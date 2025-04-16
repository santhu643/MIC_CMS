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
        <table class="datatable" id="ROdTable">
            <thead>
                <tr>
                    <th>S.No</th>
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
        function loadRODTabDetails() {
            new DataTable('#ROdTable', {
                ajaxUrl: 'hrleave_back.php',
                ajaxParams: { action: 'get_ROD_details' },
                columns: [
                    { data: 'index' },
                    { data: 'fdate' },
                    { data: 'tdate' },
                    { data: 'tdays' },
                    { data: 'reason' },
                    {
                        // View column with updated file path
                        data: 'file',
                        render: function (data, type, row) {
                            if (data) {
                                return `<button class="btn btn-primary btn-sm view2-file-btn" 
                                data-file="Files/uploads/ODR/${data}">View File</button>`;
                            }
                            return 'No file';
                        }
                    },
                    {
                        data: 'status',
                        render: function (data, row) {
                            switch (parseInt(data)) {
                                case 0:
                                    return `<button class="btn-sm btn-danger deleteRO-btn"
                                    data-id="${row.id}"
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
            $('#ROdTable').on('click', '.view2-file-btn', function () {
                const fileUrl = $(this).data('file');
                const fileExt = fileUrl.split('.').pop().toLowerCase();
                const fileContent4 = $('#fileContent4');

                // Clear previous content
                fileContent4.empty();

                // Check file type and display accordingly
                if (fileExt === 'pdf') {
                    fileContent4.html(`<embed src="${fileUrl}" type="application/pdf" width="100%" height="600px">`);
                } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExt)) {
                    fileContent4.html(`<img src="${fileUrl}" class="img-fluid" alt="Document">`);
                } else {
                    fileContent4.html('<p class="text-danger">Unsupported file type</p>');
                }

                // Show the modal
                $('#fileViewModal4').modal('show');
            });
        });



        $(document).ready(function () {
            loadRODTabDetails();
            // Event delegation for delete buttons
            $(document).on('click', '.deleteRO-btn', function () {
                if (confirm('Are you sure you want to delete this leave record?')) {
                    const btn = $(this);
                    const leaveId = btn.data('id');
                    const file_url = btn.data('file');
                    const totalDays = parseFloat(btn.data('odtdays'));

                    $.ajax({
                        url: 'hrleave_back.php',
                        type: 'POST',
                        data: {
                            action: 'delete_ROD',
                            od_id: leaveId,
                            file_url: file_url,
                            total_days: totalDays
                        },
                        dataType: 'json',
                        success: function (response) {
                            alertify.set('notifier', 'position', 'top-right');
                            if (response.status === 200) {
                                alertify.success(response.message);
                                loadLeaveDetails();
                                loadRODTabDetails();
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
<div class="modal fade" id="fileViewModal4" data-bs-backdrop="false" tabindex="-1"
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
                <div id="fileContent4" class="text-center">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>


</body>


</html>