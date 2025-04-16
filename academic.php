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
    <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            } else if (val.value == 'Copyright') {
                document.getElementById('pstatus').classList.add('d-none');
                document.getElementById('cstatus').classList.remove('d-none');
            } else {
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

        th {
            /* background-color:#7460ee; */
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
            text-align: center;
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
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="main">
                        <!-- Logo icon -->

                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="assets/images/srms.png" alt="homepage" class="light-logo" />

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
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">

                                <a class="dropdown-item" href="Logout.php"><i class="ti-power-off m-r-5 m-l-5"></i> Logout</a>
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
        <?php

        include("side.php");
        ?>
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
                                    <li class="breadcrumb-item active" aria-current="page">Academic Profile Information</li>
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
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#acad" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="ti-info-alt"></i><b> Academic profile</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi-person"></i><b> Experience</b></span></a> </li>
                                <!--  
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-book"></i><b> Journal</b></span></a> </li>
                            
								<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-people-fill"></i><b> Patent/Copyright</b></span></a> </li>
								-->
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#posting" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-people-fill"></i><b> Posting</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#train" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-book"></i><b> Trainings</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#research" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-search"></i><b> Research Identity</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#punish" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="ti-face-sad"></i><b> Punishment</b></span></a> </li>

                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">

                                <!-- ta1 -->

                                <div class="tab-pane active" id="acad" role="tabpanel">

                                    <form id="aprofile" class="needs-validation" novalidate>
                                        <div id="erroraprofile" class="alert alert-warning d-none"></div>
                                        <div class="card-header">
                                            <h4> Academic Profile </h4>
                                        </div>



                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Faculty ID *</label>
                                                <input type="text" name="id" class="form-control" id="validationCustom01" placeholder="Faculy Id" value="<?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                                                                echo $student2['id'];
                                                                                                                                                            } else {
                                                                                                                                                                echo "";
                                                                                                                                                            } ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Faculty Name *</label>
                                                <input type="text" class="form-control" name="name" id="validationCustom02" placeholder="Faculty Name" value="<?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                                                                    echo $student2['name'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo "";
                                                                                                                                                                } ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Designation *</label>

                                                <select class="form-control" name="design" id="pstatuss" required>
                                                    <option value="">Select designation</option>
                                                    <option value="Assistant Professor" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                            if ($student2['design'] == "Assistant Professor") echo 'selected="selected"';
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>>Assistant Professor</option>
                                                    <option value="Associate Professor" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                            if ($student2['design'] == "Associate Professor") echo 'selected="selected"';
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>>Associate Professor</option>
                                                    <option value="Professor" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                    if ($student2['design'] == "Professor") echo 'selected="selected"';
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>>Professor</option>
                                                    <option value="Lab Instructor" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                        if ($student2['design'] == "Lab Instructor") echo 'selected="selected"';
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>>Lab Instructor</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Role*</label>
                                                <select class="form-control" name="role" id="pstatuss" required disabled>
                                                    <option value="">Select role</option>
                                                    <option value="Faculty" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                if ($student2['role'] == "Faculty") echo 'selected="selected"';
                                                                            } else {
                                                                                echo "";
                                                                            } ?>>Faculty</option>
                                                    <option value="HOD" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                            if ($student2['role'] == "HOD") echo 'selected="selected"';
                                                                        } else {
                                                                            echo "";
                                                                        } ?>>HOD</option>
                                                    <option value="Principal" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                    if ($student2['role'] == "Principal") echo 'selected="selected"';
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>>Principal</option>
                                                    <option value="Lab Instructor" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                        if ($student2['role'] == "Lab Instructor") echo 'selected="selected"';
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>>Lab Instructor</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Department*</label>
                                                <select class="form-control" name="dept" id="pstatuss" required>
                                                    <option value="">Select department</option>
                                                    <option value="Artificial Intelligence and Data Science" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                    if ($student2['dept'] == "Artificial Intelligence and Data Science") echo 'selected="selected"';
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>>Artificial Intelligence and Data Science</option>

                                                    <option value="Artificial Intelligence and Machine Learning" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                        if ($student2['dept'] == "Artificial Intelligence and Machine Learning") echo 'selected="selected"';
                                                                                                                    } else {
                                                                                                                        echo "";
                                                                                                                    } ?>>Artificial Intelligence and Machine Learning</option>

                                                    <option value="Civil Engineering" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                            if ($student2['dept'] == "Civil Engineering") echo 'selected="selected"';
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>>Civil Engineering</option>

                                                    <option value="Computer Science and Business Systems" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                if ($student2['dept'] == "Computer Science and Business Systems") echo 'selected="selected"';
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>>Computer Science and Business Systems</option>

                                                    <option value="Computer Science and Engineering" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                            if ($student2['dept'] == "Computer Science and Engineering") echo 'selected="selected"';
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>Computer Science and Engineering</option>

                                                    <option value="Electrical and Electronics Engineering" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                if ($student2['dept'] == "Electrical and Electronics Engineering") echo 'selected="selected"';
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>>Electrical and Electronics Engineering</option>

                                                    <option value="Electronics Engineering (VLSI Design)" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                if ($student2['dept'] == "Electronics Engineering (VLSI Design)") echo 'selected="selected"';
                                                                                                            } else {
                                                                                                                echo "";
                                                                                                            } ?>>Electronics Engineering (VLSI Design)</option>

                                                    <option value="Electronics and Communication Engineering" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                    if ($student2['dept'] == "Electronics and Communication Engineering") echo 'selected="selected"';
                                                                                                                } else {
                                                                                                                    echo "";
                                                                                                                } ?>>Electronics and Communication Engineering</option>

                                                    <option value="Information Technology" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                if ($student2['dept'] == "Information Technology") echo 'selected="selected"';
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>>Information Technology</option>

                                                    <option value="Mechanical Engineering" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                if ($student2['dept'] == "Mechanical Engineering") echo 'selected="selected"';
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>>Mechanical Engineering</option>

                                                    <option value="Freshman Engineering" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                if ($student2['dept'] == "Freshman Engineering") echo 'selected="selected"';
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>>Freshman Engineering</option>

                                                    <option value="Master of Business Administration" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                            if ($student2['dept'] == "Master of Business Administration") echo 'selected="selected"';
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>>Master of Business Administration</option>

                                                    <option value="Master of Computer Applications" <?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                        if ($student2['dept'] == "Master of Computer Applications") echo 'selected="selected"';
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>>Master of Computer Applications</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Date of Joining *</label>
                                                <input type="date" class="form-control" name="doj" id="validationCustom02" placeholder="Last Name" value="<?php if (mysqli_num_rows($query_run2) == 1) {
                                                                                                                                                                echo $student2['doj'];
                                                                                                                                                            } else {
                                                                                                                                                                echo "";
                                                                                                                                                            } ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">

                                            <div class="mb-3">
                                                <label for="">Appointment Order *</label>
                                                <label for="">(upload less than 2 mb)</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile4" onchange="return fileValidation4()" aria-describedby="inputGroupPrepend" required>
                                                    <label class="custom-file-label" for="customFile">Upload 1st page as image</label>
                                                </div>
                                                <p style="color:red;" id="tutorial4"></p>
                                            </div>
                                        </div>


                                        <button class="btn btn-primary" type="submit">Submit</button>


                                    </form>



                                </div>


                                <!-- tab1 end -->



                                <div class="tab-pane" id="home" role="tabpanel">

                                    <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Experience Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="saveexp">
                                                    <div class="modal-body">

                                                        <div id="errorMessage" class="alert alert-warning d-none"></div>


                                                        <div class="mb-3">
                                                            <label for="">Current Job *</label>
                                                            <select class="form-control" name="cj" id="cj" onchange="if(this.value=='no'){this.form['tod'].style.visibility='visible'}else {this.form['tod'].style.visibility='hidden'};" required>
                                                                <option value="">Select</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Type *</label>
                                                            <select class="form-control" name="type" id="type" required>
                                                                <option value="">Select type</option>
                                                                <option value="Teaching">Teaching</option>
                                                                <option value="Research">Research</option>
                                                                <option value="Industry">Industry</option>
                                                                <option value="Adminstrative">Adminstrative</option>
                                                                <option value="Support">Support</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Institution / Corporate Name *</label>
                                                            <input type="text" name="iname" id="iname" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Designation *</label>
                                                            <input type="text" name="design" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Role *</label>
                                                            <select class="form-control" name="role">
                                                                <option value="">Select role</option>
                                                                <option value="Full time">Full time</option>
                                                                <option value="Part Time">Part Time</option>
                                                                <option value="Visiting">Visiting</option>
                                                                <option value="Adjunt">Adjunt</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">From *</label>
                                                            <input type="date" name="fromd" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">To *</label>
                                                            <input type="date" name="tod" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Exp Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label> </br>
                                                            <p> (for Current job upload joining order)</p>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile" onchange="return fileValidation2()" aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose file(Image)</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Student Modal -->
                                    <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="updateStudent">
                                                    <div class="modal-body">

                                                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                                                        <input type="hidden" name="student_id" id="student_id">


                                                        <div class="mb-3">
                                                            <label for="">Current Job *</label>
                                                            <select class="form-control" name="cj" id="cj" onchange="if(this.value=='no'){this.form['tod'].style.visibility='visible'}else {this.form['tod'].style.visibility='hidden'};" required>
                                                                <option value="">Select</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Course *</label>
                                                            <select class="form-control" name="course" id="course2" required>
                                                                <option value="">Select Course</option>
                                                                <option value="SSLC">SSLC</option>
                                                                <option value="HSC">HSC</option>
                                                                <option value="ITI">ITI</option>
                                                                <option value="DIPLOMA">DIPLOMA</option>
                                                                <option value="UG">UG</option>
                                                                <option value="PG">PG</option>
                                                                <option value="PHD">PHD</option>
                                                                <option value="PDF">PDF</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="validationCustom03">Degree *</label>
                                                            <select class="form-control" name="degree" id="degree2" required>
                                                                <option value="">Select Degree</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Specialization / Branch *</label>
                                                            <input type="text" name="branch" id="branch" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Institution Name *</label>
                                                            <input type="text" name="name" id="name" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Board/University *</label>
                                                            <input type="text" name="univ" id="univ" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">State *</label>
                                                            <select class="form-control" name="state" id="state">
                                                                <option value="">Select State</option>
                                                                <option value="Andra Pradesh">Andra Pradesh</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                                <option value="Jharkhand">Jharkhand</option>
                                                                <option value="Karnataka">Karnataka</option>
                                                                <option value="Kerala">Kerala</option>
                                                                <option value="Madya Pradesh">Madya Pradesh</option>
                                                                <option value="Maharashtra">Maharashtra</option>
                                                                <option value="Manipur">Manipur</option>
                                                                <option value="Meghalaya">Meghalaya</option>
                                                                <option value="Mizoram">Mizoram</option>
                                                                <option value="Nagaland">Nagaland</option>
                                                                <option value="Orissa">Orissa</option>
                                                                <option value="Punjab">Punjab</option>
                                                                <option value="Rajasthan">Rajasthan</option>
                                                                <option value="Sikkim">Sikkim</option>
                                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                                <option value="Telangana">Telangana</option>
                                                                <option value="Tripura">Tripura</option>
                                                                <option value="Uttaranchal">Uttaranchal</option>
                                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                                <option value="West Bengal">West Bengal</option>
                                                                <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                                <option value="Daman and Diu">Daman and Diu</option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Lakshadeep">Lakshadeep</option>
                                                                <option value="Pondicherry">Pondicherry</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Mode of Study *</label>
                                                            <select class="form-control" name="ms" id="ms" required>
                                                                <option value="">Select Degree</option>
                                                                <option value="Full Time">Full Time</option>
                                                                <option value="Part time">Part time</option>
                                                                <option value="Distance">Distance</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Medium of Study *</label>
                                                            <input type="text" name="mes" id="mes" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Year of Completion *</label>
                                                            <input type="text" name="yc" id="yc" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Completion Status *</label>
                                                            <select class="form-control" name="cs" id="cs" required>
                                                                <option value="">Select</option>
                                                                <option value="Completed">Completed</option>
                                                                <option value="Pursuing">Pursuing</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Score Obtained (%)*</label>
                                                            <input type="text" name="score" id="score" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Certification Number *</label>
                                                            <input type="text" name="cnum" id="cnum" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile" onchange="return fileValidation2()" aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Student</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- View Student Modal -->
                                    <div class="modal fade" id="studentViewModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="image" src="" alt="Computer man" class="center" style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Student Modal -->
                                    <div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="">Course</label>
                                                        <p id="view_Course" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Degree</label>
                                                        <p id="view_Degree" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Specialization / Branch</label>
                                                        <p id="view_branch" class="form-control"></p>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="">Institution Name</label>
                                                        <p id="view_iname" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Board/University</label>
                                                        <p id="view_univ" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">State</label>
                                                        <p id="view_state" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Mode of Study</label>
                                                        <p id="view_mos" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Medium of Study</label>
                                                        <p id="view_mes" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Year of Completion</label>
                                                        <p id="view_yc" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Completion Status</label>
                                                        <p id="view_cs" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Score Obtained</label>
                                                        <p id="view_score" class="form-control"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="">Certification Number</label>
                                                        <p id="view_cn" class="form-control"></p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Academic Details

                                                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentAddModal">
                                                            Add details
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">




                                                    <div class="table-responsive">
                                                        <table id="myTable2" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Institution/Corporate Name</b></th>
                                                                    <th><b>Designation</b></th>
                                                                    <th><b>From</b></th>
                                                                    <th><b>To</b></th>
                                                                    <th><b>Duration</b></th>
                                                                    <th align="center"><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php




                                                                $query = "SELECT * FROM exp where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    foreach ($query_run as $student) {

                                                                        if ($student['tod'] == "0000-00-00") {
                                                                            $ssss = "Current";
                                                                        } else {
                                                                            $ssss = $student['tod'];
                                                                        }

                                                                ?>
                                                                        <tr>
                                                                            <td><?= $student['type'] ?></td>
                                                                            <td><?= $student['iname'] ?></td>
                                                                            <td><?= $student['design'] ?></td>
                                                                            <td><?= $student['fromd'] ?></td>
                                                                            <td><?php echo $ssss; ?></td>
                                                                            <td><?= $student['exp'] ?></td>
                                                                            <td align="center"><button type="button" id="ledonof" value="<?= $student['uid']; ?>" class="btnimg btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModal2">View</button></td>
                                                                            <td>
                                                                                <!--    <button type="button" value="<?= $student['uid']; ?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?= $student['uid']; ?>" class="editStudentBtn btn btn-success btn-sm">Edit</button>-->
                                                                                <button type="button" value="<?= $student['uid']; ?>" class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>

                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </tbody>



                                                            <thead>
                                                                <?php
                                                                $v = 0;
                                                                $query = "select id, sum( datediff( ifnull(tod, now()) , fromd) +1 )AS value_sum from exp group by id having id='$s';";
                                                                $query_run = mysqli_query($db, $query);
                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $student = mysqli_fetch_assoc($query_run);
                                                                    $sum = $student['value_sum'];

                                                                    $years = floor($sum / 365);
                                                                    $months = floor(($sum - ($years * 365)) / 30.5);
                                                                    $days = floor($sum - ($years * 365) - ($months * 30.5));
                                                                    //echo "Days received: " . $sum . " days <br />";
                                                                    $v = $years . " years, " . $months . "months, " . $days . "days";
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td colspan="8" align="center"><b>Total Experience : <?= $v ?></b></td>
                                                                </tr>
                                                            </thead>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>


                                <div class="tab-pane  p-20" id="profile" role="tabpanel">

                                    <!-- Add journal -->
                                    <div class="modal fade" id="studentAddModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Journal Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="savejournal">
                                                    <div class="modal-body">

                                                        <div id="errorMessage" class="alert alert-warning d-none"></div>


                                                        <div class="mb-3">
                                                            <label for="">Paper Title *</label>
                                                            <input type="text" name="pt" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Journal Name *</label>
                                                            <input type="text" name="jn" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Publisher Name *</label>
                                                            <input type="text" name="pn" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Volume *</label>
                                                            <input type="text" name="vol" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Issue *</label>
                                                            <input type="text" name="issue" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Pages*</label>
                                                            <input type="text" name="pages" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">PISSN *</label>
                                                            <input type="text" name="pissn" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">EISSN *</label>
                                                            <input type="text" name="eissn" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Month & Year *</label>
                                                            <input type="text" id="Start" name="mon" placeholder="mm/yy" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Indexing *</label>
                                                            <div class="col-md-12">
                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input type="checkbox" class="custom-control-input" name="scope[]" id="customControlAutosizing1" value="Scopus">
                                                                    <label class="custom-control-label" for="customControlAutosizing1">Scopus</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input type="checkbox" class="custom-control-input" name="scope[]" id="customControlAutosizing2" value="WOS">
                                                                    <label class="custom-control-label" for="customControlAutosizing2">WOS</label>
                                                                </div>
                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input type="checkbox" class="custom-control-input" name="scope[]" id="customControlAutosizing3" value="SCI">
                                                                    <label class="custom-control-label" for="customControlAutosizing3">SCI</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Paper*</label>
                                                            <label for="">(upload less than 2 mb)</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile2" onchange="return fileValidation3()" aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Upload 1st page as image</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial2"></p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Student Modal -->
                                    <div class="modal fade" id="studentViewModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Paper</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="image2" src="" alt="Computer man" class="center" style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Journal Details

                                                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentAddModal2">
                                                            Add Journal
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable3" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.NO</b></th>
                                                                    <th><b>Journal Details</b></th>
                                                                    <th><b>Download</b></th>

                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM journal where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {
                                                                ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><b><?= $student['pt'] ?></b>
                                                                                <br><?= $student['jn'] ?>
                                                                                <br><?= $student['pn'] ?>
                                                                                <br>Vol: <?= $student['vol'] ?>, Issue: <?= $student['issue'] ?>, Pages: <?= $student['pages'] ?>, PISSN : <?= $student['pissn'] ?>, EISSN : <?= $student['eissn'] ?>, Month & Year: <?= $student['mon'] ?>
                                                                                <br><span style="color:blue">Indexing : <?= $student['scope'] ?></span>

                                                                            </td>

                                                                            <td align="center"><button type="button" id="ledonof" value="<?= $student['uid']; ?>" class="btnimg1 btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModal3">View</button></td>
                                                                            <td>
                                                                                <!--
                                            <button type="button" value="<?= $student['uid']; ?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?= $student['uid']; ?>" class="editStudentBtn btn btn-success btn-sm">Edit</button> -->
                                                                                <button type="button" value="<?= $student['uid']; ?>" class="deletejBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                <?php
                                                                    }
                                                                    $sn = $sn + 1;
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

                                <!--profile tab end -->


                                <!--Posting tab starts -->


                                <div class="tab-pane  p-20" id="posting" role="tabpanel">


                                    <!-- Add posting -->
                                    <div class="modal fade" id="postingadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Posting Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="savepost">
                                                    <div class="modal-body">

                                                        <div id="errorMessagepost" class="alert alert-warning d-none"></div>


                                                        <div class="mb-3"><label for="">Current Posting *</label>
                                                            <select class="form-control" name="cs" id="cs" onchange="if(this.value=='no'){this.form['tod'].style.visibility='visible'}else {this.form['tod'].style.visibility='hidden'};" required>
                                                                <option value="">Select</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>


                                                        <div class="mb-3"><label for="">Level of Posting *</label>
                                                            <select class="form-control" name="lp" id="cs" required>
                                                                <option value="">Select</option>
                                                                <option value="Department Level">Department Level</option>
                                                                <option value="Institutional Level">Institutional Level</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Name of the Posting *</label>
                                                            <input type="text" name="np" class="form-control" required />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">From</label>
                                                            <input type="date" name="fod" class="form-control" required />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">To</label>
                                                            <input type="date" name="tod" class="form-control" />
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Posting Details <?php "kalai"; ?>

                                                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postingadd">
                                                            Add Posting
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable5" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.NO</b></th>
                                                                    <th><b>Level</b></th>
                                                                    <th><b>Posting Name</b></th>
                                                                    <th><b>From</b></th>
                                                                    <th><b>To</b></th>

                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM posting where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {
                                                                        if ($student['tod'] == "0000-00-00") {
                                                                            $sss = "Current";
                                                                        } else {
                                                                            $sss = $student['tod'];
                                                                        }

                                                                ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['level'] ?></td>
                                                                            <td><?= $student['pname'] ?></td>
                                                                            <td><?= $student['fromd'] ?></td>
                                                                            <td><?php echo $sss; ?></td>

                                                                            <td>
                                                                                <!--
                                            <button type="button" value="<?= $student['uid']; ?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?= $student['uid']; ?>" class="editStudentBtn btn btn-success btn-sm">Edit</button> -->
                                                                                <button type="button" value="<?= $student['uid']; ?>" class="deletepBtn btn btn-danger btn-sm">Delete</button>
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
                                    <div class="modal fade" id="punishadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Punishment Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="savepunish">
                                                    <div class="modal-body">

                                                        <div id="errorMessagepost9" class="alert alert-warning d-none"></div>




                                                        <div class="mb-3"><label for="">Type of Punishment *</label>
                                                            <select class="form-control" name="lp" id="cs" required>
                                                                <option value="">Select</option>
                                                                <option value="Department Level">Memo</option>
                                                                <option value="Institutional Level">Suspension</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Reason *</label>
                                                            <input type="text" name="np" class="form-control" required />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">From</label>
                                                            <input type="date" name="fod" class="form-control" required />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">To</label>
                                                            <input type="date" name="tod" class="form-control" />
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Punishment Details

                                                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#punishadd">
                                                            Add Punishment
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable9" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.NO</b></th>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Reason</b></th>
                                                                    <th><b>From</b></th>
                                                                    <th><b>To</b></th>

                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM punish where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sn = 1;
                                                                    foreach ($query_run as $student) {

                                                                ?>
                                                                        <tr>
                                                                            <td><?= $sn ?></td>
                                                                            <td><?= $student['type'] ?></td>
                                                                            <td><?= $student['reason'] ?></td>
                                                                            <td><?= $student['fromd'] ?></td>
                                                                            <td><?= $student['tod'] ?></td>

                                                                            <td>
                                                                                <!--
                                            <button type="button" value="<?= $student['uid']; ?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?= $student['uid']; ?>" class="editStudentBtn btn btn-success btn-sm">Edit</button> -->
                                                                                <button type="button" value="<?= $student['uid']; ?>" class="deletepBtn btn btn-danger btn-sm">Delete</button>
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

                                <div class="tab-pane p-20" id="train" role="tabpanel">


                                    <div class="modal fade" id="pcadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"> Add Training Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="pcadd2">
                                                    <div class="modal-body">

                                                        <div id="errorMessage" class="alert alert-warning d-none"></div>



                                                        <div class="mb-3">
                                                            <label for="">Type of Training *</label>
                                                            <select class="form-control" name="type" id="type" onchange="if(this.value=='other'){this.form['other'].style.visibility='visible'}else {this.form['other'].style.visibility='hidden'};" required>
                                                                <option value="">Select type</option>
                                                                <option value="FDP">FDP</option>
                                                                <option value="Workshop">Workshop</option>
                                                                <option value="other">Others</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">

                                                            <input type="text" name="other" Placeholder="Enter Other training type" class="form-control" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Name of the Organization *</label>
                                                            <input type="text" name="no" class="form-control" />
                                                        </div>



                                                        <div class="mb-3">
                                                            <label for="">Title *</label>
                                                            <input type="text" name="title" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">From *</label>
                                                            <input type="date" name="fd" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">To *</label>
                                                            <input type="date" name="td" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Proof*</label>
                                                            <label for="">(upload less than 2 mb)</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile4" onchange="return fileValidation4()" aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Upload 1st page as image</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial4"></p>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="modal fade" id="studentViewModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Paper</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="image4" src="" alt="Computer man" class="center" style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Training details

                                                        <button type="button" style="float: right;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pcadd">
                                                            Add Training
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable4" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Type of Training</b></th>
                                                                    <th><b>Name of the organization</b></th>
                                                                    <th><b>Title</b></th>
                                                                    <th><b>From</b></th>
                                                                    <th><b>To</b></th>
                                                                    <th><b>View</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $query = "SELECT * FROM training where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $s = 1;
                                                                    foreach ($query_run as $student) {

                                                                ?>
                                                                        <tr>
                                                                            <td><?= $s ?></td>
                                                                            <td><?= $student['type'] ?></td>
                                                                            <td><?= $student['no'] ?></td>
                                                                            <td><?= $student['name'] ?></td>
                                                                            <td><?= $student['fromd'] ?></td>
                                                                            <td><?= $student['tod'] ?></td>
                                                                            <td align="center"><button type="button" id="ledonof" value="<?= $student['uid']; ?>" class="btnimg4 btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModal4">View</button></td>
                                                                            <td align="center">
                                                                                <!--<button type="button" value="<?= $student['uid']; ?>" class="editfamilyBtn btn btn-success btn-sm">Edit</button> -->
                                                                                <button type="button" value="<?= $student['uid']; ?>" class="deletepcBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                <?php
                                                                        $s = $s + 1;
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







                                    <!-- Edit Student Modal 
<div class="modal fade" id="studentEditModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updatefamily">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

           <input type="hidden" name="student_id2" id="student_id2" >
		   
		   
		   <div class="mb-3">
									<label for="">Name *</label>
									<input type="text" name="name" id="name2" class="form-control" />
								</div>
								
								<div class="mb-3">
									<label for="">Gender *</label>
									<select class="form-control" name="gender" id="gender" required>           
										<option value="">Select Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Transgender">Transgender</option>
									</select>
								</div>
								<div class="mb-3">Relationship *</label>
									<select class="form-control" name="relationship" id="relationship">
										<option value="">Select Relationship</option>
										<option value="Brother">Brother</option>
										<option value="Brother-in-Law">Brother-in-Law</option>
										<option value="Daughter">Daughter</option>
										<option value="Daughter-in-Law">Daughter-in-Law</option>
										<option value="Father">Father</option>
										<option value="Father-in-Law">Father-in-Law</option>
										<option value="Grand-Daughter">Grand-Daughter</option>
										<option value="Grand-Father">Grand-Father</option>
										<option value="Grand-Mother">Grand-Mother</option>
										<option value="Grand-Son">Grand-Son</option>
										<option value="Husband">Husband</option>
										<option value="Mother">Mother</option>
										<option value="Mother-in-Law">Mother-in-Law</option>
										<option value="Others">Others</option>
										<option value="Sister">Sister</option>
										<option value="Sister-in-Law">Sister-in-Law</option>
										<option value="Son">Son</option>
										<option value="Son-in-Law">Son-in-Law</option>
										<option value="Uncle">Uncle</option>
										<option value="Wife">Wife</option>
									  </select>
								</div>

								<div class="mb-3">
									<label for="">Mobile *</label>
									<input type="text" name="mobile" id="mobile" class="form-control" />
								</div>
 
								</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Update Member</button>
							</div>
		   
		   
		   

				
        </form>
        </div>
    </div>
</div>

-->





                                </div>

                                <div class="tab-pane p-20" id="research" role="tabpanel">

                                    <?php

                                    $query = "SELECT * FROM research WHERE id='$s'";
                                    $query_run = mysqli_query($db, $query);

                                    if (mysqli_num_rows($query_run) == 1) {
                                        $research = mysqli_fetch_array($query_run);
                                        $oid = $research['oid'];
                                        $sid = $research['sid'];
                                        $rid = $research['rid'];
                                        $gsid = $research['gsid'];
                                        $hid = $research['hid'];
                                        $iid = $research['iid'];
                                        $gi = $research['gi'];
                                        $cs = $research['cs'];
                                        $cgs = $research['cgs'];
                                    }
                                    ?>


                                    <form id="research" class="needs-validation" novalidate>
                                        <div id="errorresearch" class="alert alert-warning d-none"></div>
                                        <div class="card-header">
                                            <h4> Research Identity </h4>
                                        </div>



                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">ORCID</label>
                                                <input type="text" name="oid" class="form-control" id="validationCustom01" placeholder="ORCID" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                            echo $oid;
                                                                                                                                                        } else {
                                                                                                                                                            echo "";
                                                                                                                                                        } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Scopus ID</label>
                                                <input type="text" class="form-control" name="sid" id="validationCustom02" placeholder="Scopus ID" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                                echo $sid;
                                                                                                                                                            } else {
                                                                                                                                                                echo "";
                                                                                                                                                            } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Researcher ID</label>
                                                <input type="text" class="form-control" name="rid" id="validationCustom02" placeholder="Researcher ID" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                                    echo $rid;
                                                                                                                                                                } else {
                                                                                                                                                                    echo "";
                                                                                                                                                                } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Google Scholar ID</label>
                                                <input type="text" name="gsid" class="form-control" id="validationCustom01" placeholder="Google Scholar ID" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                                        echo $gsid;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo "";
                                                                                                                                                                    } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">H-Index</label>
                                                <input type="text" class="form-control" name="hid" id="validationCustom02" placeholder="H-Index" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                            echo $hid;
                                                                                                                                                        } else {
                                                                                                                                                            echo "";
                                                                                                                                                        } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">i10-Index</label>
                                                <input type="text" class="form-control" name="iid" id="validationCustom02" placeholder="i10-Index" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                                echo $iid;
                                                                                                                                                            } else {
                                                                                                                                                                echo "";
                                                                                                                                                            } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">G-Index</label>
                                                <input type="text" name="gi" class="form-control" id="validationCustom01" placeholder="G-Index" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                            echo $gi;
                                                                                                                                                        } else {
                                                                                                                                                            echo "";
                                                                                                                                                        } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Citations Scopus</label>
                                                <input type="text" class="form-control" name="cs" id="validationCustom02" placeholder="Citations Scopus" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                                    echo $cs;
                                                                                                                                                                } else {
                                                                                                                                                                    echo "";
                                                                                                                                                                } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Citations Google Scholar</label>
                                                <input type="text" class="form-control" name="cgs" id="validationCustom02" placeholder="Citations Google Scholar" value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                                                                                                                                                echo $cgs;
                                                                                                                                                                            } else {
                                                                                                                                                                                echo "";
                                                                                                                                                                            } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>


                                        <button class="btn btn-primary" type="submit">Submit</button>


                                    </form>


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
        $(document).on('submit', '#saveexp', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_exp", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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



        $(document).on('submit', '#pcadd2', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_pc", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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

                        $('#myTable4').load(location.href + " #myTable4");


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

        $(document).on('click', '.editStudentBtn', function() {

            var student_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function(response) {

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

        $(document).on('submit', '#updateStudent', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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

        $(document).on('click', '.viewStudentBtn', function() {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function(response) {

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

        $(document).on('click', '.btnimg', function() {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "Acode.php?student_id=" + student_id,
                success: function(response) {

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


        $(document).on('click', '.btnimg1', function() {

            var student_id22 = $(this).val();
            $.ajax({
                type: "GET",
                url: "Acode.php?student_id22=" + student_id22,
                success: function(response) {

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

        $(document).on('click', '.btnimg4', function() {

            var student_id222 = $(this).val();
            $.ajax({
                type: "GET",
                url: "Acode.php?student_id222=" + student_id222,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {

                        alert(res.message);
                    } else if (res.status == 200) {


                        $("#image4").attr("src", res.data.cert);

                        $('#studentViewModal4').modal('show');
                    }
                }
            });
        });





        $(document).on('click', '.deleteStudentBtn', function(e) {
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
                    success: function(response) {

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
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
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
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
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
        $(".custom-file-input").on("change", function() {
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
            } else {
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
            } else {
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
            } else {
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
            } else {
                if (fileSize > 2000) {
                    var msg = "File size should be less than 2MB!";
                    fileInput.value = '';
                    document.getElementById("tutorial4").innerHTML = msg;
                }
            }



        }
    </script>


    <script>
        $(document).on('submit', '#basic', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_basic", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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

        $(document).on('submit', '#research', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_research", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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


        $(document).on('submit', '#aprofile', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_aprofile", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#erroraprofile').removeClass('d-none');
                        $('#erroraprofile').text(res.message);

                    } else if (res.status == 200) {

                        $('#erroraprofile').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);



                    } else if (res.status == 500) {
                        $('#erroraprofile').removeClass('d-none');
                        $('#erroraprofile').text(res.message);
                    }
                }
            });

        });








        $(document).on('submit', '#savejournal', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_journal", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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


        $(document).on('submit', '#savepost', function(e) {
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
                success: function(response) {

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

        $(document).on('submit', '#savepunish', function(e) {
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
                success: function(response) {

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




        $(document).on('click', '.editfamilyBtn', function() {

            var student_id2 = $(this).val();

            $.ajax({
                type: "GET",
                url: "code.php?student_id2=" + student_id2,
                success: function(response) {

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

        $(document).on('submit', '#updatefamily', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_family", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

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


        $(document).on('click', '.deletefamilyBtn', function(e) {
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
                    success: function(response) {

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

        $(document).on('click', '.deletepcBtn', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "acode.php",
                    data: {
                        'delete_pc': true,
                        'student_id5': student_id5
                    },
                    success: function(response) {

                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {

                            alert(res.message);
                        } else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable4').load(location.href + " #myTable4");
                        }
                    }
                });
            }
        });


        $(document).on('click', '.deletejBtn', function(e) {
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
                    success: function(response) {

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




        $(document).on('click', '.deletepBtn', function(e) {
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
                    success: function(response) {

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