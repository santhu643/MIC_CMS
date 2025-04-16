<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Statistics Dashboard</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            --secondary-gradient: linear-gradient(135deg, #FF6B6B 0%, #FF0000 100%);
            --success-gradient: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
            --warning-gradient: linear-gradient(135deg, #F2994A 0%, #F2C94C 100%);
            --info-gradient: linear-gradient(135deg, #56CCF2 0%, #2F80ED 100%);
        }

        body {
            background: #f8f9fe;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .dashboard-header {
            background: var(--primary-gradient);
            padding: 2rem 0;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .dashboard-title {
            color: white;
            font-weight: 700;
            font-size: 2.5rem;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            position: relative;
        }

        .department-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .department-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .card-header-colored {
            background: var(--info-gradient);
            padding: 1.5rem;
            color: white;
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .computer-card .card-header-colored { background: var(--primary-gradient); }
        .mechanical-card .card-header-colored { background: var(--warning-gradient); }
        .electrical-card .card-header-colored { background: var(--success-gradient); }
        .civil-card .card-header-colored { background: var(--info-gradient); }
        .chemical-card .card-header-colored { background: var(--secondary-gradient); }

        .card-content {
            padding: 1.5rem;
        }

        .stat-row {
            background: #f8f9fe;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .stat-row:hover {
            background: #eef0f7;
            transform: translateX(5px);
        }

        .stat-label {
            color: #4a5568;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .stat-value {
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d3748;
        }

        .progress {
            height: 12px;
            border-radius: 6px;
            background: #edf2f7;
            margin-top: 1rem;
        }
        #faculty-table {
            margin: 0;
            width: 100%;
  padding: 0;
=
        }
        .faculty-table-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 2rem;
            margin-bottom: 2rem;
            width: 100%;
        }

        .faculty-table-header {
            background: var(--primary-gradient);
            padding: 1.5rem;
            color: white;
        }

        .faculty-table-header h3 {
            margin: 0;
            font-weight: 600;
        }

        .table-responsive {
            padding: 1rem;
        }

        #faculty-table thead th {
            background: #f8f9fe;
            font-weight: 600;
            color: #4a5568;
            border-bottom: none;
        }

        .dt-buttons .btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: white;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .dt-buttons .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 1.75rem;
            }

            .table-responsive {
                padding: 0.5rem;
            }

            .dt-buttons {
                margin-bottom: 1rem;
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .dt-buttons .btn {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .department-card {
            animation: slideIn 0.5s ease-out forwards;
            opacity: 0;
        }

        .department-card:nth-child(1) { animation-delay: 0.1s; }
        .department-card:nth-child(2) { animation-delay: 0.2s; }
        .department-card:nth-child(3) { animation-delay: 0.3s; }
        .department-card:nth-child(4) { animation-delay: 0.4s; }
        .department-card:nth-child(5) { animation-delay: 0.5s; }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="fas fa-chart-network mr-2"></i>
            Internship Statistics Dashboard
        </h1>
    </div>

    <div class="container-fluid px-4">
        <div class="row" id="department-cards">
            <!-- Department cards will be dynamically populated here -->
        </div>
        
        <div class="faculty-table-card">
            <div class="faculty-table-header">
                <h3>
                    <i class="fas fa-users mr-2"></i>
                    Faculty-wise Internship Details
                </h3>
            </div>
            <div class="table-responsive">
                <table id="faculty-table" class="table table-striped" style="width: 100px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Faculty Name</th>
                            <th>Department</th>
                            <th>Total Internships</th>
                            <th>Approved</th>
                            <th>Pending</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script>
    $(document).ready(function() {
        // Department-wise Internship Count
        $.ajax({
            url: "get_internship_stats.php",
            type: "POST",
            data: { type: "department" },
            dataType: "json",
            success: function(data) {
                let departmentCardsHtml = '';
                $.each(data, function(index, row) {
                    let totalInternships = parseInt(row.total_internships);
                    let approvedInternships = parseInt(row.status_1);
                    let pendingInternships = parseInt(row.status_0);
                    
                    let completionPercentage = totalInternships > 0 
                        ? Math.round((approvedInternships / totalInternships) * 100) 
                        : 0;
                    
                    let progressColor = completionPercentage < 30 
                        ? 'bg-danger' 
                        : completionPercentage < 70 
                        ? 'bg-warning' 
                        : 'bg-success';

                    let departmentClass = row.dept.toLowerCase() + '-card';
                    let departmentIcon = 
                        row.dept === 'Computer' ? 'fa-laptop-code' :
                        row.dept === 'Mechanical' ? 'fa-cogs' :
                        row.dept === 'Electrical' ? 'fa-bolt' :
                        row.dept === 'Civil' ? 'fa-hard-hat' :
                        'fa-flask';

                    departmentCardsHtml += `
                        <div class="col-md-4">
                            <div class="department-card ${departmentClass}">
                                <div class="card-header-colored">
                                    <span><i class="fas ${departmentIcon} mr-2"></i>${row.dept}</span>
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div class="card-content">
                                    <div class="stat-row">
                                        <span class="stat-label">
                                            <i class="fas fa-users mr-2"></i>
                                            Total Internships
                                        </span>
                                        <span class="stat-value">${row.total_internships}</span>
                                    </div>
                                    <div class="stat-row">
                                        <span class="stat-label">
                                            <i class="fas fa-check-circle mr-2 text-success"></i>
                                            Approved
                                        </span>
                                        <span class="stat-value text-success">${row.status_1}</span>
                                    </div>
                                    <div class="stat-row">
                                        <span class="stat-label">
                                            <i class="fas fa-clock mr-2 text-warning"></i>
                                            Pending
                                        </span>
                                        <span class="stat-value text-warning">${row.status_0}</span>
                                    </div>
                                    <div class="mt-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="small font-weight-bold">Completion Rate</span>
                                            <span class="small font-weight-bold">${completionPercentage}%</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar ${progressColor}" 
                                                 role="progressbar" 
                                                 style="width: ${completionPercentage}%;" 
                                                 aria-valuenow="${completionPercentage}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });
                $("#department-cards").html(departmentCardsHtml);
            }
        });

        // Faculty-wise Internship Count with DataTables
        $.ajax({
            url: "get_internship_stats.php",
            type: "POST",
            data: { type: "faculty" },
            dataType: "json",
            success: function(data) {
                $('#faculty-table').DataTable({
                    data: data,
                    columns: [
                        { data: 'faculty_id' },
                        { 
                            data: 'faculty_name',
                            render: function(data, type, row) {
                                return `<div class="d-flex align-items-center">
                                    <i class="fas fa-user-tie mr-2 text-primary"></i>
                                    <span>${data}</span>
                                </div>`;
                            }
                        },
                        { 
                            data: 'dept',
                            render: function(data, type, row) {
                                let icon = 
                                    data === 'Computer' ? 'fa-laptop-code' :
                                    data === 'Mechanical' ? 'fa-cogs' :
                                    data === 'Electrical' ? 'fa-bolt' :
                                    data === 'Civil' ? 'fa-hard-hat' :
                                    'fa-flask';
                                return `<div class="d-flex align-items-center">
                                    <i class="fas ${icon} mr-2"></i>
                                    <span>${data}</span>
                                </div>`;
                            }
                        },
                        { 
                            data: 'total_internships',
                            className: 'text-center font-weight-bold'
                        },
                        { 
                            data: 'status_1',
                            className: 'text-center',
                            render: function(data, type, row) {
                                return `<span class="text-success">
                                    <i class="fas fa-check-circle mr-1"></i>${data}
                                </span>`;
                            }
                        },
                        { 
                            data: 'status_0',
                            className: 'text-center',
                            render: function(data, type, row) {
                                return `<span class="text-warning">
                                    <i class="fas fa-clock mr-1"></i>${data}
                                </span>`;
                            }
                        }
                    ],
                    dom: '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>rtip',
                    buttons: [
                        {
                            extend: 'copy',
                            className: 'btn btn-sm'
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-sm'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-sm'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-sm'
                        }
                    ],
                    pageLength: 10,
                    language: {
                        search: '<i class="fas fa-search"></i>',
                        searchPlaceholder: "Search faculty..."
                    },
                    order: [[1, 'asc']],
                    responsive: true,
                    scrollX: true
                });
            }
        });
    });
    </script>
</body>
</html>