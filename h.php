	
	<?php
	$query = "SELECT dept,role FROM faculty WHERE id='$s'";
    $query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$row = mysqli_fetch_assoc($query_run);
	$dept=$row['dept'];
	$role=$row['role'];
	}
	
	if($role!="HOD")
	{
		header('Location:index.php');
	exit();
	}
?>