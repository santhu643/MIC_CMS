<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Balances</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="datatable-styles.css">
    <style>
        .nav-tabs .nav-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            margin-right: 5px;
        }

        .nav-tabs .nav-link.active {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .table thead th {
            background-color: #7b68ee;
            color: white;
            font-weight: 500;
            border: none;
        }

        .table td {
            vertical-align: middle;
        }

        .search-box {
            max-width: 250px;
        }

        .pagination {
            margin-bottom: 0;
        }

        .rows-per-page {
            width: 70px;
        }

        #loadingSpinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid py-4">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="leave-approval-tab" data-toggle="tab" href="#leave-approval" role="tab">
                    Leave Approval
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="od-approval-tab" data-toggle="tab" href="#od-approval" role="tab">
                    OD Approval
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="permission-approval-tab" data-toggle="tab" href="#permission-approval"
                    role="tab">
                    Permission Approval
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="leave-request-tab" data-toggle="tab" href="#leave-request" role="tab">
                    Leave Request Approval
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="od-request-tab" data-toggle="tab" href="#od-request" role="tab">
                    OD Request Approval
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Leave Approval Tab -->
            <div class="tab-pane fade" id="leave-approval" role="tabpanel">
                <!-- Content for Leave Approval -->
            </div>

            <!-- OD Approval Tab -->
            <div class="tab-pane fade" id="od-approval" role="tabpanel">
                <!-- Content for OD Approval -->
            </div>

            <!-- Permission Approval Tab -->
            <div class="tab-pane fade" id="permission-approval" role="tabpanel">
                <!-- Content for Permission Approval -->
            </div>

            <!-- Leave Request Tab -->
            <div class="tab-pane fade" id="leave-request" role="tabpanel">
                <!-- Content for Leave Request -->
            </div>

            <!-- OD Request Tab (Active by default) -->
            <div class="tab-pane fade show active" id="od-request" role="tabpanel">
                <!-- Leave Balances Section -->

            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Leave Balances</h5>
                <input type="text" class="form-control search-box" placeholder="Search...">
            </div>
            <div class="card-body p-0 position-relative">
                <div id="loadingSpinner" class="spinner-border text-primary d-none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="leaveBalanceTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>CL</th>
                                <th>COL</th>
                                <th>ODB</th>
                                <th>ODR</th>
                                <th>ODP</th>
                                <th>ODO</th>
                                <th>VL</th>
                                <th>ML</th>
                                <th>MAL</th>
                                <th>MTL</th>
                                <th>PTL</th>
                                <th>SL</th>
                                <th>SPL</th>
                                <th>PER</th>
                                <th>PER 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table data will be dynamically populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
       $(document).ready(function () {
      $('#leaveBalanceTable').DataTable({
        ajax: {
          url: 'hodleave_back.php',
          type: 'POST',
          data: { action: 'get_leave_balance_details' }
        },
        columns: [
          {
            data: null, render: function (data, type, row, meta) {
              return meta.row + 1;
            }
          },
          { data: 'id' },
          { data: 'name' },
          { data: 'cl' },
          { data: 'col' },
          { data: 'odb' },
          { data: 'odr' },
          { data: 'odp' },
          { data: 'odo' },
          { data: 'vl' },
          { data: 'ml' },
          { data: 'mal' },
          { data: 'mtl' },
          { data: 'ptl' },
          { data: 'sl' },
          { data: 'spl' },
          { data: 'pm' },
          { data: 'tenpm' }
        ]
      });
    });

        
    </script>
</body>

</html>