<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>MKCE - BIO data Application</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-nqK/RM+vnku5IuQZGmLGjU3/5IftKQgPRTVvpW4X8Gh6JFvgVTET30SX3P3btNJ4UOVDB5tnIGEmlsckNz9YjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->

                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text ms-2">
                            <!-- dark Logo text -->
                            <img src="assets/images/srms.png" alt="homepage" class="light-logo" />
                        </span>

                    </a>

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                        </li>

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="index2.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31" />
                            </a>

                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Bio Data</span></a>
                        </li>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <!-- <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Dashboard
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div> -->
            </div>

            <div class="container-fluid card">
                <h1 class="mb-4 p-3 bg-primary text-white rounded">Application Form for Recruitment of Faculty Position</h1>
                <form id="bioDataForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="postApplied" class="form-label">Post Applied For <span style="color:red;">*</span></label>
                            <select class="form-control select-arrow" id="postApplied" name="post_applied_for" required>
                                <option value="">Select Post</option>
                                <option value="Professor">Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Placement Aptitude Trainer">Placement Aptitude Trainer</option>
                                <option value="Placement Communication Trainer">Placement Communication Trainer</option>
                                <option value="Technical Trainer">Technical Trainer</option>
                                <option value="Lab Technician">Lab Technician</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="otherPostContainer" style="display: none;">
                            <label for="otherPost" class="form-label">Please Specify</label>
                            <input type="text" class="form-control" id="otherPost" name="other_post">
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">Department <span style="color:red;">*</span></label>
                            <select class="form-control select-arrow" id="department" name="department" required>
                                <option value="">Select department</option>
                                <option value="AI/CSE/CSBS/IT">AI / CSE / CSBS / IT</option>
                                <!-- <option value="Artificial Intelligence and Machine Learning">Artificial Intelligence and Machine
                                  Learning</option> -->
                                <option value="Civil">Civil Engineering</option>
                                <!-- <option value="Computer Science and Business Systems">Computer Science and Business Systems
                              </option>
                              <option value="Computer Science and Engineering">Computer Science and Engineering</option> -->

                                <option value="EEE">Electrical and Electronics Engineering</option>
                                <option value="EE(VLSI)">Electronics Engineering (VLSI Design)</option>
                                <option value="ECE">Electronics and Communication Engineering</option>
                                <!-- <option value="Information Technology">Information Technology</option> -->
                                <option value="MECH">Mechanical Engineering</option>
                                <option value="MBA">Master of Business Administration</option>
                                <option value="MCA">Master of Computer Applications</option>
                                <option value="Placement">Placement</option>
                                <option value="Maths">Maths</option>
                                <option value="English">English</option>
                                <option value="Physics">Physics</option>
                                <option value="Chemistry">Chemistry</option>
                                <option value="Tamil">Tamil</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">D.O.B <span style="color:red;">*</span></label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone No. <span style="color:red;">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span style="color:red;">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fatherName" class="form-label">Father's Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="fatherName" name="father_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="motherName" class="form-label">Mother's Name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="motherName" name="mother_name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="familyStatus" class="form-label">Family Status (No. of Brothers & Sisters) <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="familyStatus" name="family_status" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Occupation Details <span style="color:red;">*</span></label>
                        <input type="text" class="form-control mb-2" placeholder="Father's Occupation" name="father_occupation" required>
                        <input type="text" class="form-control mb-2" placeholder="Mother's Occupation" name="mother_occupation" required>
                        <input type="text" class="form-control" placeholder="Brothers / Sisters Occupation" name="siblings_occupation">
                    </div>

                    <div class="mb-3">
                        <label for="permanentAddress" class="form-label">Permanent Address <span style="color:red;">*</span></label>
                        <textarea class="form-control" id="permanentAddress" rows="3" name="permanent_address" required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="religion" class="form-label">Religion <span style="color:red;">*</span></label>
                            <select class="form-control select-arrow" id="religion" name="religion" required>
                                <option value="">Select Religion</option>
                                <option value="Hinduism">Hinduism</option>
                                <option value="Christianity">Christianity</option>
                                <option value="Islam">Islam</option>
                                <option value="Buddhism">Buddhism</option>
                                <option value="Sikhism">Sikhism</option>
                                <option value="Judaism">Judaism</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="community" class="form-label">Community <span style="color:red;">*</span></label>
                            <div class="position-relative">
                                <select class="form-control select-arrow" id="community" name="community" required>
                                    <option value="">Select Community</option>
                                    <option value="BC">BC</option>
                                    <option value="BCM">BCM</option>
                                    <option value="MBC">MBC</option>
                                    <option value="OC">OC</option>
                                    <option value="SC/ST">SC / ST</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="caste" class="form-label">Caste/Sub Caste <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="caste" name="caste" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Marital Status <span style="color:red;">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="marital_status" id="married" value="Married">
                            <label class="form-check-label" for="married">Married</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="marital_status" id="unmarried" value="Unmarried">
                            <label class="form-check-label" for="unmarried">Unmarried</label>
                        </div>
                    </div>

                    <div id="spouseDetails" style="display: none;">
                        <h4>If Married, details of spouse</h4>
                        <div class="mb-3">
                            <label for="spouseName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="spouseName" name="spouse_name">
                        </div>
                        <div class="mb-3">
                            <label for="spouseQualification" class="form-label">Qualification</label>
                            <input type="text" class="form-control" id="spouseQualification" name="spouse_qualification">
                        </div>
                        <div class="mb-3">
                            <label for="spouseOccupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="spouseOccupation" name="spouse_occupation">
                        </div>
                        <div class="mb-3">
                            <label for="children" class="form-label">No. of Children</label>
                            <input type="text" class="form-control" id="children" name="children_info">
                        </div>
                        <div class="mb-3">
                            <label for="children_age" class="form-label">Children's Age</label>
                            <input type="text" class="form-control" id="children_age" name="children_age">
                        </div>
                    </div>
                    <h3 class="mb-4 p-3 bg-info text-white rounded">Educational Qualification</h3>
                    <!-- <h3 class="mt-4" style="color: red;">Educational Qualification</h3> -->
                    <div style="overflow-x:auto;">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Details Specialisation</th>
            <th>Specialization</th>
            <th>Name of the Institution</th>
            <th>Name of the Place</th>
            <th>Year of Passing</th>
            <th>% of Marks obtained</th>
            <th>Class Obtained</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>X Std</td>
            <td>
                <input type="text" class="form-control" name="x_std_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="x_std_institution" id="x_std_institution" oninput="checkPlace('x_std_institution', 'x_std_place','x_std_year','x_std_percentage','x_std_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="x_std_place" id="x_std_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="x_std_year" id="x_std_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="x_std_percentage" id="x_std_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="x_std_class_obtained" id="x_std_class_obtained"/>
            </td>
        </tr>
        <tr>
            <td>XII Std</td>
            <td>
                <input type="text" class="form-control" name="xii_std_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="xii_std_institution" id="xii_std_institution" oninput="checkPlace('xii_std_institution', 'xii_std_place','xii_std_year','xii_std_percentage','xii_std_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="xii_std_place" id="xii_std_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="xii_std_year" id="xii_std_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="xii_std_percentage" id="xii_std_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="xii_std_class_obtained" id="xii_std_class_obtained"/>
            </td>
        </tr>
        <tr>
            <td>Diploma</td>
            <td>
                <input type="text" class="form-control" name="diploma_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="diploma_institution" id="diploma_institution" oninput="checkPlace('diploma_institution', 'diploma_place','diploma_year','diploma_percentage','diploma_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="diploma_place" id="diploma_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="diploma_year" id="diploma_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="diploma_percentage" id="diploma_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="diploma_class_obtained" id="diploma_class_obtained"/>
            </td>
        </tr>
        <tr>
            <td>UG</td>
            <td>
                <input type="text" class="form-control" name="ug_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="ug_institution" id="ug_institution" oninput="checkPlace('ug_institution', 'ug_place','ug_year','ug_percentage','ug_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="ug_place" id="ug_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="ug_year" id="ug_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="ug_percentage" id="ug_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="ug_class_obtained" id="ug_class_obtained"/>
            </td>
        </tr>
        <tr>
            <td>PG</td>
            <td>
                <input type="text" class="form-control" name="pg_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="pg_institution" id="pg_institution" oninput="checkPlace('pg_institution', 'pg_place','pg_year','pg_percentage','pg_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="pg_place" id="pg_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="pg_year" id="pg_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="pg_percentage" id="pg_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="pg_class_obtained" id="pg_class_obtained"/>
            </td>
        </tr>
        <tr>
            <td>M.Phil</td>
            <td>
                <input type="text" class="form-control" name="mphil_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="mphil_institution" id="mphil_institution" oninput="checkPlace('mphil_institution', 'mphil_place','mphil_year','mphil_percentage','mphil_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="mphil_place" id="mphil_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="mphil_year" id="mphil_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="mphil_percentage" id="mphil_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="mphil_class_obtained" id="mphil_class_obtained"/>
            </td>
        </tr>
        <tr>
            <td>Ph.D</td>
            <td>
                <input type="text" class="form-control" name="phd_specialization" />
            </td>
            <td>
                <input type="text" class="form-control" name="phd_institution" id="phd_institution" oninput="checkPlace('phd_institution', 'phd_place','phd_year','phd_percentage','phd_class_obtained')" />
            </td>
            <td>
                <input type="text" class="form-control" name="phd_place" id="phd_place" />
            </td>
            <td>
                <input type="text" class="form-control" name="phd_year" id="phd_year"/>
            </td>
            <td>
                <input type="text" class="form-control" name="phd_percentage" id="phd_percentage"/>
            </td>
            <td>
                <input type="text" class="form-control" name="phd_class_obtained" id="phd_class_obtained"/>
            </td>
        </tr>
    </tbody>
</table>

                    </div>
                    <div class="mb-3">
                        <label for="additionalQualification" class="form-label">Additional Qualification</label>
                        <textarea class="form-control" id="additionalQualification" rows="3" name="additional_qualification"></textarea>
                    </div>
                    <h3 class="mb-4 p-3 bg-info text-white rounded">Experience </h3>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="ugExperience" class="form-label">After UG (in Years)</label>
                            <input type="number" step="0.1" class="form-control" id="ugExperience" name="ug_experience" onchange="calculateTotalExperience()">
                        </div>
                        <div class="col-md-3">
                            <label for="pgExperience" class="form-label">After PG (in Years)</label>
                            <input type="number" step="0.1" class="form-control" id="pgExperience" name="pg_experience" onchange="calculateTotalExperience()">
                        </div>
                        <div class="col-md-2">
                            <label for="phdExperience" class="form-label">After Ph.D (in Years)</label>
                            <input type="number" step="0.1" class="form-control" id="phdExperience" name="phd_experience" onchange="calculateTotalExperience()">
                        </div>

                        <div class="col-md-2">
                            <label for="phdExperience" class="form-label">Industry Experience (in Years)</label>
                            <input type="number" step="0.1" class="form-control" id="indExperience" name="industry_experience" onchange="calculateTotalExperience()">
                        </div>
                        <div class="col-md-3">
                            <label for="totalExperience" class="form-label">Total Experience (in Years)</label>
                            <input type="number" step="0.1" class="form-control" id="totalExperience" name="total_experience" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="salaryExpected" class="form-label">Salary Expected <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="salaryExpected" name="salary_expected" required>
                        </div>
                        <div class="col-md-4">
                            <label for="lastsalary" class="form-label">Last Salary Drawn <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" id="lastsalary" name="lastsalary" required>
                        </div>
                        <div class="col-md-4">
                            <label for="photo" class="form-label">Upload your Photo <span style="color:red;">*</span></label>
                            <label for="">(upload less than 2 mb)</label>
                            <input type="file" class="form-control" id="photo" name="photo_file_path" accept="image/*" onchange="validatePhoto()" required>
                            <small id="photoError" class="text-danger" style="display: none;">Invalid file. Please upload an
                                image file (JPEG, PNG, GIF) less than 2 MB.</small>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <footer class="footer text-center">
                2024 © <b>M.Kumarasamy College of Engineering</b> All Rights Reserved. Developed and Maintained by <span><b>Technology Innovation Hub(TIH)</b></span>
            </footer>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>

    <script>
        function calculateTotalExperience() {
            const ugExperience = parseFloat(document.getElementById('ugExperience').value) || 0;
            const pgExperience = parseFloat(document.getElementById('pgExperience').value) || 0;
            const phdExperience = parseFloat(document.getElementById('phdExperience').value) || 0;

            const totalExperience = ugExperience + pgExperience + phdExperience;
            document.getElementById('totalExperience').value = totalExperience.toFixed(1);
        }
    </script>

    <script>
        function validatePhoto() {
            const photoInput = document.getElementById('photo');
            const photoError = document.getElementById('photoError');
            const file = photoInput.files[0];

            if (file) {
                const fileSize = file.size / 1024 / 1024; // in MB
                const fileType = file.type;

                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

                if (fileSize > 2 || !validImageTypes.includes(fileType)) {
                    photoError.style.display = 'block';
                    photoInput.value = ''; // Clear the input
                } else {
                    photoError.style.display = 'none';
                }
            }
        }

        document.getElementById('applicationForm').addEventListener('submit', function(event) {
            const photoError = document.getElementById('photoError');
            if (photoError.style.display === 'block') {
                event.preventDefault(); // Prevent form submission if there is an error
                alert('Please correct the errors in the form before submitting.');
            }
        });
    </script>

<script>
    function checkPlace(institutionId, placeId, yearId, markId, classID) {
        const institution = document.getElementById(institutionId);
        const place = document.getElementById(placeId);
        const year = document.getElementById(yearId);
        const mark = document.getElementById(markId);
        const oclass = document.getElementById(classID);

        if (institution.value.trim() !== "") {
            place.setAttribute("required", "required");
            year.setAttribute("required", "required");
            mark.setAttribute("required", "required");
            oclass.setAttribute("required", "required");
        } else {
            place.removeAttribute("required");
            year.removeAttribute("required");
            mark.removeAttribute("required");
            oclass.removeAttribute("required");
        }
    }
</script>

    <script>
        $(document).ready(function() {
            $('input[name="marital_status"]').change(function() {
                if ($(this).val() == 'Married') {
                    $('#spouseDetails').show();
                } else {
                    $('#spouseDetails').hide();
                }
            });

            $('#postApplied').change(function() {
                if ($(this).val() === 'Others') {
                    $('#otherPostContainer').show();
                } else {
                    $('#otherPostContainer').hide();
                    $('#otherPost').val('');
                }
            });

            $('#bioDataForm').submit(function(event) {
    event.preventDefault();

    var formData = new FormData(this);
    var postApplied = formData.get('post_applied_for');
    if (postApplied === 'Others') {
        var otherPost = formData.get('other_post');
        formData.set('post_applied_for', otherPost);
    }
    $.ajax({
        url: 'insert.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: jsonResponse.message
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bioDataForm')[0].reset();
                        $('#otherPostContainer').hide();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: jsonResponse.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Form submission failed: ' + error
            });
        }
    });
});

        });
    </script>
</body>

</html>