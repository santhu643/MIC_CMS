	
	<?php
	$query = "SELECT role FROM ofaculty WHERE uname='$s'";
    $query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$row = mysqli_fetch_assoc($query_run);
	$role=$row['role'];
	}
	
	if($role!="HR")
	{
		header('Location:hr.php');
	exit();
	}
?>