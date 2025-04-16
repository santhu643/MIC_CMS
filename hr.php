<?php

include("config.php");
include("session.php");
include("hroffice.php");

// faculty name
$query = "SELECT name FROM ofaculty WHERE uname='$s'";
$query_run = mysqli_query($db, $query);
if (mysqli_num_rows($query_run) > 0) {
    $row = mysqli_fetch_assoc($query_run);
    $name = $row['name'];
}

//total faculty members
$query = "SELECT * FROM faculty";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $tf = mysqli_num_rows($query_run);
}


//total aids
$query = "SELECT * FROM faculty where dept='Artificial Intelligence and Data Science'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $aids = mysqli_num_rows($query_run);
}
//total aiml
$query = "SELECT * FROM faculty where dept='Artificial Intelligence and Machine Learning'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $aiml = mysqli_num_rows($query_run);
}

//total civil
$query = "SELECT * FROM faculty where dept='Civil Engineering'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $civil = mysqli_num_rows($query_run);
}

//total csbs
$query = "SELECT * FROM faculty where dept='Computer Science and Business Systems'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $csbs = mysqli_num_rows($query_run);
}

//total cse
$query = "SELECT * FROM faculty where dept='Computer Science and Engineering'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $cse = mysqli_num_rows($query_run);
}

//total eee
$query = "SELECT * FROM faculty where dept='Electrical and Electronics Engineering'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $eee = mysqli_num_rows($query_run);
}

//total ee(vlsi)
$query = "SELECT * FROM faculty where dept='Electronics Engineering (VLSI Design)'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $eev = mysqli_num_rows($query_run);
} else {
    $eev = 0;
}

//total ece
$query = "SELECT * FROM faculty where dept='Electronics and Communication Engineering'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $ece = mysqli_num_rows($query_run);
}

//total it
$query = "SELECT * FROM faculty where dept='Information Technology'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $it = mysqli_num_rows($query_run);
}
//total mech
$query = "SELECT * FROM faculty where dept='Mechanical Engineering'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $mech = mysqli_num_rows($query_run);
}
//total mba
$query = "SELECT * FROM faculty where dept='Master of Business Administration'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $mba = mysqli_num_rows($query_run);
}
//total mca
$query = "SELECT * FROM faculty where dept='Master of Computer Applications'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $mca = mysqli_num_rows($query_run);
}
//total sh
$query = "SELECT * FROM faculty where dept='Freshman Engineering'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $sh = mysqli_num_rows($query_run);
} else {
    $sh = 0;
}

//total male
$query = "SELECT * FROM basic where gender='Male'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $male = mysqli_num_rows($query_run);
}

//total female
$query = "SELECT * FROM basic where gender='Female'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) > 0) {
    $female = mysqli_num_rows($query_run);
}



?>


<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>MIC</title>
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
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
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="main">
                        <span class="logo-text">
                            <img src="assets/images/srms.png" alt="homepage" class="light-logo" />
                        </span>

                    </a>
  
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">

                                <a class="dropdown-item" href="Logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php include("Aside2.php"); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard (Welcome <?php echo $name; ?>)</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-6">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="fa fa-user"></i></h1>
                                <h4 class="text-white"><b>Total Faculty</b></h4>
                                <h4 class="text-white"><b><?php echo $tf; ?> </b></h4>


                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Artificial Intelligence and Data Science </b></h4>
                                <h4 class="text-white"><b><?php echo $aids; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Artificial Intelligence and Machine Learning</b></h4>
                                <h4 class="text-white"><b><?php echo $aiml; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Civil Engineering</b></h4>
                                <h4 class="text-white"><b><?php echo $civil; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Computer Science and Business Systems</b></h4>
                                <h4 class="text-white"><b><?php echo $csbs; ?></b></h4>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#00cc99;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Computer Science and Engineering</b></h4>
                                <h4 class="text-white"><b><?php echo $cse; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#cc00ff;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Electrical and Electronics Engineering</b></h4>
                                <h4 class="text-white"><b><?php echo $eee; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#4b3910;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Electronics Engineering (VLSI Design)</b></h4>
                                <h4 class="text-white"><b><?php echo $eev; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#669900;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Electronics and Communication Engineering</b></h4>
                                <h4 class="text-white"><b><?php echo $ece; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#cc3300;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Information Technology</b></h4>
                                <h4 class="text-white"><b><?php echo $it; ?></b></h4>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#ff6699;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Mechanical Engineering</b></h4>
                                <h4 class="text-white"><b><?php echo $mech; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#996633;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Master of Business Administration</b></h4>
                                <h4 class="text-white"><b><?php echo $mba; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#006666;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Master of Computer Applications</b></h4>
                                <h4 class="text-white"><b><?php echo $mca; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div style="background-color:#ff0066;" class=" box text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Freshman Engineering</b></h4>
                                <h4 class="text-white"><b><?php echo $sh; ?></b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-dark text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                <h4 class="text-white"><b>Gender Count</b></h4>
                                <h4 class="text-white"><b>Male : <?php echo $male; ?> | Female : <?php echo $female; ?> | Others : 0</b></h4>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php include "./footer.html" ?>
    </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
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