<?php
require_once 'feed_db_connection.php';
require_once 'config.php';


// Get the selected subject code from the AJAX request
$selectedSubject = $_POST['subject'];

// Retrieve the feedback data for the selected subject
$sql = "
SELECT
    s.sname,
    sr.feedback_id,
    sr.subject_id,
    sr.question_id,
    sr.student_id,
    sr.response
FROM student_responses sr
JOIN mic.student s ON sr.student_id = s.sid
WHERE sr.subject_id = '$selectedSubject'
ORDER BY s.sname
";
$result = $conn->query($sql);

// Display the report in a table format
echo "<table>";
echo "<tr><th>Student Name</th><th>Feedback ID</th><th>Subject ID</th><th>Question ID</th><th>Student ID</th><th>Response</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['sname'] . "</td>";
    echo "<td>" . $row['feedback_id'] . "</td>";
    echo "<td>" . $row['subject_id'] . "</td>";
    echo "<td>" . $row['question_id'] . "</td>";
    echo "<td>" . $row['student_id'] . "</td>";
    echo "<td>" . $row['response'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// $feedbackConn->close();
// $micConn->close();
?>