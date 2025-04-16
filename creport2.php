<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counseling Summary</title>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .date-input-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-input {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: right;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Counseling Summary</h1>
        <div class="date-input-container">
            <label for="date-input">Select Date:</label>
            <input type="date" id="date-input" class="date-input">
            <button id="fetch-data" class="btn">Fetch Data</button>
        </div>

        <div class="summary-container">
            <table id="counseling-summary-table" class="table">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Batch</th>
                        <th>Student Count</th>
                        <th>Total Students</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="footer">
            <p>Data updated on <span id="update-timestamp"></span></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function fetchData() {
                var selectedDate = $('#date-input').val();

                // Make AJAX call to PHP script to fetch data
                $.ajax({
                    url: 'fetch_counseling_data.php',
                    type: 'POST',
                    data: { date: selectedDate },
                    dataType: 'json',
                    success: function (response) {
                        populateCounselingSummary(response);
                        updateTimestamp();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            function populateCounselingSummary(data) {
                var $summaryTable = $('#counseling-summary-table tbody');
                $summaryTable.empty();

                $.each(data, function (index, item) {
                    var $row = $('<tr>');
                    $row.append($('<td>').text(item.dept));
                    $row.append($('<td>').text(item.ayear));
                    $row.append($('<td>').text(item.attended_count));
                    $row.append($('<td>').text(item.total_students));
                    $summaryTable.append($row);
                });
            }

            function updateTimestamp() {
                var currentDate = new Date();
                var timestamp = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                $('#update-timestamp').text(timestamp);
            }

            $('#fetch-data').click(function () {
                fetchData();
            });

            // Initial data fetch
            fetchData();
        });
    </script>
</body>

</html>