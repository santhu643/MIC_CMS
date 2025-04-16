<!DOCTYPE html>
<html lang="en">

<head>
   

<body>

    <!-- Feedback Management Page -->
    <div class="container-fluid mt-4">
    <!-- Button to Add Feedback -->
    <div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addFeedbackModal">Add Feedback</button>
</div>

        <!-- Feedback Table -->
        <table id="feedbackTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Feedback Name</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Feedback rows will be populated here -->
            </tbody>
        </table>
        <!-- Add Feedback Modal -->
        <div class="modal fade" id="addFeedbackModal" tabindex="-1" role="dialog"
            aria-labelledby="addFeedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFeedbackModalLabel">Add Feedback</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addFeedbackForm">
                            <div class="form-group">
                                <label for="feedbackName">Feedback Name:</label>
                                <input type="text" class="form-control" id="feedbackName" name="feedbackName" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Year:</label>
                                <input type="text" class="form-control" id="year" name="year" placeholder="ex:2023-2027" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department:</label>
                                <select class="form-control" id="department" name="department" required>
                                    <option value="all">All Departments</option>
                                    <option value="AIDS">Artificial Intelligence and Data Science</option>
                                    <option value="AIML">Artificial Intelligence and Machine Learning</option>
                                    <option value="CIVIL">Civil Engineering</option>
                                    <option value="CSE">Computer Science</option>
                                    <option value="CSBS">Computer Science and Business Systems</option>
                                    <option value="ECE">Electronics and Communication Engineering</option>
                                    <option value="EEE">Electrical and Electronics Engineering</option>
                                    <option value="IT">Information Technology</option>
                                    <option value="MECH">Mechanical Engineering</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subjects">Subjects:</label>
                                <select multiple class="form-control" id="subjects" name="subjects[]" required>
                                    <!-- Options will be populated here -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deadline">Deadline:</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Feedback</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>





    </div>





    <script>

        $(document).ready(function () {
            // Fetch and display feedbacks
            var table = $('#feedbackTable').DataTable();
            function loadFeedbacks() {
                $.get('feedback_management.php', { action: 'get_feedbacks' }, function (data) {
                    let feedbacks = JSON.parse(data);
                    let tableBody = $('#feedbackTable tbody');
                    tableBody.empty();
                    feedbacks.forEach(feedback => {
                        let row = `<tr>
                    <td>${feedback.feedback_name}</td>
                     <td>${feedback.department}</td>
                    <td>${feedback.year}</td>
                    <td>${feedback.deadline}</td>
                    <td>
                        
                        <button class="btn btn-danger btn-sm" onclick="deleteFeedback(${feedback.id})">Delete</button>
                    </td>
                </tr>`;
                        tableBody.append(row);
                    });
                    $('#feedbackTable').DataTable().clear().rows.add(tableBody.find('tr')).draw();
                });
            }

            // Load subjects for the select box
            function loadSubjects() {
                let department = $('#department').val();

                $.get('feedback_management.php', { action: 'get_subjects_drop', department: department }, function (data) {
                    let subjects = JSON.parse(data);
                    let selectBox = $('#subjects');
                    selectBox.empty();

                    // Group subjects by code
                    let groupedSubjects = {};
                    subjects.forEach(subject => {
                        if (!groupedSubjects[subject.subject_code]) {
                            groupedSubjects[subject.subject_code] = { subject_name: subject.subject_name, departments: [] };
                        }
                        groupedSubjects[subject.subject_code].departments.push(subject.department);
                    });

                    // Add subjects to select box
                    $.each(groupedSubjects, function (code, data) {
                        let departments = [...new Set(data.departments)]; // Unique departments
                        let option = `<option value="${code}">${data.subject_name} (${departments.join(', ')})</option>`;
                        selectBox.append(option);
                    });
                });
            }


            loadFeedbacks();
            $('#department').change(function () {
                loadSubjects();
            });

            // Call loadSubjects initially to load subjects for the default selected department
            loadSubjects();

            // Add Feedback Form Submission
            $('#addFeedbackForm').on('submit', function (e) {
                e.preventDefault();
                $.post('feedback_management.php', $(this).serialize() + '&action=add_feedback', function (response) {
                    let result = JSON.parse(response);
                    if (result.success) {
                        loadFeedbacks();
                        $('#addFeedbackModal').modal('hide');
                        $('#addFeedbackForm')[0].reset();
                    } else {
                        alert('Error: ' + result.error);
                    }
                });
            });

            // Placeholder functions for edit and delete actions
            window.editFeedback = function (feedbackId) {
                // Implement edit logic here
                alert('Edit feedback with ID: ' + feedbackId);
            };

            window.deleteFeedback = function (feedbackId) {
                if (confirm('Are you sure you want to delete this Feedback?')) {
                    $.ajax({
                        url: 'feedback_management.php',
                        type: 'POST',
                        data: {
                            id: feedbackId,
                            action: 'delete_feed'
                        },
                        dataType: 'json', // Expect JSON response
                        success: function (response) {
                            console.log(response);
                            if (response.status === 200) { // Corrected typo here
                                alert('Feedback Deleted Successfully.');
                                loadFeedbacks(); // Refresh the subject list
                            } else {
                                alert('Error deleting subject: ' + (response.message || 'Unknown error'));
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Server response:', xhr.responseText);
                            alert('An error occurred. Please check the console for details.');
                        }
                    });
                }
            };
        });

    </script>
</body>

</html>