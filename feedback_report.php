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
// Add a new function to handle AJAX requests
function handleAjaxRequest($conn)
{
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'fetch_subjects':
                if (isset($_POST['feedback_id'])) {
                    $feedback_id = $_POST['feedback_id'];
                    $subject_query = "
        SELECT s.id, s.subject_name 
        FROM subjects s
        JOIN feedback_subjects fs ON fs.subject_id = s.id
        WHERE fs.feedback_id = $feedback_id";
        $result = mysqli_query($conn,  $subject_query);
    
        $options = "<option value=''>Select a subject</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $options .= "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['subject_name']) . "</option>";
        }
        
        echo $options;
                }
                exit;
            case 'generate_report':
                if (isset($_POST['feedback_id']) && isset($_POST['subject_id'])) {
                    $feedback_id = $_POST['feedback_id'];
                    $subject_id = $_POST['subject_id'];

                    // Define a fixed number of columns (e.g., CO1 to CO7)
                    $max_columns = 7;

                    // Get all unique subjects for this feedback
                    $subject_query = "
                        SELECT DISTINCT subj.subject_name
                        FROM feedback_subjects fs
                        JOIN subjects subj ON fs.subject_id = subj.id
                        WHERE fs.feedback_id = ?
                        ORDER BY subj.subject_name
                    ";

                    $stmt = mysqli_prepare($conn, $subject_query);
                    mysqli_stmt_bind_param($stmt, "i", $feedback_id);
                    mysqli_stmt_execute($stmt);
                    $subject_result = mysqli_stmt_get_result($stmt);

                    $data = [];
                    while ($row = mysqli_fetch_assoc($subject_result)) {
                        $subject_name = $row['subject_name'];
                        $data[$subject_name] = [
                            'student_responses' => [],
                            'column_indices' => []
                        ];
                    }

                    // Get the student responses
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
                                'responses' => array_fill(0, $max_columns, '')
                            ];
                        }

                        $data[$subject_name]['student_responses'][$student_id]['responses'][$column_index] = $row['response'];
                    }

                    // Calculate summary data
                    $summaryData = calculateSubjectSummaryData($data);

                    // Prepare the response
                    $response = [
                        'detailedReport' => $data,
                        'summaryReport' => $summaryData
                    ];

                    // Send the JSON response
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }

        }
    }
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    handleAjaxRequest($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback Report</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>

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
    </style>
</head>

<body>
    <div class="container my-5">
        <form id="report-form" class="mb-4">
            <div class="form-group">
                <label for="feedback_id">Select Feedback:</label>
                <select class="form-control" id="feedback_id" name="feedback_id">
                    <option value="">Select a Feedback</option>
                    <?php
                    $feedback_query = "SELECT id, feedback_name FROM feedbacks";
                    $feedback_result = mysqli_query($conn, $feedback_query);
                    while ($row = mysqli_fetch_assoc($feedback_result)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['feedback_name']) . "</option>";
                    }
                    ?>
                </select>

                <select class="form-control" id="subject_id" name="subject_id">
                    <option value="">Select a subject</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        <!-- Loader -->
        <div id="loader" style="display: none; text-align: center; margin-top: 20px;">
            <p>Fetching feedback report, please wait...</p>
        </div>

        <div id="report-container" style="display: none;">
            <h2>Detailed Report</h2>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="report-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Department</th>
                            <th>Subject</th>
                            <?php for ($i = 1; $i <= 7; $i++) { ?>
                                <th>CO<?php echo $i; ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <h2 class="mt-5">Subject-wise Summary Report</h2>
            <div id="summary-container"></div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#feedback_id').change(function () {
                var feedbackId = $(this).val();
                if (feedbackId) {
                    $.ajax({
                        url: window.location.href,
                        type: 'POST',
                        data: {
                            action: 'fetch_subjects',
                            feedback_id: feedbackId
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

                if (feedbackId && subjectId) {
                    $('#loader').show();
                    $('#report-container').hide();

                    $.ajax({
                        url: window.location.href,
                        type: 'POST',
                        data: {
                            action: 'generate_report',
                            feedback_id: feedbackId,
                            subject_id: subjectId
                        },
                        success: function (response) {
                            var data = JSON.parse(response);
                            updateDetailedReport(data.detailedReport);
                            updateSummaryReport(data.summaryReport);
                            $('#loader').hide();
                            $('#report-container').show();
                        },
                        error: function () {
                            alert('An error occurred while fetching the report.');
                            $('#loader').hide();
                        }
                    });
                } else {
                    alert('Please select both a feedback and a subject.');
                }
            });

            function updateDetailedReport(data) {
                var table = $('#report-table').DataTable();
                table.clear();

                $.each(data, function (subject_name, subject_data) {
                    $.each(subject_data.student_responses, function (student_id, student_info) {
                        var row = [
                            student_id,
                            student_info.student_name,
                            student_info.student_department,
                            subject_name
                        ];
                        row = row.concat(student_info.responses);
                        table.row.add(row);
                    });
                });

                table.draw();
            }

            function updateSummaryReport(data) {
                var container = $('#summary-container');
                container.empty();

                $.each(data, function (subject_name, summary) {
                    var subjectHtml = '<h3 class="mt-4">' + subject_name + '</h3>';
                    subjectHtml += '<p>Total number of students: ' + summary.totalStudents + '</p>';
                    subjectHtml += '<div class="table-responsive">';
                    subjectHtml += '<table class="table table-striped table-bordered summary-table">';
                    subjectHtml += '<thead><tr><th>Course Outcome</th><th>Rating 4</th><th>Rating 3</th><th>Rating 2</th><th>Rating 1</th></tr></thead>';
                    subjectHtml += '<tbody>';

                    $.each(summary, function (coIndex, coData) {
                        if (coIndex !== 'totalStudents') {
                            subjectHtml += '<tr>';
                            subjectHtml += '<td>CO' + (parseInt(coIndex) + 1) + '</td>';
                            for (var rating = 4; rating >= 1; rating--) {
                                subjectHtml += '<td>' + coData[rating][0] + ' (' + coData[rating][1] + '%)</td>';
                            }
                            subjectHtml += '</tr>';
                        }
                    });

                    subjectHtml += '</tbody></table></div>';
                    container.append(subjectHtml);
                });

                $('.summary-table').DataTable({
                    "paging": false,
                    "searching": false,
                    "info": false,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: 'Download Summary as Excel',
                            filename: function (node) {
                                return 'Feedback_summary_' + $(node).closest('.table-responsive').prev('h3').text().trim();
                            },
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ]
                });

                $('.buttons-excel').addClass('btn-success');
            }

            $('#report-table').DataTable({
                "pageLength": 25,
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                "order": [[0, "asc"], [2, "asc"], [3, "asc"]],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Download Detailed Report as Excel',
                        filename: 'Feedback_detailed_report',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });

            $('.buttons-excel').addClass('btn-success');
        });
    </script>
</body>

</html>