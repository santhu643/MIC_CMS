<?php 


//require 'fconfig.php';


	$query = "SELECT dept,role FROM faculty WHERE id='$s'";
    $query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$row = mysqli_fetch_assoc($query_run);
	$dept=$row['dept'];
	$role=$row['role'];
	}


?>
<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="main" aria-expanded="false"><img src="images/icon/dash.png" class="custom-svg-icon" alt="Dashboard Icon">
                <span class="hide-menu">&nbsp;Dashboard</span></a></li>
						
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile" aria-expanded="false"><img src="images/icon/profile.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Profile</span></a></li>
						
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="images/icon/book1.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Service Book</span></a>
                            <ul aria-expanded="false" class="collapse  first-level" style="background-color: #30302f ;">
                               
                                <li class="sidebar-item"><a href="Basic" class="sidebar-link"><img src="images/icon/basic.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Basic Details </span></a></li>
								<li class="sidebar-item"><a href="academic" class="sidebar-link"><img src="images/icon/edit.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu"> &nbsp;Academic Details </span></a></li>
						   </ul>
                        </li>

					<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="fview" aria-expanded="false"><img src="images/icon/student.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Student</span></a></li>
					
					
					<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="csview" aria-expanded="false"><img src="images/icon/staff.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Mentor - Mentee</span></a></li>

											
						<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pwd" aria-expanded="false"><img src="images/icon/keys.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Change Password</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>