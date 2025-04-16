<?php
require_once 'feed_db_connection.php';
require_once 'config.php';

function calculateSubjectSummaryData($data)
{
    $summary = [];

    foreach ($data as $subject_name => $subject_data) {
        $summary[$subject_name] = [];
        $totalStudents = count($subject_data['student_responses']);

        foreach ($subject_data['student_responses'] as $student_info) {
            foreach ($student_info['responses'] as $coIndex => $response) {
                if (!isset($summary[$subject_name][$coIndex])) {
                    $summary[$subject_name][$coIndex] = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 'total' => 0];
                }
                if (in_array($response, [1, 2, 3, 4])) {
                    $summary[$subject_name][$coIndex][$response]++;
                    $summary[$subject_name][$coIndex]['total']++;
                }
            }
        }

        // Calculate percentages
        foreach ($summary[$subject_name] as &$coData) {
            foreach ($coData as $rating => &$count) {
                if ($rating !== 'total') {
                    $percentage = ($count / $coData['total']) * 100;
                    $count = [$count, round($percentage, 2)];
                }
            }
        }

        $summary[$subject_name]['totalStudents'] = $totalStudents;
    }

    return $summary;
}

function generateReport($feedback_id, $subject_id)
{
    global $conn;
    $data = [];

    // First, let's get the subjects and their question counts
    $subject_query = "
        SELECT DISTINCT subj.subject_name, COUNT(DISTINCT q.id) as question_count
        FROM feedback_subjects fs
        JOIN subjects subj ON fs.subject_id = subj.id
        LEFT JOIN questions q ON q.subject_id = subj.id
        WHERE fs.feedback_id = ? AND fs.subject_id = ?
        GROUP BY subj.subject_name
        ORDER BY subj.subject_name
    ";
    $stmt = mysqli_prepare($conn, $subject_query);
    mysqli_stmt_bind_param($stmt, "ii", $feedback_id, $subject_id);
    mysqli_stmt_execute($stmt);
    $subject_result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($subject_result)) {
        $subject_name = $row['subject_name'];
        $question_count = $row['question_count'];
        $data[$subject_name] = [
            'student_responses' => [],
            'column_indices' => [],
            'question_count' => $question_count
        ];
    }

    $report_query = "
        SELECT
            sr.student_id,
            s.sname AS student_name,
            s.dept AS student_department,
            subj.subject_name,
            q.id AS question_id,
            sr.response
        FROM feedback_subjects fs
        JOIN subjects subj ON fs.subject_id = subj.id
        JOIN questions q ON q.subject_id = subj.id
        JOIN student_responses sr ON sr.question_id = q.id
        JOIN mic.student s ON sr.student_id = s.sid
        WHERE fs.feedback_id = ? AND fs.subject_id = ?
        ORDER BY s.sname, subj.subject_name, q.id
    ";
    $stmt = mysqli_prepare($conn, $report_query);
    mysqli_stmt_bind_param($stmt, "ii", $feedback_id, $subject_id);
    mysqli_stmt_execute($stmt);
    $report_result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($report_result)) {
        $student_id = $row['student_id'];
        $student_name = $row['student_name'];
        $student_department = $row['student_department'];
        $subject_name = $row['subject_name'];
        $question_id = $row['question_id'];

        if (!isset($data[$subject_name]['column_indices'][$question_id])) {
            $data[$subject_name]['column_indices'][$question_id] = count($data[$subject_name]['column_indices']);
        }
        $column_index = $data[$subject_name]['column_indices'][$question_id];

        if (!isset($data[$subject_name]['student_responses'][$student_id])) {
            $data[$subject_name]['student_responses'][$student_id] = [
                'student_name' => $student_name,
                'student_department' => $student_department,
                'responses' => array_fill(0, $data[$subject_name]['question_count'], '')
            ];
        }
        $data[$subject_name]['student_responses'][$student_id]['responses'][$column_index] = $row['response'];
    }

    $max_columns = max(array_map(function($subject) {
        return $subject['question_count'];
    }, $data));

    return [
        'data' => $data,
        'subjectSummary' => calculateSubjectSummaryData($data),
        'max_columns' => $max_columns
    ];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'generate_report') {
        $feedback_id = $_POST['feedback_id'];
        $subject_id = $_POST['subject_id'];

        $report = generateReport($feedback_id, $subject_id);

        header('Content-Type: application/json');
        echo json_encode($report);
        exit;
    }
}
?>


<html lang="en">
<head>

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> -->
<!-- 
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->
    <style>
        .download-btn {
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .summary-table {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-5">
        <form id="report-form" class="mb-4">
            <div class="form-group">
                <label for="feedback_id">Select Feedback:</label>
                <select class="form-control" id="feedback_id" name="feedback_id">
                    <option value="">Select a Feedback</option>
                    <?php
                    // Fetch feedback options
                    $feedback_query = "SELECT id, feedback_name FROM feedbacks where `sid`='$s'";
                    $feedback_result = mysqli_query($conn, $feedback_query);
                    while ($row = mysqli_fetch_assoc($feedback_result)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['feedback_name']) . "</option>";
                    }
                    ?>
                </select>

                <label for="subject_id" class="mt-3">Select Subject:</label>
                <select class="form-control" id="subject_id" name="subject_id">
                    <option value="">Select a Subject</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        <!-- Loader -->
        <div id="loader" style="display: none; text-align: center; margin-top: 20px;">
            <p>Fetching feedback report, please wait...</p>
        </div>

        <div id="report-container" style="display:none;">
            <h2>Detailed Report</h2>
            <div id="download-buttons">
                <button onclick="downloadCSV()" class="btn btn-success download-btn">Download CSV</button>
                <!-- <button onclick="printReport()" class="btn btn-success download-btn">Print Report</button> -->
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="report-table">
                    <thead>
                        <tr id="report-thead"></tr>
                    </thead>
                    <tbody id="report-tbody"></tbody>
                </table>
            </div>

            <div id="summary-container">
                <h2 class="mt-5">Subject-wise Summary Report</h2>
                <div id="summary-download-buttons">
                    <button onclick="downloadSummaryCSV()" class="btn btn-success download-btn">Download Summary CSV</button>
                    <!-- <button onclick="printSummary()" class="btn btn-success download-btn">Print Summary</button> -->
                </div>
                <div id="summary-tables"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let reportTable;

            $('#feedback_id').change(function () {
                var feedbackId = $(this).val();
                if (feedbackId) {
                    $.ajax({
                        url: 'feedback_management.php',
                        type: 'POST',
                        data: {
                            feedback_id: feedbackId,
                            action: 'fetch_subjects'
                        },
                        success: function (data) {
                            $('#subject_id').html(data);
                        }
                    });
                } else {
                    $('#subject_id').html('<option value="">Select a subject</option>');
                }
            });

            $('#report-form').submit(function (e) {
                e.preventDefault();

                var feedbackId = $('#feedback_id').val();
                var subjectId = $('#subject_id').val();

                if (!feedbackId || !subjectId) {
                    alert('Please select both feedback and subject.');
                    return;
                }

                $('#loader').show();
                $('#report-container').hide();

                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#report-table')) {
                    $('#report-table').DataTable().destroy();
                }

                // Clear the table completely
                $('#report-table').empty();

                $.ajax({
                    url: 'feedback_report2.php',
                    type: 'POST',
                    data: { action: 'generate_report', feedback_id: feedbackId, subject_id: subjectId },
                    cache: false,
                    success: function (response) {
                        $('#loader').hide();

                        if (response.data) {
                            $('#report-container').show();

                            // Recreate table structure
                            $('#report-table').html('<thead><tr id="report-thead"></tr></thead><tbody id="report-tbody"></tbody>');

                            // Add header row
                            var headerRow = '<th>Student ID</th><th>Student Name</th><th>Department</th><th>Subject</th>';
                            for (var i = 1; i <= response.max_columns; i++) {
                                headerRow += '<th>Q' + i + '</th>';
                            }
                            $('#report-thead').html(headerRow);

                            // Add data rows
                            $.each(response.data, function (subjectName, subjectData) {
                                $.each(subjectData.student_responses, function (studentId, studentInfo) {
                                    var row = '<tr>' +
                                        '<td>' + studentId + '</td>' +
                                        '<td>' + studentInfo.student_name + '</td>' +
                                        '<td>' + studentInfo.student_department + '</td>' +
                                        '<td>' + subjectName + '</td>';

                                    for (var i = 0; i < response.max_columns; i++) {
                                        row += '<td>' + (studentInfo.responses[i] || '') + '</td>';
                                    }

                                    row += '</tr>';
                                    $('#report-tbody').append(row);
                                });
                            });

                            // Initialize new DataTable
                            reportTable = $('#report-table').DataTable({
                                "paging": true,
                                "ordering": true,
                                "info": true,
                                "searching": true,
                                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                            });

                            // Clear and add summary tables
                            $('#summary-tables').empty();
                            $.each(response.subjectSummary, function (subjectName, coData) {
                                var summaryTable = '<table class="table table-striped table-bordered mt-3 summary-table" data-subject="' + subjectName + '">';
                                summaryTable += '<thead><tr><th colspan="6">Subject: ' + subjectName + '</th></tr>';
                                summaryTable += '<tr><th>CO</th><th>1</th><th>2</th><th>3</th><th>4</th><th>Total</th></tr></thead><tbody>';

                                for (var coIndex in coData) {
                                    if (coIndex !== 'totalStudents') {
                                        summaryTable += '<tr><td>CO' + coIndex + '</td>';
                                        for (var rating = 1; rating <= 4; rating++) {
                                            var countData = coData[coIndex][rating];
                                            summaryTable += '<td>' + countData[0] + ' (' + countData[1] + '%)</td>';
                                        }
                                        summaryTable += '<td>' + coData[coIndex].total + '</td></tr>';
                                    }
                                }

                                summaryTable += '</tbody></table>';
                                $('#summary-tables').append(summaryTable);
                            });

                        } else {
                            alert('No data found for the selected feedback and subject.');
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#loader').hide();
                        console.error('Ajax error:', status, error);
                        alert('Error generating report. Please check the console for more details.');
                    }
                });
            });
        });

        function downloadCSV() {
            var csv = [];
            var rows = document.querySelectorAll("#report-table tr");
            
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                
                for (var j = 0; j < cols.length; j++) 
                    row.push(cols[j].innerText);
                
                csv.push(row.join(","));        
            }

            // Download CSV file
            downloadCSVFile(csv.join("\n"), "feedback_report.csv");
        }

        function downloadSummaryCSV() {
            var csv = [];
            var tables = document.querySelectorAll(".summary-table");
            
            tables.forEach(function(table) {
                var subject = table.getAttribute('data-subject');
                csv.push("Subject: " + subject);
                
                var rows = table.querySelectorAll("tr");
                for (var i = 1; i < rows.length; i++) { // Start from 1 to skip the subject header
                    var row = [], cols = rows[i].querySelectorAll("td, th");
                    for (var j = 0; j < cols.length; j++) 
                        row.push(cols[j].innerText.replace(/,/g, ';')); // Replace commas with semicolons to avoid CSV issues
                    csv.push(row.join(","));
                }
                csv.push(""); // Empty line between subjects
            });

            // Download CSV file
            downloadCSVFile(csv.join("\n"), "feedback_summary_report.csv");
        }

        function downloadCSVFile(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], {type: "text/csv"});

            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = "none";

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }

        function printReport() {
            window.print();
        }

        function printSummary() {
            var printContents = document.getElementById('summary-container').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>