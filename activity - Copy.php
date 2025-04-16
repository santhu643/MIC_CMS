<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Statistics Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        :root {
            --soft-blue: #4A90E2;
            --soft-green: #2ECC71;
            --soft-orange: #F39C12;
            --soft-purple: #9B59B6;
            --soft-red: #E74C3C;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-title {
            color: #2c3e50;
            font-weight: 300;
            margin-bottom: 30px;
            text-align: center;
        }

        .department-card {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            background: white;
        }

        .department-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background-size: 200% 100%;
            transition: all 0.5s ease;
        }

        .department-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.15);
        }

        .card-header-colored {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-weight: 600;
        }

        .card-content {
            padding: 20px;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .stat-label {
            font-weight: 500;
            color: #495057;
        }

        .stat-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .progress {
            height: 25px;
            border-radius: 15px;
            background-color: #e9ecef;
            overflow: hidden;
        }

        .progress-bar {
            border-radius: 15px;
            font-weight: 600;
        }

        /* Unique color schemes for departments */
        .computer-card::before { background-image: linear-gradient(to right, var(--soft-blue), #3498db); }
        .mechanical-card::before { background-image: linear-gradient(to right, var(--soft-orange), #f1c40f); }
        .electrical-card::before { background-image: linear-gradient(to right, var(--soft-green), #27ae60); }
        .civil-card::before { background-image: linear-gradient(to right, var(--soft-purple), #8e44ad); }
        .chemical-card::before { background-image: linear-gradient(to right, var(--soft-red), #c0392b); }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <h1 class="dashboard-title">Internship Statistics Dashboard</h1>
        
        <!-- Department Statistics Section -->
        <div class="row" id="department-cards">
            <!-- Department cards will be dynamically populated here -->
        </div>
        
        <!-- Faculty Internship DataTable -->
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Faculty-wise Internship Details</h3>
            </div>
            <div class="card-body">
                <table id="faculty-table" class="table table-striped">
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

    <!-- jQuery and other scripts remain the same as previous example -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
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
                        // Calculate completion percentage
                        let totalInternships = parseInt(row.total_internships);
                        let approvedInternships = parseInt(row.status_1);
                        let pendingInternships = parseInt(row.status_0);
                        
                        // Calculate completion percentage
                        let completionPercentage = totalInternships > 0 
                            ? Math.round((approvedInternships / totalInternships) * 100) 
                            : 0;
                        
                        // Determine progress bar color
                        let progressColor = completionPercentage < 30 
                            ? 'bg-danger' 
                            : completionPercentage < 70 
                            ? 'bg-warning' 
                            : 'bg-success';

                        // Create class name for department-specific styling
                        let departmentClass = row.dept.toLowerCase() + '-card';

                        departmentCardsHtml += `
                        <div class="col-md-4 mb-4">
                            <div class="department-card ${departmentClass}">
                                <div class="card-header-colored" style="background-color: ${
                                    row.dept === 'Computer' ? 'var(--soft-blue)' :
                                    row.dept === 'Mechanical' ? 'var(--soft-orange)' :
                                    row.dept === 'Electrical' ? 'var(--soft-green)' :
                                    row.dept === 'Civil' ? 'var(--soft-purple)' :
                                    'var(--soft-red)'
                                }">
                                    <span>${row.dept} Department</span>
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <div class="card-content">
                                    <div class="stat-row">
                                        <span class="stat-label">Total Internships</span>
                                        <span class="stat-value">${row.total_internships}</span>
                                    </div>
                                    <div class="stat-row">
                                        <span class="stat-label">Approved</span>
                                        <span class="stat-value text-success">${row.status_1}</span>
                                    </div>
                                    <div class="stat-row">
                                        <span class="stat-label">Pending</span>
                                        <span class="stat-value text-warning">${row.status_0}</span>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar ${progressColor}" 
                                                 role="progressbar" 
                                                 style="width: ${completionPercentage}%;" 
                                                 aria-valuenow="${completionPercentage}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                ${completionPercentage}% Completed
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
                            { data: 'faculty_name' },
                            { data: 'dept' },
                            { data: 'total_internships' },
                            { data: 'status_1' },
                            { data: 'status_0' }
                        ],
                        dom: 'Bfrtip', // Buttons
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf'
                        ],
                        pageLength: 10,
                        language: {
                            searchPlaceholder: "Search faculty..."
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>