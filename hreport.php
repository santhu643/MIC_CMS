<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            --secondary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

      
        .page-header {
            background: var(--primary-gradient);
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* .nav-tabs {
            border: none;
            margin-bottom: 2rem;
        }

        .nav-tabs .nav-link {
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
            margin-right: 1rem;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary-gradient);
            color: white;
        } */

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            margin-bottom: 2rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6B73FF;
            box-shadow: 0 0 0 0.2rem rgba(107, 115, 255, 0.25);
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #20bf55 0%, #01baef 100%);
            border: none;
        }

        .status-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: 500;
        }

        .status-pending { background: #ffc107; }
        .status-forwarded { background: #007bff; }
        .status-approved { background: #28a745; }
        .status-rejected { background: #6c757d; }

        .search-box {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-box .form-control {
            padding-left: 2.5rem;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #6B73FF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        th{
            background: var(--primary-gradient);
            color:white;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container-fluid">


        <ul class="nav nav-tabs" id="reportTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#attendance">Attendance Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#leave">Leave Report</a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Attendance Report Tab -->
            <div class="tab-pane fade show active" id="attendance">
                <div class="card">
                    <div class="card-body">
                        <form id="attendanceForm2">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar-alt mr-2"></i>Month</label>
                                        <input type="number" name="month" min="1" max="12" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar-check mr-2"></i>Year</label>
                                        <input type="number" name="year" min="2023" max="2030" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-sync-alt mr-2"></i>Generate
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="attendanceReport" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <button id="downloadAttendance" class="btn btn-success">
                                        <i class="fas fa-download mr-2"></i>Download Report
                                    </button>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="search-box">
                                        <i class="fas fa-search search-icon"></i>
                                        <input type="text" id="attendanceSearch" class="form-control" placeholder="Search by UID...">
                                    </div>
                                </div> -->
                            </div>
                            <div class="table-responsive">
                                <table id="attendanceTable2" class="table table-hover" width="100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leave Report Tab -->
            <div class="tab-pane fade" id="leave">
                <div class="card">
                    <div class="card-body">
                        <form id="leaveForm">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar-alt mr-2"></i>Month</label>
                                        <input type="number" name="month" min="1" max="12" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar-check mr-2"></i>Year</label>
                                        <input type="number" name="year" min="2023" max="2030" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><i class="fas fa-list-alt mr-2"></i>Leave Type</label>
                                        <select name="leaveType" class="form-control" required>
                                            <option value="CL">CL</option>
                                            <option value="COL Request">COL Request</option>
                                            <option value="OD">OD</option>
                                            <option value="Permission">Permission</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-sync-alt mr-2"></i>Generate
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="leaveReport" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="search-box mb-4">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="leaveSearch" class="form-control" placeholder="Search by UID...">
                            </div> -->
                            <div class="table-responsive">
                                <table id="leaveTable2" class="table table-hover" width="100%"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="loading-overlay">
        <div class="loader"></div>
    </div> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.min.js"></script>

    <script>
        $(document).ready(function() {
            let attendanceTable2, leaveTable2;
            let attendanceData = [];

            // Attendance Report Handling
            $('#attendanceForm2').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                $('.loading-overlay').show();
                
                $.ajax({
                    url: 'hodleave_back.php',
                    method: 'POST',
                    data: {
                        action: 'get_sreport_details',
                        month: formData.get('month'),
                        year: formData.get('year')
                    },
                    success: function(response) {
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }
                        if (response.status === 200) {
                            attendanceData = response.data;
                            initializeAttendanceTable(attendanceData);
                            $('#attendanceReport').fadeIn();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonColor: '#6B73FF'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to generate report',
                            icon: 'error',
                            confirmButtonColor: '#6B73FF'
                        });
                    },
                    complete: function() {
                        $('.loading-overlay').hide();
                    }
                });
            });

            function initializeAttendanceTable(data) {
                if (attendanceTable2) {
                    attendanceTable2.destroy();
                }

                attendanceTable2 = $('#attendanceTable2').DataTable({
                    data: data,
                    columns: [
                        { title: 'S.No', render: (data, type, row, meta) => meta.row + 1 },
                        { title: 'ID', data: 'uid' },
                        { title: 'Name', data: 'facultyName' },
                        { title: 'Role', data: 'facultyRole' },
                        { title: 'Total Days', data: 'totalDays' },
                        { title: 'Working Days', data: 'totalWorkingDays' },
                        { title: 'Holidays', data: 'totalHolidays' },
                        { title: 'Present', data: 'totalPresentdays' },
                        { title: 'LOP', data: 'totalLopdays' },
                        { title: 'Salary Day', data: 'salaryDay' }
                    ],
                    pageLength: 10,
                    responsive: true
                });
            }

          

            $('#downloadAttendance').on('click', function() {
                const ws = XLSX.utils.json_to_sheet(
                    attendanceData.map(data => ({
                        'UID': data.uid,
                        'Name': data.facultyName,
                        'Role': data.facultyRole,
                        'Total Days': data.totalDays,
                        'Working Days': data.totalWorkingDays,
                        'Holidays': data.totalHolidays,
                        'Present': data.totalPresentdays,
                        'LOP': data.totalLopdays,
                        'Salary Day': data.salaryDay
                    }))
                );
                
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Attendance Report');
                XLSX.writeFile(wb, 'attendance_report.xlsx');
            });

            // Leave Report Handling
            function getStatusButton(status) {
                let buttonText, buttonClass;
                switch (parseInt(status)) {
                    case 0:
                        buttonText = 'Pending';
                        buttonClass = 'status-pending';
                        break;
                    case 1:
                        buttonText = 'Forwarded to HR';
                        buttonClass = 'status-forwarded';
                        break;
                    case 2:
                        buttonText = 'Approved';
                        buttonClass = 'status-approved';
                        break;
                    default:
                        buttonText = 'Rejected';
                        buttonClass = 'status-rejected';
                }
                return `<button class="status-btn ${buttonClass}">${buttonText}</button>`;
            }

            function getLeaveColumns(leaveType) {
                const baseColumns = [
                    {
                        title: 'S.No',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { title: 'ID', data: 'uid' },
                    { title: 'Name', data: 'name' }
                ];

                const statusColumn = {
                    title: 'Status',
                    render: function(data, type, row) {
                        return getStatusButton(row.status);
                    }
                };

                let specificColumns = [];
                switch (leaveType) {
                    case 'CL':
                    case 'OD':
                        specificColumns = [
                            { title: 'From', data: 'fdate' },
                            { title: 'To', data: 'tdate' },
                            { title: 'Type', data: leaveType === 'CL' ? 'ltype' : 'otype' },
                            { title: 'Total Days', data: 'tdays' },
                            { title: 'Reason', data: 'reason' }
                        ];
                        break;
                    case 'COL Request':
                        specificColumns = [
                            { title: 'Date', data: 'fdate' },
                            { title: 'Reason', data: 'reason' },
                            { title: 'In Time', data: 'intime' },
                            { title: 'Out Time', data: 'outtime' }
                        ];
                        break;
                    case 'Permission':
                        specificColumns = [
                            { title: 'Date', data: 'fdate' },
                            { title: 'Type', data: 'ltype' },
                            { title: 'Reason', data: 'reason' }
                        ];
                        break;
                }

                return [...baseColumns, ...specificColumns, statusColumn];
            }

            $('#leaveForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                // $('.loading-overlay').show();

                $.ajax({
                    url: 'hodleave_back.php',
                    method: 'POST',
                    data: {
                        action: 'get_lreport_details',
                        month: formData.get('month'),
                        year: formData.get('year'),
                        ltype: formData.get('leaveType')
                    },
                    success: function(response) {
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }
                        if (response.status === 200) {
                            if (leaveTable2) {
                                leaveTable2.destroy();
                            }

                            const columns = getLeaveColumns(formData.get('leaveType'));
                            
                            leaveTable2 = $('#leaveTable2').DataTable({
                                data: response.data.data,
                                columns: columns,
                                responsive: true,
                                pageLength: 10,
                                order: [[0, 'asc']]
                            });

                            $('#leaveReport').show();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonColor: '#6B73FF'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to generate report',
                            icon: 'error',
                            confirmButtonColor: '#6B73FF'
                        });
                    },
                    complete: function() {
                        $('.loading-overlay').hide();
                    }
                });
            });

            $('#leaveSearch').on('keyup', function() {
                if (leaveTable2) {
                    leaveTable2.search(this.value).draw();
                }
            });

            // Initialize current date values
            const currentDate = new Date();
            $('input[name="month"]').val(currentDate.getMonth() + 1);
            $('input[name="year"]').val(currentDate.getFullYear());
        });
    </script>
</body>
</html>