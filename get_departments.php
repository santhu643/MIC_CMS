<?php
require 'config.php';


// Query to select academic years from mic table
$query = "SELECT dname FROM departments  ORDER BY dname ASC";
$result = mysqli_query($db, $query);

// Generate options for select dropdown
$options = '<option value="">Select Department</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="'.$row['dname'].'">'.$row['dname'].'</option>';
}
// Update the select element with options
echo $options;


?>