<?php
include 'db_connection.php';

// Fetch data from the applicant_data table
$sql = "SELECT * FROM applicant_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <!-- DataTables Buttons JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#applicantTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Download as Excel',
                        filename: 'Applicant Data',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            // Custom CSS to override DataTables Buttons styling
            $('.buttons-excel').addClass('btn-success'); // Ensure button appears green
        });
    </script>

     <!-- Custom CSS -->
     <style>
        .dt-buttons .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .dt-buttons .btn-success:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }

        #applicantTable {
            border: 2px solid #000; /* Border around the table */
            border-collapse: collapse; /* Collapse border spacing */
        }

        #applicantTable th, #applicantTable td {
            border: 1px solid #000; /* Border around table cells */
            padding: 8px; /* Padding inside cells */
        }

        #applicantTable th {
            background-color: #1e3799; /* Background color for table headers */
            color:white;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="table-responsive">
            <table id="applicantTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Post Applied For</th>
                        <th>Department</th>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Family Status</th>
                        <th>Father's Occupation</th>
                        <th>Mother's Occupation</th>
                        <th>Siblings' Occupation</th>
                        <th>Permanent Address</th>
                        <th>Religion</th>
                        <th>Community</th>
                        <th>Caste</th>
                        <th>Marital Status</th>
                        <th>Spouse Name</th>
                        <th>Spouse Qualification</th>
                        <th>Spouse Occupation</th>
                        <th>Children Info</th>
                        <th>X Std Institution</th>
                        <th>X Std Place</th>
                        <th>X Std Year</th>
                        <th>X Std Percentage</th>
                        <th>XII Std Institution</th>
                        <th>XII Std Place</th>
                        <th>XII Std Year</th>
                        <th>XII Std Percentage</th>
                        <th>Diploma Institution</th>
                        <th>Diploma Place</th>
                        <th>Diploma Year</th>
                        <th>Diploma Percentage</th>
                        <th>UG Institution</th>
                        <th>UG Place</th>
                        <th>UG Year</th>
                        <th>UG Percentage</th>
                        <th>PG Institution</th>
                        <th>PG Place</th>
                        <th>PG Year</th>
                        <th>PG Percentage</th>
                        <th>MPhil Institution</th>
                        <th>MPhil Place</th>
                        <th>MPhil Year</th>
                        <th>MPhil Percentage</th>
                        <th>PhD Institution</th>
                        <th>PhD Place</th>
                        <th>PhD Year</th>
                        <th>PhD Percentage</th>
                        <th>Additional Qualification</th>
                        <th>UG Experience</th>
                        <th>PG Experience</th>
                        <th>PhD Experience</th>
                        <th>Total Experience</th>
                        <th>Salary Expected</th>
                        <th>Application Date</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["post_applied_for"] . "</td>";
                            echo "<td>" . $row["department"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["dob"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["father_name"] . "</td>";
                            echo "<td>" . $row["mother_name"] . "</td>";
                            echo "<td>" . $row["family_status"] . "</td>";
                            echo "<td>" . $row["father_occupation"] . "</td>";
                            echo "<td>" . $row["mother_occupation"] . "</td>";
                            echo "<td>" . $row["siblings_occupation"] . "</td>";
                            echo "<td>" . $row["permanent_address"] . "</td>";
                            echo "<td>" . $row["religion"] . "</td>";
                            echo "<td>" . $row["community"] . "</td>";
                            echo "<td>" . $row["caste"] . "</td>";
                            echo "<td>" . $row["marital_status"] . "</td>";
                            echo "<td>" . $row["spouse_name"] . "</td>";
                            echo "<td>" . $row["spouse_qualification"] . "</td>";
                            echo "<td>" . $row["spouse_occupation"] . "</td>";
                            echo "<td>" . $row["children_info"] . "</td>";
                            echo "<td>" . $row["x_std_institution"] . "</td>";
                            echo "<td>" . $row["x_std_place"] . "</td>";
                            echo "<td>" . $row["x_std_year"] . "</td>";
                            echo "<td>" . $row["x_std_percentage"] . "</td>";
                            echo "<td>" . $row["xii_std_institution"] . "</td>";
                            echo "<td>" . $row["xii_std_place"] . "</td>";
                            echo "<td>" . $row["xii_std_year"] . "</td>";
                            echo "<td>" . $row["xii_std_percentage"] . "</td>";
                            echo "<td>" . $row["diploma_institution"] . "</td>";
                            echo "<td>" . $row["diploma_place"] . "</td>";
                            echo "<td>" . $row["diploma_year"] . "</td>";
                            echo "<td>" . $row["diploma_percentage"] . "</td>";
                            echo "<td>" . $row["ug_institution"] . "</td>";
                            echo "<td>" . $row["ug_place"] . "</td>";
                            echo "<td>" . $row["ug_year"] . "</td>";
                            echo "<td>" . $row["ug_percentage"] . "</td>";
                            echo "<td>" . $row["pg_institution"] . "</td>";
                            echo "<td>" . $row["pg_place"] . "</td>";
                            echo "<td>" . $row["pg_year"] . "</td>";
                            echo "<td>" . $row["pg_percentage"] . "</td>";
                            echo "<td>" . $row["mphil_institution"] . "</td>";
                            echo "<td>" . $row["mphil_place"] . "</td>";
                            echo "<td>" . $row["mphil_year"] . "</td>";
                            echo "<td>" . $row["mphil_percentage"] . "</td>";
                            echo "<td>" . $row["phd_institution"] . "</td>";
                            echo "<td>" . $row["phd_place"] . "</td>";
                            echo "<td>" . $row["phd_year"] . "</td>";
                            echo "<td>" . $row["phd_percentage"] . "</td>";
                            echo "<td>" . $row["additional_qualification"] . "</td>";
                            echo "<td>" . $row["ug_experience"] . "</td>";
                            echo "<td>" . $row["pg_experience"] . "</td>";
                            echo "<td>" . $row["phd_experience"] . "</td>";
                            echo "<td>" . $row["total_experience"] . "</td>";
                            echo "<td>" . $row["salary_expected"] . "</td>";
                            echo "<td>" . $row["application_date"] . "</td>";
                            echo "<td><img src='photo/" . $row["photo_file_path"] . "' alt='Photo' width='50' height='50'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='54'>No data available</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
