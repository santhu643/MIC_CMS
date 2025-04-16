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
	<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

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
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <div class="dropdown-divider"></div>
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
                            <li class="sidebar-item"><a href="academic.php" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Academic Details </span></a></li>
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
		<div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
		  
		  			<div class="col-sm-12 mb-3">
						<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Faculy Profile</h5>
<form id="research" class="needs-validation"  novalidate>
							<div id="errorresearch" class="alert alert-warning d-none"></div>
							<div class="card-header">
									<h4> Search Faculty </h4>
							</div>
								  
							<div class="form-row">
	               
									<div class="col-md-4 mb-3">
									  <label for="validationCustom01">Faculty ID</label>
									  <input type="text" name="fid" class="form-control" id="validationCustom01" placeholder="First Name" >
									  <div class="valid-feedback">
										Looks good!
									  </div>
									</div>	

							</div>
								  
								  

								  
								  

  
  
  <button class="btn btn-primary"  type="submit">Submit</button>

    
</form>	
					
                            </div>
                        </div>
						</div>


            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                   <!-- <img src=".\assets\images\profile\1152018.jpg" alt="Admin" class="rounded-circle" width="150"> -->
					<img id="pro" src="" alt="" class="rounded-circle pro" width="150">
                    <div class="mt-3">
					
                      <h4 class="kk" id="faname"></h4>
                      <p class="text-secondary mb-1 desi"></p>
                      <p class="text-muted font-size-sm dept"></p>
                     
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">ORCID</h6>
                    <span class="text-secondary"> <?php echo $oid; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Scopus ID</h6>
                    <span class="text-secondary"> <?php echo $sid; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Researcher ID</h6>
                    <span class="text-secondary"> <?php echo $rid; ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Google Scholar ID</h6>
                    <span class="text-secondary"> <?php echo $gsid; ?></span>
                  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">H-Index</h6>
                    <span class="text-secondary"> <?php echo $hid; ?></span>
				<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">i10-Index</h6>
                    <span class="text-secondary"> <?php echo $iid; ?></span>
                  </li>
				                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">G-Index</h6>
                    <span class="text-secondary"> <?php echo $gi; ?></span>
                  </li>
				  				                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Citations Scopus</h6>
                    <span class="text-secondary"> <?php echo $cs; ?></span>
                  </li>
				  				                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Citations Google Scholar</h6>
                    <span class="text-secondary"> <?php echo $cgs; ?></span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $n; ?>
                    </div>
                  </div>
                  <hr>
				  
				    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $g; ?>
                    </div>
                  </div>
                  <hr>
				  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $e; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">	Date of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $d; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $m; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      	<?php echo $a; ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                    <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Qualification</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><b>Course</b></th>
                                        <th scope="col"><b>Institutions</b></th>
                                        <th scope="col"><b>Year</b></th>
                                    </tr>
                                </thead>
								<?php
								$records = mysqli_query($db,"select *from academic where id='$s'");
								while($data = mysqli_fetch_array($records))
								{
									?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data['course']; ?></td>
                                        <td><?php echo $data['iname']; ?></td>
                                        <td><?php echo $data['yc']; ?></td>
                                    </tr>
                                </tbody>
								<?php } ?>
                            </table>
                        </div>
                  </div>
                </div>
              </div>



            </div>

			<div class="col-sm-12 mb-3 view">
		
			<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Journals Publications</h5>
                                
								<div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><b>S.No</b></th>
												<th><b>Journal Details</b></th>
                                             
          
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
								 
									
			
										$fid = mysqli_real_escape_string($db, $_POST['fid']);
										$query = "SELECT * FROM journal where id='$data'";
										$query_run = mysqli_query($db, $query);

										if(mysqli_num_rows($query_run) > 0)
										{
											$sn=1;
											foreach($query_run as $student)
											{
                                    ?>

                                            <tr>
                                                <td><?php echo $sn;?></td>
                                                <td><b><?= $student['pt'] ?></b>
										<br><?= $student['jn']?>
										<br><?= $student['pn']?>
										<br>Vol: <?= $student['vol']?>, Issue: <?= $student['issue']?>, Pages: <?= $student['pages']?>, PISSN : <?= $student['pissn']?>, EISSN : <?= $student['eissn']?>, Month & Year: <?= $student['mon']?>
										<br><span style="color:blue">Indexing : <?= $student['scope']?></span>
										
										</td>
                                                
                                            </tr>

                                     <?php
											}
												$sn=$sn+1;
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
		    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
		
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
	
<script>
$(document).on('submit', '#searchfaculty', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("s_f", true);

console.log(formData);
	var d="kalai";
 
            $.ajax({
                type: "POST",
                url: "fcode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
            
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
						console.log(d);
						
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

      					$('#fname').val(d);
						//$('#student_id').val(res.data.uid);
						
                        //$('#fname').val(d);
						//var x=val(res.data.name);
 

 
						//$('#searchfaculty')[0].reset();

                    }else if(res.status == 201) {
						console.log(d);
						$('#errorMessage').addClass('d-none');
                        $('#studentAddModal').modal('hide');
                        $('#saveexp')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
                    }
                }
				
            });

        });
		
	$(document).on('submit', '#research', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("update_researchh", true);

            $.ajax({
                type: "POST",
                url: "Acode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
					var res2 = jQuery.parseJSON(response);
					
					$("#pro").attr("src", res.data.photo);
					
                    if(res.status == 422) {
                        $('#errorresearch').removeClass('d-none');
                        $('#errorresearch').text(res.message);

                    }else if(res2.status == 200){

                        
						var s=(res.data.id);
				
						$('.kk').html(res.data.name);
						$('.desi').html(res.data.design);
						var dep="Department of "+res.data.dept;
						$('.dept').html(dep);
						$("#pro").attr("src", res2.data.photo);
                      $('.jo').text(res.data.id);
					  var jou=res.data;
console.log(jou);
						$('#errorresearch').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                       $("#zero_config").load(location.href + " #zero_config");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });			
		




</script>	
	
	
	
	
	
</body>

</html>