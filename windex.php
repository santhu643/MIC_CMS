<?php
require "config.php";
include("session.php");
$worker_id = $s;

// fetching worker details using department in session
$qry = "SELECT * FROM worker_details WHERE worker_id='$worker_id'";
$qry_run = mysqli_query($db, $qry);
$srow  = mysqli_fetch_array($qry_run);
$dept = $srow['worker_dept'];


$qry = "SELECT * FROM worker_details WHERE worker_id='$worker_id'";
$qry_run = mysqli_query($db, $qry);
$row  = mysqli_fetch_array($qry_run);

//New task query
$sql = "
    SELECT 
        cd.id,
        cd.faculty_id,
        faculty_details.faculty_name,
        faculty_details.department,
        faculty_details.faculty_contact,
        faculty_details.faculty_mail,
        cd.block_venue,
        cd.venue_name,
        cd.type_of_problem,
        cd.problem_description,
        cd.images,
        cd.date_of_reg,
        cd.days_to_complete,
        cd.task_completion,
        cd.status,
        cd.feedback,
        m.task_id,
        m.priority
    FROM 
        complaints_detail AS cd
    JOIN 
        manager AS m ON cd.id = m.problem_id
    JOIN 
        faculty_details ON cd.faculty_id = faculty_details.faculty_id
    WHERE 
        (m.worker_dept='$dept')
    AND 
        cd.status = '9'
";

$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$newcount = mysqli_num_rows($result);


//inprogress query
$sql1 = "
    SELECT 
        cd.id,
        cd.faculty_id,
        faculty_details.faculty_name,
        faculty_details.department,
        faculty_details.faculty_contact,
        faculty_details.faculty_mail,
        cd.block_venue,
        cd.venue_name,
        cd.type_of_problem,
        cd.problem_description,
        cd.images,
        cd.date_of_reg,
        cd.days_to_complete,
        cd.task_completion,
        cd.status,
        cd.feedback,
        m.task_id,
        m.priority
    FROM 
        complaints_detail AS cd
    JOIN 
        manager AS m ON cd.id = m.problem_id
    JOIN 
        faculty_details ON cd.faculty_id = faculty_details.faculty_id
    WHERE 
        (m.worker_dept='$dept')
    AND 
        cd.status = '10'
";

$stmt = $db->prepare($sql1);
$stmt->execute();
$result1 = $stmt->get_result();
$progcount = mysqli_num_rows($result1);


//waiting for approval query
$sql2 = "
    SELECT 
        cd.id,
        cd.faculty_id,
        faculty_details.faculty_name,
        faculty_details.department,
        faculty_details.faculty_contact,
        faculty_details.faculty_mail,
        cd.block_venue,
        cd.venue_name,
        cd.type_of_problem,
        cd.problem_description,
        cd.images,
        cd.date_of_reg,
        cd.days_to_complete,
        cd.task_completion,
        cd.status,
        cd.reason,
        cd.feedback,
        m.task_id,
        m.priority
    FROM 
        complaints_detail AS cd
    JOIN 
        manager AS m ON cd.id = m.problem_id
    JOIN 
        faculty_details ON cd.faculty_id = faculty_details.faculty_id
    WHERE 
        (m.worker_dept='$dept')
    AND 
        (cd.status = '11' OR cd.status = '18')
";

$stmt = $db->prepare($sql2);
$stmt->execute();
$result2 = $stmt->get_result();
$waitcount = mysqli_num_rows($result2);


//completed query
$sql3 = "
    SELECT 
        cd.id,
        cd.faculty_id,
        faculty_details.faculty_name,
        faculty_details.department,
        faculty_details.faculty_contact,
        faculty_details.faculty_mail,
        cd.block_venue,
        cd.venue_name,
        cd.type_of_problem,
        cd.problem_description,
        cd.images,
        cd.date_of_reg,
        cd.days_to_complete,
        cd.task_completion,
        cd.date_of_completion,
        cd.status,
        cd.feedback,
        m.task_id,
        m.priority
    FROM 
        complaints_detail AS cd
    JOIN 
        manager AS m ON cd.id = m.problem_id
    JOIN 
        faculty_details ON cd.faculty_id = faculty_details.faculty_id
    WHERE 
        (m.worker_dept='$dept')
    AND 
        cd.status = '16'
";

$stmt = $db->prepare($sql3);
$stmt->execute();
$result3 = $stmt->get_result();
$compcount = mysqli_num_rows($result3);


//not approved query
$sql4 = "
    SELECT 
        cd.id,
        cd.faculty_id,
        faculty_details.faculty_name,
        faculty_details.department,
        faculty_details.faculty_contact,
        faculty_details.faculty_mail,
        cd.block_venue,
        cd.venue_name,
        cd.type_of_problem,
        cd.problem_description,
        cd.images,
        cd.date_of_reg,
        cd.days_to_complete,
        cd.task_completion,
        cd.date_of_completion,
        cd.status,
        cd.feedback,
        m.task_id,
        m.priority
    FROM 
        complaints_detail AS cd
    JOIN 
        manager AS m ON cd.id = m.problem_id
    JOIN 
        faculty_details ON cd.faculty_id = faculty_details.faculty_id
    WHERE 
        (m.worker_dept='$dept')
    AND 
        cd.status = '15'
";


$stmt = $db->prepare($sql4);
$stmt->execute();
$result4 = $stmt->get_result();
$notcount = mysqli_num_rows($result4);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/images/favicon.png">
    <title>MIC</title>
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="css/dboardstyles.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
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
                            <a class="dropdown-item" href="Logout"><i class="fa fa-power-off m-r-5 m-l-5"></i>
                            Logout</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar"><br>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="windex"
                                aria-expanded="false"><img src="images/icon/dash.png" class="custom-svg-icon"
                                    alt="Dashboard Icon"><span class="hide-menu">&nbsp;Dashboard</span></a></li>

                        <li class="sidebar-item"> <a id="view-work-task-history"
                                class="sidebar-link waves-effect waves-dark sidebar-link" href="new_work.php"
                                aria-expanded="false"><img src="images/icon/construction-worker.png" class="custom-svg-icon"
                                alt="Dashboard Icon"><span class="hide-menu">&nbsp Work
                                    Assign</span></a></li>

                        <li class="sidebar-item"> <a id="view-work-task-history"
                                class="sidebar-link waves-effect waves-dark sidebar-link" href="workall.php"
                                aria-expanded="false"><img src="images/icon/wrench.png" class="custom-svg-icon"
                                alt="Dashboard Icon"><span class="hide-menu">&nbsp <?php echo $row['worker_dept'] ?></span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="fas fa-user"></i></h1>
                                <h3 class="text-white"><b> Name <br></b></h3>
                                <h5 class="text-white" id="workerName"><?php echo $row['worker_first_name'] ?></h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                                <h3 class="text-white"><b>Worker Department<br></b></h3>
                                <h5 class="text-white" id="employmentType"><?php echo $row['worker_dept'] ?></h5>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-account-card-details"></i></h1>
                                <h3 class="text-white"><b>Designation<br></b></h3>
                                <h5 id="workerdepartment" class="text-white">Worker-Head</h5>


                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-0"></h4><br>
                        <div class="row">
                            <div class="col-12 col-md-3 mb-3">
                                <div class="cir">
                                    <div class="bo">
                                        <div class="content1">
                                            <div class="stats-box text-center p-3"
                                                style="background-color:rgb(252, 119, 71);">
                                                <i class="fas fa-bell m-b-5 font-20"></i>
                                                <h1 class="m-b-0 m-t-5"><?php echo $compcount ?></h1>
                                                <small class="font-light">Task Completed</small>
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
                                                <h1 class="m-b-0 m-t-5"><?php echo $newcount ?></h1>
                                                <small class="font-light">New Tasks</small>
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
                                                <h1 class="m-b-0 m-t-5"><?php echo $progcount; ?></h1>
                                                <small class="font-light">Task in progress</small>
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
                                                <h1 class="m-b-0 m-t-5"><?php echo $waitcount ?></h1>
                                                <small class="font-light">Tasks waiting for approval</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                <p><b>
                        2024 © M.Kumarasamy College of Engineering All Rights Reserved.<br>
                        Developed and Maintained by Technology Innovation Hub.
                    </b></p>
            </footer>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="dist/js/waves.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <script src="dist/js/custom.min.js"></script>
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>



</body>

</html>