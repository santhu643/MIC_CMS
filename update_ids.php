<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['csvFile']) || $_FILES['csvFile']['error'] !== UPLOAD_ERR_OK) {
        echo "Error uploading file.";
        exit;
    }

    $csvFile = $_FILES['csvFile']['tmp_name'];

    // Read and parse the CSV file
    $csvData = array_map('str_getcsv', file($csvFile));
    array_shift($csvData); // Remove the header row (oid, aid)

    // Database connection
    $conn = new mysqli('localhost', 'TIHMIC', 'KalaI@@1992@@', 'mic');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL update statements
    $updateStudent = $conn->prepare("UPDATE student SET sid = ?, pass = ? WHERE sid = ?");
    $updateSbasic = $conn->prepare("UPDATE sbasic SET sid = ? WHERE sid = ?");

    if (!$updateStudent || !$updateSbasic) {
        echo "Error preparing SQL statements.";
        $conn->close();
        exit;
    }

    // Process each CSV row
    $count = 0;
    foreach ($csvData as $row) {
        $oid = trim($row[0]);
        $aid = trim($row[1]);

        if (!empty($oid) && !empty($aid)) {
            // Update `student` table
            $updateStudent->bind_param('sss', $aid, $aid, $oid);
            $updateStudent->execute();

            // Update `sbasic` table
            $updateSbasic->bind_param('ss', $aid, $oid);
            $updateSbasic->execute();

            $count++;
        }
    }

    // Close the prepared statements and connection
    $updateStudent->close();
    $updateSbasic->close();
    $conn->close();

    echo "Update completed. Processed $count records.";
}
?>
