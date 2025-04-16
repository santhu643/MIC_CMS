<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mic";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST['type'] == "department") {
    // Department-wise Internship Count
    $sql = "
        SELECT 
            s.dept, 
            COUNT(*) AS total_internships, 
            SUM(CASE WHEN i.status = 0 THEN 1 ELSE 0 END) AS status_0, 
            SUM(CASE WHEN i.status = 1 THEN 1 ELSE 0 END) AS status_1
        FROM `sintern` i
        JOIN `student` s ON i.sid = s.sid
        GROUP BY s.dept
    ";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} elseif ($_POST['type'] == "faculty") {
    // Faculty-wise Internship Count
    $sql = "
        SELECT 
        f.id AS faculty_id,
            f.name AS faculty_name, 
            f.dept, 
            COUNT(*) AS total_internships, 
            SUM(CASE WHEN i.status = 0 THEN 1 ELSE 0 END) AS status_0, 
            SUM(CASE WHEN i.status = 1 THEN 1 ELSE 0 END) AS status_1
        FROM `sintern` i
        JOIN `student` s ON i.sid = s.sid
        JOIN `faculty` f ON s.mentor = f.id
        GROUP BY s.mentor
    ";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
}

$conn->close();
?>