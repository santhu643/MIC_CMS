    <?php //include("h.php"); 
//require 'fconfig.php';



$query = "SELECT id,dept,role FROM faculty WHERE id='$s'";
$query_run = mysqli_query($db, $query);
if (mysqli_num_rows($query_run) > 0) {
    $row = mysqli_fetch_assoc($query_run);
    $dept = $row['dept'];
    $role = $row['role'];
    $fac_id = $row['id'];
}


?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="main"
                        aria-expanded="false"><img src="images/icon/dash.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile"
                        aria-expanded="false"><img src="images/icon/profile.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Profile</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><img src="images/icon/book1.png"
                            class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Service
                            Book</span></a>
                    <ul aria-expanded="false" class="collapse  first-level" style="background-color: #30302f ;">

                        <li class="sidebar-item"><a href="Basic" class="sidebar-link"><img src="images/icon/basic.png"
                                    class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu"> &nbsp;Basic
                                    Details </span></a></li>
                        <li class="sidebar-item"><a href="academic" class="sidebar-link"><img src="images/icon/edit.png"
                                    class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu"> &nbsp;Academic
                                    Details </span></a></li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="hrleave"
                        aria-expanded="false"><img src="images/icon/attendance.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Wallet HR</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="fview"
                        aria-expanded="false"><img src="images/icon/student.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Student</span></a></li>
                        <?php
                        $query2 = "SELECT * FROM faculty_details WHERE faculty_id='$fac_id'";
                        $query_run2 = mysqli_query($db,$query2);
                        if (mysqli_num_rows($query_run2) > 0) {

                        ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="completedtable"
                        aria-expanded="false"><img src="images/icon/feedback1.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Complaint</span></a></li>
                            <?php
                        }
                            ?>
                        <?php
                        if($fac_id==1141014){
                    
                        
                        ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="eo"
                        aria-expanded="false"><img src="images/icon/feedback1.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Complaint</span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if($fac_id==1112001){

                        ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="manager"
                        aria-expanded="false"><img src="images/icon/feedback1.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Complaint</span></a></li>
                        <?php
                        }
                        ?>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pwd"
                        aria-expanded="false"><img src="images/icon/keys.png" class="custom-svg-icon"
                            alt="Dashboard Icon"><span class="hide-menu">&nbsp;Change Password</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>