<?php
require 'config.php';
include("session.php");
include("h.php");


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
	<link href="checknew.css" rel="stylesheet">
	
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

  <script type="text/javascript">
function CheckColors(val){
 if(val.value=='Patent')
 {
   document.getElementById('pstatus').classList.remove('d-none');
   document.getElementById('cstatus').classList.add('d-none');
 }
 else if(val.value=='Copyright') {
	 document.getElementById('pstatus').classList.add('d-none');
   document.getElementById('cstatus').classList.remove('d-none');
 }
 
 else{  
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
.d-none{
	display:none;
}

.d1-none{
	display:none;
}
.dropdown-menu {
		max-height: 300px; 
		overflow-y: auto; 
        width: 500px; /* Adjust the width as needed */
        padding: 0.5rem;
        background-color: #f8f9fa; /* Background color */
        border: 1px solid #ced4da; /* Border color */
        border-radius: 0.25rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }

    .dropdown-menu li {
        margin: 0.25rem 0;
        padding: 0.25rem 0;
        list-style-type: none;
    }

    .form-check-label {
        font-size: 14px;
        cursor: pointer;
    }

    /* Hover effect */
    .dropdown-menu li:hover {
        background-color: #e2e3e5; /* Highlight on hover */
    }
	
	
.alertify-notifier .ajs-message{
    color: white; /* Change to your desired color */
}

th {
	/* background-color:#7460ee; */
	background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
	color:white;
	text-align:center;
}

td
{
	text-align:center;
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
                               
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="Logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                
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
			
			if($frole=="HOD")
			{
				include("Hside.php"); 
			}
			else
			{
				include("fside.php"); 
			}
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
                        <h4 class="page-title">Faculty Profile Information</h4>
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

    if(mysqli_num_rows($query_run) >= 0)
    {
        $student = mysqli_fetch_array($query_run);
	} ?>
				
				
				
                <div class="card">
                    <div class="card-body wizard-content">
    
						<div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi-person"></i><b> View Students</b></span></a> </li>
                              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-book"></i><b> Student Details</b></span></a> </li>
                              
							  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#couns" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-book"></i><b> Counselling</b></span></a> </li>
							  
							  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#smedi" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i class="bi bi-book"></i><b> Medical Leave</b></span></a> </li>							  
                                
                            </ul>
                            <!-- Tab panes -->
			<div class="tab-content tabcontent-border">
			<div class="tab-pane active" id="home" role="tabpanel">
						

    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
 
 

 
 <div class="table-responsive">
                    <table id="myTable2" class="table table-bordered table-striped">
										<thead>
                                            <tr>
                                                <th><b>S.No</b></th>
												<th><b>Student ID</b></th>
												<th><b>Name</b></th>
												<th><b>Basic Profile</b></th>
												<th><b>Academic Profile</b></th>
							
                                            </tr>
                                        </thead>
								<tbody>
                            <?php
										if($dept=="Artificial Intelligence and Data Science")
										{
											$dept2="Artificial Intelligence and Machine Learning";
											
										$query = "SELECT * FROM student where dept='$dept' OR dept='$dept2'";
										}
										else
										{
											$query = "SELECT * FROM student where dept='$dept'";
										}
										$query_run = mysqli_query($db, $query);


										if(mysqli_num_rows($query_run) > 0)
										{
											$sn=1;
											foreach($query_run as $student)
											{
                                    ?>
                                            <tr>
                                                <td><?php echo $sn;?></td>
												<td><?= $student['sid']?> </td>
                                                <td><span><?= $student['sname']?></span></td>
												<td><span><?= $student['bc']?></span></td>
												<td><span><?= $student['ac']?></span></td>
                                            </tr>

                                     <?php
									 $sn=$sn+1;
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

		
								
  <div class="tab-pane  p-20" id="profile" role="tabpanel">
  
  
      
			<form id="fsearch" class="needs-validation"  novalidate>
							<div id="fasearch" class="alert alert-warning d-none"></div>
		
								  
							<div class="form-row">
	               
									<div class="col-md-4 mb-3">
									  <label for="validationCustom01">Student ID</label>
									  <input type="text" name="fid" class="form-control" id="validationCustom01" placeholder="Student ID" >
									  <div class="valid-feedback">
										Looks good!
									  </div>
									</div>	

							</div>
								  
					<button class="btn btn-primary"  type="submit">Submit</button>

    
					</form>			
								
							

	<div id="result"></div>

							
								</div>
								

							
								
	<!--profile tab end -->							




								
	<div class="tab-pane" id="couns" role="tabpanel">	

<div class="modal fade" id="addaction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Action taken</h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i> 
                </button>
        </div>

    <div class="container mt-2">
  
		  <div class="mb-3">

 <form id="caction">
    	<div id="actionmsg" class="alert alert-warning d-none"></div>
		
		 <input type="hidden"  name="uidc" id="uidc" >
		
	<div class="mb-3">
		<label for="">Action Taken*</label>
			<textarea type="text" name="action" class="form-control" ></textarea>
			
	</div>
		
    <div class="mb-3">
        <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</form>

               </div>
<div id="check"></div>
	</div>



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- action modal end -->


		         <div class="col-sm-12 mb-3">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title"><u>Counselling Details</u></h5>
				  <div id="test"> </div>
                  <div class="table-responsive">
				  <div id="approvemsg" class="alert alert-warning d-none"></div>
                     <table id="zero_config3" class="table table-striped table-bordered">
                        <thead>
                           <th><b>S.No</b></th>
                           <th><b>Date</b></th>
						   <th><b>Reg no & Name</b></th>
                           <th><b>Point Discussed</b></th>
                           <th><b>Suggestion Given</b></th>
						    <th><b>Action</b></th>
                           <th><b>Status</b></th>
                        </thead>
                        <tbody>
                           
						   <?php
										$query = "SELECT * FROM student where dept='$fdept'";
										$query_run = mysqli_query($db, $query);

										if(mysqli_num_rows($query_run) > 0)
										{
											$sn=1;
											foreach($query_run as $student)
											{
						
						
								$fid=$student['sid'];
								$sname= $student['sname'];
                              $query = "SELECT * FROM counselling where sid='$fid' and status='2' ORDER BY uid DESC";
                              $query_run = mysqli_query($db, $query);
                              
                              if (mysqli_num_rows($query_run) > 0) {
                                  $sss = 1;
                                  foreach ($query_run as $student) {
                                      $actionsValue = $student['actions'];
                                     
                                      ?>
                           <tr>
                              <td><?= $sss ?></td>
                              <td><?= $student['datee'] ?></td>
							   <td><?= $student['sid'].'-'. $sname ?></td>
                              <td><?= $student['feedback'] ?></td>
                              <td>
									<?php
									if($student['actions']=="" and $student['status']=="2")
									{
										?>
										<span class="btn btn-success btn-sm" id="enterButton" value="<?=$student['uid'];?>" data-bs-toggle="modal" data-bs-target="#addaction">Enter</span>
										
										<button type="button" value="<?=$student['uid'];?>" class="forwardhBtn btn btn-primary btn-sm">Forward</button>
										
										
										<?php
									}
									else
									{
										echo $student['actions'];
										?>
										<br>
										<button type="button" value="<?=$student['uid'];?>" class="approveBtn btn btn-success btn-sm">Approve</button>
										
										<?php
									}

									?>
							  
							  </td>
							  
							 <td><?php 

									if($student['status']==1)
									{
										echo "Approved on " . $student['adate'];
									}
									
									if($student['status']==2)
									{
										echo "Received on " . $student['adate']." from ".$student['aname'];
										?>
	
										<?php
									}

								?>
                              </td>
							  
							  
							  
							  
                              <td><?php if($student['status']==2):?>
                                 <span class="btn btn-warning btn-sm">Pending</span>
                                 <?php elseif($student['status']==0 ):?>
                                 <span class="btn btn-success">Approved</span>
								 <?php elseif($student['status']==3 ):?>
                                 <span class="btn btn-danger">Forwarded to Principal</span>
                                 <?php endif;?>
                              </td>
                           </tr>
                           <?php
                              $sss = $sss + 1;
                              }
                              }
							  			
											}
												
                            }
  						   
                              ?>
                        </tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
				
 
									
								
    </div>

							
		<div class="tab-pane  p-20" id="smedi" role="tabpanel">
  
  <div class="modal fade" id="studentViewModalms" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                </button>
        </div>
            <div class="modal-body">
			 <img id="imagems" src="" alt="Medical Leave" class="center" style="width:80%;height:80%;">           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
          <div class="col-sm-12 mb-3">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title"><u>Medical Leave details</u></h5>
				  <div id="test"> </div>
                  <div class="table-responsive">
				  <div id="approvemsg" class="alert alert-warning d-none"></div>
                     <table id="zero_config5" class="table table-striped table-bordered">
                        <thead>
								<th><b>S.No</b></th>
								<th><b>Reg no & Name</b></th>
								<th><b>From</b></th>
								<th><b>To</b></th>
                                <th><b>Total Days</b></th>
                                <th><b>Reason</b></th>
								<th><b>View</b></th>
								<th><b>Action</b></th>
								<th><b>Status</b></th>
                        </thead>
                        <tbody>
                           
						   <?php
										$query = "SELECT * FROM student where dept='$fdept'";
										$query_run = mysqli_query($db, $query);

										if(mysqli_num_rows($query_run) > 0)
										{
											$sn=1;
											foreach($query_run as $student)
											{
						
						
								$fid=$student['sid'];
								$sname2= $student['sname'];
                              $query = "SELECT * FROM smedical where sid='$fid' and status='2' ORDER BY uid DESC";
                              $query_run = mysqli_query($db, $query);
                              
                              if (mysqli_num_rows($query_run) > 0) {
                                  $sss = 1;
                                  foreach ($query_run as $student) {
                                    
                                     
                                      ?>
                           <tr>
                              <td><?= $sss ?></td>
							   <td><?= $student['sid'].'-'. $sname2 ?></td>
                              <td><?= $student['fdate'] ?></td>
							<td><?= $student['tdate'] ?></td>
							<td><?= $student['tdays'] ?></td>
							<td><?= $student['reason'] ?></td>
							<td align="center"><button type="button" id="ledonof" value="<?=$student['uid'];?>" class="btnsmedi btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModalms">View</button></td>
                   
							  
							 <td><?php 
							 
								if($student['status']==0)
								{
									?>
                                <button type="button" value="<?=$student['uid'];?>" class="forwardmlBtn btn btn-success btn-sm">Forward</button>
								
								<button type="button" value="<?=$student['uid'];?>" class="rejectmlBtn btn btn-danger btn-sm">Reject</button>
                              
								<?php
								}
								else
								{
									if($student['status']==1)
									{
										echo "Approved on " . $student['adate'];
									}
									
									else if($student['status']==2)
									{
										echo "Forwarded on " . $student['adate']." by ".$student['aname'];
										
										echo "<br>";
										echo "<br>";
										?>
										<button type="button" value="<?=$student['uid'];?>" class="approvemlBtn btn btn-success btn-sm">Approve</button>
								
								<button type="button" value="<?=$student['uid'];?>" class="rejectmlBtn btn btn-danger btn-sm">Reject</button>
								
								<?php
									}
									else if($student['status']==3)
									{
										echo "Rejected on " . $student['adate'];
									}
								}
								?>
                              </td>
							  
							  
							  
							  
                              <td>
                                 <?php if($student['status']==2 ):?>
                                 <span class="btn btn-warning">Pending</span>
                            
                                 <?php endif;?>
                              </td>
                           </tr>
                           <?php
                              $sss = $sss + 1;
                              }
                              }
							  			
											}
												
                            }
  						   
                              ?>
                        </tbody>
                        </tbody>
                     </table>
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
		    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
		
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    
		
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
	
		
	$(document).on('submit', '#fsearch', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("f_search", true);
			console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
					var res = jQuery.parseJSON(response);
                    $('#result').html(res);

                }
            });

        });		


$(document).ready(function() {
    // Fetch academic year options on page load
   $.ajax({
        url: "scode.php?action=academic_years", // PHP script for academic years
        method: "GET",
        success: function(response) {
            $("#academic-year").html(response);
			$("#academic-year1").html(response);
        }
    });

    // Fetch faculty names on page load
    $.ajax({
        url: "scode.php?action=faculty_names", // PHP script for faculty names
        method: "GET",
        success: function(response) {
            $("#faculty").html(response);
			$("#faculty1").html(response);
        }
    });
	

    // Listen for changes in academic year dropdown
    $("#academic-year").change(function() {
        var selectedYear = $(this).val();
        
        $.ajax({
            url: "scode.php", // Your PHP script to fetch students based on academic year
            method: "POST",
            data: { 
			'sel_std': true,
			academic_year: selectedYear
			},
            success: function(response) {
               
				$("#student-checkboxes").html(response);
            }
        });
    });
	

  $("#faculty1").change(function() {
       
     $("#academic-year1").val("");   
    $('#student-checkboxes1').load(location.href + " #student-checkboxes1");
   
   
    });



  $("#academic-year1").change(function() {
        var selectedYear1 = $(this).val();
		 var selectedFaculty = $("#faculty1").val(); 
        
        $.ajax({
            url: "scode.php", // Your PHP script to fetch students based on academic year
            method: "POST",
            data: { 
			'sel_std1': true,
			academic_year1: selectedYear1,
			fac:selectedFaculty
			},
            success: function(response) {
				$("#student-checkboxes1").html(response);
            }
        });
    });
});




  

//submit mentees form

        $(document).on('submit', '#stdname', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_stdname", true);

            $.ajax({
                type: "POST",
                url: "process.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#menteemsg').removeClass('d-none');
                        $('#menteemsg').text(res.message);

                    }else if(res.status == 200){

                        $('#menteemsg').addClass('d-none');
                      
                        $('#stdname')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
						
						 $('#student-checkboxes').load(location.href + " #student-checkboxes");

                    }else if(res.status == 502) {
						$('#menteemsg').addClass('d-none');
                      
                        $('#stdname')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
                    }
                }
            });

        });
		

//add students csv
 $(document).on('submit', '#csv', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_csv", true);
console.log(formData);
            $.ajax({
                type: "POST",
                url: "process.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
				console.log(res.status);
                    if(res.status == 500) {
                        $('#stdmsg').removeClass('d-none');
                        $('#stdmsg').text(res.message);

                    }else if(res.status == 200){

                        $('#stdmsg').addClass('d-none');
                      
                        $('#csv')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
						
						 $('#addstd').modal('hide');

                    }else if(res.status == 502) {
						$('#stdmsg').addClass('d-none');
                      
                        $('#csv')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
						 $('#addstd').modal('hide');
                    }
                }
            });

        });


//delete mentees		
	
$(document).on('submit', '#stdname1', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_stdname1", true);
console.log(formData);
            $.ajax({
                type: "POST",
                url: "process.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#delmsg').removeClass('d-none');
                        $('#delmsg').text(res.message);

                    }else if(res.status == 200){

                        $('#delmsg').addClass('d-none');
                      
                        $('#stdname1')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
						
						 $('#student-checkboxes1').load(location.href + " #student-checkboxes1");
						 
						 $('#delmentee').modal('hide');

                    }else if(res.status == 502) {
						$('#delmsg').addClass('d-none');
                      
                        $('#stdname1')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
                    }
                }
            });

        });
		
	
	
	
//faculty search

        $(document).on('submit', '#fsearch', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_ssearch", true);
			
			console.log(formData);

            $.ajax({
                type: "POST",
                url: "sprofilehod.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
            $("#result").html(response);
                }
            });

        });


//feedback enter by HOD


//getting enter button value to modal

$(document).ready(function() {
    
    $('#enterButton').click(function() {
        
        var studentUID = $(this).attr('value');

       
        $('#uidc').val(studentUID);
    });

    // Additional code for form submission, validation, etc., can be added here.
});


 $(document).on('submit', '#caction', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_caction", true);
            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
					  //$("#check").html(response);
                    var res = jQuery.parseJSON(response);
			
                    if(res.status == 422) {
                        $('#actionmsg').removeClass('d-none');
                        $('#actionmsg').text(res.message);

                    }else if(res.status == 200){

                        $('#actionmsg').addClass('d-none');
                      
                        $('#caction')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
						
						 $('#addaction').modal('hide');
						  $('#zero_config3').load(location.href + " #zero_config3");

                    }else if(res.status == 500) {
						$('#actionmsg').addClass('d-none');
                      
                        $('#caction')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);
						 $('#addaction').modal('hide');
                    }
                }
            });

        });	

	//Faculty Approve	
		
$(document).on('click', '.approveBtn', function () {

            var fc = $(this).val();
            
            $.ajax({
					type: "POST",
                    url: "scode.php",
                    data: {
                        'approve_c': true,
                        'fc': fc
                    },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
					
					console.log(res.status);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
						
						$('#approvemsg').addClass('d-none');
                      

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

						  $('#zero_config3').load(location.href + " #zero_config3");
						
                    }

                }
            });

        });

//mentor approve end	

//mentor forward to principal

$(document).on('click', '.forwardhBtn', function () {

            var fc = $(this).val();
            
            $.ajax({
					type: "POST",
                    url: "scode.php",
                    data: {
                        'forwardh_c': true,
                        'fc': fc
                    },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
					
					console.log(res.status);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
						
						$('#approvemsg').addClass('d-none');
                      

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

						  $('#zero_config3').load(location.href + " #zero_config3");
						
                    }

                }
            });

        });		
		
	//medical leave rejected

$(document).on('click', '.rejectmlBtn', function () {

            var fc = $(this).val();
            
            $.ajax({
					type: "POST",
                    url: "scode.php",
                    data: {
                        'rejec_ml': true,
                        'fc': fc
                    },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
					
					console.log(res.status);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
						
						$('#approvemsg').addClass('d-none');
                      

                        alertify.set('notifier','position', 'top-right');
                        alertify.error(res.message);

						  $('#zero_config5').load(location.href + " #zero_config5");
						
                    }

                }
            });

        });


//approve medical leave
$(document).on('click', '.approvemlBtn', function () {

            var fc = $(this).val();
            
            $.ajax({
					type: "POST",
                    url: "scode.php",
                    data: {
                        'approve_ml': true,
                        'fc': fc
                    },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
					
					console.log(res.status);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){
						
						$('#approvemsg').addClass('d-none');
                      

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

						  $('#zero_config5').load(location.href + " #zero_config5");
						
                    }

                }
            });

        });	
</script>

   <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#myTable2').DataTable();
       </script> 
</body>

</html>