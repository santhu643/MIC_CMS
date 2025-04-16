<?php //include("h.php"); 
$query = "SELECT * FROM faculty_details WHERE faculty_id='$s' ";
$query_run = mysqli_query($db, $query);
$res = mysqli_fetch_array($query_run);

    




?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="smain" aria-expanded="false"><img src="images/icon/dash.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sprofile" aria-expanded="false"><img src="images/icon/profile.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Profile</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="images/icon/Eprofile.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu">&nbsp;Edit Profile</span></a>
                    <ul aria-expanded="false" class="collapse  first-level" style="background-color: #30302f ;">

                        <li class="sidebar-item"><a href="sBasic" class="sidebar-link"><img src="images/icon/basic.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu"> &nbsp;Basic Details </span></a></li>

                        <li class="sidebar-item"><a href="sacademic" class="sidebar-link"><img src="images/icon/edit.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu"> &nbsp;Academic Details </span></a></li>

                        <li class="sidebar-item"><a href="sexam" class="sidebar-link"><img src="images/icon/exam.png" class="custom-svg-icon" alt="Dashboard Icon"><span class="hide-menu"> &nbsp;Exams Details </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="bus_booking" aria-expanded="false"><img src="images/icon/busN.png" class="custom-svg-icon" alt="Bus"><span class="hide-menu">&nbsp;Bus Booking</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sfeedback" aria-expanded="false"><img src="images/icon/feedback1.png" class="custom-svg-icon" alt="Bus"><span class="hide-menu">&nbsp;Feedback Corner</span></a></li>
                <?php
                if($res){

                ?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="completedtable" aria-expanded="false"><img src="images/icon/feedback1.png" class="custom-svg-icon" alt="Bus"><span class="hide-menu">&nbsp;Complaints</span></a></li>
<?php
                }
?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="spwd" aria-expanded="false"><img src="images/icon/keys.png" class="custom-svg-icon" alt="Password"><span class="hide-menu">&nbsp;Change Password</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>