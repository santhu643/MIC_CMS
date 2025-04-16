<?php
require 'config.php';
include("session.php");

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
    <link rel="stylesheet" type="text/css"
        href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="dist/css/style.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Alertify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Alertify default theme (optional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <!-- Alertify JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .alertify-notifier .ajs-error {
            background: linear-gradient(to bottom right, #003300 16%, #ff0000 100%);
            color: #ffffff;
        }

        .alertify-notifier .ajs-success {
            background: blue;
            color: #ffffff;
        }


        /* Modal container styling */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            background-color: rgba(0, 0, 0, 0.8);
            /* Black background with opacity */
            overflow: auto;
            /* Enable scrolling if needed */
            backdrop-filter: blur(1px);
            /* Add blur to background */
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            /* 5% from the top and centered */
            padding: 0;
            border-radius: 10px;
            width: 60%;
            /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            animation: slideDown 0.5s ease-out;
            overflow: hidden;
            /* Hide content that overflows */
        }

        /* Modal Header */
        .modal-header {
            background-color: #007bff;
            /* Custom header color */
            color: white;
            padding: 15px;
            font-size: 24px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        /* Close button */
        .modal-header .close {
            color: white;
            float: right;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
        }

        .modal-header .close:hover {
            color: #ff5f5f;
        }

        /* Modal body */
        .modal-body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
            background-color: #f8f9fa;
        }

        /* Modal footer */
        .modal-footer {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            background-color: #f1f1f1;
        }

        /* Modal buttons */
        .modal-footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal-footer .modal-button-primary {
            background-color: #28a745;
            color: white;
        }

        .modal-footer .modal-button-secondary {
            background-color: #6c757d;
            color: white;
        }

        .modal-footer button:hover {
            opacity: 0.9;
        }

        .table thead th {
            background: linear-gradient(to bottom right, #cc66ff 1%, #0033cc 100%) !important;
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 500;
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
                    <a class="navbar-brand" href="main">
                        <span class="logo-text">
                            <img src="assets/images/srms.png" alt="homepage" class="light-logo" />
                        </span>
                    </a>
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

                                <a class="dropdown-item" href="Logout.php"><i class="ti-power-off m-r-5 m-l-5"></i>
                                    Logout</a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
        include("side.php");

        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Faculty Wallet HR</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Faculty Wallet HR</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid card">
                <div class="container-fluid mt-4">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="add-subjects-tab" data-toggle="tab" href="#add-subjects"
                                role="tab" aria-controls="add-subjects" aria-selected="true">Leave Management</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="add-feedbacks-tab" data-toggle="tab" href="#add-feedbacks"
                                role="tab" aria-controls="add-subjects" aria-selected="true">Faculty Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="add-reports-tab" data-toggle="tab" href="#add-reports" role="tab"
                                aria-controls="add-subjects" aria-selected="true">Report</a>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link" id="ns-reports-tab" data-toggle="tab" href="#ns-reports" role="tab"
                                aria-controls="add-subjects" aria-selected="true">Leave Report</a>
                        </li> -->
                        <!-- Other tabs here -->
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content mt-3" id="myTabContent">
                        <!-- Add Subjects Tab -->
                        <div class="tab-pane fade show active" id="add-subjects" role="tabpanel"
                            aria-labelledby="add-subjects-tab">
                            <div class="card">
                                <div class="col-12 py-4">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-leave-approval-tab"
                                                data-toggle="tab" href="#nav-leave-approval" role="tab"
                                                aria-controls="nav-leave-approval" aria-selected="true">Leave
                                                Approval</a>
                                            <a class="nav-item nav-link" id="nav-od-approval-tab" data-toggle="tab"
                                                href="#nav-od-approval" role="tab" aria-controls="nav-od-approval"
                                                aria-selected="false">OD Approval</a>
                                            <a class="nav-item nav-link" id="nav-permission-approval-tab"
                                                data-toggle="tab" href="#nav-permission-approval" role="tab"
                                                aria-controls="nav-permission-approval" aria-selected="false">Permission
                                                Approval</a>
                                            <a class="nav-item nav-link" id="nav-leave-request-approval-tab"
                                                data-toggle="tab" href="#nav-leave-request-approval" role="tab"
                                                aria-controls="nav-leave-request-approval" aria-selected="false">Leave
                                                Request Approval</a>
                                            <a class="nav-item nav-link" id="nav-od-request-approval-tab"
                                                data-toggle="tab" href="#nav-od-request-approval" role="tab"
                                                aria-controls="nav-od-request-approval" aria-selected="false">OD Request
                                                Approval</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-leave-approval" role="tabpanel"
                                            aria-labelledby="nav-leave-approval-tab">

                                            <div class="container-fluid my-5" id="LeaveTab">
                                                <table class="table table-striped table-bordered" id="leaveTable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Leave Type</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Total Days</th>
                                                            <th>Reason</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>


                                        </div>


                                        <div class="tab-pane fade" id="nav-od-approval" role="tabpanel"
                                            aria-labelledby="nav-od-approval-tab">
                                            <div class="container-fluid my-5" id="ODTab">
                                                <table class="table table-striped table-bordered" id="odTable"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>OD Type</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Total Days</th>
                                                            <th>Reason</th>
                                                            <th>Proof</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="nav-permission-approval" role="tabpanel"
                                            aria-labelledby="nav-permission-approval-tab">
                                            <div class="container-fluid my-5" id="PerTab">
                                                <table class="table table-striped table-bordered" id="PerTable"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Permission Type</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="nav-leave-request-approval" role="tabpanel"
                                            aria-labelledby="nav-leave-request-approval-tab">
                                            <div class="container-fluid my-5" id="ColTab">
                                                <table class="table table-striped table-bordered" id="ColTable"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Date</th>
                                                            <th>Reason</th>
                                                            <th>Intime</th>
                                                            <th>Outtime</th>
                                                            <th>Days</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="nav-od-request-approval" role="tabpanel"
                                            aria-labelledby="nav-od-request-approval-tab">
                                            <div class="container-fluid my-5" id="ODRTab">
                                                <table class="table table-striped table-bordered" id="odrTable"
                                                    style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Total Days</th>
                                                            <th>Reason</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="col-12 py-4">
                                    <h4>Leave balance</h4>
                                    <table class="table table-striped table-bordered py-4" id="leaveBalanceTable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>CL</th>
                                                <th>COL</th>
                                                <th>ODB</th>
                                                <th>ODR</th>
                                                <th>ODP</th>
                                                <th>ODO</th>
                                                <th>VL</th>
                                                <th>ML</th>
                                                <th>MAL</th>
                                                <th>MTL</th>
                                                <th>PTL</th>
                                                <th>SL</th>
                                                <th>SPL</th>
                                                <th>PER</th>
                                                <th>PER 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be populated dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal to display ODR file -->
                        <div class="modal" id="fileModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">File Viewer</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe id="fileViewer"
                                            style="width: 100%; height: 500px; border: none;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal end -->

                        <div class="tab-pane fade show" id="add-feedbacks" role="tabpanel"
                            aria-labelledby="add-feedbacks-tab">
                            <?php include "hatten.php"; ?>
                        </div>

                        <div class="tab-pane fade show" id="add-reports" role="tabpanel"
                            aria-labelledby="add-feedbacks-tab">
                            <?php include "hreport.php"; ?>
                        </div>

                        <!-- <div class="tab-pane fade show" id="ns-reports" role="tabpanel"
                            aria-labelledby="add-feedbacks-tab">
                           
                        </div> -->
                    </div>
                </div>

            </div>
        </div>



    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="rejectForm">
                        <div class="form-group">
                            <label for="rejectReason">Reason for Rejection</label>
                            <textarea class="form-control" id="rejectReason" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmReject">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "./footer.html" ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    <!-- <script src="assets/libs/jquery-steps/build/jquery.steps.min.js"></script> -->
    <script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <script>


        $(document).ready(function () {
            $('#leaveBalanceTable').DataTable({
                ajax: {
                    url: 'hodleave_back.php',
                    type: 'POST',
                    data: { action: 'get_leave_balance_details' }
                },
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'cl' },
                    { data: 'col' },
                    { data: 'odb' },
                    { data: 'odr' },
                    { data: 'odp' },
                    { data: 'odo' },
                    { data: 'vl' },
                    { data: 'ml' },
                    { data: 'mal' },
                    { data: 'mtl' },
                    { data: 'ptl' },
                    { data: 'sl' },
                    { data: 'spl' },
                    { data: 'pm' },
                    { data: 'tenpm' }
                ]
            });
        });
        // Leave approve

        $(document).ready(function () {
            let leaveData = null;
            $('#leaveTable').DataTable({
                ajax: {
                    url: 'hodleave_back.php',
                    type: 'POST',
                    data: { action: 'get_leave_details' }
                },
                language: {
                    emptyTable: "No Leave data found",
                    loadingRecords: "No Leave data found",
                    zeroRecords: "No Leave data found"
                },
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'uid' },
                    { data: 'name' },
                    { data: 'ltype' },
                    { data: 'fdate' },
                    { data: 'tdate' },
                    { data: 'tdays' },
                    { data: 'reason' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            // Store all necessary data as data attributes
                            return `
                        <button class="btn btn-success approve-btn" 
                            data-id="${row.id}"
                            data-uid="${row.uid}"
                             data-ltype="${row.ltype}"
                            data-fdate="${row.fdate}"
                            data-tdate="${row.tdate}"
                            data-fshift="${row.fshift}"
                            data-tshift="${row.tshift}"
                            style="background: transparent; border: none; padding: 5px;">
                            <img src="images/icon/accept.png" alt="View" style="width: 24px; height: 24px;">
                        </button>
                        <button class="btn btn-danger reject-btn"
                            data-id="${row.id}"
                            data-uid="${row.uid}"
                            data-ltype="${row.ltype}"
                            data-fdate="${row.fdate}"
                            data-tdate="${row.tdate}"
                            data-fshift="${row.fshift}"
                            data-tshift="${row.tshift}"
                            data-tdays="${row.tdays}"
                            style="background: transparent; border: none; padding: 5px;">
                           <img src="images/icon/reject.png" alt="Reject" style="width: 24px; height: 24px;">
                        </button>
                    `;
                        }
                    }
                ]
            });

            // Approve button click event
            $('#leaveTable').on('click', '.approve-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid'),
                    ltype: button.data('ltype'),
                    fdate: button.data('fdate'),
                    tdate: button.data('tdate'),
                    fshift: button.data('fshift'),
                    tshift: button.data('tshift')
                };
                approveLeave(leaveData);
            });

            // Reject button click event
            $('#leaveTable').on('click', '.reject-btn', function () {
                var button = $(this);
                leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid'),
                    ltype: button.data('ltype'),
                    fdate: button.data('fdate'),
                    tdate: button.data('tdate'),
                    fshift: button.data('fshift'),
                    tshift: button.data('tshift'),
                    tdays: button.data('tdays')
                };
                $('#rejectModal').modal('show');
            });
            $('#confirmReject').on('click', function () {
                const rejectReason = $('#rejectReason').val().trim();

                if (!rejectReason) {
                    alertify.error('Please enter rejection reason');
                    return;
                }

                rejectLeave(leaveData, rejectReason);
                $('#rejectModal').modal('hide');
                $('#rejectReason').val(''); // Clear the textarea
            });

        });

        function approveLeave(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'approve_leave',
                    id: leaveData.id,
                    uid: leaveData.uid,
                    ltype: leaveData.ltype,
                    fdate: leaveData.fdate,
                    tdate: leaveData.tdate,
                    fshift: leaveData.fshift,
                    tshift: leaveData.tshift
                },
                success: function (response) {
                    $('#leaveTable').DataTable().clear().draw();
                    $('#leaveTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('Leave approved successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error approving leave:', error);
                    alert('Error approving leave. Please try again.');
                }
            });
        }

        function rejectLeave(leaveData,rejectReason) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'reject_leave',
                    id: leaveData.id,
                    uid: leaveData.uid,
                    ltype: leaveData.ltype,
                    fdate: leaveData.fdate,
                    tdate: leaveData.tdate,
                    fshift: leaveData.fshift,
                    tshift: leaveData.tshift,
                    tdays: leaveData.tdays,
                    reject_reason: rejectReason
                },
                success: function (response) {
                    $('#leaveTable').DataTable().clear().draw();
                    $('#leaveTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Leave rejected successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error rejecting leave:', error);
                    alert('Error rejecting leave. Please try again.');
                }
            });
        }

        // OD approve

        $(document).ready(function () {
            $('#odTable').DataTable({
                ajax: {
                    url: 'hodleave_back.php',
                    type: 'POST',
                    data: { action: 'get_OD_details' }
                },
                language: {
                    emptyTable: "No OD data found",
                    loadingRecords: "No OD data found",
                    zeroRecords: "No OD data found"
                },
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'uid' },
                    { data: 'name' },
                    { data: 'otype' },
                    { data: 'fdate' },
                    { data: 'tdate' },
                    { data: 'tdays' },
                    { data: 'reason' },
                    {
                        // View column with updated file path
                        data: 'file',
                        render: function (data, type, row) {
                            if (data) {
                                return `<div style="display: flex; justify-content: center;">
                                    <button class="btn btn-primary btn-sm view2_file_btn" 
                                            data-file="Files/uploads/OD/${data}" 
                                            style="background: transparent; border: none;">
                                        <img src="images/icon/eye.png" alt="View" style="width: 24px; height: 24px;">
                                    </button>
                                </div>`;
                            }
                            return 'No file';
                        }
                    },

                    {
                        data: null,
                        render: function (data, type, row) {
                            // Store all necessary data as data attributes
                            return `
                        <button class="btn btn-success approveOD-btn" 
                            data-id="${row.id}"
                            data-uid="${row.uid}"
                            data-otype="${row.otype}"
                            data-fdate="${row.fdate}"
                            data-tdate="${row.tdate}"
                            data-fshift="${row.fshift}"
                            data-tshift="${row.tshift}"
                            style="background: transparent; border: none; padding: 5px;"
                            >
                           <img src="images/icon/accept.png" alt="View" style="width: 24px; height: 24px;">
                        </button>
                        <button class="btn btn-danger rejectOD-btn"
                            data-id="${row.id}"
                            data-uid="${row.uid}"
                            data-otype="${row.otype}"
                            data-fdate="${row.fdate}"
                            data-tdate="${row.tdate}"
                            data-fshift="${row.fshift}"
                            data-tshift="${row.tshift}"
                            data-tdays="${row.tdays}"
                            style="background: transparent; border: none; padding: 5px;"
                            >
                            <img src="images/icon/reject.png" alt="Reject" style="width: 24px; height: 24px;">
                        </button>
                    `;
                        }
                    }
                ]
            });


            $(document).on('click', '.view2_file_btn', function () {
                const fileUrl = $(this).data('file');
                const fileExt = fileUrl.split('.').pop().toLowerCase();
                const fileContent = $('#fileContent');

                // Clear previous content
                fileContent.empty();

                // Check file type and display accordingly
                if (fileExt === 'pdf') {
                    fileContent.html(`<embed src="${fileUrl}" type="application/pdf" width="100%" height="600px">`);
                } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                    fileContent.html(`<img src="${fileUrl}" class="img-fluid" alt="Document">`);
                } else {
                    fileContent.html('<p class="text-danger">Unsupported file type</p>');
                }

                // Show the modal
                $('#fileViewModal_new').modal('show');
            });

            // Approve button click event
            $('#odTable').on('click', '.approveOD-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid'),
                    otype: button.data('otype'),
                    fdate: button.data('fdate'),
                    tdate: button.data('tdate'),
                    fshift: button.data('fshift'),
                    tshift: button.data('tshift')
                };
                approveOD(leaveData);
            });

            // Reject button click event
            $('#odTable').on('click', '.rejectOD-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid'),
                    otype: button.data('otype'),
                    fdate: button.data('fdate'),
                    tdate: button.data('tdate'),
                    fshift: button.data('fshift'),
                    tshift: button.data('tshift'),
                    tdays: button.data('tdays')
                };
                rejectOD(leaveData);
            });
        });

        function approveOD(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'approve_OD',
                    id: leaveData.id,
                    uid: leaveData.uid,
                    otype: leaveData.otype,
                    fdate: leaveData.fdate,
                    tdate: leaveData.tdate,
                    fshift: leaveData.fshift,
                    tshift: leaveData.tshift
                },
                success: function (response) {
                    $('#odTable').DataTable().clear().draw();
                    $('#odTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('OD approved successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error approving OD:', error);
                    alert('Error approving OD. Please try again.');
                }
            });
        }

        function rejectOD(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'reject_OD',
                    id: leaveData.id,
                    uid: leaveData.uid,
                    otype: leaveData.otype,
                    fdate: leaveData.fdate,
                    tdate: leaveData.tdate,
                    fshift: leaveData.fshift,
                    tshift: leaveData.tshift,
                    tdays: leaveData.tdays
                },
                success: function (response) {
                    $('#odTable').DataTable().clear().draw();
                    $('#odTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('OD rejected successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error rejecting OD:', error);
                    alert('Error rejecting OD. Please try again.');
                }
            });
        }


        // Permissions approve

        $(document).ready(function () {
            $('#PerTable').DataTable({
                ajax: {
                    url: 'hodleave_back.php',
                    type: 'POST',
                    data: { action: 'get_PER_details' }
                },
                language: {
                    emptyTable: "No Permission data found",
                    loadingRecords: "No Permission data found",
                    zeroRecords: "No Permission data found"
                },
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'uid' },
                    { data: 'name' },
                    { data: 'ltype' },
                    { data: 'fdate' },
                    { data: 'reason' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            // Store all necessary data as data attributes
                            return `
                        <button class="btn btn-success approvePer-btn" 
                            data-id="${row.id}"
                            data-uid="${row.uid}"
                            data-ltype="${row.ltype}"
                            data-fdate="${row.fdate}">
                            Approve
                        </button>
                        <button class="btn btn-danger rejectPer-btn"
                            data-id="${row.id}"
                            data-uid="${row.uid}"
                            data-ltype="${row.ltype}"
                            data-fdate="${row.fdate}">
                            Reject
                        </button>
                    `;
                        }
                    }
                ]
            });

            // Approve button click event
            $('#PerTable').on('click', '.approvePer-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid'),
                    ltype: button.data('ltype'),
                    fdate: button.data('fdate')
                };
                approvePER(leaveData);
            });

            // Reject button click event
            $('#PerTable').on('click', '.rejectPer-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid'),
                    ltype: button.data('ltype'),
                    fdate: button.data('fdate')
                };
                rejectPER(leaveData);
            });
        });

        function approvePER(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'approve_PER',
                    id: leaveData.id,
                    uid: leaveData.uid,
                    ltype: leaveData.ltype,
                    fdate: leaveData.fdate
                },
                success: function (response) {
                    $('#PerTable').DataTable().clear().draw();
                    $('#PerTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('Permission approved successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error approving Permission:', error);
                    alert('Error approving Permission. Please try again.');
                }
            });
        }

        function rejectPER(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'reject_PER',
                    id: leaveData.id,
                    uid: leaveData.uid,
                    ltype: leaveData.ltype,
                    fdate: leaveData.fdate
                },
                success: function (response) {
                    $('#PerTable').DataTable().clear().draw();
                    $('#PerTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('Permission rejected successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error rejecting Permission:', error);
                    alert('Error rejecting Permission. Please try again.');
                }
            });
        }


        // COL approve

        $(document).ready(function () {
            $('#ColTable').DataTable({
                ajax: {
                    url: 'hodleave_back.php',
                    type: 'POST',
                    data: { action: 'get_Col_details' }
                },
                language: {
                    emptyTable: "No COL data found",
                    loadingRecords: "No COL data found",
                    zeroRecords: "No COL data found"
                },
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'uid' },
                    { data: 'name' },
                    { data: 'fdate' },
                    { data: 'reason' },
                    { data: 'intime' },
                    { data: 'outtime' },
                    { data: 'days' },

                    {
                        data: null,
                        render: function (data, type, row) {
                            // Store all necessary data as data attributes
                            return `
                        <button class="btn btn-success approveCOL-btn" 
                            data-id="${row.id}"
                            data-uid="${row.uid}">
                            Approve
                        </button>
                        <button class="btn btn-danger rejectCOL-btn"
                            data-id="${row.id}"
                            data-uid="${row.uid}">
                            Reject
                        </button>
                    `;
                        }
                    }
                ]
            });

            // Approve button click event
            $('#ColTable').on('click', '.approveCOL-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid')
                };
                approveCOL(leaveData);
            });

            // Reject button click event
            $('#ColTable').on('click', '.rejectCOL-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid')
                };
                rejectCOL(leaveData);
            });
        });

        function approveCOL(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'approve_COL',
                    id: leaveData.id,
                    uid: leaveData.uid
                },
                success: function (response) {
                    $('#ColTable').DataTable().clear().draw();
                    $('#ColTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('COL Request approved successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error approving COL:', error);
                    alert('Error approving COL. Please try again.');
                }
            });
        }

        function rejectCOL(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'reject_COL',
                    id: leaveData.id,
                    uid: leaveData.uid
                },
                success: function (response) {
                    $('#ColTable').DataTable().clear().draw();
                    $('#ColTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('COL Request rejected successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error rejecting COL:', error);
                    alert('Error rejecting COL. Please try again.');
                }
            });
        }


        // ODR approve

        $(document).ready(function () {
            $('#odrTable').DataTable({
                ajax: {
                    url: 'hodleave_back.php',
                    type: 'POST',
                    data: { action: 'get_ODR_details' }
                },
                language: {
                    emptyTable: "No ODR data found",
                    loadingRecords: "No ODR data found",
                    zeroRecords: "No ODR data found"
                },
                columns: [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'uid' },
                    { data: 'name' },
                    { data: 'fdate' },
                    { data: 'tdate' },
                    { data: 'tdays' },
                    { data: 'reason' },
                    {
                        data: 'file',
                        render: function (data, type, row) {
                            // Store all necessary data as data attributes
                            return `
                            <button class="btn btn-primary btn-sm view2_file_btn"  data-file="Files/uploads/ODR/${data}" style="background: transparent; border: none; padding: 5px;">
                                <img src="images/icon/eye.png" alt="View" style="width: 24px; height: 24px;">
                            </button>
                            <button class="btn approveODR-btn" 
                                data-id="${row.id}"
                                data-uid="${row.uid}"
                                style="background: transparent; border: none; padding: 5px;">
                                <img src="images/icon/accept.png" alt="View" style="width: 24px; height: 24px;">
                            </button>
                            <button class="btn rejectODR-btn" 
                                    data-id="${row.id}" 
                                    data-uid="${row.uid}"
                                    style="background: transparent; border: none; padding: 5px;">
                                <img src="images/icon/reject.png" alt="Reject" style="width: 24px; height: 24px;">
                            </button>
                        `;
                        }
                    }
                ]
            });
            // Approve button click event
            $('#odrTable').on('click', '.approveODR-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid')
                };
                approveODR(leaveData);
            });

            // Reject button click event
            $('#odrTable').on('click', '.rejectODR-btn', function () {
                var button = $(this);
                var leaveData = {
                    id: button.data('id'),
                    uid: button.data('uid')
                };
                rejectODR(leaveData);
            });
        });


        function approveODR(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'approve_ODR',
                    id: leaveData.id,
                    uid: leaveData.uid
                },
                success: function (response) {
                    $('#odrTable').DataTable().clear().draw();
                    $('#odrTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success('ODR Request approved successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error approving ODR:', error);
                    alert('Error approving ODR. Please try again.');
                }
            });
        }

        function rejectODR(leaveData) {
            $.ajax({
                url: 'hodleave_back.php',
                type: 'POST',
                data: {
                    action: 'reject_ODR',
                    id: leaveData.id,
                    uid: leaveData.uid
                },
                success: function (response) {
                    $('#odrTable').DataTable().clear().draw();
                    $('#odrTable').DataTable().ajax.reload().draw();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error('ODR Request rejected successfully');
                },
                error: function (xhr, status, error) {
                    console.error('Error rejecting ODR:', error);
                    alert('Error rejecting ODR. Please try again.');
                }
            });
        }


        function viewFile(filePath) {
            document.getElementById('fileViewer').src = filePath;
            $('#fileViewModal_new').modal('show');
        }
    </script>

    <!-- leave file view modal -->
    <div class="modal fade" id="fileViewModal_new" data-bs-backdrop="false" tabindex="-1"
        aria-labelledby="fileViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 90%; width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fileViewModalLabel">File View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="fileContent" class="text-center">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>