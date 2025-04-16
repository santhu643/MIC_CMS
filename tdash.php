<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --topbar-height: 60px;
            --footer-height: 60px;
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --dark-bg: #1a1c23;
            --light-bg: #f8f9fc;
        }

        /* General Styles */
        body {
            min-height: 100vh;
            margin: 0;
            background: var(--light-bg);
            overflow-x: hidden;
            padding-bottom: var(--footer-height);
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--dark-bg);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            background-image: url('image/pattern_h.png');
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar .logo {
            /* height: var(--topbar-height); */
            display: flex;
            align-items: center;
            justify-content: center;
            /* margin: 10px 10px; */
            padding: 0 20px;
            color: white;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .logo img {

            max-height: 90px;
            width: auto;
        }

        .sidebar.collapsed .logo img {
            max-height: 40px;
        }

        .sidebar .menu {
            padding: 10px;
        }

        .menu-item {
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            cursor: pointer;
            border-radius: 5px;
            margin: 4px 0;
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .menu-item i {
            min-width: 30px;
            font-size: 18px;
        }

        .menu-item span {
            margin-left: 10px;
            transition: all 0.3s ease;
            flex-grow: 1;
        }

        .has-submenu::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: 10px;
            transition: transform 0.3s ease;
        }

        .has-submenu.active::after {
            transform: rotate(180deg);
        }

        .sidebar.collapsed .menu-item span,
        .sidebar.collapsed .has-submenu::after {
            display: none;
        }

        .submenu {
            margin-left: 30px;
            display: none;
            transition: all 0.3s ease;
        }

        .submenu.active {
            display: block;
        }




        /* Topbar Styles */
        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            height: var(--topbar-height);
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 0 20px;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .brand-logo {
            display: none;
            color: var(--primary-color);
            font-size: 24px;
            margin: 0 auto;
        }

        .sidebar.collapsed+.content .topbar {
            left: var(--sidebar-collapsed-width);
        }

        .hamburger {
            cursor: pointer;
            font-size: 20px;
            color: var(--secondary-color);
        }

        .user-profile {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        .online-indicator {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--success-color);
            border-radius: 50%;
            bottom: 0;
            right: 0;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        /* Content Area Styles */
        .content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        /* Content Navigation */
        .content-nav {
            background: linear-gradient(45deg, #4e73df, #1cc88a);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .content-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
            overflow-x: auto;
        }

        .content-nav li a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .content-nav li a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar.collapsed+.content {
            margin-left: var(--sidebar-collapsed-width);
        }

        .breadcrumb-area {
            padding: 15px 20px;
            background: white;
            margin-bottom: 20px;
        }

        /* User Menu Dropdown */
        .user-menu {
            position: relative;
            cursor: pointer;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: none;
            min-width: 200px;
        }

        .dropdown-menu.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .dropdown-item {
            padding: 10px 20px;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--light-bg);
            color: var(--primary-color);
        }

        /* Table Styles */
        .custom-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .custom-table thead {
            background: var(--primary-color);
            color: white;
        }

        .custom-table th {
            font-weight: 500;
            padding: 15px;
        }

        .custom-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        /* User Profile Styles */
        .user-profile {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .online-indicator {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--success-color);
            border-radius: 50%;
            bottom: 0;
            right: 0;
            border: 2px solid white;
            animation: blink 1.5s infinite;
        }

        /* Footer Styles */
        .footer {
            position: fixed;
            bottom: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--footer-height);
            background: linear-gradient(45deg, #4e73df, #1cc88a);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .sidebar.collapsed+.content .footer {
            left: var(--sidebar-collapsed-width);
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            opacity: 0.8;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }

            .sidebar.mobile-show {
                transform: translateX(0);
            }

            .topbar {
                left: 0 !important;
            }

            .mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .mobile-overlay.show {
                display: block;
            }

            .content {
                margin-left: 0 !important;
            }

            .brand-logo {
                display: block;
            }

            .user-profile {
                margin-left: 0;
            }

            .sidebar .logo {
                justify-content: center;
            }

            .sidebar .menu-item span,
            .sidebar .has-submenu::after {
                display: block !important;
            }

            body.sidebar-open {
                overflow: hidden;
            }

            .footer {
                left: 0 !important;
            }

            .content-nav ul {
                flex-wrap: nowrap;
                overflow-x: auto;
                padding-bottom: 5px;
            }

            .content-nav ul::-webkit-scrollbar {
                height: 4px;
            }

            .content-nav ul::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.3);
                border-radius: 2px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="image/mkce.png" alt="College Logo">
        </div>

        <div class="menu">
            <div class="menu-item">
                <i class="fas fa-home text-primary"></i>
                <span>Dashboard</span>
            </div>
            <div class="menu-item has-submenu">
                <i class="fas fa-chart-bar text-success"></i>
                <span>Analytics</span>
            </div>
            <div class="submenu">
                <div class="menu-item">
                    <i class="fas fa-chart-pie text-warning"></i>
                    <span>Reports</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-chart-line text-info"></i>
                    <span>Statistics</span>
                </div>
            </div>
            <div class="menu-item has-submenu">
                <i class="fas fa-users text-danger"></i>
                <span>Users</span>
            </div>
            <div class="submenu">
                <div class="menu-item">
                    <i class="fas fa-user-plus text-warning"></i>
                    <span>Add User</span>
                </div>
                <div class="menu-item">
                    <i class="fas fa-user-edit text-info"></i>
                    <span>Manage Users</span>
                </div>
            </div>
            <div class="menu-item">
                <i class="fas fa-cog text-secondary"></i>
                <span>Settings</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </div>
            <div class="brand-logo">
                <i class="fas fa-chart-line"></i>
                MIC
            </div>
            <div class="user-profile">
                <div class="user-menu" id="userMenu">
                    <div class="user-avatar">
                        <img src="/api/placeholder/35/35" alt="User">
                        <div class="online-indicator"></div>
                    </div>
                    <div class="dropdown-menu">
                        <a class="dropdown-item">
                            <i class="fas fa-key"></i>
                            Change Password
                        </a>
                        <a class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </div>
                <span>John Doe</span>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb-area">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="container-fluid">
            <!-- Sample Table -->
             <?php include 'activity.php';?>
            <div class="custom-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>John Doe</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Jane Smith</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Footer -->
        <footer class="footer">
            <div class="footer-copyright" style="text-align: center;">
            <p>Copyright © 2024 Designed by <span style="background: linear-gradient(to right, #cb2d3e, #ef473a);" -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Technology Innovation Hub - MKCE. </span>All rights reserved.</p>
            </div>
            <div class="footer-links">

                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const body = document.body;
        const mobileOverlay = document.getElementById('mobileOverlay');

        function toggleSidebar() {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-show');
                mobileOverlay.classList.toggle('show');
                body.classList.toggle('sidebar-open');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        }
        hamburger.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', toggleSidebar);
        // Toggle User Menu
        const userMenu = document.getElementById('userMenu');
        const dropdownMenu = userMenu.querySelector('.dropdown-menu');

        userMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });

        // Toggle Submenu
        const menuItems = document.querySelectorAll('.has-submenu');
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                const submenu = item.nextElementSibling;
                item.classList.toggle('active');
                submenu.classList.toggle('active');
            });
        });

        // Handle responsive behavior
        window.addEventListener('resize', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
                sidebar.classList.remove('mobile-show');
                mobileOverlay.classList.remove('show');
                body.classList.remove('sidebar-open');
            } else {
                sidebar.style.transform = '';
                mobileOverlay.classList.remove('show');
                body.classList.remove('sidebar-open');
            }
        });
    </script>
</body>

</html>