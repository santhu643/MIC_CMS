<?php
require_once 'feed_db_connection.php';

$feedbackId = $_GET['feedback_id'];

$query = "SELECT s.*, fs.feedback_id 
          FROM subjects s 
          JOIN feedback_subjects fs ON s.id = fs.subject_id 
          WHERE fs.feedback_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $feedbackId);
$stmt->execute();
$result = $stmt->get_result();

$subjects = [];
while ($row = $result->fetch_assoc()) {
    $subjectId = $row['id'];
    $row['questions'] = [];
    
    $questionQuery = "SELECT * FROM questions WHERE subject_id = ?";
    $questionStmt = $conn->prepare($questionQuery);
    $questionStmt->bind_param("i", $subjectId);
    $questionStmt->execute();
    $questionResult = $questionStmt->get_result();
    
    while ($questionRow = $questionResult->fetch_assoc()) {
        $row['questions'][] = $questionRow;
    }
    
    $subjects[] = $row;
}

echo json_encode(['subjects' => $subjects]);