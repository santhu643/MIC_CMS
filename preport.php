<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Tabs - Bootstrap 4</title>
    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .tab-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .nav-tabs .nav-link {
            border-radius: 5px;
            margin-right: 5px;
            font-weight: 500;
            color: #495057;
            padding: 12px 25px;
        }

        .nav-tabs .nav-link.active {
            background-color: #007bff !important;
            color: white !important;
            border: none !important;
        }

        .nav-tabs {
            border-bottom: none;
            margin-bottom: 20px;
        }

        .tab-content {
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            min-height: 300px;
        }

        /* Add animation for tab transition */
        .tab-pane.fade.show {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="tab-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="reportTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="counseling-tab" data-toggle="tab" href="#counseling" role="tab"
                        aria-controls="counseling" aria-selected="true">
                        Counseling Report
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mentor-tab" data-toggle="tab" href="#mentor" role="tab"
                        aria-controls="mentor" aria-selected="false">
                        Mentor-Mentee Assignment Report
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                        aria-controls="activity" aria-selected="false">
                        Activities Report
                    </a>
                </li>

            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="reportTabsContent">
                <!-- tab1 content -->
                <div class="tab-pane fade show active" id="counseling" role="tabpanel" aria-labelledby="counseling-tab">
                    <?php include 'cpreport.php' ?></php>
                </div>

                <!-- Tab 2 content -->
                <div class="tab-pane fade" id="mentor" role="tabpanel" aria-labelledby="mentor-tab">
                    <?php include 'cmreport.php' ?></php>
                </div>

                <!-- Tab 3 content -->
                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <?php include 'activity2.php' ?></php>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Bootstrap 4 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
</body>

</html>