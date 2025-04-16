<?php
// feedback_report.php

require_once 'feed_db_connection.php';
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['feedback_id'])) {
    $feedback_id = $_POST['feedback_id'];
    
    // Assuming $max_columns is defined here
    $max_columns = 7; // or whatever the actual number is
    
    $query = "SELECT s.sid AS student_id, s.sname AS student_name, s.dept AS student_department, sub.subject_name, sr.response 
              FROM student_responses sr
              JOIN students s ON sr.student_id = s.uid
              JOIN subjects sub ON sr.subject_id = sub.id
              WHERE sr.feedback_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $feedback_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $student_id = $row['student_id'];
        $subject_name = $row['subject_name'];

        if (!isset($data[$subject_name])) {
            $data[$subject_name] = [
                'student_responses' => []
            ];
        }
        
        $data[$subject_name]['student_responses'][$student_id] = [
            'student_name' => $row['student_name'],
            'student_department' => $row['student_department'],
            'responses' => explode(',', $row['response']) // Assuming responses are stored as comma-separated values
        ];
    }

    foreach ($data as $subject_name => $subject_data) {
        foreach ($subject_data['student_responses'] as $student_id => $student_info) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($student_id) . "</td>";
            echo "<td>" . htmlspecialchars($student_info['student_name']) . "</td>";
            echo "<td>" . htmlspecialchars($student_info['student_department']) . "</td>";
            echo "<td>" . htmlspecialchars($subject_name) . "</td>";
            foreach ($student_info['responses'] as $response) {
                echo "<td>" . htmlspecialchars($response) . "</td>";
            }
            echo "</tr>";
        }
    }

    $stmt->close();
    $conn->close();
    exit; // End the script execution after outputting the rows
}
?>
