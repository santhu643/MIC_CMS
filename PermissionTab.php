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
        <table class="datatable" id="PerTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th data-sort="ltype">Permission Type <span class="sort-icon"></span></th>
                    <th data-sort="fdate">Date <span class="sort-icon"></span></th>
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
        function loadPERTabDetails() {
            new DataTable('#PerTable', {
                ajaxUrl: 'hrleave_back.php',
                ajaxParams: { action: 'get_per_details' },
                columns: [
                    { data: 'index' },
                    { data: 'ltype' },
                    { data: 'fdate' },
                    { data: 'reason' },
 
                    {
                        data: 'status',
                        render: function (data, row) {
                            switch (parseInt(data)) {
                                case 0:
                                    return `<button class="btn-sm btn-danger deleteP-btn"
                                    data-id="${row.id}"
                                    data-fdate="${row.fdate}"
                                    data-ltype="${row.ltype || ''}">Delete</button>`;
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


        $(document).ready(function () {
            loadPERTabDetails();
            // Event delegation for delete buttons
            $(document).on('click', '.deleteP-btn', function () {
                if (confirm('Are you sure you want to delete this leave record?')) {
                    const btn = $(this);
                    const leaveId = btn.data('id');
                    const leaveType = btn.data('ltype');
                    const fdate = btn.data('fdate');

                    $.ajax({
                        url: 'hrleave_back.php',
                        type: 'POST',
                        data: {
                            action: 'delete_PER',
                            per_id: leaveId,
                            per_type: leaveType,
                            fdate:fdate
                        },
                        dataType: 'json',
                        success: function (response) {
                            alertify.set('notifier', 'position', 'top-right');
                            if (response.status === 200) {
                                alertify.success(response.message);
                                loadLeaveDetails();
                                loadPERTabDetails();
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