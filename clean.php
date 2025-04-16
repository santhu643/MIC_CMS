<?php
// Database connection
$conn = new mysqli("localhost", "TIHMIC", "KalaI@@1992@@", "bus");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the select query to find pending records older than 5 minutes
$selectQuery = "SELECT regno FROM student WHERE fee_status = 'pending' AND TIMESTAMPDIFF(MINUTE, generated_date, NOW()) > 20";
$result = $conn->query($selectQuery);

// Check if there are any records to delete
if ($result->num_rows > 0) {
    // Prepare the delete statement
    $deleteStmt = $conn->prepare("DELETE FROM student WHERE regno = ?");

    // Fetch each record and delete it
    while ($row = $result->fetch_assoc()) {
        $regno = $row['regno'];

        // Bind the parameter and execute the delete statement
        $deleteStmt->bind_param("s", $regno);
        $deleteStmt->execute();
    }

    // Close the delete statement
    $deleteStmt->close();
}

// Close the database connection
$conn->close();
