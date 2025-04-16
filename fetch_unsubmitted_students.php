<?php
require_once 'feed_db_connection.php';
require_once 'config.php';

// Department mapping from full form to short form
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

if (isset($_POST['feedback_id'])) {
    $feedback_id = intval($_POST['feedback_id']);

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
} else {
    echo "<tr><td colspan='3'>No feedback ID provided.</td></tr>";
}
?>
