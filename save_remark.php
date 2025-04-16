<?php
include 'db_connection.php';
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $remark = $_POST['remark'];
    
    // Sanitize input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $remark = mysqli_real_escape_string($conn, $remark);
    
    // Update remarks in the database
    $sql = "UPDATE applicant_data SET remarks = '$remark' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Remark saved successfully"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
    }
    
    $conn->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}
?>