<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student IDs</title>
    <style>

        .container {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h6>Upload CSV to Update Student IDs</h6>
        <form id="uploadForm">
            <input type="file" id="csvFile" name="csvFile" accept=".csv" required>
            <br>
            <button type="submit">Upload and Update</button>
        </form>
        <div class="message" id="message"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#uploadForm').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData();
                let file = $('#csvFile')[0].files[0];
                if (!file) {
                    $('#message').text('Please select a file.');
                    return;
                }
                formData.append('csvFile', file);

                $.ajax({
                    url: 'update_ids.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#message').html(response);
                    },
                    error: function () {
                        $('#message').text('An error occurred while uploading.');
                    }
                });
            });
        });
    </script>
</body>
</html>
