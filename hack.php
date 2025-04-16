<!DOCTYPE html>
<html>

<head>
    <title>Student HackerRank Scores</title>
    <!-- Include Bootstrap CSS from a CDN -->
    <!-- Include DataTables Buttons CSS -->


    <style>
        /* Customize Excel button */
        .dt-buttons .buttons-excel {
            background-color: #4CAF50;
            /* Green */
            border-color: #4CAF50;
            /* Green */
            color: white;
        }

        /* Hover effect */
        .dt-buttons .buttons-excel:hover {
            background-color: #45a049;
            /* Darker Green */
            border-color: #45a049;
            /* Darker Green */
            color: black;
        }

        th {
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
        }
    </style>

</head>

<body>
    <div class="col-md-12">
        <h2 class="mt-4">HackerRank Scores</h2>

        <!-- Department Selection Form -->
        <div class="card border-primary mb-4">
            <div class="card-header">Select Department and Batch</div>
            <div class="card-body">
                <form id="deptForm">
                    <div class="form-group">
                        <label for="deptSelect">Choose Department:</label>
                        <select class="form-control" id="deptSelect" name="dept">
                            <option value="AIML">AIML</option>
                            <option value="CSE">CSE</option>
                            <option value="CSBS">CSBS</option>
                            <option value="EEE">EEE</option>
                            <option value="EE(VLSI)">EE(VLSI)</option>
                            <option value="ECE">ECE</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="batchSelect">Choose Batch:</label>
                        <select class="form-control" id="batchSelect" name="batch">
                            <option value="Batch 1">Batch 1</option>
                            <option value="Batch 2">Batch 2</option>
                            <option value="Batch 3">Batch 3</option>
                            <option value="Batch 4">Batch 4</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loading" class="text-center mb-4" style="display: none;">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p>Loading HackerRank scores...</p>
        </div>

        <!-- Student Table -->
        <table id="studentTable" class="table table-striped table-bordered" style="width: 100%;">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Reg Number</th>
                    <th>Name</th>
                    <th>C Score</th>
                    <th>Java Score</th>
                    <th>Python Score</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Include jQuery from a CDN -->

    <!-- Include Bootstrap JS from a CDN -->

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            $('#deptForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting traditionally

                var dept = $('#deptSelect').val();
                var batch = $('#batchSelect').val();
                $('#loading').show();

                // Fetch data from the HackerRank API for the selected department
                $.ajax({
                    url: 'fetch_scores.php',
                    type: 'POST',
                    data: {
                        dept: dept,
                        batch: batch
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Handle the JSON response here
                        $('#loading').hide();

                        // Populate the table with the received data
                        populateTable(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#loading').hide();
                    }
                });
            });

            // Initialize DataTable with buttons for Excel export
            $('#studentTable').DataTable({
                dom: 'Bfrtip', // Show buttons for Excel export
                buttons: [
                    'excelHtml5' // Excel button
                ]
            });
        });

        function populateTable(data) {
            var table = $('#studentTable').DataTable();
            table.clear().draw();

            var count = 1;
            $.each(data, function(index, student) {
                table.row.add([
                    count++,
                    student.regno,
                    student.name,
                    student.cScore,
                    student.javaScore,
                    student.pythonScore
                ]).draw();
            });
        }
    </script>
</body>

</html>