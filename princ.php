<?php

require 'config.php';
include("session.php");

	$query = "SELECT * FROM basic WHERE id='$s'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);
		$k=$student['photo'];
		$n=$student['fname'].' '.$student['lname'];
		$g=$student['gender'];
		$e=$student['email'];
		$d2=$student['dob'];
		$exp = explode('-', $d2);
		$newStr = trim($exp[2]) . ' - ' . trim($exp[1]). ' - ' . trim($exp[0]);
		$d= $newStr;
		$m=$student['mobile'];
		$a=$student['paddress'].','.$student['city'].'-'.$student['zip'];
	}

else{
$k=".\assets\images\images.jpg";
$n=" ";
$g=" ";
$e=" ";
$d=" ";
$m=" ";
$a=" ";
}

	$query = "SELECT * FROM research WHERE id='$s'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $research = mysqli_fetch_array($query_run);
		$oid=$research['oid'];
		$sid=$research['sid'];
		$rid=$research['rid'];
		$gsid=$research['gsid'];
		$hid=$research['hid'];
		$iid=$research['iid'];
		$gi=$research['gi'];
		$cs=$research['cs'];
		$cgs=$research['cgs'];
	}

else{
		$oid="0000-0000";
		$sid="0000-0000";
		$rid="0000-0000";
		$gsid="0000-0000";
		$hid="0";
		$iid="0";
		$gi="0";
		$cs="0";
		$cgs="0";
}




	
?>

<!DOCTYPE html>
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
    <title>SRMS</title>
    <!-- Custom CSS -->
	<link href="assets/libs/jquery-steps/jquery.steps.css" rel="stylesheet">
    <link href="assets/libs/jquery-steps/steps.css" rel="stylesheet">
	<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{

    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
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
                    <a class="navbar-brand" href="main.php">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                           
                        </b>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                             <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>   
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                            </a>
                             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="">
                                             <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Event today</h5> 
                                                        <span class="mail-desc">Just a reminder that event</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Settings</h5> 
                                                        <span class="mail-desc">You can customize this template</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Pavan kumar</h5> 
                                                        <span class="mail-desc">Just see the my admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                    <div class="m-l-10">
                                                        <h5 class="m-b-0">Luanch Admin</h5> 
                                                        <span class="mail-desc">Just see the my new admin!</span> 
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="Logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
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
                <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="main.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Profile</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-edit"></i><span class="hide-menu">Edit Profile</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                               
                                <li class="sidebar-item"><a href="Basic.php" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Basic Details </span></a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
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
                        <h4 class="page-title">Profile</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
		
          <!-- /Breadcrumb -->
		  
		  


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
												<label for="">(upload less than 2 mb)</label>
												 <div class="input-group">
												 <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile" onchange="return fileValidation2()" aria-describedby="inputGroupPrepend" required>
												<label class="custom-file-label" for="customFile">Choose file(Image)</label>
												</div>
												<p style="color:red;" id = "tutorial"></p>
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

           <input type="hidden" name="student_id" id="student_id" >

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
                    <input type="text" name="univ" id="univ"  class="form-control" />
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
                    <select class="form-control" name="ms" id="ms"required>           
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
                    <input type="text" name="cnum" id="cnum"  class="form-control" />
                </div>

				<div class="mb-3">
                    <label for="">Certificate*</label>
					<label for="">(upload less than 2 mb)</label>
					 <div class="input-group">
					 <input type="file" class="form-control custom-file-input" name="cert" id="uploadFile" onchange="return fileValidation2()" aria-describedby="inputGroupPrepend" required>
					<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
					<p style="color:red;" id = "tutorial"></p>
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

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $student['type'] ?></td>
                                        <td><?= $student['iname'] ?></td>
                                        <td><?= $student['design'] ?></td>
                                        <td><?= $student['fromd'] ?></td>
                                        <td><?= $student['tod'] ?></td>
										<td><?= $student['exp'] ?></td>
										<td align="center"><button type="button" id="ledonof" value="<?=$student['uid'];?>" class="btnimg btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModal2">View</button></td>
                                        <td>
                                        <!--    <button type="button" value="<?=$student['uid'];?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <button type="button" value="<?=$student['uid'];?>" class="editStudentBtn btn btn-success btn-sm">Edit</button>-->
                                            <button type="button" value="<?=$student['uid'];?>" class="deleteStudentBtn btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
				
                                    <?php
                                }
                            }
                            ?>
      
                        </tbody>
                   
					
				
                        <thead>
						    <?php
                            
							$query = "select id, sum( datediff( ifnull(tod, now()) , fromd) +1 )AS value_sum from exp group by id;";
							$query_run = mysqli_query($db, $query);
							$student = mysqli_fetch_assoc($query_run); 
							$sum=$student['value_sum'];
							
							$years = floor($sum / 365);
							$months = floor(($sum - ($years * 365))/30.5);
							$days = floor($sum - ($years * 365) - ($months * 30.5));
							//echo "Days received: " . $sum . " days <br />";
							$v= $years . " years, " . $months . "months, " . $days . "days";
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
        </div>
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

    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
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
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveexp')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable2').load(location.href + " #myTable2");
						

                    }else if(res.status == 500) {
						$('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveexp')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });
		
		
		
		$(document).on('submit', '#pcadd2', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_pc", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage4').removeClass('d-none');
                        $('#errorMessage4').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage4').addClass('d-none');
                        $('#pcadd').modal('hide');
                        $('#pcadd2')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable4').load(location.href + " #myTable4");
						

                    }else if(res.status == 500) {
						$('#errorMessage4').addClass('d-none');
                        $('#pcadd').modal('hide');
                        $('#pcadd2')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editStudentBtn', function () {

            var student_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
						
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
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
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
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

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
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){


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
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){


						$("#image2").attr("src", res.data.paper);
                      
                        $('#studentViewModal3').modal('show');
                    }
                }
            });
        });

$(document).on('click', '.btnimg4', function () {

            var student_id222 = $(this).val();
            $.ajax({
                type: "GET",
                url: "Acode.php?student_id222=" + student_id222,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){


						$("#image4").attr("src", res.data.cert);
                      
                        $('#studentViewModal4').modal('show');
                    }
                }
            });
        });





        $(document).on('click', '.deleteStudentBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
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
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
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
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>

function fileValidation() {
            var fileInput =
                document.getElementById('validationCustomUsername');
             var fileSize = ((document.getElementById('validationCustomUsername').files[0].size)/1024);
            var filePath = fileInput.value;
         
            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
				swal("OOPS!", "Only Image Files are allowed!", "error");
                fileInput.value = '';
                return false;
			}
			else
			{
				if (fileSize>2000) {
                swal("OOPS!", "File size should be less than 2MB!", "error");
                fileInput.value = '';
                return false;
			}
			}				
			
        }

function fileValidation2() {
            var fileInput =
                document.getElementById('uploadFile');
             var fileSize = ((document.getElementById('uploadFile').files[0].size)/1024);
            var filePath = fileInput.value;
         document.getElementById("tutorial").innerHTML= " ";
            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
				var msg="Only Image Files are allowed!";
                fileInput.value = '';
				document.getElementById("tutorial").innerHTML= msg;
			}
			else
			{
				if (fileSize>2000) {
                var msg="File size should be less than 2MB!";
                fileInput.value = '';
				document.getElementById("tutorial").innerHTML= msg;
			}
			}	

			
			
        }
		
		
function fileValidation3() {
            var fileInput =
                document.getElementById('uploadFile2');
             var fileSize = ((document.getElementById('uploadFile2').files[0].size)/1024);
            var filePath = fileInput.value;
         document.getElementById("tutorial2").innerHTML= " ";
            // Allowing file type
                 var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
				var msg="Only images are allowed!";
                fileInput.value = '';
				document.getElementById("tutorial2").innerHTML= msg;
			}
			else
			{
				if (fileSize>2000) {
                var msg="File size should be less than 2MB!";
                fileInput.value = '';
				document.getElementById("tutorial2").innerHTML= msg;
			}
			}	

			
			
        }
		
function fileValidation4() {
            var fileInput =
                document.getElementById('uploadFile4');
             var fileSize = ((document.getElementById('uploadFile4').files[0].size)/1024);
            var filePath = fileInput.value;
         document.getElementById("tutorial4").innerHTML= " ";
            // Allowing file type
                 var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
				var msg="Only images are allowed!";
                fileInput.value = '';
				document.getElementById("tutorial4").innerHTML= msg;
			}
			else
			{
				if (fileSize>2000) {
                var msg="File size should be less than 2MB!";
                fileInput.value = '';
				document.getElementById("tutorial4").innerHTML= msg;
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
                    if(res.status == 422) {
                        $('#errorMessageUpdate2').removeClass('d-none');
                        $('#errorMessageUpdate2').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate2').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                       

                    }else if(res.status == 500) {
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
                    if(res.status == 422) {
                        $('#errorresearch').removeClass('d-none');
                        $('#errorresearch').text(res.message);

                    }else if(res.status == 200){

                        $('#errorresearch').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                       

                    }else if(res.status == 500) {
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
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#studentAddModal2').modal('hide');
                        $('#savejournal')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable3').load(location.href + " #myTable3");

                    }else if(res.status == 500) {
						$('#errorMessage').addClass('d-none');
                        $('#studentAddModal2').modal('hide');
                        $('#savejournal')[0].reset();
                        alertify.set('notifier','position', 'top-right');
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
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
						
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
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#studentEditModal2').modal('hide');
                        $('#updatefamily')[0].reset();

                        $('#myTable1').load(location.href + " #myTable1");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });


        $(document).on('click', '.deletefamilyBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
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
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable1').load(location.href + " #myTable1");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.deletepcBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var student_id5 = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "acode.php",
                    data: {
                        'delete_pc': true,
                        'student_id5': student_id5
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable4').load(location.href + " #myTable4");
                        }
                    }
                });
            }
        });


 $(document).on('click', '.deletejBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
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
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable3').load(location.href + " #myTable3");
                        }
                    }
                });
            }
        });

		
</script>
	
	
</body>

</html>