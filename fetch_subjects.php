<?php
require_once 'feed_db_connection.php';

if (isset($_POST['feedback_id'])) {
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
?>
