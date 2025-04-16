<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extracurricular</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .modal-content {
            border-radius: 0.5rem;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }

        .btn-update {
            background-color: #28a745;
            color: white;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .dataTables_wrapper {
            padding: 20px;
        }

        /* PDF viewer styles */
        .modal-body.certificate-viewer {
            height: 80vh;
            padding: 0;
            overflow: hidden;
        }

        .certificate-viewer #certContainer {
            width: 100%;
            height: 100%;
        }

        .certificate-viewer iframe,
        .certificate-viewer img {
            width: 100%;
            height: 100%;
            border: none;
            object-fit: contain;
        }

        /* Additional responsive styles */
        @media (max-width: 768px) {
            .modal-body.certificate-viewer {
                height: 60vh;
            }
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Extra curricular Records</h4>
            </div>
            <div class="card-body">
                <table id="internshipTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic data from the database will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Year Update Modal -->
    <div class="modal fade" id="yearModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Academic Year</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateYearForm">
                        <input type="hidden" id="recordId" name="recordId">
                        <div class="form-group">
                            <label for="academicYear">Select Year:</label>
                            <select class="form-control" id="academicYear" name="academicYear">
                            <option value="2020-2021">2020-2021</option>
                                <option value="2021-2022">2021-2022</option>
                                <option value="2022-2023">2022-2023</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2024-2025">2024-2025</option>
                            </select>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                    <input type="hidden" id="deleteRecordId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificate Modal -->
    <div class="modal fade" id="certModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Certificate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body certificate-viewer">
                    <div id="certContainer"></div>
                </div>
                <div class="modal-footer">
                    <a id="downloadBtn" href="#" class="btn btn-primary" download>
                        <i class="fas fa-download mr-1"></i> Download
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

    <script>
        // Load table data
        function loadTable() {
            $.ajax({
                url: 'ueco_back.php',
                type: 'POST',
                data: { action: 'fetch' },
                success: function (data) {
                    $('#internshipTable tbody').html(data);

                    // Destroy existing DataTable if it exists
                    if (dataTable) {
                        dataTable.destroy();
                    }

                    // Initialize new DataTable
                    dataTable = $('#internshipTable').DataTable({
                        responsive: true,
                        order: [[0, 'desc']],
                        language: {
                            search: "Search records:",
                            lengthMenu: "Show _MENU_ records per page",
                            info: "Showing _START_ to _END_ of _TOTAL_ records",
                            paginate: {
                                first: "First",
                                last: "Last",
                                next: "Next",
                                previous: "Previous"
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error loading table data:", error);
                    alert("Error loading data. Please try again.");
                }
            });
        }

        $(document).ready(function () {
            let dataTable = null;



            // Initial table load
            loadTable();

            // Handle year update modal
            $(document).on('click', '.updateYearBtn', function () {
                const id = $(this).data('id');
                const currentYear = $(this).closest('tr').find('td:eq(2)').text().trim();

                $('#recordId').val(id);
                $('#academicYear').val(currentYear);
                $('#yearModal').modal('show');
            });

            // Handle delete button click
            $(document).on('click', '.deleteBtn', function () {
                const id = $(this).data('id');
                $('#deleteRecordId').val(id);
                $('#deleteModal').modal('show');
            });

            // Handle delete confirmation
            $('#confirmDelete').click(function () {
                const id = $('#deleteRecordId').val();

                $.ajax({
                    url: 'ueco_back.php',
                    type: 'POST',
                    data: {
                        action: 'delete',
                        recordId: id
                    },
                    success: function (response) {
                        $('#deleteModal').modal('hide');
                        alert(response);
                        loadTable();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error deleting record:", error);
                        alert("Error deleting record. Please try again.");
                    }
                });
            });

            // Handle year update form submission
            $('#updateYearForm').submit(function (e) {
                e.preventDefault();

                const formData = {
                    action: 'update',
                    recordId: $('#recordId').val(),
                    academicYear: $('#academicYear').val()
                };

                $.ajax({
                    url: 'ueco_back.php',
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        $('#updateYearForm button[type="submit"]').prop('disabled', true);
                    },
                    success: function (response) {
                        alert(response);
                        $('#yearModal').modal('hide');
                        loadTable();
                    },
                    error: function (xhr, status, error) {
                        console.error("Error updating year:", error);
                        alert("Error updating year. Please try again.");
                    },
                    complete: function () {
                        $('#updateYearForm button[type="submit"]').prop('disabled', false);
                    }
                });
            });

            // Handle certificate view modal
            $(document).on('click', '.viewCertBtn', function () {
                const certPath = $(this).data('cert');
                const fileName = certPath.split('/').pop();
                const fileExtension = fileName.split('.').pop().toLowerCase();
                const container = $('#certContainer');

                container.empty();

                $('#downloadBtn')
                    .attr('href', certPath)
                    .attr('download', fileName);

                if (fileExtension === 'pdf') {
                    const iframe = $('<iframe>', {
                        src: certPath + '#toolbar=0&navpanes=0',
                        type: 'application/pdf',
                        width: '100%',
                        height: '100%'
                    });
                    container.append(iframe);
                } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    const img = $('<img>', {
                        src: certPath,
                        alt: 'Certificate',
                        class: 'img-fluid'
                    });
                    container.append(img);
                } else {
                    container.html('<div class="alert alert-warning m-3">Unsupported file type. Please download the file to view it.</div>');
                }

                $('#certModal').modal('show');
            });

            // Handle modal cleanup on close
            $('#certModal').on('hidden.bs.modal', function () {
                $('#certContainer').empty();
            });
        });
    </script>
</body>

</html>