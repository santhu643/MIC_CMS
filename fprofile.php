<html>
<head>
  <script src="jquery-3.3.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
 
</head>
</html>


<?php

require 'config.php';
include("session.php");


 $fid = mysqli_real_escape_string($db, $_POST['fid']);

	$query = "SELECT * FROM basic WHERE id='$fid'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

		$photo=$student['photo'];

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

$n=" ";
$g=" ";
$e=" ";
$d=" ";
$m=" ";
$a=" ";
}

	$query = "SELECT * FROM research WHERE id='$fid'";
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


	$query7 = "SELECT design,dept FROM faculty WHERE id='$fid'";
    $query_run7 = mysqli_query($db, $query7);
	if(mysqli_num_rows($query_run7) > 0){
	$row7 = mysqli_fetch_assoc($query_run7);
	$de=$row7['design'];
	$dep="Department of ".$row7['dept'];

	}


if($row7['dept']==$fdept)
{	

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
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
	<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
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

 
<div class="container-fluid">
		<div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                   <!-- <img src=".\assets\images\profile\1152018.jpg" alt="Admin" class="rounded-circle" width="150"> -->
					<img src="<?php echo $photo; ?>" alt="" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $n; ?></h4>
                      <p class="text-secondary mb-1"><?php echo $de;?></p>
                      <p class="text-muted font-size-sm"><?php echo $dep;?></p>
                     
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
								$records = mysqli_query($db,"select *from academic where id='$fid'");
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

					<!-- family Start -->
			
			<div class="col-sm-12 mb-3">
			<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Family Details</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><b>S.No</b></th>
												<th><b>Name</b></th>
												<th><b>Relationship</b></th>
												<th><b>Mobile</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$query2 = "SELECT * FROM family where id='$fid'";
										$query_run2 = mysqli_query($db, $query2);

										if(mysqli_num_rows($query_run2) > 0)
										{
											$sn=1;
											foreach($query_run2 as $student2)
											{
                                    ?>

                                            <tr>
                                                <td><?php echo $sn;?></td>
												 <td><?= $student2['name'] ?></td> 
												 <td><?= $student2['relationship'] ?></td>
												  <td><?= $student2['mobile'] ?></td>

                                                
										
										</td>
                                                
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
						
						<!-- family end -->
			
						<!-- exp Start -->
			
			<div class="col-sm-12 mb-3">
			<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Experience Details</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><b>S.No</b></th>
												<th><b>Institution/Corporate Name</b></th>
												<th><b>Designation</b></th>
												<th><b>From</b></th>
												<th><b>To</b></th>
												<th><b>Duration</b></th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$query = "SELECT * FROM exp where id='$fid'";
                            $query_run = mysqli_query($db, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
									
									if($student['tod']=="0000-00-00")
										{
											$ssss= "Current";
										}
										
										else
										{
										$ssss= $student['tod'];
										}
									
                                    ?>
                                    <tr>
                                        <td><?= $student['type'] ?></td>
                                        <td><?= $student['iname'] ?></td>
                                        <td><?= $student['design'] ?></td>
                                        <td><?= $student['fromd'] ?></td>
                                        <td><?php echo $ssss; ?></td>
										<td><?= $student['exp'] ?></td>
										
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
						
						<!-- exp end -->
			
			<!-- posting Start -->
			
			<div class="col-sm-12 mb-3">
			<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Posting Details</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><b>S.No</b></th>
												<th><b>Level</b></th>
												<th><b>Posting Name</b></th>
												<th><b>From</b></th>
												<th><b>To</b></th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
                            

                            $query = "SELECT * FROM posting where id='$fid'";
                            $query_run = mysqli_query($db, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
								$sn=1;
                                foreach($query_run as $student)
                                {
									if($student['tod']=="0000-00-00")
										{
											$sss= "Current";
										}
										
										else
										{
										$sss= $student['tod'];
										}
									
                                    ?>
                                    <tr>
                                        <td><?= $sn ?></td>
                                        <td><?= $student['level'] ?></td>
										<td><?= $student['pname']?></td>
										<td><?= $student['fromd']?></td>
										<td><?php echo $sss; ?></td>
		
                                       
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
						
						<!-- posting end -->
						
						
		<!-- Training Start -->
			
			<div class="col-sm-12 mb-3">
			<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Training Details</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th><b>S.No</b></th>
												<th><b>Type of Training</b></th>
												<th><b>Name of the organization</b></th>
												<th><b>Title</b></th>
												<th><b>From</b></th>
												<th><b>To</b></th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
		
                            $query = "SELECT * FROM training where id='$fid'";
                            $query_run = mysqli_query($db, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
								$s=1;
                                foreach($query_run as $student)
                                {
									
                                    ?>
                                    <tr>
                                        <td><?= $s ?></td>
                                        <td><?= $student['type'] ?></td>
                                        <td><?= $student['no'] ?></td>
                                        <td><?= $student['name'] ?></td>
										 <td><?= $student['fromd'] ?></td>
										 <td><?= $student['tod'] ?></td>
										
                                    </tr>
                                    <?php
									$s=$s+1;
                                }
                            }
                            ?>
                                                

                                        
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
						</div>
						
						<!-- training end -->
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			
          </div>

        </div>
		</div>
	            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
		 <?php //include "./footer.html" ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
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
    <script src="assets/libs/chart/matrix.interface.js"></script>
    <script src="assets/libs/chart/excanvas.min.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/chart/jquery.peity.min.js"></script>
    <script src="assets/libs/chart/matrix.charts.js"></script>
    <script src="assets/libs/chart/jquery.flot.pie.min.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="assets/libs/chart/turning-series.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>
	<script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
	<script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
</body>

</html>
<?php
}

else
	
	{
		?>
		<script>
							
							swal.fire({
									icon: 'error',
									title: 'Faculty Not Found',
									text: 'Note : You can view your department faculty only'
					});
							</script>
		
<?php		
	}
?>