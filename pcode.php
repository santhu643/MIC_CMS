<?php

require 'config.php';
require 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $action = $_GET["action"];
    
    if ($action === "academic_years") {
        // Fetch academic year options
        $query = "SELECT DISTINCT ayear FROM student";
        $query_run = mysqli_query($db, $query);

        if(mysqli_num_rows($query_run) > 0) {
            $options = "<option value=''>Select Batch</option>";
            while ($student = mysqli_fetch_assoc($query_run)) {
                $options .= "<option value='" . $student['ayear'] . "'>" . $student['ayear'] . "</option>";
            }
            echo $options;
        }
    } else if ($action === "dept") {
        // Fetch faculty names
        $query = "SELECT DISTINCT dept FROM student";
        $query_run = mysqli_query($db, $query);

        if(mysqli_num_rows($query_run) > 0) {
            $options = "<option value=''>Select Department Name</option>";
            while ($faculty = mysqli_fetch_assoc($query_run)) {
                $options .= "<option value='" . $faculty['dept'] . "'>" . $faculty['dept'] . "</option>";
            }
            echo $options;
        }
    }
}

//batch select

if(isset($_POST['sel_std'])) {
    $dept = $_POST["batch"];

    $query = "SELECT DISTINCT ayear FROM student WHERE dept='$dept'";
    $query_run = mysqli_query($db, $query);

if(mysqli_num_rows($query_run) > 0) {
            $options = "<option value=''>Select Batch</option>";
            while ($student = mysqli_fetch_assoc($query_run)) {
                $options .= "<option value='" . $student['ayear'] . "'>" . $student['ayear'] . "</option>";
            }
            echo $options;
        }
		else {
        echo "<option value=''> No Batch Found</option>";
    }
}

//display data

if(isset($_POST['sel_std1'])) {
    
	//$batch = $_POST["abatch"];
	$dept = $_POST["adept"];
	?>
		         <div class="col-sm-12 mb-3">
            <div class="card">
               <div class="card-body">

				  <div id="test"> </div>
                  <div class="table-responsive">
				  <div id="approvemsg" class="alert alert-warning d-none"></div>
                     <table id="zero_config3" class="table table-striped table-bordered">
                        <thead>
                           <th><b>S.No</b></th>
                           <th><b>Batch</b></th>
						   <th><b>Total Students</b></th>
                           <th><b>Mentor Asssigned</b></th>
						   <th><b>Mentor Not Asssigned</b></th>
                        </thead>
                        <tbody>
                           
						   <?php
						   $sss = 1;
										$query = "SELECT DISTINCT ayear FROM student WHERE dept='$dept' and status='0'";

										$query_run = mysqli_query($db, $query);

										if(mysqli_num_rows($query_run) > 0)
										{
										
											foreach($query_run as $student)
											{
						 
								$year=$student['ayear'];
									  $query = "SELECT COUNT(*) AS student_count FROM student where dept='$dept' and ayear='$year' and status='0'";
									  $query_run = mysqli_query($db, $query);
									  
									   $query2 = "SELECT COUNT(*) AS student_count2 FROM student where dept='$dept' and ayear='$year' and mentor='' and status='0'";
									  $query_run2 = mysqli_query($db, $query2);
									  								  
									  if ($query_run) {
										 
										   $row = mysqli_fetch_assoc($query_run);
										   $row2 = mysqli_fetch_assoc($query_run2);
											$studentCount = $row['student_count'];
											$studentCount2 = $row2['student_count2'];
											
                                     
                                      ?>
                           <tr>
                              <td><?= $sss ?></td>
                              <td><?php echo $year;?></td>
							   <td><?php echo $studentCount; ?></td>
                              <td><?php echo $studentCount-$studentCount2;?></td>
							  <td><?php echo $studentCount2;?></td>
                              
                           </tr>
                           <?php
                              $sss = $sss + 1;
                              }
                              }
							  			
											}
												
                            
  						   
                              ?>
                        </tbody>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
		 <?php
}

?>