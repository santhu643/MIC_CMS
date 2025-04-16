<?php
require 'config.php';
require 'session.php';

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {
    case 'get_leave':
        $result = $db->query("SELECT * FROM faculty where id='$s'");
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;


    case 'get_calendar':
        $month = isset($_GET['month']) ? intval($_GET['month']) : date('n');
        $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

        // Validate month and year
        if ($month < 1 || $month > 12 || $year < 1970 || $year > 2100) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid month or year']);
            exit();
        }

        $tableName = "devicelogs_{$month}_{$year}";

        // Prepare and execute the query
        $query = "SELECT * FROM $tableName WHERE uid = ?";
        $stmt = $erp_conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $s);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch all results
            $data = $result->fetch_all(MYSQLI_ASSOC);

            // Return results as JSON
            header('Content-Type: application/json');
            echo json_encode($data);

            // Close the statement
            $stmt->close();
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Query preparation failed: ' . $mysqli->error]);
        }

        break;

    case 'leave_apply':
        $errors = array();

        // Escape and sanitize input
        $leave = mysqli_real_escape_string($db, $_POST['leaveType']);
        $fdate = mysqli_real_escape_string($db, $_POST['fromDate']);
        $tdate = mysqli_real_escape_string($db, $_POST['toDate']);
        $fshift = mysqli_real_escape_string($db, $_POST['fromShift']);
        $tshift = mysqli_real_escape_string($db, $_POST['toShift']);
        $tdays = floatval($_POST['totalDays']);
        $reason = mysqli_real_escape_string($db, $_POST['reason']);
        // Get user information
        $uname = $s;
        $faculty = getFacultyInfo($uname);
        $reversedFdate = date('d-m-Y', strtotime($fdate));
        $reversedTdate = date('d-m-Y', strtotime($tdate));
        // Check for existing permission
        $stmt = $db->prepare("SELECT * FROM fpermission WHERE uid = ? AND fdate = ?");
        $stmt->bind_param("ss", $uname, $reversedTdate);
        $stmt->execute();
        $result = $stmt->get_result();
        $fleave = $result->fetch_object();
        $stmt->close();

        if (!$fleave || $fleave->status === 3) {
            $fromShift = $fshift === "Half Day" ? 0.5 : 1;
            $toShift = $tshift === "Half Day" ? 0.5 : 1;

            $leaveTypes = [
                "Casual Leave" => ["field" => "cl", "type" => "cl"],
                "Compensation Leave" => ["field" => "col", "type" => "col"],
                "Vacation Leave" => ["field" => "vl", "type" => "vl"],
                "Medical Leave" => ["field" => "ml", "type" => "ml"],
                "Marriage Leave" => ["field" => "mal", "type" => "mal"],
                "Maternity Leave" => ["field" => "mtl", "type" => "mtl"],
                "Paternity Leave" => ["field" => "ptl", "type" => "ptl"],
                "Study Leave" => ["field" => "sl", "type" => "sl"],
                "Special Leave" => ["field" => "spl", "type" => "spl"],
            ];

            if (!isset($leaveTypes[$leave])) {
                $res = [
                    'status' => 400,
                    'message' => "Invalid leave type"
                ];
                echo json_encode($res);
                return;
            }

            $leaveInfo = $leaveTypes[$leave];
            $ltype = $faculty->{$leaveInfo['field']};
            $lt = $leaveInfo['type'];
            $adays = $ltype - $tdays;

            if ($ltype <= 0 || $ltype < $tdays) {
                $res = [
                    'status' => 402,
                    'message' => "You don't have enough {$leave} to apply."
                ];
                echo json_encode($res);
                return;
            }

            $db->begin_transaction();

            try {
                $stmt = $db->prepare("INSERT INTO fleave (uid, name, dept, manager, ltype, fdate, tdate, tdays, fshift, tshift, reason, status, adate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $status = 0;
                $adate = date('d-m-Y');
                $stmt->bind_param("sssssssdddsss", $uname, $faculty->name, $faculty->ddept, $faculty->manager, $leave, $reversedFdate, $reversedTdate, $tdays, $fromShift, $toShift, $reason, $status, $adate);
                $stmt->execute();
                $stmt->close();

                $stmt = $db->prepare("UPDATE faculty SET $lt = ? WHERE id = ?");
                $stmt->bind_param("ds", $adays, $uname);
                $stmt->execute();
                $stmt->close();

                updateAttendanceRecords(
                    $uname,
                    $reversedFdate,
                    $reversedTdate,
                    $fromShift,
                    $toShift,
                    $leave
                );

                $db->commit();

                $res = [
                    'status' => 200,
                    'message' => "Leave applied successfully."
                ];
                echo json_encode($res);
                return;

            } catch (Exception $error) {
                $db->rollback();
                echo ("Error occurred: " . $error->getMessage());
                $res = [
                    'status' => 500,
                    'message' => "Internal server error"
                ];
                echo json_encode($res);
                return;
            }
        } else {
            $res = [
                'status' => 403,
                'message' => "You can't apply leave and permission on the same day."
            ];
            echo json_encode($res);
            return;
        }

        break;

    case 'OD_apply':
        $errors = array();
        $username = $s;
        if (!$s) {
            echo json_encode(['status' => 403, 'message' => 'User not logged in']);
            exit;
        }

        try {
            $formData = $_POST;
            $leave = $formData['ODType'];
            $fdate = $formData['fromDate'];
            $tdate = $formData['toDate'];

            // Convert dates to d-m-Y format
            $fdateParts = explode("-", $fdate);
            $tdateParts = explode("-", $tdate);
            $reversedDate = implode("-", array_reverse($tdateParts));
            $reversedFdate = implode("-", array_reverse($fdateParts));
            $reversedTdate = implode("-", array_reverse($tdateParts));

            $tshift = $formData['toShift'];
            $fshift = $formData['fromShift'];
            $tdays = floatval($formData['totalDays']);

            // $username = getUsernameFromSession();

            // Check for existing permission
            $stmt = $db->prepare("SELECT status FROM fpermission WHERE uid = ? AND fdate = ?");
            $stmt->bind_param("ss", $username, $reversedDate);
            $stmt->execute();
            $result = $stmt->get_result();
            $Fleave = $result->fetch_assoc();

            if (!$Fleave || $Fleave['status'] !== 3) {
                $faculty = getFacultyInfo($username);
                if (!$faculty) {
                    throw new Exception('Faculty information not found');
                }

                $dept = $faculty->dept;
                $name = $faculty->name;
                $manager = $faculty->manager;

                $fromShift = $fshift === "Half Day" ? 0.5 : 1;
                $toShift = $tshift === "Half Day" ? 0.5 : 1;

                $ODTypes = [
                    "OnDuty Basic" => ["field" => "odb", "key" => "odb"],
                    "On Duty Research" => ["field" => "odr", "key" => "odr"],
                    "On Duty Professional" => ["field" => "odp", "key" => "odp"],
                    "On Duty Outreach" => ["field" => "odo", "key" => "odo"]
                ];


                if (!isset($ODTypes[$leave])) {
                    throw new Exception('Invalid leave type');
                }

                $leaveInfo = $ODTypes[$leave];

                $field = $leaveInfo['field'];
                $key = $leaveInfo['key'];
                $ltype = $faculty->{$leaveInfo['field']};
                $adays = $ltype - $tdays;

                if ($ltype > 0 && $ltype >= $tdays) {
                    $reason = $formData['ODreason'];
                    $status = 0;
                    $adate = date('d-m-Y');

                    $file = $_FILES['uploadFile']['name'];
                    $file_temp = $_FILES['uploadFile']['tmp_name'];

                    $file_new_name = $username . '-' . $reversedFdate . '.' . pathinfo($file, PATHINFO_EXTENSION);


                    move_uploaded_file($file_temp, "Files/uploads/OD/" . $file_new_name);
                    $photoFilePath = $file_new_name;

                    // Begin transaction
                    $db->begin_transaction();

                    // Insert into fonduty table
                    $stmt = $db->prepare("INSERT INTO fonduty (uid, name, dept, manager, otype, fdate, tdate, 
                                          tdays, fshift, tshift, reason, file, status, adate) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                    $stmt->bind_param(
                        "sssssssdddssss",
                        $username,
                        $name,
                        $dept,
                        $manager,
                        $leave,
                        $reversedFdate,
                        $reversedTdate,
                        $tdays,
                        $fromShift,
                        $toShift,
                        $reason,
                        $photoFilePath,
                        $status,
                        $adate
                    );

                    if (!$stmt->execute()) {
                        throw new Exception('Failed to insert OD record');
                    }

                    // Update faculty leave balance
                    $stmt = $db->prepare("UPDATE faculty SET $key = ? WHERE id = ?");
                    $stmt->bind_param("ds", $adays, $username);

                    if (!$stmt->execute()) {
                        throw new Exception('Failed to update leave balance');
                    }

                    // Call existing attendance update function
                    updateAttendanceRecords(
                        $username,
                        $reversedFdate,
                        $reversedTdate,
                        $fromShift,
                        $toShift,
                        $leave
                    );

                    // Commit transaction
                    $db->commit();

                    echo json_encode(['status' => 200, 'message' => 'OD Applied Successfully']);

                } else {
                    echo json_encode([
                        'status' => 402,
                        'message' => "You don't have enough $leave to apply."
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 403,
                    'message' => "You can't apply OD and permission on the same day."
                ]);
            }

        } catch (Exception $e) {
            // Rollback transaction if active


            // Delete uploaded file if exists and there was an error
            if (isset($photoFilePath) && file_exists($photoFilePath)) {
                unlink($photoFilePath);
            }

            echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
        }

        // Close database connection
        $db->close();

        break;

        case 'permission_apply':
            $uname = $s;
            $formData = $_POST;
            $leave = $formData['permissionType'];
            $fdate = $formData['permissionDate'];
            $fdateParts = explode("-", $fdate);
    
            // Rearranging the date parts to form the desired format
            list($year1, $month1, $day1) = explode("-", $fdate);
            $reversedDate = "$day1-$month1-$year1";
    
            try {
                // Check existing permissions
                $stmt = mysqli_prepare($db, "SELECT * FROM fpermission WHERE uid = ? AND fdate = ?");
                mysqli_stmt_bind_param($stmt, "ss", $uname, $reversedDate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $existingPermission = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
    
                // Check existing leaves
                $stmt = mysqli_prepare($db, "SELECT * FROM fleave WHERE uid = ? AND (? BETWEEN fdate AND tdate) AND status != 3");
                mysqli_stmt_bind_param($stmt, "ss", $uname, $reversedDate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $existingLeave = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
    
                // Check existing on-duty
                $stmt = mysqli_prepare($db, "SELECT * FROM fonduty WHERE uid = ? AND (? BETWEEN fdate AND tdate) AND status != 3");
                mysqli_stmt_bind_param($stmt, "ss", $uname, $reversedDate);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $existingOnduty = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
    
                if ($existingPermission) {
                    $res = ['status' => 403, 'message' => "You already have a permission application for this date."];
                } else if ($existingLeave) {
                    $res = ['status' => 403, 'message' => "You cannot apply for permission as you have already applied for leave on this date."];
                } else if ($existingOnduty) {
                    $res = ['status' => 403, 'message' => "You cannot apply for permission as you have on-duty scheduled for this date."];
                } else {
                    // Get faculty info
                    $faculty = getFacultyInfo($uname);
                    if (!$faculty) {
                        throw new Exception('Faculty information not found');
                    }
    
                    $ltype = 0;
                    $lt = "";
    
                    if ($leave === "Morning" || $leave === "Evening") {
                        $ltype = $faculty->pm;
                        $lt = "pm";
                    } else if ($leave === "10minM" || $leave === "10minE") {
                        $ltype = $faculty->tenpm;
                        $lt = "tenpm";
                    }
    
                    $adays = $ltype - 1;
    
                    if ($ltype > 0) {
                        $reversedFdate = $fdateParts[2] . "-" . $fdateParts[1] . "-" . $fdateParts[0];
                        $reason = mysqli_real_escape_string($db, $formData['preason']);
                        $status = 0;
    
                        $today = new DateTime();
                        $adate = $today->format('d-m-Y');
    
                        $dept = $faculty->ddept;
                        $name = $faculty->name;
                        $manager = $faculty->manager;
    
                        // Begin transaction
                        mysqli_begin_transaction($db);
    
                        try {
                            // Insert new permission
                            $stmt = mysqli_prepare(
                                $db,
                                "INSERT INTO fpermission (uid, name, dept, manager, ltype, fdate, reason, status, adate) 
                                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
                            );
                            mysqli_stmt_bind_param(
                                $stmt,
                                "sssssssss",
                                $uname,
                                $name,
                                $dept,
                                $manager,
                                $leave,
                                $reversedFdate,
                                $reason,
                                $status,
                                $adate
                            );
                            $result = mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);
    
                            if ($result) {
                                // Update faculty table
                                $stmt = mysqli_prepare($db, "UPDATE faculty SET $lt = ? WHERE id = ?");
                                mysqli_stmt_bind_param($stmt, "is", $adays, $uname);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
    
                                // Update permission records
                                updatePermissionRecords($uname, $fdate, $leave);
    
                                // Commit transaction
                                mysqli_commit($db);
                                $res = ['status' => 200, 'message' => "Permission Applied Successfully"];
                            } else {
                                throw new Exception("Failed to insert permission record");
                            }
                        } catch (Exception $error) {
                            mysqli_rollback($db);
                            error_log("Error occurred during permission application: " . $error->getMessage());
                            $res = ['status' => 500, 'message' => "Internal server error"];
                        }
                    } else {
                        $res = ['status' => 402, 'message' => "You don't have enough $leave Permission to apply."];
                    }
                }
            } catch (Exception $error) {
                error_log("Error during permission validation: " . $error->getMessage());
                $res = ['status' => 500, 'message' => "Internal server error"];
            }
    
            mysqli_close($db);
            echo json_encode($res);
            break;

        case 'COL_apply':
            $formData = $_POST;
            try {
                $fdate = $formData['fromDate3'];
                $fdateParts = explode("-", $fdate);
                $reversedFdate = $fdateParts[2] . "-" . $fdateParts[1] . "-" . $fdateParts[0];
                
                $currentMonth = intval($fdateParts[1]);
                $currentYear = $fdateParts[0];
                $tableName = "devicelogs_" . $currentMonth . "_" . $currentYear;
                
                $reason = $formData['colreason'];
                $status = 0;
                
                $today = new DateTime();
                $adate = $today->format('d-m-Y');
                
                $uname = $s;
        
                // First check if COL request already exists for this date
                $checkStmt = mysqli_prepare(
                    $db,
                    "SELECT COUNT(*) as count FROM fcolreq WHERE uid = ? AND fdate = ?"
                );
                mysqli_stmt_bind_param($checkStmt, "ss", $uname, $reversedFdate);
                mysqli_stmt_execute($checkStmt);
                $checkResult = mysqli_stmt_get_result($checkStmt);
                $existingRequest = mysqli_fetch_assoc($checkResult);
        
                if ($existingRequest['count'] > 0) {
                    echo json_encode([
                        'status' => 401,
                        'message' => "A COL request already exists for this date."
                    ]);
                    exit();
                }
        
                // Query device_log table
                $stmt = mysqli_prepare(
                    $erp_conn,
                    "SELECT * FROM `" . mysqli_real_escape_string($erp_conn, $tableName) . "` 
                     WHERE tdate = ? AND uid = ?"
                );
                mysqli_stmt_bind_param($stmt, "ss", $fdate, $uname);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);
        
                if (
                    $row &&
                    !empty($row['in_time']) &&
                    !empty($row['out_time']) &&
                    $row['hday'] === 1
                ) {
                    $inTime = $row['in_time'];
                    $outTime = $row['out_time'];
        
                    // Calculate total hours worked
                    $inDate = strtotime("1970-01-01 " . $inTime);
                    $outDate = strtotime("1970-01-01 " . $outTime);
                    $totalHoursWorked = ($outDate - $inDate) / 3600; // Convert seconds to hours
        
                    $tdays = 0;
                    if ($totalHoursWorked >= 8) {
                        $tdays = 1;
                    } else if ($totalHoursWorked >= 4) {
                        $tdays = 0.5;
                    }
        
                    if ($tdays === 0) {
                        echo json_encode([
                            'status' => 401,
                            'message' => "You are Not eligible to Apply COL on this day."
                        ]);
                        exit();
                    }
        
                    // Get faculty info
                    $faculty = getFacultyInfo($uname);
                    if (!$faculty) {
                        throw new Exception('Faculty information not found');
                    }
        
                    // Insert into fcolreq table
                    $stmt = mysqli_prepare(
                        $db,
                        "INSERT INTO fcolreq (uid, name, dept, manager, fdate, reason, 
                                            intime, outtime, days, status, adate)
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
                    );
        
                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssssssssdis",
                        $uname,
                        $faculty->name,
                        $faculty->ddept,
                        $faculty->manager,
                        $reversedFdate,
                        $reason,
                        $inTime,
                        $outTime,
                        $tdays,
                        $status,
                        $adate
                    );
        
                    $result = mysqli_stmt_execute($stmt);
        
                    if ($result) {
                        mysqli_close($db);
                        $res = ['status' => 200, 'message' => "COL request Applied Successfully"];
                    } else {
                        mysqli_close($db);
                        $res = ['status' => 401, 'message' => "COL request Application Failed"];
                    }
                } else {
                    mysqli_close($db);
                    $res = [
                        'status' => 401,
                        'message' => "You are Not eligible to Apply COL on this day."
                    ];
                }
            } catch (Exception $error) {
                error_log("Error occurred during COL request: " . $error->getMessage());
                mysqli_close($erp_conn);
                $res = ['status' => 500, 'message' => "Internal server error"];
            }
            echo json_encode($res);
            break;

    case 'ODR_apply':
        $errors = array();
        $formData = $_POST;
        try {
            $fdate = $formData['fromDate'];
            $tdate = $formData['toDate'];
            $fdateParts = explode("-", $fdate);
            $tdateParts = explode("-", $tdate);
            $tshift = $formData['toShift'];
            $fshift = $formData['fromShift'];
            $tdays = floatval($formData['totalDays']);

            $uname = $s; // You'll need to implement this function

            // Fetch faculty info
            $faculty = getFacultyInfo($uname);
            if (!$faculty) {
                throw new Exception('Faculty information not found');
            }

            $fromShift = 1;
            $toShift = 1;

            if ($fshift === "Half Day") {
                $fromShift = 0.5;
            }
            if ($tshift === "Half Day") {
                $toShift = 0.5;
            }

            // Rearranging the date parts
            $reversedFdate = $fdateParts[2] . "-" . $fdateParts[1] . "-" . $fdateParts[0];
            $reversedTdate = $tdateParts[2] . "-" . $tdateParts[1] . "-" . $tdateParts[0];

            $reason = $formData['ODRreason'];
            $status = 0;

            $today = new DateTime();
            $adate = $today->format('d-m-Y');

            // Handle file upload
            $file = $_FILES['uploadFile']['name'];
            $file_temp = $_FILES['uploadFile']['tmp_name'];

            $file_new_name = $uname . '-' . $reversedFdate . '.' . pathinfo($file, PATHINFO_EXTENSION);

            move_uploaded_file($file_temp, "Files/uploads/ODR/" . $file_new_name);
            $photoFilePath = $file_new_name;

            // Insert into fondutyreq table
            $stmt = mysqli_prepare(
                $db,
                "INSERT INTO fondutyreq (uid, name, dept, manager, fdate, tdate, 
                                           tdays, fshift, tshift, reason, file, status, adate)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "ssssssdddssis",
                $uname,
                $faculty->name,
                $faculty->ddept,
                $faculty->manager,
                $reversedFdate,
                $reversedTdate,
                $tdays,
                $fromShift,
                $toShift,
                $reason,
                $photoFilePath,
                $status,
                $adate
            );

            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                mysqli_close($db);
                $res = ['status' => 200, 'message' => "OD Request Applied Successfully"];
            } else {
                // Delete uploaded file if database insert fails
                unlink($photoFilePath);
                mysqli_close($db);
                $res = ['status' => 401, 'message' => "OD Apply Failed"];
            }

        } catch (Exception $e) {
            if (isset($photoFilePath) && file_exists($photoFilePath)) {
                unlink($photoFilePath);
            }

            // echo json_encode(['status' => 500, 'message' => $e->getMessage()]);
            $res = ['status' => 500, 'message' => "Internal server error"];
        }
        echo json_encode($res);
        break;

    case 'get_leave_details':
        $uid = $s;
        $query = "SELECT * FROM fleave WHERE uid = ? ORDER BY id DESC";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $leaves = array(); // Create array to store all leaves

        while ($student = mysqli_fetch_assoc($result)) {
            $leaves[] = $student; // Add each leave to array
        }

        if (!empty($leaves)) {
            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully',
                'data' => $leaves
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'No details found for this ID'
            ];
        }
        echo json_encode($res);
        break;

    case 'delete_leave':
        $leaveId = $_POST['leave_id'];
        $leaveType = $_POST['leave_type'];
        $totalDays = floatval($_POST['total_days']);
        $username = $s;

        if (!$username) {
            $response = ['status' => 401, 'message' => 'Unauthorized access'];
            echo json_encode($response);
            exit;
        }

        // Start transaction
        $db->begin_transaction();  

        try {
            // Get faculty information
            $faculty = getFacultyInfo($username);

            // Define leave type mappings
            $leaveTypes = [
                "Casual Leave" => ["field" => "cl", "type" => "cl"],
                "Compensation Leave" => ["field" => "col", "type" => "col"],
                "Vacation Leave" => ["field" => "vl", "type" => "vl"],
                "Medical Leave" => ["field" => "ml", "type" => "ml"],
                "Marriage Leave" => ["field" => "mal", "type" => "mal"],
                "Maternity Leave" => ["field" => "mtl", "type" => "mtl"],
                "Paternity Leave" => ["field" => "ptl", "type" => "ptl"],
                "Study Leave" => ["field" => "sl", "type" => "sl"],
                "Special Leave" => ["field" => "spl", "type" => "spl"]
            ];

            if (!isset($leaveTypes[$leaveType])) {
                throw new Exception("Invalid leave type");
            }

            $leaveInfo = $leaveTypes[$leaveType];
            $field = $leaveInfo['field'];
            $currentLeaveBalance = $faculty->$field;
            $updatedLeaveBalance = $currentLeaveBalance + $totalDays;

            // Get leave details before deletion
            $stmt = $db->prepare("SELECT fdate, tdate, fshift, tshift FROM fleave WHERE id = ?");
            $stmt->bind_param("i", $leaveId);
            $stmt->execute();
            $leaveDetails = $stmt->get_result()->fetch_object();
            $stmt->close();

            if (!$leaveDetails) {
                throw new Exception("Leave record not found");
            }

            // Delete the leave record
            $stmt = $db->prepare("DELETE FROM fleave WHERE id = ?");
            $stmt->bind_param("i", $leaveId);
            $deleteSuccess = $stmt->execute();
            $stmt->close();

            if ($deleteSuccess) {
                // Update faculty leave balance
                $stmt = $db->prepare("UPDATE faculty SET {$leaveInfo['type']} = ? WHERE id = ?");
                $stmt->bind_param("ds", $updatedLeaveBalance, $username);
                $stmt->execute();
                $stmt->close();

                // Update attendance records
                $fromShift = $leaveDetails->fshift === "Half Day" ? 0.5 : 1;
                $toShift = $leaveDetails->tshift === "Half Day" ? 0.5 : 1;
                updateAttendanceRecords(
                    $username,
                    $leaveDetails->fdate,
                    $leaveDetails->tdate,
                    $fromShift,
                    $toShift,
                    $leaveType,
                    true
                );

                $db->commit();
                $response = ['status' => 200, 'message' => 'Leave record deleted successfully'];
                echo json_encode($response);
                exit;
            } else {
                throw new Exception("Failed to delete leave record");
            }
        } catch (Exception $e) {
            $db->rollback();
            $response = ['status' => 500, 'message' => $e->getMessage()];
            echo json_encode($response);
            exit;
        }

    case 'get_OD_details':

        $uid = $s;
        $query = "SELECT * FROM fonduty WHERE uid = ? ORDER BY id DESC";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $leaves = array(); // Create array to store all leaves

        while ($student = mysqli_fetch_assoc($result)) {
            $leaves[] = $student; // Add each leave to array
        }

        if (!empty($leaves)) {
            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully',
                'data' => $leaves
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'No details found for this ID'
            ];
        }
        echo json_encode($res);
        break;



    case 'delete_OD':
        $odId = $_POST['od_id'];
        $fileUrl = $_POST['file_url'];
        $odType = $_POST['od_type'];
        $totalDays = floatval($_POST['total_days']);
        $username = $s;

        if (!$username) {
            $response = ['status' => 401, 'message' => 'Unauthorized access'];
            echo json_encode($response);
            exit;
        }

        // Start transaction
        $db->begin_transaction();

        try {
            // Get faculty information
            $faculty = getFacultyInfo($username);

            // Define OD type mappings
            $odTypes = [
                "OnDuty Basic" => ["field" => "odb", "type" => "odb"],
                "On Duty Research" => ["field" => "odr", "type" => "odr"],
                "On Duty Professional" => ["field" => "odp", "type" => "odp"],
                "On Duty Outreach" => ["field" => "odo", "type" => "odo"]
            ];

            if (!isset($odTypes[$odType])) {
                throw new Exception("Invalid OD type");
            }

            $odInfo = $odTypes[$odType];
            $field = $odInfo['field'];

            //$currentOdBalance = $faculty->$field;
            $currentOdBalance = $faculty->{$odInfo['field']};
            $updatedOdBalance = $currentOdBalance + $totalDays;

            // Get OD details before deletion
            $stmt = $db->prepare("SELECT fdate, tdate, fshift, tshift FROM fonduty WHERE id = ?");
            $stmt->bind_param("i", $odId);
            $stmt->execute();
            $odDetails = $stmt->get_result()->fetch_object();
            $stmt->close();

            if (!$odDetails) {
                throw new Exception("OD record not found");
            }

            // Delete the file
            $filePath = 'Files/uploads/OD/' . $fileUrl;

            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    error_log("Error deleting file: " . $filePath);
                    // Continue execution even if file deletion fails
                }
            }

            // Delete the OD record
            $stmt = $db->prepare("DELETE FROM fonduty WHERE id = ?");
            $stmt->bind_param("i", $odId);
            $deleteSuccess = $stmt->execute();
            $stmt->close();

            if ($deleteSuccess) {
                // Update faculty OD balance
                $stmt = $db->prepare("UPDATE faculty SET {$odInfo['type']} = ? WHERE id = ?");
                $stmt->bind_param("ds", $updatedOdBalance, $username);
                $stmt->execute();
                $stmt->close();

                // Update attendance records
                $fromShift = $odDetails->fshift === "Half Day" ? 0.5 : 1;
                $toShift = $odDetails->tshift === "Half Day" ? 0.5 : 1;
                updateAttendanceRecords(
                    $username,
                    $odDetails->fdate,
                    $odDetails->tdate,
                    $fromShift,
                    $toShift,
                    $odType,
                    true
                );

                $db->commit();
                $response = ['status' => 200, 'message' => 'OD record deleted successfully'];
                echo json_encode($response);
                exit;
            } else {
                throw new Exception("Failed to delete OD record");
            }
        } catch (Exception $e) {
            $db->rollback();
            $response = ['status' => 500, 'message' => $e->getMessage()];
            echo json_encode($response);
            exit;
        }


    case 'get_per_details':
        $uid = $s;
        $query = "SELECT * FROM fpermission WHERE uid = ? ORDER BY id DESC";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $leaves = array(); // Create array to store all leaves

        while ($student = mysqli_fetch_assoc($result)) {
            $leaves[] = $student; // Add each leave to array
        }

        if (!empty($leaves)) {
            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully',
                'data' => $leaves
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'No details found for this ID'
            ];
        }
        echo json_encode($res);
        break;

    case 'delete_PER':
        try {
            $uname = $s; // You'll need to implement this function

            // Get faculty info
            $faculty = getFacultyInfo($uname);

            $uid = (int) $_POST['per_id'];
            $leave = $_POST['per_type'];
            $fdate = $_POST['fdate'];


            $parts = explode("-", $fdate);
            $reversedDate = $parts[2] . "-" . $parts[1] . "-" . $parts[0];

            // Determine leave type and value
            $ltype = null;
            $lt = null;

            if ($leave === "Morning" || $leave === "Evening") {
                $ltype = $faculty->pm;
                $lt = "pm";
            } else if ($leave === "10minM" || $leave === "10minE") {
                $ltype = $faculty->tenpm;
                $lt = "tenpm";
            }

            $adays = $ltype + 1;

            // Start transaction
            mysqli_begin_transaction($db);

            // Delete from fpermission table
            $stmt = mysqli_prepare($db, "DELETE FROM fpermission WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $uid);
            $deleteResult = mysqli_stmt_execute($stmt);

            if ($deleteResult && mysqli_affected_rows($db) > 0) {
                // Update faculty table
                $updateQuery = "UPDATE faculty SET $lt = ? WHERE id = ?";
                $stmt = mysqli_prepare($db, $updateQuery);
                mysqli_stmt_bind_param($stmt, "ds", $adays, $uname);
                $updateResult = mysqli_stmt_execute($stmt);

                if ($updateResult) {
                    // Update permission records
                    updatePermissionRecords($uname, $reversedDate, $leave, true);

                    // Commit transaction
                    mysqli_commit($db);
                    mysqli_close($db);
                    $res = ['status' => 200, 'message' => "Deleted successfully"];
                } else {
                    // Rollback if faculty update fails
                    mysqli_rollback($db);
                    mysqli_close($db);
                    $res = ['status' => 401, 'message' => "Deletion failed during faculty update"];
                }
            } else {
                // Rollback if permission deletion fails
                mysqli_rollback($db);
                mysqli_close($db);
                $res = ['status' => 401, 'message' => "Deletion failed"];
            }

        } catch (Exception $error) {
            // Rollback on any error
            if ($db) {
                mysqli_rollback($db);
                mysqli_close(mysql: $db);
            }
            echo json_encode("Error occurred during permission deletion: " . $error->getMessage());
            $res = ['status' => 500, 'message' => "Internal server error"];
        }
        echo json_encode($res);
        break;

    case 'get_col_details':
        $uid = $s;
        $query = "SELECT * FROM fcolreq WHERE uid = ? ORDER BY id DESC";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $leaves = array(); // Create array to store all leaves

        while ($student = mysqli_fetch_assoc($result)) {
            $leaves[] = $student; // Add each leave to array
        }

        if (!empty($leaves)) {
            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully',
                'data' => $leaves
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'No details found for this ID'
            ];
        }
        echo json_encode($res);
        break;

    case 'delete_COL':
        $uid = (int) $_POST['per_id'];
        try {
            // Prepare the delete statement
            $stmt = $db->prepare("DELETE FROM fcolreq WHERE id = ?");

            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $db->error);
            }

            // Bind the parameter
            $stmt->bind_param("s", $uid);

            // Execute the statement
            if ($stmt->execute()) {
                // Check if any rows were affected
                if ($stmt->affected_rows > 0) {
                    $res = array(
                        "status" => 200,
                        "message" => "Deleted successfully"
                    );
                } else {
                    error_log("Deletion failed: No matching record found");
                    $res = array(
                        "status" => 401,
                        "message" => "Deletion failed"
                    );
                }
            } else {
                throw new Exception("Execute failed: " . $stmt->error);
            }

        } catch (Exception $e) {
            error_log("Error occurred during deletion: " . $e->getMessage());
            $res = array(
                "status" => 500,
                "message" => "Internal server error"
            );
        } finally {
            // Close statement and connection
            if (isset($stmt)) {
                $stmt->close();
            }
            $db->close();
        }
        echo json_encode($res);
        break;


    case 'get_ROD_details':
        $uid = $s;
        $query = "SELECT * FROM fondutyreq WHERE uid = ? ORDER BY id DESC";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $leaves = array(); // Create array to store all leaves

        while ($student = mysqli_fetch_assoc($result)) {
            $leaves[] = $student; // Add each leave to array
        }

        if (!empty($leaves)) {
            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully',
                'data' => $leaves
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'No details found for this ID'
            ];
        }
        echo json_encode($res);
        break;


    case 'delete_ROD':
        $uid = (int) $_POST['od_id'];
        $fileurl = $_POST['file_url'];
        // Delete file if exists
        $url = "Files/uploads/ODR/" . $fileurl;
        //echo json_encode($url);
        if (file_exists($url)) {
            unlink($url);
        }

        // Delete record
        $stmt = $db->prepare("DELETE FROM fondutyreq WHERE id = ?");
        $stmt->bind_param("s", $uid);

        if ($stmt->execute() && $stmt->affected_rows > 0) {
            $res = array("status" => 200, "message" => "Deleted successfully");
        } else {
            $res = array("status" => 401, "message" => "Deletion failed");
        }

        $stmt->close();
        $db->close();

        echo json_encode($res);
        break;


    default:
        echo json_encode(['error' => 'Invalid action']);
}








function getFacultyInfo($uname)
{
    global $db;
    $stmt = $db->prepare("SELECT * FROM faculty WHERE id = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();
    $faculty = $result->fetch_object();
    $stmt->close();
    return $faculty;
}

function updateAttendanceRecords($uid, $fdate, $tdate, $fshift, $tshift, $leave, $isDeleting = false)
{
    global $erp_conn;
    $fromDate = new DateTime($fdate);
    $toDate = new DateTime($tdate);
    $dateRange = new DatePeriod(
        $fromDate,
        new DateInterval('P1D'),
        $toDate->modify('+1 day')
    );
    try {
        foreach ($dateRange as $date) {
            $formattedDate = $date->format('Y-m-d');
            
            $lcValue = $isDeleting ? 0 : 7;
            if (!$isDeleting) {
                if ($date == $fromDate && $fshift == 0.5) {
                    $lcValue = 7.5;
                } elseif ($date == $toDate && $tshift == 0.5) {
                    $lcValue = 7.5;
                }
            }
            
            $leaveType = $isDeleting ? null : $leave;
            $tableName = "devicelogs_" . $date->format('n_Y');
            
            // Check if existing record has lc = 0.5
            $checkStmt = $erp_conn->prepare("SELECT lc FROM `$tableName` WHERE uid = ? AND tdate = ?");
            $checkStmt->bind_param("ss", $uid, $formattedDate);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            $row = $result->fetch_assoc();
            $checkStmt->close();
            
            if ($row && $row['lc'] > 0) {
                // If lc is 0.5, update lc2 instead
                $stmt = $erp_conn->prepare("UPDATE `$tableName` SET lc2 = ?, ltype2 = ? WHERE uid = ? AND tdate = ?");
            } else {
                // Normal update to lc
                $stmt = $erp_conn->prepare("UPDATE `$tableName` SET lc = ?, ltype = ? WHERE uid = ? AND tdate = ?");
            }
            
            $stmt->bind_param("dsss", $lcValue, $leaveType, $uid, $formattedDate);
            $stmt->execute();
            $stmt->close();
        }
    } catch (Exception $error) {
        error_log("Error updating attendance records: " . $error->getMessage());
        throw $error;
    }
}

function updatePermissionRecords($uid, $fdate, $leave, $isDeleting = false)
{
    global $erp_conn;
    error_log($fdate);

    list($year, $month) = explode('-', $fdate);
    $tableName = "devicelogs_" . intval($month) . "_" . $year;
    error_log($tableName);

    $leaveTypes = [
        'Morning' => 'mp',
        'Evening' => 'ep',
        '10minM' => 'tmp',
        '10minE' => 'tep'
    ];

    $lt = isset($leaveTypes[$leave]) ? $leaveTypes[$leave] : '';
    $lcValue = $isDeleting ? 0 : 7;

    try {
        // Using prepared statement for the dynamic table name
        $updateQuery = sprintf(
            "UPDATE `%s` SET `%s` = ?, ltype = ? WHERE uid = ? AND tdate = ?",
            mysqli_real_escape_string($erp_conn, $tableName),
            mysqli_real_escape_string($erp_conn, $lt)
        );

        $stmt = mysqli_prepare($erp_conn, $updateQuery);
        $ltype = $isDeleting ? null : $leave;
        mysqli_stmt_bind_param($stmt, "isss", $lcValue, $ltype, $uid, $fdate);
        mysqli_stmt_execute($stmt);

        error_log("Data updated in target database for " . $fdate);
    } catch (Exception $error) {
        error_log("Error updating attendance records: " . $error->getMessage());
        throw $error;
    }
}

?>