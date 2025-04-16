<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }

        #addFeedbackBtn {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Feedback Management System</h2>
        <button id="addFeedbackBtn" class="btn btn-primary float-right">Add Feedback</button>
        <div class="table-responsive">
            <table id="feedbackTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Event Level</th>
                        <th>Date</th>
                        <th>Target Audience</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Add Feedback</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="feedbackForm">
                        <input type="hidden" id="feedbackId">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="targetAudience">Target Audience</label>
                            <select class="form-control" id="targetAudience" required>
                                <option value="students">Students</option>
                                <option value="faculty">Faculty</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departments">Departments</label>
                            <select class="form-control" id="departments" multiple required>
                                <option value="all">All Departments</option>
                                <?php
                                $sql = "SELECT * FROM departments";
                                $result = mysqli_query($db, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['dname'] . "'>" . $row['dname'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveFeedback">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            loadFeedbackData();

            $('#addFeedbackBtn').click(function () {
                $('#feedbackModal').modal('show');
                $('#feedbackForm')[0].reset();
                $('#feedbackId').val('');
                $('#feedbackModalLabel').text('Add Feedback');
            });

            $('#saveFeedback').click(function () {
                var id = $('#feedbackId').val();
                var title = $('#title').val();
                var targetAudience = $('#targetAudience').val();
                var departments = $('#departments').val().join(',');

                $.ajax({
                    url: 'event_feedback_backend.php',
                    type: 'POST',
                    data: {
                        id: id,
                        title: title,
                        target_audience: targetAudience,
                        departments: departments,
                        action:'save_feedback' 
                    },
                    success: function (response) {
                        var feedback = JSON.parse(response);
                        console.log(feedback);
                        $('#feedbackModal').modal('hide');
                        loadFeedbackData();
                    }
                });
            });

            $(document).on('click', '.edit-feedback', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: 'event_feedback_backend.php',
                    type: 'GET',
                    data: { id: id,action:'get_feedback' },
                    success: function (response) {
                        var feedback = JSON.parse(response);
                        $('#feedbackId').val(feedback.id);
                        $('#title').val(feedback.title);
                        $('#targetAudience').val(feedback.target_audience);
                        $('#departments').val(feedback.organizer.split(','));
                        $('#feedbackModal').modal('show');
                        $('#feedbackModalLabel').text('Edit Feedback');
                    }
                });
            });

            $(document).on('click', '.delete-feedback', function () {
                if (confirm('Are you sure you want to delete this feedback?')) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'event_feedback_backend.php',
                        type: 'POST',
                        data: { id: id, action:'delete_feedback' },
                        success: function (response) {
                            loadFeedbackData();
                        }
                    });
                }
            });
        });

        function loadFeedbackData() {
            $.ajax({
                url: 'event_feedback_backend.php',
                type: 'GET',
                data: { action: 'get_all_feedback' },  // Added data property for the action
                success: function (response) {
                    $('#feedbackTable tbody').html(response);
                }
            });
        }

    </script>
</body>

</html>