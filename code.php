<?php

require 'config.php';
require 'session.php';




if(isset($_POST['update_basic']))
{
	$errors= array();
	$fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
	//$photo = mysqli_real_escape_string($db, $_POST['branch']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
	$religion = mysqli_real_escape_string($db, $_POST['religion']);
    $social = mysqli_real_escape_string($db, $_POST['social']);
    $caste = mysqli_real_escape_string($db, $_POST['caste']);
    $ms = mysqli_real_escape_string($db, $_POST['ms']);
	$pmc = mysqli_real_escape_string($db, $_POST['pmc']);
    $pim1 = mysqli_real_escape_string($db, $_POST['pim1']);
    $pim2 = mysqli_real_escape_string($db, $_POST['pim2']);
	
	$paddress = mysqli_real_escape_string($db, $_POST['paddress']);
    $taddress = mysqli_real_escape_string($db, $_POST['taddress']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $zip = mysqli_real_escape_string($db, $_POST['zip']);
	$country = mysqli_real_escape_string($db, $_POST['country']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $blood = mysqli_real_escape_string($db, $_POST['blood']);
	//$id = mysqli_real_escape_string($db, $_POST['cs']);	
	$file_name = $_FILES['photo']['name'];
	$file_tmp =$_FILES['photo']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.".".$ext;
	
	$file_name2 = $_FILES['aadhar']['name'];
	$file_tmp2 =$_FILES['aadhar']['tmp_name'];
	$ext2 = pathinfo($file_name2, PATHINFO_EXTENSION);
	$file_name2 = $s.".".$ext;
	
	$file_name3 = $_FILES['pan']['name'];
	$file_tmp3 =$_FILES['pan']['tmp_name'];
	$ext3 = pathinfo($file_name3, PATHINFO_EXTENSION);
	$file_name3 = $s.".".$ext;
	
	
    if($fname == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
	/*
	$query2 = "SELECT * FROM basic WHERE id='$s'";
    $query_run2 = mysqli_query($db, $query2);

    if(mysqli_num_rows($query_run2)== 0)
    {
        $query = "INSERT INTO basic(id) VALUES('$s')";
		$query_run = mysqli_query($db, $query);
	}
	
*/
	
	$query = "SELECT photo,aadhar,pan FROM basic WHERE id='$s'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['photo'];
	$f2=$row['aadhar'];
	$f3=$row['pan'];

		if (file_exists($f)) 
					   {
						 unlink($f);
						 unlink($f2);
						 unlink($f3);
					   }

	$file_tmp =$_FILES['photo']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.".".$ext;
	$filePath="images/profile/".$file_name;
	$filePath2="images/Aadhar/".$file_name2;
	$filePath3="images/PAN/".$file_name3;
	
	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/profile/".$file_name);
		 move_uploaded_file($file_tmp2,"images/Aadhar/".$file_name2);
		 move_uploaded_file($file_tmp3,"images/PAN/".$file_name3);

    $query = "UPDATE basic SET fname='$fname',lname='$lname',photo='$filePath',gender='$gender',dob='$dob',religion='$religion',social='$social',caste='$caste',ms='$ms',pmc='$pmc',pim1='$pim1',pim2='$pim2',paddress='$paddress',taddress='$taddress',state='$state',city='$city',zip='$zip',country='$country',mobile='$mobile',email='$email',blood='$blood',aadhar='$filePath2',pan='$filePath3' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);
	

    //$query = "INSERT INTO basic (id,fname,lname,photo,gender,dob,religion,social,caste,ms,pmc,pim1,pim2,paddress,taddress,state,city,zip,country,mobile,email,blood) VALUES('$s','$fname','$lname','$file_name','$gender','$dob','$religion','$social','$caste','$ms','$pmc','$pim1','$pim2','$paddress','$taddress','$state','$city','$zip','$country','$mobile','$email','$blood')";
    //$query_run = mysqli_query($db, $query);

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



if(isset($_POST['update_medical']))
{

	$sur = mysqli_real_escape_string($db, $_POST['sur']);
    $ins = mysqli_real_escape_string($db, $_POST['ins']);

    if($sur == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	

    $query = "UPDATE basic SET surgery='$sur',insurance='$ins' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);


       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
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

if(isset($_POST['update_pass']))
{

	$pass = mysqli_real_escape_string($db, $_POST['password']);

    if($pass == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	

    $query = "UPDATE faculty SET pass='$pass' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);


       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
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











if(isset($_POST['update_nominee']))
{

	$name = mysqli_real_escape_string($db, $_POST['name']);
	$type = mysqli_real_escape_string($db, $_POST['type']);
    $share = mysqli_real_escape_string($db, $_POST['share']);

    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
$query2 = "SELECT * FROM nominee WHERE id='$s'";
    $query_run2 = mysqli_query($db, $query2);

    if(mysqli_num_rows($query_run2)== 0)
    {
        $query = "INSERT INTO nominee(id) VALUES('$s')";
		$query_run = mysqli_query($db, $query);
	}



    $query = "UPDATE nominee SET id='$s',name='$name',type='$type',share='$share' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);


       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Nominee Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
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




if(isset($_POST['save_student']))
{
	$errors= array();
	$course = mysqli_real_escape_string($db, $_POST['course']);
    $Degree = mysqli_real_escape_string($db, $_POST['degree']);
	$branch = mysqli_real_escape_string($db, $_POST['branch']);
    $iname = mysqli_real_escape_string($db, $_POST['name']);
    $board = mysqli_real_escape_string($db, $_POST['univ']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
    $mos = mysqli_real_escape_string($db, $_POST['ms']);
    $mes = mysqli_real_escape_string($db, $_POST['mes']);
    $yc = mysqli_real_escape_string($db, $_POST['yc']);
	$cs = mysqli_real_escape_string($db, $_POST['cs']);
    $score = mysqli_real_escape_string($db, $_POST['score']);
    $cnum = mysqli_real_escape_string($db, $_POST['cnum']);
	$file_name = $_FILES['cert']['name'];
	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	//$file_ext=strtolower(end(explode('.',$_FILES['cert']['name'])));
	$file_name = $s.$course.".".$ext;
	$filePath="images/cert/".$file_name;
	//$cert= mysqli_real_escape_string($db, $_POST['cert']);
	
	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/cert/".$file_name);
	
    if($Degree == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO academic (id,course,Degree,branch,Iname,univ,state,mos,mes,yc,cs,score,cnum,cert) VALUES('$s','$course','$Degree','$branch','$iname','$board','$state','$mos','$mes','$yc','$cs','$score','$cnum','$filePath')";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    }}
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
	
}


if(isset($_POST['update_student']))
{
	$errors= array();
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);

    $course = mysqli_real_escape_string($db, $_POST['course']);
    $Degree = mysqli_real_escape_string($db, $_POST['degree']);
	$branch = mysqli_real_escape_string($db, $_POST['branch']);
    $iname = mysqli_real_escape_string($db, $_POST['name']);
    $board = mysqli_real_escape_string($db, $_POST['univ']);
	$state = mysqli_real_escape_string($db, $_POST['state']);
    $mos = mysqli_real_escape_string($db, $_POST['ms']);
    $mes = mysqli_real_escape_string($db, $_POST['mes']);
    $yc = mysqli_real_escape_string($db, $_POST['yc']);
	$cs = mysqli_real_escape_string($db, $_POST['cs']);
    $score = mysqli_real_escape_string($db, $_POST['score']);
    $cnum = mysqli_real_escape_string($db, $_POST['cnum']);
	$file_name = $_FILES['cert']['name'];
	//$cert= mysqli_real_escape_string($db, $_POST['cert']);
    if($Degree == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	$query = "SELECT cert FROM academic WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];

		if (file_exists($f)) 
					   {
						 unlink($f);
					   }

	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.$course.".".$ext;
	$filePath="images/cert/".$file_name;
	
	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/cert/".$file_name);

    $query = "UPDATE academic  SET course='$course', Degree='$Degree',branch='$branch', iname='$iname', univ='$board',state='$state',mos='$mos',mes='$mes',yc='$yc',cs='$cs',score='$score',cnum='$cnum',cert='$filePath' WHERE uid='$student_id'";
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

if(isset($_POST['update_family']))
{

    $student_id = mysqli_real_escape_string($db, $_POST['student_id2']);

   	$name = mysqli_real_escape_string($db, $_POST['name']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $relationship = mysqli_real_escape_string($db, $_POST['relationship']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    if($name== NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	

    $query = "UPDATE family  SET name='$name', gender='$gender',relationship='$relationship', mobile='$mobile' WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
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



if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id']);

    $query = "SELECT * FROM academic WHERE uid='$student_id'";
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



if(isset($_GET['student_id2']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id2']);

    $query = "SELECT * FROM family WHERE uid='$student_id'";
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

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);
	$query = "SELECT cert FROM academic WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];
	//$filePath="images/cert/".$f;
		if (file_exists($f)) 
					   {
						 unlink($f);
					   }
    $query = "DELETE FROM academic  WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['save_family']))
{
	$name = mysqli_real_escape_string($db, $_POST['name']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $relationship = mysqli_real_escape_string($db, $_POST['relationship']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
	
    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "INSERT INTO family (id,name,gender,relationship,mobile) VALUES('$s','$name','$gender','$relationship','$mobile')";
    $query_run = mysqli_query($db, $query);

       if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
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

if(isset($_POST['delete_family']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id3']);

    $query = "DELETE FROM family  WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}



?>