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

$query = "SELECT * FROM student WHERE sid='$fid' and mentor='$s'";
$query_run = mysqli_query($db, $query);

if (mysqli_num_rows($query_run) == 1) {
   $query = "SELECT * FROM sbasic WHERE sid='$fid'";
   $query_run = mysqli_query($db, $query);

   if (mysqli_num_rows($query_run) == 1) {
      $student = mysqli_fetch_array($query_run);

      if ($student['pphoto'] == "") {
         $k = ".\assets\images\images.jpg";
      } else {
         $k = $student['pphoto'];
      }


      if ($student['fphoto'] == "") {
         $fa = ".\assets\images\images.jpg";
      } else {
         $fa = $student['fphoto'];
      }


      if ($student['mphoto'] == "") {
         $mo = ".\assets\images\images.jpg";
      } else {
         $mo = $student['mphoto'];
      }



      $n = $student['fname'] . ' ' . $student['lname'];
      $batch = $student['batch'];
      $de = $student['programme'];
      $dep = $student['department'];
      $g = $student['gender'];
      $e = $student['email'];
      $d2 = $student['dob'];
      $exp = explode('-', $d2);
      $newStr = trim($exp[2]) . ' - ' . trim($exp[1]) . ' - ' . trim($exp[0]);
      $dob = $newStr;
      $blood = $student['blood'];
      $m = $student['mobile'];
      $a = $student['paddress'] . ',' . $student['city'] . '-' . $student['zip'];
      $ta = $student['taddress'];
      $lang = $student['languages'];
      $hstl = $student['room'];
   } else {



      $n = " ";
      $de = " ";
      $k = "images/user.png";
      $fa = "images/dad.png";
      $mo = "images/women.png";
      $dep = " ";
      $g = " ";
      $e = " ";
      $dob = " ";
      $m = " ";
      $a = " ";
      $batch = " ";
      $ta = " ";
      $lang = " ";
      $blood = " ";
      $hstl = "NA";
   }





   ?>

   <!DOCTYPE html>
   <html dir="ltr" lang="en">

   <head>

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
         body {

            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
         }

         .main-body {
            padding: 15px;
         }

         .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
         }

         .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
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

         .gutters-sm>.col,
         .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
         }

         .mb-3,
         .my-3 {
            margin-bottom: 1rem !important;
         }

         .bg-gray-300 {
            background-color: #e2e8f0;
         }

         .h-100 {
            height: 100% !important;
         }

         .shadow-none {
            box-shadow: none !important;
         }

         .colr {
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
         }


         th {
            /* background-color:#7460ee; */
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%);
            color: white;
            text-align: center;
         }

         td {
            text-align: center;
         }

         .test {
            padding: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
         }

         .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
         }
      </style>


   </head>

   <body>

      <div class="container-fluid">
         <div class="main-body">
            <div class="row gutters-sm">
               <div class="col-md-4 mb-3">
                  <div class="card">
                     <div class="card-body colr">
                        <div class="d-flex flex-column align-items-center text-center">
                           <!-- <img src=".\assets\images\profile\1152018.jpg" alt="Admin" class="rounded-circle" width="150"> -->
                           <img src="<?php echo $k; ?>" alt="" class="rounded-circle test" width="150">
                           <div class="mt-3">
                              <h4><?php echo $n; ?></h4>
                              <p class="text-white mb-1"><?php echo $de; ?></p>
                              <p class="text-white font-size-sm"><?php echo $dep; ?></p>
                              <p class="text-warning font-size-sm"><b><?php echo $batch; ?></b></p>
                              <hr>
                              <img src="<?php echo $fa; ?>" alt="" class="rounded-circle test" width="150">
                              &nbsp;&nbsp;&nbsp;&nbsp;
                              <img src="<?php echo $mo; ?>" alt="" class="rounded-circle test" width="150">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card mt-3">
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
                              <h6 class="mb-0">Register Number</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $fid; ?>
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
                              <h6 class="mb-0"> Date of Birth</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $dob; ?>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 class="mb-0"> Blood Group</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $blood; ?>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Mobile</h6>
                           </div>
                           <div class="col-sm-3 text-secondary">
                              <?php echo $m; ?>
                           </div>
                           <div class="col-sm-3">
                              <h6 class="mb-0">Email</h6>
                           </div>
                           <div class="col-sm-3 text-secondary">
                              <?php echo $e; ?>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Language Known</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $lang; ?>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Communication Address</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $ta; ?>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Permeant Address</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $a; ?>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Hostel Room</h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <?php echo $hstl; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 mb-3">
                  <div class="card h-100">
                     <div class="card">
                        <div class="card-body">
                           <h5 class="card-title m-b-0"><u>Qualification</u></h5>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col"><b>Course</b></th>
                                 <th scope="col"><b>Degree</b></th>
                                 <th scope="col"><b>Institution</b></th>
                                 <th scope="col"><b>Branch</b></th>
                                 <th scope="col"><b>Board</b></th>
                                 <th scope="col"><b>Medium of study</b></th>
                                 <th scope="col"><b>Year</b></th>
                                 <th scope="col"><b>Percentage</b></th>
                              </tr>
                           </thead>
                           <?php
                           $records = mysqli_query($db, "select *from sacademic where sid='$fid'");
                           while ($data = mysqli_fetch_array($records)) {
                              ?>
                              <tbody>
                                 <tr>
                                    <td><?php echo $data['course']; ?></td>
                                    <td><?php echo $data['degree']; ?></td>
                                    <td><?php echo $data['iname']; ?></td>
                                    <td><?php echo $data['branch']; ?></td>
                                    <td><?php echo $data['board']; ?></td>
                                    <td><?php echo $data['mos']; ?></td>
                                    <td><?php echo $data['yc']; ?></td>
                                    <td><?php echo $data['score']; ?></td>
                                 </tr>
                              </tbody>
                           <?php } ?>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- family Start -->
               <div class="col-sm-12 mb-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title"><u>Family Details</u></h5>
                        <div class="table-responsive">
                           <table id="zero_config1" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th><b>S.No</b></th>
                                    <th><b>Name</b></th>
                                    <th><b>Gender</b></th>
                                    <th><b>Relationship</b></th>
                                    <th><b>Occupation</b></th>
                                    <th><b>Organization</b></th>
                                    <th><b>Mobile</b></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $query2 = "SELECT * FROM sfamily where sid='$fid'";
                                 $query_run2 = mysqli_query($db, $query2);

                                 if (mysqli_num_rows($query_run2) > 0) {
                                    $sn = 1;
                                    foreach ($query_run2 as $student2) {
                                       ?>
                                       <tr>
                                          <td><?php echo $sn; ?></td>
                                          <td><?= $student2['name'] ?></td>
                                          <td><?= $student2['gender'] ?></td>
                                          <td><?= $student2['relationship'] ?></td>
                                          <td><?= $student2['occu'] ?></td>
                                          <td><?= $student2['org'] ?></td>
                                          <td><?= $student2['mobile'] ?></td>
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
               <!-- family end -->
               <!-- exp Start -->
               <!-- <div class="col-sm-12 mb-3">
                  <div class="modal fade" id="studentViewModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">View Prizes</h5>
                              <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                 <i class="mdi mdi-close"></i> 
                              </button>
                           </div>
                           <div class="modal-body">
                              <img id="imagepr" src="" alt="prizes" class="center" style="width:80%;height:80%;">
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title"><u>Prizes / Awards Details</u></h5>
                        <div class="table-responsive">
                           <table id="zero_config" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th><b>S.No</b></th>
                                    <th><b>Name of the event</b></th>
                                    <th><b>Level</b></th>
                                    <th><b>Organizer</b></th>
                                    <th><b>Prize</b></th>
                                    <th><b>View</b></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $query = "SELECT * FROM sprize where sid='$fid'";
                                 $query_run = mysqli_query($db, $query);

                                 if (mysqli_num_rows($query_run) > 0) {
                                    $sn = 1;
                                    foreach ($query_run as $student) {

                                       ?>
                                       <tr>
                                          <td><?= $sn ?></td>
                                          <td><?= $student['event'] ?></td>
                                          <td><?= $student['level'] ?></td>
                                          <td><?= $student['organiser'] ?></td>
                                          <td><?= $student['prize'] ?></td>
                                          <td align="center">
                                             <button type="button" id="ledonof" value="<?= $student['uid']; ?>" class="btnimgpr btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#studentViewModal4"><i class="fas fa-eye"></i></button>
                                             <a href="<?= $student['cert'] ?>" download class="btn btn-primary btn-sm">
                                                <i class="fas fa-download"></i>
                                             </a>
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
               </div> -->
               <!-- exp end -->
               <!-- posting Start -->
               <div class="col-sm-12 mb-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title"><u>Parents-Meeting Details</u></h5>
                        <div class="table-responsive">
                           <table id="zero_config2" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th><b>S.No</b></th>
                                    <th><b>Date</b></th>
                                    <th><b>Purpose of Meeting</b></th>
                                    <th><b>Suggestions</b></th>
                                    <th><b>Status</b>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $query = "SELECT * FROM parentmeeting where sid='$fid'";
                                 $query_run = mysqli_query($db, $query);

                                 if (mysqli_num_rows($query_run) > 0) {
                                    $sn = 1;
                                    foreach ($query_run as $student) {
                                       ?>
                                       <tr>
                                          <td><?= $sn ?></td>
                                          <td><?= $student['datee'] ?></td>
                                          <td><?= $student['purpose'] ?></td>
                                          <td><?= $student['suggestion'] ?></td>
                                          <td><?php if ($student['status'] == 0): ?>
                                                <span class="btn btn-warning">Pending</span>
                                             <?php elseif ($student['status'] == 1): ?>
                                                <span class="btn btn-success">Approved</span>
                                             <?php endif; ?>
                                          </td>
                                       </tr>
                                       <?php
                                       $sn++;
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
                        <h5 class="card-title"><u>Counselling Details</u></h5>
                        <div class="table-responsive">
                           <table id="zero_config3" class="table table-striped table-bordered">
                              <thead>
                                 <th><b>S.No</b></th>
                                 <th><b>Date</b></th>
                                 <th><b>FeedBack</b></th>
                                 <th><b>Actions Taken</b></th>
                                 <th><b>Status</b></th>
                              </thead>
                              <tbody>
                                 <?php
                                 $query = "SELECT * FROM counselling where sid='$fid'";
                                 $query_run = mysqli_query($db, $query);

                                 if (mysqli_num_rows($query_run) > 0) {
                                    $sss = 1;
                                    foreach ($query_run as $student) {
                                       $actionsValue = $student['actions'];
                                       $buttonText = ($actionsValue == 0) ? 'Pending' : 'Verified';
                                       $buttonClass = ($actionsValue == 0) ? 'btn-warning' : 'btn-success';
                                       ?>
                                       <tr>
                                          <td><?= $sss ?></td>
                                          <td><?= $student['datee'] ?></td>
                                          <td><?= $student['feedback'] ?></td>
                                          <td><?= $student['actions'] ?></td>
                                          <td><?php if ($student['status'] == 0): ?>
                                                <span class="btn btn-warning btn-sm">Pending</span>
                                             <?php elseif ($student['status'] == 1): ?>
                                                <span class="btn btn-success">Approved</span>
                                             <?php endif; ?>
                                          </td>
                                       </tr>
                                       <?php
                                       $sss = $sss + 1;
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
               <!-- training end -->
               <!-- Projects Start -->
               <div class="col-sm-12 mb-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title"><u>Projects Done</u></h5>
                        <div class="table-responsive">
                           <table id="zero_config4" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th><b>S.No</b></th>
                                    <th><b>Semester</b></th>
                                    <th><b>Title of the project</b></th>
                                    <th><b>Github link</b></th>
                                    <th><b>Remarks</b></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $query = "SELECT * FROM sproject WHERE sid='$fid'";
                                 $query_run = mysqli_query($db, $query);

                                 if (mysqli_num_rows($query_run) > 0) {
                                    $sn = 1;
                                    foreach ($query_run as $student) {

                                       ?>
                                       <tr>
                                          <td><?= $sn ?></td>
                                          <td><?= $student['semester'] ?></td>
                                          <td><?= $student['title'] ?></td>
                                          <td><?= $student['github'] ?></td>
                                          <td><?= $student['remark'] ?></td>
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
               <!-- internship Start -->
               <div class="col-sm-12 mb-3">


                  <div class="modal fade" id="studentViewModali" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                              <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                 <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                              </button>
                           </div>
                           <div class="modal-body text-center">
                              <img id="imagei" src="" alt="Certificate" class="img-fluid"
                                 style="max-width:80%; max-height:70vh;">
                              <iframe id="pdfi" src=""
                                 style="width:100%; height:70vh; border:none; display:none;"></iframe>
                              <div id="noContentMessage" class="alert alert-info" style="display:none;">
                                 No content available
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>


                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title"><u>Online / Internship / Course Certification Details</u> </h5>
                        <div class="table-responsive">
                           <table id="zero_config5" class="table table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th><b>S.No</b></th>
                                    <th><b>Name of the Program / Title</b></th>
                                    <th><b>Type</b></th>
                                    <th><b>Organizer</b></th>
                                    <th><b>Duration</b></th>
                                    <th><b>Remarks</b></th>
                                    <th><b>View</b></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 $query = "SELECT * FROM sintern where sid='$fid'";
                                 $query_run = mysqli_query($db, $query);

                                 if (mysqli_num_rows($query_run) > 0) {
                                    $sn = 1;
                                    foreach ($query_run as $student) {

                                       ?>
                                       <tr>
                                          <td><?= $sn ?></td>
                                          <td><?= $student['iname'] ?></td>
                                          <td><?= $student['type'] ?></td>
                                          <td><?= $student['org'] ?></td>
                                          <td><?= $student['dur'] ?></td>
                                          <td><?= $student['rem'] ?></td>
                                          <td align="center">
                                             <button type="button" id="ledonof" value="<?= $student['uid']; ?>"
                                                class="btnimgi btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#studentViewModali"><i class="fas fa-eye"></i></button>
                                             <a href="<?= $student['cert'] ?>" download class="btn btn-primary btn-sm">
                                                <i class="fas fa-download"></i>
                                             </a>
                                          </td>
                                       </tr>
                                       <?php
                                       $sn = $sn + 1;
                                    }
                                 }
                                 ?>
                              </tbody>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

                  <!-- co-curricular Start -->
                  <div class="col-sm-12 mb-3">


                     <div class="modal fade" id="studentViewModalco" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                 <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                 </button>
                              </div>
                              <div class="modal-body text-center">
                                 <img id="imagei2" src="" alt="Certificate" class="img-fluid"
                                    style="max-width:80%; max-height:70vh;">
                                 <iframe id="pdfi2" src=""
                                    style="width:100%; height:70vh; border:none; display:none;"></iframe>
                                 <div id="noContentMessage" class="alert alert-info" style="display:none;">
                                    No content available
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>


                     <div class="card">
                        <div class="card-body">
                           <h5 class="card-title"><u>Co – Curricular Activity</u></h5>
                           <div class="table-responsive">
                              <table id="zero_config6" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th><b>S.No</b></th>
                                       <th><b>Name of the event</b></th>
                                       <th><b>Level</b></th>
                                       <th><b>Organizer</b></th>
                                       <th><b>Prize</b></th>
                                       <th><b>View</b></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $query = "SELECT * FROM scocu where sid='$fid'";
                                    $query_run = mysqli_query($db, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                       $sn = 1;
                                       foreach ($query_run as $student) {

                                          ?>
                                          <tr>
                                             <td><?= $sn ?></td>
                                             <td><?= $student['event'] ?></td>
                                             <td><?= $student['level'] ?></td>
                                             <td><?= $student['organiser'] ?></td>
                                             <td><?= $student['prize'] ?></td>
                                             <td align="center">
                                                <button type="button" id="ledonof" value="<?= $student['uid']; ?>"
                                                   class="btnimgco btn-info btn-sm" data-bs-toggle="modal"
                                                   data-bs-target="#studentViewModalco"> <i class="fas fa-eye"></i></button>
                                                <a href="<?= $student['cert'] ?>" download class="btn btn-primary btn-sm">
                                                   <i class="fas fa-download"></i>
                                                </a>
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
                  <!-- posting end -->
                  <!-- Training Start -->
                  <div class="col-sm-12 mb-3">
                     <div class="modal fade" id="studentViewModalex" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                                 <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="mdi mdi-close"></i> <!-- Font Awesome close icon -->
                                 </button>
                              </div>
                              <div class="modal-body text-center">
                                 <img id="imagei3" src="" alt="Certificate" class="img-fluid"
                                    style="max-width:80%; max-height:70vh;">
                                 <iframe id="pdfi3" src=""
                                    style="width:100%; height:70vh; border:none; display:none;"></iframe>
                                 <div id="noContentMessage" class="alert alert-info" style="display:none;">
                                    No content available
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-body">
                           <h5 class="card-title"><u>Extra – Curricular / Extension Activity</u></h5>
                           <div class="table-responsive">
                              <table id="zero_config7" class="table table-striped table-bordered">
                                 <thead>
                                    <tr>
                                       <th><b>S.No</b></th>
                                       <th><b>Name of the event</b></th>
                                       <th><b>Level</b></th>
                                       <th><b>Organizer</b></th>
                                       <th><b>Prize</b></th>
                                       <th><b>View</b></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $query = "SELECT * FROM st_extra where sid='$fid'";
                                    $query_run = mysqli_query($db, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                       $sn = 1;
                                       foreach ($query_run as $student) {

                                          ?>
                                          <tr>
                                             <td><?= $sn ?></td>
                                             <td><?= $student['event'] ?></td>
                                             <td><?= $student['level'] ?></td>
                                             <td><?= $student['organiser'] ?></td>
                                             <td><?= $student['prize'] ?></td>
                                             <td align="center">
                                                <button type="button" id="ledonof" value="<?= $student['uid']; ?>"
                                                   class="btnimgex btn-info btn-sm" data-bs-toggle="modal"
                                                   data-bs-target="#studentViewModalex"><i class="fas fa-eye"></i></button>
                                                <a href="<?= $student['cert'] ?>" download class="btn btn-primary btn-sm">
                                                   <i class="fas fa-download"></i>
                                                </a>
                                             </td>
                                          </tr>
                                          <?php
                                          $sn = $sn + 1;
                                       }
                                    }
                                    ?>
                                 </tbody>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>

                     <!-- posting Start -->
                     <div class="col-sm-12 mb-3">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title"><u>Programming / Training / Carrier Progress</u></h5>
                              <div class="table-responsive">
                                 <table id="zero_config8" class="table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th><b>S.No</b></th>
                                          <th><b>Date</b></th>
                                          <th><b>ICT</b></th>
                                          <th><b>HackerRank</b></th>
                                          <th><b>SkillRack</b></th>
                                          <th><b>Action Taken</b></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $query = "SELECT * FROM straining where sid='$fid'";
                                       $query_run = mysqli_query($db, $query);

                                       if (mysqli_num_rows($query_run) > 0) {
                                          $sn = 1;
                                          foreach ($query_run as $student) {

                                             ?>
                                             <tr>
                                                <td><?= $sn ?></td>
                                                <td><?= $student['date'] ?></td>
                                                <td><?= $student['ict'] ?></td>
                                                <td><?= $student['hack'] ?></td>
                                                <td><?= $student['skill'] ?></td>
                                                <td><?= $student['action'] ?> </td>
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
                     <!-- posting end -->
                     <!-- placement Start -->
                     <div class="col-sm-12 mb-3">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title"><u>Placement Details</u></h5>
                              <div class="table-responsive">
                                 <table id="zero_config9" class="table table-striped table-bordered">
                                    <thead>
                                       <tr>
                                          <th><b>S.No</b></th>
                                          <th><b>Date</b></th>
                                          <th><b>Name of the Company</b></th>
                                          <th><b>Designation & Salary Package</b></th>
                                          <th><b>Performance / Result</b></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $query = "SELECT * FROM splacement where sid='$fid'";
                                       $query_run = mysqli_query($db, $query);

                                       if (mysqli_num_rows($query_run) > 0) {
                                          $sn = 1;
                                          foreach ($query_run as $student) {

                                             ?>
                                             <tr>
                                                <td><?= $sn ?></td>
                                                <td><?= $student['date'] ?></td>
                                                <td><?= $student['np'] ?></td>
                                                <td><?= $student['ds'] ?></td>
                                                <td><?= $student['pr'] ?></td>
                                             </tr>
                                             <?php
                                             $sn = $sn + 1;
                                          }
                                       }
                                       ?>
                                    </tbody>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>

                        <!-- MArk Start -->
                        <div class="col-sm-12 mb-3">
                           <div class="card">
                              <div class="card-body">
                                 <h5 class="card-title"><u>Exam Marks and Attendance Details</u></h5>
                                 <!-- Nav tabs -->
                                 <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#sem1"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 1</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem2"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 2</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem3"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 3</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem4"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 4</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem5"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 5</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem6"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 6</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem7"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 7</b></span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sem8"
                                          role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down"><i
                                                class="ti-pencil-alt"></i><b> Semester 8</b></span></a> </li>
                                 </ul>
                                 <!--tab conetent -->
                                 <div class="tab-content tabcontent-border">
                                    <!-- Tab 1 -->
                                    <div class="tab-pane active p-20" id="sem1" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 1 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss1 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='1'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 1 end -->
                                    <!-- Tab 2 -->
                                    <div class="tab-pane  p-20" id="sem2" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 2 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss2 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='2'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 2 end -->
                                    <!-- Tab 3 -->
                                    <div class="tab-pane p-20" id="sem3" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 3 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss3 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='3'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 3 end -->
                                    <!-- Tab 4 -->
                                    <div class="tab-pane p-20" id="sem4" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 4 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss4 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='4'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 4 end -->
                                    <!-- Tab 5 -->
                                    <div class="tab-pane p-20" id="sem5" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 5 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss5 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='5'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 5 end -->
                                    <!-- Tab 6 -->
                                    <div class="tab-pane p-20" id="sem6" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 6 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss6 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='6'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 6 end -->
                                    <!-- Tab 7 -->
                                    <div class="tab-pane p-20" id="sem7" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 7 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss7 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='7'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 7 end -->
                                    <!-- Tab 8 -->
                                    <div class="tab-pane p-20" id="sem8" role="tabpanel">
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>Semester 8 Exam Details
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="myTables1ms1" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>S.No</b></th>
                                                               <th><b>Subject Name</b></th>
                                                               <th><b>MS 1 / CIA 1</b></th>
                                                               <th><b>MS 2 / CIA 2</b></th>
                                                               <th><b>Preparatory(R2018 alone)</b></th>
                                                               <th><b>Semester</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM ss8 where sid='$fid'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $sn ?></td>
                                                                     <td><?= $student['sname'] ?></td>
                                                                     <td><?= $student['ms1'] ?></td>
                                                                     <td><?= $student['ms2'] ?></td>
                                                                     <td><?= $student['prep'] ?></td>
                                                                     <td align="center"><?= $student['sem'] ?></td>
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
                                       <!-- CGAP/SGPA/Attendance -->
                                       <div class="row">
                                          <div class="col-md-12">
                                             <div class="card">
                                                <div class="card-header">
                                                   <h4>SGPA /CGPA / Attendance
                                                   </h4>
                                                </div>
                                                <div class="card-body">
                                                   <div class="table-responsive">
                                                      <table id="sem1sgpa" class="table table-bordered table-striped">
                                                         <thead>
                                                            <tr>
                                                               <th><b>SGPA</b></th>
                                                               <th><b>CGPA</b></th>
                                                               <th><b>Current Arrear</b></th>
                                                               <th><b>Overall Arrear</b></th>
                                                               <th><b>MS 1 / CIA 1-Attendance</b></th>
                                                               <th><b>MS 2 / CIA 2-Attendance</b></th>
                                                               <th><b>Prep-Attendance </b></th>
                                                               <th><b>Overall-Attendance</b></th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>
                                                            <?php
                                                            $query = "SELECT * FROM sgrade where sid='$fid' and sem='8'";
                                                            $query_run = mysqli_query($db, $query);

                                                            if (mysqli_num_rows($query_run) > 0) {
                                                               $sn = 1;
                                                               foreach ($query_run as $student) {

                                                                  ?>
                                                                  <tr>
                                                                     <td><?= $student['sgpa'] ?></td>
                                                                     <td><?= $student['cgpa'] ?></td>
                                                                     <td><?= $student['CA'] ?></td>
                                                                     <td><?= $student['OA'] ?></td>
                                                                     <td><?= $student['ms1a'] ?></td>
                                                                     <td><?= $student['ms2a'] ?></td>
                                                                     <td align="center"><?= $student['prepa'] ?></td>
                                                                     <td align="center"><?= $student['ova'] ?></td>
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
                                    <!-- Tab 8 end -->
                                 </div>
                                 <!--tab content end -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>



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
                  <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


                  <script>
                     /****************************************
                      *       Basic Table                   *
                      ****************************************/
                     $('#zero_config').DataTable();
                     $('#zero_config1').DataTable();
                     $('#zero_config2').DataTable();
                     $('#zero_config3').DataTable();
                     $('#zero_config4').DataTable();
                     $('#zero_config5').DataTable();
                     $('#zero_config6').DataTable();
                     $('#zero_config7').DataTable();
                     $('#zero_config8').DataTable();
                     $('#zero_config9').DataTable();
                  </script>


                  <script>
                     //prize
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

                     //intern
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


                     //Co-Curricular

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

                                 // $("#imageco").attr("src", res.data.cert);

                                 $('#studentViewModalco').modal('show');
                              }
                           }
                        });
                     });

                     //extra-curricular

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
                  </script>
   </body>

   </html>

   <?php
} else {
   ?>
   <script>
      swal.fire({
         icon: 'error',
         title: 'ID not Found',
         text: 'Note: Only you can view your mentees'
      });
   </script>
   <?php
}
?>