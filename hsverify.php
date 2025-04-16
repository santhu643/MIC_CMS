<!DOCTYPE html>
<html>

<head>
  <link href="dist/css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <style>
    .action-menu {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      padding: 20px;
      max-width: 1600px;
      margin: 0 auto;
    }

    .menu-btn {
      padding: 12px 24px;
      border: none;
      border-radius: 25px;
      background-color: #f0f0f0;
      color: #555;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 15px;
      font-weight: 500;
      outline: none;
    }

    .menu-btn:hover {
      background-color: #e0e0e0;
      transform: translateY(-2px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .menu-btn.active-btn {
      background-color: #4a90e2;
      color: white;
      box-shadow: 0 2px 10px rgba(74, 144, 226, 0.3);
    }

    .content-section {
      max-width: 1600px;
      margin: 0 auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      display: none;
    }

    .content-section.active-content {
      display: block;
      animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .menu-btn {
        padding: 10px 20px;
        font-size: 14px;
      }
    }

  </style>
</head>

<body>

  <div class="modal fade" id="ViewModal4" tabindex="-1" aria-labelledby="documentPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="documentPreviewLabel">Document Preview
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><b>X</b></button>
        </div>
        <div class="modal-body">
          <!-- Container for image/PDF -->
          <div id="documentContainer" class="text-center">
            <!-- Content will be loaded here -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="studentViewModal4" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Certificate</h5>
                <button type="button" class="btn" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="mdi mdi-close"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="imagepr" src="" alt="Certificate" class="img-fluid" style="max-width:80%; max-height:70vh;">
                <iframe id="pdfpr" src="" style="width:100%; height:70vh; border:none; display:none;"></iframe>
                <div id="noContentMessage" class="alert alert-info" style="display:none;">
                    No content available
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





  <div class="action-menu">
    <button class="menu-btn active-btn" data-target="prizes">International Certifications</button>
    <button class="menu-btn" data-target="projects">Projects</button>
    <button class="menu-btn" data-target="internship">Internship / Course</button>
    <button class="menu-btn" data-target="language">International Language</button>
    <button class="menu-btn" data-target="cocurricular">Co-Curricular</button>
    <button class="menu-btn" data-target="extracurricular">Extra-Curricular</button>
    <button class="menu-btn" data-target="placement">Placement</button>
  </div>

  <div id="prizes" class="content-section active-content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>International Certifications
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myTablepr" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Name of the Certifications</b></th>
                    <th><b>Duration</b></th>
                    <th><b>Organizer</b></th>
                    <th><b>View</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get prize details for each student
                      $query2 = "SELECT * FROM s_i_certification where sid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $prize) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>
                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $prize['ayear'] ?></td>
                            <td><?= $prize['cname'] ?></td>
                            <td><?= $prize['duration'] ?></td>
                            <td><?= $prize['organiser'] ?></td>
                            <!-- <td align="center">
                              <button type="button" class="btnimglang btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ViewModal4" data-file="<?= $prize['cert']; ?>">
                                View
                              </button>
                            </td> -->


                            <td align="center">
                              <button type="button" id="ledonof" data-uid="<?= $prize['uid']; ?>" data-cert="s_i_certification"
                                class="btnimgcert btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#studentViewModal4">
                                View
                              </button>
                            </td>

                            <td align="center">
                              <?php if ($prize['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $prize['uid']; ?>"
                                  class="approvepcBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="projects" class="content-section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Projects Details
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="project" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Semester</b></th>
                    <th><b>Title of the project</b></th>
                    <th><b>Github link</b></th>
                    <th><b>Remarks</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get project details for each student
                      $query2 = "SELECT * FROM sproject where sid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $project) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>
                     
                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $project['ayear'] ?></td>
                            <td><?= $project['semester'] ?></td>
                            <td><?= $project['title'] ?></td>
                            <td><?= $project['github'] ?></td>
                            <td><?= $project['remark'] ?></td>
                            <td align="center">
                              <?php if ($project['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $project['uid']; ?>"
                                  class="approveprojBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="internship" class="content-section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Internship Details
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myinternship" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Name of the Program / Title</b></th>
                    <th><b>Type</b></th>
                    <th><b>Organizer</b></th>
                    <th><b>Duration</b></th>
                    <th><b>Remarks</b></th>
                    <th><b>View</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get project details for each student
                      $query2 = "SELECT * FROM sintern where sid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $internship) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>

                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $internship['ayear'] ?></td>
                            <td><?= $internship['iname'] ?></td>
                            <td><?= $internship['type'] ?></td>
                            <td><?= $internship['org'] ?></td>
                            <td><?= $internship['dur'] ?></td>
                            <td><?= $internship['rem'] ?></td>
                            <!-- <td align="center">
                              <button type="button" class="btnimglang btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ViewModal4" data-file="<?= $internship['cert']; ?>">
                                View
                              </button>
                            </td> -->

                            <!-- <td align="center"><button type="button" id="ledonof" value="<?= $internship['uid']; ?>"
                                class="btnimgcert btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#studentViewModal4">View</button>
                            </td> -->
                            <td align="center">
                              <button type="button" id="ledonof" data-uid="<?= $internship['uid']; ?>" data-cert="sintern"
                                class="btnimgcert btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#studentViewModal4">
                                View
                              </button>
                            </td>

                            <td align="center">
                              <?php if ($internship['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $internship['uid']; ?>"
                                  class="approveinternBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="language" class="content-section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Language Details
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="mylang" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Language</b></th>
                    <th><b>Level</b></th>
                    <th><b>View</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get project details for each student
                      $query2 = "SELECT * FROM slang where uid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $internship) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>

                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $internship['ayear'] ?></td>
                            <td><?= $internship['lang'] ?></td>
                            <td><?= $internship['level'] ?></td>
                            <!-- <td align="center">
                              <button type="button" class="btnimglang btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ViewModal4" data-file="<?= $internship['cert']; ?>">
                                View
                              </button>
                            </td> -->

                            
                            <td align="center">
                              <button type="button" id="ledonof" data-uid="<?= $internship['uid']; ?>" data-cert="slang"
                                class="btnimgcert btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#studentViewModal4">
                                View
                              </button>
                            </td>

                            <td align="center">
                              <?php if ($internship['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $internship['id']; ?>"
                                  class="approvelangBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="cocurricular" class="content-section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Cocurricular Details
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="mycoco" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Name of the Event</b></th>
                    <th><b>Level</b></th>
                    <th><b>Organizer</b></th>
                    <th><b>Prize</b></th>
                    <th><b>View</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get project details for each student
                      $query2 = "SELECT * FROM scocu where sid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $internship) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>

                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $internship['ayear'] ?></td>
                            <td><?= $internship['event'] ?></td>
                            <td><?= $internship['level'] ?></td>
                            <td><?= $internship['organiser'] ?></td>
                            <td><?= $internship['prize'] ?></td>
                            <!-- <td align="center">
                              <button type="button" class="btnimglang btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ViewModal4" data-file="<?= $internship['cert']; ?>">
                                View
                              </button>
                            </td> -->

                            <td align="center">
                              <button type="button" id="ledonof" data-uid="<?= $internship['uid']; ?>" data-cert="scocu"
                                class="btnimgcert btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#studentViewModal4">
                                View
                              </button>
                            </td>

                            <td align="center">
                              <?php if ($internship['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $internship['uid']; ?>"
                                  class="approvecocoBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="extracurricular" class="content-section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Extracurricular Details
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myextra" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Name of the Event</b></th>
                    <th><b>Level</b></th>
                    <th><b>Organizer</b></th>
                    <th><b>Prize</b></th>
                    <th><b>View</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get project details for each student
                      $query2 = "SELECT * FROM st_extra where sid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $internship) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>

                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $internship['ayear'] ?></td>
                            <td><?= $internship['event'] ?></td>
                            <td><?= $internship['level'] ?></td>
                            <td><?= $internship['organiser'] ?></td>
                            <td><?= $internship['prize'] ?></td>
                            <!-- <td align="center">
                              <button type="button" class="btnimglang btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ViewModal4" data-file="<?= htmlspecialchars($internship['cert']); ?>">
                                View
                              </button>
                            </td> -->

                            <td align="center">
                              <button type="button" id="ledonof" data-uid="<?= $internship['uid']; ?>" data-cert="st_extra"
                                class="btnimgcert btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#studentViewModal4">
                                View
                              </button>
                            </td>

                            <td align="center">
                              <?php if ($internship['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $internship['uid']; ?>"
                                  class="approveextraBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="placement" class="content-section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Placement Details
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="myplace" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th><b>S.No</b></th>
                    <th><b>Name</b></th>
                    <th><b>Academic Year</b></th>
                    <th><b>Date</b></th>
                    <th><b>Name of the Company</b></th>
                    <th><b>Designation & Salary Package</b></th>
                    <th><b>Result</b></th>
                    <th align="center"><b>Action</b></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM student where mentor='$s'";
                  $query_run = mysqli_query($db, $query);
                  $sss = 1;
                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $student) {
                      $fid = $student['sid'];
                      $sname2 = $student['sname'];

                      // Get project details for each student
                      $query2 = "SELECT * FROM splacement where sid='$fid'";
                      $query_run2 = mysqli_query($db, $query2);

                      if (mysqli_num_rows($query_run2) > 0) {
                        foreach ($query_run2 as $internship) {
                          ?>
                          <tr>
                            <td><?= $sss ?></td>

                            <td><?= $fid . '-' . $sname2 ?></td>
                            <td><?= $internship['ayear'] ?></td>
                            <td><?= $internship['date'] ?></td>
                            <td><?= $internship['np'] ?></td>
                            <td><?= $internship['ds'] ?></td>
                            <td><?= $internship['pr'] ?></td>
                            <td align="center">
                              <?php if ($internship['status'] == 1): ?>
                                <button type="button" class="btn btn-primary btn-sm">Approved</button>
                              <?php else: ?>
                                <button type="button" value="<?= $internship['uid']; ?>"
                                  class="approveplaceBtn btn btn-success btn-sm">Approve</button>
                              <?php endif; ?>
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
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const menuBtns = document.querySelectorAll('.menu-btn');
      const contentSections = document.querySelectorAll('.content-section');

      menuBtns.forEach(btn => {
        btn.addEventListener('click', function () {
          // Remove active class from all buttons
          menuBtns.forEach(b => b.classList.remove('active-btn'));
          // Add active class to clicked button
          this.classList.add('active-btn');

          // Hide all content sections
          contentSections.forEach(section => section.classList.remove('active-content'));
          // Show the selected content section
          const targetId = this.getAttribute('data-target');
          document.getElementById(targetId).classList.add('active-content');
        });
      });
    });
  </script>

  <script>
    function initializeViewButtons() {
      const viewButtons = document.querySelectorAll('.btnimglang');
      viewButtons.forEach(button => {
        button.addEventListener('click', function () {
          const container = document.getElementById('documentContainer');
          container.innerHTML = ''; // Clear previous content

          // Get the file URL directly from the data attribute
          const fileUrl = this.getAttribute('data-file');
          const fileExtension = fileUrl.split('.').pop().toLowerCase();

          if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
            // If it's an image
            const img = document.createElement('img');
            img.src = fileUrl;
            img.className = 'img-fluid';
            img.style.maxHeight = '70vh';
            container.appendChild(img);
          } else if (fileExtension === 'pdf') {
            // If it's a PDF
            const embed = document.createElement('embed');
            embed.src = fileUrl;
            embed.type = 'application/pdf';
            embed.style.width = '100%';
            embed.style.height = '70vh';
            container.appendChild(embed);
          } else {
            container.innerHTML = '<p class="text-danger">Unsupported file type</p>';
          }
        });
      });
    }

    // Initialize handlers on page load
    document.addEventListener('DOMContentLoaded', function () {
      initializeViewButtons();
    });

    // prize approve
    $(document).on('click', '.approvepcBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_i_certification': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                // $('#myTablepr').load(location.href + " #myTablepr");

                $('#myTablepr').load(location.href + " #myTablepr > *", function () {
                  // Reinitialize view buttons after table reload
                  initializeViewButtons();
                });
              }
            }
          });
        }
      });
    });

    // project approve

    $(document).on('click', '.approveprojBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_project': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                // $('#project').load(location.href + " #project");
                $('#project').load(location.href + " #project > *", function () {
                  // Reinitialize view buttons after table reload
                  initializeViewButtons();
                });
              }
            }
          });
        }
      });
    });

    // intern approve

    $(document).on('click', '.approveinternBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_intern': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                // $('#myinternship').load(location.href + " #myinternship");
                $('#myinternship').load(location.href + " #myinternship > *", function () {
                  // Reinitialize view buttons after table reload
                  initializeViewButtons();
                });
              }
            }
          });
        }
      });
    });

    // language approve

    $(document).on('click', '.approvelangBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_lang': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                // $('#mylang').load(location.href + " #mylang");

                $('#mylang').load(location.href + " #mylang > *", function () {
                  // Reinitialize view buttons after table reload
                  initializeViewButtons();
                });
              }
            }
          });
        }
      });
    });

    // coco approve

    $(document).on('click', '.approvecocoBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_coco': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                $('#mycoco').load(location.href + " #mycoco > *", function () {
                  // Reinitialize view buttons after table reload
                  initializeViewButtons();
                });


                // $('#mycoco').load(location.href + " #mycoco");
              }
            }
          });
        }
      });
    });

    // extra approve

    $(document).on('click', '.approveextraBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_extra': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                $('#myextra').load(location.href + " #myextra > *", function () {
                  // Reinitialize view buttons after table reload
                  initializeViewButtons();
                });


                // $('#mycoco').load(location.href + " #mycoco");
              }
            }
          });
        }
      });
    });


    // extra place

    $(document).on('click', '.approveplaceBtn', function (e) {
      e.preventDefault();

      Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var student_id5 = $(this).val();
          $.ajax({
            type: "POST",
            url: "scode.php",
            data: {
              'approve_place': true,
              'student_id5': student_id5
            },
            success: function (response) {
              var res = jQuery.parseJSON(response);
              if (res.status == 500) {
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: res.message
                });
              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Approved!',
                  text: res.message
                });

                //   $('#myplace').load(location.href + " #myplace > *", function() {
                //   // Reinitialize view buttons after table reload
                //   initializeViewButtons();
                // });


                $('#myplace').load(location.href + " #myplace");
              }
            }
          });
        }
      });
    });

    // image view
    $(document).on('click', '.btnimgcert', function () {
    var student_id222 = $(this).data('uid');
    var certification = $(this).data('cert');
    $.ajax({
        type: "GET",
        url: "scode.php",
        data: { student_idii: student_id222, certification: certification },
        success: function (response) {
            var res = jQuery.parseJSON(response);
            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                // Hide PDF and message first
                $('#pdfpr').hide();
                $('#noContentMessage').hide();

                // Determine content type
                if (res.data.cert.toLowerCase().endsWith('.pdf')) {
                    $('#pdfpr').attr('src', res.data.cert).show();
                    $('#imagepr').hide();
                } else {
                    $('#imagepr').attr("src", res.data.cert).show();
                    $('#pdfpr').hide();
                }

                // Show the modal
                $('#studentViewModal4').modal('show');
            }
        }
    });
});


  </script>
</body>

</html>