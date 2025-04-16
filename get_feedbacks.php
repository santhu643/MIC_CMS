<?php
require_once 'config.php';
require_once 'feed_db_connection.php';
require_once 'session.php';

// Ensure $sdept and $sayear are safely handled
$sdept = isset($sdept) ? $sdept : '';
$sayear = isset($sayear) ? $sayear : '';
$std_id = $s;

// Department mapping array
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

// Convert the full department name to short form if necessary
$sdeptShortForm = $departmentMapping[$sdept] ?? $sdept; // Use $sdept if no mapping found


$query = "
    SELECT feedbacks.* 
    FROM feedbacks
    LEFT JOIN student_responses 
    ON feedbacks.id = student_responses.feedback_id 
    AND student_responses.student_id = ?
    WHERE feedbacks.deadline >= CURDATE() 
    AND (feedbacks.department = 'all' OR feedbacks.department = ?) 
    AND feedbacks.year = ?
    AND student_responses.student_id IS NULL
    ORDER BY feedbacks.deadline";

$stmt = $conn->prepare($query);

$stmt->bind_param("sss", $std_id, $sdeptShortForm, $sayear);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$feedbacks = [];
while ($row = $result->fetch_assoc()) {
    $feedbacks[] = $row;
}

echo json_encode($feedbacks);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
