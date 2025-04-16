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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    
    
<![endif]-->

    <script type="text/javascript">
        function CheckColors(val) {
            if (val.value == 'Patent') {
                document.getElementById('pstatus').classList.remove('d-none');
                document.getElementById('cstatus').classList.add('d-none');
            }
            else if (val.value == 'Copyright') {
                document.getElementById('pstatus').classList.add('d-none');
                document.getElementById('cstatus').classList.remove('d-none');
            }

            else {
                document.getElementById('pstatus').classList.add('d-none');
                document.getElementById('cstatus').classList.add('d-none');
            }
        }

    </script>

    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .d-none {
            display: none;
        }

        .d1-none {
            display: none;
        }

        th,
        td {
            text-align: center;
        }

        th {
            /* background-color:#7460ee; */
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
        }


        .custom-button {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
            /* Text color */
            border-color: #FF5733;
            /* Border color */
        }

        .centered-text {
            text-align: center;
            vertical-align: top;
        }

        .alertify-notifier .ajs-success {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
        }
    </style>
</head>

<body>
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="smain">
                        <!-- Logo icon -->

                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="assets/images/srms33333.png" alt="homepage" class="light-logo" />

                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a
                                class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
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
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include("sside.php"); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Academic Exam Details</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Academic Exam Information
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <?php
                $query = "SELECT * FROM basic WHERE id='$s'";
                $query_run = mysqli_query($db, $query);

                if (mysqli_num_rows($query_run) >= 0) {
                    $student = mysqli_fetch_array($query_run);
                }

                $query2 = "SELECT * FROM faculty WHERE id='$s'";
                $query_run2 = mysqli_query($db, $query2);

                if (mysqli_num_rows($query_run2) >= 0) {
                    $student2 = mysqli_fetch_array($query_run2);
                }


                ?>

                <div class="card">
                    <div class="card-body wizard-content">
                        <h4 class="card-title">Academic Exam Information</h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#sem1"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 1</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem2"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 2</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem3"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 3</b></span></a> </li>
                                <!--
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-people-fill"></i><b> Patent/Copyright</b></span></a> </li>
                                -->
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem4"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 4</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem5"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 5</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem6"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 6</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem7"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 7</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem8"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 8</b></span></a> </li>

                            </ul>
                            <!---CGPA Modal Starts -->
                            <div class="modal fade" id="sem1SG" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">GPA /CGPA / Attendance </h5>
                                            <button type="button" class="btn" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                            </button>
                                        </div>
                                        <form id="sem1SGf">
                                            <div class="modal-body">
                                                <div id="sem1SGMessage" class="alert alert-warning d-none"></div>



                                                <div class="mb-3">
                                                    <label for="">Semester *</label>
                                                    <select class="form-control" name="sem" id="sem" required>
                                                        <option value="">Select Semester</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="">Select *</label>
                                                    <select class="form-control" name="type" id="type" required>
                                                        <option value="">Select</option>
                                                        <option value="sgpa">GPA</option>
                                                        <option value="cgpa">CGPA</option>
                                                        <option value="ca">Current Arrear</option>
                                                        <option value="oa">Overall Arrear</option>
                                                        <option value="ms1a">MS1-Attendance</option>
                                                        <option value="ms2a">MS2-Attendance</option>

                                                        <option value="ova">Overall-Attendance</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3" id="sg">
                                                    <label for="SGPA">GPA* : </label>
                                                    <input type="text" name="sgpa" class="form-control">
                                                </div>
                                                <div class="mb-3" id="cg">
                                                    <label for="CGPA">CGPA* : </label>
                                                    <input type="text" name="cgpa" class="form-control">
                                                </div>
                                                <div class="mb-3" id="ca">
                                                    <label for="CA">Current Arrear* : </label>
                                                    <input type="text" name="ca" class="form-control">
                                                </div>
                                                <div class="mb-3" id="oa">
                                                    <label for="OA">Overall Arrear* : </label>
                                                    <input type="text" name="oa" class="form-control">
                                                </div>
                                                <div class="mb-3" id="ms1">
                                                    <label for="SGPA">MS1-Attendance* : </label>
                                                    <input type="text" name="ms1" class="form-control">
                                                </div>
                                                <div class="mb-3" id="ms2">
                                                    <label for="SGPA">MS2-Attendance* : </label>
                                                    <input type="text" name="ms2" class="form-control">
                                                </div>

                                                <div class="mb-3" id="ova">
                                                    <label for="SGPA">Overall-Attendance* : </label>
                                                    <input type="text" name="ova" class="form-control">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>




                            <!---CGPA Modal End -->




                            <!-- TAB PANES -->


                            <div class="tab-content tabcontent-border">

                                <!-- ta1 -->

                                <div class="tab-pane active p-20" id="sem1" role="tabpanel">

                                    <div class="modal fade" id="subadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 1 Exam
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="pcex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary" id="add-input">Add
                                                            Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="ms1ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="s1ms1">
                                                    <div class="modal-body">

                                                        <div id="s1ms1Message" class="alert alert-warning d-none"></div>

                                                        <?php
                                                        $query = "SELECT * FROM ss1 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="ms1ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="s1ms2">
                                                    <div class="modal-body">

                                                        <div id="s1ms2Message" class="alert alert-warning d-none"></div>

                                                        <?php
                                                        $query = "SELECT * FROM ss1 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="ms1prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="s1prep">
                                                    <div class="modal-body">

                                                        <div id="s1prepMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss1 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="ms1sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="s1sem">
                                                    <div class="modal-body">

                                                        <div id="s1semMessage" class="alert alert-warning d-none"></div>

                                                        <?php
                                                        $query = "SELECT * FROM ss1 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 1 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTables1ms1"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#subadd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ms1ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ms1ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ms1prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#ms1sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss1 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>



                                                                            <td><?= $student['ms1'] ?></td>







                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="deletes1Btn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem1sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='1'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <!-- tab1 end -->



                                <div class="tab-pane p-20" id="sem2" role="tabpanel">
                                    <div class="modal fade" id="sem2madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 2 Exam
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem2fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container2">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input2">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form2">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem2ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem2fms1">
                                                    <div class="modal-body">

                                                        <div id="sem2fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss2 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem2ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem2ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem2ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss2 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem2prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem2prepf">
                                                    <div class="modal-body">

                                                        <div id="sem2prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss2 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem2sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem2semf">
                                                    <div class="modal-body">

                                                        <div id="sem2semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss2 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 2 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem2table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem2madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem2ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem2ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem2prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem2sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss2 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>



                                                                            <td><?= $student['ms1'] ?></td>







                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem2deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem2sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='2'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- tab2 end -->


                                <div class="tab-pane  p-20" id="sem3" role="tabpanel">
                                    <div class="modal fade" id="sem3madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 3
                                                        Subject Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem3fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container3">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input3">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form3">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem3ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem3fms1">
                                                    <div class="modal-body">

                                                        <div id="sem3fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss3 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem3ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem3ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem3ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss3 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem3prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem3prepf">
                                                    <div class="modal-body">

                                                        <div id="sem3prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss3 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem3sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem3semf">
                                                    <div class="modal-body">

                                                        <div id="sem3semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss3 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 3 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem3table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem3madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem3ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem3ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem3prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem3sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss3 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>



                                                                            <td><?= $student['ms1'] ?></td>







                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem3deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem3sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='3'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!--profile tab end (internship) -->




                                <!--Posting(co-curricular) tab starts -->


                                <div class="tab-pane  p-20" id="sem4" role="tabpanel">


                                    <div class="modal fade" id="sem4madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 4
                                                        Subject Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem4fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container4">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input4">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form4">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem4ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem4fms1">
                                                    <div class="modal-body">

                                                        <div id="sem4fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss4 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem4ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem4ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem4ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss4 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem4prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem4prepf">
                                                    <div class="modal-body">

                                                        <div id="sem4prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss4 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem4sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem4semf">
                                                    <div class="modal-body">

                                                        <div id="sem4semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss4 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 4 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem4table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem4madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem4ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem4ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem4prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem4sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss4 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>



                                                                            <td><?= $student['ms1'] ?></td>







                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem4deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem4sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='4'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <!-- posting tab ending -->


                                <!--Punish tab starts -->


                                <div class="tab-pane  p-20" id="sem5" role="tabpanel">


                                    <div class="modal fade" id="sem5madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 5
                                                        Subject Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem5fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container5">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input5">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form5">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem5ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem5fms1">
                                                    <div class="modal-body">

                                                        <div id="sem5fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss5 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem5ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem5ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem5ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss5 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem5prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem5prepf">
                                                    <div class="modal-body">

                                                        <div id="sem5prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss5 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem5sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem5semf">
                                                    <div class="modal-body">

                                                        <div id="sem5semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss5 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 5 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem5table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem5madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem5ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem5ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem5prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem5sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss5 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>



                                                                            <td><?= $student['ms1'] ?></td>







                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem5deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem5sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='5'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                                <!-- punish tab ending -->


                                <!-- Extra Curricular tab -->

                                <div class="tab-pane p-20" id="sem6" role="tabpanel">

                                    <div class="modal fade" id="sem6madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 6
                                                        Subject Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem6fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container6">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input6">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form6">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem6ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem6fms1">
                                                    <div class="modal-body">

                                                        <div id="sem6fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss6 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem6ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem6ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem6ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss6 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem6prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem6prepf">
                                                    <div class="modal-body">

                                                        <div id="sem6prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss6 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem6sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem6semf">
                                                    <div class="modal-body">

                                                        <div id="sem6semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss6 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 6 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem6table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem6madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem6ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem6ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem6prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem6sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss6 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>



                                                                            <td><?= $student['ms1'] ?></td>







                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem6deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem6sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='6'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>

                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>

                                                                            <td><?= $student['OA'] ?></td>
                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Extra Curricular ending -->

                                <!-- Skill Training Starts -->
                                <div class="tab-pane p-20" id="sem7" role="tabpanel">

                                    <div class="modal fade" id="sem7madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 7
                                                        Subject Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem7fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container7">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input7">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form7">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem7ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem7fms1">
                                                    <div class="modal-body">

                                                        <div id="sem7fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss7 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem7ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem7ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem7ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss7 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem7prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem7prepf">
                                                    <div class="modal-body">

                                                        <div id="sem7prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss7 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem7sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem7semf">
                                                    <div class="modal-body">

                                                        <div id="sem7semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss7 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 7 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem7table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem7madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem7ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem7ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem7prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem7sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss7 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>

                                                                            <td><?= $student['ms1'] ?></td>

                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem7deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem7sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='7'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Skill Training ending -->

                                <div class="tab-pane p-20" id="sem8" role="tabpanel">

                                    <div class="modal fade" id="sem8madd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Semester 8
                                                        Subject Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem8fex">
                                                    <div class="modal-body">

                                                        <div id="sem1Message" class="alert alert-warning d-none"></div>

                                                        <div id="input-container8">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control"
                                                                    name="dynamic_input[]" placeholder="Subject 1">

                                                            </div>

                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-input8">Add Subject</button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success"
                                                            id="submit-form8">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- Add MS1 modal -->
                                    <div class="modal fade" id="sem8ms1" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 1/CIA 1 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem8fms1">
                                                    <div class="modal-body">

                                                        <div id="sem8fms1Message" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss8 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {
                                                            $i = 1;
                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                                $i = $i + 1;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS1 modal end -->


                                    <!-- Add MS2 modal -->
                                    <div class="modal fade" id="sem8ms2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> MS 2/CIA 2 Mark Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem8ms2f">
                                                    <div class="modal-body">

                                                        <div id="sem8ms2fMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss8 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- MS2 modal end -->


                                    <!-- Add prep modal -->
                                    <div class="modal fade" id="sem8prep" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Preparatory(R2018 alone) Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem8prepf">
                                                    <div class="modal-body">

                                                        <div id="sem8prepfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss8 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- prep modal end -->


                                    <!-- Add sem modal -->
                                    <div class="modal fade" id="sem8sem" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Semester Mark
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="sem8semf">
                                                    <div class="modal-body">

                                                        <div id="sem8semfMessage" class="alert alert-warning d-none">
                                                        </div>

                                                        <?php
                                                        $query = "SELECT * FROM ss8 WHERE sid='$s'";
                                                        $query_run = mysqli_query($db, $query);

                                                        if (mysqli_num_rows($query_run) > 0) {

                                                            while ($student = mysqli_fetch_assoc($query_run)) {

                                                                echo "<div class='mb-3'>";
                                                                echo "<label for='" . $student['sname'] . "'>" . $student['sname'] . "</label>";
                                                                echo "<input type='text' class='form-control' name='" . $student['uid'] . "' required>";
                                                                echo "</div>";

                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-md">Update
                                                            details</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- sem modal end -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Semester 8 Exam Details
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem8table"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="centered-text"><b>S.No</b>
                                                                    </th>
                                                                    <th><b>Subject Name</b></th>
                                                                    <th><b>MS 1/CIA 1</b></th>
                                                                    <th><b>MS 2/CIA 2</b></th>
                                                                    <th><b>Preparatory(R2018 alone)</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th rowspan="2" align="center"><b>Action</b></th>
                                                                </tr>
                                                                <tr>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem8madd">
                                                                            Add Subject</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem8ms1">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem8ms2">
                                                                            Enter Mark</button></td>

                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem8prep">
                                                                            Enter Mark</button></td>
                                                                    <td><button type="button" class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem8sem">
                                                                            Enter Mark</button></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM ss8 where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['sname'] ?></td>
                                                                            <td><?= $student['ms1'] ?></td>
                                                                            <td><?= $student['ms2'] ?></td>
                                                                            <td><?= $student['prep'] ?></td>
                                                                            <td align="center"><?= $student['sem'] ?></td>
                                                                            <td align="center">

                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="sem8deleteBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CGAP/SGPA/Attendance -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>GPA /CGPA / Attendance
                                                        <!--  
                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subadd">
                            Add Semester 1 Exam Details
                        </button>						
                        -->
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="sem8sgpa" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>GPA</b></th>
                                                                    <th><b>CGPA</b></th>
                                                                    <th><b>Current Arrear</b></th>
                                                                    <th><b>Overall Arrear</b></th>
                                                                    <th><b>MS 1/CIA 1-Attendance</b></th>
                                                                    <th><b>MS 2/CIA 2-Attendance</b></th>

                                                                    <th><b>Overall-Attendance</b></th>
                                                                </tr>

                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sgrade where sid='$s' and sem='8'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>

                                                                            <td><?= $student['sgpa'] ?></td>



                                                                            <td><?= $student['cgpa'] ?></td>
                                                                            <td><?= $student['CA'] ?></td>



                                                                            <td><?= $student['OA'] ?></td>


                                                                            <td><?= $student['ms1a'] ?></td>
                                                                            <td><?= $student['ms2a'] ?></td>

                                                                            <td align="center"><?= $student['ova'] ?></td>
                                                                        </tr>
                                                                        <?php
                                                                        $sn = $sn + 1;
                                                                    }
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8"><button type="button"
                                                                            class="btn btn-success"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#sem1SG">
                                                                            Enter</button></td>


                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>





                            </div>


                        </div>



                        <!-- Tabs content -->



                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->


    <?php include "./footer.html" ?>


    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const typeDropdown = document.getElementById("type");
            const sgDiv = document.getElementById("sg");
            const cgDiv = document.getElementById("cg");
            const caDiv = document.getElementById("ca");
            const oaDiv = document.getElementById("oa");
            const ms1Div = document.getElementById("ms1");
            const ms2Div = document.getElementById("ms2");

            const ovaDiv = document.getElementById("ova");

            typeDropdown.addEventListener("change", function () {
                const selectedValue = typeDropdown.value;

                sgDiv.style.display = "none";
                cgDiv.style.display = "none";
                caDiv.style.display = "none";
                oaDiv.style.display = "none";
                ms1Div.style.display = "none";
                ms2Div.style.display = "none";

                ovaDiv.style.display = "none";

                if (selectedValue === "sgpa") {
                    sgDiv.style.display = "block";
                } else if (selectedValue === "cgpa") {
                    cgDiv.style.display = "block";
                } else if (selectedValue === "ca") {
                    caDiv.style.display = "block";
                } else if (selectedValue === "oa") {
                    oaDiv.style.display = "block";
                } else if (selectedValue === "ms1a") {
                    ms1Div.style.display = "block";
                } else if (selectedValue === "ms2a") {
                    ms2Div.style.display = "block";
                } else if (selectedValue === "ova") {
                    ovaDiv.style.display = "block";
                }
            });
        });
    </script>



    <script>
        $(document).ready(function () {
            let counter = 2;

            $('#add-input').click(function () {
                $('#input-container').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form').click(function () {
                const formData = $('#pcex').serialize();
                const customFlag = 'save_s1=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem1Message').addClass('d-none');
                            $('#subadd').modal('hide');
                            $('#pcex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#myTables1ms1').load(location.href + " #myTables1ms1");
                            $('#ms1ms1 .modal-content').load(location.href + " #ms1ms1 .modal-content");
                            $('#ms1ms2 .modal-content').load(location.href + " #ms1ms2 .modal-content");
                            $('#ms1prep .modal-content').load(location.href + " #ms1prep .modal-content");
                            $('#ms1sem .modal-content').load(location.href + " #ms1sem .modal-content");





                        }
                    }
                });
            });
        });
    </script>

    <script>
        //sem2 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input2').click(function () {
                $('#input-container2').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form2').click(function () {
                console.log("kalai");
                const formData = $('#sem2fex').serialize();
                const customFlag = 'save_s2=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem1Message').addClass('d-none');
                            $('#sem2madd').modal('hide');
                            $('#sem2fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem2table').load(location.href + " #sem2table");
                            $('#sem2ms1 .modal-content').load(location.href + " #sem2ms1 .modal-content");
                            $('#sem2ms2 .modal-content').load(location.href + " #sem2ms2 .modal-content");
                            $('#sem2prep .modal-content').load(location.href + " #sem2prep .modal-content");
                            $('#sem2sem .modal-content').load(location.href + " #sem2sem .modal-content");





                        }
                    }
                });
            });
        });


        //sem3 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input3').click(function () {
                $('#input-container3').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form3').click(function () {

                const formData = $('#sem3fex').serialize();
                const customFlag = 'save_s3=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem1Message').addClass('d-none');
                            $('#sem3madd').modal('hide');
                            $('#sem3fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem3table').load(location.href + " #sem3table");
                            $('#sem3ms1 .modal-content').load(location.href + " #sem3ms1 .modal-content");
                            $('#sem3ms2 .modal-content').load(location.href + " #sem3ms2 .modal-content");
                            $('#sem3prep .modal-content').load(location.href + " #sem3prep .modal-content");
                            $('#sem3sem .modal-content').load(location.href + " #sem3sem .modal-content");





                        }
                    }
                });
            });
        });
    </script>






    <script>

        //sem 1 

        //ms1
        $(document).on('submit', '#s1ms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_s1ms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#s1ms1Message').addClass('d-none');
                        $('#ms1ms1').modal('hide');
                        $('#s1ms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTables1ms1').load(location.href + " #myTables1ms1");


                    }

                    else if (res.status == 500) {
                        $('#s1ms1Message').addClass('d-none');
                        $('#ms1ms1').modal('hide');
                        $('#s1ms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#s1ms2', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_s1ms2", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#s1ms2Message').addClass('d-none');
                        $('#ms1ms2').modal('hide');
                        $('#s1ms2')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTables1ms1').load(location.href + " #myTables1ms1");


                    }

                    else if (res.status == 500) {
                        $('#s1ms2Message').addClass('d-none');
                        $('#ms1ms2').modal('hide');
                        $('#s1ms2')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //prep

        $(document).on('submit', '#s1prep', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_s1prep", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#s1prepMessage').addClass('d-none');
                        $('#ms1prep').modal('hide');
                        $('#s1prep')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTables1ms1').load(location.href + " #myTables1ms1");


                    }

                    else if (res.status == 500) {
                        $('#s1prepMessage').addClass('d-none');
                        $('#ms1prep').modal('hide');
                        $('#s1prep')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //end sem

        $(document).on('submit', '#s1sem', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_s1sem", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#s1semMessage').addClass('d-none');
                        $('#ms1sem').modal('hide');
                        $('#s1sem')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTables1ms1').load(location.href + " #myTables1ms1");


                    }

                    else if (res.status == 500) {
                        $('#s1semMessage').addClass('d-none');
                        $('#ms1sem').modal('hide');
                        $('#s1sem')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete

        $(document).on('click', '.deletes1Btn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s1': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#myTables1ms1').load(location.href + " #myTables1ms1");
                            $('#ms1ms1 .modal-content').load(location.href + " #ms1ms1 .modal-content");
                            $('#ms1ms2 .modal-content').load(location.href + " #ms1ms2 .modal-content");
                            $('#ms1prep .modal-content').load(location.href + " #ms1prep .modal-content");
                            $('#ms1sem .modal-content').load(location.href + " #ms1sem .modal-content");
                        }
                    }
                });
            }
        });


        //sem2

        //ms1
        $(document).on('submit', '#sem2fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem2fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem2fms1Message').addClass('d-none');
                        $('#sem2ms1').modal('hide');
                        $('#sem2fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem2table').load(location.href + " #sem2table");


                    }

                    else if (res.status == 500) {
                        $('#sem2fms1Message').addClass('d-none');
                        $('#sem2ms1').modal('hide');
                        $('#sem2fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem2ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem2ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem2ms2fMessage').addClass('d-none');
                        $('#sem2ms2').modal('hide');
                        $('#sem2ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem2table').load(location.href + " #sem2table");


                    }

                    else if (res.status == 500) {
                        $('#sem2ms2fMessage').addClass('d-none');
                        $('#sem2ms2').modal('hide');
                        $('#sem2ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem2prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem2prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem2prepfMessage').addClass('d-none');
                        $('#sem2prep').modal('hide');
                        $('#sem2prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem2table').load(location.href + " #sem2table");


                    }

                    else if (res.status == 500) {
                        $('#sem2prepfMessage').addClass('d-none');
                        $('#sem2prep').modal('hide');
                        $('#sem2prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem2semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem2semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem2semfMessage').addClass('d-none');
                        $('#sem2sem').modal('hide');
                        $('#sem2semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem2table').load(location.href + " #sem2table");


                    }

                    else if (res.status == 500) {
                        $('#sem2semfMessage').addClass('d-none');
                        $('#sem2sem').modal('hide');
                        $('#sem2semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem2deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s2': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem2table').load(location.href + " #sem2table");
                            $('#sem2ms1 .modal-content').load(location.href + " #sem2ms1 .modal-content");
                            $('#sem2ms2 .modal-content').load(location.href + " #sem2ms2 .modal-content");
                            $('#sem2prep .modal-content').load(location.href + " #sem2prep .modal-content");
                            $('#sem2sem .modal-content').load(location.href + " #sem2sem .modal-content");
                        }
                    }
                });
            }
        });

        //sem 3


        //ms1
        $(document).on('submit', '#sem3fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem3fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem3fms1Message').addClass('d-none');
                        $('#sem3ms1').modal('hide');
                        $('#sem3fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem3table').load(location.href + " #sem3table");


                    }

                    else if (res.status == 500) {
                        $('#sem3fms1Message').addClass('d-none');
                        $('#sem3ms1').modal('hide');
                        $('#sem3fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem3ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem3ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem3ms2fMessage').addClass('d-none');
                        $('#sem3ms2').modal('hide');
                        $('#sem3ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem3table').load(location.href + " #sem3table");


                    }

                    else if (res.status == 500) {
                        $('#sem3ms2fMessage').addClass('d-none');
                        $('#sem3ms2').modal('hide');
                        $('#sem3ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem3prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem3prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem3prepfMessage').addClass('d-none');
                        $('#sem3prep').modal('hide');
                        $('#sem3prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem3table').load(location.href + " #sem3table");


                    }

                    else if (res.status == 500) {
                        $('#sem3prepfMessage').addClass('d-none');
                        $('#sem3prep').modal('hide');
                        $('#sem3prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem3semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem3semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem3semfMessage').addClass('d-none');
                        $('#sem3sem').modal('hide');
                        $('#sem3semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem3table').load(location.href + " #sem3table");


                    }

                    else if (res.status == 500) {
                        $('#sem3semfMessage').addClass('d-none');
                        $('#sem3sem').modal('hide');
                        $('#sem3semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem3deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s3': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem3table').load(location.href + " #sem3table");
                            $('#sem3ms1 .modal-content').load(location.href + " #sem3ms1 .modal-content");
                            $('#sem3ms2 .modal-content').load(location.href + " #sem3ms2 .modal-content");
                            $('#sem3prep .modal-content').load(location.href + " #sem3prep .modal-content");
                            $('#sem3sem .modal-content').load(location.href + " #sem3sem .modal-content");
                        }
                    }
                });
            }
        });


        //sem 4

        //sem4 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input4').click(function () {
                $('#input-container4').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form4').click(function () {

                const formData = $('#sem4fex').serialize();
                const customFlag = 'save_s4=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem1Message').addClass('d-none');
                            $('#sem4madd').modal('hide');
                            $('#sem4fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem4table').load(location.href + " #sem4table");
                            $('#sem4ms1 .modal-content').load(location.href + " #sem4ms1 .modal-content");
                            $('#sem4ms2 .modal-content').load(location.href + " #sem4ms2 .modal-content");
                            $('#sem4prep .modal-content').load(location.href + " #sem4prep .modal-content");
                            $('#sem4sem .modal-content').load(location.href + " #sem4sem .modal-content");





                        }
                    }
                });
            });
        });




        //ms1
        $(document).on('submit', '#sem4fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem4fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem4fms1Message').addClass('d-none');
                        $('#sem4ms1').modal('hide');
                        $('#sem4fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem4table').load(location.href + " #sem4table");


                    }

                    else if (res.status == 500) {
                        $('#sem4fms1Message').addClass('d-none');
                        $('#sem4ms1').modal('hide');
                        $('#sem4fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem4ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem4ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem4ms2fMessage').addClass('d-none');
                        $('#sem4ms2').modal('hide');
                        $('#sem4ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem4table').load(location.href + " #sem4table");


                    }

                    else if (res.status == 500) {
                        $('#sem4ms2fMessage').addClass('d-none');
                        $('#sem4ms2').modal('hide');
                        $('#sem4ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem4prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem4prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem4prepfMessage').addClass('d-none');
                        $('#sem4prep').modal('hide');
                        $('#sem4prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem4table').load(location.href + " #sem4table");


                    }

                    else if (res.status == 500) {
                        $('#sem4prepfMessage').addClass('d-none');
                        $('#sem4prep').modal('hide');
                        $('#sem4prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem4semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem4semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem4semfMessage').addClass('d-none');
                        $('#sem4sem').modal('hide');
                        $('#sem4semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem4table').load(location.href + " #sem4table");


                    }

                    else if (res.status == 500) {
                        $('#sem4semfMessage').addClass('d-none');
                        $('#sem4sem').modal('hide');
                        $('#sem4semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem4deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s4': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem4table').load(location.href + " #sem4table");
                            $('#sem4ms1 .modal-content').load(location.href + " #sem4ms1 .modal-content");
                            $('#sem4ms2 .modal-content').load(location.href + " #sem4ms2 .modal-content");
                            $('#sem4prep .modal-content').load(location.href + " #sem4prep .modal-content");
                            $('#sem4sem .modal-content').load(location.href + " #sem4sem .modal-content");
                        }
                    }
                });
            }
        });


        //sem5

        //sem5 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input5').click(function () {
                $('#input-container5').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form5').click(function () {

                const formData = $('#sem5fex').serialize();
                const customFlag = 'save_s5=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem1Message').addClass('d-none');
                            $('#sem5madd').modal('hide');
                            $('#sem5fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem5table').load(location.href + " #sem5table");
                            $('#sem5ms1 .modal-content').load(location.href + " #sem5ms1 .modal-content");
                            $('#sem5ms2 .modal-content').load(location.href + " #sem5ms2 .modal-content");
                            $('#sem5prep .modal-content').load(location.href + " #sem5prep .modal-content");
                            $('#sem5sem .modal-content').load(location.href + " #sem5sem .modal-content");





                        }
                    }
                });
            });
        });




        //ms1
        $(document).on('submit', '#sem5fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem5fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem5fms1Message').addClass('d-none');
                        $('#sem5ms1').modal('hide');
                        $('#sem5fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem5table').load(location.href + " #sem5table");


                    }

                    else if (res.status == 500) {
                        $('#sem5fms1Message').addClass('d-none');
                        $('#sem5ms1').modal('hide');
                        $('#sem5fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem5ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem5ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem5ms2fMessage').addClass('d-none');
                        $('#sem5ms2').modal('hide');
                        $('#sem5ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem5table').load(location.href + " #sem5table");


                    }

                    else if (res.status == 500) {
                        $('#sem5ms2fMessage').addClass('d-none');
                        $('#sem5ms2').modal('hide');
                        $('#sem5ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem5prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem5prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem5prepfMessage').addClass('d-none');
                        $('#sem5prep').modal('hide');
                        $('#sem5prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem5table').load(location.href + " #sem5table");


                    }

                    else if (res.status == 500) {
                        $('#sem5prepfMessage').addClass('d-none');
                        $('#sem5prep').modal('hide');
                        $('#sem5prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem5semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem5semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem5semfMessage').addClass('d-none');
                        $('#sem5sem').modal('hide');
                        $('#sem5semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem5table').load(location.href + " #sem5table");


                    }

                    else if (res.status == 500) {
                        $('#sem5semfMessage').addClass('d-none');
                        $('#sem5sem').modal('hide');
                        $('#sem5semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem5deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s5': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem5table').load(location.href + " #sem5table");
                            $('#sem5ms1 .modal-content').load(location.href + " #sem5ms1 .modal-content");
                            $('#sem5ms2 .modal-content').load(location.href + " #sem5ms2 .modal-content");
                            $('#sem5prep .modal-content').load(location.href + " #sem5prep .modal-content");
                            $('#sem5sem .modal-content').load(location.href + " #sem5sem .modal-content");
                        }
                    }
                });
            }
        });

        //sem6 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input6').click(function () {
                $('#input-container6').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form6').click(function () {

                const formData = $('#sem6fex').serialize();
                const customFlag = 'save_s6=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem1Message').addClass('d-none');
                            $('#sem6madd').modal('hide');
                            $('#sem6fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem6table').load(location.href + " #sem6table");
                            $('#sem6ms1 .modal-content').load(location.href + " #sem6ms1 .modal-content");
                            $('#sem6ms2 .modal-content').load(location.href + " #sem6ms2 .modal-content");
                            $('#sem6prep .modal-content').load(location.href + " #sem6prep .modal-content");
                            $('#sem6sem .modal-content').load(location.href + " #sem6sem .modal-content");





                        }
                    }
                });
            });
        });




        //ms1
        $(document).on('submit', '#sem6fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem6fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem6fms1Message').addClass('d-none');
                        $('#sem6ms1').modal('hide');
                        $('#sem6fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem6table').load(location.href + " #sem6table");


                    }

                    else if (res.status == 500) {
                        $('#sem6fms1Message').addClass('d-none');
                        $('#sem6ms1').modal('hide');
                        $('#sem6fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem6ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem6ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem6ms2fMessage').addClass('d-none');
                        $('#sem6ms2').modal('hide');
                        $('#sem6ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem6table').load(location.href + " #sem6table");


                    }

                    else if (res.status == 500) {
                        $('#sem6ms2fMessage').addClass('d-none');
                        $('#sem6ms2').modal('hide');
                        $('#sem6ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem6prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem6prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem6prepfMessage').addClass('d-none');
                        $('#sem6prep').modal('hide');
                        $('#sem6prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem6table').load(location.href + " #sem6table");


                    }

                    else if (res.status == 500) {
                        $('#sem6prepfMessage').addClass('d-none');
                        $('#sem6prep').modal('hide');
                        $('#sem6prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem6semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem6semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem6semfMessage').addClass('d-none');
                        $('#sem6sem').modal('hide');
                        $('#sem6semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem6table').load(location.href + " #sem6table");


                    }

                    else if (res.status == 500) {
                        $('#sem6semfMessage').addClass('d-none');
                        $('#sem6sem').modal('hide');
                        $('#sem6semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem6deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s6': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem6table').load(location.href + " #sem6table");
                            $('#sem6ms1 .modal-content').load(location.href + " #sem6ms1 .modal-content");
                            $('#sem6ms2 .modal-content').load(location.href + " #sem6ms2 .modal-content");
                            $('#sem6prep .modal-content').load(location.href + " #sem6prep .modal-content");
                            $('#sem6sem .modal-content').load(location.href + " #sem6sem .modal-content");
                        }
                    }
                });
            }
        });

        //sem7 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input7').click(function () {
                $('#input-container7').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form7').click(function () {

                const formData = $('#sem7fex').serialize();
                const customFlag = 'save_s7=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem7Message').addClass('d-none');
                            $('#sem7madd').modal('hide');
                            $('#sem7fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem7table').load(location.href + " #sem7table");
                            $('#sem7ms1 .modal-content').load(location.href + " #sem7ms1 .modal-content");
                            $('#sem7ms2 .modal-content').load(location.href + " #sem7ms2 .modal-content");
                            $('#sem7prep .modal-content').load(location.href + " #sem7prep .modal-content");
                            $('#sem7sem .modal-content').load(location.href + " #sem7sem .modal-content");





                        }
                    }
                });
            });
        });




        //ms1
        $(document).on('submit', '#sem7fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem7fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem7fms1Message').addClass('d-none');
                        $('#sem7ms1').modal('hide');
                        $('#sem7fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem7table').load(location.href + " #sem7table");


                    }

                    else if (res.status == 500) {
                        $('#sem7fms1Message').addClass('d-none');
                        $('#sem7ms1').modal('hide');
                        $('#sem7fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem7ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem7ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem7ms2fMessage').addClass('d-none');
                        $('#sem7ms2').modal('hide');
                        $('#sem7ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem7table').load(location.href + " #sem7table");


                    }

                    else if (res.status == 500) {
                        $('#sem7ms2fMessage').addClass('d-none');
                        $('#sem7ms2').modal('hide');
                        $('#sem7ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem7prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem7prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem7prepfMessage').addClass('d-none');
                        $('#sem7prep').modal('hide');
                        $('#sem7prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem7table').load(location.href + " #sem7table");


                    }

                    else if (res.status == 500) {
                        $('#sem7prepfMessage').addClass('d-none');
                        $('#sem7prep').modal('hide');
                        $('#sem7prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem7semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem7semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem7semfMessage').addClass('d-none');
                        $('#sem7sem').modal('hide');
                        $('#sem7semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem7table').load(location.href + " #sem7table");


                    }

                    else if (res.status == 500) {
                        $('#sem7semfMessage').addClass('d-none');
                        $('#sem7sem').modal('hide');
                        $('#sem7semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem7deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s7': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem7table').load(location.href + " #sem7table");
                            $('#sem7ms1 .modal-content').load(location.href + " #sem7ms1 .modal-content");
                            $('#sem7ms2 .modal-content').load(location.href + " #sem7ms2 .modal-content");
                            $('#sem7prep .modal-content').load(location.href + " #sem7prep .modal-content");
                            $('#sem7sem .modal-content').load(location.href + " #sem7sem .modal-content");
                        }
                    }
                });
            }
        });

        //sem8 
        $(document).ready(function () {
            let counter = 2;

            $('#add-input8').click(function () {
                $('#input-container8').append(`
                    <div class="mb-3">
                        <input type="text" class="form-control" name="dynamic_input[]" placeholder="Subject ${counter}">
                    </div>
                `);
                counter++;
            });

            $('#submit-form8').click(function () {

                const formData = $('#sem8fex').serialize();
                const customFlag = 'save_s8=true';
                const formDataWithFlag = formData + '&' + customFlag;
                $.ajax({
                    type: 'POST',
                    url: 'scode.php',
                    data: formDataWithFlag,
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 200) {

                            $('#sem8Message').addClass('d-none');
                            $('#sem8madd').modal('hide');
                            $('#sem8fex')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem8table').load(location.href + " #sem8table");
                            $('#sem8ms1 .modal-content').load(location.href + " #sem8ms1 .modal-content");
                            $('#sem8ms2 .modal-content').load(location.href + " #sem8ms2 .modal-content");
                            $('#sem8prep .modal-content').load(location.href + " #sem8prep .modal-content");
                            $('#sem8sem .modal-content').load(location.href + " #sem8sem .modal-content");





                        }
                    }
                });
            });
        });




        //ms1
        $(document).on('submit', '#sem8fms1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem8fms1", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem8fms1Message').addClass('d-none');
                        $('#sem8ms1').modal('hide');
                        $('#sem8fms1')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem8table').load(location.href + " #sem8table");


                    }

                    else if (res.status == 500) {
                        $('#sem8fms1Message').addClass('d-none');
                        $('#sem8ms1').modal('hide');
                        $('#sem8fms1')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //MS 2/CIA 2	

        $(document).on('submit', '#sem8ms2f', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem8ms2f", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem8ms2fMessage').addClass('d-none');
                        $('#sem8ms2').modal('hide');
                        $('#sem8ms2f')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem8table').load(location.href + " #sem8table");


                    }

                    else if (res.status == 500) {
                        $('#sem8ms2fMessage').addClass('d-none');
                        $('#sem8ms2').modal('hide');
                        $('#sem8ms2f')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prep

        $(document).on('submit', '#sem8prepf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem8prepf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem8prepfMessage').addClass('d-none');
                        $('#sem8prep').modal('hide');
                        $('#sem8prepf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem8table').load(location.href + " #sem8table");


                    }

                    else if (res.status == 500) {
                        $('#sem8prepfMessage').addClass('d-none');
                        $('#sem8prep').modal('hide');
                        $('#sem8prepf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        //end sem

        $(document).on('submit', '#sem8semf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem8semf", true);


            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);

                    if (res.status == 200) {
                        $('#sem8semfMessage').addClass('d-none');
                        $('#sem8sem').modal('hide');
                        $('#sem8semf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem8table').load(location.href + " #sem8table");


                    }

                    else if (res.status == 500) {
                        $('#sem8semfMessage').addClass('d-none');
                        $('#sem8sem').modal('hide');
                        $('#sem8semf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //delete
        $(document).on('click', '.sem8deleteBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_s8': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            // Reload the content of all modals
                            $('#sem8table').load(location.href + " #sem8table");
                            $('#sem8ms1 .modal-content').load(location.href + " #sem8ms1 .modal-content");
                            $('#sem8ms2 .modal-content').load(location.href + " #sem8ms2 .modal-content");
                            $('#sem8prep .modal-content').load(location.href + " #sem8prep .modal-content");
                            $('#sem8sem .modal-content').load(location.href + " #sem8sem .modal-content");
                        }
                    }
                });
            }
        });

    </script>

    <script>

        $(document).on('submit', '#sem1SGf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_sem1SGf", true);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res.status);
                    if (res.status == 422) {
                        $('#sem1SGMessage').removeClass('d-none');
                        $('#sem1SGMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#sem1SGMessage').addClass('d-none');
                        $('#sem1SG').modal('hide');
                        $('#sem1SGf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#sem1sgpa').load(location.href + " #sem1sgpa");
                        $('#sem2sgpa').load(location.href + " #sem2sgpa");
                        $('#sem3sgpa').load(location.href + " #sem3sgpa");
                        $('#sem4sgpa').load(location.href + " #sem4sgpa");
                        $('#sem5sgpa').load(location.href + " #sem5sgpa");
                        $('#sem6sgpa').load(location.href + " #sem6sgpa");
                        $('#sem7sgpa').load(location.href + " #sem74sgpa");
                        $('#sem8sgpa').load(location.href + " #sem8sgpa");

                    } else if (res.status == 500) {
                        $('#sem1SGMessage').addClass('d-none');
                        $('#sem1SG').modal('hide');
                        $('#sem1SGf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

    </script>





    <script>

        $(document).on('submit', '#saveexp', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_exp", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveexp')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable2').load(location.href + " #myTable2");


                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveexp')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        //prize and awards		

        $(document).on('submit', '#pcadd2', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_pc", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage4').removeClass('d-none');
                        $('#errorMessage4').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage4').addClass('d-none');
                        $('#pcadd').modal('hide');
                        $('#pcadd2')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTablepr').load(location.href + " #myTablepr");


                    } else if (res.status == 500) {
                        $('#errorMessage4').addClass('d-none');
                        $('#pcadd').modal('hide');
                        $('#pcadd2')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.deletepcBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_pc': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTablepr').load(location.href + " #myTablepr");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.btnimgpr', function () {

            var student_id222 = $(this).val();
            $.ajax({
                type: "GET",
                url: "scode.php?student_id222=" + student_id222,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#imagepr").attr("src", res.data.cert);

                        $('#studentViewModal4').modal('show');
                    }
                }
            });
        });


        //prize awards ends
        //------------------------------------------
        //projects starts

        $(document).on('submit', '#saveproject', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_project", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagepost').removeClass('d-none');
                        $('#errorMessagepost').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagepost').addClass('d-none');
                        $('#projectadd').modal('hide');
                        $('#saveproject')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable0').load(location.href + " #myTable0");

                    } else if (res.status == 500) {
                        $('#errorMessagepost').addClass('d-none');
                        $('#projectadd').modal('hide');
                        $('#saveproject')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deletePrBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id9 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_project': true,
                        'student_id9': student_id9
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable0').load(location.href + " #myTable0");
                        }
                    }
                });
            }
        });




        //projects ends
        //---------------------------------------------

        //internship		

        $(document).on('submit', '#iadd2', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_i", true);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagei').removeClass('d-none');
                        $('#errorMessagei').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagei').addClass('d-none');
                        $('#iadd').modal('hide');
                        $('#iadd2')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTablei').load(location.href + " #myTablei");


                    } else if (res.status == 500) {
                        $('#errorMessagei').addClass('d-none');
                        $('#iadd').modal('hide');
                        $('#iadd2')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.deleteiBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_idi = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_i': true,
                        'student_idi': student_idi
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTablei').load(location.href + " #myTablei");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.btnimgi', function () {

            var student_idii = $(this).val();
            $.ajax({
                type: "GET",
                url: "scode.php?student_idii=" + student_idii,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#imagei").attr("src", res.data.cert);

                        $('#studentViewModali').modal('show');
                    }
                }
            });
        });


        //internship ends
        //---------------------------------------------------
        //co-curricular starts

        $(document).on('submit', '#savepost', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_post", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagepost').removeClass('d-none');
                        $('#errorMessagepost').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagepost').addClass('d-none');
                        $('#postingadd').modal('hide');
                        $('#savepost')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTablecc').load(location.href + " #myTablecc");

                    } else if (res.status == 500) {
                        $('#errorMessagepost').addClass('d-none');
                        $('#postingadd').modal('hide');
                        $('#savepost')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deletecoBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_idi = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_co': true,
                        'student_idi': student_idi
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTablecc').load(location.href + " #myTablecc");
                        }
                    }
                });
            }
        });


        $(document).on('click', '.btnimgco', function () {

            var student_idco = $(this).val();
            $.ajax({
                type: "GET",
                url: "scode.php?student_idco=" + student_idco,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#imageco").attr("src", res.data.cert);

                        $('#studentViewModalco').modal('show');
                    }
                }
            });
        });

        //co-curricular ends       
        //---------------------------------------------------

        //extra-curricular starts

        $(document).on('submit', '#saveextra', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_extra", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagepost').removeClass('d-none');
                        $('#errorMessagepost').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagepost').addClass('d-none');
                        $('#extraadd').modal('hide');
                        $('#saveextra')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTableex').load(location.href + " #myTableex");

                    } else if (res.status == 500) {
                        $('#errorMessagepost').addClass('d-none');
                        $('#extraadd').modal('hide');
                        $('#saveextra')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deleteexBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_idi = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_ex': true,
                        'student_idi': student_idi
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTableex').load(location.href + " #myTableex");
                        }
                    }
                });
            }
        });


        $(document).on('click', '.btnimgex', function () {

            var student_idex = $(this).val();
            $.ajax({
                type: "GET",
                url: "scode.php?student_idex=" + student_idex,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#imageex").attr("src", res.data.cert);

                        $('#studentViewModalex').modal('show');
                    }
                }
            });
        });

        //extra-curricular ends       
        //---------------------------------------------------
        //carrier progress starts

        $(document).on('submit', '#savecp', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_cp", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagecp').removeClass('d-none');
                        $('#errorMessagecp').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagecp').addClass('d-none');
                        $('#cpadd').modal('hide');
                        $('#savecp')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTablecp').load(location.href + " #myTablecp");

                    } else if (res.status == 500) {
                        $('#errorMessagecp').addClass('d-none');
                        $('#cpadd').modal('hide');
                        $('#savecp')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deletecpBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_idcp = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_cp': true,
                        'student_idcp': student_idcp
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTablecp').load(location.href + " #myTablecp");
                        }
                    }
                });
            }
        });




        //carrier progress ends       
        //---------------------------------------------------
        //placement starts

        $(document).on('submit', '#saveplace', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_place", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagep').removeClass('d-none');
                        $('#errorMessagep').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagep').addClass('d-none');
                        $('#placeadd').modal('hide');
                        $('#saveplace')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTablep').load(location.href + " #myTablep");

                    } else if (res.status == 500) {
                        $('#errorMessagep').addClass('d-none');
                        $('#placeadd').modal('hide');
                        $('#saveplace')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deleteplBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_idp = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_pl': true,
                        'student_idp': student_idp
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTablep').load(location.href + " #myTablep");
                        }
                    }
                });
            }
        });




        //placement ends       
        //---------------------------------------------------




        $(document).on('click', '.editStudentBtn', function () {

            var student_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#student_id').val(res.data.uid);

                        // $('#course2').val(res.data.course);
                        //$('#degree2').val(res.data.Degree);
                        $('#branch').val(res.data.branch);
                        $('#name').val(res.data.iname);

                        $('#univ').val(res.data.univ);
                        $('#state').val(res.data.state);
                        $('#ms').val(res.data.mos);
                        $('#mes').val(res.data.mes);

                        $('#yc').val(res.data.yc);
                        $('#cs').val(res.data.cs);
                        $('#score').val(res.data.score);
                        $('#cnum').val(res.data.cnum);
                        //$('#uploadFile').val(res.data.cert);

                        $('#studentEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#view_Course').text(res.data.course);
                        $('#view_Degree').text(res.data.Degree);
                        $('#view_branch').text(res.data.branch);
                        $('#view_iname').text(res.data.iname);
                        $('#view_univ').text(res.data.univ);

                        $('#view_state').text(res.data.state);
                        $('#view_mos').text(res.data.mos);
                        $('#view_mes').text(res.data.mes);
                        $('#view_yc').text(res.data.yc);

                        $('#view_cs').text(res.data.cs);
                        $('#view_score').text(res.data.score);
                        $('#view_cn').text(res.data.cnum);


                        $('#studentViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.btnimg', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "Acode.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#image").attr("src", res.data.cert);

                        $('#studentViewModal2').modal('show');
                    }
                }
            });
        });


        $(document).on('click', '.btnimg1', function () {

            var student_id22 = $(this).val();
            $.ajax({
                type: "GET",
                url: "Acode.php?student_id22=" + student_id22,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#image2").attr("src", res.data.paper);

                        $('#studentViewModal3').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.btnimgpr', function () {

            var student_id222 = $(this).val();
            $.ajax({
                type: "GET",
                url: "scode.php?student_id222=" + student_id222,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#imagepr").attr("src", res.data.cert);

                        $('#studentViewModal4').modal('show');
                    }
                }
            });
        });


        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "Acode.php",
                    data: {
                        'delete_student': true,
                        'student_id': student_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable2').load(location.href + " #myTable2");
                        }
                    }
                });
            }
        });

    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        // Basic Example with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });

        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
    </script>

    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <script>

        function fileValidation() {
            var fileInput =
                document.getElementById('validationCustomUsername');
            var fileSize = ((document.getElementById('validationCustomUsername').files[0].size) / 1024);
            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                swal("OOPS!", "Only Image Files are allowed!", "error");
                fileInput.value = '';
                return false;
            }
            else {
                if (fileSize > 2000) {
                    swal("OOPS!", "File size should be less than 2MB!", "error");
                    fileInput.value = '';
                    return false;
                }
            }

        }

        function fileValidation2() {
            var fileInput =
                document.getElementById('uploadFile');
            var fileSize = ((document.getElementById('uploadFile').files[0].size) / 1024);
            var filePath = fileInput.value;
            document.getElementById("tutorial").innerHTML = " ";
            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                var msg = "Only Image Files are allowed!";
                fileInput.value = '';
                document.getElementById("tutorial").innerHTML = msg;
            }
            else {
                if (fileSize > 2000) {
                    var msg = "File size should be less than 2MB!";
                    fileInput.value = '';
                    document.getElementById("tutorial").innerHTML = msg;
                }
            }



        }


        function fileValidation3() {
            var fileInput =
                document.getElementById('uploadFile2');
            var fileSize = ((document.getElementById('uploadFile2').files[0].size) / 1024);
            var filePath = fileInput.value;
            document.getElementById("tutorial2").innerHTML = " ";
            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                var msg = "Only images are allowed!";
                fileInput.value = '';
                document.getElementById("tutorial2").innerHTML = msg;
            }
            else {
                if (fileSize > 2000) {
                    var msg = "File size should be less than 2MB!";
                    fileInput.value = '';
                    document.getElementById("tutorial2").innerHTML = msg;
                }
            }



        }

        function fileValidation4() {
            var fileInput =
                document.getElementById('uploadFile4');
            var fileSize = ((document.getElementById('uploadFile4').files[0].size) / 1024);
            var filePath = fileInput.value;
            document.getElementById("tutorial4").innerHTML = " ";
            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                var msg = "Only images are allowed!";
                fileInput.value = '';
                document.getElementById("tutorial4").innerHTML = msg;
            }
            else {
                if (fileSize > 2000) {
                    var msg = "File size should be less than 2MB!";
                    fileInput.value = '';
                    document.getElementById("tutorial4").innerHTML = msg;
                }
            }



        }

    </script>


    <script>

        $(document).on('submit', '#basic', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_basic", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessageUpdate2').removeClass('d-none');
                        $('#errorMessageUpdate2').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessageUpdate2').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);



                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('submit', '#research', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_research", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorresearch').removeClass('d-none');
                        $('#errorresearch').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorresearch').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);



                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('submit', '#aprofile', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_aprofile", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#erroraprofile').removeClass('d-none');
                        $('#erroraprofile').text(res.message);

                    } else if (res.status == 200) {

                        $('#erroraprofile').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);



                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });








        $(document).on('submit', '#savejournal', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_journal", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal2').modal('hide');
                        $('#savejournal')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable3').load(location.href + " #myTable3");

                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal2').modal('hide');
                        $('#savejournal')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


        $(document).on('submit', '#savepost', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_post", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagepost').removeClass('d-none');
                        $('#errorMessagepost').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagepost').addClass('d-none');
                        $('#postingadd').modal('hide');
                        $('#savepost')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable5').load(location.href + " #myTable5");

                    } else if (res.status == 500) {
                        $('#errorMessagepost').addClass('d-none');
                        $('#postingadd').modal('hide');
                        $('#savepost')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        $(document).on('submit', '#savepunish', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_punish", true);
            console.log(formData);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessagepost9').removeClass('d-none');
                        $('#errorMessagepost9').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessagepost9').addClass('d-none');
                        $('#punishadd').modal('hide');
                        $('#savepunish')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable9').load(location.href + " #myTable9");

                    } else if (res.status == 500) {
                        $('#errorMessagepost').addClass('d-none');
                        $('#punishadd').modal('hide');
                        $('#savepunish')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });




        $(document).on('click', '.editfamilyBtn', function () {

            var student_id2 = $(this).val();

            $.ajax({
                type: "GET",
                url: "code.php?student_id2=" + student_id2,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {

                        $('#student_id2').val(res.data.uid);

                        $('#name2').val(res.data.name);
                        $('#gender').val(res.data.gender);

                        $('#relationship').val(res.data.relationship);
                        $('#mobile').val(res.data.mobile);


                        $('#studentEditModal2').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updatefamily', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_family", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#studentEditModal2').modal('hide');
                        $('#updatefamily')[0].reset();

                        $('#myTable1').load(location.href + " #myTable1");

                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deletefamilyBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id3 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_family': true,
                        'student_id3': student_id3
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable1').load(location.href + " #myTable1");
                        }
                    }
                });
            }
        });



        $(document).on('click', '.deletejBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id4 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "Acode.php",
                    data: {
                        'delete_journal': true,
                        'student_id4': student_id4
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable3').load(location.href + " #myTable3");
                        }
                    }
                });
            }
        });




        $(document).on('click', '.deletepBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id6 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "Acode.php",
                    data: {
                        'delete_post': true,
                        'student_id6': student_id6
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable5').load(location.href + " #myTable5");
                        }
                    }
                });
            }
        });




    </script>


</body>

</html>