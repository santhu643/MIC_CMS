<html>

<head>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>

</head>

</html>

<?php
include("config.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $myusername = mysqli_real_escape_string($db, $_POST['email']);
    $mypassword = mysqli_real_escape_string($db, $_POST['pass']);

    
   

    if ($type == "faculty") {
                if ($myusername == "hroffice" || $myusername == "hr" || $myusername == "busadmin" || $myusername=="principal" || $myusername == "civil" || $myusername == "electrical" || $myusername == "itkm" || $myusername == "transport" || $myusername == "house") {
            $sql = "SELECT * FROM ofaculty WHERE uname = ? AND pass = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $myusername, $mypassword);
        } else {
            $sql = "SELECT * FROM faculty WHERE id = ? AND pass = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("ss", $myusername, $mypassword);
        }
    } elseif ($type == "student") {
        $sql = "SELECT * FROM student WHERE sid = ? AND pass = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $myusername, $mypassword);
    }
    else {
        // Handle invalid type
        echo "<script>
                swal.fire({
                    icon: 'error',
                    title: 'Login Failure',
                    text: 'Invalid user type'
                }).then(function() {
                    window.location = 'index';
                });
              </script>";
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if ($count == 1) {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['login_user'] = $myusername;

        $redirectUrl = ($type == "student") ? "smain" : 
    (($myusername == "hroffice") ? "hr" : 
    (($myusername == "principal") ? "p_index" : 
    (($myusername == "hr") ? "Codes/HRM/HR/dash.php" : 
    (($myusername == "busadmin") ? "busadmin/index" : 
    (in_array($myusername, ["civil", "electrical", "itkm", "transport", "house"]) ? "windex" : "main")))));

        echo "<script>
                swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Login Successful'
                }).then(function() {
                    window.location = '$redirectUrl';
                });
              </script>";
    } else {
        echo "<script>
                swal.fire({
                    icon: 'error',
                    title: 'Login Failure',
                    text: 'Check login credentials'
                }).then(function() {
                    window.location = 'index';
                });
              </script>";
    }

    $stmt->close();
}
?>
<html dir="ltr">

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
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tabler-ui/dist/css/tabler.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tabler-ui/dist/js/tabler.min.js"></script>
</head>


<style>
    /* Custom styling for tabs */
    .custom-tabs {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .custom-tab-content {
        padding: 20px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0 0 0.25rem 0.25rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .custom-tab-content .form-horizontal {
        max-width: 400px;
        margin: 0 auto;
    }

    /* Active tab styling */
    .nav-link.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out, border-color 0.2s ease-in-out;
    }

    .nav-tabs .nav-link:hover {
        background-color: #e9ecef;
    }
</style>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark"
            style="margin: 0; padding: 0;">

            <div class="auth-box bg-dark border-top border-secondary" style="margin: 0; padding: 0;">

                <div id="loginform">

                    <div class="text-center p-t-10 p-b-10">
                        <h2 style="color:white"><b>MKCE Info Corner</b> </h2>
                        <span class="db"><img src="assets/images/logo2.png" alt="logo" /></span>
                    </div>

                    <div class="py-3">
                        <ul class="nav nav-tabs custom-tabs" id="myTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="faculty-tab" data-toggle="tab" href="#faculty" role="tab"
                                    aria-controls="faculty" aria-selected="true"><b>Faculty</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="student-tab" data-toggle="tab" href="#student" role="tab"
                                    aria-controls="student" aria-selected="false"><b>Student</b></a>
                            </li>
                        </ul>
                    </div>


                    <div class="tab-content" id="myTabContent">


                        <div class="tab-pane fade show active" id="faculty" role="tabpanel"
                            aria-labelledby="faculty-tab">

                            <!-- faculty Form -->
                            <form class="form-horizontal m-t-20" id="loginform" action="#" method="post">
                                <div class="row p-b-30">
                                    <div class="col-12">

                                        <input type="hidden" id="custId" name="type" value="faculty">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success text-white"
                                                    id="basic-addon1"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="FacultyID or Username" aria-label="Username"
                                                aria-describedby="basic-addon1" name="email" required="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-warning text-white"
                                                    id="basic-addon2"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="basic-addon1" name="pass" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top border-secondary">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="p-t-20">
                                                <button class="btn btn-info" id="to-recover" type="button"><i
                                                        class="fa fa-lock m-r-5"></i> Lost password?</button>
                                                <button class="btn btn-success float-right" type="submit">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                        <div class="tab-pane fade" id="student" role="tabpanel" aria-labelledby="student-tab">
                            <form class="form-horizontal m-t-20" id="loginform" action="#" method="post">
                                <div class="row p-b-30">
                                    <div class="col-12">

                                        <input type="hidden" id="custId" name="type" value="student">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-success text-white"
                                                    id="basic-addon1"><i class="ti-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Register Number or Username" aria-label="Username"
                                                aria-describedby="basic-addon1" name="email" required="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-warning text-white"
                                                    id="basic-addon2"><i class="ti-pencil"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" aria-label="Password"
                                                aria-describedby="basic-addon1" name="pass" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top border-secondary">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="p-t-20">
                                                <button class="btn btn-info" id="to-recover2" type="button"><i
                                                        class="fa fa-lock m-r-5"></i> Lost password?</button>
                                                <button class="btn btn-success float-right" type="submit">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address and Faculty ID below and we will help you to
                            recover your password.(Faculty Only)</span>
                    </div>
                    <div class="row m-t-20">
                        <!-- Form -->
                        <form class="col-12" id="emailForm" method="POST">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                            class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="fid" id="fid"
                                    placeholder="Faculty ID" aria-label="Email" aria-describedby="basic-addon1"
                                    required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                            class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control form-control-lg" name="email" id="email"
                                    placeholder="Email Address" aria-label="Email" aria-describedby="basic-addon1"
                                    required>
                            </div>
                            <!-- pwd -->
                            <div class="row m-t-20 p-t-20 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-right" type="button" id="sendEmailButton"
                                        name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <footer class="footer text-center" style="color:white">
                    <b> All Rights Reserved by M.Kumarasamy College of Engineering, Karur. <br> <br>
                        <span style="color:yellow"> Version 2.0 </span></b>
                </footer>
            </div>


        </div>
        <!-- ============================================================== -->
        <!-- All Required js -->
        <!-- ============================================================== -->
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- ============================================================== -->
        <!-- This page plugin js -->
        <!-- ============================================================== -->
        <script>
            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
            // ============================================================== 
            // Login and Recover Password 
            // ============================================================== 
            $('#to-recover').on("click", function () {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });

            $('#to-recover2').on("click", function () {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });

            $('#to-login').click(function () {

                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        </script>

        <script>
            $(document).ready(function () {
                $("#sendEmailButton").click(function () {
                    // Get the email address from the input field
                    var email = $("#email").val();
                    var id = $("#fid").val();

                    // Send an AJAX request to the PHP script
                    $.ajax({
                        type: "POST",
                        url: "mail.php",
                        data: {
                            email: email,
                            fid: id
                        },
                        dataType: "json", // Expect JSON response
                        success: function (response) {
                            if (response.status === 200) {
                                // Email sent successfully
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                }).then(function () {
                                    // Reload the page after the user dismisses the alert
                                    location.reload();
                                });
                            } else {
                                // Email not found or other error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText); // Log the response text
                            // Display a generic error message using SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "An error occurred. Please try again later.",
                            });
                        }
                    });
                });
            });
        </script>


</body>

</html>