<head>
    <style>
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            max-width: 1600px;
        }

        .tab-button {
            padding: 10px 20px;
            border: none;
            color: white;
            cursor: pointer;
            margin-right: 10px;
        }

        .tab-button.active {
            font-weight: bold;
        }

        .tab-content {
            padding: 20px;
            border: 1px solid #ddd;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
        }

        @media (max-width: 1200px) {
            .tab-content {
                width: 1200px;
            }
        }

        .datatable-container {
            font-family: Arial, sans-serif;
            max-width: 1600px !important;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="tabs">
            <button class="tab-button active" onclick="handleTabChange('leave')" style="background-color: #4CAF50;">
                Leave Details
            </button>
            <button class="tab-button" onclick="handleTabChange('od')" style="background-color: #2196F3;">
                OD Details
            </button>
            <button class="tab-button" onclick="handleTabChange('permission')" style="background-color: #FF9800;">
                Permission Details
            </button>
            <button class="tab-button" onclick="handleTabChange('col')" style="background-color: #F44336;">
                COL Request Details
            </button>
            <button class="tab-button" onclick="handleTabChange('odr')" style="background-color: #2255a4;">
                ODR Request Details
            </button>
        </div>
        <div class="tab-content">
            <div id="leaveTab" style="display: block;">
                <?php include 'LeaveTab.php'; ?>
            </div>
            <div id="odTab" style="display: none;">
                <?php include 'OdTab.php'; ?>
            </div>
            <div id="permissionTab" style="display: none;">
                <?php include 'PermissionTab.php'; ?>
            </div>
            <div id="colTab" style="display: none;">
                <?php include 'ColTab.php'; ?>
            </div>
            <div id="odrTab" style="display: none;">
                <?php include 'ROdTab.php'; ?>
            </div>
        </div>
    </div>

    <script>
        function handleTabChange(tab) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content > div').forEach(el => el.style.display = 'none');

            // Remove active class from all buttons
            document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));

            // Show the selected tab content
            document.getElementById(tab + 'Tab').style.display = 'block';

            // Add active class to the clicked button
            event.target.classList.add('active');
        }
    </script>
</body>