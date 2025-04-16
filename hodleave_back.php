<?php
require 'config.php';
require 'session.php';
date_default_timezone_set('Asia/Kolkata');
ini_set('error_log', 'error.log');

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {


    case 'get_leave_balance_details':

        $uid = $s;
        $faculty = getFacultyInfo($uid);
        $fdept = $faculty->ddept;
        try {
            // Now fetch the main data
            $stmt = $db->prepare("SELECT * FROM faculty WHERE ddept = ? AND status = ? AND manager = ?");
            $status = 1;
            $manager = "HOD";
            $stmt->bind_param("sis", $fdept, $status, $manager);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = [];
            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }
            $stmt->close();

            if (count($userData) > 0) {
                $response = [
                    'status' => 200,
                    'message' => 'Data Fetching successful',
                    'data' => $userData
                ];
            } else {
                error_log("Data fetching failed");
                $response = [
                    'status' => 401,
                    'message' => 'No Data Found..'
                ];
            }

        } catch (Exception $e) {
            error_log("Error occurred during fetch: " . $e->getMessage());
            $response = [
                'status' => 500,
                'message' => 'Internal server error'
            ];
        } finally {
            $db->close();
        }
        echo json_encode($response);
        break;


    case 'get_leave_details':

        $uid = $s;
        $faculty = getFacultyInfo($uid);
        $fdept = $faculty->ddept;
        try {
            // Now fetch the main data
            $stmt = $db->prepare("SELECT * FROM fleave WHERE dept = ? AND status = ? AND manager = ?");
            $status = 0;
            $manager = "HOD";
            $stmt->bind_param("sis", $fdept, $status, $manager);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = [];
            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }
            $stmt->close();

            if (count($userData) > 0) {
                $response = [
                    'status' => 200,
                    'message' => 'Data Fetching successful',
                    'data' => $userData
                ];
            } else {
                error_log("Data fetching failed");
                $response = [
                    'status' => 401,
                    'message' => 'Data Fetching failed'
                ];
            }

        } catch (Exception $e) {
            error_log("Error occurred during fetch: " . $e->getMessage());
            $response = [
                'status' => 500,
                'message' => 'Internal server error'
            ];
        } finally {
            $db->close();
        }
        echo json_encode($response);
        break;




    case 'approve_leave':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $ltype = mysqli_real_escape_string($db, $_POST['ltype']);
        $fdate = mysqli_real_escape_string($db, $_POST['fdate']);
        $tdate = mysqli_real_escape_string($db, $_POST['tdate']);
        $fshift = mysqli_real_escape_string($db, $_POST['fshift']);
        $tshift = mysqli_real_escape_string($db, $_POST['tshift']);

        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fleave SET status = 1 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // If update successful, update attendance records
                updateAttendanceRecords($uid, $fdate, $tdate, $fshift, $tshift, $ltype);

                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Forwarded successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'reject_leave':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $ltype = mysqli_real_escape_string($db, $_POST['ltype']);
        $fdate = mysqli_real_escape_string($db, $_POST['fdate']);
        $tdate = mysqli_real_escape_string($db, $_POST['tdate']);
        $fshift = mysqli_real_escape_string($db, $_POST['fshift']);
        $tshift = mysqli_real_escape_string($db, $_POST['tshift']);
        $tdays = mysqli_real_escape_string($db, $_POST['tdays']);
        $reject_reason = mysqli_real_escape_string($db, $_POST['reject_reason']);

        try {
            // Start transaction
            $db->begin_transaction();
            $faculty = getFacultyInfo($uid);

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

            $leaveInfo = $leaveTypes[$ltype];
            $field = $leaveInfo['field'];
            $currentLeaveBalance = $faculty->$field;
            $updatedLeaveBalance = $currentLeaveBalance + $tdays;
            // Update fleave table
            $stmt = $db->prepare("UPDATE fleave SET status = 3, info = ? WHERE id = ?");
            $stmt->bind_param("si", $reject_reason, $leaveid);
            $result = $stmt->execute();

            if ($result) {

                $stmt = $db->prepare("UPDATE faculty SET {$leaveInfo['type']} = ? WHERE id = ?");
                $stmt->bind_param("ds", $updatedLeaveBalance, $uid);
                $stmt->execute();
                // If update successful, update attendance records
                updateAttendanceRecords($uid, $fdate, $tdate, $fshift, $tshift, $ltype, true);

                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Rejected successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'get_OD_details':

        $uid = $s;
        $faculty = getFacultyInfo($uid);
        $fdept = $faculty->ddept;
        try {
            // Now fetch the main data
            $stmt = $db->prepare("SELECT * FROM fonduty WHERE dept = ? AND status = ? AND manager = ?");
            $status = 0;
            $manager = "HOD";
            $stmt->bind_param("sis", $fdept, $status, $manager);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = [];
            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }
            $stmt->close();

            if (count($userData) > 0) {
                $response = [
                    'status' => 200,
                    'message' => 'Data Fetching successful',
                    'data' => $userData
                ];
            } else {
                error_log("Data fetching failed");
                $response = [
                    'status' => 401,
                    'message' => 'Data Fetching failed'
                ];
            }

        } catch (Exception $e) {
            error_log("Error occurred during fetch: " . $e->getMessage());
            $response = [
                'status' => 500,
                'message' => 'Internal server error'
            ];
        } finally {
            $db->close();
        }
        echo json_encode($response);
        break;



    case 'approve_OD':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $otype = mysqli_real_escape_string($db, $_POST['otype']);
        $fdate = mysqli_real_escape_string($db, $_POST['fdate']);
        $tdate = mysqli_real_escape_string($db, $_POST['tdate']);
        $fshift = mysqli_real_escape_string($db, $_POST['fshift']);
        $tshift = mysqli_real_escape_string($db, $_POST['tshift']);

        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fonduty SET status = 1 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // If update successful, update attendance records
                updateAttendanceRecords($uid, $fdate, $tdate, $fshift, $tshift, $otype);

                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Forwarded successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'reject_OD':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $otype = mysqli_real_escape_string($db, $_POST['otype']);
        $fdate = mysqli_real_escape_string($db, $_POST['fdate']);
        $tdate = mysqli_real_escape_string($db, $_POST['tdate']);
        $fshift = mysqli_real_escape_string($db, $_POST['fshift']);
        $tshift = mysqli_real_escape_string($db, $_POST['tshift']);
        $tdays = mysqli_real_escape_string($db, $_POST['tdays']);

        try {
            // Start transaction
            $db->begin_transaction();
            $faculty = getFacultyInfo($uid);

            $leaveTypes = [
                "OnDuty Basic" => ["field" => "odb", "type" => "odb"],
                "On Duty Research" => ["field" => "odr", "type" => "odr"],
                "On Duty Professional" => ["field" => "odp", "type" => "odp"],
                "On Duty Outreach" => ["field" => "odo", "type" => "odo"]
            ];

            $leaveInfo = $leaveTypes[$otype];
            $field = $leaveInfo['field'];
            $currentLeaveBalance = $faculty->$field;
            $updatedLeaveBalance = $currentLeaveBalance + $tdays;
            // Update fleave table
            $stmt = $db->prepare("UPDATE fonduty SET status = 3 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {

                $stmt = $db->prepare("UPDATE faculty SET {$leaveInfo['type']} = ? WHERE id = ?");
                $stmt->bind_param("ds", $updatedLeaveBalance, $uid);
                $stmt->execute();
                $stmt->close();
                // If update successful, update attendance records
                updateAttendanceRecords($uid, $fdate, $tdate, $fshift, $tshift, $otype, true);

                // Commit transaction
                $db->commit();
                // $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Rejected successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;


    case 'get_PER_details':

        $uid = $s;
        $faculty = getFacultyInfo($uid);
        $fdept = $faculty->ddept;
        try {
            // Now fetch the main data
            $stmt = $db->prepare("SELECT * FROM fpermission WHERE dept = ? AND status = ? AND manager = ?");
            $status = 0;
            $manager = "HOD";
            $stmt->bind_param("sis", $fdept, $status, $manager);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = [];
            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }
            $stmt->close();

            if (count($userData) > 0) {
                $response = [
                    'status' => 200,
                    'message' => 'Data Fetching successful',
                    'data' => $userData
                ];
            } else {
                error_log("Data fetching failed");
                $response = [
                    'status' => 401,
                    'message' => 'Data Fetching failed'
                ];
            }

        } catch (Exception $e) {
            error_log("Error occurred during fetch: " . $e->getMessage());
            $response = [
                'status' => 500,
                'message' => 'Internal server error'
            ];
        } finally {
            $db->close();
        }
        echo json_encode($response);
        break;


    case 'approve_PER':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $ltype = mysqli_real_escape_string($db, $_POST['ltype']);
        $fdate = mysqli_real_escape_string($db, $_POST['fdate']);


        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fpermission SET status = 1 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // If update successful, update attendance records
                updatePermissionRecords($uid, $fdate, $ltype);

                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Forwarded successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'reject_PER':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        $ltype = mysqli_real_escape_string($db, $_POST['ltype']);
        $fdate = mysqli_real_escape_string($db, $_POST['fdate']);


        try {
            // Start transaction
            $db->begin_transaction();
            $faculty = getFacultyInfo($uid);

            $leaveTypes = [
                "Morning" => ["field" => "pm", "type" => "pm"],
                "Evening" => ["field" => "pm", "type" => "pm"],
                "10minM" => ["field" => "tenpm", "type" => "tenpm"],
                "10minE" => ["field" => "tenpm", "type" => "tenpm"]
            ];

            $leaveInfo = $leaveTypes[$ltype];
            $field = $leaveInfo['field'];
            $currentLeaveBalance = $faculty->$field;
            $updatedLeaveBalance = $currentLeaveBalance + 1;
            // Update fleave table
            $stmt = $db->prepare("UPDATE fpermission SET status = 3 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {

                $stmt = $db->prepare("UPDATE faculty SET {$leaveInfo['type']} = ? WHERE id = ?");
                $stmt->bind_param("ds", $updatedLeaveBalance, $uid);
                $stmt->execute();
                $stmt->close();
                // If update successful, update attendance records
                updatePermissionRecords($uid, $fdate, $ltype, true);

                // Commit transaction
                $db->commit();
                // $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Rejected successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'get_Col_details':

        $uid = $s;
        $faculty = getFacultyInfo($uid);
        $fdept = $faculty->ddept;
        try {
            // Now fetch the main data
            $stmt = $db->prepare("SELECT * FROM fcolreq WHERE dept = ? AND status = ? AND manager = ?");
            $status = 0;
            $manager = "HOD";
            $stmt->bind_param("sis", $fdept, $status, $manager);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = [];
            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }
            $stmt->close();

            if (count($userData) > 0) {
                $response = [
                    'status' => 200,
                    'message' => 'Data Fetching successful',
                    'data' => $userData
                ];
            } else {
                error_log("Data fetching failed");
                $response = [
                    'status' => 401,
                    'message' => 'Data Fetching failed'
                ];
            }

        } catch (Exception $e) {
            error_log("Error occurred during fetch: " . $e->getMessage());
            $response = [
                'status' => 500,
                'message' => 'Internal server error'
            ];
        } finally {
            $db->close();
        }
        echo json_encode($response);
        break;

    case 'approve_COL':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fcolreq SET status = 1 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Forwarded successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'reject_COL':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fcolreq SET status = 3 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Rejected successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'get_ODR_details':

        $uid = $s;
        $faculty = getFacultyInfo($uid);
        $fdept = $faculty->ddept;
        try {
            // Now fetch the main data
            $stmt = $db->prepare("SELECT * FROM fondutyreq WHERE dept = ? AND status = ? AND manager = ?");
            $status = 0;
            $manager = "HOD";
            $stmt->bind_param("sis", $fdept, $status, $manager);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = [];
            while ($row = $result->fetch_assoc()) {
                $userData[] = $row;
            }
            $stmt->close();

            if (count($userData) > 0) {
                $response = [
                    'status' => 200,
                    'message' => 'Data Fetching successful',
                    'data' => $userData
                ];
            } else {
                error_log("Data fetching failed");
                $response = [
                    'status' => 401,
                    'message' => 'Data Fetching failed'
                ];
            }

        } catch (Exception $e) {
            error_log("Error occurred during fetch: " . $e->getMessage());
            $response = [
                'status' => 500,
                'message' => 'Internal server error'
            ];
        } finally {
            $db->close();
        }
        echo json_encode($response);
        break;

    case 'approve_ODR':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fondutyreq SET status = 1 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Forwarded successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'reject_ODR':
        $leaveid = mysqli_real_escape_string($db, $_POST['id']);
        $uid = mysqli_real_escape_string($db, $_POST['uid']);
        try {
            // Start transaction
            $db->begin_transaction();

            // Update fleave table
            $stmt = $db->prepare("UPDATE fondutyreq SET status = 3 WHERE id = ?");
            $stmt->bind_param("i", $leaveid);
            $result = $stmt->execute();

            if ($result) {
                // Commit transaction
                $db->commit();
                $stmt->close();
                $db->close();

                $response = ["status" => 200, "message" => "Rejected successfully"];
            } else {
                // Rollback transaction
                $db->rollback();
                $stmt->close();
                $db->close();

                $response = ["status" => 401, "message" => "failed"];
            }
        } catch (Exception $e) {
            // Rollback transaction
            $db->rollback();
            error_log("Error occurred during approval: " . $e->getMessage());
            $response = array("status" => 500, "message" => "Internal server error");
        }

        echo json_encode($response);
        break;

    case 'get_areport_details':
        $month = $_POST['month'] ?? '';
        $year = $_POST['year'] ?? '';

        $uname = $s; // Assuming this function exists
        if (!$uname) {
            return ["status" => 401, "message" => "Unauthorized"];
        }

        $tableName = "devicelogs_{$month}_{$year}";

        // Assuming this function exists and returns object with ddept property
        $faculty = getFacultyInfo($uname);
        $ddept = $faculty->ddept;

        // Create connection
        //$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($erp_conn->connect_error) {
            return ["status" => 500, "message" => "Database connection failed"];
        }

        try {
            $sql = "
                SELECT d.uid, d.fname, d.tdate, d.in_time, d.out_time, d.status, 
                       d.hday, d.lc, d.mp, d.mpu
                FROM " . $tableName . " d
                JOIN mic.faculty f ON d.uid = f.id
                WHERE f.ddept = ? AND f.manager = 'HOD'
                ORDER BY d.uid ASC, d.tdate ASC
            ";

            $stmt = $erp_conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $erp_conn->error);
            }

            $stmt->bind_param("s", $ddept);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $employeeAttendance = [];

                while ($log = $result->fetch_assoc()) {
                    $uid = $log['uid'];
                    $tdate = new DateTime($log['tdate']);
                    $day = (int) $tdate->format('d');

                    $status = getStatusAbbreviation(
                        $log['status'],
                        $log['hday'],
                        $log['lc'],
                        $log['mpu'],
                        $log['mp'],
                        $tdate,
                        $log['in_time'],
                        $log['out_time']
                    );

                    $employeeFound = false;
                    foreach ($employeeAttendance as &$employee) {
                        if ($employee['uid'] === $uid) {
                            $employee['attendance'][$day - 1] = [
                                'status' => $status,
                                'in_time' => $log['in_time'],
                                'out_time' => $log['out_time']
                            ];
                            $employeeFound = true;
                            break;
                        }
                    }

                    if (!$employeeFound) {
                        $newEmployee = [
                            'uid' => $uid,
                            'name' => $log['fname'],
                            'attendance' => array_fill(0, 31, [
                                'status' => '-',
                                'in_time' => null,
                                'out_time' => null
                            ])
                        ];
                        $newEmployee['attendance'][$day - 1] = [
                            'status' => $status,
                            'in_time' => $log['in_time'],
                            'out_time' => $log['out_time']
                        ];
                        $employeeAttendance[] = $newEmployee;
                    }
                }

                $response = [
                    "status" => 200,
                    "message" => "Data Fetching successful",
                    "data" => $employeeAttendance
                ];
            } else {
                $response = ["status" => 404, "message" => "No data found"];
            }
        } catch (Exception $e) {
            error_log('Error fetching attendance data: ' . $e->getMessage());
            $response = ["status" => 500, "message" => "Internal server error"];
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $erp_conn->close();
        }
        echo json_encode($response);
        break;

    case 'get_sreport_details':
        $month = $_POST['month'] ?? '';
        $year = $_POST['year'] ?? '';

        $uname = $s; // Assuming this function exists
        if (!$uname) {
            $response = ["status" => 401, "message" => "Unauthorized"];
        }

        try {
            // Get faculty department
            $stmt = $db->prepare("SELECT ddept FROM faculty WHERE id = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $result = $stmt->get_result();
            $faculty = $result->fetch_assoc();
            $ddept = $faculty['ddept'];
            $stmt->close();

            // Get distinct UIDs
            $stmt = $db->prepare("SELECT id FROM faculty WHERE ddept = ? AND status = 1 AND manager = 'HOD'");
            $stmt->bind_param("s", $ddept);
            $stmt->execute();
            $result = $stmt->get_result();
            $distinctUids = array();
            while ($row = $result->fetch_assoc()) {
                $distinctUids[] = $row['id'];
            }
            $stmt->close();

            $tableNameDeviceLog = "devicelogs_{$month}_{$year}";
            $reports = array();
            $currentDate = date('Y-m-d');

            foreach ($distinctUids as $uid) {
                // Get working days data
                $stmt = $erp_conn->prepare("SELECT * FROM {$tableNameDeviceLog} WHERE uid = ? AND hday = 0");
                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $deviceLogData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                // Get holiday data
                $stmt = $erp_conn->prepare("SELECT * FROM {$tableNameDeviceLog} WHERE uid = ? AND hday = 1");
                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $holidayData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                // Get faculty info
                $stmt = $db->prepare("SELECT name, role FROM faculty WHERE id = ?");
                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $facultyInfo = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                // Get LOP data
                $stmt = $erp_conn->prepare("
                    SELECT lc, lc2, status, COUNT(*) as count 
                    FROM {$tableNameDeviceLog} 
                    WHERE uid = ? 
                    AND status IN (0, 2) 
                    AND hday = 0 
                    AND lc NOT IN (1)
                    AND lc2 NOT IN (0.5)
                    AND mpu = 0
                    AND tdate <= ?
                    GROUP BY lc, status
                ");
                $stmt->bind_param("ss", $uid, $currentDate);
                $stmt->execute();
                $lopData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                // Calculate total LOP
                $totalLOP = 0;
                foreach ($lopData as $record) {
                    if ($record['status'] == 0 && ($record['lc'] == 0 || $record['lc'] == 7 || $record['lc'] == 8 || $record['lc'] == 7.5 || $record['lc'] == 8.5 )) {
                        $totalLOP += $record['count'];
                    } else if ($record['status'] == 2 || ($record['status'] == 0 && ($record['lc'] == 0 || $record['lc'] == 0.5 ))) {
                        $totalLOP += $record['count'] * 0.5;
                    }
                }

                // Get presence data
                $stmt = $erp_conn->prepare("
                SELECT lc, lc2, status, mpu, COUNT(*) as count 
                FROM {$tableNameDeviceLog} 
                WHERE uid = ? 
                AND (status = 1 OR status = 2 OR lc IN(1, 0.5) OR lc2 IN(0.5) OR mpu > 0)
                GROUP BY status, lc, mpu");

                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $presentData = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();

                // Calculate total presence
                $totalPresence = 0;
                foreach ($presentData as $record) {
                    if ($record['status'] == 1 || $record['lc'] == 1 || $record['lc2'] == 0.5 || $record['mpu'] > 0) {
                        $totalPresence += $record['count'];
                    } else if ($record['status'] == 2 || $record['lc'] == 0.5) {
                        $totalPresence += $record['count'] * 0.5;
                    }
                }

                // Calculate final metrics
                $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $totalWorkingDays = count($deviceLogData);
                $totalHolidays = count($holidayData);
                $totalPresentdays = $totalPresence;
                $totalLopdays = $totalLOP;
                $salaryDay = $totalWorkingDays + $totalHolidays - $totalLopdays;

                // Create report object
                $report = array(
                    'uid' => $uid,
                    'facultyName' => $facultyInfo['name'],
                    'facultyRole' => $facultyInfo['role'],
                    'totalDays' => $totalDays,
                    'totalWorkingDays' => $totalWorkingDays,
                    'totalHolidays' => $totalHolidays,
                    'totalPresentdays' => $totalPresentdays,
                    'totalLopdays' => $totalLopdays,
                    'salaryDay' => $salaryDay
                );

                $reports[] = $report;
            }

            $response = array('status' => 200, 'message' => 'Data Fetching successful', 'data' => $reports);

        } catch (Exception $e) {
            error_log("Error generating report: " . $e->getMessage());
            $response = array('status' => 500, 'message' => 'Failed to generate report');
        } finally {
            $db->close();
        }

        echo json_encode($response);
        break;


    case 'get_lreport_details':
        $uname = $s;
    if (!$uname) {
        return ["status" => 401, "message" => "Unauthorized"];
    }

    $month = $_POST['month'] ?? '';
    $year = $_POST['year'] ?? '';
    $lt =  $_POST['ltype'] ?? '';

    // Get faculty info
    $faculty = getFacultyInfo($uname);
    $ddept = $faculty->ddept;
    $manager = $faculty->manager;

    // Calculate dates
    $startDateString = "01-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" . $year;
    $endDate = date("t-m-Y", strtotime($year . "-" . $month . "-01"));
    $endDateString = str_replace("/", "-", $endDate);

    try {
        $userData = [];
        $query = "";
        
        switch($lt) {
            case "CL":
                $query = "SELECT * FROM fleave 
                         WHERE STR_TO_DATE(fdate, '%d-%m-%Y') >= STR_TO_DATE(?, '%d-%m-%Y')
                         AND STR_TO_DATE(tdate, '%d-%m-%Y') <= STR_TO_DATE(?, '%d-%m-%Y')
                         AND dept = ? AND manager = 'HOD'
                         ORDER BY id DESC";
                break;
                
            case "OD":
                $query = "SELECT * FROM fonduty 
                         WHERE STR_TO_DATE(fdate, '%d-%m-%Y') >= STR_TO_DATE(?, '%d-%m-%Y')
                         AND STR_TO_DATE(tdate, '%d-%m-%Y') <= STR_TO_DATE(?, '%d-%m-%Y')
                         AND dept = ? AND manager = 'HOD'
                         ORDER BY id DESC";
                break;
                
            case "Permission":
                $query = "SELECT * FROM fpermission 
                         WHERE STR_TO_DATE(fdate, '%d-%m-%Y') >= STR_TO_DATE(?, '%d-%m-%Y')
                         AND dept = ? AND manager = 'HOD'
                         ORDER BY id DESC";
                break;
                
            case "COL Request":
                $query = "SELECT * FROM fcolreq 
                         WHERE STR_TO_DATE(fdate, '%d-%m-%Y') >= STR_TO_DATE(?, '%d-%m-%Y')
                         AND dept = ? AND manager = 'HOD'
                         ORDER BY id DESC";
                break;
        }

        $stmt = mysqli_prepare($db, $query);
        
        if ($lt == "Permission" || $lt == "COL Request") {
            mysqli_stmt_bind_param($stmt, "ss", $startDateString, $ddept);
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $startDateString, $endDateString, $ddept);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $row['lt'] = $lt;  // Add leave type to each row
            $userData[] = $row;
        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($db);

        if (count($userData) > 0) {
            $response = ["status" => 200, "data" => ["data" => $userData]];
        } else {
            error_log("No data found for the selected month and year");
            $response = ["status" => 200, "data" => ["data" => []]];
        }

    } catch (Exception $e) {
        error_log("Error occurred during fetching data: " . $e->getMessage());
        $response = ["status" => 500, "message" => "Internal server error"];
    }

        echo json_encode($response);
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


function updateAttendanceRecords($sid, $fdate, $tdate, $fshift, $tshift, $leave, $isDeleting = false)
{
    global $erp_conn;
    try {
        // Convert dates
        $fromDate = new DateTime($fdate);
        $toDate = new DateTime($tdate);
        // Generate date range
        $dateRange = new DatePeriod(
            $fromDate,
            new DateInterval('P1D'),
            $toDate->modify('+1 day')
        );
       
        // Process each date
        foreach ($dateRange as $date) {
            $formattedDate = $date->format('Y-m-d');
           
            // Determine lc value
            if ($isDeleting) {
                $lcValue = 0;
                $lc2Value = null;
            } else {
                $lcValue = 8; // Default full day
                $lc2Value = null;
                if ($date->format('Y-m-d') === $fromDate->format('Y-m-d') && $fshift == 0.5) {
                    $lcValue = 8.5;
                } else if ($date->format('Y-m-d') === $toDate->format('Y-m-d') && $tshift == 0.5) {
                    $lcValue = 8.5;
                }
            }

            // Get year and month for table name
            $year = $date->format('Y');
            $month = $date->format('m');
            $leaveType = $isDeleting ? null : $leave;
            $tableName = "devicelogs_" . intval($month) . "_" . $year;

            // Check existing record for both lc and lc2
            $checkStmt = $erp_conn->prepare("SELECT lc, lc2 FROM `" . $tableName . "` WHERE uid = ? AND tdate = ?");
            $checkStmt->bind_param("ss", $sid, $formattedDate);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            $row = $result->fetch_assoc();
            $checkStmt->close();

            if ($row) {
                $existingLc = floatval($row['lc']);
                $existingLc2 = is_null($row['lc2']) ? 0 : floatval($row['lc2']);

                // Decision logic based on existing values
                if (($existingLc == 8.5 || $existingLc == 0.5) && ($existingLc2 == 7.5 || $existingLc2 == 0 )) {
                    // Case: lc is 8.5 and lc2 is 7.5 - update lc2 and ltype2
                    $updateStmt = $erp_conn->prepare("UPDATE `" . $tableName . "` SET lc2 = ?, ltype2 = ? WHERE uid = ? AND tdate = ?");
                    $updateStmt->bind_param("dsis", $lcValue, $leaveType, $sid, $formattedDate);
                } else if (($existingLc == 7.5 && $existingLc2 == 0) || 
                          ($existingLc == 7.5 && $existingLc2 == 7.5)) {
                    // Case: lc is 7.5 and (lc2 is 0 or 7.5) - update lc and ltype
                    $updateStmt = $erp_conn->prepare("UPDATE `" . $tableName . "` SET lc = ?, ltype = ? WHERE uid = ? AND tdate = ?");
                    $updateStmt->bind_param("dsis", $lcValue, $leaveType, $sid, $formattedDate);
                } else {
                    // Default case - update lc and ltype
                    $updateStmt = $erp_conn->prepare("UPDATE `" . $tableName . "` SET lc = ?, ltype = ? WHERE uid = ? AND tdate = ?");
                    $updateStmt->bind_param("dsis", $lcValue, $leaveType, $sid, $formattedDate);
                }
            } else {
                // No existing record - insert with lc and ltype
                $updateStmt = $erp_conn->prepare("INSERT INTO `" . $tableName . "` (uid, tdate, lc, ltype) VALUES (?, ?, ?, ?)");
                $updateStmt->bind_param("ssds", $sid, $formattedDate, $lcValue, $leaveType);
            }

            $updateStmt->execute();
            $updateStmt->close();
            error_log("Data updated in target database for " . $formattedDate);
        }
    } catch (Exception $e) {
        error_log("Error updating attendance records: " . $e->getMessage());
        throw $e;
    } finally {
        $erp_conn->close();
    }
}



function updatePermissionRecords($uid, $fdate, $leave, $isDeleting = false)
{
    global $erp_conn;
    error_log($fdate);

    list($year, $month, $day) = explode('-', $fdate);
    $fromDate = new DateTime($fdate);
    $formattedDate = $fromDate->format('Y-m-d');
    $tableName = "devicelogs_" . intval($month) . "_" . $day;
    error_log($tableName);

    $leaveTypes = [
        'Morning' => 'mp',
        'Evening' => 'ep',
        '10minM' => 'tmp',
        '10minE' => 'tep'
    ];

    $lt = isset($leaveTypes[$leave]) ? $leaveTypes[$leave] : '';
    $lcValue = $isDeleting ? 0 : 8;

    try {
        // Using prepared statement for the dynamic table name
        $stmt = $erp_conn->prepare("UPDATE `$tableName` SET `$lt` = ?, ltype = ? WHERE uid = ? AND tdate = ?");
        $ltype = $isDeleting ? null : $leave;
        $stmt->bind_param("isss", $lcValue, $ltype, $uid, $formattedDate);
        $stmt->execute();
        $stmt->close();

        error_log("Data updated in target database for " . $fdate);
    } catch (Exception $error) {
        error_log("Error updating attendance records: " . $error->getMessage());
        throw $error;
    }
}

function getStatusAbbreviation($status, $hday, $lc, $mpu, $mp, $tdate, $in_time, $out_time)
{
    $today = new DateTime();

    if ($mpu === 1) {
        return 'MP';
    }

    if ($tdate > $today) {
        return '-'; // Future date
    }

    if ($hday === 1) {
        return 'H';
    }

    if ($lc === 1) {
        return 'L';
    }

    // Check for absent first
    if ($in_time === null && $out_time === null) {
        return 'AB';
    }

    switch ($status) {
        case 1:
            return 'P';
        case 0:
        case 2:
            return 'S';
        default:
            return '-';
    }
}



?>