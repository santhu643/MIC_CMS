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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #f97316;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --border-color: #e2e8f0;
        }

        body {
            background-color: var(--bg-primary);
            min-height: 100vh;
            padding: 1.5rem;
            color: var(--text-primary);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: var(--bg-secondary);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: linear-gradient(45deg, var(--primary) 0%, var(--secondary) 100%);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(150px, -150px);
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .date-input-container {
            display: flex;
            gap: 1rem;
            align-items: center;
            position: relative;
        }

        .date-input {
            padding: 1rem 1.5rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            background: var(--bg-secondary);
            color: var(--text-primary);
            transition: all 0.3s ease;
            flex: 1;
            max-width: 200px;
        }

        .date-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn {
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 8px -1px rgba(79, 70, 229, 0.3);
        }

        .department-card {
            background: var(--bg-secondary);
            border-radius: 24px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .department-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .department-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 2rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .department-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50px, -100px);
        }

        .department-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .department-icon i {
            font-size: 1.75rem;
            color: white;
        }

        .department-name {
            font-size: 1.75rem;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .batch-container {
            padding: 2rem;
        }

        .batch-row {
            display: grid;
            grid-template-columns: 1.5fr repeat(3, 1fr);
            gap: 2.5rem;
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            align-items: center;
            transition: all 0.3s ease;
        }

        .batch-row:hover {
            background: var(--bg-primary);
        }

        .batch-row:last-child {
            border-bottom: none;
        }

        .batch-name {
            font-weight: 700;
            color: var(--text-primary);
            font-size: 1.1rem;
        }

        .stat {
            text-align: center;
            padding: 1rem;
            background: var(--bg-primary);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .batch-row:hover .stat {
            background: var(--bg-secondary);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .progress-container {
            grid-column: 1 / -1;
            margin-top: 1rem;
        }

        .progress-bar {
            height: 8px;
            background: var(--bg-primary);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 4px;
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .details-btn {
            background: transparent;
            color: var(--primary);
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--primary);
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .details-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: var(--bg-secondary);
            padding: 2.5rem;
            border-radius: 24px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px) scale(0.95);
                opacity: 0;
            }
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-title {
            font-size: 1.5rem;
            color: var(--text-primary);
            font-weight: 700;
        }

        .close-modal {
            background: var(--bg-primary);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 20px;
            cursor: pointer;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close-modal:hover {
            background: var(--border-color);
            color: var(--text-primary);
        }

        .mentor-list {
            display: grid;
            gap: 1rem;
        }

        .mentor-item {
            background: var(--bg-primary);
            padding: 1.5rem;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .mentor-item:hover {
            transform: translateX(4px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .mentor-name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1.1rem;
        }

        .mentor-count {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
        }

        .footer {
            text-align: right;
            color: var(--text-secondary);
            margin-top: 2rem;
            font-size: 0.875rem;
        }

        .error-message {
            display: none;
            text-align: center;
            padding: 1rem;
            margin: 1rem 0;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 12px;
            border: 1px solid #fecaca;
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .loading {
            display: none;
            text-align: center;
            padding: 2rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .batch-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stat {
                padding: 0.75rem;
            }

            .department-header {
                padding: 1.5rem;
            }

            .header {
                padding: 1.5rem;
            }

            .date-input-container {
                flex-direction: column;
            }

            .date-input {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="header">
          
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