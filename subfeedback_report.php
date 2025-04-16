<?php
require_once 'feed_db_connection.php';
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subject-wise Feedback Report</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Subject-wise Feedback Report</h1>

    <form id="subject-form">
        <label for="subject">Select Subject:</label>
        <select name="subject" id="subject">
            <option value="">Select Subject</option>
            <?php
            // Retrieve the list of subjects from the database
            $sql = "SELECT subject_code, subject_name FROM subjects";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['subject_code'] . "'>" . $row['subject_code'] ." - ". $row['subject_name'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Generate Report</button>
    </form>

    <div id="report-container">
        <!-- Report data will be displayed here -->
    </div>

    <script>
        $(document).ready(function() {
            $('#subject-form').submit(function(event) {
                event.preventDefault();
                var selectedSubject = $('#subject').val();
                if (selectedSubject) {
                    $.ajax({
                        url: 'getsubfeedback_report.php',
                        type: 'POST',
                        data: { subject: selectedSubject },
                        success: function(data) {
                            $('#report-container').html(data);
                        },
                        error: function() {
                            alert('Error generating report.');
                        }
                    });
                } else {
                    alert('Please select a subject.');
                }
            });
        });
    </script>
</body>
</html>