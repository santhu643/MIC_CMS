<?php include("h.php"); ?>
<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="main" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Profile</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-edit"></i><span class="hide-menu">Edit Profile</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                               
                                <li class="sidebar-item"><a href="Basic" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Basic Details </span></a></li>
								<li class="sidebar-item"><a href="academic" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Academic Details </span></a></li>
						   </ul>
                        </li>
						<?php
						if($role=="HOD")
						{ ?>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="hview" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">View faculty</span></a></li>
						<?php } ?>
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="pwd" aria-expanded="false"><i class="ti-key"></i><span class="hide-menu">Change Password</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>