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
        <table class="datatable" id="leaveTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th data-sort="ltype">Leave Type <span class="sort-icon"></span></th>
                    <th data-sort="fdate">From <span class="sort-icon"></span></th>
                    <th data-sort="tdate">To <span class="sort-icon"></span></th>
                    <th data-sort="tdays">Total Days <span class="sort-icon"></span></th>
                    <th data-sort="reason">Reason <span class="sort-icon"></span></th>
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
        function loadLeaveTabDetails() {
            new DataTable('#leaveTable', {
                ajaxUrl: 'hrleave_back.php',
                ajaxParams: { action: 'get_leave_details' },
                columns: [
                    { data: 'index' },
                    { data: 'ltype' },
                    { data: 'fdate' },
                    { data: 'tdate' },
                    { data: 'tdays' },
                    { data: 'reason' },
                    {
                        data: 'status',
                        render: function (data, row) {
                            switch (parseInt(data)) {
                                case 0:
                                    return `<button class="btn-sm btn-danger deleteL-btn" 
                                            data-id="${row.id}" 
                                            data-ltype="${row.ltype}" 
                                            data-tdays="${row.tdays}">Delete</button>`;
                                case 1:
                                    return '<button class="btn-sm btn-warning">Forwarded to HR</button>';
                                case 2:
                                    return '<button class="btn-sm btn-success">Approved</button>';
                                case 3:
                                    return `
                                            <div class="d-flex align-items-center">
                                                <button class="btn-sm btn-secondary mr-2">Rejected</button>
                                                <i class="fas fa-info-circle text-danger" 
                                                data-toggle="tooltip" 
                                                data-html="true"
                                                title="${escapeHtml(row.info || 'No additional information')}"
                                                ></i>
                                            </div>`;
                                default:
                                    return '<button class="btn-sm">Unknown Status</button>';
                            }
                        }
                    }
                ],
                // Add tooltip initialization
        initComplete: function () {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        }

        function escapeHtml(unsafe) {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        $(document).ready(function () {
            loadLeaveTabDetails();
            // Event delegation for delete buttons
            $(document).on('click', '.deleteL-btn', function () {
                if (confirm('Are you sure you want to delete this leave record?')) {
                    const btn = $(this);
                    const leaveId = btn.data('id');
                    const leaveType = btn.data('ltype');
                    const totalDays = parseFloat(btn.data('tdays'));

                    $.ajax({
                        url: 'hrleave_back.php',
                        type: 'POST',
                        data: {
                            action: 'delete_leave',
                            leave_id: leaveId,
                            leave_type: leaveType,
                            total_days: totalDays
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 200) {
                                alert(response.message);
                                loadLeaveDetails();
                                loadLeaveTabDetails();
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
</body>

</html>