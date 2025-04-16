<?php
require 'config.php';
include("session.php");

?>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>MIC</title>
    <!-- Custom CSS -->
    <link href="assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
    <link href="assets/libs/jquery-steps/steps.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">



    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .alertify-notifier .ajs-error {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
        }

        .alertify-notifier .ajs-success {
            background: blue;
            color: #ffffff;
        }
        th{
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); !important
            color:white; !important
        }

        .btn-link {
    font-weight: bold;
    text-decoration: none;
    color: #007bff;
    padding: 10px 15px;
    width: 100%;
    text-align: left;
}

.btn-link:hover {
    text-decoration: none;
    color: #0056b3;
}

.btn-link.collapsed .fa-chevron-down {
    transform: rotate(0deg);
    transition: transform 0.3s ease;
}

.btn-link:not(.collapsed) .fa-chevron-down {
    transform: rotate(-180deg);
    transition: transform 0.3s ease;
}

    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="smain">
                        <span class="logo-text">
                            <img src="assets/images/srms33333.png" alt="homepage" class="light-logo" />
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                    </ul>
                    <ul class="navbar-nav float-right">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">

                                <a class="dropdown-item" href="Logout.php"><i class="ti-power-off m-r-5 m-l-5"></i>
                                    Logout</a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
        include("sside.php");

        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">FeedBack Corner</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">FeedBack Corner</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

            <div class="card">
            <div class="card-body wizard-content">
                <div class="container-fluid mt-3">
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
    </div>
    </div>

                <!-- Feedback Modal -->
                <div class="modal fade" id="feedbackModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="color:blue;">
                                <h5 class="modal-title">Submit Feedback</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                            </div>
                            <div class="modal-body">
                                <form id="feedbackForm">
                                    <!-- Feedback ID and questions will be inserted here dynamically -->
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="submitFeedback">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>



    <?php include "./footer.html" ?>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(document).ready(function() {
    $('#feedbackTable').DataTable();
});

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
        success: function (data) {
            let tableBody = $('#feedbackTable tbody');
            tableBody.empty(); // Clear existing rows

            // Loop through feedbacks and add rows
            data.forEach(feedback => {
                let row = `
                    <tr>
                        <td>${feedback.feedback_name}</td>
                        <td>${feedback.year}</td>
                        <td>${feedback.deadline}</td>
                        <td><button class="btn btn-primary btn-sm view-feedback" data-id="${feedback.id}">View</button></td>
                    </tr>`;
                tableBody.append(row);
            });

            // Redraw the table to reflect new data
            $('#feedbackTable').DataTable().clear().rows.add(tableBody.find('tr')).draw();
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
                    <div class="card">
                        <div class="card-header" id="heading${subject.id}">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#subject${subject.id}" aria-expanded="false" aria-controls="subject${subject.id}">
                                    ${subject.subject_name}
                                    <span class="float-right">
                                        <i class="fa fa-chevron-down"></i>
                                    </span>
                                </button>
                            </h5>
                        </div>
                        <div id="subject${subject.id}" class="collapse" aria-labelledby="heading${subject.id}" data-parent="#feedbackForm">
                            <div class="card-body">
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
                        loadFeedbacks();
                        $('#feedbackModal').modal('hide');
                       
                    } else {
                        alert((response.message || 'Unknown error'));
                       $('#feedbackModal').modal('hide');
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