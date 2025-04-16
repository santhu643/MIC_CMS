<!DOCTYPE html>
<html>

<head>
  <title>Leave Balance Table</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
  <div class="container my-5">
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