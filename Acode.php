<?php

require 'config.php';
require 'session.php';




if(isset($_POST['update_research']))
{
	$oid = mysqli_real_escape_string($db, $_POST['oid']);
    $sid = mysqli_real_escape_string($db, $_POST['sid']);
    $rid = mysqli_real_escape_string($db, $_POST['rid']);
    $gsid = mysqli_real_escape_string($db, $_POST['gsid']);
	$hid = mysqli_real_escape_string($db, $_POST['hid']);
    $iid = mysqli_real_escape_string($db, $_POST['iid']);
    $gi = mysqli_real_escape_string($db, $_POST['gi']);
    $cs = mysqli_real_escape_string($db, $_POST['cs']);
	$cgs = mysqli_real_escape_string($db, $_POST['cgs']);


	$query2 = "SELECT * FROM research WHERE id='$s'";
    $query_run2 = mysqli_query($db, $query2);

    if(mysqli_num_rows($query_run2)== 0)
    {
        $query = "INSERT INTO research(id) VALUES('$s')";
		$query_run = mysqli_query($db, $query);
	}

	if($oid=="")
	{
		$oid="0000-0000";
	}
	if($sid=="")
	{
		$sid="0000-0000";
	}
	if($rid=="")
	{
		$rid="0000-0000";
	}
	if($gsid=="")
	{
		$gsid="0000-0000";
	}
	if($hid=="")
	{
		$hid="0";
	}
	if($iid=="")
	{
		$iid="0";
	}
	if($gi=="")
	{
		$gi="0";
	}
	if($cs=="")
	{
		$cs="0";
	}
	if($cgs=="")
	{
		$cgs="0";
	}

    $query = "UPDATE research SET id='$s',oid='$oid',sid='$sid',rid='$rid',gsid='$gsid',hid='$hid',iid='$iid',gi='$gi',cs='$cs',cgs='$cgs' WHERE id='$s'";
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

if(isset($_POST['update_aprofile']))
{
	//$id = mysqli_real_escape_string($db, $_POST['id']);
	$errors= array();
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $design = mysqli_real_escape_string($db, $_POST['design']);
    $role = mysqli_real_escape_string($db, $_POST['role']);

    $user_query = "SELECT role FROM faculty WHERE id = ?";
    $stmt = $db->prepare($user_query);
    $stmt->bind_param("i", $s);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    // Validate the role
    if ($role !== $user['role']) {

        $res = [
            'status' => 500,
            'message' => 'Unauthorized role modification attempt'
        ];
        echo json_encode($res);
        return;
    }
    
	$dept = mysqli_real_escape_string($db, $_POST['dept']);
    $doj = mysqli_real_escape_string($db, $_POST['doj']);

	$file_name = $_FILES['cert']['name'];
	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $name.$s.".".$ext;
	
	$query = "SELECT cert FROM faculty WHERE id='$s'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];
	if (file_exists($f)) 
					   {
						 unlink($f);

					   }  
					   
	$filePath="images/profile/".$file_name;
	
	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/profile/".$file_name);
	
    $query = "UPDATE faculty SET id='$s',name='$name',dept='$dept',design='$design',role='$role',doj='$doj',cert='$filePath' WHERE id='$s'";
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





if(isset($_POST['update_researchh']))
{
	$fid = mysqli_real_escape_string($db, $_POST['fid']);

	$query2 = "SELECT * FROM faculty WHERE id='$fid'";
    $query_run2 = mysqli_query($db, $query2);

	$query3 = "SELECT * FROM basic WHERE id='$fid'";
    $query_run3 = mysqli_query($db, $query3);

	$query4 = "SELECT * FROM journal WHERE id='$fid'";
    $query_run4 = mysqli_query($db, $query4);


    if(mysqli_num_rows($query_run2)== 1)
    {
        $student2 = mysqli_fetch_array($query_run2);
		$student3 = mysqli_fetch_array($query_run3);
		$student4 = mysqli_fetch_array($query_run4);
		$std=array_merge($student2,$student3,$student4);
        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $std
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
	
	//2nd query
	
}



if(isset($_POST['save_exp']))
{
	$errors= array();
	
	$type = mysqli_real_escape_string($db, $_POST['type']);
    $iname = mysqli_real_escape_string($db, $_POST['iname']);
	$design = mysqli_real_escape_string($db, $_POST['design']);
    $role = mysqli_real_escape_string($db, $_POST['role']);
    $fromd = mysqli_real_escape_string($db, $_POST['fromd']);
	$tod = mysqli_real_escape_string($db, $_POST['tod']);
		$datetime1 = new DateTime($_POST['fromd']);
        $datetime2 = new DateTime($_POST['tod']);
        $interval = $datetime1->diff($datetime2);
		$ex=$interval->format('%y years %m months and %d days');
	$file_name = $_FILES['cert']['name'];
	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.$iname.".".$ext;
	$filePath="images/exp/".$file_name;

	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/exp/".$file_name);
	
    if($type == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO exp (id,type,iname,design,role,fromd,tod,exp,cert) VALUES('$s','$type','$iname','$design','$role','$fromd','$tod','$ex','$filePath')";
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

    $query = "SELECT * FROM exp WHERE uid='$student_id'";
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

if(isset($_GET['student_id22']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id22']);

    $query = "SELECT * FROM journal WHERE uid='$student_id'";
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


if(isset($_GET['student_id222']))
{
    $student_id = mysqli_real_escape_string($db, $_GET['student_id222']);

    $query = "SELECT * FROM training WHERE uid='$student_id'";
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
	$query = "SELECT cert FROM exp WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];
	//$filePath="images/exp/".$f;
		if (file_exists($f)) 
					   {
						 unlink($f);
					   }
    $query = "DELETE FROM exp  WHERE uid='$student_id'";
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

if(isset($_POST['delete_journal']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id4']);
	$query = "SELECT paper FROM journal WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['paper'];
	//$filePath="images/exp/".$f;
		if (file_exists($f)) 
					   {
						 unlink($f);
					   }
    $query = "DELETE FROM journal WHERE uid='$student_id'";
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

if(isset($_POST['delete_post']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id6']);
	
    $query = "DELETE FROM posting WHERE uid='$student_id'";
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




if(isset($_POST['delete_pc']))
{
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);
	$query = "SELECT cert FROM training WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($query_run);
	$f=$row['cert'];
	//$filePath="images/exp/".$f;
		if (file_exists($f)) 
					   {
						 unlink($f);
					   }
    $query = "DELETE FROM training WHERE uid='$student_id'";
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




if(isset($_POST['save_journal']))
{
	$errors= array();
	$pt = mysqli_real_escape_string($db, $_POST['pt']);
    $jn = mysqli_real_escape_string($db, $_POST['jn']);
    $pn = mysqli_real_escape_string($db, $_POST['pn']);
    $vol = mysqli_real_escape_string($db, $_POST['vol']);
	$issue = mysqli_real_escape_string($db, $_POST['issue']);
    $pages = mysqli_real_escape_string($db, $_POST['pages']);
    $pissn = mysqli_real_escape_string($db, $_POST['pissn']);
    $eissn = mysqli_real_escape_string($db, $_POST['eissn']);
	$scope = $_POST['scope'];
	$xyz=implode(",",$scope);
	$mon = mysqli_real_escape_string($db, $_POST['mon']);
	$file_name = $_FILES['cert']['name'];
	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.$jn.".".$ext;
	$filePath="images/journal/".$file_name;

	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/journal/".$file_name);
	
    if($pt == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "INSERT INTO journal (id,pt,jn,pn,vol,issue,pages,pissn,eissn,scope,mon,paper) VALUES('$s','$pt','$jn','$pn','$vol','$issue','$pages','$pissn','$eissn','$xyz','$mon','$filePath')";
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


if(isset($_POST['save_post']))
{
	$level = mysqli_real_escape_string($db, $_POST['lp']);
    $pname = mysqli_real_escape_string($db, $_POST['np']);
    $fromd = mysqli_real_escape_string($db, $_POST['fod']);
    $tod = mysqli_real_escape_string($db, $_POST['tod']);
	
	
    if($pname == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "INSERT INTO posting(id,level,pname,fromd,tod) VALUES('$s','$level','$pname','$fromd','$tod')";
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

if(isset($_POST['save_punish']))
{
	$type = mysqli_real_escape_string($db, $_POST['lp']);
    $reason = mysqli_real_escape_string($db, $_POST['np']);
    $fromd = mysqli_real_escape_string($db, $_POST['fod']);
    $tod = mysqli_real_escape_string($db, $_POST['tod']);
	
	
    if($type == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
    $query = "INSERT INTO punish(id,type,reason,fromd,tod) VALUES('$s','$type','$reason','$fromd','$tod')";
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






if(isset($_POST['save_pc']))
{
	$errors= array();
	$type = mysqli_real_escape_string($db, $_POST['type']);
	$otype = mysqli_real_escape_string($db, $_POST['other']);
    $no = mysqli_real_escape_string($db, $_POST['no']);
    $name = mysqli_real_escape_string($db, $_POST['title']);
	$fromd = mysqli_real_escape_string($db, $_POST['fd']);
    $tod = mysqli_real_escape_string($db, $_POST['td']);
	$file_name = $_FILES['cert']['name'];
	$file_tmp =$_FILES['cert']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.$name.".".$ext;
	$filePath="images/training/".$file_name;

	if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/training/".$file_name);
	
    if($type == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
	
	
	if ($type=="other")
		{
			$status=$otype;
		}
		else
		{
			$status=$type;
		}
	
	
	
    $query = "INSERT INTO training (id,type,no,name,fromd,tod,cert) VALUES('$s','$status','$no','$name','$fromd','$tod','$filePath')";
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