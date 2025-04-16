<?php
require "config.php";
include("session.php");
//query for 1st table input 
//Faculty complaint table
$sql1 = "
SELECT cd.*, faculty_details.faculty_name, faculty_details.department, faculty_details.faculty_contact, faculty_details.faculty_mail
FROM complaints_detail cd
JOIN faculty_details ON cd.faculty_id = faculty_details.faculty_id
WHERE cd.status IN ('22','9')
";
$result1 = mysqli_query($db, $sql1);
$row_count1 = mysqli_num_rows($result1);
//manager table
$sql2 = "SELECT * FROM worker_details";
$result2 = mysqli_query($db, $sql2);
//worker details fetch panna
$sql3 = "SELECT * FROM complaints_detail WHERE status IN ('7','10','11','13')";
$result3 = mysqli_query($db, $sql3);
$row_count3 = mysqli_num_rows($result3);

//worker details fetch panna
$sql4 = "SELECT * FROM complaints_detail WHERE status IN ('8','19')";
$result4 = mysqli_query($db, $sql4);

$sql9 = "SELECT * FROM complaints_detail WHERE status IN ('8')";
$result9 = mysqli_query($db, $sql9);
$row_count4 = mysqli_num_rows($result9);

//work finished table
$sql5 = "SELECT * FROM complaints_detail WHERE status = '14'";
$result5 = mysqli_query($db, $sql5);
$row_count5 = mysqli_num_rows($result5);
//work completed table
$sql6 = "SELECT * FROM complaints_detail WHERE status='16'";
$result6 = mysqli_query($db, $sql6);
$row_count2  = mysqli_num_rows($result6);
//work reassigned table
$sql7 = "SELECT * FROM complaints_detail WHERE status IN ('15','17','18')";
$result7 = mysqli_query($db, $sql7);
$row_count7 = mysqli_num_rows($result7);

//display all users
$sql10 = "SELECT * FROM faculty_details";
$result10 = mysqli_query($db, $sql10);

//display all workers
$sql11 = "SELECT * FROM worker_details";
$result11 = mysqli_query($db, $sql11);


if (isset($_POST['fdept'])) {
    $fdept = "SELECT * FROM departments";
    $fdept_run = mysqli_query($db, $fdept);
    $options = '';


    while ($row = mysqli_fetch_assoc($fdept_run)) {
        $options .= '<option value="' . $row['dname'] . '">' . $row['dname'] . '</option>';
    }
    echo $options;
    exit;
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>MIC - MKCE</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/extra-libs/multicheck/multicheck.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">

    <!-- CSS Alertify-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <!-- Bootstrap theme alertify-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />
    <link href="css/dboardstyles.css" rel="stylesheet">

    <style>
        .nav-tabs .nav-link {
            color: #0033cc;
        }

        .nav-tabs .nav-link.active {
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
        }

        /* Dropdown animation */
        .dropdown-menu {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
        }

        .selected-priority {
            background-color: blue;
            color: white;
        }
    </style>

    <!-- Additional CSS for Modal -->
    <style>
        .close span {
            display: inline-block;
            transition: transform 0.3s ease-in-out;
        }

        .close:hover span {
            transform: rotate(45deg);
            color: white;
        }

        /* Close Button */
        .modal-header .close {
            font-size: 1.5rem;
            color: white;
            opacity: 1;
            transition: transform 0.3s ease;
            outline: none;
            /* Removes the focus outline */
            border: none;
            /* Ensures no border around the button */
        }

        .modal-header .close:focus {
            outline: none;
            /* Removes focus outline when the button is clicked */
            box-shadow: none;
            /* Ensures no shadow or box effect appears */
        }

        .modal-header .close:hover {
            transform: rotate(90deg);
            color: #ff8080;
        }


        /* priority modal */
        /* Modal Background */
        .modal-content {
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            background-color: #f5f5f5;

            border: none;
        }

        /* Header Styling with Gradient */
        .modal-header {
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
            border-bottom: none;
            padding: 10px 20px;
            border-radius: 12px 12px 0 0;
        }

        .modal-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        /* Close Button */
        .modal-header .close {
            font-size: 1.5rem;
            color: white;
            opacity: 1;
            transition: transform 0.3s ease;
        }

        .modal-header .close:hover {


            transform: rotate(90deg);
            color: #ff8080;
        }

        /* Modal Body */
        .modal-body {
            font-family: 'Arial', sans-serif;
            color: #333;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Form Inputs and Labels */
        label {
            font-weight: bold;
            color: #555;
        }

        input[type="date"],
        input[type="text"] {
            border: none;
            /* Removed border */
            border-radius: 8px;
            padding: 5px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        input[type="date"]:focus,
        input[type="text"]:focus {
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        /* Radio Buttons */
        .form-check-input[type="radio"] {
            transform: scale(1.2);
            margin-right: 10px;
            outline: none;
            /* Removes the focus outline */
            box-shadow: none !important;
            /* Removes the box-like effect when clicked */
        }

        .form-check-input[type="radio"]:focus {
            box-shadow: none;
            /* Ensures no shadow appears when focused */
        }

        /* Checkbox (No toggle effect) */
        #flexSwitchCheckDefault {
            width: auto;
            height: auto;
            background-color: transparent;
            cursor: pointer;
            transition: none;
            position: relative;
        }

        #flexSwitchCheckDefault:checked {
            background-color: transparent;
        }

        #flexSwitchCheckDefault::after {
            content: none;
        }

        /* Reason Input */
        #reasonInput {
            margin-top: 10px;
        }

        /* Modal Footer Buttons */
        .modal-footer .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .modal-footer .btn-primary:hover {
            background-color: #0056b3;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
        }




        /* Dropdown styling */
        ul.dropdown-menu {
            background-color: #f8f9fa;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 7px 0;
            text-align: center;
            opacity: 0;
            /* Start hidden */
            transform: translateY(-20px);
            /* Slightly above */
            /* Smooth transition */
            visibility: hidden;
            /* Initially hidden */
        }

        ul.dropdown-menu.show {
            opacity: 1;
            /* Fully visible */
            transform: translateY(0);
            /* Return to original position */
            visibility: visible;
            /* Visible */
        }

        ul.dropdown-menu li {
            display: block;
        }

        ul.dropdown-menu li a {
            display: block;
            padding: 5px 12px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
            /* Smooth hover effect */
        }

        ul.dropdown-menu li a:hover {
            background-color: #e9ecef;
            color: #0056b3;
            border-radius: 10px;
            transform: scale(1.05);
            /* Slight zoom effect on hover */
        }

        /* Center the dropdown items */
        ul.dropdown-menu center {
            display: block;
        }

        /* Animation for dropdown items (staggered effect) */
        ul.dropdown-menu li {
            animation: fadeIn 0.4s ease forwards;
            opacity: 0;
            /* Initially invisible */
        }

        /* Staggering delay for each item */
        ul.dropdown-menu li:nth-child(1) {
            animation-delay: 0.05s;
        }

        ul.dropdown-menu li:nth-child(2) {
            animation-delay: 0.1s;
        }

        ul.dropdown-menu li:nth-child(3) {
            animation-delay: 0.15s;
        }

        ul.dropdown-menu li:nth-child(4) {
            animation-delay: 0.2s;
        }

        ul.dropdown-menu li:nth-child(5) {
            animation-delay: 0.25s;
        }

        ul.dropdown-menu li:nth-child(6) {
            animation-delay: 0.30s;
        }

        /* Keyframes for dropdown items */
        @keyframes fadeIn {
            0% {
                transform: translateY(-20px);
                /* Move vertically */
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                /* Move to original position */
                opacity: 1;
            }
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        .modal-body p {
            margin: 10px 0;
            /* Adds spacing between paragraphs */
        }

        .modal-footer .btn {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .modal-footer .btn:hover {
            background-color: #e9ecef;
            /* Light background on hover */
            color: black;
        }

        /*star rating*/
        .stars span {
            font-size: 2rem;
            cursor: pointer;
            color: gray;
            /* Default color for unlit stars */
            transition: color 0.3s;
        }

        .stars span.highlighted {
            color: gold;
            /* Color for lit stars */
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
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal"
                                    data-target="#manageworkermodal"><i class="ti-user m-r-5 m-l-5"></i>
                                    Manager Worker</a>
                                <a class="dropdown-item fetchdept" href="javascript:void(0)" data-toggle="modal"
                                    data-target="#manageusermodal"><i class="ti-user m-r-5 m-l-5"></i>
                                    Manager User</a>
                                <a class="dropdown-item" href="Logout"><i class="fa fa-power-off m-r-5 m-l-5"></i>
                                    Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <?php
        include("side.php");
        ?>
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
                        <h4 class="page-title">Complaints</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">

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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">


                            <div id="navref">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist" id="navli">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#dashboard"
                                            role="tab"><span class="hidden-sm-up"></span>
                                            <span class="hidden-xs-down"><b>Dashboard</b></span>
                                        </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#complain"
                                            role="tab"><span class="hidden-sm-up"></span>
                                            <div id="navref1"> <span class="hidden-xs-down"><b>Complaint Raised
                                                        (<?php echo $row_count1; ?>)</b></span></div>
                                        </a> </li>

                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#principal"
                                            role="tab"><span class="hidden-sm-up"></span>
                                            <div id="navref2"> <span class="hidden-xs-down"><b>Principal Approval
                                                        (<?php echo $row_count4; ?>)</b></span></div>
                                        </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#worker"
                                            role="tab"><span class="hidden-sm-up"></span>
                                            <div id="navref3"> <span class="hidden-xs-down"><b>Assigned
                                                        (<?php echo $row_count3; ?>)</b></span> </div>
                                        </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#finished"
                                            role="tab"><span class="hidden-sm-up"></span>
                                            <div id="navref4"> <span class="hidden-xs-down"><b>Response
                                                        (<?php echo $row_count5; ?>)</b></span></div>
                                        </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reassigned"
                                            role="tab"><span class="hidden-sm-up"></span>
                                            <div id="navref5"> <span class="hidden-xs-down"><b>Reassigned
                                                        (<?php echo $row_count7; ?>)</b></span></div>
                                        </a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#completed"
                                            role="tab"><span class="hidden-sm-up"></span><span
                                                class="hidden-xs-down"><b>Completed works</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#record"
                                            role="tab"><span class="hidden-sm-up"></span> <span
                                                class="hidden-xs-down"><b>Work Record</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#workersr"
                                            role="tab"><span class="hidden-sm-up"></span> <span
                                                class="hidden-xs-down"><b>Workers Record</b></span></a> </li>
                                </ul>
                            </div>

                            <!-- Tab panes -->
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane p-20 active show" id="dashboard" role="tabpanel">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title m-b-0">Issue Analysis</h4><br>
                                            <div class="row">
                                                <div class="col-12 col-md-3 mb-3">
                                                    <div class="cir">
                                                        <div class="bo">
                                                            <div class="content1">
                                                                <div class="stats-box text-center p-3"
                                                                    style="background-color:rgb(252, 119, 71);">
                                                                    <i class="fas fa-bell m-b-5 font-20"></i>
                                                                    <h1 class="m-b-0 m-t-5"><?php echo $row_count1; ?>
                                                                    </h1>
                                                                    <small class="font-light">New issues</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 mb-3">
                                                    <div class="cir">
                                                        <div class="bo">
                                                            <div class="content1">
                                                                <div class="stats-box text-center p-3"
                                                                    style="background-color:rgb(241, 74, 74);">
                                                                    <i class="fas fa-exclamation m-b-5 font-16"></i>
                                                                    <h1 class="m-b-0 m-t-5"><?php echo $row_count3; ?>
                                                                    </h1>
                                                                    <small class="font-light">Pending</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 mb-3">
                                                    <div class="cir">
                                                        <div class="bo">
                                                            <div class="content1">
                                                                <div class="stats-box text-center p-3"
                                                                    style="background-color:rgb(70, 160, 70);">
                                                                    <i class="fas fa-check m-b-5 font-20"></i>
                                                                    <h1 class="m-b-0 m-t-5"><?php echo $row_count2; ?>
                                                                    </h1>
                                                                    <small class="font-light">Completed</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3 mb-3">
                                                    <div class="cir">
                                                        <div class="bo">
                                                            <div class="content1">
                                                                <div class="stats-box text-center p-3"
                                                                    style="background-color: rgb(187, 187, 35);">
                                                                    <i class="fas fa-redo m-b-5 font-20"></i>
                                                                    <h1 class="m-b-0 m-t-5"><?php echo $row_count7; ?>
                                                                    </h1>
                                                                    <small class="font-light">Reassigned</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--Complaint start-->
                                <div class="tab-pane p-20" id="complain" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <h5 class="card-title">Complaint Raised</h5>
                                            <table id="complain_table" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>

                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Raised Date</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Dept / Venue</h5>
                                                            </b></th>

                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Complaint</h5>
                                                            </b></th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Picture</h5>
                                                            </b>
                                                        </th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Action</h5>
                                                            </b></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $s = 1;
                                                    while ($row = mysqli_fetch_assoc($result1)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center"><?php echo $row['date_of_reg'] ?></td>
                                                            <td class="text-center"><?php echo $row['department'] ?> /
                                                                <?php echo $row['block_venue'] ?></td>

                                                            <td class="text-center"><button type="button"
                                                                    value="<?php echo $row['id']; ?>"
                                                                    class="btn viewcomplaint"
                                                                    data-value="<?php echo $row['fac_id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#complaintDetailsModal"><i
                                                                        class="fas fa-eye"
                                                                        style="font-size: 25px;"></i></button>
                                                            </td>

                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light btn-sm showImage"
                                                                    value="<?php echo $row['id']; ?>" data-toggle="modal"
                                                                    data-target="#imageModal">
                                                                    <i class="fas fa-image" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">


                                                                <?php if ($row['status'] == 9) { ?>
                                                                    <button type="button" class="btn btn-warning reassign"
                                                                        id="reassignbutton" value="<?php echo $row['id']; ?>"
                                                                        data-toggle="dropdown">
                                                                        Reassign
                                                                    </button>
                                                                    <ul class="dropdown-menu">

                                                                        <center>
                                                                            <li><a href="#" class="reass1"
                                                                                    data-value="electrical">ELECTRICAL</a></li>
                                                                            <li><a href="#" class="reass1"
                                                                                    data-value="civil">CIVIL</a></li>
                                                                            <li><a href="#" class="reass1"
                                                                                    data-value="itkm">ITKM</a></li>
                                                                            <li><a href="#" class="reass1"
                                                                                    data-value="transport">TRANSPORT</a></li>
                                                                            <li><a href="#" class="reass1"
                                                                                    data-value="house">HOUSE KEEPING</a></li>
                                                                        </center>

                                                                    </ul>
                                                                <?php } else { ?>
                                                                    <button type="button"
                                                                        class="btn btn-success  managerapprove"
                                                                        value="<?php echo $row['id']; ?>"
                                                                        data-toggle="dropdown"><i class="fas fa-check"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">

                                                                        <center>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="electrical">ELECTRICAL</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="civil">CIVIL</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="itkm">ITKM</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="transport">TRANSPORT</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="house">HOUSE KEEPING</a></li>
                                                                        </center>

                                                                    </ul>

                                                                    <button type="button" class="btn btn-danger rejectcomplaint"
                                                                        id="rejectbutton" value="<?php echo $row['id']; ?>"
                                                                        data-toggle="modal" data-target="#rejectModal"><i
                                                                            class="fas fa-times"></i></button>

                                                                    <button type="button"
                                                                        class="btn btn-primary principalcomplaint"
                                                                        id="principalbutton" value="<?php echo $row['id']; ?>"
                                                                        data-toggle="modal" data-target="#principalModal"><i
                                                                            class="fas fa-paper-plane"></i>
                                                                    </button>
                                                                <?php } ?>


                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $s++;
                                                    }
                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!-- Principal Table -->
                                <div class="tab-pane p-20" id="principal" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <h5 class="card-title">Principal Approval</h5>
                                            <table id="principal_table" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>

                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Raised Date</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Venue</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Complaint</h5>
                                                            </b></th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Picture</h5>
                                                            </b>
                                                        </th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Action</h5>
                                                            </b></th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Status</h5>
                                                            </b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $s = 1;
                                                    while ($row4 = mysqli_fetch_assoc($result4)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center"><?php echo $row4['date_of_reg'] ?></td>
                                                            <td class="text-center"><?php echo $row4['block_venue'] ?></td>
                                                            <td class="text-center">
                                                                <button type="button" value="<?php echo $row4['id']; ?>"
                                                                    class="btn viewcomplaint"
                                                                    data-value="<?php echo $row4['fac_id']; ?>">
                                                                    <i class="fas fa-eye" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>

                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light btn-sm showImage"
                                                                    value="<?php echo $row4['id']; ?>" data-toggle="modal"
                                                                    data-target="#imageModal">
                                                                    <i class="fas fa-image" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($row4['status'] == '8') { ?>
                                                                    <button type="button"
                                                                        class="btn btn-success  managerapprove"
                                                                        value="<?php echo $row4['id']; ?>"
                                                                        data-toggle="dropdown"><i class="fas fa-check"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <center>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="electrical">ELECTRICAL</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="civil">CIVIL</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="itkm">ITKM</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="transport">TRANSPORT</a></li>
                                                                            <li><a href="#" class="worker" data-toggle="modal"
                                                                                    data-target="#managerapproveModal"
                                                                                    data-value="house">HOUSE KEEPING</a></li>
                                                                        </center>

                                                                    </ul>


                                                                <?php }
                                                                if ($row4['status'] == '19') { ?>
                                                                    <button type="button" class="btn btn-primary"
                                                                        value="<?php echo $row4['id']; ?>">
                                                                        Okay</button>
                                                                <?php } ?>

                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($row4['status'] == '8') { ?>
                                                                    <span class="btn btn-success">Approved</span>

                                                                <?php }
                                                                if ($row4['status'] == '19') { ?>
                                                                    <button type="button" class="btn btn-danger rejectreasonbtn"
                                                                        value="<?php echo $row4['id']; ?>" data-toggle="modal"
                                                                        data-target="#princerejectres">Rejected</button>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $s++;
                                                    }
                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- Worker Table -->
                                <div class="tab-pane p-20" id="worker" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <h5 class="card-title">Ongoing Work's</h5>
                                            <table id="worker_table" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>

                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Complaint</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Worker</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Deadline</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Picture</h5>
                                                            </b></th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Status</h5>
                                                            </b>
                                                        </th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Principal Query</h5>
                                                            </b></th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Your Reply</h5>
                                                            </b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $s = 1;
                                                    $current_date = date('Y-m-d'); // Get current date in 'YYYY-MM-DD' format

                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                        $deadline = $row3['days_to_complete'];
                                                        $h = $row3['id']; // complaint id

                                                        // Fetch query from manager table
                                                        $querydisplay = "SELECT * FROM manager WHERE problem_id=$h";
                                                        $resultdisplay = mysqli_query($db, $querydisplay);
                                                        $rowdis = mysqli_fetch_assoc($resultdisplay);
                                                        $comment_query = $rowdis['comment_query'];
                                                        $comment_reply = $rowdis['comment_reply']; // Fetch the reply
                                                        $reply_date = $rowdis['reply_date']; // Fetch the reply date
                                                        $task_id = $rowdis['task_id']; // Unique ID from manager table

                                                        // Check if comment_reply has a value to assign the green color class
                                                        $buttonClass = empty($comment_reply) ? 'btn-primary' : 'btn-success';

                                                        // Check if current date is equal to or greater than the deadline
                                                        $rowBackground = ($current_date >= $deadline) ? 'background-color: #ffcccc;' : '';
                                                    ?>
                                                        <tr style="<?php echo $rowBackground; ?>">
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center">
                                                                <button type="button" value="<?php echo $row3['id']; ?>"
                                                                    class="btn viewcomplaint"
                                                                    data-value="<?php echo $row3['fac_id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#complaintDetailsModal"><i
                                                                        class="fas fa-eye"
                                                                        style="font-size: 25px;"></i></button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light worker_det"
                                                                    value="<?php echo $row3["id"]; ?>" data-toggle="modal"
                                                                    data-target="#workerdetailmodal">
                                                                    <?php
                                                                    $prblm_id = $row3['id'];
                                                                    $querry = "SELECT worker_first_name FROM worker_details WHERE worker_id = ( SELECT worker_dept FROM manager WHERE problem_id = '$prblm_id')";
                                                                    $querry_run = mysqli_query($db, $querry);
                                                                    $worker_name = mysqli_fetch_array($querry_run);
                                                                    echo $worker_name['worker_first_name']; ?>
                                                                </button>
                                                            </td>
                                                            <td class="text-center"> <button
                                                                    class="btn btn-light deadline_extend"
                                                                    value="<?php echo $row3["id"]; ?>" data-toggle="modal"
                                                                    data-target="#extend_date">

                                                                    <?php echo $row3['days_to_complete'] ?></button></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light btn-sm showImage"
                                                                    value="<?php echo $row3['id']; ?>" data-toggle="modal"
                                                                    data-target="#imageModal">
                                                                    <i class="fas fa-image" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center"><span class="btn btn-warning">In
                                                                    Progress</span></td>

                                                            <td class="text-center">
                                                                <button type="button"
                                                                    class="btn <?php echo $buttonClass; ?> openQueryModal"
                                                                    data-task-id="<?php echo $task_id; ?>"
                                                                    data-comment-query="<?php echo $comment_query; ?>"
                                                                    data-toggle="modal" data-target="#principalQueryModal"
                                                                    <?php echo empty($comment_query) ? 'disabled' : ''; ?>>
                                                                    <?php echo empty($comment_query) ? 'No Query' : 'View Query'; ?>
                                                                </button>
                                                            </td>
                                                            <!-- Display Comment Reply and Date if available -->
                                                            <td>
                                                                <?php if (!empty($comment_reply)): ?>
                                                                    <span> <?php echo $comment_reply; ?></span>
                                                                    <br>
                                                                    <span class="">Reply Date: <?php echo $reply_date; ?></span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-secondary">No Reply Yet</span>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $s++;
                                                    }
                                                    ?>
                                                </tbody>


                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- Work Finished Table -->
                                <div class="tab-pane p-20" id="finished" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <h5 class="card-title">Work's for Response</h5>
                                            <table id="finished_table" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>

                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Complaint</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Worker</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Completion Date</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Picture</h5>
                                                            </b></th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Faculty Feedback</h5>
                                                            </b>
                                                        </th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Status</h5>
                                                            </b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $s = 1;
                                                    while ($row5 = mysqli_fetch_assoc($result5)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center">
                                                                <button type="button" value="<?php echo $row5['id']; ?>"
                                                                    class="btn viewcomplaint"
                                                                    data-value="<?php echo $row5['fac_id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#complaintDetailsModal">
                                                                    <i class="fas fa-eye" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light worker_det"
                                                                    value="<?php echo $row5["id"]; ?>" data-toggle="modal"
                                                                    data-target="#workerdetailmodal">
                                                                    <?php
                                                                    $prblm_id = $row5['id'];
                                                                    $querry = "SELECT worker_first_name FROM worker_details WHERE worker_id = ( SELECT worker_dept FROM manager WHERE problem_id = '$prblm_id')";
                                                                    $querry_run = mysqli_query($db, $querry);
                                                                    $worker_name = mysqli_fetch_array($querry_run);
                                                                    if ($worker_name['worker_first_name'] != null) {
                                                                        echo $worker_name['worker_first_name'];
                                                                    } else {
                                                                        echo "NA";
                                                                    }
                                                                    ?>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $row5['date_of_completion'] ?></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light btn-sm showImage"
                                                                    value="<?php echo $row5['id']; ?>" data-toggle="modal"
                                                                    data-target="#imageModal">
                                                                    <i class="fas fa-image" style="font-size: 25px;"></i>
                                                                </button>
                                                                <button value="<?php echo $row5['id']; ?>" type="button"
                                                                    class="btn btn-light btn-sm imgafter"
                                                                    data-toggle="modal">
                                                                    <i class="fas fa-images" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-primary facfeed"
                                                                    value="<?php echo $row5['id']; ?>" data-toggle="modal"
                                                                    data-target="#exampleModal">
                                                                    Feedback
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                if ($row5['task_completion'] == 'Fully Completed') {
                                                                ?>
                                                                    <span
                                                                        class="btn btn-success"><?php echo $row5['task_completion'] ?></span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <button class="btn btn-warning partially"
                                                                        data-toggle="modal" data-target="#partially_reason"
                                                                        value="<?php echo $row5['id'] ?>"><?php echo $row5['task_completion'] ?></button>

                                                                <?php
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $s++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- Resigned Table -->
                                <div class="tab-pane p-20" id="reassigned" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <h5 class="card-title">Reassigned Work's</h5>
                                            <table id="reassigned_table" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>

                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Complaint</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Worker</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Date of Reassigned</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Deadline</h5>
                                                            </b></th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Picture</h5>
                                                            </b>
                                                        </th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Faculty Feedback</h5>
                                                            </b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $s = 1;
                                                    while ($row7 = mysqli_fetch_assoc($result7)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center">
                                                                <button type="button" value="<?php echo $row7['id']; ?>"
                                                                    class="btn viewcomplaint"
                                                                    data-value="<?php echo $row7['fac_id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#complaintDetailsModal">
                                                                    <i class="fas fa-eye" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light worker_det"
                                                                    value="<?php echo $row7["id"]; ?>" data-toggle="modal"
                                                                    data-target="#workerdetailmodal">
                                                                    <?php
                                                                    $prblm_id = $row7['id'];
                                                                    $querry = "SELECT worker_first_name FROM worker_details WHERE worker_id = ( SELECT worker_id FROM manager WHERE problem_id = '$prblm_id')";
                                                                    $querry_run = mysqli_query($db, $querry);
                                                                    $worker_name = mysqli_fetch_array($querry_run);
                                                                    echo $worker_name['worker_first_name']; ?>
                                                                </button>
                                                            </td>
                                                            <td class="text-center"><?php echo $row7['reassign_date'] ?>
                                                            </td>
                                                            <td class="text-center"><?php echo $row7['days_to_complete'] ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light btn-sm showImage"
                                                                    value="<?php echo $row7['id']; ?>" data-toggle="modal"
                                                                    data-target="#imageModal">
                                                                    <i class="fas fa-image" style="font-size: 25px;"></i>
                                                                </button>
                                                                <button value="<?php echo $row7['id']; ?>" type="button"
                                                                    class="btn btn-light btn-sm imgafter"
                                                                    data-toggle="modal">
                                                                    <i class="fas fa-images" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $row7['feedback']; ?>
                                                            </td>

                                                        </tr>
                                                    <?php
                                                        $s++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- Completed Table -->
                                <div class="tab-pane p-20" id="completed" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                           
                                            <table id="completed_table" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>

                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Complaint</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Worker</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Date of Completion</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Picture</h5>
                                                            </b></th>
                                                        <th class=" col-md-2 text-center"><b>
                                                                <h5>Faculty Feedback</h5>
                                                            </b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $s = 1;
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $s ?></td>
                                                            <td class="text-center">
                                                                <button type="button" value="<?php echo $row6['id']; ?>"
                                                                    class="btn viewcomplaint"
                                                                    data-value="<?php echo $row6['fac_id']; ?>"
                                                                    data-toggle="modal"
                                                                    data-target="#complaintDetailsModal">
                                                                    <i class="fas fa-eye" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light worker_det"
                                                                    value="<?php echo $row6["id"]; ?>" data-toggle="modal"
                                                                    data-target="#workerdetailmodal">
                                                                    <?php
                                                                    $prblm_id = $row6['id'];
                                                                    $querry = "SELECT worker_first_name FROM worker_details WHERE worker_id = ( SELECT worker_dept FROM manager WHERE problem_id = '$prblm_id')";
                                                                    $querry_run = mysqli_query($db, $querry);
                                                                    $worker_name = mysqli_fetch_array($querry_run);
                                                                    echo $worker_name['worker_first_name']; ?>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $row6['date_of_completion'] ?></td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-light btn-sm showImage"
                                                                    value="<?php echo $row6['id']; ?>" data-toggle="modal"
                                                                    data-target="#imageModal">
                                                                    <i class="fas fa-image" style="font-size: 25px;"></i>
                                                                </button>
                                                                <button value="<?php echo $row6['id']; ?>" type="button"
                                                                    class="btn btn-light btn-sm imgafter"
                                                                    data-toggle="modal">
                                                                    <i class="fas fa-images" style="font-size: 25px;"></i>
                                                                </button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $row6['feedback']; ?>
                                                            </td>
                                                            <!-- <td>
                                                                <span class="btn btn-success">Completed</span>
                                                            </td> -->
                                                        </tr>
                                                    <?php
                                                        $s++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                                <!-- Record Table -->

                                <div class="tab-pane p-20" id="record" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">

                                        <h5 class="card-title">Work's Completed</h5>

                                            <!-- Date Range Filter Form -->
                                            <form id="date-filter-form" style="margin: 20px auto; padding: 20px; background-color: #f9f9f9; border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 100%; font-family: Arial, sans-serif;">
                                                <div style="margin-bottom: 15px; padding: 0 20px;">
                                                    <label for="from_date" style="margin-right: 10px; font-weight: bold; font-size: 14px; color: #333;">From Date:</label>
                                                    <input type="date" id="from_date" name="from_date"
                                                        style="padding: 12px; border-radius: 8px; border: 1px solid #ccc; width: 100%; max-width: 300px; font-size: 14px; color: #333;" required>
                                                </div>
                                                <div style="margin-bottom: 15px; padding: 0 20px;">
                                                    <label for="to_date" style="margin-right: 10px; font-weight: bold; font-size: 14px; color: #333;">To Date:</label>
                                                    <input type="date" id="to_date" name="to_date"
                                                        style="padding: 12px; border-radius: 8px; border: 1px solid #ccc; width: 100%; max-width: 300px; font-size: 14px; color: #333;" required>
                                                </div>
                                                <div style="text-align: center; padding: 10px;">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="padding: 12px 30px; background-color: #007bff; border: none; border-radius: 8px; font-size: 16px; color: white; cursor: pointer; transition: background-color 0.3s ease;">
                                                        Filter
                                                    </button>
                                                </div>
                                            </form>



                                            <!-- Download Button -->
                                            <button id="download" class="btn btn-success"
                                                style="float: right; padding: 10px 20px; background-color: #28a745; border: none; border-radius: 5px; color: white;">Download as Excel</button>
                                            <br><br>

                                            <h5 class="card-title">Work Completed Records</h5>

                                            <!-- Table for Displaying Results -->
                                            <table id="record_table" class="table table-striped table-bordered">
                                                <thead style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>
                                                        <th class="text-center"><b>S.No</b></th>
                                                        <th class="text-center"><b>Work ID</b></th>
                                                        <th class="text-center"><b>Venue Details</b></th>
                                                        <th class="text-center"><b>Completed Details</b></th>
                                                        <th class="text-center"><b>Item No</b></th>
                                                        <th class="text-center"><b>Amount Spent</b></th>
                                                        <th class="text-center"><b>Faculty Feedback</b></th>
                                                        <th class="text-center"><b>Manager Feedback</b></th>
                                                        <th class="text-center"><b>Completed On</b></th>
                                                        <th class="text-center"><b>Average Rating</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Rows will be dynamically added by jQuery -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Workers Record Table -->



                                <div class="tab-pane p-20" id="workersr" role="tabpanel">
                                    <div class="p-20">
                                        <div class="table-responsive">
                                            <h5 class="card-title">Worker's Record</h5>

                                            <form id="date-form" style="padding: 20px; background-color: #f9f9f9; border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: calc(100% - 50px); margin: 20px 0 20px 20px; font-family: Arial, sans-serif;">
                                                <div style="margin-bottom: 15px;">
                                                    <label for="from_date" style="margin-right: 10px; font-weight: bold; font-size: 14px; color: #333;">From Date:</label>
                                                    <input type="date" name="from_date" value="<?php echo $from_date; ?>"
                                                        style="padding: 12px; border-radius: 8px; border: 1px solid #ccc; width: 100%; max-width: 300px; font-size: 14px; color: #333;" required>
                                                </div>
                                                <div style="margin-bottom: 15px;">
                                                    <label for="to_date" style="margin-right: 10px; font-weight: bold; font-size: 14px; color: #333;">To Date:</label>
                                                    <input type="date" name="to_date" value="<?php echo $to_date; ?>"
                                                        style="padding: 12px; border-radius: 8px; border: 1px solid #ccc; width: 100%; max-width: 300px; font-size: 14px; color: #333;" required>
                                                </div>
                                                <div style="text-align: center; padding: 10px;">
                                                    <button type="submit" class="btn btn-primary"
                                                        style="padding: 12px 30px; background-color: #007bff; border: none; border-radius: 8px; font-size: 16px; color: white; cursor: pointer; transition: background-color 0.3s ease;">
                                                        Filter
                                                    </button>
                                                </div>
                                            </form>

                                            <span style="float:right">
                                                <button id="download1" class="btn btn-success">Download as
                                                    Excel</button></span><br><br>

                                            <table id="Rworkers" class="table table-striped table-bordered">
                                                <thead
                                                    style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                    <tr>
                                                        <th class="text-center"><b>
                                                                <h5>S.No</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Worker ID</h5>
                                                            </b></th>
                                                        <th class="col-md-2 text-center"><b>
                                                                <h5>Worker Name</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Department</h5>
                                                            </b></th>
                                                        <th class="text-center"><b>
                                                                <h5>Completed Works</h5>
                                                            </b></th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Faculty Ratings</h5>
                                                            </b>
                                                        </th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>Manager Ratings</h5>
                                                            </b>
                                                        </th>
                                                        <th class="text-center">
                                                            <b>
                                                                <h5>average Rating</h5>
                                                            </b>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!--Modals-->

                            <!-- manage user Modal -->
                            <div class="modal fade" id="manageusermodal" tabindex="-1" role="dialog"
                                aria-labelledby="manageusermodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content"
                                        style="border-radius: 8px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15); background-color: #f9f9f9;">

                                        <!-- Modal Header -->
                                        <div class="modal-header"
                                            style="background-color: #007bff; color: white; border-radius: 8px 8px 0 0; padding: 15px;">
                                            <h5 class="modal-title" id="manageusermodalLabel"
                                                style="font-weight: 700; font-size: 1.4em; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                                📋Manage User's
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white; font-size: 1.2em;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body"
                                            style="padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">


                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#adduser"><i class="ti-user m-r-5 m-l-5"></i>
                                                Add User</button>

                                            <div class="tab-pane active p-20" id="complain" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="table-responsive">
                                                        <table id="user_display"
                                                            class="table table-striped table-bordered">
                                                            <thead
                                                                style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                                <tr>

                                                                    <th class="text-center"><b>
                                                                            <h5>S.No</h5>
                                                                        </b></th>
                                                                    <th class="col-md-2 text-center"><b>
                                                                            <h5>Name</h5>
                                                                        </b></th>
                                                                    <th class="text-center"><b>
                                                                            <h5>Department</h5>
                                                                        </b></th>

                                                                    <th class="col-md-2 text-center"><b>
                                                                            <h5>Role</h5>
                                                                        </b></th>
                                                                    <th class=" col-md-2 text-center"><b>
                                                                            <h5>Action</h5>
                                                                        </b></th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $s = 1;
                                                                while ($row = mysqli_fetch_assoc($result10)) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $s ?></td>
                                                                        <td class="text-center">
                                                                            <?php echo $row['faculty_name'] ?></td>
                                                                        <td class="text-center">
                                                                            <?php echo $row['department'] ?></td>
                                                                        <td class="text-center"><?php echo $row['role'] ?>
                                                                        </td>
                                                                        <td class="text-center"><button tupe="button"
                                                                                class="btn btn-danger deleteuser"
                                                                                value="<?php echo $row["id"] ?>">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    $s++;
                                                                }
                                                                ?>
                                                            </tbody>

                                                        </table>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>

                                        <!-- Modal Footer with Save Button -->
                                        <div class="modal-footer"
                                            style="background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; padding: 10px;">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- manage wo Modal -->
                            <div class="modal fade" id="manageworkermodal" tabindex="-1" role="dialog"
                                aria-labelledby="manageworkermodalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content"
                                        style="border-radius: 8px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15); background-color: #f9f9f9;">

                                        <!-- Modal Header -->
                                        <div class="modal-header"
                                            style="background-color: #007bff; color: white; border-radius: 8px 8px 0 0; padding: 15px;">
                                            <h5 class="modal-title" id="manageworkermodalLabel"
                                                style="font-weight: 700; font-size: 1.4em; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                                📋Manage Workers's
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white; font-size: 1.2em;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body"
                                            style="padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">


                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#addworker"><i class="ti-user m-r-5 m-l-5"></i>
                                                Add Worker</button>

                                            <div class="tab-pane active p-20" id="complain" role="tabpanel">
                                                <div class="p-20">
                                                    <div class="table-responsive">
                                                        <table id="worker_display"
                                                            class="table table-striped table-bordered">
                                                            <thead
                                                                style="background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%); color: white;">
                                                                <tr>

                                                                    <th class="text-center"><b>
                                                                            <h5>S.No</h5>
                                                                        </b></th>
                                                                    <th class="col-md-2 text-center"><b>
                                                                            <h5>Name</h5>
                                                                        </b></th>
                                                                    <th class="text-center"><b>
                                                                            <h5>Department</h5>
                                                                        </b></th>
                                                                    <th class="col-md-2 text-center"><b>
                                                                            <h5>Role</h5>
                                                                        </b></th>


                                                                    <th class=" col-md-2 text-center"><b>
                                                                            <h5>Action</h5>
                                                                        </b></th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $s = 1;
                                                                while ($row = mysqli_fetch_assoc($result11)) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?php echo $s ?></td>
                                                                        <td class="text-center">
                                                                            <?php echo $row['worker_first_name'] ?></td>
                                                                        <td class="text-center">
                                                                            <?php echo $row['worker_dept'] ?></td>

                                                                        <td class="text-center">
                                                                            <?php echo $row['usertype'] ?></td>

                                                                        <td class="text-center"><button tupe="button"
                                                                                class="btn btn-danger deleteworker"
                                                                                value="<?php echo $row["id"] ?>">Delete</button>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                    $s++;
                                                                }
                                                                ?>
                                                            </tbody>

                                                        </table>
                                                    </div>

                                                </div>
                                            </div>


                                        </div>

                                        <!-- Modal Footer with Save Button -->
                                        <div class="modal-footer"
                                            style="background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; padding: 10px;">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Add User option-->
                            <div class="modal fade" id="adduser" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="border-radius: 8px; border: 1px solid #ccc;">
                                        <div class="modal-header"
                                            style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="user_data">
                                            <div class="modal-body" style="padding: 20px; background-color: #f5f5f5;">

                                                <input type="text" name="userid" placeholder="Enter User Id"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">

                                                <select id="department" name="u_dept"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">

                                                </select>
                                                <select id="role" name="u_role"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">
                                                    <option value="all">Select Role</option>
                                                    <option value="infra">Infra</option>
                                                    <option value="student">Student</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    style="background-color: #6c757d; border: none; padding: 10px 20px;">Close</button>
                                                <button type="submit" class="btn btn-primary"
                                                    style="background-color: #007bff; border: none; padding: 10px 20px;">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <!--Add worker option-->
                            <div class="modal fade" id="addworker" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="border-radius: 8px; border: 1px solid #ccc;">
                                        <div class="modal-header"
                                            style="background-color: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Worker</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="workers">
                                            <div class="modal-body" style="padding: 20px; background-color: #f5f5f5;">
                                                <input type="text" name="w_name" placeholder="Enter Worker Name"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">
                                                <select id="department" name="w_dept"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">
                                                    <option value="all">Select department</option>
                                                    <option value="civil">Civil</option>
                                                    <option value="electrical">Electrical</option>
                                                    <option value="itkm">itkm</option>
                                                    <option value="transport">Transport</option>
                                                    <option value="house">House Keeping</option>

                                                </select>

                                                <select id="role" name="w_role"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">
                                                    <option value="all">Select Role</option>
                                                    <option value="head">Head</option>
                                                    <option value="worker">Worker</option>
                                                </select>

                                                <input type="text" name="w_phone" placeholder="Enter Phone Number"
                                                    style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 15px;">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    style="background-color: #6c757d; border: none; padding: 10px 20px;">Close</button>
                                                <button type="submit" class="btn btn-primary"
                                                    style="background-color: #007bff; border: none; padding: 10px 20px;">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog"
                                aria-labelledby="rejectModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel">Reject Complaint</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="rejectForm">
                                                <input type="hidden" name="id" id="complaint_id99">
                                                <div class="form-group">
                                                    <label for="rejectReason" class="form-label">Reason for
                                                        rejection</label>
                                                    <textarea class="form-control" name="feedback" id="rejectReason"
                                                        rows="3" placeholder="Type the reason here..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- manager approve -->
                            <div class="modal fade" id="managerapproveModal" tabindex="-1" role="dialog"
                                aria-labelledby="managerapproveModalLabel1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="managerapproveModalLabel1">Approval Modal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="managerapproveForm">
                                                <input type="hidden" name="problem_id" id="complaint_id56">

                                                <input type="hidden" name="worker_id" id="worker_id" value="">
                                                <p id="assignedWorker">Assigned Worker: </p>

                                                <!--deadline code-->
                                                <label for="deadline"><span class="font-weight-bold"
                                                        style="display: block; margin-bottom: 10px;">Set
                                                        Deadline:</span></label> <br>
                                                <input type="date" id="deadline01" name="deadline"> <br> <br>
                                                <span class="font-weight-bold"
                                                    style="display: block; margin-bottom: 10px;">Set Priority:</span>
                                                <ul class="list-group" style="list-style: none; padding: 0;">
                                                    <li class="list-group-item"
                                                        style="padding: 10px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 5px;">
                                                        <input type="radio" class="form-check-input" name="priority"
                                                            value="High" required>
                                                        <label class="form-check-label">High</label>
                                                    </li>
                                                    <li class="list-group-item"
                                                        style="padding: 10px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 5px;">
                                                        <input type="radio" class="form-check-input" name="priority"
                                                            value="Medium">
                                                        <label class="form-check-label">Medium</label>
                                                    </li>
                                                    <li class="list-group-item"
                                                        style="padding: 10px; background-color: #ffffff; border: 1px solid #ddd; border-radius: 4px;">
                                                        <input type="radio" class="form-check-input" name="priority"
                                                            value="Low">
                                                        <label class="form-check-label">Low</label>
                                                    </li>
                                                </ul>
                                                <br>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" form="managerapproveForm"
                                                id="submitButton">Submit</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Partially completed reason Modal -->
                            <div class="modal fade" id="partially_reason" tabindex="-1" role="dialog"
                                aria-labelledby="partially_reasonLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="partially_reasonLabel">Partially Completed
                                                Reason</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="partially_completed">
                                                <input type="hidden" name="id" id="complaint_id119">
                                                <div class="form-group">
                                                    <label for="partiallyReason" class="form-label">Reason</label>
                                                    <textarea readonly class="form-control" name="reason"
                                                        id="partiallyReason" rows="3"
                                                        placeholder="Type the reason here..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!--Principal Approve Modal -->
                            <div class="modal fade" id="principalModal" tabindex="-1" role="dialog"
                                aria-labelledby="principalModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="principalModalLabel">Need Approval</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="principal_Form">
                                                <input type="hidden" name="id" id="complaint_id89">
                                                <div class="form-group">
                                                    <label for="approvalReason" class="form-label">Reason for
                                                        Approval</label>
                                                    <textarea class="form-control" name="reason" id="approvalReason"
                                                        rows="3" placeholder="Type the reason here..."></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Complaint Details Modal -->
                            <div class="modal fade" id="complaintDetailsModal" tabindex="-1" role="dialog"
                                aria-labelledby="complaintDetailsModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content"
                                        style="border-radius: 8px; box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15); background-color: #f9f9f9;">

                                        <!-- Modal Header -->
                                        <div class="modal-header"
                                            style="background-color: #007bff; color: white; border-radius: 8px 8px 0 0; padding: 15px;">
                                            <h5 class="modal-title" id="complaintDetailsModalLabel"
                                                style="font-weight: 700; font-size: 1.4em; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                                📋 Complaint Details
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                                style="color: white; font-size: 1.2em;">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body"
                                            style="padding: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

                                            <!-- Complaint Info Section arranged in two-column layout -->
                                            <div class="row">
                                                <!-- Left Column -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">Complaint
                                                            ID</label>
                                                        <div class="text-muted"><b id="id"></b></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">Infra
                                                            Name</label>
                                                        <div class="text-muted"><b id="faculty_name"></b></div>
                                                    </div>
                                                </div>

                                                <!-- Right Column -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">Mobile
                                                            Number</label>
                                                        <div class="text-muted"><b id="faculty_contact"></b></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">E-mail</label>
                                                        <div class="text-muted"><b id="faculty_mail"></b></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold"
                                                            style="color: #007bff;">Faculty_name</label>
                                                        <div class="text-muted"><b id="fac_name"></b></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold"
                                                            style="color: #007bff;">Faculty_ID</label>
                                                        <div class="text-muted"><b id="fac_id"></b></div>
                                                    </div>
                                                </div>

                                                <!-- New row for Venue and Type of Problem -->
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">Venue
                                                            Name</label>
                                                        <div class="text-muted"><b id="venue_name"></b></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">Type of
                                                            Problem</label>
                                                        <div class="text-muted"><b id="type_of_problem"></b></div>
                                                    </div>
                                                </div>

                                                <!-- Full width for Problem Description -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="fw-bold" style="color: #007bff;">Problem
                                                            Description</label>
                                                        <div class="alert alert-light" role="alert"
                                                            style="border-radius: 6px; background-color: #f1f1f1; padding: 15px; color: #333;">
                                                            <span id="problem_description"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Modal Footer with Save Button -->
                                        <div class="modal-footer"
                                            style="background-color: #f1f1f1; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px; padding: 10px;">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Before Image Modal -->
                            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog"
                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel">Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img id="modalImage" src="" alt="Image" class="img-fluid"
                                                style="width: 100%; height: auto;">
                                            <!-- src will be set dynamically -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Principal Question Modal -->
                            <div class="modal fade" id="principalQueryModal" tabindex="-1" role="dialog"
                                aria-labelledby="principalQueryLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="principalQueryLabel">Principal's Query
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Question from comment_query -->
                                            <p id="commentQueryText"></p>
                                            <!-- Input for reply -->
                                            <div class="form-group">
                                                <label for="commentReply">Your Reply</label>
                                                <input type="text" class="form-control" id="commentReply"
                                                    placeholder="Enter your reply">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="submitReply">Submit
                                                Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- After Image Modal -->
                            <div class="modal fade" id="afterImageModal" tabindex="-1" role="dialog"
                                aria-labelledby="afterImageModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="afterImageModalLabel">After Picture</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img id="modalImage2" src="" alt="After" class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Faculty Feedback Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Faculty Feedback</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Rating: </h5>
                                            <div class="stars" id="star-rating1">
                                                <span data-value="1">&#9733;</span>
                                                <span data-value="2">&#9733;</span>
                                                <span data-value="3">&#9733;</span>
                                                <span data-value="4">&#9733;</span>
                                                <span data-value="5">&#9733;</span> <br>
                                            </div>
                                            <h5>Feedback: </h5>
                                            <textarea name="ffeed" id="ffeed" readonly
                                                style="width: 100%; height: 150px;"></textarea>
                                            <!-- Change to complaintfeed_id -->
                                            <input type="hidden" id="complaintfeed_id" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal"
                                                data-toggle="modal" data-target="#DoneModal">Done</button>
                                            <button type="button" class="btn btn-danger reass">Reassign</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Manager Feedback Modal for complete work-->
                            <div class="modal fade" id="DoneModal" tabindex="-1" aria-labelledby="DoneModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="principalModalLabel">Need Approval</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="manager_feedback">
                                                <div class="stars" id="star-rating">
                                                    <h5>Give Rating:</h5>
                                                    <span data-value="1">&#9733;</span>
                                                    <span data-value="2">&#9733;</span>
                                                    <span data-value="3">&#9733;</span>
                                                    <span data-value="4">&#9733;</span>
                                                    <span data-value="5">&#9733;</span>
                                                </div>
                                                <p id="rating-value">Rating: <span id="ratevalue">0</span></p>

                                                <div class="mb-3">
                                                    <label for="feedback" class="form-label">Feedback</label>
                                                    <textarea name="feedback12" id="mfeedback" class="form-control"
                                                        placeholder="Enter Feedback" style="width: 100%; height: 150px;"
                                                        require></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reassign deadline Modal -->
                            <div class="modal fade" id="datePickerModal" tabindex="-1" role="dialog"
                                aria-labelledby="datePickerModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="datePickerModalLabel">Set Reassign Deadline</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="reassign_deadline">Reassign Deadline Date:</label>
                                            <input type="date" id="reassign_deadline" name="reassign_deadline" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="saveDeadline">Set
                                                Deadline</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Principal Reject Reason Modal -->
                            <div class="modal fade" id="princerejectres" tabindex="-1" role="dialog"
                                aria-labelledby="princerejectresLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="princerejectresLabel">Rejected reason</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="feedback" id="feedback" readonly></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Worker detail Modal -->
                            <div class="modal fade" id="workerdetailmodal" tabindex="-1" role="dialog"
                                aria-labelledby="workerdetailmodalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="workerdetailmodalLabel">Worker Mobile Number
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between align-items-center p-3"
                                                style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                                                <div>
                                                    <span id="worker_mobile" class="font-weight-bold"
                                                        style="font-size: 1.25rem; color: #555;">9629613708</span>
                                                </div>
                                                <div>
                                                    <a href="#" id="callWorkerBtn" class="btn btn-success"
                                                        style="padding: 8px 16px; font-size: 0.9rem; border-radius: 25px;">Call
                                                        Worker</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--extend_deadline date Modal -->
                            <div class="modal fade" id="extend_date" tabindex="-1" role="dialog"
                                aria-labelledby="extend_dateLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="extend_dateLabel">Dead-line extend</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="extenddead">
                                                <input type="hidden" name="id" id="deadline_id">
                                                <label for="extend_deadline">Extend Deadline Date:</label>
                                                <input type="date" id="extend_deadline" name="extend_deadline" required>
                                                <br> <br>
                                                <label for="extendReason" class="form-label">Reason for
                                                    Extend:</label>
                                                <textarea class="form-control" name="reason" id="extendReason" rows="3"
                                                    placeholder="Type the reason here..."></textarea>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Set Deadline</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>


                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="footer text-center">
                    <b>2024 © M.Kumarasamy College of Engineering All Rights Reserved.<br>
                        Developed and Maintained by Technology Innovation Hub.
                    </b>
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- All Jquery -->
            <!-- ============================================================== -->
            <!-- jQuery -->
            <script src="assets/libs/jquery/dist/jquery.min.js"></script>

            <!-- Datatables -->
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous">
            </script>

            <!-- Perfect Scrollbar -->
            <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

            <!-- Bootstrap tether Core JavaScript -->
            <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
            <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

            <!-- Other Scripts -->
            <script src="assets/extra-libs/sparkline/sparkline.js"></script>
            <script src="dist/js/waves.js"></script>
            <script src="dist/js/sidebarmenu.js"></script>
            <script src="dist/js/custom.min.js"></script>

            <!-- Popper.js for Bootstrap 4 -->
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>

            <!-- JavaScript Sweetalert-->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <!-- JavaScript Alertify-->
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

            <!--Download as XL-Sheet-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>



            <script>
                //Tool Tip
                $(function() {
                    // Initialize the tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // You can also set options manually if needed
                    $('.rejectcomplaint').tooltip({
                        placement: 'top',
                        title: 'Reject'
                    });
                });

                $(function() {
                    // Initialize the tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // You can also set options manually if needed
                    $('.managerapprove').tooltip({
                        placement: 'top',
                        title: 'Accept'
                    });
                });

                $(function() {
                    // Initialize the tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // You can also set options manually if needed
                    $('.principalcomplaint').tooltip({
                        placement: 'top',
                        title: 'Principal Approval'
                    });
                });

                $(function() {
                    // Initialize the tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // You can also set options manually if needed
                    $('.showImage').tooltip({
                        placement: 'top',
                        title: 'Before'
                    });
                });

                $(function() {
                    // Initialize the tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // You can also set options manually if needed
                    $('.imgafter').tooltip({
                        placement: 'top',
                        title: 'After'
                    });
                });

                $(function() {
                    // Initialize the tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // You can also set options manually if needed
                    $('.viewcomplaint').tooltip({
                        placement: 'top',
                        title: 'View Complaint'
                    });
                });


                $(document).ready(function() {
                    $("#principal_table").DataTable();
                });
                $(document).ready(function() {
                    $("#complain_table").DataTable();
                });
                $(document).ready(function() {
                    $("#worker_table").DataTable();
                });
                $(document).ready(function() {
                    $("#finished_table").DataTable();
                });
                $(document).ready(function() {
                    $("#reassigned_table").DataTable();
                });
                $(document).ready(function() {
                    $("#completed_table").DataTable();
                });
                $(document).ready(function() {
                    $("#record_table").DataTable();
                });
                $(document).ready(function() {
                    $("#Rworkers").DataTable();
                });
                $(document).ready(function() {
                    $("#user_display").DataTable({
                        pageLength: 5,
                    });
                });
                $(document).ready(function() {
                    $("#worker_display").DataTable({
                        pageLength: 5,
                    });
                });
            </script>
            <script>
                //reject complaint
                $(document).on("click", "#rejectbutton", function(e) {
                    e.preventDefault();
                    var user_id = $(this).val(); // Get the ID from the button's value
                    console.log("User ID:", user_id);
                    // Set the user_id in the hidden input field within the form
                    $("#complaint_id99").val(user_id);
                });
                $(document).on("submit", "#rejectForm", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=reject_complaint',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {

                                confirm("Are you sure? you want to reject it!!");
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.error('Rejected');
                                // Close modal
                                $("#navref1").load(location.href + " #navref1");
                                $("#navref2").load(location.href + " #navref2");



                                $("#rejectModal").modal("hide");

                                // Reset the form
                                $("#rejectForm")[0].reset();
                                // Force refresh the table body with cache bypass

                                // Before loading new content, destroy the existing DataTable instance
                                $('#complain_table').DataTable().destroy();

                                $("#complain_table").load(location.href + " #complain_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#complain_table').DataTable();
                                    });

                                // Display success message
                            } else if (res.status == 500) {
                                $("#rejectModal").modal("hide");
                                $("#rejectForm")[0].reset();
                                alert("Something went wrong. Please try again.");
                            }
                        },
                        error: function(xhr, status, error) {
                            alert("An error occurred while processing your request.");
                        },
                    });
                });


                //pass worker department tp approve model
                //approve by manager
                $(document).on("click", ".managerapprove", function(e) {
                    e.preventDefault();
                    var user_id = $(this).val(); // Get the ID from the button's value
                    console.log("User ID:", user_id);
                    // pass id to model - form
                    $("#complaint_id56").val(user_id);

                    // Reset the worker selection in modal for next selection
                    $("#worker_id").val('');
                    $("#assignedWorker").text('Assigned Worker: ');
                });

                $(document).on('click', ".worker", function(e) {
                    e.preventDefault();
                    var worker = $(this).data('value');

                    console.log(worker);

                    //pass values to model
                    $("#worker_id").val(worker);
                    $("#assignedWorker").text("Assigned Worker: " + worker);
                })

                //reassign for manager
                $(document).on("click", ".reassign", function(e) {
                    e.preventDefault();
                    var user_id = $(this).val(); // Get the ID from the button's value
                    console.log("User ID:", user_id);

                    $(document).data("user_id2", user_id);

                });

                $(document).on('click', ".reass1", function(e) {
                    e.preventDefault();
                    var worker = $(this).data('value');
                    var user_id = $(document).data("user_id2");

                    console.log(worker);
                    console.log("User ID:", user_id);

                    $.ajax({
                        url: 'cms_backend.php?action=reassign_complaint',
                        type: "POST",
                        data: {
                            user_id: user_id,
                            worker: worker,
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 200) {
                                swal({
                                    title: "success!",
                                    text: "Complaint accepted sucessfully!",
                                    icon: "success",
                                    button: "Ok",
                                    timer: null
                                });

                                $("#managerapproveModal").modal("hide");

                                // Reset the form
                                $("#managerapproveForm")[0].reset();


                                $('#complain_table').DataTable().destroy();
                                $('#principal_table').DataTable().destroy();

                                $("#complain_table").load(location.href + " #complain_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#complain_table').DataTable();
                                    });
                                $("#principal_table").load(location.href + " #principal_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#principal_table').DataTable();
                                    });
                                $("#navref1").load(location.href + " #navref1");
                                $("#navref2").load(location.href + " #navref2");



                            } else {
                                alert("Failed to accept complaint");
                            }
                        },
                    });


                });

                $(document).on("submit", "#managerapproveForm", function(e) {
                    e.preventDefault();
                    var data = new FormData(this);
                    console.log(data);

                    $.ajax({
                        url: 'cms_backend.php?action=manager_approve',
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 200) {
                                swal({
                                    title: "success!",
                                    text: "Complaint accepted sucessfully!",
                                    icon: "success",
                                    button: "Ok",
                                    timer: null
                                });

                                $("#managerapproveModal").modal("hide");

                                // Reset the form
                                $("#managerapproveForm")[0].reset();


                                $('#complain_table').DataTable().destroy();
                                $('#principal_table').DataTable().destroy();

                                $("#complain_table").load(location.href + " #complain_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#complain_table').DataTable();
                                    });
                                $("#principal_table").load(location.href + " #principal_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#principal_table').DataTable();
                                    });
                                $("#navref1").load(location.href + " #navref1");
                                $("#navref2").load(location.href + " #navref2");



                            } else {
                                alert("Failed to accept complaint");
                            }
                        },
                    });
                });


                //Principal approval
                $(document).on("click", "#principalbutton", function(e) {
                    e.preventDefault();
                    var user_id = $(this).val(); // Get the ID from the button's value
                    console.log("User ID:", user_id);
                    // Set the user_id in the hidden input field within the form
                    $("#complaint_id89").val(user_id);
                });
                $(document).on("submit", "#principal_Form", function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=principal_complaint',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {

                                swal({
                                    title: "success!",
                                    text: "Complaint sent to Principal sucessfully!",
                                    icon: "success",
                                    button: "Ok",
                                    timer: null
                                });
                                // Close modal
                                $("#principalModal").modal("hide");

                                // Reset the form
                                $("#principal_Form")[0].reset();
                                // Force refresh the table body with cache bypass
                                $('#complain_table').DataTable().destroy();
                                $("#complain_table").load(location.href + " #complain_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#complain_table').DataTable();
                                    });
                                $("#navref1").load(location.href + " #navref1");
                                $("#navref2").load(location.href + " #navref2");



                                // Display success message
                            } else if (res.status == 500) {
                                $("#principalModal").modal("hide");
                                $("#principal_Form")[0].reset();
                                alert("Something went wrong. Please try again.");
                            }
                        },
                        error: function(xhr, status, error) {
                            alert("An error occurred while processing your request.");
                        },
                    });
                });


                //jquerry for view complaint
                $(document).on("click", ".viewcomplaint", function(e) {
                    e.preventDefault();
                    var user_id = $(this).val();
                    var fac_id = $(".viewcomplaint").data("value");
                    console.log(user_id);
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=view_complaint',
                        data: {
                            user_id: user_id,
                            fac_id: fac_id,
                        },
                        success: function(response) {

                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 404) {
                                alert(res.message);
                            } else {
                                //$('#student_id2').val(res.data.uid);
                                $("#id").text(res.data.id);
                                $("#type_of_problem").text(res.data.type_of_problem);
                                $("#problem_description").text(res.data.problem_description);
                                $("#faculty_name").text(res.data.faculty_name);
                                $("#faculty_mail").text(res.data.faculty_mail);
                                $("#faculty_contact").text(res.data.faculty_contact);
                                $("#block_venue").text(res.data.block_venue);
                                $("#venue_name").text(res.data.venue_name);
                                if (res.data1) {


                                    $("#fac_name").text(res.data1.name);
                                    $("#fac_id").text(res.data1.id);
                                } else {
                                    $("#fac_name").text("N/A");
                                    $("#fac_id").text("N/A");

                                }
                                $("#complaintDetailsModal").modal("show");
                            }
                        },
                    });
                });

                //Before image
                $(document).on("click", ".showImage", function() {
                    var problem_id = $(this).val(); // Get the problem_id from button value
                    console.log(problem_id); // Ensure this logs correctly
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=get_image',
                        data: {
                            problem_id: problem_id, // Correct POST key
                        },
                        dataType: "json", // Automatically parses JSON responses
                        success: function(response) {
                            console.log(response); // Log the parsed JSON response
                            if (response.status == 200) {
                                // Dynamically set the image source
                                $("#modalImage").attr("src", "uploads/" + response.data.images);
                                // Show the modal
                                $("#imageModal").modal("show");
                            } else {
                                // Handle case where no image is found
                                alert(
                                    response.message ||
                                    "An error occurred while retrieving the image."
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            // Log the full error details for debugging
                            console.error("AJAX Error: ", xhr.responseText);
                            alert(
                                "An error occurred: " +
                                error +
                                "\nStatus: " +
                                status +
                                "\nDetails: " +
                                xhr.responseText
                            );
                        },
                    });
                });

                //principal question 
                $(document).ready(function() {
                    // When the button is clicked, populate the modal with the query
                    $(".openQueryModal").on("click", function() {
                        // Check if the button is disabled
                        if ($(this).is(':disabled')) {
                            return; // Do nothing if the button is disabled
                        }

                        var commentQuery = $(this).data("comment-query");
                        var taskId = $(this).data("task-id");
                        // Set the comment query text in the modal
                        $("#commentQueryText").text(commentQuery);
                        // Store the task_id for later use when submitting the answer
                        $("#submitReply").data("task-id", taskId);
                    });

                    // Handle form submission when 'Submit Reply' is clicked
                    $("#submitReply").on("click", function() {
                        var taskId = $(this).data("task-id");
                        var commentReply = $("#commentReply").val();

                        // AJAX request to send the reply to the backend
                        $.ajax({
                            url: 'cms_backend.php?action=submit_comment_reply', // Your backend file
                            type: "POST",
                            data: {
                                task_id: taskId,
                                comment_reply: commentReply,
                            },
                            success: function(response) {
                                var res = jQuery.parseJSON(response);
                                if (res.status == 200) {
                                    alert(res.message);
                                    $("#principalQueryModal").modal("hide");
                                    // Reload the table to reflect changes
                                    $("#worker_table").load(location.href + " #worker_table");
                                } else {
                                    alert("Something went wrong. Please try again.");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error:", error);
                                alert("Something went wrong. Please try again.");
                            },
                        });
                    });
                });

                //verify once again


                $(document).on("click", ".facfeed", function(e) {
                    e.preventDefault();
                    var user_id = $(this).val();
                    console.log(user_id);
                    $(document).data("feedid", user_id);
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=facfeedview',
                        data: {
                            user_id: user_id,
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 500) {
                                alert(res.message);
                            } else {
                                //$('#student_id2').val(res.data.uid);
                                $("#ffeed").val(res.data.feedback)
                                $("#exampleModal").modal("show");

                                var nu = res.data.rating;
                                console.log(nu);

                                if (!isNaN(nu) && nu > 0) {
                                    const stars1 = document.querySelectorAll("#star-rating1 span");

                                    stars1.forEach(s => s.classList.remove("highlighted"));

                                    for (let i = 0; i < nu; i++) {
                                        stars1[i].classList.add("highlighted");
                                    }
                                }
                            }
                        },
                    });
                });

                $(document).ready(function() {
                    var complaintfeedId = null; // Store complaintfeed_id globally

                    // Open the feedback modal and set the complaintfeed ID (Event Delegation)
                    $(document).on("click", ".facfeed", function() {
                        var complaintfeedId = $(this).val();
                        $("#complaintfeed_id").val(complaintfeedId)

                        // Send the rating ID to the PHP script via AJAX

                    });

                    // When 'Reassign' is clicked (Event Delegation)
                    $(document).on("click", ".reass", function() {
                        $("#datePickerModal").modal("show"); // Show the modal to select deadline
                    });

                    // When 'Set Deadline' is clicked in the date picker modal
                    $(document).on("click", "#saveDeadline", function() {
                        var reassign_deadline = $("#reassign_deadline").val(); // Get the selected deadline

                        if (!reassign_deadline) {
                            alert("Please select a deadline date.");
                            return;
                        }

                        var complaintfeedId = $("#complaintfeed_id").val();
                        updateComplaintStatus(complaintfeedId, 15,
                            reassign_deadline); // Status '15' for Reassign with deadline
                        swal({
                            title: "success!",
                            text: "Reassigned sucessfully!",
                            icon: "success",
                            button: "Ok",
                            timer: null
                        });
                        $("#datePickerModal").modal("hide"); // Close the date picker modal
                        $("#exampleModal").modal("hide"); // Close the feedback modal

                        $('#finished_table').DataTable().destroy();
                        $('#reassigned_table').DataTable().destroy();

                        $("#finished_table").load(location.href + " #finished_table > *", function() {
                            // Reinitialize the DataTable after the content is loaded
                            $('#finished_table').DataTable();
                        });
                        $("#reassigned_table").load(location.href + " #reassigned_table > *", function() {
                            // Reinitialize the DataTable after the content is loaded
                            $('#reassigned_table').DataTable();
                        });
                        $("#navref3").load(location.href + " #navref3");
                        $("#navref4").load(location.href + " #navref4");
                        $("#navref5").load(location.href + " #navref5");
                    });

                    // Function to update the complaint status
                    function updateComplaintStatus(complaintfeedId, status, reassign_deadline = null) {
                        $.ajax({
                            type: "POST",
                            url: 'cms_backend.php?action=reassign_work',
                            data: {
                                complaintfeed_id: complaintfeedId,
                                status: status,
                                reassign_deadline: reassign_deadline, // Only pass this when we give 'reassign'
                            },
                            success: function(response) {
                                var res = jQuery.parseJSON(response);
                                if (res.status == 500) {
                                    alert(res.message);
                                }
                            },
                            error: function() {
                                alert("An error occurred while updating the status.");
                            }
                        });
                    }
                });


                //Reject Reason from principal
                $(document).on("click", ".rejectreasonbtn", function(e) {
                    e.preventDefault();
                    var id12 = $(this).val();
                    console.log(id12);
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=get_reject_reason',
                        data: {
                            problem_id: id12,
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 500) {
                                alert(res.message);
                            } else {
                                $("#feedback").text(res.data.feedback);
                            }
                        },
                    });
                });


                //after image
                $(document).on("click", ".imgafter", function() {
                    var problem_id = $(this).val(); // Get the problem_id from button value
                    console.log(problem_id); // Ensure this logs correctly
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=get_aimage',
                        data: {
                            problem2_id: problem_id, // Correct POST key
                        },
                        dataType: "json", // Automatically parses JSON responses
                        success: function(response) {
                            console.log(response); // Log the parsed JSON response
                            if (response.status == 200) { // Use 'response' instead of 'res'
                                // Dynamically set the image source
                                $("#modalImage2").attr("src", response.data.after_photo);
                                // Show the modal
                                $("#afterImageModal").modal("show");
                            } else {
                                // Handle case where no image is found
                                alert(response.message ||
                                    "An error occurred while retrieving the image.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: ", status, error);
                        }
                    });
                });
                $('#afterImageModal').on('hidden.bs.modal', function() {
                    // Reset the image source to a default or blank placeholder
                    $("#modalImage2").attr("src", "path/to/placeholder_image.jpg");
                });

                //to download as xlsheet record table
                document.getElementById('download').addEventListener('click', function() {
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.table_to_sheet(document.getElementById('record_table'));
                    XLSX.utils.book_append_sheet(wb, ws, "Complaints Data");

                    // Create and trigger the download
                    XLSX.writeFile(wb, 'complaints_data.xlsx');
                });

                //to download as xlsheet workers record table
                document.getElementById('download1').addEventListener('click', function() {
                    var we = XLSX.utils.book_new();
                    var wg = XLSX.utils.table_to_sheet(document.getElementById('Rworkers'));
                    XLSX.utils.book_append_sheet(we, wg, "Workers Data");

                    // Create and trigger the download
                    XLSX.writeFile(we, 'workers_data.xlsx');
                });


                //exctend deadline
                $(document).on("click", ".deadline_extend", function(e) {
                    e.preventDefault();
                    var user = $(this).val();
                    console.log(user);
                    $("#deadline_id").val(user);
                });
                $(document).on("submit", "#extenddead", function(e) {
                    e.preventDefault();
                    console.log("Haii!!");
                    var data = new FormData(this);
                    console.log(data);

                    $.ajax({
                        url: 'cms_backend.php?action=extend_deadlinedate',
                        type: "POST",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 200) {
                                swal({
                                    title: "success!",
                                    text: "Complaint accepted sucessfully!",
                                    icon: "success",
                                    button: "Ok",
                                    timer: null
                                });
                                $("#extend_date").modal("hide");
                                $("#extenddead")[0].reset();
                                $('#worker_table').DataTable().destroy();
                                $("#worker_table").load(location.href + " #worker_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#worker_table').DataTable();
                                    });
                            }
                        }
                    })
                })

                //Add worker
                $(document).on("submit", "#workers", function(e) {
                    e.preventDefault();
                    var dt = new FormData(this);
                    console.log(dt);

                    $.ajax({
                        url: 'cms_backend.php?action=addworker',
                        type: "POST",
                        data: dt,
                        processData: false,
                        contentType: false,
                        success: function(response) {

                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('User Added');
                                $("#addworker").modal("hide");
                                $('#workers')[0].reset();
                                $('#worker_display').DataTable().destroy();
                                $("#worker_display").load(location.href + " #worker_display > *",
                                    function() {
                                        $('#worker_display').DataTable({
                                            pageLength: 5
                                        });
                                    });



                            } else {
                                alert("Error");
                            }
                        },
                        error: function(xhr, status, error) {
                            alert("An error occurred: " + error);
                        }
                    });
                })

                $(document).on("submit", "#manager_feedback", function(e) {
                    e.preventDefault();
                    var fd = new FormData(this);
                    console.log(fd);

                    var store_rating = $(document).data("ratings");
                    console.log(store_rating);
                    fd.append("ratings", store_rating);
                    var manfeed = $(document).data("feedid")
                    console.log(manfeed);
                    fd.append("id", manfeed);

                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=manager_feedbacks',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {
                                swal({
                                    title: "success!",
                                    text: "Completed sucessfully!",
                                    icon: "success",
                                    button: "Ok",
                                    timer: null
                                });

                                $("#DoneModal").modal("hide");

                                // Reset the form
                                $("#manager_feedback")[0].reset();
                                $('#finished_table').DataTable().destroy();
                                $('#completed_table').DataTable().destroy();
                                $('#record_table').DataTable().destroy();
                                $('#completed_table').DataTable().destroy();

                                $("#finished_table").load(location.href + " #finished_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#finished_table').DataTable();
                                    });
                                $("#completed_table").load(location.href + " #completed_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#completed_table').DataTable();
                                    });
                                $("#record_table").load(location.href + " #record_table > *",
                                    function() {
                                        // Reinitialize the DataTable after the content is loaded
                                        $('#record_table').DataTable();
                                    });
                                $("#Rworkers").load(location.href + " #Rworkers > *", function() {
                                    // Reinitialize the DataTable after the content is loaded
                                    $('#Rworkers').DataTable();
                                });
                                $("#navref3").load(location.href + " #navref3");
                                $("#navref4").load(location.href + " #navref4");
                                $("#navref5").load(location.href + " #navref5");



                                // Display success message
                            } else if (res.status == 500) {
                                $("#DoneModal").modal("hide");
                                $("#manager_feedback")[0].reset();
                                alert(res.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert("An error occurred while processing your request.");
                        },
                    });
                });
            </script>

            <script>
                // Get today's date in the format 'YYYY-MM-DD'
                var today = new Date().toISOString().split('T')[0];

                // Get the date input element
                var dateInput = document.getElementById('deadline01');

                // Set the minimum and maximum date for the input field to today's date
                dateInput.setAttribute('min', today);
            </script>

            <script>
                // Get today's date in the format 'YYYY-MM-DD'
                var today = new Date().toISOString().split('T')[0];

                // Get the date input element
                var dateInput = document.getElementById('reassign_deadline');

                // Set the minimum and maximum date for the input field to today's date
                dateInput.setAttribute('min', today);
            </script>

            <script>
                // Get today's date in the format 'YYYY-MM-DD'
                var today = new Date().toISOString().split('T')[0];

                // Get the date input element
                var dateInput = document.getElementById('extend_deadline');

                // Set the minimum and maximum date for the input field to today's date
                dateInput.setAttribute('min', today);
            </script>

            <script>
                //Star Rating Coding
                const stars = document.querySelectorAll("#star-rating span");
                const ratingValue = document.getElementById("rating-value");
                const ratevalue = document.getElementById("ratevalue");



                stars.forEach((star, index) => {
                    star.addEventListener("click", () => {
                        // Remove the "highlighted" class from all stars hidhlited is used in Style
                        stars.forEach(s => s.classList.remove("highlighted"));

                        // Add the "highlighted" class to all stars up to the clicked one
                        for (let i = 0; i <= index; i++) {
                            stars[i].classList.add("highlighted");
                        }

                        // Update the rating value
                        ratingValue.textContent = `Rating: ${index + 1}`;
                        ratevalue.textContent = `${index + 1}`;
                        var rating = ratevalue.textContent;
                        $(document).data("ratings", rating);
                    });
                });




                //delete user
                $(document).on("click", ".deleteuser", function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    console.log(id);
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=delete_user',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 200) {

                                alertify.set('notifier', 'position', 'top-right');
                                alertify.error('deleted');
                                $('#user_display').DataTable().destroy();

                                $("#user_display").load(location.href + " #user_display > *",
                                    function() {
                                        $('#user_display').DataTable({
                                            pageLength: 5
                                        });
                                    });

                            }
                        },
                    });

                });

                //delete worker
                $(document).on("click", ".deleteworker", function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    console.log(id);
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=delete_worker',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(res);
                            if (res.status == 200) {

                                alertify.set('notifier', 'position', 'top-right');
                                alertify.error('Deleted');
                                $('#worker_display').DataTable().destroy();
                                $("#worker_display").load(location.href + " #worker_display > *",
                                    function() {
                                        $('#worker_display').DataTable({
                                            pageLength: 5
                                        });
                                    });

                            }
                        },
                    });

                });



                $(document).on("submit", "#user_data", function(e) {
                    e.preventDefault();
                    var form = new FormData(this);
                    form.append("add_user", true);
                    console.log(form);
                    $.ajax({
                        type: "POST",
                        url: 'cms_backend.php?action=add_user',
                        data: form,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {
                                alertify.set('notifier', 'position', 'top-right');
                                alertify.success('User Added');

                                $("#adduser").modal("hide");
                                $("#user_data")[0].reset();
                                $('#user_display').DataTable().destroy();
                                $("#user_display").load(location.href + " #user_display > *",
                                    function() {
                                        $('#user_display').DataTable({
                                            pageLength: 5
                                        });
                                    });
                            } else {
                                swal({
                                    title: "Warning!",
                                    text: "Invalid user Id!",
                                    icon: "warning",
                                    button: "Ok",
                                    timer: null
                                });
                            }
                        }
                    })
                })



                $(document).on("click", ".partially", function(e) {
                    e.preventDefault();
                    var id = $(this).val();
                    console.log(id);

                    $.ajax({
                        type: "POST",
                        url: "cms_backend.php?action=partially_reason",
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            console.log(response);
                            if (res.status == 404) {
                                alert("something went wrong!!");
                            } else {
                                $("#partiallyReason").text(res.data.reason);
                                $("#partially_reason").modal("show");
                            }
                        }
                    })
                });

                $(document).on("click", ".fetchdept", function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "manager.php",
                        data: {
                            "fdept": true,

                        },
                        success: function(response) {
                            $('#department').html(response);

                        }
                    })
                });

                $(document).on("submit", "#date-form", function(e) {
                    e.preventDefault();
                    var form = new FormData(this);


                    $.ajax({
                        type: "POST",
                        url: "cms_backend.php?action=dateapply",
                        data: form,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            var res = jQuery.parseJSON(response);

                            if (res.status == 200) {
                                console.log("Date applied");

                                // Clear the existing table rows
                                $("#Rworkers tbody").empty();

                                // Add new rows dynamically
                                res.data.forEach((row, index) => {
                                    var avgFacultyRating = row.avg_faculty_rating !== "N/A" ? row.avg_faculty_rating : "N/A";
                                    var avgManagerRating = row.avg_manager_rating !== "N/A" ? row.avg_manager_rating : "N/A";
                                    var avgRating = row.avg_rating !== "N/A" ? row.avg_rating : "N/A";

                                    $("#Rworkers tbody").append(`
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${row.worker_id}</td>
                            <td class="text-center">${row.worker_first_name}</td>
                            <td class="text-center">${row.worker_dept}</td>
                            <td class="text-center">${row.total_completed_works}</td>
                            <td class="text-center">${avgFacultyRating}</td>
                            <td class="text-center">${avgManagerRating}</td>
                            <td class="text-center">${avgRating}</td>
                        </tr>
                    `);
                                });
                            } else {
                                console.log("Error: " + res.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                        },
                    });
                });

                $(document).on("submit", "#date-filter-form", function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "cms_backend.php?action=workrecord",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 200) {
                                console.log("Data fetched successfully!");

                                // Clear the existing table rows
                                $("#record_table tbody").empty();

                                // Dynamically populate the table with new data
                                var data = res.data;
                                data.forEach((row, index) => {
                                    var avgRating = row.average_rating !== "N/A" ? row.average_rating : "N/A";
                                    $("#record_table tbody").append(`
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${row.id}</td>
                            <td class="text-center">Venue: ${row.block_venue} | <br>Problem: ${row.problem_description}</td>
                            <td class="text-center">Completed by: ${row.completed_by} | <br>Department: ${row.department}</td>
                            <td class="text-center">${row.itemno}</td>
                            <td class="text-center">${row.amount_spent}</td>
                            <td class="text-center">${row.feedback}<br>Ratings: ${row.rating}</td>
                            <td class="text-center">${row.mfeedback}<br>Ratings: ${row.mrating}</td>
                            <td class="text-center">${row.date_of_completion}</td>
                            <td class="text-center">${avgRating}</td>
                        </tr>
                    `);
                                });
                            } else {
                                console.log("Error fetching data: ", res.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", error);
                        },
                    });
                });
            </script>


</body>