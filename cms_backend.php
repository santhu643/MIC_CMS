<?php
require 'config.php';
include("session.php");



// Define the counter file path
$counterFilePath = './uploads/counter.txt';

// Function to get the next file number
function getNextFileNumber($counterFilePath)
{
    if (file_exists($counterFilePath)) {
        $file = fopen($counterFilePath, 'r');
        $lastNumber = (int)fgets($file);
        fclose($file);
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }
    $file = fopen($counterFilePath, 'w');
    fwrite($file, $nextNumber);
    fclose($file);
    return $nextNumber;
}


$action = $_GET['action'] ?? '';

switch ($action) {

        //Common for all files
        //viewing complaint description in modal
    case 'view_complaint':
        $complain_id = $_POST['user_id'];
        $fac_id = $_POST['fac_id'];

        // First query
        $query = "
        SELECT cd.*, faculty_details.faculty_name, faculty_details.faculty_contact, 
               faculty_details.faculty_mail, faculty_details.department, cd.block_venue
        FROM complaints_detail cd
        JOIN faculty_details ON cd.faculty_id = faculty_details.faculty_id
        WHERE cd.id = ?
    ";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $complain_id);
        mysqli_stmt_execute($stmt);
        $User_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);

        // Second query
        $query1 = "SELECT * FROM faculty WHERE id = ?";
        $stmt1 = mysqli_prepare($db, $query1);
        mysqli_stmt_bind_param($stmt1, "s", $fac_id);
        mysqli_stmt_execute($stmt1);
        $fac_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt1));
        mysqli_stmt_close($stmt1);

        // Response
        if ($User_data || $fac_data) {
            echo json_encode([
                'status' => 200,
                'message' => 'Details fetched successfully by ID',
                'data' => $User_data,
                'data1' => $fac_data
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'Details not found'
            ]);
        }
        break;
        //before image
    case 'get_image':
        $problem_id = isset($_POST['problem_id']) ? $_POST['problem_id'] : ''; // Ensure problem_id is set
        // Validate problem_id
        if (empty($problem_id)) {
            echo json_encode(['status' => 400, 'message' => 'Problem ID not provided']);
            exit;
        }
        // Query to fetch the image based on problem_id
        $query = "SELECT images FROM complaints_detail WHERE id = ?";
        $stmt = $db->prepare($query);
        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }
        $stmt->bind_param('i', $problem_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = json_encode(['status' => 200, 'data' => ['images' => $row['images']]]);
            // Log response to debug if the JSON is correctly formed
            error_log("Response: " . $response);
            echo $response;
        } else {
            // Return 404 if no image is found for the given problem_id
            echo json_encode(['status' => 404, 'message' => 'Image not found']);
        }
        $stmt->close();
        $db->close();
        exit;
        break;

        //After Image
    case 'get_aimage':
        $problem_id = isset($_POST['problem2_id']) ? $_POST['problem2_id'] : '';

        // Validate problem_id
        if (empty($problem_id)) {
            echo json_encode(['status' => 400, 'message' => 'Problem ID not provided']);
            exit;
        }

        // Log the received problem_id for debugging
        error_log("Problem ID received: " . $problem_id);

        // First, fetch the task_id from the manager table using the problem_id
        $query = "SELECT task_id FROM manager WHERE problem_id = ?";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }

        $stmt->bind_param('i', $problem_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $task_id = $row['task_id'];

            // Log the fetched task_id for debugging
            error_log("Task ID fetched: " . $task_id);

            $stmt->close();

            // Now, fetch the after_photo using the retrieved task_id
            $query = "SELECT after_photo FROM worker_taskdet WHERE task_id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
                exit;
            }

            $stmt->bind_param('i', $task_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $image_filename = basename($row['after_photo']); // Get the filename
                $image_path = 'imgafter/' . $image_filename; // Path to the image

                echo json_encode(['status' => 200, 'data' => ['after_photo' => $image_path]]);
            } else {
                echo json_encode(['status' => 404, 'message' => 'No image found for the provided task ID']);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 404, 'message' => 'No task found for the provided problem ID']);
        }
        break;

        //worker Phone number
    case 'get_worker_phone':
        $complain_id = mysqli_real_escape_string($db, $_POST['prblm_id']);
        $query = "
        SELECT w.* 
        FROM complaints_detail cd
        INNER JOIN manager m ON cd.id = m.problem_id
        INNER JOIN worker_details w ON m.worker_id = w.worker_id
        WHERE cd.id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $complain_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $User_data = $result->fetch_assoc();
        if ($User_data) {
            echo json_encode(['status' => 200, 'message' => 'Details fetched successfully.', 'data' => $User_data]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Details not found.']);
        }
        break;


        //Manager Backend
        //accapt complaint
    case 'manager_approve':
        $problem_id = $_POST['problem_id'];
        $worker = $_POST['worker_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];

        $nowdate = date('Y-m-d');

        // Insert into manager table
        $insertQuery = "INSERT INTO manager (problem_id, worker_dept, priority) VALUES (?, ?, ?)";
        $stmt = $db->prepare($insertQuery);
        $stmt->bind_param('sss', $problem_id, $worker, $priority);
        if ($stmt->execute()) {
            // Update status in complaints_detail table
            $updateQuery = "UPDATE complaints_detail SET days_to_complete = ?,manager_approve = ?,status = '9' WHERE id = ?";
            $stmtUpdate = $db->prepare($updateQuery);
            $stmtUpdate->bind_param('ssi', $deadline, $nowdate, $problem_id);
            if ($stmtUpdate->execute()) {
                $response = ['status' => 200, 'message' => 'Complaint accepted and status updated successfully!'];
            } else {
                $response = ['status' => 500, 'message' => 'Failed to update complaint status.'];
            }
            $stmtUpdate->close();
        } else {
            $response = ['status' => 500, 'message' => 'Failed to insert data into manager table.'];
        }
        $stmt->close();
        echo json_encode($response);
        break;

        //when manager assign the complaint to wrong department -> Reassign department
    case 'reassign_complaint':
        try {
            $id = $_POST['user_id'];
            $worker_dept = $_POST['worker'];

            $query = "UPDATE manager SET worker_dept = ? WHERE problem_id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param('si', $worker_dept, $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 200]);
            } else {
                throw new Exception('Query Failed: ' . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

        //Reject Complaint
    case 'reject_complaint':
        try {
            $id = $_POST['id'];
            $reason = $_POST['feedback'];

            $query = "UPDATE complaints_detail SET feedback = ?, status = '20' WHERE id = ?";
            $stmt = mysqli_prepare($db, $query);
            mysqli_stmt_bind_param($stmt, "ss", $reason, $id);
            $query_obj = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($query_obj) {
                echo json_encode(['status' => 200]);
            } else {
                throw new Exception('Failed to execute query');
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
        break;

        //to get approval from principal
    case 'principal_complaint':
        $problem_id = $_POST['id'];
        $reason = $_POST['reason'];

        // Prepare the SQL query
        $updateQuery = "UPDATE complaints_detail SET p_reason = ?, status = '6' WHERE id = ?";
        $stmtUpdate = $db->prepare($updateQuery);
        if (!$stmtUpdate) {
            echo json_encode(['status' => 500, 'message' => 'Failed to prepare statement.']);
            break;
        }

        // Bind parameters
        $stmtUpdate->bind_param('si', $reason, $problem_id);

        // Execute the query
        if ($stmtUpdate->execute()) {
            echo json_encode(['status' => 200, 'message' => 'Complaint accepted and status updated.']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Failed to update complaint status.']);
        }

        // Close the prepared statement
        $stmtUpdate->close();
        break;


        //get rejected reason from principal
    case 'get_reject_reason':
        $complain_id = mysqli_real_escape_string($db, $_POST['problem_id']);
        $query = "SELECT feedback FROM complaints_detail WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $complain_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $User_data = $result->fetch_assoc();
        if ($User_data) {
            echo json_encode(['status' => 200, 'message' => 'Details fetched successfully.', 'data' => $User_data]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Details not found.']);
        }
        break;


        //add new workers
    case 'addworker':
        $name = $_POST['w_name'];
        $contact = $_POST['w_phone'];
        $dept = $_POST['w_dept'];
        $role = $_POST['w_role'];

        if($role == "worker"){

        $dept_prefix = strtoupper(substr($dept, 0, 3));

        $checkQuery = "SELECT SUBSTRING(worker_id, 4) AS id_number 
                   FROM worker_details 
                   WHERE worker_id LIKE CONCAT(?, '%') 
                   ORDER BY CAST(SUBSTRING(worker_id, 4) AS UNSIGNED) DESC LIMIT 1";
        $stmt = $db->prepare($checkQuery);
        $stmt->bind_param('s', $dept_prefix);
        $stmt->execute();
        $result = $stmt->get_result();

        $number = ($row = $result->fetch_assoc()) ? intval($row['id_number']) + 1 : 1;
        $worker_id = $dept_prefix . str_pad($number, 2, '0', STR_PAD_LEFT);

    }

    elseif($role == "head"){
        $worker_id = $dept;
    }

        $insertQuery = "INSERT INTO worker_details (worker_id, worker_first_name, worker_dept, worker_mobile,usertype) 
                    VALUES (?, ?, ?, ?,?)";
        $stmtInsert = $db->prepare($insertQuery);
        $stmtInsert->bind_param('sssss', $worker_id, $name, $dept, $contact,$role);
        if ($stmtInsert->execute()) {
            echo json_encode(['status' => 200, 'message' => "Worker added with ID $worker_id!"]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Error: Could not insert worker details.']);
        }
        break;

        //add new user for raise complaints
    case 'add_user':
        try {
            $id = $_POST["userid"];
            $dept = $_POST["u_dept"];
            $role = $_POST["u_role"];

            $name = $phone = $email = '';

            if ($role == "infra") {
                $selectquery = "SELECT fname, mobile, email FROM basic WHERE id = ?";
                $stmt = $db->prepare($selectquery);
                $stmt->bind_param('s', $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $selectval = $result->fetch_assoc();
                    $name = $selectval["fname"];
                    $phone = $selectval["mobile"];
                    $email = $selectval["email"];
                } else {
                    throw new Exception("No data found for the provided ID in 'basic' table.");
                }
            } else if ($role == "student") {
                $selectquery1 = "SELECT fname, mobile, email FROM sbasic WHERE sid = ?";
                $stmt = $db->prepare($selectquery1);
                $stmt->bind_param('s', $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $selectval1 = $result->fetch_assoc();
                    $name = $selectval1["fname"];
                    $phone = $selectval1["mobile"];
                    $email = $selectval1["email"];
                } else {
                    throw new Exception("No data found for the provided ID in 'sbasic' table.");
                }
            }

            $query = "INSERT INTO faculty_details (faculty_id, faculty_name, department, faculty_contact, faculty_mail, role)
                          VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssssss', $id, $name, $dept, $phone, $email, $role);

            if ($stmt->execute()) {
                echo json_encode(['status' => 200, 'msg' => 'Successfully stored']);
            } else {
                throw new Exception('Query Failed: ' . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

        //delete workers
    case 'delete_worker':
        $id = $_POST['id'];

        $query = "DELETE FROM worker_details WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $id);
        $query_obj = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo json_encode([
            'status' => $query_obj ? 200 : 500
        ]);
        break;

        //delete users
    case 'delete_user':
        $id = $_POST['id'];

        $query = "DELETE FROM faculty_details WHERE id = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $id);
        $query_obj = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo json_encode([
            'status' => $query_obj ? 200 : 500
        ]);
        break;

        //Answer for Principal Query
    case 'submit_comment_reply':
        $task_id = $_POST['task_id'];
        $comment_reply = $_POST['comment_reply'];
        $reply_date = date('Y-m-d');

        // Update the comment_reply and reply_date fields for the corresponding task_id
        $query = "UPDATE manager SET comment_reply = ?, reply_date = ? WHERE task_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssi', $comment_reply, $reply_date, $task_id);
        if ($stmt->execute()) {
            $response = ['status' => 200, 'message' => 'Reply submitted successfully!'];
        } else {
            $response = ['status' => 500, 'message' => 'Failed to submit reply.'];
        }
        $stmt->close();
        echo json_encode($response);
        break;

        //Extend Deadline for work inprogress
    case 'extend_deadlinedate':
        try {
            $id = $_POST['id'];
            $dead_date = $_POST['extend_deadline'];
            $reason = $_POST['reason'];

            $query = "UPDATE complaints_detail SET days_to_complete = ?, extend_date = '1', extend_reason = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssi', $dead_date, $reason, $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 200]);
            } else {
                throw new Exception('Query Failed: ' . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

        //to view feedback from faculty
    case 'facfeedview':
        $student_id = mysqli_real_escape_string($db, $_POST['user_id']);
        $query = "SELECT * FROM complaints_detail WHERE id = ? AND status IN ('13', '14')";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $User_data = $result->fetch_assoc();
        if ($User_data) {
            echo json_encode(['status' => 200, 'message' => 'Details fetched successfully.', 'data' => $User_data]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Details not found.']);
        }
        break;

        //partially completed
    case 'partially_reason':
        $id = $_POST['id'];
        // First query
        $query = "SELECT * FROM complaints_detail WHERE id = ? ";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $User_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);

        // Response
        if ($User_data) {
            echo json_encode([
                'status' => 200,
                'message' => 'Details fetched successfully by ID',
                'data' => $User_data,
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'Details not found'
            ]);
        }
        break;


        //Reassign Work after faculty feedback
    case 'reassign_work':
        $id = $_POST['complaintfeed_id'];
        $status = $_POST['status'];
        $current_date = date('Y-m-d');
        $reassign_deadline = $_POST['reassign_deadline'] ?? null;

        if ($status == 15 && $reassign_deadline) {
            // Status '15' for reassign with deadline
            $sql = "UPDATE complaints_detail SET status = ?, reassign_date = ?, days_to_complete = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('issi', $status, $current_date, $reassign_deadline, $id);
        } else {
            // Other statuses without deadline
            $sql = "UPDATE complaints_detail SET status = ?, reassign_date = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param('isi', $status, $current_date, $id);
        }

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 200,
                'message' => "Status and updates saved successfully."
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => "Error updating status: " . $stmt->error
            ]);
        }
        $stmt->close();
        break;

        //Manager feedback for complited work
    case 'manager_feedbacks':
        try {
            $id = $_POST['id'];
            $feedback = $_POST['feedback12'];
            $rating = $_POST['ratings'];

            $query = "UPDATE complaints_detail SET mfeedback = ?, mrating = ?, status = '16' WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssi', $feedback, $rating, $id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 200]);
            } else {
                throw new Exception('Query Failed: ' . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

        //get workers record
    case 'dateapply':
        try {
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];

            $sql19 = "SELECT worker_details.worker_id, worker_details.worker_first_name, worker_details.worker_dept, 
                            COUNT(complaints_detail.id) AS total_completed_works,
                            AVG(complaints_detail.rating) AS avg_faculty_rating, 
                            AVG(complaints_detail.mrating) AS avg_manager_rating 
                          FROM worker_details 
                          INNER JOIN complaints_detail 
                          ON worker_details.worker_id = complaints_detail.worker_id 
                          WHERE worker_details.usertype = 'worker' 
                          AND complaints_detail.status = '16'
                          AND complaints_detail.date_of_completion BETWEEN ? AND ?
                          GROUP BY worker_details.worker_id";

            $stmt = $db->prepare($sql19);
            $stmt->bind_param('ss', $from_date, $to_date);
            $stmt->execute();
            $result = $stmt->get_result();

            $data = [];
            while ($row = $result->fetch_assoc()) {
                $row['avg_faculty_rating'] = $row['avg_faculty_rating'] ? round($row['avg_faculty_rating'], 2) : 'N/A';
                $row['avg_manager_rating'] = $row['avg_manager_rating'] ? round($row['avg_manager_rating'], 2) : 'N/A';
                $row['avg_rating'] = ($row['avg_faculty_rating'] != 'N/A' && $row['avg_manager_rating'] != 'N/A')
                    ? round(($row['avg_faculty_rating'] + $row['avg_manager_rating']) / 2, 2)
                    : 'N/A';
                $data[] = $row;
            }

            echo json_encode(['status' => 200, 'data' => $data]);
            exit;
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

    case 'workrecord':
        try {
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];

            $sql8 = "SELECT * FROM complaints_detail 
             WHERE status = '16' 
             AND date_of_completion BETWEEN '$from_date' AND '$to_date'";
            $result8 = mysqli_query($db, $sql8);

            $data = [];
            while ($row = mysqli_fetch_assoc($result8)) {
                $pid = $row['id'];

                // Fetch worker details for completed work
                $manager_query = "SELECT * FROM manager WHERE problem_id = $pid";
                $manager_result = mysqli_query($db, $manager_query);
                $manager_data = mysqli_fetch_assoc($manager_result);

                $worker_query = "SELECT * FROM worker_details WHERE worker_id = '{$manager_data['worker_id']}'";
                $worker_result = mysqli_query($db, $worker_query);
                $worker_data = mysqli_fetch_assoc($worker_result);

                $row['completed_by'] = $worker_data['worker_first_name'] ?? 'N/A';
                $row['department'] = $worker_data['worker_dept'] ?? 'N/A';

                $row['average_rating'] = ($row['rating'] && $row['mrating'])
                    ? round(($row['rating'] + $row['mrating']) / 2, 2)
                    : 'N/A';

                $data[] = $row;
            }

            echo json_encode(['status' => 200, 'data' => $data]);
            exit;
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;





        //HOD backend
        //hod accept
    case 'approvebtn':
        try {
            $id = $_POST['approve'];

            // Prepare the SQL statement
            $query = "UPDATE complaints_detail SET status = ? WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement failed: ' . $db->error);
            }

            // Bind parameters (status and id)
            $status = 4;
            $stmt->bind_param('ii', $status, $id);

            // Execute the statement
            if ($stmt->execute()) {
                $res = [
                    'status' => 200,
                    'message' => 'Details Updated Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Execution failed: ' . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        }
        break;

        //HOD reject
    case 'rejectbtn':
        try {
            $id = $_POST['reject_id'];
            $feedback = $_POST['rejfeed'];

            // Prepare the SQL statement
            $query = "UPDATE complaints_detail SET feedback = ?, status = ? WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement failed: ' . $db->error);
            }

            // Bind parameters
            $status = 5;
            $stmt->bind_param('sii', $feedback, $status, $id);

            // Execute the statement
            if ($stmt->execute()) {
                $res = [
                    'status' => 200,
                    'message' => 'Details Updated Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Execution failed: ' . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        }
        break;

        //HOD seeproblem description
    case 'seeproblem':
        try {
            $student_id1 = $_POST['user_id'];

            // Prepare the SQL statement
            $query = "SELECT * FROM complaints_detail WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement failed: ' . $db->error);
            }

            // Bind the parameter
            $stmt->bind_param('i', $student_id1);

            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();
            $User_data = $result->fetch_assoc();

            if ($User_data) {
                $res = [
                    'status' => 200,
                    'message' => 'Details fetched successfully by ID',
                    'data' => $User_data
                ];
            } else {
                $res = [
                    'status' => 404,
                    'message' => 'No details found for the given ID'
                ];
            }

            echo json_encode($res);
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        } finally {
            if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                $stmt->close();
            }
        }
        break;

        //Raise complaint in HOD
    case 'addcomplaint':
        try {
            $hod = 12345;
            $block_venue = mysqli_real_escape_string($db, $_POST['block_venue']);
            $venue_name = mysqli_real_escape_string($db, $_POST['venue_name']);
            $type_of_problem = mysqli_real_escape_string($db, $_POST['type_of_problem']);
            $problem_description = mysqli_real_escape_string($db, $_POST['problem_description']);
            $date_of_reg = mysqli_real_escape_string($db, $_POST['date_of_reg']);
            $status = 4; // Fixed status value

            // Handle file upload
            $images = "";
            $uploadFileDir = './uploads/';

            // Ensure the upload directory exists
            if (!is_dir($uploadFileDir) && !mkdir($uploadFileDir, 0755, true)) {
                throw new Exception('Failed to create upload directory.');
            }

            if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['images']['tmp_name'];
                $fileNameCmps = explode(".", $_FILES['images']['name']);
                $fileExtension = strtolower(end($fileNameCmps));

                // Validate file extension
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (!in_array($fileExtension, $allowedExtensions)) {
                    throw new Exception('Invalid file extension. Allowed: jpg, jpeg, png.');
                }

                // Generate a unique filename
                $newFileName = uniqid('img_', true) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                // Move the uploaded file
                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    throw new Exception('Error moving the uploaded file.');
                }

                $images = $newFileName;
            }

            // Insert data into the database
            $query = "INSERT INTO complaints_detail (faculty_id, fac_id, block_venue, venue_name, type_of_problem, problem_description, images, date_of_reg, status) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . $db->error);
            }

            // Bind parameters and execute
            $stmt->bind_param('iissssssi', $hod, $hod, $block_venue, $venue_name, $type_of_problem, $problem_description, $images, $date_of_reg, $status);
            if ($stmt->execute()) {
                echo json_encode(['status' => 200, 'message' => 'Success']);
            } else {
                throw new Exception('Error inserting data: ' . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

        //faculty info in hod
    case 'facinfohod':
        try {
            $student_id1 = $_POST['user_id'];
            $fac_id = $_POST['fac_id'];

            // Query 1: Fetch data from faculty table
            $query1 = "SELECT * FROM faculty WHERE id = ?";
            $stmt1 = $db->prepare($query1);

            if (!$stmt1) {
                throw new Exception('Prepare statement for faculty failed: ' . $db->error);
            }

            $stmt1->bind_param('i', $fac_id);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            $fac_data = $result1->fetch_assoc();

            // Query 2: Fetch data by joining complaints_detail and faculty_details tables
            $query = "SELECT cd.*, faculty_details.faculty_name, faculty_details.department, faculty_details.faculty_contact, faculty_details.faculty_mail
                                      FROM complaints_detail cd
                                      JOIN faculty_details ON cd.faculty_id = faculty_details.faculty_id
                                      WHERE cd.id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement for complaints_detail failed: ' . $db->error);
            }

            $stmt->bind_param('i', $student_id1);
            $stmt->execute();
            $result = $stmt->get_result();
            $User_data = $result->fetch_assoc();

            if ($User_data || $fac_data) {
                $res = [
                    'status' => 200,
                    'message' => 'Details fetched successfully by ID',
                    'data' => $User_data,
                    'data1' => $fac_data
                ];
            } else {
                $res = [
                    'status' => 404,
                    'message' => 'No details found for the given IDs'
                ];
            }

            echo json_encode($res);
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        } finally {
            // Close prepared statements
            if (isset($stmt1) && $stmt1 instanceof mysqli_stmt) {
                $stmt1->close();
            }
            if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                $stmt->close();
            }
        }
        break;

        //before image in HOD
    case 'bimgforhod':
        try {
            $task_id = $_POST['task_id'];

            // Validate the task ID
            if (empty($task_id) || !is_numeric($task_id)) {
                echo json_encode(['status' => 400, 'message' => 'Task ID not provided or invalid']);
                exit;
            }

            // Prepare the SQL query
            $query = "SELECT images FROM complaints_detail WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Failed to prepare the statement: ' . $db->error);
            }

            // Bind and execute
            $stmt->bind_param('i', $task_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the image was found
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $image_path = $row['images'];
                $res = [
                    "status" => 200,
                    "message" => "success",
                    "data" => $image_path
                ];
                echo json_encode($res);
            } else {
                echo json_encode(['status' => 404, 'message' => 'No image found']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        } finally {
            // Close the statement if it was successfully created
            if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                $stmt->close();
            }
        }
        break;

        //after image for hod
    case 'aimgforhod':
        $task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : '';

        if ($task_id == 0) {
            echo json_encode(['status' => 400, 'message' => 'Task ID not provided or invalid']);
            exit;
        }

        $query = "SELECT after_photo FROM worker_taskdet WHERE id = ?";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }

        $stmt->bind_param('i', $task_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image_path = 'imgafter/' . $row['after_photo'];

            if (file_exists($image_path)) {
                echo json_encode(['status' => 200, 'data' => ['after_photo' => $image_path]]);
            } else {
                echo json_encode(['status' => 404, 'message' => 'Image file not found on the server']);
            }
        } else {
            echo json_encode(['status' => 404, 'message' => 'No image found']);
        }

        $stmt->close();
        $db->close();
        break;

        //reject feedback for hod
    case 'rejfeedback':
        try {
            $student_id5 = $_POST['user_idrej'];

            // Prepare the query
            $query = "SELECT * FROM complaints_detail WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement failed: ' . $db->error);
            }

            // Bind the parameter
            $stmt->bind_param('i', $student_id5);
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();
            $User_data = $result->fetch_assoc();

            if ($User_data) {
                $res = [
                    'status' => 200,
                    'message' => 'Details fetched successfully by ID',
                    'data2' => $User_data
                ];
            } else {
                $res = [
                    'status' => 404,
                    'message' => 'No details found for the given ID'
                ];
            }

            echo json_encode($res);
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        } finally {
            // Close the prepared statement
            if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                $stmt->close();
            }
        }
        break;




        //EO backend
        //EO raise complaint
    case 'EOaddcomplaint':
        try {
            $eo_id = 123456;
            $block_venue = mysqli_real_escape_string($db, $_POST['block_venue']);
            $venue_name = mysqli_real_escape_string($db, $_POST['venue_name']);
            $type_of_problem = mysqli_real_escape_string($db, $_POST['type_of_problem']);
            $problem_description = mysqli_real_escape_string($db, $_POST['problem_description']);
            $date_of_reg = mysqli_real_escape_string($db, $_POST['date_of_reg']);
            $status = 22; // Fixed status value

            // Handle file upload
            $images = "";
            $uploadFileDir = './uploads/';

            // Ensure the upload directory exists
            if (!is_dir($uploadFileDir) && !mkdir($uploadFileDir, 0755, true)) {
                throw new Exception('Failed to create upload directory.');
            }

            if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['images']['tmp_name'];
                $fileNameCmps = explode(".", $_FILES['images']['name']);
                $fileExtension = strtolower(end($fileNameCmps));

                // Validate file extension
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                if (!in_array($fileExtension, $allowedExtensions)) {
                    throw new Exception('Invalid file extension. Allowed: jpg, jpeg, png.');
                }

                // Generate a unique filename
                $newFileName = uniqid('img_', true) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                // Move the uploaded file
                if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                    throw new Exception('Error moving the uploaded file.');
                }

                $images = $newFileName;
            }

            // Insert data into the database
            $query = "INSERT INTO complaints_detail (faculty_id, fac_id, block_venue, venue_name, type_of_problem, problem_description, images, date_of_reg, status) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . $db->error);
            }

            // Bind parameters and execute
            $stmt->bind_param('iissssssi', $eo_id, $eo_id, $block_venue, $venue_name, $type_of_problem, $problem_description, $images, $date_of_reg, $status);
            if ($stmt->execute()) {
                echo json_encode(['status' => 200, 'message' => 'Success']);
            } else {
                throw new Exception('Error inserting data: ' . $stmt->error);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Error: ' . $e->getMessage()]);
        }
        break;

        //reject task in EO
    case 'rejfeedbackeo':
        try {
            $id = $_POST['reject_id'];
            $feedback = $_POST['rejfeed'];

            // Prepare the SQL statement
            $query = "UPDATE complaints_detail SET feedback = ?, status = ? WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement failed: ' . $db->error);
            }

            // Bind parameters
            $status = 23;
            $stmt->bind_param('sii', $feedback, $status, $id);

            // Execute the statement
            if ($stmt->execute()) {
                $res = [
                    'status' => 200,
                    'message' => 'Details Updated Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Execution failed: ' . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        }
        break;


        //EO accept complaint
    case 'eoaccept':
        try {
            $id = $_POST['approveid'];

            // Prepare the SQL statement
            $query = "UPDATE complaints_detail SET status = ? WHERE id = ?";
            $stmt = $db->prepare($query);

            if (!$stmt) {
                throw new Exception('Prepare statement failed: ' . $db->error);
            }

            // Bind parameters (status and id)
            $status = 22;
            $stmt->bind_param('ii', $status, $id);

            // Execute the statement
            if ($stmt->execute()) {
                $res = [
                    'status' => 200,
                    'message' => 'Details Updated Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Execution failed: ' . $stmt->error);
            }

            // Close the statement
            $stmt->close();
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        }
        break;

        //Principal Backend 
        //Approval
    case 'approve_user':
        $customer_id = $_POST['user_id']; // Assuming the input is already sanitized before this point

        // Begin the transaction
        mysqli_begin_transaction($db);

        try {
            // First query: Update the status in complaints_detail table
            $query = "UPDATE complaints_detail SET status = ? WHERE id = ?";
            $stmt = mysqli_prepare($db, $query);
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . mysqli_error($db));
            }

            // Bind parameters (s for string, i for integer)
            $status = '8';
            mysqli_stmt_bind_param($stmt, 'si', $status, $customer_id);

            // Execute the query
            $query_run = mysqli_stmt_execute($stmt);
            if (!$query_run) {
                throw new Exception('Failed to execute query: ' . mysqli_stmt_error($stmt));
            }

            // Commit transaction if succeeded
            mysqli_commit($db);
            echo json_encode(['status' => 200]);

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($db);
            $res = [
                'status' => 500,
                'message' => 'Error occurred: ' . $e->getMessage()
            ];
            echo json_encode($res);
        }
        break;

        //Reject complaint
    case 'reject_user':
        try {
            // Sanitize input values
            $reason = $_POST['reason']; // Assuming validation and sanitization before this point
            $customer_id = $_POST['problem_id']; // Assuming validation and sanitization before this point

            // Start the transaction
            mysqli_begin_transaction($db);

            // First query: Update the status in complaints_detail table
            $query = "UPDATE complaints_detail SET feedback = ?, status = ? WHERE id = ?";
            $stmt = mysqli_prepare($db, $query);
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . mysqli_error($db));
            }

            // Bind parameters (s for string, i for integer)
            $status = 19;
            mysqli_stmt_bind_param($stmt, 'sii', $reason, $status, $customer_id);

            // Execute the query
            $query_run = mysqli_stmt_execute($stmt);
            if (!$query_run) {
                throw new Exception('Failed to execute query: ' . mysqli_stmt_error($stmt));
            }

            // Commit transaction if all succeeded
            mysqli_commit($db);
            echo json_encode(['status' => 200]);

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } catch (Exception $e) {
            // Rollback transaction on error
            mysqli_rollback($db);
            $res = [
                'status' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ];
            echo json_encode($res);
        }
        break;

        //principal query
    case 'principal_query':
        $customer_id = $_POST['task_id'];
        $query = $_POST['comment_query'];
        $reply = $_POST['comment_reply'];

        // Prepare the SQL update query
        $stmt = $db->prepare("UPDATE manager SET comment_query = ?, query_date = NOW(), comment_reply = ? WHERE task_id = ?");
        $stmt->bind_param("sss", $query, $reply, $customer_id); // Bind parameters (query, reply, and task_id)

        // Execute the prepared statement
        if ($stmt->execute()) {
            $res = [
                'status' => 200,
                'message' => 'Details updated successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Failed to update details'
            ];
            echo json_encode($res);
            return;
        }
        break;


        //view manager response
    case 'manager_response':
        $customer_id = $_POST['user_id'];

        // Prepare the SQL query
        $stmt = $db->prepare("SELECT * FROM manager WHERE task_id = ?");
        $stmt->bind_param("s", $customer_id); // Bind the customer_id parameter

        // Execute the prepared statement
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $User_data = $result->fetch_assoc();
            $query_date = $User_data['query_date'];
            $current_date = date('Y-m-d');

            // Calculate the difference in days between current date and query date
            $date_diff = (strtotime($current_date) - strtotime($query_date)) / (60 * 60 * 24);

            // Determine if the field should be readonly
            if ($date_diff < 5 && !empty($User_data['comment_query'])) {
                $readonly = true;
            } else {
                $readonly = false; // Make it editable if conditions are met
            }

            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully by ID',
                'data' => $User_data,
                'readonly' => $readonly,
                'date_diff' => $date_diff
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 404,
                'message' => 'No details found for the given ID'
            ];
            echo json_encode($res);
            return;
        }
        break;



        //Worker backend
        //accept complaint by head
    case 'wacceptcomp':
        $problem_id = $_POST['user_id'] ?? null;

        if ($problem_id) {
            // Prepare the SQL query
            $updateQuery = "UPDATE complaints_detail SET status = ? WHERE id = ?";
            $stmt = mysqli_prepare($db, $updateQuery);

            if ($stmt) {
                // Bind parameters to the prepared statement
                $status = 10;
                mysqli_stmt_bind_param($stmt, "ii", $status, $problem_id);

                // Execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    echo "Success: Complaint accepted and status updated successfully!";
                } else {
                    echo "Error: Failed to update complaint status.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: Failed to prepare the update query.";
            }
        } else {
            echo "Error: Problem ID is missing.";
        }
        break;

        //view complaint in head
    case 'whviewcomp':
        $complain_id = $_POST['user_id'];

        // First query
        $query = "
        SELECT cd.*, faculty_details.faculty_name, faculty_details.faculty_contact, 
               faculty_details.faculty_mail, faculty_details.department, cd.block_venue
        FROM complaints_detail cd
        JOIN faculty_details ON cd.faculty_id = faculty_details.faculty_id
        WHERE cd.id = ?
    ";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $complain_id);
        mysqli_stmt_execute($stmt);
        $User_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);



        // Response
        if ($User_data) {
            echo json_encode([
                'status' => 200,
                'message' => 'Details fetched successfully by ID',
                'data' => $User_data,
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'Details not found'
            ]);
        }
        break;

        //bacnkend for workers
        //worker view complaint description
    case 'wviewcomp':
        $task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : null;

        if ($task_id === null) {
            die(json_encode(['error' => 'Task ID not provided']));
        }

        $sql = "SELECT 
        f.faculty_name, 
        f.faculty_contact, 
        cd.block_venue, 
        cd.venue_name, 
        cd.problem_description, 
        cd.days_to_complete
    FROM 
        complaints_detail AS cd
    JOIN 
        faculty_details AS f ON cd.faculty_id = f.faculty_id
    WHERE 
        cd.id = (SELECT problem_id FROM manager WHERE task_id = ?)
";


        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $response = array();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = array(
                'faculty_name' => $row['faculty_name'],
                'faculty_contact' => $row['faculty_contact'],
                'block_venue' => $row['block_venue'],
                'venue_name' => $row['venue_name'],
                'problem_description' => $row['problem_description'],
                'days_to_complete' => $row['days_to_complete']
            );
            echo json_encode($response);
        } else {
            $response['error'] = 'No details found for this complaint.';
        }



        $stmt->close();
        break;



        //restart work for not approval
    case 'wrestart':
        $id = $_POST['task_id'];



        $sql = "UPDATE complaints_detail 
            SET status = 10 
            WHERE id = (SELECT problem_id FROM manager WHERE task_id = '$id')";

        $query_run = mysqli_query($db, $sql);
        if ($query_run) {
            $res = [
                "status" => 200,
                "message" => "Work started successfully"
            ];
            echo json_encode($res);
        } else {
            $res = [
                "status" => 500,
                "message" => "Work could not be started"
            ];
            echo json_encode($res);
        }
        break;


        //work completion status update
    case 'workcompletion':
        $taskId = $_POST['task_id'];
        $completionStatus = $_POST['completion_status'];
        $reason = $_POST['reason'];
        $p_id = $_POST['p_id'];
        $oname = $_POST['o_name'];
        $wname = $_POST['w_name'];
        $amt = $_POST['amt'];
        $name = current(array_filter([$oname, $wname]));

        $insertQuery = "UPDATE manager SET worker_id='$name' WHERE task_id='$taskId'";
        if (mysqli_query($db, $insertQuery)) {


            $updateComplaintSql = "UPDATE complaints_detail 
                                   SET status = 11,worker_id='$name',amount_spent='$amt', task_completion = ?,reason = ?,date_of_completion = NOW()
                                   WHERE id = (SELECT problem_id FROM manager WHERE task_id = ?)";
            if ($stmt = $db->prepare($updateComplaintSql)) {
                $stmt->bind_param("ssi", $completionStatus, $reason, $taskId);
                if (!$stmt->execute()) {
                    echo "Update failed: (" . $stmt->errno . ") " . $stmt->error;
                } else {
                    echo "Complaint status and task completion updated successfully.";
                }
                $stmt->close();
            } else {
                echo "Prepare failed: (" . $db->errno . ") " . $db->error;
            }

            $imgAfterName = null;
            if (isset($_FILES['img_after']) && $_FILES['img_after']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'imgafter/';
                $imgAfterName = basename($_FILES['img_after']['name']);
                $uploadFile = $uploadDir . $imgAfterName;

                if (move_uploaded_file($_FILES['img_after']['tmp_name'], $uploadFile)) {
                    echo "File successfully uploaded: " . $imgAfterName;

                    $insertTaskDetSql = "INSERT INTO worker_taskdet (task_id, task_completion, after_photo, work_completion_date) 
                                         VALUES (?, ?, ?, NOW())";
                    if ($stmt = $db->prepare($insertTaskDetSql)) {
                        $stmt->bind_param("sss", $taskId, $completionStatus, $imgAfterName);
                        if (!$stmt->execute()) {
                            echo "Insertion into worker_taskdet failed: (" . $stmt->errno . ") " . $stmt->error;
                        } else {
                            echo "Record inserted successfully into worker_taskdet.";
                        }
                        $stmt->close();
                    } else {
                        echo "Prepare failed: (" . $db->errno . ") " . $db->error;
                    }
                } else {
                    echo "File upload failed.";
                }
            } else {
                echo "No file uploaded or file upload error.";
            }
        }
        break;



        //show before image for workers
    case 'wbeforeimg':
        $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : '';

        if (empty($task_id)) {
            echo json_encode(['status' => 400, 'message' => 'Task ID not provided']);
            exit;
        }

        $query = "SELECT images FROM complaints_detail WHERE id = (SELECT problem_id FROM manager WHERE task_id = ?)";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }

        $stmt->bind_param('i', $task_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $image_filename = basename($row['images']);
            $image_path = 'uploads/' . $image_filename;

            echo json_encode(['status' => 200, 'data' => ['after_photo' => $image_path]]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'No image found']);
        }

        $stmt->close();
        break;


        //after image for workers
    case 'wafterimage':
        $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : '';

        if (empty($task_id)) {
            echo json_encode(['status' => 400, 'message' => 'Task ID not provided']);
            exit;
        }

        $query = "SELECT after_photo FROM worker_taskdet WHERE task_id = ?";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }

        $stmt->bind_param('i', $task_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $image_filename = basename($row['after_photo']);
            $image_path = 'imgafter/' . $image_filename;

            echo json_encode(['status' => 200, 'data' => ['after_photo' => $image_path]]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'No image found']);
        }

        $stmt->close();
        exit;
        break;



        //worker assign in completion
    case 'wworkerassign':
        $work = $_POST['worker_dept'];
        $sql8 = "SELECT worker_id, worker_first_name FROM worker_details WHERE worker_dept = ?";
        $stmt = $db->prepare($sql8);
        $stmt->bind_param("s", $work);
        $stmt->execute();
        $result8 = $stmt->get_result();



        $options = '';


        while ($row = mysqli_fetch_assoc($result8)) {
            $options .= '<option value="' . $row['worker_id'] . '">' . $row['worker_id'] . ' - ' . $row['worker_first_name'] . '</option>';
        }


        echo $options;
        break;



        //Faculty backend Starts
        //faculty raise complaint
    case 'facraisecomp':
        $faculty_id = mysqli_real_escape_string($db, $_POST['faculty_id']);
        $fac_id = mysqli_real_escape_string($db, $_POST['cfaculty']);
        $block_venue = mysqli_real_escape_string($db, $_POST['block_venue']);
        $venue_name = mysqli_real_escape_string($db, $_POST['venue_name']);
        $type_of_problem = mysqli_real_escape_string($db, $_POST['type_of_problem']);
        $problem_description = mysqli_real_escape_string($db, $_POST['problem_description']);
        $itemno = mysqli_real_escape_string($db, $_POST['itemno']);
        $date_of_reg = mysqli_real_escape_string($db, $_POST['date_of_reg']);
        $status = $_POST['status'];

        // Handle file upload
        $images = "";
        $uploadFileDir = './uploads/';

        if (!is_dir($uploadFileDir) && !mkdir($uploadFileDir, 0755, true)) {
            echo json_encode(['status' => 500, 'message' => 'Failed to create upload directory.']);
            exit;
        }

        if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['images']['tmp_name'];
            $fileNameCmps = explode(".", $_FILES['images']['name']);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            if (in_array($fileExtension, $allowedExtensions)) {
                $nextFileNumber = getNextFileNumber($counterFilePath);
                $newFileName = str_pad($nextFileNumber, 10, '0', STR_PAD_LEFT) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $images = $newFileName;
                } else {
                    echo json_encode(['status' => 500, 'message' => 'Error moving the uploaded file.']);
                    exit;
                }
            } else {
                echo json_encode(['status' => 500, 'message' => 'Upload failed. Allowed types: jpg, jpeg, png.']);
                exit;
            }
        }





        // Insert data into the database
        $query = "INSERT INTO complaints_detail (faculty_id,fac_id,block_venue, venue_name, type_of_problem, problem_description,itemno, images, date_of_reg, status) 
              VALUES ('$faculty_id','$fac_id', '$block_venue', '$venue_name', '$type_of_problem', '$problem_description','$itemno', '$images', '$date_of_reg', '$status')";

        if (mysqli_query($db, $query)) {
            echo json_encode(['status' => 200, 'message' => 'Success']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Error inserting data: ' . mysqli_error($db)]);
        }
        break;



        //Deleting the complaint
    case 'facdelcomp':
        $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
        $query = "DELETE FROM complaints_detail WHERE id='$user_id'";

        if (mysqli_query($db, $query)) {
            echo json_encode(['status' => 200, 'message' => 'Deleted successfully']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Error deleting data: ' . mysqli_error($db)]);
        }
        break;



        //Show before image 
    case 'facbimg':
        $id = $_POST['problem_id']; // Ensure id is set


        // Query to fetch the image based on id
        $query = "SELECT id, images FROM complaints_detail WHERE id = ?";
        $stmt = $db->prepare($query);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(['status' => 200, 'data' => $row]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'No image found']);
        }

        $stmt->close();
        $db->close();
        break;


        //worker details showing in faculty
    case 'facworkerdet':
        $id = $_POST['id'];

        // SQL query to get worker details
        $query = "
    SELECT w.worker_first_name,
     w.worker_mobile
    FROM complaints_detail cd
    INNER JOIN manager m ON cd.id = m.problem_id
    INNER JOIN worker_details w ON m.worker_id = w.worker_id
    WHERE cd.id = ?
";

        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $worker = $result->fetch_assoc();
            echo json_encode(['status' => 200, 'worker_first_name' => $worker['worker_first_name'], 'worker_mobile' => $worker['worker_mobile']]);
        } else {
            echo json_encode(['status' => 500, 'message' => 'No worker details found for this id']);
        }

        $stmt->close();
        $db->close();
        break;


        //Showing feedback for faculty
    case 'facdetfeedback':
        $id = $_POST['id'];
        $feedback = $_POST['satisfaction_feedback']; // Combined feedback and satisfaction value
        $rating = $_POST['ratings']; // Get rating

        // Validate inputs
        if (empty($id) || empty($feedback)) {
            echo json_encode(['status' => 400, 'message' => 'Problem ID or Feedback is missing']);
            exit;
        }

        // Check if feedback already exists for the given id
        $checkQuery = "SELECT feedback FROM complaints_detail WHERE id = ?";
        $stmt = $db->prepare($checkQuery);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            exit;
        }

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        $feedbackExists = $stmt->num_rows > 0; // Check if a row exists for the given id

        $stmt->close();

        // Update feedback if it exists, and set status to 14
        if ($feedbackExists) {
            // Update existing feedback, rating, and set status to 14
            $query = "UPDATE complaints_detail SET feedback = ?, rating = ?, status = 14 WHERE id = ?";
        } else {
            // Insert new feedback (same query logic as update), with status set to 14
            $query = "UPDATE complaints_detail SET feedback = ?, rating = ?, status = 14 WHERE id = ?";
        }

        $stmt = $db->prepare($query);

        if (!$stmt) {
            echo json_encode(['status' => 500, 'message' => 'Prepare statement failed: ' . $db->error]);
            break;
        }

        // Bind parameters including the combined feedback value, rating, and ID
        $stmt->bind_param('sii', $feedback, $rating, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 200, 'message' => 'Feedback updated successfully']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Query failed: ' . $stmt->error]);
        }

        $stmt->close();
        $db->close();
        break;





    case 'getfaculty':
        $sql8 =  "SELECT * FROM faculty WHERE dept=(SELECT department FROM faculty_details WHERE faculty_id='$faculty_id')";
        $result8 = mysqli_query($db, $sql8);

        $options = '';
        $options .= '<option value="">Select a Faculty</option>';



        while ($row = mysqli_fetch_assoc($result8)) {
            $options .= '<option value="' . $row['id'] . '">' . $row['id'] . ' - ' . $row['name'] . '</option>';
        }


        echo $options;
        break;

        //password change for faculty
    case 'facchangepass':
        $newp = $_POST['pass'];
        $sql = "UPDATE faculty_details SET password = '$newp' WHERE faculty_id ='$fac_id'";
        if (mysqli_query($db, $sql)) {
            $res = [
                "status" => 200,
                "message" => "password changed",
            ];
            echo json_encode($res);
            break;
        }
}
