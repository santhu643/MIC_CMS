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
    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        th {
            /* background-color:#7460ee; */
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
            text-align: center;
        }

        .alertify-notifier .ajs-success {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
        }

        .alertify-notifier .ajs-error {
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
                        <h4 class="page-title">Edit Profile</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile Information</li>
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
                $q = mysqli_query($db, $query);

                if (mysqli_num_rows($query_run) >= 0) {
                    $student = mysqli_fetch_array($query_run);
                    $m = $student;
                }


                ?>



                <div class="card">
                    <div class="card-body wizard-content">
                        <h4 class="card-title">Profile Information</h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><img
                                                src="images/icon/profile.png" class="custom-svg-icon"
                                                alt="Dashboard Icon"><b> Basic</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><img
                                                src="images/icon/academic.png" class="custom-svg-icon"
                                                alt="Dashboard Icon"><b> Academic Information</b></span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><img
                                                src="images/icon/family.png" class="custom-svg-icon"
                                                alt="Dashboard Icon"><b> Family Details</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#medical"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><img
                                                src="images/icon/medical.png" class="custom-svg-icon"
                                                alt="Dashboard Icon"><b> Medical Record</b></span></a> </li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#nominee"
                                        role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><img
                                                src="images/icon/buddy.png" class="custom-svg-icon"
                                                alt="Dashboard Icon"><b> Nominee details</b></span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <form id="basic" class="needs-validation" novalidate>
                                        <div id="Abasic" class="alert alert-warning d-none"></div>
                                        <div class="card-header">
                                            <h4>Personal Information </h4>
                                        </div>
                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">First name *</label>
                                                <input type="text" name="fname" class="form-control"
                                                    id="validationCustom01" placeholder="First Name"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['fname'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Last name *</label>
                                                <input type="text" class="form-control" name="lname"
                                                    id="validationCustom02" placeholder="Last Name"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['lname'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>


                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Profile Photo *</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control custom-file-input"
                                                        name="photo" id="validationCustomProfilePhoto"
                                                        onchange="return fileValidation('validationCustomProfilePhoto')"
                                                        placeholder="Username" aria-describedby="inputGroupPrepend"
                                                        required>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose a profile photo.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Gender *</label>
                                                <select class="select2 form-control custom-select form-control"
                                                    name="gender" value="<?php echo $student['gender']; ?>"
                                                    id="validationCustom01" placeholder="First name" required>
                                                    <option value="">Select</option>
                                                    <option value="Male" <?php if (isset($student['gender']) && $student['gender'] == "Male") echo 'selected="selected"'; ?>>Male</option>
                                                    <option value="Female" <?php if (isset($student['gender']) && $student['gender'] == "Female") echo 'selected="selected"'; ?>>Female</option>
                                                    <option value="Transgender" <?php if (isset($student['gender']) && $student['gender'] == "Transgender") echo 'selected="selected"'; ?>>Transgender</option>
                                                </select>

                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select gender.
                                                </div>
                                            </div>



                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">DOB *</label>
                                                <input type="date" class="form-control" name="dob"
                                                    id="validationCustom02" placeholder="DOB"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['dob'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter DOB.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Religion *</label>
                                                <div class="input-group">
                                                    <select class="select2 form-control custom-select" name="religion"
                                                        style="width: 100%; height:36px;" required>
                                                        <option value="">Select</option>
                                                        <option value="Buddhism" <?php if (isset($student['religion']) && $student['religion'] == "Buddhism")
                                                            echo 'selected="selected"'; ?>>Buddhism</option>
                                                        <option value="Christian" <?php if (isset($student['religion']) && $student['religion'] == "Christian")
                                                            echo 'selected="selected"'; ?>>Christian</option>
                                                        <option value="Hinduism" <?php if (isset($student['religion']) && $student['religion'] == "Hinduism")
                                                            echo 'selected="selected"'; ?>>Hinduism</option>
                                                        <option value="Islam" <?php if (isset($student['religion']) && $student['religion'] == "Islam")
                                                            echo 'selected="selected"'; ?>>Islam</option>
                                                        <option value="Jainism" <?php if (isset($student['religion']) && $student['religion'] == "Jainism")
                                                            echo 'selected="selected"'; ?>>Jainism</option>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose a religion.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Social Strata *</label>
                                                <select class="select2 form-control custom-select form-control"
                                                    name="social" id="validationCustom01" placeholder="First name"
                                                    required>

                                                    <option value="">Select</option>
                                                    <option value="BC" <?php if (isset($student['social']) && $student['social'] == "BC")
                                                        echo 'selected="selected"'; ?>>BC</option>
                                                    <option value="BCM" <?php if (isset($student['social']) && $student['social'] == "BCM")
                                                        echo 'selected="selected"'; ?>>BCM</option>
                                                    <option value="MBC" <?php if (isset($student['social']) && $student['social'] == "MBC")
                                                        echo 'selected="selected"'; ?>>MBC</option>
                                                    <option value="OC" <?php if (isset($student['social']) && $student['social'] == "OC")
                                                        echo 'selected="selected"'; ?>>OC</option>
                                                    <option value="SS" <?php if (isset($student['social']) && $student['social'] == "SS")
                                                        echo 'selected="selected"'; ?>>SC / ST</option>
                                                </select>

                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select social strata.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Caste *</label>
                                                <input type="text" class="form-control" name="caste"
                                                    id="validationCustom02"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['caste'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    placeholder="Enter your caste" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter Caste.
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Martial Status *</label>
                                                <div class="input-group">
                                                    <select class="select2 form-control custom-select" name="ms"
                                                        style="width: 100%; height:36px;" required>
                                                        <option value="">Select</option>
                                                        <option value="Single" <?php if (isset($student['ms']) && $student['ms'] == "Single")
                                                            echo 'selected="selected"'; ?>>Single</option>
                                                        <option value="Married" <?php if (isset($student['ms']) && $student['ms'] == "Married")
                                                            echo 'selected="selected"'; ?>>Married</option>
                                                        <option value="Widowed" <?php if (isset($student['ms']) && $student['ms'] == "Widowed")
                                                            echo 'selected="selected"'; ?>>Widowed</option>
                                                        <option value="Divorced" <?php if (isset($student['ms']) && $student['ms'] == "Divorced")
                                                            echo 'selected="selected"'; ?>>Divorced</option>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose a Martial Status.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Physically / Mentally Challenged *
                                                </label>
                                                <div class="input-group">
                                                    <select class="select2 form-control custom-select" name="pmc"
                                                        style="width: 100%; height:36px;" required>

                                                        <option value="">Select</option>
                                                        <option value="No" <?php if (isset($student['pmc']) && $student['pmc'] == "No")
                                                            echo 'selected="selected"'; ?>>No</option>
                                                        <option value="Yes" <?php if (isset($student['pmc']) && $student['pmc'] == "Yes")
                                                            echo 'selected="selected"'; ?>>Yes</option>
                                                    </select>

                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose physical status.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Physical Identification Mark 1 *</label>
                                                <input type="text" class="form-control" name="pim1"
                                                    id="validationCustom02"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['pim1'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    placeholder="Enter Physical Identification Mark 1" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter Physical Identification Mark 1.
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Physical Identification Mark 2
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="pim2"
                                                        id="validationCustom02"
                                                        value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                            echo $student['pim2'];
                                                        } else {
                                                            echo "";
                                                        } ?>"
                                                        placeholder="Enter Physical Identification Mark 2">


                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom03">Permanent Address *</label>
                                                <input type="text" class="form-control" name="paddress"
                                                    id="validationCustom03"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['paddress'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    placeholder="Permanent Address" required>
                                                <div class="invalid-feedback">
                                                    Please enter a permanent address.
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="validationCustom04">Temporary Address *</label>
                                                <input type="text" class="form-control" name="taddress"
                                                    id="validationCustom04"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['taddress'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    placeholder="Temporary Address" required>
                                                <div class="invalid-feedback">
                                                    Please enter a temporary address.
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom04">State *</label>
                                                <select class="select2 form-control custom-select" name="state"
                                                    id="inputState" required>
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
                                                    <option disabled style="background-color:#aaa; color:#fff">UNION
                                                        Territories</option>
                                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                        Islands</option>
                                                    <option value="Chandigarh">Chandigarh</option>
                                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli
                                                    </option>
                                                    <option value="Daman and Diu">Daman and Diu</option>
                                                    <option value="Delhi">Delhi</option>
                                                    <option value="Lakshadeep">Lakshadeep</option>
                                                    <option value="Pondicherry">Pondicherry</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please choose state.
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom04">City *</label>
                                                <select class="select2 form-control custom-select" name="city"
                                                    id="inputDistrict" required>
                                                    <option value="">-- select one -- </option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please choose city.
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom05">Zip *</label>
                                                <input type="text" class="form-control" name="zip"
                                                    id="validationCustom05"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['zip'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    placeholder="Zip" required>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom05">Country *</label>
                                                <select class="select2 form-control custom-select" id="country"
                                                    name="country" class="form-control" required>
                                                    <option value="">Select</option>
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Åland Islands">Åland Islands</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="American Samoa">American Samoa</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Anguilla">Anguilla</option>
                                                    <option value="Antarctica">Antarctica</option>
                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina
                                                    </option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Territory">British Indian Ocean
                                                        Territory</option>
                                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African Republic
                                                    </option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island</option>
                                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands
                                                    </option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Congo, The Democratic Republic of The">Congo, The
                                                        Democratic Republic of The</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czech Republic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Falkland Islands (Malvinas)">Falkland Islands
                                                        (Malvinas)</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia</option>
                                                    <option value="French Southern Territories">French Southern
                                                        Territories</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guernsey">Guernsey</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Heard Island and Mcdonald Islands">Heard Island and
                                                        Mcdonald Islands</option>
                                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City
                                                        State)</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of
                                                    </option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jersey">Jersey</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Korea, Democratic People's Republic of">Korea,
                                                        Democratic People's Republic of</option>
                                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Lao People's Democratic Republic">Lao People's
                                                        Democratic Republic</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya
                                                    </option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macao">Macao</option>
                                                    <option value="Macedonia, The Former Yugoslav Republic of">
                                                        Macedonia, The Former Yugoslav Republic of</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia, Federated States of">Micronesia,
                                                        Federated States of</option>
                                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="Northern Mariana Islands">Northern Mariana Islands
                                                    </option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestinian Territory, Occupied">Palestinian
                                                        Territory, Occupied</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Pitcairn">Pitcairn</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Reunion">Reunion</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russian Federation">Russian Federation</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Saint Helena">Saint Helena</option>
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon
                                                    </option>
                                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and
                                                        The Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="South Georgia and The South Sandwich Islands">South
                                                        Georgia and The South Sandwich Islands</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen
                                                    </option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania, United Republic of">Tanzania, United
                                                        Republic of</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-leste">Timor-leste</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands
                                                    </option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States">United States</option>
                                                    <option value="United States Minor Outlying Islands">United States
                                                        Minor Outlying Islands</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Viet Nam">Viet Nam</option>
                                                    <option value="Virgin Islands, British">Virgin Islands, British
                                                    </option>
                                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                    <option value="Western Sahara">Western Sahara</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please choose country.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">


                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Mobile Number *</label>
                                                <input type="text" class="form-control" name="mobile"
                                                    id="validationCustom02"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['mobile'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    placeholder="Enter Mobile Number" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter mobile number.
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Email ID* </label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="email"
                                                        id="validationCustom02"
                                                        value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                            echo $student['email'];
                                                        } else {
                                                            echo "";
                                                        } ?>"
                                                        placeholder="Enter Email ID" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please enter email id.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Blood Group </label>
                                                <select class="select2 form-control custom-select form-control"
                                                    name="blood" id="validationCustom01" placeholder="First name"
                                                    required>


                                                    <option value="">Select Blood Group</option>
                                                    <option value="A+VE" <?php if (isset($student['pmc']) && $student['blood'] == "A+VE")
                                                        echo 'selected="selected"'; ?>>A+VE</option>
                                                    <option value="A-VE" <?php if (isset($student['pmc']) && $student['blood'] == "A-VE")
                                                        echo 'selected="selected"'; ?>>A-VE</option>
                                                    <option value="B+VE" <?php if (isset($student['pmc']) && $student['blood'] == "B+VE")
                                                        echo 'selected="selected"'; ?>>B+VE</option>
                                                    <option value="B-VE" <?php if (isset($student['pmc']) && $student['blood'] == "B-VE")
                                                        echo 'selected="selected"'; ?>>B-VE</option>
                                                    <option value="O+VE" <?php if (isset($student['pmc']) && $student['blood'] == "O+VE")
                                                        echo 'selected="selected"'; ?>>O+VE</option>
                                                    <option value="O-VE" <?php if (isset($student['pmc']) && $student['blood'] == "O-VE")
                                                        echo 'selected="selected"'; ?>>O-VE</option>
                                                    <option value="AB+VE" <?php if (isset($student['pmc']) && $student['blood'] == "AB+VE")
                                                        echo 'selected="selected"'; ?>>AB+VE</option>
                                                    <option value="AB-VE" <?php if (isset($student['pmc']) && $student['blood'] == "AB-VE")
                                                        echo 'selected="selected"'; ?>>AB-VE</option>
                                                </select>

                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select blood group.
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-row">


                                            <div class="col-md-6 mb-6">
                                                <label for="validationCustomUsername">Aadhar *</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control custom-file-input"
                                                        name="aadhar" id="validationCustomAadhar"
                                                        onchange="return fileValidation('validationCustomAadhar')"
                                                        placeholder="Username" aria-describedby="inputGroupPrepend"
                                                        required>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose a aadhar photo.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-6">
                                                <label for="validationCustomUsername">PAN *</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control custom-file-input" name="pan"
                                                        id="validationCustomPAN"
                                                        onchange="return fileValidation('validationCustomPAN')"
                                                        placeholder="Username" aria-describedby="inputGroupPrepend"
                                                        required>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Please choose a pan photo.
                                                    </div>
                                                </div>
                                            </div>





                                        </div>





                                        <button class="btn btn-primary" type="submit">Submit</button>


                                    </form>
                                </div>



                                <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                    <!-- Add Student -->
                                    <div class="modal fade" id="studentAddModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Academic Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="saveStudent">
                                                    <div class="modal-body">

                                                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                                                        <div class="mb-3">
                                                            <label for="">Course *</label>
                                                            <select class="form-control" name="course" id="course"
                                                                onchange="if(this.value!='PHD'){this.form['score'].style.visibility='visible'}else {this.form['score'].style.visibility='hidden'};"
                                                                required>
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
                                                            <select class="form-control" name="degree" id="degree"
                                                                required>
                                                                <option value="">Select Degree</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Specialization / Branch *</label>
                                                            <input type="text" name="branch" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Institution Name *</label>
                                                            <input type="text" name="name" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Board/University *</label>
                                                            <input type="text" name="univ" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">State *</label>
                                                            <select class="form-control" name="state">
                                                                <option value="">Select State</option>
                                                                <option value="Andra Pradesh">Andra Pradesh</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh
                                                                </option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh
                                                                </option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir
                                                                </option>
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
                                                                <option disabled
                                                                    style="background-color:#aaa; color:#fff">UNION
                                                                    Territories</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and
                                                                    Nicobar Islands</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar
                                                                    Haveli</option>
                                                                <option value="Daman and Diu">Daman and Diu</option>
                                                                <option value="Delhi">Delhi</option>
                                                                <option value="Lakshadeep">Lakshadeep</option>
                                                                <option value="Pondicherry">Pondicherry</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Mode of Study *</label>
                                                            <select class="form-control" name="ms" required>
                                                                <option value="">Select Degree</option>
                                                                <option value="Full Time">Full Time</option>
                                                                <option value="Part time">Part time</option>
                                                                <option value="Distance">Distance</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Medium of Study *</label>
                                                            <input type="text" name="mes" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Completion Status *</label>
                                                            <select class="form-control" name="cs"
                                                                onchange="if(this.value=='Completed'){this.form['yc'].style.visibility='visible',this.form['score'].style.visibility='visible'}else {this.form['yc'].style.visibility='hidden',this.form['score'].style.visibility='hidden'};"
                                                                required>
                                                                <option value="">Select</option>
                                                                <option value="Completed">Completed</option>
                                                                <option value="Pursuing">Pursuing</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Year of Completion *</label>
                                                            <input type="text" name="yc" class="form-control" />
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="">Score Obtained (%)*</label>
                                                            <input type="text" name="score" class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Certification Number *</label><br>
                                                            <p> (for PHD Pursuing : Enter provisional Reg order num)
                                                            </p>
                                                            <input type="text" name="cnum" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label></br>
                                                            <p> (for PHD Pursuing : upload provisional Reg order) </p>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile" onchange="return fileValidation2()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
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

                                    <!-- Edit Student Modal -->
                                    <div class="modal fade" id="studentEditModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="updateStudent">
                                                    <div class="modal-body">

                                                        <div id="errorMessageUpdate" class="alert alert-warning d-none">
                                                        </div>

                                                        <input type="hidden" name="student_id" id="student_id">

                                                        <div class="mb-3">
                                                            <label for="">Course *</label>
                                                            <select class="form-control" name="course" id="course2"
                                                                required>
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
                                                            <select class="form-control" name="degree" id="degree2"
                                                                required>
                                                                <option value="">Select Degree</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Specialization / Branch *</label>
                                                            <input type="text" name="branch" id="branch"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Institution Name *</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Board/University *</label>
                                                            <input type="text" name="univ" id="univ"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">State *</label>
                                                            <select class="form-control" name="state" id="state">
                                                                <option value="">Select State</option>
                                                                <option value="Andra Pradesh">Andra Pradesh</option>
                                                                <option value="Arunachal Pradesh">Arunachal Pradesh
                                                                </option>
                                                                <option value="Assam">Assam</option>
                                                                <option value="Bihar">Bihar</option>
                                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                                <option value="Goa">Goa</option>
                                                                <option value="Gujarat">Gujarat</option>
                                                                <option value="Haryana">Haryana</option>
                                                                <option value="Himachal Pradesh">Himachal Pradesh
                                                                </option>
                                                                <option value="Jammu and Kashmir">Jammu and Kashmir
                                                                </option>
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
                                                                <option disabled
                                                                    style="background-color:#aaa; color:#fff">UNION
                                                                    Territories</option>
                                                                <option value="Andaman and Nicobar Islands">Andaman and
                                                                    Nicobar Islands</option>
                                                                <option value="Chandigarh">Chandigarh</option>
                                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar
                                                                    Haveli</option>
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
                                                            <input type="text" name="mes" id="mes"
                                                                class="form-control" />
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
                                                            <input type="text" name="score" id="score"
                                                                class="form-control" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Certification Number *</label>
                                                            <input type="text" name="cnum" id="cnum"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Certificate*</label>
                                                            <label for="">(upload less than 2 mb)</label>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    class="form-control custom-file-input" name="cert"
                                                                    id="uploadFile" onchange="return fileValidation2()"
                                                                    aria-describedby="inputGroupPrepend" required>
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                            </div>
                                                            <p style="color:red;" id="tutorial"></p>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            details</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- View Student Modal -->
                                    <div class="modal fade" id="studentViewModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img id="image" src="" alt="Computer man" class="center"
                                                        style="width:80%;height:80%;">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>










                                    <!-- View Student Modal -->
                                    <div class="modal fade" id="studentViewModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
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
                                                    <h4>Academic Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#studentAddModal">
                                                            Add details
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>Degree</b></th>
                                                                    <th><b>Institution Name</b></th>
                                                                    <th><b>Board/University</b></th>
                                                                    <th><b>Certificate No</b></th>
                                                                    <th><b>Mark </b></th>
                                                                    <th align="center"><b>View Certificate</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM academic where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    foreach ($query_run as $student) {

                                                                        if ($student['score'] == "") {
                                                                            $mark = "NA";
                                                                        } else {
                                                                            $mark = $student['score'];
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $student['Degree'] ?></td>
                                                                            <td><?= $student['iname'] ?></td>
                                                                            <td><?= $student['univ'] ?></td>
                                                                            <td><?= $student['cnum'] ?></td>
                                                                            <td><?php echo $mark; ?></td>
                                                                            <td align="center"><img
                                                                                    src="images/icon/certificate.png"
                                                                                    class="action-icon btnimg" alt="View"
                                                                                    data-action="cert"
                                                                                    data-student-id="<?= $student['uid']; ?>"
                                                                                    title="View Certificate"
                                                                                    style="cursor: pointer;">


                                                                                <!--	
                                    <button type="button" id="ledonof" value="<?= $student['uid']; ?>" class="btnimg btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModal2">View</button>
                                        -->


                                                                            </td>
                                                                            <td style="width: 100px;">
                                                                                <img src="images/icon/eye.png"
                                                                                    class="action-icon viewStudentAction"
                                                                                    alt="View" data-action="view"
                                                                                    data-student-id="<?= $student['uid']; ?>"
                                                                                    title="View" style="cursor: pointer;">

                                                                                <img src="images/icon/edit.png"
                                                                                    class="action-icon editStudentBtn"
                                                                                    alt="edit" data-action="edit"
                                                                                    data-student-id="<?= $student['uid']; ?>"
                                                                                    title="Edit" style="cursor: pointer; ">

                                                                                <img src="images/icon/delete.png"
                                                                                    class="action-icon deleteStudentBtn"
                                                                                    alt="delete" data-action="delete"
                                                                                    data-student-id="<?= $student['uid']; ?>"
                                                                                    title="Delete" style="cursor: pointer;">
                                                                                <!--  <button type="button" value="<?= $student['uid']; ?>" class="editStudentBtn btn btn-success btn-sm">Edit</button>
                                            <button type="button" value="<?= $student['uid']; ?>" class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
                                            -->
                                                                            </td>
                                                                        </tr>
                                                                        <?php
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





                                <div class="tab-pane p-20" id="messages" role="tabpanel">


                                    <div class="modal fade" id="familyadd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add family Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="familyadd2">
                                                    <div class="modal-body">

                                                        <div id="errorMessage" class="alert alert-warning d-none"></div>


                                                        <div class="mb-3">
                                                            <label for="">Name *</label>
                                                            <input type="text" name="name" class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Gender *</label>
                                                            <select class="form-control" name="gender" required>
                                                                <option value="">Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Transgender">Transgender</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">Relationship *</label>
                                                            <select class="form-control" name="relationship">
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
                                                            <input type="text" name="mobile" class="form-control" />
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add
                                                            member</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Edit Student Modal -->
                                    <div class="modal fade" id="studentEditModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form id="updatefamily">
                                                    <div class="modal-body">

                                                        <div id="errorMessageUpdate" class="alert alert-warning d-none">
                                                        </div>

                                                        <input type="hidden" name="student_id2" id="student_id2">


                                                        <div class="mb-3">
                                                            <label for="">Name *</label>
                                                            <input type="text" name="name" id="name2"
                                                                class="form-control" />
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="">Gender *</label>
                                                            <select class="form-control" name="gender" id="gender"
                                                                required>
                                                                <option value="">Select Gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Transgender">Transgender</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">Relationship *</label>
                                                            <select class="form-control" name="relationship"
                                                                id="relationship">
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
                                                            <input type="text" name="mobile" id="mobile"
                                                                class="form-control" />
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Member</button>
                                                    </div>





                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Family Details

                                                        <button type="button" style="float: right;"
                                                            class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#familyadd">
                                                            Add Family Members
                                                        </button>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="myTable1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>S.No</b></th>
                                                                    <th><b>Name</b></th>
                                                                    <th><b>Gender</b></th>
                                                                    <th><b>Relationship</b></th>
                                                                    <th><b>Mobile Number</b></th>
                                                                    <th align="center"><b>Action</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php


                                                                $query = "SELECT * FROM family where id='$s'";
                                                                $query_run = mysqli_query($db, $query);

                                                                if (mysqli_num_rows($query_run) > 0) {
                                                                    $sss = 1;
                                                                    foreach ($query_run as $student) {

                                                                        ?>
                                                                        <tr>
                                                                            <td><?= $sss ?></td>
                                                                            <td><?= $student['name'] ?></td>
                                                                            <td><?= $student['gender'] ?></td>
                                                                            <td><?= $student['relationship'] ?></td>
                                                                            <td><?= $student['mobile'] ?></td>
                                                                            <td align="center">
                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="editfamilyBtn btn btn-success btn-sm">Edit</button>
                                                                                <button type="button"
                                                                                    value="<?= $student['uid']; ?>"
                                                                                    class="deletefamilyBtn btn btn-danger btn-sm">Delete</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $sss = $sss + 1;
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
                                <!-- tab end-->

                                <div class="tab-pane p-20" id="medical" role="tabpanel">

                                    <?php
                                    $query = "SELECT * FROM basic WHERE id='$s'";
                                    $query_run = mysqli_query($db, $query);

                                    if (mysqli_num_rows($query_run) >= 0) {
                                        $student = mysqli_fetch_array($query_run);
                                    }


                                    ?>

                                    <form id="medical" class="needs-validation" novalidate>
                                        <div id="errorresearch" class="alert alert-warning d-none"></div>
                                        <div class="card-header">
                                            <h4> Medical Record </h4>
                                        </div>



                                        <div class="form-row">

                                            <div class="col-md-6 mb-1">
                                                <label for="validationCustom01">Major Surgery Undergone(if any)</label>
                                                <input type="text" name="sur" class="form-control"
                                                    id="validationCustom01" placeholder="Surgery info"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['surgery'];
                                                    } else {
                                                        echo "";
                                                    } ?>">
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="validationCustom02">Medical Insurance(if any)</label>
                                                <input type="text" class="form-control" name="ins"
                                                    id="validationCustom02" placeholder="Insurance info"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student['insurance'];
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












                                <!-- tab end-->


                                <div class="tab-pane p-20" id="nominee" role="tabpanel">

                                    <?php
                                    $query = "SELECT * FROM nominee WHERE id='$s'";
                                    $query_run = mysqli_query($db, $query);

                                    if (mysqli_num_rows($query_run) >= 0) {
                                        $student5 = mysqli_fetch_array($query_run);
                                    }


                                    ?>

                                    <form id="nominee" class="needs-validation" novalidate>
                                        <div id="errornominee" class="alert alert-warning d-none"></div>
                                        <div class="card-header">
                                            <h4> Nominee Details </h4>
                                        </div>



                                        <div class="form-row">

                                            <div class="col-md-4 mb-1">
                                                <label for="">Choose Nominee * </label>

                                                <select class="form-control" name="name" id="student"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student5['name'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    required>
                                                    <?php
                                                    $query2 = "SELECT name FROM family WHERE id='$s'";
                                                    $query_run2 = mysqli_query($db, $query2);

                                                    if (mysqli_num_rows($query_run2) >= 0) {
                                                        while ($optionData = $query_run2->fetch_assoc()) {
                                                            $option = $optionData['name'];


                                                            ?>
                                                            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                                                            <?php
                                                        }
                                                    } ?>
                                                </select>
                                            </div>


                                            <div class="col-md-4 mb-1">
                                                <label for="">Nomination for *</label>
                                                <select class="form-control" name="type" id="gender"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student5['type'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option value="Family Benefit">Family Benefit</option>
                                                    <option value="PF">PF</option>
                                                    <option value="Death cum retirement gratuity">Death cum retirement
                                                        gratuity</option>
                                                </select>
                                            </div>


                                            <div class="col-md-4 mb-1">
                                                <label for="">Amount of share of gratuity payable *</label>
                                                <select class="form-control" name="share" id="gender"
                                                    value="<?php if (mysqli_num_rows($query_run) == 1) {
                                                        echo $student5['share'];
                                                    } else {
                                                        echo "";
                                                    } ?>"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option value="20%">20%</option>
                                                    <option value="50%">50%</option>
                                                    <option value="75%">75%</option>
                                                </select>
                                            </div>

                                        </div>


                                        <button class="btn btn-primary" type="submit">Submit</button>


                                    </form>


                                </div>












                                <!-- tab end-->



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
        $(document).on('submit', '#saveStudent', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_student", true);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res.status);
                    if (res.status == 422) {
                        $('#errorbasic').removeClass('d-none');
                        $('#errorbasic').text(res.message);

                    } else if (res.status == 200) {

                        $('#errorbasic').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        //$('#saveStudent')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 500) {
                        $('#errorbasic').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        //$('#saveStudent')[0].reset();
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStudentBtn', function () {

            var student_id = $(this).data('student-id');

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

        $(document).on('click', '.viewStudentAction', function () {

            var student_id = $(this).data('student-id');
            var action = $(this).data('action');
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

            var student_id = $(this).data('student-id');
            //var action = $(this).data('cert');
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
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









        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this data?')) {
                var student_id = $(this).data('student-id');
                $.ajax({
                    type: "POST",
                    url: "code.php",
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
                            alertify.error(res.message);

                            $('#myTable').load(location.href + " #myTable");
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
        var AndraPradesh = ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Kadapa", "Krishna", "Kurnool", "Prakasam", "Nellore", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari"];
        var ArunachalPradesh = ["Anjaw", "Changlang", "Dibang Valley", "East Kameng", "East Siang", "Kra Daadi", "Kurung Kumey", "Lohit", "Longding", "Lower Dibang Valley", "Lower Subansiri", "Namsai", "Papum Pare", "Siang", "Tawang", "Tirap", "Upper Siang", "Upper Subansiri", "West Kameng", "West Siang", "Itanagar"];
        var Assam = ["Baksa", "Barpeta", "Biswanath", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang", "Dhemaji", "Dhubri", "Dibrugarh", "Goalpara", "Golaghat", "Hailakandi", "Hojai", "Jorhat", "Kamrup Metropolitan", "Kamrup (Rural)", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur", "Majuli", "Morigaon", "Nagaon", "Nalbari", "Dima Hasao", "Sivasagar", "Sonitpur", "South Salmara Mankachar", "Tinsukia", "Udalguri", "West Karbi Anglong"];
        var Bihar = ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar", "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", "Kaimur", "Katihar", "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", "Madhubani", "Munger", "Muzaffarpur", "Nalanda", "Nawada", "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", "Sheohar", "Sitamarhi", "Siwan", "Supaul", "Vaishali", "West Champaran"];
        var Chhattisgarh = ["Balod", "Baloda Bazar", "Balrampur", "Bastar", "Bemetara", "Bijapur", "Bilaspur", "Dantewada", "Dhamtari", "Durg", "Gariaband", "Janjgir Champa", "Jashpur", "Kabirdham", "Kanker", "Kondagaon", "Korba", "Koriya", "Mahasamund", "Mungeli", "Narayanpur", "Raigarh", "Raipur", "Rajnandgaon", "Sukma", "Surajpur", "Surguja"];
        var Goa = ["North Goa", "South Goa"];
        var Gujarat = ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha", "Bharuch", "Bhavnagar", "Botad", "Chhota Udaipur", "Dahod", "Dang", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar", "Junagadh", "Kheda", "Kutch", "Mahisagar", "Mehsana", "Morbi", "Narmada", "Navsari", "Panchmahal", "Patan", "Porbandar", "Rajkot", "Sabarkantha", "Surat", "Surendranagar", "Tapi", "Vadodara", "Valsad"];
        var Haryana = ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurugram", "Hisar", "Jhajjar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Mewat", "Palwal", "Panchkula", "Panipat", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamunanagar"];
        var HimachalPradesh = ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul Spiti", "Mandi", "Shimla", "Sirmaur", "Solan", "Una"];
        var JammuKashmir = ["Anantnag", "Bandipora", "Baramulla", "Budgam", "Doda", "Ganderbal", "Jammu", "Kargil", "Kathua", "Kishtwar", "Kulgam", "Kupwara", "Leh", "Poonch", "Pulwama", "Rajouri", "Ramban", "Reasi", "Samba", "Shopian", "Srinagar", "Udhampur"];
        var Jharkhand = ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih", "Godda", "Gumla", "Hazaribagh", "Jamtara", "Khunti", "Koderma", "Latehar", "Lohardaga", "Pakur", "Palamu", "Ramgarh", "Ranchi", "Sahebganj", "Seraikela Kharsawan", "Simdega", "West Singhbhum"];
        var Karnataka = ["Bagalkot", "Bangalore Rural", "Bangalore Urban", "Belgaum", "Bellary", "Bidar", "Vijayapura", "Chamarajanagar", "Chikkaballapur", "Chikkamagaluru", "Chitradurga", "Dakshina Kannada", "Davanagere", "Dharwad", "Gadag", "Gulbarga", "Hassan", "Haveri", "Kodagu", "Kolar", "Koppal", "Mandya", "Mysore", "Raichur", "Ramanagara", "Shimoga", "Tumkur", "Udupi", "Uttara Kannada", "Yadgir"];
        var Kerala = ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode", "Malappuram", "Palakkad", "Pathanamthitta", "Thiruvananthapuram", "Thrissur", "Wayanad"];
        var MadhyaPradesh = ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat", "Barwani", "Betul", "Bhind", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara", "Damoh", "Datia", "Dewas", "Dhar", "Dindori", "Guna", "Gwalior", "Harda", "Hoshangabad", "Indore", "Jabalpur", "Jhabua", "Katni", "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena", "Narsinghpur", "Neemuch", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna",
            "Sehore", "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Sidhi", "Singrauli", "Tikamgarh", "Ujjain", "Umaria", "Vidisha"];
        var Maharashtra = ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana", "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna", "Kolhapur", "Latur", "Mumbai City", "Mumbai Suburban", "Nagpur", "Nanded", "Nandurbar", "Nashik", "Osmanabad", "Palghar", "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg", "Solapur", "Thane", "Wardha", "Washim", "Yavatmal"];
        var Manipur = ["Bishnupur", "Chandel", "Churachandpur", "Imphal East", "Imphal West", "Jiribam", "Kakching", "Kamjong", "Kangpokpi", "Noney", "Pherzawl", "Senapati", "Tamenglong", "Tengnoupal", "Thoubal", "Ukhrul"];
        var Meghalaya = ["East Garo Hills", "East Jaintia Hills", "East Khasi Hills", "North Garo Hills", "Ri Bhoi", "South Garo Hills", "South West Garo Hills", "South West Khasi Hills", "West Garo Hills", "West Jaintia Hills", "West Khasi Hills"];
        var Mizoram = ["Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip", "Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip"];
        var Nagaland = ["Dimapur", "Kiphire", "Kohima", "Longleng", "Mokokchung", "Mon", "Peren", "Phek", "Tuensang", "Wokha", "Zunheboto"];
        var Odisha = ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack", "Debagarh", "Dhenkanal", "Gajapati", "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara", "Kendujhar", "Khordha", "Koraput", "Malkangiri", "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada", "Sambalpur", "Subarnapur", "Sundergarh"];
        var Punjab = ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib", "Fazilka", "Firozpur", "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Mansa", "Moga", "Mohali", "Muktsar", "Pathankot", "Patiala", "Rupnagar", "Sangrur", "Shaheed Bhagat Singh Nagar", "Tarn Taran"];
        var Rajasthan = ["Ajmer", "Alwar", "Banswara", "Baran", "Barmer", "Bharatpur", "Bhilwara", "Bikaner", "Bundi", "Chittorgarh", "Churu", "Dausa", "Dholpur", "Dungarpur", "Ganganagar", "Hanumangarh", "Jaipur", "Jaisalmer", "Jalore", "Jhalawar", "Jhunjhunu", "Jodhpur", "Karauli", "Kota", "Nagaur", "Pali", "Pratapgarh", "Rajsamand", "Sawai Madhopur", "Sikar", "Sirohi", "Tonk", "Udaipur"];
        var Sikkim = ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"];
        var TamilNadu = ["Ariyalur", "Chengalpattu", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kallakurichi", "Kancheepuram", "Kanyakumari", "Karur", "Krishnagiri", "Madurai", "Mayiladuthurai", "Nagapattinam", "Namakkal", "Nilgiris", "Perambalur", "Pudukkottai", "Ramanathapuram", "Ranipet", "Salem", "Sivagangai", "Tenkasi", "Thanjavur", "Theni", "Thoothukudi", "Tiruchirappalli", "Tirunelveli", "Tirupathur", "Tiruppur", "Tiruvallur", "Tiruvannamalai", "Tiruvarur", "Vellore", "Viluppuram", "Virudhunagar"];
        var Telangana = ["Adilabad", "Bhadradri Kothagudem", "Hyderabad", "Jagtial", "Jangaon", "Jayashankar", "Jogulamba", "Kamareddy", "Karimnagar", "Khammam", "Komaram Bheem", "Mahabubabad", "Mahbubnagar", "Mancherial", "Medak", "Medchal", "Nagarkurnool", "Nalgonda", "Nirmal", "Nizamabad", "Peddapalli", "Rajanna Sircilla", "Ranga Reddy", "Sangareddy", "Siddipet", "Suryapet", "Vikarabad", "Wanaparthy", "Warangal Rural", "Warangal Urban", "Yadadri Bhuvanagiri"];
        var Tripura = ["Dhalai", "Gomati", "Khowai", "North Tripura", "Sepahijala", "South Tripura", "Unakoti", "West Tripura"];
        var UttarPradesh = ["Agra", "Aligarh", "Allahabad", "Ambedkar Nagar", "Amethi", "Amroha", "Auraiya", "Azamgarh", "Baghpat", "Bahraich", "Ballia", "Balrampur", "Banda", "Barabanki", "Bareilly", "Basti", "Bhadohi", "Bijnor", "Budaun", "Bulandshahr", "Chandauli", "Chitrakoot", "Deoria", "Etah", "Etawah", "Faizabad", "Farrukhabad", "Fatehpur", "Firozabad", "Gautam Buddha Nagar", "Ghaziabad", "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hapur", "Hardoi", "Hathras", "Jalaun", "Jaunpur", "Jhansi", "Kannauj", "Kanpur Dehat", "Kanpur Nagar", "Kasganj", "Kaushambi", "Kheri", "Kushinagar", "Lalitpur", "Lucknow", "Maharajganj", "Mahoba", "Mainpuri", "Mathura", "Mau", "Meerut", "Mirzapur", "Moradabad", "Muzaffarnagar", "Pilibhit", "Pratapgarh", "Raebareli", "Rampur", "Saharanpur", "Sambhal", "Sant Kabir Nagar", "Shahjahanpur", "Shamli", "Shravasti", "Siddharthnagar", "Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"];
        var Uttarakhand = ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar", "Nainital", "Pauri", "Pithoragarh", "Rudraprayag", "Tehri", "Udham Singh Nagar", "Uttarkashi"];
        var WestBengal = ["Alipurduar", "Bankura", "Birbhum", "Cooch Behar", "Dakshin Dinajpur", "Darjeeling", "Hooghly", "Howrah", "Jalpaiguri", "Jhargram", "Kalimpong", "Kolkata", "Malda", "Murshidabad", "Nadia", "North 24 Parganas", "Paschim Bardhaman", "Paschim Medinipur", "Purba Bardhaman", "Purba Medinipur", "Purulia", "South 24 Parganas", "Uttar Dinajpur"];
        var AndamanNicobar = ["Nicobar", "North Middle Andaman", "South Andaman"];
        var Chandigarh = ["Chandigarh"];
        var DadraHaveli = ["Dadra Nagar Haveli"];
        var DamanDiu = ["Daman", "Diu"];
        var Delhi = ["Central Delhi", "East Delhi", "New Delhi", "North Delhi", "North East Delhi", "North West Delhi", "Shahdara", "South Delhi", "South East Delhi", "South West Delhi", "West Delhi"];
        var Lakshadweep = ["Lakshadweep"];
        var Puducherry = ["Karaikal", "Mahe", "Puducherry", "Yanam"];


        $("#inputState").change(function () {
            var StateSelected = $(this).val();
            var optionsList;
            var htmlString = "";

            switch (StateSelected) {
                case "Andra Pradesh":
                    optionsList = AndraPradesh;
                    break;
                case "Arunachal Pradesh":
                    optionsList = ArunachalPradesh;
                    break;
                case "Assam":
                    optionsList = Assam;
                    break;
                case "Bihar":
                    optionsList = Bihar;
                    break;
                case "Chhattisgarh":
                    optionsList = Chhattisgarh;
                    break;
                case "Goa":
                    optionsList = Goa;
                    break;
                case "Gujarat":
                    optionsList = Gujarat;
                    break;
                case "Haryana":
                    optionsList = Haryana;
                    break;
                case "Himachal Pradesh":
                    optionsList = HimachalPradesh;
                    break;
                case "Jammu and Kashmir":
                    optionsList = JammuKashmir;
                    break;
                case "Jharkhand":
                    optionsList = Jharkhand;
                    break;
                case "Karnataka":
                    optionsList = Karnataka;
                    break;
                case "Kerala":
                    optionsList = Kerala;
                    break;
                case "Madya Pradesh":
                    optionsList = MadhyaPradesh;
                    break;
                case "Maharashtra":
                    optionsList = Maharashtra;
                    break;
                case "Manipur":
                    optionsList = Manipur;
                    break;
                case "Meghalaya":
                    optionsList = Meghalaya;
                    break;
                case "Mizoram":
                    optionsList = Mizoram;
                    break;
                case "Nagaland":
                    optionsList = Nagaland;
                    break;
                case "Orissa":
                    optionsList = Orissa;
                    break;
                case "Punjab":
                    optionsList = Punjab;
                    break;
                case "Rajasthan":
                    optionsList = Rajasthan;
                    break;
                case "Sikkim":
                    optionsList = Sikkim;
                    break;
                case "Tamil Nadu":
                    optionsList = TamilNadu;
                    break;
                case "Telangana":
                    optionsList = Telangana;
                    break;
                case "Tripura":
                    optionsList = Tripura;
                    break;
                case "Uttaranchal":
                    optionsList = Uttaranchal;
                    break;
                case "Uttar Pradesh":
                    optionsList = UttarPradesh;
                    break;
                case "West Bengal":
                    optionsList = WestBengal;
                    break;
                case "Andaman and Nicobar Islands":
                    optionsList = AndamanNicobar;
                    break;
                case "Chandigarh":
                    optionsList = Chandigarh;
                    break;
                case "Dadar and Nagar Haveli":
                    optionsList = DadraHaveli;
                    break;
                case "Daman and Diu":
                    optionsList = DamanDiu;
                    break;
                case "Delhi":
                    optionsList = Delhi;
                    break;
                case "Lakshadeep":
                    optionsList = Lakshadeep;
                    break;
                case "Pondicherry":
                    optionsList = Pondicherry;
                    break;
            }


            for (var i = 0; i < optionsList.length; i++) {
                htmlString = htmlString + "<option value='" + optionsList[i] + "'>" + optionsList[i] + "</option>";
            }
            $("#inputDistrict").html(htmlString);

        });

        function fileValidation(inputId) {
            var fileInput = document.getElementById(inputId);
            var fileSize = (fileInput.files[0].size) / 1024;
            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

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
            }
            else {
                if (fileSize > 2000) {
                    var msg = "File size should be less than 2MB!";
                    fileInput.value = '';
                    document.getElementById("tutorial").innerHTML = msg;
                }
            }



        }

    </script>
    <script>
        var UG = ["BE", "B.Tech", "B.Arch", "B.S", "B.A", "B.Sc", "BBA", "BCA", "B.Com", "B.Com(CA)", "BBM"];
        var PG = ["ME", "M.Tech", "M.Arch", "M.S", "M.A", "M.Sc", "MBA", "MCA", "M.Com", "M.Phil"];
        var ITI = ["ITI"];
        var DIPLOMA = ["Diploma"];
        var SSLC = ["SSLC"];
        var HSC = ["HSC"];
        var PHD = ["PHD"];
        var PDF = ["PDF"];

        $("#course").change(function () {
            var StateSelected = $(this).val();
            var optionsList;
            var htmlString = "";

            switch (StateSelected) {
                case "SSLC":
                    optionsList = SSLC;
                    break;
                case "HSC":
                    optionsList = HSC;
                    break;
                case "ITI":
                    optionsList = ITI;
                    break;
                case "DIPLOMA":
                    optionsList = DIPLOMA;
                    break;
                case "UG":
                    optionsList = UG;
                    break;
                case "PG":
                    optionsList = PG;
                    break;
                case "PHD":
                    optionsList = PHD;
                    break;
                case "PDF":
                    optionsList = PDF;
                    break;
            }


            for (var i = 0; i < optionsList.length; i++) {
                htmlString = htmlString + "<option value='" + optionsList[i] + "'>" + optionsList[i] + "</option>";
            }
            $("#degree").html(htmlString);

        });
    </script>

    <script>
        var UG = ["BE", "B.Tech", "B.Arch", "B.S", "B.A", "B.Sc", "BBA", "BCA", "B.Com", "B.Com(CA)", "BBM"];
        var PG = ["ME", "M.Tech", "M.Arch", "M.S", "M.A", "M.Sc", "MBA", "MCA", "M.Com", "M.Phil"];
        var ITI = ["ITI"];
        var DIPLOMA = ["Diploma"];
        var SSLC = ["SSLC"];
        var HSC = ["HSC"];
        var PHD = ["PHD"];
        var PDF = ["PDF"];

        $("#course2").change(function () {
            var StateSelected = $(this).val();
            var optionsList;
            var htmlString = "";

            switch (StateSelected) {
                case "SSLC":
                    optionsList = SSLC;
                    break;
                case "HSC":
                    optionsList = HSC;
                    break;
                case "ITI":
                    optionsList = ITI;
                    break;
                case "DIPLOMA":
                    optionsList = DIPLOMA;
                    break;
                case "UG":
                    optionsList = UG;
                    break;
                case "PG":
                    optionsList = PG;
                    break;
                case "PHD":
                    optionsList = PHD;
                    break;
                case "PDF":
                    optionsList = PDF;
                    break;
            }


            for (var i = 0; i < optionsList.length; i++) {
                htmlString = htmlString + "<option value='" + optionsList[i] + "'>" + optionsList[i] + "</option>";
            }
            $("#degree2").html(htmlString);

        });
    </script>

    <script>

        $(document).on('submit', '#basic', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_basic", true);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    var res = jQuery.parseJSON(response);
                    console.log(res.status);
                    if (res.status == 422) {
                        $('#Abasic').removeClass('d-none');
                        $('#Abasic').text(res.message);

                    } else if (res.status == 200) {

                        $('#Abasic').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);



                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });



        $(document).on('submit', '#medical', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_medical", true);

            console.log(formData);

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


        $(document).on('submit', '#nominee', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_nominee", true);

            console.log(formData);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $('#errornominee').removeClass('d-none');
                        $('#errornominee').text(res.message);

                    } else if (res.status == 200) {

                        $('#errornominee').addClass('d-none');

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);



                    } else if (res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('submit', '#familyadd2', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_family", true);

            $.ajax({
                type: "POST",
                url: "code.php",
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
                        $('#familyadd').modal('hide');
                        $('#familyadd2')[0].reset();

                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable1').load(location.href + " #myTable1");
                        $('#nominee').load(location.href + " #nominee");

                    } else if (res.status == 500) {
                        $('#errorMessage').addClass('d-none');
                        $('#familyadd').modal('hide');
                        $('#familyadd2')[0].reset();
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
                            $('#nominee').load(location.href + " #nominee");
                        }
                    }
                });
            }
        });




    </script>


</body>

</html>