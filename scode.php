<?php

require 'config.php';
require 'session.php';
date_default_timezone_set("Asia/Kolkata");

if (isset($_POST['save_login'])) {
    $d = 1;

    if ($d == 1) {
        $res = [
            'status' => 200,
            'message' => 'Login Successfully'
        ];
        echo json_encode($res);
        return;
    }
    $mail = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['pass']);



    $query = "SELECT * FROM faculty WHERE id = '$mail' and pass = '$pass'";
    $query_run = mysqli_query($db, $query);
    $count = mysqli_num_rows($query_run);
    if ($count == 1) {
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['login_user'] = $mail;

        $res = [
            'status' => 200,
            'message' => 'Login Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Username/Password wrong'
        ];
        echo json_encode($res);
        return;
    }
}




if (isset($_POST['update_basic'])) {

    $errors = array();
    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $programme = mysqli_real_escape_string($db, $_POST['programme']);
    $department = mysqli_real_escape_string($db, $_POST['department']);
    $batch = mysqli_real_escape_string($db, $_POST['batch']);
    $dob = mysqli_real_escape_string($db, $_POST['dob']);
    $blood = mysqli_real_escape_string($db, $_POST['blood']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    $pmobile = mysqli_real_escape_string($db, $_POST['pmobile']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $languages = mysqli_real_escape_string($db, $_POST['language']);
    $aadhar = mysqli_real_escape_string($db, $_POST['aadhar']);
    $hosday = mysqli_real_escape_string($db, $_POST['hosday']);
    $room = mysqli_real_escape_string($db, $_POST['room']);
    $stay = mysqli_real_escape_string($db, $_POST['stay']);
    $paddress = mysqli_real_escape_string($db, $_POST['paddress']);
    $taddress = mysqli_real_escape_string($db, $_POST['taddress']);
    $state = mysqli_real_escape_string($db, $_POST['state']);
    $city = mysqli_real_escape_string($db, $_POST['city']);
    $zip = mysqli_real_escape_string($db, $_POST['zip']);
    $country = mysqli_real_escape_string($db, $_POST['country']);

    $file_name = $_FILES['pphoto']['name'];
    $file_tmp = $_FILES['pphoto']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = $s . "." . $ext;

    $file_name2 = $_FILES['fphoto']['name'];
    $file_tmp2 = $_FILES['fphoto']['tmp_name'];
    $ext2 = pathinfo($file_name2, PATHINFO_EXTENSION);
    $file_name2 = $s . "." . $ext;

    $file_name3 = $_FILES['mphoto']['name'];
    $file_tmp3 = $_FILES['mphoto']['tmp_name'];
    $ext3 = pathinfo($file_name3, PATHINFO_EXTENSION);
    $file_name3 = $s . "." . $ext;



    $query2 = "SELECT * FROM sbasic WHERE sid='$s'";
    $query_run2 = mysqli_query($db, $query2);

    if (mysqli_num_rows($query_run2) == 0) {
        $query = "INSERT INTO sbasic(sid) VALUES('$s')";
        $query_run = mysqli_query($db, $query);
    }



    $query = "SELECT pphoto,fphoto,mphoto FROM sbasic WHERE sid='$s'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['pphoto'];
    $f2 = $row['fphoto'];
    $f3 = $row['mphoto'];

    if (file_exists($f)) {
        unlink($f);
        //unlink($f2);
        //unlink($f3);
    }
    if (file_exists($f2)) {
        //unlink($f);
        unlink($f2);
        //unlink($f3);
    }
    if (file_exists($f3)) {
        //unlink($f);
        // unlink($f2);
        unlink($f3);
    }
    $filePath = "images/sphoto/" . $file_name;
    $filePath2 = "images/sfather/" . $file_name2;
    $filePath3 = "images/smother/" . $file_name3;

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/sphoto/" . $file_name);
        move_uploaded_file($file_tmp2, "images/sfather/" . $file_name2);
        move_uploaded_file($file_tmp3, "images/smother/" . $file_name3);


        $query = "UPDATE sbasic SET sid='$s',fname='$fname',lname='$lname',gender='$gender',programme='$programme',department='$department',batch='$batch',dob='$dob',blood='$blood',mobile='$mobile',pmobile='$pmobile',email='$email',languages ='$languages',aadhar ='$aadhar',hosday='$hosday',room='$room',stay='$stay',paddress='$paddress',taddress='$taddress',state='$state',city='$city',zip='$zip',country='$country',pphoto='$filePath',fphoto='$filePath2', mphoto='$filePath3' WHERE sid='$s'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_student'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);

    $query = "SELECT fname FROM sbasic WHERE sid='$s'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['fname'];
    if ($f != "") {
        $stt = 1;
        $query = "UPDATE sbasic SET status='$stt' WHERE sid='$s'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Approved Successfully'
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Details Not Approved'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 205
        ];
        echo json_encode($res);
        return;
    }
}
//basic ends

if (isset($_POST['update_medical'])) {

    $sur = mysqli_real_escape_string($db, $_POST['sur']);
    $ins = mysqli_real_escape_string($db, $_POST['ins']);

    if ($sur == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE basic SET surgery='$sur',insurance='$ins' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['update_pass'])) {

    $pass = mysqli_real_escape_string($db, $_POST['password']);

    if ($pass == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE faculty SET pass='$pass' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['update_nominee'])) {

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $share = mysqli_real_escape_string($db, $_POST['share']);

    if ($name == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query2 = "SELECT * FROM nominee WHERE id='$s'";
    $query_run2 = mysqli_query($db, $query2);

    if (mysqli_num_rows($query_run2) == 0) {
        $query = "INSERT INTO nominee(id) VALUES('$s')";
        $query_run = mysqli_query($db, $query);
    }



    $query = "UPDATE nominee SET id='$s',name='$name',type='$type',share='$share' WHERE id='$s'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Nominee Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



//--------------------------------------------------------------------------------------
//student_academic starts
//--------------------------------------------------------------------------------------
if (isset($_POST['save_sacademic'])) {

    $errors = array();
    $course = mysqli_real_escape_string($db, $_POST['course']);
    $Degree = mysqli_real_escape_string($db, $_POST['degree']);
    $branch = mysqli_real_escape_string($db, $_POST['branch']);
    $iname = mysqli_real_escape_string($db, $_POST['iname']);
    $board = mysqli_real_escape_string($db, $_POST['univ']);
    $mes = mysqli_real_escape_string($db, $_POST['mes']);
    $yc = mysqli_real_escape_string($db, $_POST['yc']);

    $score = mysqli_real_escape_string($db, $_POST['score']);

    $file_name = $_FILES['cert']['name'];

    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $file_name = $s . $course . "." . $ext;

    $filePath = "images/scert/" . $file_name;

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/scert/" . $file_name);

        if ($Degree == NULL) {
            $res = [
                'status' => 422,
                'message' => 'All fields are mandatory'
            ];
            echo json_encode($res);
            return;
        }
        $filePath = $filePath;
        $query = "INSERT INTO sacademic (sid,course,degree,branch,iname,board,mos,yc,score,cert) VALUES('$s','$course','$Degree','$branch','$iname','$board','$mes','$yc','$score','$filePath')";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details added Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['update_student'])) {
    $errors = array();
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);

    $course = mysqli_real_escape_string($db, $_POST['course']);
    $Degree = mysqli_real_escape_string($db, $_POST['degree']);
    $branch = mysqli_real_escape_string($db, $_POST['branch']);
    $iname = mysqli_real_escape_string($db, $_POST['name']);
    $board = mysqli_real_escape_string($db, $_POST['univ']);
    $mos = mysqli_real_escape_string($db, $_POST['mes']);
    $yc = mysqli_real_escape_string($db, $_POST['yc']);

    $score = mysqli_real_escape_string($db, $_POST['score']);

    $file_name = $_FILES['cert']['name'];


    if ($Degree == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "SELECT cert FROM sacademic WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }

    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = $s . $course . "." . $ext;
    $filePath = "images/scert/" . $file_name;

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/scert/" . $file_name);

        $query = "UPDATE sacademic  SET course='$course',degree='$Degree',branch='$branch', iname='$iname', board='$board',mos='$mos',yc='$yc',score='$score',cert='$filePath' WHERE uid='$student_id'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_id']);

    $query = "SELECT * FROM sacademic WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id']);

    $query = "DELETE FROM sacademic WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//student_academic ends

//-----------------------------------------------------------

// Family Starts

//------------------------------------------------------------
if (isset($_POST['save_family'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $relationship = mysqli_real_escape_string($db, $_POST['relationship']);
    $occu = mysqli_real_escape_string($db, $_POST['occu']);
    $org = mysqli_real_escape_string($db, $_POST['org']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);

    if ($name == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO sfamily (sid,name,gender,relationship,occu,org,mobile) VALUES('$s','$name','$gender','$relationship','$occu','$org','$mobile')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['update_family'])) {

    $student_id = mysqli_real_escape_string($db, $_POST['student_id2']);

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $relationship = mysqli_real_escape_string($db, $_POST['relationship']);
    $occu = mysqli_real_escape_string($db, $_POST['occu']);
    $org = mysqli_real_escape_string($db, $_POST['org']);
    $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
    if ($name == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE sfamily  SET name='$name', gender='$gender',relationship='$relationship',occu='$occu',org='$org',mobile='$mobile' WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_GET['student_id2'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_id2']);

    $query = "SELECT * FROM sfamily WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}





if (isset($_POST['delete_family'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id3']);

    $query = "DELETE FROM sfamily  WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//family ends

//--------------------------------------------------------
//Parents-meeting start
//---------------------------------------------------------

if (isset($_POST['save_parentsmeeting'])) {
    $datee = mysqli_real_escape_string($db, $_POST['pmdate']);
    $purposemeeting = mysqli_real_escape_string($db, $_POST['purpose']);
    // $suggestion=mysqli_real_escape_string($db,$_POST['suggestion']);
    $ss = 0;

    if ($datee == NULL || $purposemeeting == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO parentmeeting (sid,datee,purpose,status) VALUES ('$s','$datee','$purposemeeting','$ss')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['upd_parent'])) {

    $uid = mysqli_real_escape_string($db, $_POST['student_id3']);
    $datee = mysqli_real_escape_string($db, $_POST['pmdate2']);
    $purpose = mysqli_real_escape_string($db, $_POST['purpose-meeting2']);
    //$suggestion = mysqli_real_escape_string($db, $_POST['suggestion2']);
    $status = mysqli_real_escape_string($db, $_POST['status2']);
    if ($datee == NULL || $purpose == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "UPDATE parentmeeting  SET datee='$datee', purpose='$purpose' WHERE uid='$uid'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_GET['uid_id'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['uid_id']);
    $query = "SELECT * FROM parentmeeting WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_parentmeeting'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['delete_meeting']);

    $query = "DELETE FROM parentmeeting  WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//parents meeting end

//---------------------------------------------
//counselling starts
//---------------------------------------------
if (isset($_POST['save_counselling'])) {
    $datee = mysqli_real_escape_string($db, $_POST['datee']);
    $feedback = mysqli_real_escape_string($db, $_POST['feedback']);
    //$remark = mysqli_real_escape_string($db, $_POST['taken']);
    $st = 0;

    if ($datee == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }




    $query = "INSERT INTO counselling (sid,datee,feedback,status) VALUES('$s','$datee','$feedback','$st')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_details'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id3']);

    $query = "DELETE FROM counselling  WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//counselling ends



//----------------------------------------------------------
//Medical leave
//----------------------------------------------------------

if (isset($_POST['save_smedical'])) {
    $errors = array();

    $fdate = date('d-m-Y', strtotime(mysqli_real_escape_string($db, $_POST['fdatee'])));

    $tdate = date('d-m-Y', strtotime(mysqli_real_escape_string($db, $_POST['tdatee'])));

    $tdays = mysqli_real_escape_string($db, $_POST['tdays']);
    $reason = mysqli_real_escape_string($db, $_POST['reason']);
    $file_name = $_FILES['mcert']['name'];
    $file_tmp = $_FILES['mcert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = $s . $fdate . "." . $ext;
    $filePath = "images/smedical/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/smedical/" . $file_name);
    }

    if ($fdate == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO smedical (sid,fdate,tdate,tdays,reason,mcert) VALUES('$s','$fdate','$tdate','$tdays','$reason','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_sm'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_idi']);


    $query = "SELECT mcert FROM smedical WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['mcert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM smedical WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_GET['student_idsm'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idsm']);

    $query = "SELECT * FROM smedical WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

//Medical leave end


//-------------------------------------------------
//swot starts

if (isset($_POST['update_swot'])) {

    $Strengths = mysqli_real_escape_string($db, $_POST['Strengths']);
    $Weaknesses = mysqli_real_escape_string($db, $_POST['Weaknesses']);
    $Opportunities = mysqli_real_escape_string($db, $_POST['Opportunities']);
    $Threats = mysqli_real_escape_string($db, $_POST['Threats']);

    if ($Strengths == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE sbasic SET Strengths='$Strengths',Weaknesses='$Weaknesses', Opportunities='$Opportunities',Threats='$Threats' WHERE sid='$s'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//--------------------------------------------------

//swot ends



//----------------------------------------------------------
//Prizes awards
//----------------------------------------------------------

if (isset($_POST['save_pc'])) {
    $errors = array();
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $event = mysqli_real_escape_string($db, $_POST['event']);
    $event1 = str_replace(' ', '_', $event);
    $level = mysqli_real_escape_string($db, $_POST['level']);
    $organiser = mysqli_real_escape_string($db, $_POST['organiser']);
    $prize = mysqli_real_escape_string($db, $_POST['prize']);
    $file_name = $_FILES['cert']['name'];
    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $ti=date("d_m_Y_H_i_s");
    $file_name = $s . $ti . "." . $ext;
    $filePath = "images/sprize/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/sprize/" . $file_name);
    }



    if ($event == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO sprize (sid,event,ayear,level,organiser,prize,cert) VALUES('$s','$event','$ayear','$level','$organiser','$prize','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Added'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_pc'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);


    $query = "SELECT cert FROM sprize WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM sprize WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['student_id222'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_id222']);

    $query = "SELECT * FROM sprize WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_prize'])) {
    $stmt = $db->prepare("UPDATE sprize SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}


//prize ends


//----------------------------------------------------------
//international Certifications
//----------------------------------------------------------

if (isset($_POST['save_i_certification'])) {
    $errors = array();
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $event = mysqli_real_escape_string($db, $_POST['cname']);
    $event1 = str_replace(' ', '_', $event);
    $duration = mysqli_real_escape_string($db, $_POST['duration']);
    $organiser = mysqli_real_escape_string($db, $_POST['organiser']);
    $file_name = $_FILES['cert']['name'];
    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $ti=date("d_m_Y_H_i_s");
    $file_name = $s . $ti . "." . $ext;
    $filePath = "images/s_i_certification/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/s_i_certification/" . $file_name);
    }

    if ($event == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO s_i_certification (sid,cname,ayear,duration,organiser,cert) VALUES('$s','$event','$ayear','$duration','$organiser','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Added'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_i_certification'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);


    $query = "SELECT cert FROM s_i_certification WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM s_i_certification WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['student_i_certification'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_i_certification']);

    $query = "SELECT * FROM s_i_certification WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_i_certification'])) {
    $stmt = $db->prepare("UPDATE s_i_certification SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}


//international Certifications ends




//----------------------------------------------------------
//language
//----------------------------------------------------------

if (isset($_POST['save_lang'])) {
    $errors = array();
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $language = mysqli_real_escape_string($db, $_POST['language']);
    $level = strtoupper(mysqli_real_escape_string($db, $_POST['level']));
    // $prize = mysqli_real_escape_string($db, $_POST['prize']);
    $file_name = $_FILES['cert']['name'];
    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = $s . $level . "." . $ext;
    $filePath = "images/slang/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/slang/" . $file_name);
    }



    if ($language == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO slang (uid,ayear,lang,level,cert) VALUES('$s','$ayear','$language','$level','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Added'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_lang'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);


    $query = "SELECT cert FROM slang WHERE id='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM slang WHERE id='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_lang'])) {
    $stmt = $db->prepare("UPDATE slang SET status = 1 WHERE id = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}


//language ends


//-------------------------------------------
//projects starts

if (isset($_POST['save_project'])) {
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $semester = mysqli_real_escape_string($db, $_POST['sem']);
    $title = mysqli_real_escape_string($db, $_POST['ti']);
    $git = mysqli_real_escape_string($db, $_POST['gl']);
    $remark = mysqli_real_escape_string($db, $_POST['rm']);

    if ($title == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO sproject(sid,semester,ayear,title,github,remark) VALUES('$s','$semester','$ayear','$title','$git','$remark')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_project'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id9']);

    $query = "DELETE FROM sproject WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_project'])) {
    $stmt = $db->prepare("UPDATE sproject SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}

//projects ends
//-------------------------------------------
//internship starts

if (isset($_POST['save_i'])) {
    $errors = array();
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $event = mysqli_real_escape_string($db, $_POST['event']);
    $event1 = str_replace(' ', '_', $event);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $organiser = mysqli_real_escape_string($db, $_POST['organiser']);
    $dur = mysqli_real_escape_string($db, $_POST['dur']);
    $rem = mysqli_real_escape_string($db, $_POST['rem']);
    $file_name = $_FILES['cert']['name'];
    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $ti=date("d_m_Y_H_i_s");
    $file_name = $s . $ti . "." . $ext;
    $filePath = "images/sintern/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/sintern/" . $file_name);
    }
    if ($event == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO sintern(sid,ayear,iname,type,org,dur,rem,cert) VALUES('$s','$ayear','$event','$type','$organiser','$dur','$rem','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['delete_i'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_idi']);


    $query = "SELECT cert FROM sintern WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM sintern WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['student_idii'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idii']);
    $certification = mysqli_real_escape_string($db, $_GET['certification']);

    $allowed_tables = ['sintern', 's_i_certification', 'internship','scocu','st_extra','slang']; 
    if (!in_array($certification, $allowed_tables)) {
        echo json_encode([
            'status' => 404,
            'message' => 'Invalid table name'
        ]);
        exit;
    }

    $query = "SELECT * FROM $certification WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_GET['student_idiintern'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idiintern']);

    $query = "SELECT * FROM sintern WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_intern'])) {
    $stmt = $db->prepare("UPDATE sintern SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}

//internship ends
//------------------------------------------------
//co-curricular

if (isset($_POST['save_post'])) {
    $errors = array();
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $event = mysqli_real_escape_string($db, $_POST['event']);
    $event1 = str_replace(' ', '_', $event);
    $level = mysqli_real_escape_string($db, $_POST['level']);
    $organiser = mysqli_real_escape_string($db, $_POST['organiser']);
    $prize = mysqli_real_escape_string($db, $_POST['prize']);
    $file_name = $_FILES['cert']['name'];
    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $ti=date("d_m_Y_H_i_s");
    $file_name = $s . $ti . "." . $ext;
    $filePath = "images/scocu/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/scocu/" . $file_name);
    }



    if ($event == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO scocu (sid,ayear,event,level,organiser,prize,cert) VALUES('$s','$ayear','$event','$level','$organiser','$prize','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_co'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_idi']);


    $query = "SELECT cert FROM scocu WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM scocu WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_GET['student_idco'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idco']);

    $query = "SELECT * FROM scocu WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_coco'])) {
    $stmt = $db->prepare("UPDATE scocu SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}

//co-curricular ends
//-------------------------------------------------
//extra-curricular

if (isset($_POST['save_extra'])) {
    $errors = array();
    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $event = mysqli_real_escape_string($db, $_POST['event']);
    $event1 = str_replace(' ', '_', $event);
    $level = mysqli_real_escape_string($db, $_POST['level']);
    $organiser = mysqli_real_escape_string($db, $_POST['organiser']);
    $prize = mysqli_real_escape_string($db, $_POST['prize']);
    $file_name = $_FILES['cert']['name'];
    $file_tmp = $_FILES['cert']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $ti=date("d_m_Y_H_i_s");
    $file_name = $s . $ti . "." . $ext;
    $filePath = "images/st_extra/" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/st_extra/" . $file_name);
    }



    if ($event == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO st_extra (sid,ayear,event,level,organiser,prize,cert) VALUES('$s','$ayear','$event','$level','$organiser','$prize','$filePath')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_ex'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_idi']);


    $query = "SELECT cert FROM st_extra WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($query_run);
    $f = $row['cert'];

    if (file_exists($f)) {
        unlink($f);
    }


    $query = "DELETE FROM st_extra WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_GET['student_idex'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idex']);

    $query = "SELECT * FROM st_extra WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_extra'])) {
    $stmt = $db->prepare("UPDATE st_extra SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}
//extra-curricular ends
//-------------------------------------------------
//carrier progress starts

if (isset($_POST['save_cp'])) {

    $dt = mysqli_real_escape_string($db, $_POST['dt']);
    $ict = mysqli_real_escape_string($db, $_POST['ict']);
    $hr = mysqli_real_escape_string($db, $_POST['hr']);
    $sr = mysqli_real_escape_string($db, $_POST['sr']);


    if ($dt == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO straining (sid,date,ict,hack,skill) VALUES('$s','$dt','$ict','$hr','$sr')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_cp'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_idcp']);


    $query = "DELETE FROM straining WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//carrier progress ends
//-------------------------------------------------
//placement starts

if (isset($_POST['save_place'])) {

    $ayear = mysqli_real_escape_string($db, $_POST['ayear']);
    $dt = mysqli_real_escape_string($db, $_POST['dt']);
    $np = mysqli_real_escape_string($db, $_POST['nc']);
    $ds = mysqli_real_escape_string($db, $_POST['ds']);
    $pr = mysqli_real_escape_string($db, $_POST['pr']);


    if ($dt == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    $query = "INSERT INTO splacement (sid,ayear,date,np,ds,pr) VALUES('$s','$ayear','$dt','$np','$ds','$pr')";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}



if (isset($_POST['delete_pl'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_idp']);


    $query = "DELETE FROM splacement WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['approve_place'])) {
    $stmt = $db->prepare("UPDATE splacement SET status = 1 WHERE uid = ?");
    $student_id = $_POST['student_id5'];
    $stmt->bind_param("i", $student_id);
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Apporoved Successfully'
        ];
    } else {
        $res = [
            'status' => 500,
            'message' => 'Update Failed'
        ];
    }
    $stmt->close();
    echo json_encode($res);
    return;
}

//placement ends
//-------------------------------------------------

//Sem marks
//---------------------------------------------

//sem 1 starts

//add new subjects

if (isset($_POST['save_s1'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss1(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


//sem 2

if (isset($_POST['save_s2'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss2(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 3

if (isset($_POST['save_s3'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss3(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 4

if (isset($_POST['save_s4'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss4(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 5

if (isset($_POST['save_s5'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss5(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 6

if (isset($_POST['save_s6'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss6(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 7

if (isset($_POST['save_s7'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss7(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 8

if (isset($_POST['save_s8'])) {
    $dynamicInputs = $_POST['dynamic_input'];

    // Process and insert data into the database
    // ...

    foreach ($dynamicInputs as $value) {

        if ($value != "") {

            $query = "INSERT INTO ss8(sid,sname) VALUES('$s','$value')";
            $query_run = mysqli_query($db, $query);
        }
    }
    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Created'
        ];
        echo json_encode($res);
        return;
    }
}




//subject adding end

//ms 1
if (isset($_POST['save_s1ms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_s1ms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss1 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_s1ms2'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_s1ms2') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss1 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_s1prep'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_s1prep') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss1 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_s1sem'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_s1sem') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss1 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s1'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss1 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//sem 1 ends
//-----------------------------------------------
//sem 2
//ms 1
if (isset($_POST['save_sem2fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem2fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss2 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem2ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem2ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss2 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem2prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem2prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss2 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem2semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem2semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss2 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s2'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss2 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//sem 2 ends
//-----------------------------------------------

//sem 3
//ms 1
if (isset($_POST['save_sem3fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem3fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss3 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem3ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem3ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss3 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem3prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem3prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss3 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem3semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem3semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss3 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s3'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss3 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
//sem 3 ends
//----------------------------------------------------

//sem 4
//ms 1
if (isset($_POST['save_sem4fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem4fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss4 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem4ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem4ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss4 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem4prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem4prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss4 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem4semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem4semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss4 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s4'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss4 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}


//sem 4 ends
//-----------------------------------------------------------

//sem 5

//ms 1
if (isset($_POST['save_sem5fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem5fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss5 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem5ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem5ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss5 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem5prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem5prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss5 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem5semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem5semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss5 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s5'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss5 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
//sem 5 ends
//-----------------------------------------------------------------

//sem 6

//ms 1
if (isset($_POST['save_sem6fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem6fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss6 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem6ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem6ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss6 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem6prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem6prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss6 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem6semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem6semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss6 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s6'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss6 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 6 ends

//-----------------------------------------

//sem 7 starts
//ms 1
if (isset($_POST['save_sem7fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem7fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss7 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem7ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem7ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss7 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem7prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem7prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss7 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem7semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem7semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss7 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s7'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss7 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 7 ends
//-----------------------------------------------------------------------------
//sem 8 starts
//ms 1
if (isset($_POST['save_sem8fms1'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem8fms1') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss8 SET MS1='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//ms 2

if (isset($_POST['save_sem8ms2f'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem8ms2f') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss8 SET MS2='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//prep

if (isset($_POST['save_sem8prepf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem8prepf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss8 SET prep='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//Sem

if (isset($_POST['save_sem8semf'])) {
    foreach ($_POST as $key => $value) {
        if ($key !== 'save_sem8semf') {
            $uid = mysqli_real_escape_string($db, $key);
            $newMarks = mysqli_real_escape_string($db, $value);

            $query = "UPDATE ss8 SET sem='$newMarks' WHERE uid='$uid'";
            $query_run = mysqli_query($db, $query);

            if (!$query_run) {
                $res = [
                    'status' => 500,
                    'message' => 'Details Not Updated'
                ];
                echo json_encode($res);
                return;
            }
        }
    }

    $res = [
        'status' => 200,
        'message' => 'Details Updated Successfully'
    ];
    echo json_encode($res);
    return;
}

//DELETE

if (isset($_POST['delete_s8'])) {
    $student_id = mysqli_real_escape_string($db, $_POST['student_id5']);

    $query = "DELETE FROM ss8 WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//sem 8 ends

//sgpa

if (isset($_POST['save_sem1SGf'])) {
    //$errors= array();
    $sem = mysqli_real_escape_string($db, $_POST['sem']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $sgpa = mysqli_real_escape_string($db, $_POST['sgpa']);
    $cgpa = mysqli_real_escape_string($db, $_POST['cgpa']);
    $ca = mysqli_real_escape_string($db, $_POST['ca']);
    $oa = mysqli_real_escape_string($db, $_POST['oa']);
    $ms1 = mysqli_real_escape_string($db, $_POST['ms1']);
    $ms2 = mysqli_real_escape_string($db, $_POST['ms2']);
    //$prep = mysqli_real_escape_string($db, $_POST['prep']);
    $ova = mysqli_real_escape_string($db, $_POST['ova']);

    if ($sgpa == "" and $cgpa == "" and $ca == "" and $oa == "" and $ms1 == "" and $ms2 == "" and $ova == "") {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query2 = "SELECT * FROM sgrade WHERE sid='$s' and sem='$sem'";
    $query_run2 = mysqli_query($db, $query2);

    if (mysqli_num_rows($query_run2) == 0) {
        $query = "INSERT INTO sgrade(sid,sem) VALUES('$s','$sem')";
        $query_run = mysqli_query($db, $query);
    }

    if ($sgpa != "") {
        $query = "UPDATE sgrade SET sgpa='$sgpa' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully',
                'sem' => $sem
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($cgpa != "") {
        $query = "UPDATE sgrade SET cgpa='$cgpa' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($ca != "") {
        $query = "UPDATE sgrade SET CA='$ca' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($oa != "") {
        $query = "UPDATE sgrade SET OA='$oa' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($ms1 != "") {
        $query = "UPDATE sgrade SET ms1a='$ms1' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($ms2 != "") {
        $query = "UPDATE sgrade SET ms2a='$ms2' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($ova != "") {
        $query = "UPDATE sgrade SET ova='$ova' WHERE sid='$s' and sem='$sem'";
        $query_run = mysqli_query($db, $query);

        if ($query_run) {
            $res = [
                'status' => 200,
                'message' => 'Details Updated Successfully'
            ];
            echo json_encode($res);
            return;
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//display academic year and faculty name

if (isset($_GET['action'])) {
    $action = $_GET["action"];

    if ($action === "academic_years") {
        // Fetch academic year options


        if ($fdept == "Artificial Intelligence and Data Science") {
            $dept2 = "Artificial Intelligence and Machine Learning";
            $query = "SELECT DISTINCT ayear FROM student WHERE dept='$fdept' OR dept='$dept2'";
        } else {
            $query = "SELECT DISTINCT ayear FROM student WHERE dept='$fdept'";
        }


        //$query = "SELECT DISTINCT ayear FROM student WHERE dept='$fdept'";
        $query_run = mysqli_query($db, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $options = "<option value=''>Select Batch</option>";
            while ($student = mysqli_fetch_assoc($query_run)) {
                $options .= "<option value='" . $student['ayear'] . "'>" . $student['ayear'] . "</option>";
            }
            echo $options;
        }
    } elseif ($action === "faculty_names") {
        // Fetch faculty names

        if ($fdept == "Artificial Intelligence and Data Science") {
            $dept2 = "Artificial Intelligence and Machine Learning";

            $query = "SELECT id, name FROM faculty where dept='$fdept' OR dept='$dept2'";
        } else {
            $query = "SELECT id, name FROM faculty WHERE dept='$fdept'";
        }


        $query_run = mysqli_query($db, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $options = "<option value=''>Select Faculty Name</option>";
            while ($faculty = mysqli_fetch_assoc($query_run)) {
                $options .= "<option value='" . $faculty['id'] . "'>" . $faculty['name'] . "</option>";
            }
            echo $options;
        }
    }
}

//select students



if (isset($_POST['sel_std'])) {
    $academicYear = $_POST["academic_year"];

    $men = "";


    if ($fdept == "Artificial Intelligence and Data Science") {
        $dept2 = "Artificial Intelligence and Machine Learning";

        $query = "SELECT * FROM student WHERE dept='$fdept' OR dept='$dept2' AND ayear='$academicYear' AND mentor='$men' and status=0";
    } else {
        $query = "SELECT * FROM student WHERE dept='$fdept' AND ayear='$academicYear' AND mentor='$men' and status=0";
    }




    // $query = "SELECT * FROM student WHERE dept='$fdept' AND ayear='$academicYear' AND mentor='$men'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($student = mysqli_fetch_assoc($query_run)) {
            echo '
                   <div class="form-check custom-control">
    <div class="checkbox-wrapper-10 d-flex align-items-center">
        <input class="tgl tgl-flip" type="checkbox" name="selected_students[]" value="' . $student['sid'] . '" id="student-checkbox-' . $student['sid'] . '">
        <label class="tgl-btn" data-tg-off="Nope" data-tg-on="Yeah!" for="student-checkbox-' . $student['sid'] . '"></label>

        <label class="form-check-label mb-0 ml-4" for="student-checkbox-' . $student['sid'] . '">' . $student['sid'] . '-' . $student['sname'] . '</label>
    </div>
</div>


                  ';
        }
    } else {
        echo '<li>No students found</li>';
    }
}



if (isset($_POST['sel_std1'])) {
    $academicYear1 = $_POST["academic_year1"];
    $fac = $_POST["fac"];


    if ($fdept == "Artificial Intelligence and Data Science") {
        $dept2 = "Artificial Intelligence and Machine Learning";

        $query = "SELECT * FROM student WHERE dept='$fdept' OR dept='$dept2' AND mentor='$fac' and status=0";
    } else {
        $query = "SELECT * FROM student WHERE dept='$fdept' AND ayear='$academicYear1' AND mentor='$fac' and status=0";
    }


    // $query = "SELECT * FROM student WHERE dept='$fdept' AND ayear='$academicYear1' AND mentor='$fac'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($student = mysqli_fetch_assoc($query_run)) {
            echo '
                   <div class="form-check custom-control">
    <div class="checkbox-wrapper-10 d-flex align-items-center">
        <input class="tgl tgl-flip" type="checkbox" name="selected_students[]" value="' . $student['sid'] . '" id="student-checkbox-' . $student['sid'] . '">
        <label class="tgl-btn" data-tg-off="Remove" data-tg-on="Removed!" for="student-checkbox-' . $student['sid'] . '"></label>

        <label class="form-check-label mb-0 ml-4" for="student-checkbox-' . $student['sid'] . '">' . $student['sname'] . '</label>
    </div>
</div>


                  ';
        }
    } else {
        echo '<li>No students found</li>';
    }
}


//fetch counselling data for enter button action taken



if (isset($_GET['student_idas12'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idas12']);

    $query = "SELECT * FROM counselling WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        //header('Content-Type: application/json');
        echo json_encode($res);
        //echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

//add counselling action by faculty

if (isset($_POST['save_caction'])) {

    $uid = mysqli_real_escape_string($db, $_POST['uidc']);

    $action = mysqli_real_escape_string($db, $_POST['action']);

    if ($action == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE counselling  SET actions='$action' WHERE uid='$uid'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['approve_c'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 1;
    $query = "UPDATE counselling  SET status='$action',adate='$currentDateTime',aname='$fname',aid='$s',arole='$frole' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Approved Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['forward_c'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 2;
    $query = "UPDATE counselling  SET status='$action',adate='$currentDateTime',aname='$fname',aid='$s',arole='$frole' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Forwarded to HOD Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['forwardh_c'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 3;
    $query = "UPDATE counselling  SET status='$action',adate='$currentDateTime',aname='$fname',aid='$s',arole='$frole' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Forwarded to HOD Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}

//-------------------------------------------------

//add assessment scores actions

if (isset($_POST['save_asaction'])) {

    $uid = mysqli_real_escape_string($db, $_POST['uidas']);

    $action = mysqli_real_escape_string($db, $_POST['action']);

    if ($action == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE straining SET action='$action' WHERE uid='$uid'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Suggestion Added Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

//edit assessment score suggestion

if (isset($_GET['student_idas'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idas']);

    $query = "SELECT * FROM straining WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        //header('Content-Type: application/json');
        echo json_encode($res);
        //echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

//As suggestion update

if (isset($_POST['update_as'])) {

    $student_id = mysqli_real_escape_string($db, $_POST['asid']);
    $action = mysqli_real_escape_string($db, $_POST['asaction']);

    if ($action == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE straining  SET action='$action' WHERE uid='$student_id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}

//approve assessment score suggestion

if (isset($_GET['student_idapas'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idapas']);

    $currentDateTime = date('d-m-Y H:i:s');

    $query = "UPDATE straining  SET status='1',adate='$currentDateTime' WHERE uid='$student_id'";

    $query_run = mysqli_query($db, $query);

    if ($query_run) {

        $res = [
            'status' => 200,
            'message' => 'Approved Successfully'
        ];

        echo json_encode($res);

        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Not Approved'
        ];
        echo json_encode($res);
        return;
    }
}





//As end 




//--------------------------------------------------------

//fetch parents meeting data for enter button action taken

if (isset($_GET['student_idas12p'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['student_idas12p']);

    $query = "SELECT * FROM counselling WHERE uid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $student
        ];
        //header('Content-Type: application/json');
        echo json_encode($res);
        //echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}







//add parents meeting actions

if (isset($_POST['save_pmaction'])) {

    $uid = mysqli_real_escape_string($db, $_POST['uidpm']);

    $action = mysqli_real_escape_string($db, $_POST['action']);

    if ($action == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE parentmeeting  SET suggestion='$action' WHERE uid='$uid'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if (isset($_POST['approve_pm'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 1;
    $query = "UPDATE parentmeeting  SET status='$action',adate='$currentDateTime' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Approved Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}

//medical leave forward to HOD

if (isset($_POST['forward_ml'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 2;
    $query = "UPDATE smedical  SET status='$action',adate='$currentDateTime',aname='$fname',aid='$s',arole='$frole' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Forwarded to HOD Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}

//medical leave rejected by faculty

if (isset($_POST['rejec_ml'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 3;
    $query = "UPDATE smedical  SET status='$action',adate='$currentDateTime',aname='$fname',aid='$s',arole='$frole' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Medical Leave Rejected'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}

//-----------------------------------------------------------
//approve medical leave
//-----------------------------------------------------------

if (isset($_POST['approve_ml'])) {
    $fc = mysqli_real_escape_string($db, $_POST['fc']);

    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('d-m-Y H:i:s');
    $action = 1;
    $query = "UPDATE smedical  SET status='$action',adate='$currentDateTime' WHERE uid='$fc'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Approved Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Forwarded'
        ];
        echo json_encode($res);
        return;
    }
}

//-----------------------------------------------------------
//update other faculty Password
//-----------------------------------------------------------

if (isset($_POST['update_opass'])) {

    $pass = mysqli_real_escape_string($db, $_POST['password']);

    if ($pass == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE ofaculty SET pass='$pass' WHERE uname='$s'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//-----------------------------------------------------------
//update other student Password
//-----------------------------------------------------------

if (isset($_POST['update_spass'])) {

    $pass = mysqli_real_escape_string($db, $_POST['password']);

    if ($pass == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }


    $query = "UPDATE student SET pass='$pass' WHERE sid='$s'";
    $query_run = mysqli_query($db, $query);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Password Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


//reset approved
if (isset($_GET['sid_id'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['sid_id']);

    $query = "UPDATE sbasic SET status='0' where sid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {


        $res = [
            'status' => 200,
            'message' => 'Reset Successfully'
        ];
        //header('Content-Type: application/json');
        echo json_encode($res);
        //echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


//reset password
if (isset($_GET['sid_idpass'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['sid_idpass']);
    $student_idu = strtoupper($student_id);

    $query = "UPDATE student SET pass='$student_idu' where sid='$student_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run) {


        $res = [
            'status' => 200,
            'message' => 'Password Reset Successfully'
        ];
        //header('Content-Type: application/json');
        echo json_encode($res);
        //echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

//delete student
if (isset($_GET['sid_iddelete'])) {
    $student_id = mysqli_real_escape_string($db, $_GET['sid_iddelete']);
    $student_idu = strtoupper($student_id);

    $query = "UPDATE student SET status=1 where sid='$student_id'";
    $query1 = "UPDATE sbasic SET status=2 where sid='$student_id'";

    $query_run = mysqli_query($db, $query);
    $query_run1 = mysqli_query($db, $query1);

    if ($query_run && $query_run1) {


        $res = [
            'status' => 200,
            'message' => 'Deleted Successfully'
        ];
        //header('Content-Type: application/json');
        echo json_encode($res);
        //echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'details Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}