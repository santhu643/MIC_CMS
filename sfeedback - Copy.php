<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h4>Available Feedbacks</h4>
        <table class="table table-striped" id="feedbackTable">
            <thead>
                <tr>
                    <th>Feedback Name</th>
                    <th>Year</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Feedback rows will be inserted here dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="feedbackForm">
                        <!-- Feedback ID and questions will be inserted here dynamically -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitFeedback">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load available feedbacks
            loadFeedbacks();

            // Handle view button click
            $(document).on('click', '.view-feedback', function() {
                const feedbackId = $(this).data('id');
                loadFeedbackDetails(feedbackId);
            });

            // Handle submit button click
            $('#submitFeedback').click(function() {
                if (validateFeedbackForm()) {
                    submitFeedback();
                } else {
                    alert('Please answer all questions.');
                }
            });
        });

        function loadFeedbacks() {
            $.ajax({
                url: 'get_feedbacks.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let rows = '';
                    data.forEach(feedback => {
                        rows += `
                            <tr>
                                <td>${feedback.feedback_name}</td>
                                <td>${feedback.year}</td>
                                <td>${feedback.deadline}</td>
                                <td><button class="btn btn-primary btn-sm view-feedback" data-id="${feedback.id}">View</button></td>
                            </tr>
                        `;
                    });
                    $('#feedbackTable tbody').html(rows);
                }
            });
        }

        function loadFeedbackDetails(feedbackId) {
            $.ajax({
                url: 'get_feedback_details.php',
                type: 'GET',
                data: { feedback_id: feedbackId },
                dataType: 'json',
                success: function(data) {
                    let formContent = '';
                    data.subjects.forEach(subject => {
                        formContent += `
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#subject${subject.id}">
                                        ${subject.subject_name}
                                    </button>
                                </h2>
                                <div id="subject${subject.id}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                        `;
                        subject.questions.forEach(question => {
                            formContent += `
                                <div class="mb-3">
                                    <label class="form-label">${question.question}</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="q${question.id}" value="4" required>
                                            <label class="form-check-label">4</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="q${question.id}" value="3" required>
                                            <label class="form-check-label">3</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="q${question.id}" value="2" required>
                                            <label class="form-check-label">2</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="q${question.id}" value="1" required>
                                            <label class="form-check-label">1</label>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        formContent += `
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#feedbackForm').html(`
                        <input type="hidden" id="feedbackIdInput" name="feedback_id" value="${feedbackId}">
                        ${formContent}
                    `);
                    $('#feedbackModal').modal('show');
                }
            });
        }

        function validateFeedbackForm() {
            let valid = true;
            $('#feedbackForm').find('div.mb-3').each(function() {
                const questionId = $(this).find('input[type="radio"]').attr('name');
                if ($(`input[name="${questionId}"]:checked`).length === 0) {
                    valid = false;
                    $(this).find('label.form-label').css('color', 'red');  // Highlight missing fields
                } else {
                    $(this).find('label.form-label').css('color', '');  // Remove highlight
                }
            });
            return valid;
        }

        function submitFeedback() {
            const formData = $('#feedbackForm').serializeArray();
            console.log("Form data:", formData);  // Log the form data
            $.ajax({
                url: 'submit_feedback.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    console.log("Server response:", response);  // Log the server response
                    if (response.success) {
                        alert('Feedback submitted successfully');
                        $('#feedbackModal').modal('hide');
                    } else {
                        alert('Error submitting feedback: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX error:", textStatus, errorThrown);
                    alert('Error submitting feedback: ' + textStatus);
                }
            });
        }
    </script>
</body>
</html>
