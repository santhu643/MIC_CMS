<?php

require 'config.php';
require 'session.php';

if(isset($_POST['save_exp']))
{
	$errors= array();
    $id = mysqli_real_escape_string($db, $_POST['id']);
	
	$query2 = "SELECT * FROM faculty WHERE id='$id'";
    $query_run2 = mysqli_query($db, $query2);

    if(mysqli_num_rows($query_run2)== 1)
    {
        $res = [
            'status' => 201,
            'message' => 'Faculty already existed'
        ];
        echo json_encode($res);
        return;
	}

	
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$design = mysqli_real_escape_string($db, $_POST['design']);
    $dept = mysqli_real_escape_string($db, $_POST['dept']);
    $ddept = mysqli_real_escape_string($db, $_POST['ddept']);
    $doj = mysqli_real_escape_string($db, $_POST['doj']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

	$file_name = $_FILES['cert']['name'];
	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $name.$id.".".$ext;
$filePath="images/profile/".$file_name;
if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/profile/".$file_name);

    if($id == NULL || $name == NULL || $design == NULL || $dept == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO faculty (id,name,dept,ddept,design,role,doj,pass,cert) VALUES ('$id','$name','$dept','$ddept','$design','$role','$doj','$id','$filePath')";
	$query2 = "INSERT INTO basic (id) VALUES ('$id')";
    $query_run = mysqli_query($db, $query);
	$query_run2 = mysqli_query($db, $query2);
	

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Faculty Created Successfully'
        ];
        echo json_encode($res);
        return;
}}
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $course = mysqli_real_escape_string($db, $_POST['course']);

    if($name == NULL || $email == NULL || $phone == NULL || $course == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course' 
                WHERE id='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}




if(isset($_POST['delete_pc']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);
	$query = "SELECT id,cert FROM faculty WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];
	$idd=$row['id'];
	//$filePath="images/exp/".$f;
		if (file_exists($f)) 
					   {
						 unlink($f);
					   }
    $query = "DELETE FROM faculty WHERE uid='$student_id'";
	$query2 = "DELETE FROM basic WHERE id='$idd'";
    $query_run = mysqli_query($db, $query);
	$query_run2 = mysqli_query($db, $query2);
    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Faculty Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Faculty Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['student_id2']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id2']);

    $query = "SELECT * FROM faculty WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_faculty']))
{

    $student_id = mysqli_real_escape_string($db, $_POST['student_id3']);

   	$errors= array();
    $id = mysqli_real_escape_string($db, $_POST['id']);
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$design = mysqli_real_escape_string($db, $_POST['design']);
    $dept = mysqli_real_escape_string($db, $_POST['dept']);
    $doj = mysqli_real_escape_string($db, $_POST['doj']);
    $role = mysqli_real_escape_string($db, $_POST['role']);
	$file_name = $_FILES['cert']['name'];
	if($id == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	$query = "SELECT cert FROM faculty WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];

		if (file_exists($f)) 
					   {
						 unlink($f);
					   }

	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $name.$id.".".$ext;
	$filePath="images/profile/".$file_name;
	
	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/profile/".$file_name);
	

    $query = "UPDATE faculty  SET id='$id',name='$name',design='$design',dept='$dept',doj='$doj',role='$role',cert='$filePath' WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }}
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['student_id4']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id4']);

    $query = "SELECT * FROM faculty WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'detailsss Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_faculty_status'])) {
    // Sanitize inputs
    $faculty_uid = mysqli_real_escape_string($db, $_POST['faculty_uid']);
    $new_status = mysqli_real_escape_string($db, $_POST['new_status']);
    $remarks = mysqli_real_escape_string($db, $_POST['remarks']);

    // Validate inputs
    if(empty($faculty_uid) || $new_status === '' || empty($remarks)) {
        echo json_encode([
            'status' => 400,
            'message' => 'Invalid input parameters'
        ]);
        exit;
    }

    // Start a transaction
    mysqli_begin_transaction($db);

    try {
        // Update faculty table status
        $update_query = "UPDATE faculty SET status = '$new_status' WHERE id = '$faculty_uid'";
        $update_result = mysqli_query($db, $update_query);

        // Insert remarks into faculty_remarks table
        $remarks_query = "INSERT INTO faculty_remarks (faculty_id, remarks, status_changed_at) 
                          VALUES ('$faculty_uid', '$remarks', NOW())";
        $remarks_result = mysqli_query($db, $remarks_query);

        // Commit transaction
        if($update_result && $remarks_result) {
            mysqli_commit($db);
            
            echo json_encode([
                'status' => 200,
                'message' => $new_status == 1 
                    ? 'Faculty Activated Successfully' 
                    : 'Faculty Deactivated Successfully'
            ]);
        } else {
            // Rollback in case of error
            mysqli_rollback($db);
            
            echo json_encode([
                'status' => 500,
                'message' => 'Failed to update status'
            ]);
        }
    } catch (Exception $e) {
        // Rollback in case of any exception
        mysqli_rollback($db);
        
        echo json_encode([
            'status' => 500,
            'message' => 'An error occurred: ' . $e->getMessage()
        ]);
    }
}




if(isset($_POST['update_research']))
{

    $id = mysqli_real_escape_string($db, $_POST['oid']);

	$query = "SELECT * FROM faculty WHERE id='$id'";
    $query_run = mysqli_query($db, $query);

    if(mysqli_num_rows($query_run)== 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
	}
	
	else{
		      $res = [
            'status' => 201,
            'message' => 'details Fetch Successfully by id',
  
        ];
	}
}







?>