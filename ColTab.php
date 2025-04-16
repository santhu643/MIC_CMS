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
        <table class="datatable" id="ColTable">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th data-sort="ltype">Date<span class="sort-icon"></span></th>
                    <th data-sort="fdate">Reason <span class="sort-icon"></span></th>
                    <th data-sort="reason">Intime <span class="sort-icon"></span></th>
                    <th data-sort="reason">Outtime <span class="sort-icon"></span></th>
                    <th data-sort="reason">Days <span class="sort-icon"></span></th>
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
        function loadCOLTabDetails() {
            new DataTable('#ColTable', {
                ajaxUrl: 'hrleave_back.php',
                ajaxParams: { action: 'get_col_details' },
                columns: [
                    { data: 'index' },
                    { data: 'fdate' },
                    { data: 'reason' },
                    { data: 'intime' },
                    { data: 'outtime' },
                    { data: 'days' },
                    {
                        data: 'status',
                        render: function (data, row) {
                            switch (parseInt(data)) {
                                case 0:
                                    return `<button class="btn-sm btn-danger deletecol-btn"
                                    data-id="${row.id}">Delete</button>`;
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
            loadCOLTabDetails();
            // Event delegation for delete buttons
            $(document).on('click', '.deletecol-btn', function () {
                if (confirm('Are you sure you want to delete this leave record?')) {
                    const btn = $(this);
                    const leaveId = btn.data('id');
                    $.ajax({
                        url: 'hrleave_back.php',
                        type: 'POST',
                        data: {
                            action: 'delete_COL',
                            per_id: leaveId
                        },
                        dataType: 'json',
                        success: function (response) {
                            alertify.set('notifier', 'position', 'top-right');
                            if (response.status === 200) {
                                alertify.success(response.message);
                                loadLeaveDetails();
                                loadCOLTabDetails();
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