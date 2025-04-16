<head>
    <link rel="stylesheet" href="datatable-styles.css">
</head>

<body>
    <div class="datatable-container">
        <div class="datatable-controls">
            <input type="text" class="datatable-search" placeholder="Search...">
            <select class="datatable-entries">
                <option value="5">5 per page</option>
                <option value="10" selected>10 per page</option>
                <option value="20">20 per page</option>
            </select>
        </div>
        <table class="datatable" id="OdTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th data-sort="ltype">OD Type <span class="sort-icon"></span></th>
                    <th data-sort="fdate">From <span class="sort-icon"></span></th>
                    <th data-sort="tdate">To <span class="sort-icon"></span></th>
                    <th data-sort="tdays">Total Days <span class="sort-icon"></span></th>
                    <th data-sort="reason">Reason <span class="sort-icon"></span></th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be dynamically inserted here -->
            </tbody>
        </table>
        <div class="datatable-pagination"></div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="datatable-script.js"></script>
    <script>
        function loadODTabDetails() {
            new DataTable('#OdTable', {
                ajaxUrl: 'hrleave_back.php',
                ajaxParams: { action: 'get_OD_details' },
                columns: [
                    { data: 'index' },
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
                                return `<button class="btn btn-primary btn-sm view-file-btn" 
                                data-file="Files/uploads/OD/${data}">View File</button>`;
                            }
                            return 'No file';
                        }
                    },
                    {
                        data: 'status',
                        render: function (data, row) {
                            switch (parseInt(data)) {
                                case 0:
                                    return `<button class="btn-sm btn-danger deleteO-btn"
                                    data-id="${row.id}"
                                    data-otype="${row.otype || ''}"
                                    data-file="${row.file || ''}"
                                    data-odtdays="${row.tdays}">Delete</button>`;
                                case 1:
                                    return '<button class="btn-sm btn-warning">Forwarded to HR</button>';
                                case 2:
                                    return '<button class="btn-sm btn-success">Approved</button>';
                                case 3:
                                    return '<button class="btn-sm btn-secondary">Rejected</button>';
                                default:
                                    return '<button class="btn-sm">Unknown Status</button>';
                            }
                        }
                    }
                ]
            });
        }




        // Add this JavaScript to handle the view button click
        $(document).ready(function () {
            $('#OdTable').on('click', '.view-file-btn', function () {
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
                $('#fileViewModal').modal('show');
            });
        });



        $(document).ready(function () {
            loadODTabDetails();
            // Event delegation for delete buttons
            $(document).on('click', '.deleteO-btn', function () {
                if (confirm('Are you sure you want to delete this leave record?')) {
                    const btn = $(this);
                    const leaveId = btn.data('id');
                    const leaveType = btn.data('otype');
                    const file_url = btn.data('file');
                    const totalDays = parseFloat(btn.data('odtdays'));

                    $.ajax({
                        url: 'hrleave_back.php',
                        type: 'POST',
                        data: {
                            action: 'delete_OD',
                            od_id: leaveId,
                            od_type: leaveType,
                            file_url: file_url,
                            total_days: totalDays
                        },
                        dataType: 'json',
                        success: function (response) {
                            alertify.set('notifier', 'position', 'top-right');
                            if (response.status === 200) {
                                alertify.success(response.message);
                                loadLeaveDetails();
                                loadODTabDetails();
                            } else {
                                alert(response.message || 'Error deleting leave record');
                            }
                        },
                        error: function () {
                            alert('An error occurred while processing your request');
                        }
                    });
                }
            });
        });


    </script>
<div class="modal fade" id="fileViewModal" data-bs-backdrop="false" tabindex="-1"
    aria-labelledby="fileViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 90%; width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileViewModalLabel">File View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background: none; border: none; color: white; font-size: 20px; padding: 0; line-height: 1;">
                    x
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