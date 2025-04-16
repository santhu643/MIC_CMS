<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css"
        rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            --secondary-gradient: linear-gradient(135deg, #FF6B6B 0%, #FF000D 100%);
        }


        .container {
            max-width: 1400px;
            padding: 2rem;
        }


        .form-container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6B73FF;
            box-shadow: 0 0 0 0.2rem rgba(107, 115, 255, 0.25);
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-generate {
            background: var(--primary-gradient);
            border: none;
            color: white;
            box-shadow: 0 4px 15px rgba(107, 115, 255, 0.3);
        }

        .btn-export {
            background: #28a745;
            color: white;
            border: none;
            margin-left: 1rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107, 115, 255, 0.4);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* .nav-tabs {
            border: none;
            margin-bottom: 1.5rem;
            gap: 1rem;
            display: flex;
        }

        .nav-tabs .nav-link {
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            color: #6c757d;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(107, 115, 255, 0.3);
        } */

        .table thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 500;
        }

        .status-cell {
            padding: 0.5rem;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
            min-width: 45px;
        }

        .status-H {
            background-color: #90caf9;
            color: #1565c0;
        }

        .status-MP {
            background-color: #a5d6a7;
            color: #2e7d32;
        }

        .status-AB {
            background-color: #ef9a9a;
            color: #c62828;
        }

        .status-P {
            background-color: #81c784;
            color: #2e7d32;
        }

        .status-S {
            background-color: #fff59d;
            color: #f57f17;
        }

        .status-L {
            background-color: #ce93d8;
            color: #6a1b9a;
        }

        .time-info {
            font-size: 0.75rem;
            margin-top: 0.25rem;
            opacity: 0.8;
        }

        .work-hours {
            font-size: 0.75rem;
            margin-top: 0.25rem;
            color: #2196f3;
            font-weight: 500;
        }

        .individual-view {
            max-height: 70vh;
            overflow-y: auto;
        }

        .individual-day {
            background: #fff;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #6B73FF;
        }

        .day-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .individual-status {
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-weight: 500;
        }

        #individualSearch {
            margin-bottom: 1rem;
        }

        .export-toolbar {
            margin-bottom: 1rem;
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="form-container">
            <form id="attendanceForm" class="report-form">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group mb-md-0">
                            <label for="month">Month</label>
                            <input type="number" id="month" name="month" min="1" max="12" class="form-control"
                                placeholder="Enter month (1-12)" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-md-0">
                            <label for="year">Year</label>
                            <input type="number" id="year" name="year" min="2023" max="2030" class="form-control"
                                placeholder="Enter year" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-generate">
                            <i class="fas fa-sync-alt mr-2"></i>Generate Report
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div id="tableContainer" class="card" style="display: none;">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active nn" data-tab="status" href="#">
                            <i class="fas fa-list-alt mr-2"></i>Status
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nn" data-tab="detailed" href="#">
                            <i class="fas fa-clock mr-2"></i>Status with IN/OUT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nn" data-tab="individual" href="#">
                            <i class="fas fa-user mr-2"></i>Individual View
                        </a>
                    </li>
                </ul>

                <div class="export-toolbar">
                    <button class="btn btn-export" id="exportBtn">
                        <i class="fas fa-file-excel mr-2"></i>Export to Excel
                    </button>
                </div>

                <div id="mainTableView">
                    <div id="attendanceTableWrapper">
                        <table id="attendanceTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>UID</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div id="individualView" style="display: none;">
                    <div class="form-group">
                        <input type="text" id="individualSearch" class="form-control" placeholder="Enter Staff UID">
                    </div>
                    <div id="individualData" class="individual-view">
                        <!-- Individual data will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let table;
            let currentMonth, currentYear;
            let currentView = 'status';
            let attendanceData = [];

            function calculateWorkHours(inTime, outTime) {
                if (!inTime || !outTime) return null;

                const [inHour, inMin] = inTime.split(':').map(Number);
                const [outHour, outMin] = outTime.split(':').map(Number);

                let hours = outHour - inHour;
                let minutes = outMin - inMin;

                if (minutes < 0) {
                    hours--;
                    minutes += 60;
                }

                return hours + (minutes / 60);
            }

            function formatWorkHours(hours) {
                if (hours === null) return '';
                const wholeHours = Math.floor(hours);
                const minutes = Math.round((hours - wholeHours) * 60);
                return `${wholeHours}h ${minutes}m`;
            }

            function formatTime(timeStr) {
                if (!timeStr) return '';
                return timeStr.split(':').slice(0, 2).join(':');
            }

            function renderCell(attendance, viewType) {
                if (!attendance) return '';

                const status = attendance.status;
                const inTime = formatTime(attendance.in_time);
                const outTime = formatTime(attendance.out_time);
                const workHours = calculateWorkHours(attendance.in_time, attendance.out_time);

                return `
                    <div class="status-cell status-${status}">
                        ${status}
                        ${viewType === 'detailed' && (inTime || outTime) ?
                        `<div class="time-info">
                                ${inTime ? `<i class="fas fa-sign-in-alt mr-1"></i>${inTime}` : ''}
                                ${outTime ? `<br><i class="fas fa-sign-out-alt mr-1"></i>${outTime}` : ''}
                                ${workHours ? `<div class="work-hours"><i class="fas fa-business-time mr-1"></i>${formatWorkHours(workHours)}</div>` : ''}
                            </div>` :
                        ''}
                    </div>
                `;
            }

            function renderIndividualView(uid) {
                const employee = attendanceData.find(emp => emp.uid === uid);
                if (!employee) {
                    $('#individualData').html('<div class="alert alert-warning">No data found for this UID</div>');
                    return;
                }

                let html = `<h4 class="mb-4">${employee.name} (${employee.uid})</h4>`;

                employee.attendance.forEach((day, index) => {
                    if (day) {
                        const inTime = formatTime(day.in_time);
                        const outTime = formatTime(day.out_time);
                        const workHours = calculateWorkHours(day.in_time, day.out_time);

                        html += `
                            <div class="individual-day">
                                <div class="day-header">
                                    <strong>Day ${index + 1}</strong>
                                    <span class="individual-status status-${day.status}">${day.status}</span>
                                </div>
                                <div class="time-info">
                                    ${inTime ? `<div><i class="fas fa-sign-in-alt mr-1"></i>In: ${inTime}</div>` : ''}
                                    ${outTime ? `<div><i class="fas fa-sign-out-alt mr-1"></i>Out: ${outTime}</div>` : ''}
                                    ${workHours ? `<div class="work-hours"><i class="fas fa-business-time mr-1"></i>Working Hours: ${formatWorkHours(workHours)}</div>` : ''}
                                </div>
                            </div>
                        `;
                    }
                });

                $('#individualData').html(html);
            }

            function initializeTable(data, month, year) {
                const daysInMonth = new Date(year, month, 0).getDate();
                attendanceData = data;

                const columns = [
                    { data: 'uid', width: '100px' },
                    { data: 'name', width: '150px' }
                ];

                for (let i = 1; i <= daysInMonth; i++) {
                    columns.push({
                        data: null,
                        width: '60px',
                        render: function (row) {
                            return renderCell(row.attendance[i - 1], currentView);
                        }
                    });
                }

                if (table) {
                    table.destroy();
                    $('#attendanceTable thead tr th:gt(1)').remove();
                }

                const headerRow = $('#attendanceTable thead tr');
                for (let i = 1; i <= daysInMonth; i++) {
                    headerRow.append(`<th>${i}</th>`);
                }

                table = $('#attendanceTable').DataTable({
                    data: data,
                    columns: columns,
                    scrollX: true,
                    scrollY: '60vh',
                    scrollCollapse: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    pageLength: 25,
                    fixedColumns: {
                        leftColumns: 2
                    },
                    dom: '<"top"f>rt<"bottom"ip>',
                    language: {
                        search: '<i class="fas fa-search"></i> Search:',
                        emptyTable: '<div class="text-center py-4"><i class="fas fa-calendar-times fa-3x mb-3 text-muted"></i><br>No attendance data available</div>'
                    }
                });
            }

            // Export to Excel functionality
            function exportToExcel() {
                // Check if we have data to export
                if (!attendanceData || attendanceData.length === 0) {
                    alert('No data available to export');
                    return;
                }

                const wb = XLSX.utils.book_new();

                // Convert main table data
                const mainTableData = attendanceData.map(row => {
                    const rowData = {
                        UID: row.uid,
                        Name: row.name
                    };

                    row.attendance.forEach((day, index) => {
                        if (day) {
                            rowData[`Day ${index + 1}`] = `${day.status}${day.in_time ? ' (In: ' + formatTime(day.in_time) + ')' : ''}${day.out_time ? ' (Out: ' + formatTime(day.out_time) + ')' : ''}`;
                        } else {
                            rowData[`Day ${index + 1}`] = '';
                        }
                    });

                    return rowData;
                });

                const ws = XLSX.utils.json_to_sheet(mainTableData);
                XLSX.utils.book_append_sheet(wb, ws, "Attendance Overview");

                // Add individual sheets for each employee
                attendanceData.forEach(employee => {
                    const individualData = employee.attendance.map((day, index) => {
                        if (day) {
                            const workHours = calculateWorkHours(day.in_time, day.out_time);
                            return {
                                Date: `Day ${index + 1}`,
                                Status: day.status,
                                'In Time': formatTime(day.in_time) || '-',
                                'Out Time': formatTime(day.out_time) || '-',
                                'Working Hours': workHours ? formatWorkHours(workHours) : '-'
                            };
                        }
                        return null;
                    }).filter(Boolean);

                    const ws = XLSX.utils.json_to_sheet(individualData);
                    XLSX.utils.book_append_sheet(wb, ws, `${employee.uid}_${employee.name.substring(0, 10)}`);
                });

                // Generate filename with current month and year
                const filename = `Attendance_Report_${currentMonth}_${currentYear}.xlsx`;
                XLSX.writeFile(wb, filename);
            }
            // Event Listeners
            $('.nn').on('click', function (e) {
                e.preventDefault();
                $('.nn').removeClass('active');
                $(this).addClass('active');
                currentView = $(this).data('tab');

                if (currentView === 'individual') {
                    $('#mainTableView').hide();
                    $('#individualView').show();
                } else {
                    $('#mainTableView').show();
                    $('#individualView').hide();
                    initializeTable(attendanceData, currentMonth, currentYear);
                }
            });

            $('#individualSearch').on('input', function () {
                const uid = $(this).val().trim();
                if (uid) {
                    renderIndividualView(uid);
                } else {
                    $('#individualData').html('<div class="alert alert-info">Enter a Staff UID to view their attendance details</div>');
                }
            });

            $('#exportBtn').on('click', exportToExcel);

            $('#attendanceForm').on('submit', function (e) {
                e.preventDefault();

                currentMonth = parseInt($('input[name="month"]').val());
                currentYear = parseInt($('input[name="year"]').val());

                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Generating...').prop('disabled', true);

                $.ajax({
                    url: 'hodleave_back.php',
                    method: 'POST',
                    data: {
                        action: 'get_areport_details',
                        month: currentMonth,
                        year: currentYear
                    },
                    success: function (response) {
                        if (typeof response === 'string') {
                            response = JSON.parse(response);
                        }

                        if (response.status === 200 && Array.isArray(response.data)) {
                            $('#tableContainer').fadeIn();
                            initializeTable(response.data, currentMonth, currentYear);
                        } else {
                            console.error('Invalid response format:', response);
                            alert('Error: Invalid data format received from server');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Ajax error:', error);
                        alert('Error fetching attendance data. Please try again.');
                    },
                    complete: function () {
                        submitBtn.html('<i class="fas fa-sync-alt mr-2"></i>Generate Report').prop('disabled', false);
                    }
                });
            });

        });
    </script>
</body>

</html>