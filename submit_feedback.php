<?php
require_once 'feed_db_connection.php';
require_once 'config.php';
require_once 'session.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = ['success' => false, 'message' => 'Unknown error'];

try {
    $conn->begin_transaction();
    
    // Retrieve student ID from session
    $studentId = $s; // assuming $s is the student ID from session
    $name=$sname;
    $dept=$sdept;
    
    // Check if feedback has already been submitted
    $feedbackId = isset($_POST['feedback_id']) ? (int)$_POST['feedback_id'] : 0;
    $stmt = $conn->prepare("
        SELECT COUNT(*) AS count FROM student_responses 
        WHERE feedback_id = ? AND student_id = ?
    ");
    $stmt->bind_param("is", $feedbackId, $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        $response['message'] = 'Feedback already submitted!';
    } else {
        // Proceed with inserting the feedback
        $stmt = $conn->prepare("
            INSERT INTO student_responses (feedback_id, subject_id, question_id, student_id,sname,dept, response) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        if ($stmt === false) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'q') === 0) {
                $questionId = (int)substr($key, 1);
                $subjectId = getSubjectIdForQuestion($conn, $questionId);
                $stmt->bind_param("iiisssi", $feedbackId, $subjectId, $questionId, $studentId, $name, $dept, $value);
                if (!$stmt->execute()) {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
            }
        }
        $conn->commit();
        $response = ['success' => true];
    }
} catch (Exception $e) {
    $conn->rollback();
    $response['message'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);

function getSubjectIdForQuestion($conn, $questionId) {
    $stmt = $conn->prepare("SELECT subject_id FROM questions WHERE id = ?");
    $stmt->bind_param("i", $questionId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return (int)$row['subject_id'];
    }
    
    return 0;
}
