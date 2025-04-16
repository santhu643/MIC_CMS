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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#applicantTable1').DataTable();
        });
    </script>
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="table-responsive">
            <table id="applicantTable1" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Post Applied For</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["post_applied_for"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td><img src='photo/" . $row["photo_file_path"] . "' alt='Photo' width='50' height='50'></td>";

            // Remark column with "Enter" button if remark is empty
            echo "<td>" . $row["remarks"]."</td>";

            // Action column with delete and print icons
            echo "<td>";
            echo "<img class='enterRemarkBtn' src='img/edit.png' data-id='" . $row["id"] . "' alt='Enter Remark' width='20' height='20'>";
            echo "&nbsp;";
            echo "<img class='deleteBtn' src='img/delete.png' data-id='" . $row["id"] . "' alt='Delete' width='20' height='20'>";
            echo "&nbsp;";
            echo "<img class='printBtn' src='img/print.png' data-id='" . $row["id"] . "' alt='Print' width='20' height='20'>";
            echo "</td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No data available</td></tr>";
    }
    $conn->close();
    ?>
</tbody>

            </table>
        </div>
    </div>

    <!-- Modal for entering remarks -->
    <div class="modal fade" id="enterRemarkModal" tabindex="-1" role="dialog" aria-labelledby="enterRemarkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="enterRemarkModalLabel">Enter Remark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="enterRemarkForm">
                    <div class="modal-body">
                        <input type="hidden" id="applicantId" name="applicantId">
                        <div class="form-group">
                            <label for="remark">Remark:</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Remark</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling modal and actions -->
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#applicantTable').DataTable();

            // Handle click on "Enter" button for remarks
            $(document).on('click', '.enterRemarkBtn', function () {
                var applicantId = $(this).data('id');
                $('#applicantId').val(applicantId);
                $('#enterRemarkModal').modal('show');
            });

            // Handle click on "Delete" button
            $(document).on('click', '.deleteBtn', function () {
                var applicantId = $(this).data('id');
                if (confirm("Are you sure you want to delete this applicant's data?")) {
                    // Perform AJAX delete request
                    $.ajax({
                        url: 'delete_applicant.php',
                        method: 'POST',
                        data: { id: applicantId },
                        success: function (response) {
                            // Reload DataTable after deletion
                            $('#applicantTable1').load(location.href + " #applicantTable1");
                        }
                    });
                }
            });

            // Handle click on "Print" button (to be implemented)
            $(document).on('click', '.printBtn', function () {
    var applicantId = $(this).data('id');
    // Open print.php in a new tab with the applicant ID as a query parameter
    window.open('print.php?id=' + applicantId, '_blank');
});


            // Handle form submission for entering remarks
            $('#enterRemarkForm').submit(function (e) {
                e.preventDefault();
                var applicantId = $('#applicantId').val();
                var remark = $('#remark').val();

                // Perform AJAX request to save remark
                $.ajax({
    url: 'save_remark.php',
    method: 'POST',
    data: {
        id: applicantId,
        remark: remark
    },
    dataType: 'json',
    success: function (response) {
        if (response.status === 'success') {
            // Close modal and reload DataTable after saving remark
            $('#enterRemarkModal').modal('hide');
            //$('#applicantTable').DataTable().ajax.reload();
            $('#applicantTable').load(location.href + " #applicantTable");
        } else {
            alert('Error: ' + response.message);
        }
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.error('AJAX Error:', textStatus, errorThrown);
        alert('An error occurred while saving the remark. Please try again.');
    }
});
            });
        });
    </script>
</body>
</html>
