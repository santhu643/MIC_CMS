<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Counseling Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f6f9fc 0%, #edf2f7 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #2d3748;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .date-input-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .date-input {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .department-card {
            background: white;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .department-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .department-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.5rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .department-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .department-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .department-name {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .batch-container {
            padding: 1.5rem;
        }

        .batch-row {
            display: grid;
            grid-template-columns: 1fr repeat(3, auto);
            gap: 2rem;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            align-items: center;
        }

        .batch-row:last-child {
            border-bottom: none;
        }

        .batch-name {
            font-weight: 600;
            color: #4a5568;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #718096;
        }

        .progress-container {
            grid-column: 1 / -1;
            margin-top: 0.5rem;
        }

        .progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 3px;
            transition: width 1s ease;
        }

        .footer {
            text-align: right;
            color: #718096;
            margin-top: 2rem;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
            color: #4a5568;
        }

        .error-message {
            display: none;
            text-align: center;
            padding: 1rem;
            margin: 1rem 0;
            background-color: #fff5f5;
            color: #c53030;
            border-radius: 8px;
            border: 1px solid #feb2b2;
        }

        .details-btn {
            background: transparent;
            color: #667eea;
            padding: 0.5rem 1rem;
            border: 2px solid #667eea;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .details-btn:hover {
            background: #667eea;
            color: white;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-title {
            font-size: 1.5rem;
            color: #2d3748;
            font-weight: 600;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #718096;
            padding: 0.5rem;
        }

        .mentor-list {
            display: grid;
            gap: 1rem;
        }

        .mentor-item {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mentor-name {
            font-weight: 600;
            color: #4a5568;
        }

        .mentor-count {
            background: #667eea;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        /* Add to existing styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Student Counseling Dashboard</h1>
            <div class="date-input-container">
                <input type="date" id="date-input" class="date-input">
                <button id="fetch-data" class="btn">
                    <i class="fas fa-sync-alt"></i> Update Data
                </button>
            </div>
        </div>

        <div id="error-message" class="error-message">
            <i class="fas fa-exclamation-circle"></i>
            <span></span>
        </div>

        <div id="loading" class="loading">
            <i class="fas fa-spinner fa-spin"></i> Loading data...
        </div>

        <div id="counseling-summary"></div>

        <div class="footer">
            <p>Last updated: <span id="update-timestamp"></span></p>
        </div>
    </div>
    <!-- Add Modal -->
    <div id="mentorModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Mentor Details</h2>
                <button class="close-modal">&times;</button>
            </div>
            <div id="mentorList" class="mentor-list"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const departmentIcons = {
                'Artificial Intelligence': 'robot',
                'Civil': 'building',
                'Computer Science': 'laptop-code',
                'default': 'graduation-cap'
            };

            function groupByDepartment(data) {
                const grouped = {};
                data.forEach(item => {
                    const deptName = item.dept;
                    if (!grouped[deptName]) {
                        grouped[deptName] = [];
                    }
                    grouped[deptName].push(item);
                });
                return grouped;
            }

            function getDepartmentIcon(deptName) {
                return departmentIcons[deptName] || departmentIcons.default;
            }

            function createDepartmentCard(deptName, batches) {
                const batchesHtml = batches.map(batch => {
                    const percentage = ((batch.attended_count / batch.total_students) * 100).toFixed(1);
                    return `
                        <div class="batch-row">
                            <div class="batch-name">Batch ${batch.ayear}</div>
                            <div class="stat">
                                <div class="stat-value">${batch.attended_count}</div>
                                <div class="stat-label">Attended</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">${batch.total_students}</div>
                                <div class="stat-label">Total</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">${percentage}%</div>
                                <div class="stat-label">Completion</div>
                            </div>
                            <div class="progress-container">
                                <div class="progress-bar">
                                    <div class="progress" style="width: ${percentage}%"></div>
                                </div>
                            </div>
                            <button class="details-btn" onclick="showMentorDetails('${deptName}', '${batch.ayear}', ${JSON.stringify(batch.mentors).replace(/"/g, '&quot;')})">
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                        </div>
                    `;
                }).join('');

                return `
                    <div class="department-card">
                        <div class="department-header">
                            <div class="department-icon">
                                <i class="fas fa-${getDepartmentIcon(deptName)}"></i>
                            </div>
                            <div class="department-name">${deptName}</div>
                        </div>
                        <div class="batch-container">
                            ${batchesHtml}
                        </div>
                    </div>
                `;
            }

            // Add new functions for modal handling
            window.showMentorDetails = function(deptName, batch, mentors) {
                const $modal = $('#mentorModal');
                const $mentorList = $('#mentorList');
                const $modalTitle = $('.modal-title');

                $modalTitle.text(`${deptName} - Batch ${batch} Mentor Details`);
                
                $mentorList.empty();
                mentors.forEach(mentor => {
                    $mentorList.append(`
                        <div class="mentor-item">
                            <span class="mentor-name">${mentor.name}</span>
                            <span class="mentor-count">${mentor.data_completed_count} students</span>
                        </div>
                    `);
                });

                $modal.css('display', 'flex');
            };

            // Close modal when clicking the close button or outside the modal
            $('.close-modal, .modal').click(function(e) {
                if (e.target === this) {
                    $('#mentorModal').hide();
                }
            });

            // Prevent modal content clicks from closing the modal
            $('.modal-content').click(function(e) {
                e.stopPropagation();
            });

            // Previous functions remain the same...
            function showError(message) {
                const $error = $('#error-message');
                $error.find('span').text(message);
                $error.slideDown();
                setTimeout(() => $error.slideUp(), 5000);
            }

            function showLoading(show) {
                if (show) {
                    $('#loading').fadeIn();
                    $('#counseling-summary').hide();
                } else {
                    $('#loading').fadeOut();
                    $('#counseling-summary').show();
                }
            }

            function fetchData() {
                const selectedDate = $('#date-input').val();
                if (!selectedDate) {
                    showError('Please select a date');
                    return;
                }

                showLoading(true);

                $.ajax({
                    url: 'fetch_counseling_data.php',
                    type: 'POST',
                    data: { date: selectedDate },
                    dataType: 'json',
                    success: function(response) {
                        const $container = $('#counseling-summary');
                        $container.empty();

                        if (response && response.length > 0) {
                            const groupedData = groupByDepartment(response);
                            
                            Object.entries(groupedData).forEach(([deptName, batches], index) => {
                                const $card = $(createDepartmentCard(deptName, batches));
                                $container.append($card);
                                setTimeout(() => {
                                    $card.addClass('visible');
                                }, index * 200);
                            });
                        } else {
                            showError('No data available for selected date');
                        }

                        updateTimestamp();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        showError('Failed to fetch data. Please try again.');
                    },
                    complete: function() {
                        showLoading(false);
                    }
                });
            }

            function updateTimestamp() {
                const currentDate = new Date();
                const timestamp = currentDate.toLocaleString();
                $('#update-timestamp').text(timestamp);
            }

            $('#fetch-data').click(function() {
                fetchData();
            });

            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            $('#date-input').val(today);

            // Initial data fetch
            fetchData();
        });
    </script>
</body>

</html>