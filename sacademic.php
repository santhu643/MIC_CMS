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
            text-align: center;
        }

        .alertify-notifier .ajs-error {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
        }

        .alertify-notifier .ajs-success {
            background: blue;
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
                        <h4 class="page-title">Academic Profile</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Academic Profile Information
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
                        <h4 class="card-title">Academic Profile Information</h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#acad"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-cup"></i><b> International Certifications</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-desktop"></i><b> Projects Done</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-tablet"></i><b> Internship/Courses</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#lang"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="bi bi-people-fill"></i><b> International Languages</b></span></a>
                                </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#posting"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-book"></i><b> Co-Curricular</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#train"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-game"></i><b> Extra-Curricular</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#research"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Assessment Score</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#punish"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-medall-alt"></i><b> Placement Details</b></span></a> </li>

                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">

                                <!-- ta1 -->

                                <div class="tab-pane active p-20" id="acad" role="tabpanel">

                                    <div class="modal fade" id="pcadd" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add International
                                                        Certifications
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="pcadd2">
                                                    <div class="modal-body">

                                                        <div id="errorMessage" class="alert alert-warning d-none"></div>


                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Name of the Certification *</label>
                                                            <input type="text" name="cname" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Duration *</label>
                                                            <input type="text" name="duration" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Organizer *</label>
                                                            <input type="text" name="organiser" class="form-control" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label> </br>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile" onchange="return fileValidation2()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file(Image)</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="modal fade" id="studentViewModal4" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="imagepr" src="" alt="prizes" class="center"
                                                        style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>International Certifications

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#pcadd">
                                                            Add Certifications Details
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTablepr"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>.
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Name of the Certificate</b></th>
                                                                    <th><b>Duration</b></th>
                                                                    <th><b>Organizer</b></th>

                                                                    <th><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM s_i_certification where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['cname'] ?></td>
                                                                            <td><?= $student['duration'] ?></td>
                                                                            <td><?= $student['organiser'] ?></td>

                                                                            <td align="center"><button type="button"
                                                                                    id="ledonof" value="<?= $student['uid']; ?>"
                                                                                    class="btnimgcert btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#studentViewModal4">View</button>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deletepcBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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


                                </div>


                                <!-- tab1 end -->


                                <!-- Language tab start -->
                                <div class="tab-pane p-20" id="lang" role="tabpanel">

                                    <div class="modal fade" id="lanadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add International
                                                        Language
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>

                                                <form id="lanaddf">
                                                    <div class="modal-body">

                                                        <div id="errorMessage5" class="alert alert-warning d-none">
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>


                                                        <!-- <div class="mb-3">
                                                            <label for="">Name of the event *</label>
                                                            <input type="text" name="event" class="form-control" />
                                                        </div> -->

                                                        <div class="mb-3">
                                                            <label for="">Language *</label>
                                                            <select class="form-control" name="language" id="type"
                                                                required>
                                                                <option value="">Select type</option>
                                                                <option value="Japanese">Japanese</option>
                                                                <option value="German">German</option>
                                                                <option value="Chinese">Chinese</option>
                                                                <!-- <option value="State Level">State Level</option>
                                                                <option value="National Level">National Level</option>
                                                                <option value="International Level">International Level -->
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Level *</label>
                                                            <input type="text" name="level" class="form-control" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label> </br>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile5" onchange="return fileValidation5()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file(Image)</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial5"></p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal fade" id="ViewModal4" tabindex="-1"
                                        aria-labelledby="documentPreviewLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="documentPreviewLabel">Document Preview
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Container for image/PDF -->
                                                    <div id="documentContainer" class="text-center">
                                                        <!-- Content will be loaded here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="studentViewModal4" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Prizes</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="imagepr" src="" alt="prizes" class="center"
                                                        style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Language Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#lanadd">
                                                            Add Language Details
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTablelan"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>.
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Language</b></th>
                                                                    <th><b>Level</b></th>
                                                                    <th><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM slang where uid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['lang'] ?></td>
                                                                            <td><?= $student['level'] ?></td>
                                                                            <td align="center">
                                                                                <button type="button" id="ledonof"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="btnimglang btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#ViewModal4"
                                                                                    data-file="<?= $student['cert']; ?>">
                                                                                    View
                                                                                </button>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['id']; ?>"
                                                                                        class="deletelangBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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
                                </div>
                                <!-- language tab end -->


                                <div class="tab-pane p-20" id="home" role="tabpanel">


                                    <!-- Add porject -->
                                    <div class="modal fade" id="projectadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Project Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="saveproject">
                                                    <div class="modal-body">

                                                        <div id="errorMessagepost" class="alert alert-warning d-none">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3"><label for="">Semester *</label>
                                                            <select class="form-control" name="sem" id="cs" required>
                                                                <option value="">Select</option>
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
                                                            <label for="">Title of the Project *</label>
                                                            <input type="text" name="ti" class="form-control"
                                                                required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Github Link *</label>
                                                            <input type="text" name="gl" class="form-control"
                                                                required />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Remarks *</label>
                                                            <input type="text" name="rm" class="form-control"
                                                                required />
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Project Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#projectadd">
                                                            Add Project
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable0" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Semester</b></th>
                                                                    <th><b>Title of the project</b></th>
                                                                    <th
                                                                        style="word-wrap: break-word; white-space: normal; max-width: 50px;">
                                                                        <b>Github link</b>
                                                                    </th>
                                                                    <th><b>Remarks</b></th>
                                                                    <th><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM sproject WHERE sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['semester'] ?></td>
                                                                            <td><?= $student['title'] ?></td>
                                                                            <td
                                                                                style="word-wrap: break-word; max-width: 150px; overflow-wrap: break-word;">
                                                                                <?= $student['github'] ?>
                                                                            </td>
                                                                            <td><?= $student['remark'] ?></td>
                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deletePrBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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









                                </div>

                                <!-- tab2 end -->


                                <div class="tab-pane  p-20" id="profile" role="tabpanel">



                                    <div class="modal fade" id="iadd" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Internship /
                                                        Course Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="iadd2">
                                                    <div class="modal-body">

                                                        <div id="errorMessagei" class="alert alert-warning d-none">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Name of the Program / Title *</label>
                                                            <input type="text" name="event" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Type *</label>
                                                            <select class="form-control" name="type" id="type" required>
                                                                <option value="">Select type</option>
                                                                <option value="Internship">Internship</option>
                                                                <option value="Course">Course</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Organizer *</label>
                                                            <input type="text" name="organiser" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Duration *</label>
                                                            <input type="text" name="dur" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Remarks *</label>
                                                            <input type="text" name="rem" class="form-control" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label> </br>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile" onchange="return fileValidation2()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file(Image)</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>



                                    <!-- <div class="modal fade" id="studentViewModali" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> 
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="imagei" src="" alt="prizes" class="center"
                                                        style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="modal fade" id="studentViewModali" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="imagei" src="" alt="Certificate" class="img-fluid"
                                                        style="max-width:80%; max-height:70vh;">
                                                    <iframe id="pdfi" src=""
                                                        style="width:100%; height:70vh; border:none; display:none;"></iframe>
                                                    <div id="noContentMessage" class="alert alert-info"
                                                        style="display:none;">
                                                        No content available
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Internship / Course Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#iadd">
                                                            Add Internship / Course Details
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTablei" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Name of the Program / Title</b></th>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Organizer</b></th>
                                                                    <th><b>Duration</b></th>
                                                                    <th><b>Remarks</b></th>
                                                                    <th><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM sintern where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['iname'] ?></td>
                                                                            <td><?= $student['type'] ?></td>
                                                                            <td><?= $student['org'] ?></td>
                                                                            <td><?= $student['dur'] ?></td>
                                                                            <td><?= $student['rem'] ?></td>
                                                                            <td align="center"><button type="button"
                                                                                    id="ledonof" value="<?= $student['uid']; ?>"
                                                                                    class="btnimgi btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#studentViewModali">View</button>
                                                                            </td>
                                                                            <!-- 
                                                                            <td align="center">
                                                                                <button type="button" id="ledonof"
                                                                                    data-uid="<?= $student['uid']; ?>"
                                                                                    data-cert="sintern"
                                                                                    class="btnimgcert btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#studentViewModal4">
                                                                                    View
                                                                                </button>
                                                                            </td> -->

                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deleteiBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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



                                </div>

                                <!--profile tab end (internship) -->




                                <!--Posting(co-curricular) tab starts -->


                                <div class="tab-pane  p-20" id="posting" role="tabpanel">


                                    <!-- Add posting -->
                                    <div class="modal fade" id="postingadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Co-Curricular
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="savepost">
                                                    <div class="modal-body">

                                                        <div id="errorMessagepost" class="alert alert-warning d-none">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Name of the event *</label>
                                                            <input type="text" name="event" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Level *</label>
                                                            <select class="form-control" name="level" id="type"
                                                                required>
                                                                <option value="">Select type</option>
                                                                <option value="School Level">School Level</option>
                                                                <option value="College Level">College Level</option>
                                                                <option value="Zonal Level">Zonal Level</option>
                                                                <option value="State Level">State Level</option>
                                                                <option value="National Level">National Level</option>
                                                                <option value="International Level">International Level
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Organizer *</label>
                                                            <input type="text" name="organiser" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Prize *</label>
                                                            <select class="form-control" name="prize" id="type"
                                                                required>
                                                                <option value="">Select type</option>
                                                                <option value="I">I</option>
                                                                <option value="II">II</option>
                                                                <option value="III">III</option>
                                                                <option value="Participation">Participation</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label> </br>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile" onchange="return fileValidation2()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file(Image)</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>




                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="studentViewModalco" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="imagei2" src="" alt="Certificate" class="img-fluid"
                                                        style="max-width:80%; max-height:70vh;">
                                                    <iframe id="pdfi2" src=""
                                                        style="width:100%; height:70vh; border:none; display:none;"></iframe>
                                                    <div id="noContentMessage2" class="alert alert-info"
                                                        style="display:none;">
                                                        No content available
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Co-Curricular Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#postingadd">
                                                            Add Co-Curricular
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTablecc"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Name of the event</b></th>
                                                                    <th><b>Level</b></th>
                                                                    <th><b>Organizer</b></th>
                                                                    <th><b>Prize</b></th>
                                                                    <th><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM scocu where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['event'] ?></td>
                                                                            <td><?= $student['level'] ?></td>
                                                                            <td><?= $student['organiser'] ?></td>
                                                                            <td><?= $student['prize'] ?></td>
                                                                            <td align="center"><button type="button"
                                                                                    id="ledonof" value="<?= $student['uid']; ?>"
                                                                                    class="btnimgco btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#studentViewModalco">View</button>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deletecoBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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





                                </div>

                                <!-- posting tab ending -->


                                <!--Punish tab starts -->


                                <div class="tab-pane  p-20" id="punish" role="tabpanel">


                                    <!-- Add posting -->
                                    <div class="modal fade" id="placeadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Placement Details
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="saveplace">
                                                    <div class="modal-body">

                                                        <div id="errorMessagep" class="alert alert-warning d-none">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Date *</label>
                                                            <input type="date" name="dt" class="form-control"
                                                                required />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Name of the Company *</label>
                                                            <input type="text" name="nc" class="form-control"
                                                                required />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Designation & Salary Package</label>
                                                            <input type="text" name="ds" class="form-control"
                                                                required />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Result *</label>
                                                            <select class="form-control" name="pr" id="type" required>
                                                                <option value="">Select type</option>
                                                                <option value="Selected">Selected</option>
                                                                <option value="Not Selected">Not Selected</option>

                                                            </select>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Placement Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#placeadd">
                                                            Add Placement
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTablep" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Date</b></th>
                                                                    <th><b>Name of the Company</b></th>
                                                                    <th><b>Designation & Salary Package</b></th>
                                                                    <th><b>Performance / Result</b></th>

                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM splacement where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['date'] ?></td>
                                                                            <td><?= $student['np'] ?></td>
                                                                            <td><?= $student['ds'] ?></td>
                                                                            <td><?= $student['pr'] ?></td>

                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deleteplBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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





                                </div>

                                <!-- punish tab ending -->


                                <!-- Extra Curricular tab -->

                                <div class="tab-pane p-20" id="train" role="tabpanel">


                                    <div class="modal fade" id="extraadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Extra-Curricular
                                                        Details</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="saveextra">
                                                    <div class="modal-body">

                                                        <div id="errorMessagepost" class="alert alert-warning d-none">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Academic Year *</label>
                                                            <select class="form-control" name="ayear" id="ayear"
                                                                required>
                                                                <?php
                                                                include 'get_academic_years.php';
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Name of the event *</label>
                                                            <input type="text" name="event" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Level *</label>
                                                            <select class="form-control" name="level" id="type"
                                                                required>
                                                                <option value="">Select type</option>
                                                                <option value="School Level">School Level</option>
                                                                <option value="College Level">College Level</option>
                                                                <option value="Zonal Level">Zonal Level</option>
                                                                <option value="State Level">State Level</option>
                                                                <option value="National Level">National Level</option>
                                                                <option value="International Level">International Level
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Organizer *</label>
                                                            <input type="text" name="organiser" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Prize *</label>
                                                            <select class="form-control" name="prize" id="type"
                                                                required>
                                                                <option value="">Select type</option>
                                                                <option value="I">I</option>
                                                                <option value="II">II</option>
                                                                <option value="III">III</option>
                                                                <option value="Participation">Participation</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label> </br>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile" onchange="return fileValidation2()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file(Image)</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>




                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="studentViewModalex" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img id="imagei3" src="" alt="Certificate" class="img-fluid"
                                                        style="max-width:80%; max-height:70vh;">
                                                    <iframe id="pdfi3" src=""
                                                        style="width:100%; height:70vh; border:none; display:none;"></iframe>
                                                    <div id="noContentMessage3" class="alert alert-info"
                                                        style="display:none;">
                                                        No content available
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Extra-Curricular Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#extraadd">
                                                            Add Extra-Curricular
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTableex"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Academic Year</b></th>
                                                                    <th><b>Name of the event</b></th>
                                                                    <th><b>Level</b></th>
                                                                    <th><b>Organizer</b></th>
                                                                    <th><b>Prize</b></th>
                                                                    <th><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM st_extra where sid='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['ayear'] ?></td>
                                                                            <td><?= $student['event'] ?></td>
                                                                            <td><?= $student['level'] ?></td>
                                                                            <td><?= $student['organiser'] ?></td>
                                                                            <td><?= $student['prize'] ?></td>
                                                                            <td align="center"><button type="button"
                                                                                    id="ledonof" value="<?= $student['uid']; ?>"
                                                                                    class="btnimgex btn-success btn-sm"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#studentViewModalex">View</button>
                                                                            </td>
                                                                            <td align="center">
                                                                                <?php if ($student['status'] == 1): ?>
                                                                                    <button type="button"
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                <?php else: ?>
                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deleteexBtn btn btn-danger btn-sm">Delete</button>
                                                                                <?php endif; ?>
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




                                </div>

                                <!-- Extra Curricular ending -->

                                <!-- Skill Training Starts -->
                                <div class="tab-pane p-20" id="research" role="tabpanel">

                                    <div class="modal fade" id="cpadd" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Assessment Score
                                                    </h5>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                                    </button>
                                                </div>
                                                <form id="savecp">
                                                    <div class="modal-body">

                                                        <div id="errorMessagecp" class="alert alert-warning d-none">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Date *</label>
                                                            <input type="Date" name="dt" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">HackerRank *</label>
                                                            <input type="text" name="hr" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">SkillRack/Codetantra *</label>
                                                            <input type="text" name="sr" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Other</label>
                                                            <input type="text" name="ict" placeholder="Ex: Codechef:80"
                                                                class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Assessment Score Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#cpadd">
                                                            Add Assessment Score
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTablecp"
                                                            class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Date</b></th>
                                                                    <th><b>HackerRank</b></th>
                                                                    <th><b>SkillRack/Codetantra</b></th>
                                                                    <th><b>Other</b></th>
                                                                    <th><b>Action Taken</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM straining where sid='$s' ORDER BY uid DESC";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['date'] ?></td>

                                                                            <td><?= $student['hack'] ?></td>
                                                                            <td><?= $student['skill'] ?></td>
                                                                            <td><?= $student['ict'] ?></td>
                                                                            <td><?php if ($student['status'] == 1) {
                                                                                echo $student['action'];
                                                                            }
                                                                            ?></td>
                                                                            <td align="center">


                                                                                <?php
                                                                                if ($student['status'] == 0) { ?>

                                                                                    <button type="button"
                                                                                        value="<?= $student['uid']; ?>"
                                                                                        class="deletecpBtn btn btn-danger  btn-sm">Delete</button>
                                                                                    <button type="button" value=""
                                                                                        class="btn btn-warning btn-sm">Pending</button>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <button type="button" value=""
                                                                                        class="btn btn-success btn-sm">Approved</button>
                                                                                    <?php
                                                                                }
                                                                                ?>
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




                                </div>

                                <!-- Skill Training ending -->







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

        function showContent(type, source) {
            // Reset all content
            document.getElementById('imagei').style.display = 'none';
            document.getElementById('pdfi').style.display = 'none';
            document.getElementById('noContentMessage').style.display = 'none';

            // Show appropriate content
            if (type === 'image') {
                const imgElement = document.getElementById('imagei');
                imgElement.src = source;
                imgElement.style.display = 'block';
            } else if (type === 'pdf') {
                const pdfElement = document.getElementById('pdfi');
                pdfElement.src = source;
                pdfElement.style.display = 'block';
            } else {
                document.getElementById('noContentMessage').style.display = 'block';
            }

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('studentViewModali'));
            modal.show();
        }





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
            formData.append("save_i_certification", true);
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
                        'delete_i_certification': true,
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

        $(document).on('click', '.btnimgcert', function () {

            var student_id222 = $(this).val();
            console.log(student_id222);
            $.ajax({
                type: "GET",
                url: "scode.php?student_i_certification=" + student_id222,
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


        //language starts

        $(document).on('submit', '#lanaddf', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_lang", true);
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
                        $('#errorMessage5').removeClass('d-none');
                        $('#errorMessage5').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorMessage5').addClass('d-none');
                        $('#lanadd').modal('hide');
                        $('#lanaddf')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTablelan').load(location.href + " #myTablelan");


                    } else if (res.status == 500) {
                        $('#errorMessage5').addClass('d-none');
                        $('#lanadd').modal('hide');
                        $('#lanaddf')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.deletelangBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "scode.php",
                    data: {
                        'delete_lang': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTablelan').load(location.href + " #myTablelan");
                        }
                    }
                });
            }
        });

        // $(document).on('click', '.btnimgpr', function () {

        //     var student_id222 = $(this).val();
        //     $.ajax({
        //         type: "GET",
        //         url: "scode.php?student_id222=" + student_id222,
        //         success: function (response) {

        //             var res = jQuery.parseJSON(response);
        //             if (res.status == 404) {

        //                 alert(res.message);
        //             } else if (res.status == 200) {


        //                 $("#imagepr").attr("src", res.data.cert);

        //                 $('#studentViewModal4').modal('show');
        //             }
        //         }
        //     });
        // });


        //language ends

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


        //view intern image

        $(document).on('click', '.btnimgi', function () {
            var student_idii = $(this).val();
            $.ajax({
                type: "GET",
                url: "scode.php?student_idiintern=" + student_idii,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $('#pdfi').hide();
                        $('#noContentMessage').hide();

                        if (res.data.cert.toLowerCase().endsWith('.pdf')) {
                            $('#pdfi').attr('src', res.data.cert).show();
                            $('#imagei').hide();
                        } else {
                            $('#imagei').attr("src", res.data.cert).show();
                            $('#pdfi').hide();
                        }
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

                        $('#pdfi2').hide();
                        $('#noContentMessage2').hide();

                        if (res.data.cert.toLowerCase().endsWith('.pdf')) {
                            $('#pdfi2').attr('src', res.data.cert).show();
                            $('#imagei2').hide();
                        } else {
                            $('#imagei2').attr("src", res.data.cert).show();
                            $('#pdfi2').hide();
                        }

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
                        $('#pdfi3').hide();
                        $('#noContentMessage3').hide();

                        if (res.data.cert.toLowerCase().endsWith('.pdf')) {
                            $('#pdfi3').attr('src', res.data.cert).show();
                            $('#imagei3').hide();
                        } else {
                            $('#imagei3').attr("src", res.data.cert).show();
                            $('#pdfi3').hide();
                        }

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

        function fileValidation5() {
            var fileInput =
                document.getElementById('uploadFile5');
            var fileSize = ((document.getElementById('uploadFile5').files[0].size) / 1024);
            var filePath = fileInput.value;
            document.getElementById("tutorial5").innerHTML = " ";
            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                var msg = "Only images are allowed!";
                fileInput.value = '';
                document.getElementById("tutorial5").innerHTML = msg;
            }
            else {
                if (fileSize > 2000) {
                    var msg = "File size should be less than 2MB!";
                    fileInput.value = '';
                    document.getElementById("tutorial5").innerHTML = msg;
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add click event listener to all view buttons
            const viewButtons = document.querySelectorAll('.btnimglang');

            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const container = document.getElementById('documentContainer');
                    container.innerHTML = ''; // Clear previous content

                    // Get the file URL directly from the data attribute
                    const fileUrl = this.getAttribute('data-file');
                    const fileExtension = fileUrl.split('.').pop().toLowerCase();

                    if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                        // If it's an image
                        const img = document.createElement('img');
                        img.src = fileUrl;
                        img.className = 'img-fluid';
                        img.style.maxHeight = '70vh';
                        container.appendChild(img);
                    } else if (fileExtension === 'pdf') {
                        // If it's a PDF
                        const embed = document.createElement('embed');
                        embed.src = fileUrl;
                        embed.type = 'application/pdf';
                        embed.style.width = '100%';
                        embed.style.height = '70vh';
                        container.appendChild(embed);
                    } else {
                        container.innerHTML = '<p class="text-danger">Unsupported file type</p>';
                    }
                });
            });
        });
    </script>
</body>

</html>