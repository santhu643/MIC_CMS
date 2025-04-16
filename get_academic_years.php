<?php
require 'config.php';


// Query to select academic years from mic table
$query = "SELECT ayear FROM ayear ORDER BY ayear DESC";
$result = mysqli_query($db, $query);

// Generate options for select dropdown
$options = '<option value="">Select type</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="'.$row['ayear'].'">'.$row['ayear'].'</option>';
}

// Update the select element with options
echo $options;


?>