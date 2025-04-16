<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Fetch photo_file_path to delete photo
    $sql_select = "SELECT photo_file_path FROM applicant_data WHERE id = $id";
    $result = $conn->query($sql_select);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo_file_path = $row['photo_file_path'];

        // Delete applicant data from the database
        $sql_delete = "DELETE FROM applicant_data WHERE id = $id";

        if ($conn->query($sql_delete) === TRUE) {
            // Delete photo from directory
            $photo_path = 'photo/' . $photo_file_path;
            if (file_exists($photo_path)) {
                unlink($photo_path); // Delete the file
            }
            echo json_encode(array("status" => "success", "message" => "Applicant data and photo deleted successfully"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error deleting applicant data: " . $conn->error));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Applicant data not found"));
    }

    $conn->close();
}
?>
