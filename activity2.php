<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Activities Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-buttons-bs4/2.2.3/buttons.bootstrap4.min.css">

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
        }

        body {
            background-color: #f8f9fc;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .filter-section {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
        }

        .nav-tabs {
            border-bottom: 2px solid #e3e6f0;
        }

        .nav-tabs .nav-link {
            border: none;
            color: var(--secondary-color);
            font-weight: 600;
            padding: 1rem 1.5rem;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
            margin-bottom: -2px;
        }

        .stats-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, 0.15);
            transition: transform 0.2s;
            margin-bottom: 1.5rem;
        }

        .stats-card:hover {
            transform: translateY(-3px);
        }

        .stats-card .card-header {
            background: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }

        .stats-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-total {
            background: #eaecf4;
            color: #4e73df;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
        }

        .hidden-table {
            display: none;
        }

        .export-buttons {
            margin: 1rem 0;
        }

        .export-buttons .btn {
            margin-right: 0.5rem;
            border-radius: 0.35rem;
        }

        /* Faculty Table Styling */
        #facultyTable {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem rgba(58, 59, 69, 0.15);
        }

        #facultyTable thead th {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 1rem;
        }

        #facultyTable tbody tr:nth-of-type(odd) {
            background-color: #f8f9fc;
        }

        #facultyTable tbody tr:hover {
            background-color: #eaecf4;
        }

        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loading .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>

<body>
    <div class="dashboard-header">
        <div class="container-fluid">
            <h1 class="mb-0">Student Activities Dashboard</h1>
        </div>
    </div>

    <div class="container-fluid">
        <div class="filter-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="yearSelect">Select Academic Year:</label>
                        <select class="form-control" id="yearSelect">
                            <option value="">All Years</option>
                            <option value="2024-2025">2024-25</option>
                            <option value="2023-2024">2023-24</option>
                            <option value="2022-2023">2022-23</option>
                            <option value="2021-2022">2021-22</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="batchSelect">Select Batch:</label>
                        <select class="form-control" id="batchSelect">
                            <option value="">All Years</option>
                            <option value="2024-2028">2024-28</option>
                            <option value="2023-2027">2023-27</option>
                            <option value="2022-2026">2022-26</option>
                            <option value="2021-2025">2021-25</option>
                            <option value="2020-2024">2020-24</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Department Stats -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Department Statistics</h3>
                    <div class="export-buttons">
                        <button class="btn btn-primary btn-sm export-csv">Export CSV</button>
                        <button class="btn btn-primary btn-sm export-excel">Export Excel</button>
                        <button class="btn btn-primary btn-sm export-pdf">Export PDF</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="activityTabs" role="tablist"></ul>
                <div class="tab-content mt-4" id="activityTabContent"></div>

                <!-- Hidden table for export functionality -->
                <div class="hidden-table">
                    <table id="departmentTable" class="table">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Activity Type</th>
                                <th>Total Count</th>
                                <th>Approved Count</th>
                                <th>Pending Count</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Faculty Stats -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h3 class="mb-0">Faculty Statistics</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="facultyTable" class="table">
                        <thead>
                            <tr>
                                <th>Faculty Name</th>
                                <th>Department</th>
                                <th>Internships</th>
                                <th>Certifications</th>
                                <th>Projects</th>
                                <th>Languages</th>
                                <th>Co-curricular</th>
                                <th>Extra-curricular</th>
                                <th>Placements</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="loading d-none">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 400">
            <g transform="translate(300, 200)">
                <!-- Multiple ripple circles -->
                <circle cx="0" cy="0" r="5" fill="none" stroke="#9B59B6" stroke-width="2">
                    <animate attributeName="r" values="5;40" dur="2s" repeatCount="indefinite" />
                    <animate attributeName="opacity" values="1;0" dur="2s" repeatCount="indefinite" />
                </circle>
                <circle cx="0" cy="0" r="5" fill="none" stroke="#9B59B6" stroke-width="2">
                    <animate attributeName="r" values="5;40" begin="0.5s" dur="2s" repeatCount="indefinite" />
                    <animate attributeName="opacity" values="1;0" begin="0.5s" dur="2s" repeatCount="indefinite" />
                </circle>
                <circle cx="0" cy="0" r="5" fill="none" stroke="#9B59B6" stroke-width="2">
                    <animate attributeName="r" values="5;40" begin="1s" dur="2s" repeatCount="indefinite" />
                    <animate attributeName="opacity" values="1;0" begin="1s" dur="2s" repeatCount="indefinite" />
                </circle>
                <circle cx="0" cy="0" r="5" fill="#9B59B6" />

                <text font-family="Arial" font-size="10" fill="#9B59B6" text-anchor="middle">
                    <tspan x="0" y="60">Fueling Your Request...</tspan>
                    <tspan x="0" y="75">Crafting The Perfect Reply..😊😊</tspan>
                    <animate attributeName="opacity" values="0.6;1;0.6" dur="2s" repeatCount="indefinite" />
                </text>
            </g>
        </svg>

    </div>

    <!-- Required JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function () {
            let departmentTable, facultyTable;

            // Initialize DataTables
            function initializeTables() {
                departmentTable = $('#departmentTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'csv', 'excel', 'pdf'
                    ],
                    columns: [
                        { data: 'dept' },
                        { data: 'activity_type' },
                        { data: 'total_count' },
                        { data: 'approved_count' },
                        { data: 'pending_count' }
                    ]
                });

                facultyTable = $('#facultyTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'pdf',
                            orientation: 'landscape', // Set to landscape mode
                            pageSize: 'A4', // Use A4 size
                            title: 'Department Activities Report', // Add a title
                            exportOptions: {
                                columns: ':visible' // Export all visible columns
                            },
                            customize: function (doc) {
                                // Optional: Customize PDF styling
                                doc.styles.tableHeader = {
                                    fillColor: '#4e73df',
                                    color: 'white',
                                    bold: true
                                };
                            }
                        },
                        'csv',
                        'excel'
                    ],
                    columns: [
                        { data: 'faculty_name' },
                        { data: 'dept' },
                        { data: 'internships' }, // Combined internships
                        { data: 'certifications' }, // Combined certifications
                        { data: 'projects' }, // Combined projects
                        { data: 'languages' }, // Combined languages
                        { data: 'cocurricular' }, // Combined cocurricular
                        { data: 'extracurricular' }, // Combined extracurricular
                        { data: 'placements' } // Combined placements
                    ]
                });
            }

            // Create department stats cards
            function createDepartmentCards(activityType, departments) {
                let cardsHtml = '<div class="row">';

                departments.forEach(dept => {
                    cardsHtml += `
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="card-header">
                                    <h5 class="mb-0">${dept.dept}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="stats-label">Total</span>
                                        <span class="status-badge status-total">${dept.total_count}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="stats-label">Pending</span>
                                        <span class="status-badge status-pending">${dept.pending_count}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="stats-label">Approved</span>
                                        <span class="status-badge status-approved">${dept.approved_count}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                cardsHtml += '</div>';
                return cardsHtml;
            }

            // Fetch and process data
            function fetchData(year = '', batch = '') {
                $('.loading').removeClass('d-none');

                // Fetch department stats
                $.ajax({
                    url: 'act_back.php',
                    data: { type: 'department', year: year, batch: batch }, // Pass batch here
                    method: 'GET',
                    success: function (response) {
                        const processedData = [];

                        // Clear existing tabs and content
                        $('#activityTabs').empty();
                        $('#activityTabContent').empty();

                        // Create tabs and content for each activity type
                        Object.entries(response).forEach(([activityType, departments], index) => {
                            // Create tab
                            const tabId = activityType.toLowerCase().replace(/\s+/g, '-');
                            $('#activityTabs').append(`
                    <li class="nav-item">
                        <a class="nav-link ${index === 0 ? 'active' : ''}" 
                           id="${tabId}-tab" 
                           data-toggle="tab" 
                           href="#${tabId}" 
                           role="tab">${activityType}</a>
                    </li>
                `);

                            // Create tab content
                            $('#activityTabContent').append(`
                    <div class="tab-pane fade ${index === 0 ? 'show active' : ''}" 
                         id="${tabId}" 
                         role="tabpanel">
                        ${createDepartmentCards(activityType, departments)}
                    </div>
                `);

                            // Process data for hidden table
                            departments.forEach(dept => {
                                processedData.push({
                                    dept: dept.dept,
                                    activity_type: activityType,
                                    total_count: dept.total_count,
                                    pending_count: dept.pending_count,
                                    approved_count: dept.approved_count
                                });
                            });
                        });
                        // Update hidden table for export functionality
                        departmentTable.clear().rows.add(processedData).draw();
                    }
                });

                // Fetch faculty stats
                $.ajax({
                    url: 'act_back.php',
                    data: { type: 'faculty', year: year, batch: batch }, // Pass batch here
                    method: 'GET',
                    success: function (response) {
                        const processedData = response.map(item => ({
                            faculty_name: item.faculty_name,
                            dept: item.dept,
                            internships: `Total: ${item.total_internships}</br>Approved: ${item.approved_internships}<br>Pending: ${item.pending_internships}`,
                            certifications: `Total: ${item.total_certifications}<br>Approved: ${item.approved_certifications}<br>Pending: ${item.pending_certifications}`,
                            projects: `Total: ${item.total_projects}<br>Approved: ${item.approved_projects}<br>Pending: ${item.pending_projects}`,
                            languages: `Total: ${item.total_languages}<br>Approved: ${item.approved_languages}<br>Pending: ${item.pending_languages}`,
                            cocurricular: `Total: ${item.total_cocurricular}<br>Approved: ${item.approved_cocurricular}<br>Pending: ${item.pending_cocurricular}`,
                            extracurricular: `Total: ${item.total_extracurricular}<br>Approved: ${item.approved_extracurricular}<br>Pending: ${item.pending_extracurricular}`,
                            placements: `Total: ${item.total_placements}<br>Approved: ${item.approved_placements}<br>Pending: ${item.pending_placements}`
                        }));
                        facultyTable.clear().rows.add(processedData).draw();
                    },
                    complete: function () {
                        $('.loading').addClass('d-none');
                    }
                });
            }

            // Initialize tables and fetch initial data
            initializeTables();
            fetchData();

            // Handle year selection
            $('#yearSelect').on('change', function () {
                fetchData($(this).val());
            });

            //  batch selection
            $('#batchSelect').on('change', function () {
                fetchData($('#yearSelect').val(), $(this).val()); // Pass the selected year and batch value
            });

            // Handle export button clicks
            $('.export-csv').on('click', function () {
                departmentTable.button('.buttons-csv').trigger();
            });

            $('.export-excel').on('click', function () {
                departmentTable.button('.buttons-excel').trigger();
            });

            $('.export-pdf').on('click', function () {
                departmentTable.button('.buttons-pdf').trigger();
            });
        });
    </script>
</body>

</html>