<!DOCTYPE html>
<html lang="en">

<head>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</head>

<body>
    <div class="container-fluid mt-4">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="add-subjects-tab" data-toggle="tab" href="#add-subjects" role="tab"
                    aria-controls="add-subjects" aria-selected="true">Add Subjects</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="add-feedbacks-tab" data-toggle="tab" href="#add-feedbacks" role="tab"
                    aria-controls="add-subjects" aria-selected="true">Add Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="add-reports-tab" data-toggle="tab" href="#add-reports" role="tab"
                    aria-controls="add-subjects" aria-selected="true">Feedback Report</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="ns-reports-tab" data-toggle="tab" href="#ns-reports" role="tab"
                    aria-controls="add-subjects" aria-selected="true">Not Submitted Report</a>
            </li>
            <!-- Other tabs here -->
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Add Subjects Tab -->
            <div class="tab-pane fade show active" id="add-subjects" role="tabpanel" aria-labelledby="add-subjects-tab">

                <div class="row mb-3">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">Add
                            Subject</button>

                    </div>
                </div>

                <table class="table table-striped table-bordered py-4" id="subjectsTable">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Department</th>
                            <th>Questions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated dynamically -->
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade show" id="add-feedbacks" role="tabpanel" aria-labelledby="add-feedbacks-tab">
                <?php include "add_feedback.php"; ?>
            </div>

            <div class="tab-pane fade show" id="add-reports" role="tabpanel" aria-labelledby="add-feedbacks-tab">
                <?php include "feedback_report2.php"; ?>
            </div>

            <div class="tab-pane fade show" id="ns-reports" role="tabpanel" aria-labelledby="add-feedbacks-tab">
                <?php include "notsubmitted.php"; ?>
            </div>
        </div>
    </div>



    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSubjectForm">
                        <div class="form-group">
                            <label for="subjectCode">Subject Code:</label>
                            <input type="text" class="form-control" id="subjectCode" name="subjectCode" required>
                        </div>
                        <div class="form-group">
                            <label for="subjectName">Subject Name:</label>
                            <input type="text" class="form-control" id="subjectName" name="subjectName" required>
                        </div>
                        <div class="form-group">
                            <label>Departments:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="IT" name="departments[]" value="IT">
                                <label class="form-check-label" for="IT">IT</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="CSE" name="departments[]"
                                    value="CSE">
                                <label class="form-check-label" for="CSE">CSE</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="MECH" name="departments[]"
                                    value="MECH">
                                <label class="form-check-label" for="MECH">MECH</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ECE" name="departments[]"
                                    value="ECE">
                                <label class="form-check-label" for="ECE">ECE</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="EEE" name="departments[]"
                                    value="EEE">
                                <label class="form-check-label" for="EEE">EEE</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="AIDS" name="departments[]"
                                    value="AIDS">
                                <label class="form-check-label" for="AIDS">AIDS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="AIML" name="departments[]"
                                    value="AIML">
                                <label class="form-check-label" for="AIML">AIML</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="CIVIL" name="departments[]"
                                    value="CIVIL">
                                <label class="form-check-label" for="CIVIL">CIVIL</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="CSBS" name="departments[]"
                                    value="CSBS">
                                <label class="form-check-label" for="CSBS">CSBS</label>
                            </div>
                        </div>
                        <div id="questionsContainer">
                            <div class="form-group">
                                <label for="question">Question:</label>
                                <input type="text" class="form-control question-input" name="questions[]"
                                    placeholder="Enter a question">
                            </div>
                        </div>
                        <button type="button" id="addQuestionBtn" class="btn btn-secondary">+ Add Question</button>
                        <button type="submit" class="btn btn-primary">Add Subject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Modal -->
    <div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionsModalLabel">Questions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Questions will be dynamically loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#subjectsTable').DataTable();

            // Fetch and display subjects
            function loadSubjects() {
                $.ajax({
                    url: 'feedback_management.php',
                    type: 'GET',
                    data: { action: 'get_subjects' },
                    success: function (data) {

                        let subjects = JSON.parse(data);
                        let tableBody = $('#subjectsTable tbody');
                        tableBody.empty(); // Clear existing rows

                        // Loop through subjects and add rows
                        subjects.forEach(subject => {
                            // Join questions into a single string with <br> tags
                            let questions = subject.questions.map(q => q.replace(/</g, "&lt;").replace(/>/g, "&gt;")).join('<br>');
                            let row = `
                    <tr>
                        <td>${subject.subject_code}</td>
                        <td>${subject.subject_name}</td>
                        <td>${subject.department}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-questions="${questions}" onclick="viewQuestions(this)">View Questions</button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteSubject(${subject.id})">Delete</button>
                        </td>
                    </tr>`;
                            tableBody.append(row);
                        });

                        // Redraw the table to reflect new data
                        $('#subjectsTable').DataTable().clear().rows.add(tableBody.find('tr')).draw();
                    }
                });
            }

            loadSubjects();

            // Add Subject
            $('#addSubjectForm').on('submit', function (e) {
                e.preventDefault();
                $.post('feedback_management.php', $(this).serialize() + '&action=add_subject', function (response) {
                    let result = JSON.parse(response);
                    if (result.success) {
                        loadSubjects();
                        $('#addSubjectModal').modal('hide');
                        $('#addSubjectForm')[0].reset();
                    } else {
                        alert('Error: ' + result.error);
                    }
                });
            });

            // Add Question Button
            $('#addQuestionBtn').on('click', function () {
                $('#questionsContainer').append(
                    `<div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control question-input" name="questions[]" placeholder="Enter a question">
            </div>`
                );
            });

            // Placeholder functions for edit and delete actions
            window.editSubject = function (subjectId) {
                // Implement edit logic here
                alert('Edit subject with ID: ' + subjectId);
            };
            window.deleteSubject = function (subjectId) {
                if (confirm('Are you sure you want to delete this subject?')) {
                    $.ajax({
                        url: 'feedback_management.php',
                        type: 'POST',
                        data: {
                            id: subjectId,
                            action: 'delete_sub'
                        },
                        dataType: 'json', // Expect JSON response
                        success: function (response) {
                            console.log(response);
                            if (response.status === 200) { // Corrected typo here
                                alert('Subject deleted successfully.');
                                loadSubjects(); // Refresh the subject list
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



        function viewQuestions(button) {
            let questions = $(button).data('questions').split('<br>');
            let modalBody = $('#questionsModal .modal-body');

            // Create a list of questions with bullet points
            let questionList = '<ul>';
            questions.forEach(question => {
                questionList += `<li>${question}</li>`;
            });
            questionList += '</ul>';

            modalBody.html(questionList); // Set the content with bullet points
            $('#questionsModal').modal('show');
        }



    </script>
</body>

</html>