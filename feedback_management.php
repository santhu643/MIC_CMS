<?php
require_once 'feed_db_connection.php';
require 'config.php';
require 'session.php';


// Handle Add Subject
if (isset($_POST['action']) && $_POST['action'] === 'add_subject') {
    $subjectCode = $_POST['subjectCode'];
    $subjectName = $_POST['subjectName'];
    $departments = $_POST['departments'];
    $questions = $_POST['questions'];

    $success = true;
    $conn->begin_transaction();

    try {
        // Insert subject for each department
        foreach ($departments as $department) {
            $stmt = $conn->prepare("INSERT INTO subjects (subject_code, subject_name, department) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $subjectCode, $subjectName, $department);
            $stmt->execute();
            $subjectId = $stmt->insert_id;
            $stmt->close();

            // Insert questions
            if (!empty($questions)) {
                $questionStmt = $conn->prepare("INSERT INTO questions (subject_id, question) VALUES (?, ?)");
                foreach ($questions as $question) {
                    $questionStmt->bind_param("is", $subjectId, $question);
                    $questionStmt->execute();
                }
                $questionStmt->close();
            }
        }

        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }

    exit;
}
// Handle Add Question
if (isset($_POST['action']) && $_POST['action'] === 'add_question') {
    $subjectId = $_POST['subjectId'];
    $question = $_POST['question'];

    $stmt = $conn->prepare("INSERT INTO questions (subject_id, question) VALUES (?, ?)");
    $stmt->bind_param("is", $subjectId, $question);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }

    $stmt->close();
    exit;
}
//adding feedback
// Handle Fetch Subjects
if (isset($_GET['action']) && $_GET['action'] === 'get_subjects') {
    $result = $conn->query("SELECT * FROM subjects where `sid`='$s'");

    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjectId = $row['id'];
        $questionsResult = $conn->query("SELECT question FROM questions WHERE subject_id = $subjectId");
        $questions = [];
        while ($questionRow = $questionsResult->fetch_assoc()) {
            $questions[] = $questionRow['question'];
        }
        $row['questions'] = $questions;
        $subjects[] = $row;
    }

    echo json_encode($subjects);
    exit;
}



if (isset($_GET['action']) && $_GET['action'] === 'get_subjects_drop') {
    $department = $_GET['department'];

    // Fetch subjects based on the selected department
    if ($department === 'all') {
        $result = $conn->query("SELECT * FROM subjects");
    } else {
        $stmt = $conn->prepare("SELECT * FROM subjects WHERE department LIKE ?");
        $stmt->bind_param("s", $department);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjectId = $row['id'];
        $questionsResult = $conn->query("SELECT question FROM questions WHERE subject_id = $subjectId");
        $questions = [];
        while ($questionRow = $questionsResult->fetch_assoc()) {
            $questions[] = $questionRow['question'];
        }
        $row['questions'] = $questions;
        $subjects[] = $row;
    }

    echo json_encode($subjects);
    exit;
}

// Handle Get Feedbacks
if (isset($_GET['action']) && $_GET['action'] === 'get_feedbacks') {
    $result = $conn->query("SELECT * FROM feedbacks where `sid`='$s'");
    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
    echo json_encode($feedbacks);
    exit;
}

// Handle Get Subjects
if (isset($_GET['action']) && $_GET['action'] === 'get_subjects') {
    $result = $conn->query("SELECT s.id, s.subject_code, s.subject_name, d.department FROM subjects s
        JOIN departments d ON s.department_id = d.id");
    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }
    echo json_encode($subjects);
    exit;
}

// Handle Add Feedback
if (isset($_POST['action']) && $_POST['action'] === 'add_feedback') {
    $feedbackName = $_POST['feedbackName'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $deadline = $_POST['deadline'];
    $subjects = $_POST['subjects'];

    $success = true;
    $conn->begin_transaction();

    try {
        // Insert feedback
        $stmt = $conn->prepare("INSERT INTO feedbacks (feedback_name, department,year, deadline) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $feedbackName,$department, $year, $deadline);
        $stmt->execute();
        $feedbackId = $stmt->insert_id;
        $stmt->close();

        // Insert feedback-subject mappings
        $stmt = $conn->prepare("INSERT INTO feedback_subjects (feedback_id, subject_id) VALUES (?, ?)");
        foreach ($subjects as $subjectCode) {
            // Fetch subject ID from code
            $subjectStmt = $conn->prepare("SELECT id FROM subjects WHERE subject_code = ?");
            $subjectStmt->bind_param("s", $subjectCode);
            $subjectStmt->execute();
            $result = $subjectStmt->get_result();
            $subject = $result->fetch_assoc();
            $subjectId = $subject['id'];
            $subjectStmt->close();

            $stmt->bind_param("ii", $feedbackId, $subjectId);
            $stmt->execute();
        }
        $stmt->close();

        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }

    exit;
}

//student feedback section

// Handle Get Subjects for Student
if (isset($_GET['action']) && $_GET['action'] === 'get_feedbacks') {

    $studentId = $_GET['student_id']; // Replace with actual student ID from session

    // Fetch student's academic year
    $stmt = $conn->prepare("SELECT ayear, dept FROM student WHERE sid = ?");
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $studentYear = $student['ayear'];
    $studentDept = $student['dept'];

    // Fetch feedbacks relevant to the student's academic year
    $stmt = $conn->prepare("SELECT id, feedback_name, deadline
        FROM feedbacks 
        WHERE year = ?");
    $stmt->bind_param("s", $studentYear);
    $stmt->execute();
    $result = $stmt->get_result();

    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
    echo json_encode($feedbacks);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'get_feedback_details') {

    $feedbackId = $_GET['feedback_id'];

    // Fetch subjects associated with this feedback
    $stmt = $conn->prepare("SELECT s.id as subject_id, s.subject_name 
        FROM feedback_subjects fs
        JOIN subjects s ON fs.subject_id = s.id
        WHERE fs.feedback_id = ?");
    $stmt->bind_param("i", $feedbackId);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = [];
    while ($row = $result->fetch_assoc()) {
        $subjectId = $row['subject_id'];
        $subjectName = $row['subject_name'];

        // Fetch questions for each subject
        $stmtQuestions = $conn->prepare("SELECT id, question FROM questions WHERE subject_id = ?");
        $stmtQuestions->bind_param("i", $subjectId);
        $stmtQuestions->execute();
        $resultQuestions = $stmtQuestions->get_result();

        $questions = [];
        while ($questionRow = $resultQuestions->fetch_assoc()) {
            $questions[] = $questionRow;
        }

        $subjects[] = [
            'subject_name' => $subjectName,
            'questions' => $questions
        ];
    }

    echo json_encode($subjects);
    exit;
}

// Handle feedback submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_feedback') {

    $studentId = $_POST['student_id'];
    $feedbackId = $_POST['feedback_id'];
    $ratings = $_POST['ratings']; // Array of subject_id => [question_id => rating]

    foreach ($ratings as $subjectId => $subjectRatings) {
        foreach ($subjectRatings as $questionId => $rating) {
            // Save each rating to student_feedbacks table
            $stmt = $conn->prepare("INSERT INTO student_feedbacks (student_id, subject_id, rating) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $studentId, $subjectId, $rating);
            $stmt->execute();
        }
    }

    echo json_encode(['status' => 'success']);
    exit;
}

//fecth subjects associated with feedback for dropdown
if (isset($_POST['action']) && $_POST['action'] === 'fetch_subjects') {
    $feedback_id = intval($_POST['feedback_id']);
    
    // Query to fetch subjects associated with the selected feedback
    $query = "
        SELECT s.id, s.subject_name 
        FROM subjects s
        JOIN feedback_subjects fs ON fs.subject_id = s.id
        WHERE fs.feedback_id = $feedback_id
    ";
    $result = mysqli_query($conn, $query);
    
    $options = "<option value=''>Select a subject</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['subject_name']) . "</option>";
    }
    
    echo $options;
}

//not submitted students list fetch

$departmentMapping = [
    'Information Technology' => 'IT',
    'Computer Science and Engineering' => 'CSE',
    'Mechanical Engineering' => 'MECH',
    'Electronics and Communication Engineering' => 'ECE',
    'Electrical and Electronics Engineering' => 'EEE',
    'Artificial Intelligence and Data Science' => 'AIDS',
    'Artificial Intelligence and Machine Learning' => 'AIML',
    'Civil Engineering' => 'CIVIL',
    'Computer Science and Business Systems' => 'CSBS'
];

if (isset($_POST['action']) && $_POST['action'] === 'not_submitted') {
    $feedback_id = intval($_POST['feedback_id2']);

    // Query to find the department associated with the given feedback ID
    $dept_query = "SELECT department FROM feedbacks WHERE id = $feedback_id";
    $dept_result = mysqli_query($conn, $dept_query);

    if ($dept_result && mysqli_num_rows($dept_result) > 0) {
        $dept_row = mysqli_fetch_assoc($dept_result);
        $departmentShort = $dept_row['department'];

        if ($departmentShort === 'all') {
            $query = "
                SELECT s.sid, s.sname, s.dept
                FROM mic.student s
                LEFT JOIN student_responses sr 
                    ON s.sid = sr.student_id 
                    AND sr.feedback_id = $feedback_id
                WHERE sr.student_id IS NULL
                AND s.ayear = (SELECT year FROM feedbacks WHERE id = $feedback_id)
            ";
        } else {
            $departmentFull = array_search($departmentShort, $departmentMapping);

            if ($departmentFull !== false) {
                $query = "
                    SELECT s.sid, s.sname, s.dept
                    FROM mic.student s
                    LEFT JOIN student_responses sr 
                        ON s.sid = sr.student_id 
                        AND sr.feedback_id = $feedback_id
                    WHERE sr.student_id IS NULL
                    AND s.ayear = (SELECT year FROM feedbacks WHERE id = $feedback_id)
                    AND s.dept = '" . mysqli_real_escape_string($conn, $departmentFull) . "'
                ";
            } else {
                echo "<tr><td colspan='3'>Department mapping not found for the selected feedback.</td></tr>";
                exit;
            }
        }

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['sid']) . "</td>
                        <td>" . htmlspecialchars($row['sname']) . "</td>
                        <td>" . htmlspecialchars($row['dept']) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>All students have submitted the feedback.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Invalid feedback ID or department not found.</td></tr>";
    }
}


//delete subject

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_sub') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // First, delete related records in feedback_subjects
        $delete_feedback_subjects = "DELETE FROM feedback_subjects WHERE subject_id = ?";
        $stmt = mysqli_prepare($conn, $delete_feedback_subjects);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        // Then, delete the subject
        $delete_subject = "DELETE FROM subjects WHERE id = ?";
        $stmt = mysqli_prepare($conn, $delete_subject);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        // If everything is successful, commit the transaction
        mysqli_commit($conn);

        $res = [
            'status' => 200,
            'message' => 'Subject Deleted Successfully'
        ];
    } catch (Exception $e) {
        // If an error occurs, rollback the changes
        mysqli_rollback($conn);
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
    }

    echo json_encode($res);
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_feed') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // First, delete related records in feedback_subjects
        $delete_feedback_subjects = "DELETE FROM feedback_subjects WHERE feedback_id = ?";
        $stmt = mysqli_prepare($conn, $delete_feedback_subjects);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        // Then, delete the subject
        $delete_subject = "DELETE FROM feedbacks WHERE id = ?";
        $stmt = mysqli_prepare($conn, $delete_subject);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        // If everything is successful, commit the transaction
        mysqli_commit($conn);

        $res = [
            'status' => 200,
            'message' => 'Feedback Deleted Successfully'
        ];
    } catch (Exception $e) {
        // If an error occurs, rollback the changes
        mysqli_rollback($conn);
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
    }

    echo json_encode($res);
    return;
}
?>