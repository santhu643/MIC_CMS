+<?php
require "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if (isset($_POST['noapproval'])){
    $email = "cragulraja2004@gmail.com";
    $email1 = "saransoundhar06@gmail.com";
    $email2 = "samiisboss1574@gmail.com";
    $email3 = "rabinsmith27124s@gmail.com";    
    // Check if the email exists in the database
    $query = "SELECT * FROM complaints_detail WHERE status = 9";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 1) {
        // Email exists in the database, send the email
        $mail = new PHPMailer(true);
        /*
            $query = "SELECT * FROM faculty WHERE id = ?";
            $stmt = $db->prepare($query);
            $stmt->bind_param('si',$id); // 'si' means string and integer
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $pass = $row['pass'];

*/
$currentDate = date("Y-m-d");

$query2 = "SELECT * FROM complaints_detail WHERE DATEDIFF('$currentDate',manager_approve) > 1 AND status = '9'";
$query_run2 = mysqli_query($db, $query2);

if (mysqli_num_rows($query_run2) > 0) {
    // Initialize the email body
    $emailBody = "
    <p>Dear Manager,</p>
    <p>The following complaints have not been accepted by the worker:</p>
    <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <th>S.No</th>
            <th>Complaint ID</th>
            <th>Registration Date</th>
            <th>Faculty ID</th>
        </tr>";
        $sno = 1;

    while ($row2 = mysqli_fetch_assoc($query_run2)) {
        $id = $row2['id'];
        $rdate = $row2['date_of_reg'];
        $f_id = $row2['fac_id'];

        $emailBody .= "
        <tr>
            <td>$sno</td>
            <td>$id</td>
            <td>$rdate</td>
            <td>$f_id</td>
        </tr>";
        $sno+=1;
    }

    $emailBody .= "
    </table>
    <p>Please take necessary action.</p>
    <p>Regards,<br>Complaint Management Team</p>";

    try {
        // SMTP settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mkceinfocorner@gmail.com'; // Your Gmail email address
        $mail->Password = 'npdllnbipximwvnq'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('mkceinfocorner@gmail.com', 'MKCE_INFO_CORNER');
        $mail->addAddress($email);
        $mail->addAddress($email1);
        $mail->addAddress($email2);
        $mail->addAddress($email3);

        // Email content
        $mail->Subject = 'Pending Complaints Not Accepted';
        $mail->isHTML(true);
        $mail->Body = $emailBody;

        // Send the email
        $mail->send();

        $res = [
            'status' => 200,
            'message' => 'Email sent successfully with all pending complaints!'
        ];
        echo json_encode($res);
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
    }
} else {
    $res = [
        'status' => 500,
        'message' => 'No complaints found with status 9 and manager approval delay!'
    ];
    echo json_encode($res);
}
    }
} 


if(isset($_POST['deadline'])){
    $email = "saransoundhar06@gmail.com";
    $currentDate = date("Y-m-d");
    $query2 = "SELECT * FROM complaints_detail WHERE DATEDIFF('$currentDate',days_to_complete) = 0 AND status='10'";
    $query_run2 = mysqli_query($db, $query2);

    if(mysqli_num_rows($query_run2)>0){
        $emailBody = "
        <p>Dear Manager,</p>
        <p>The following complaints have been crossing the deadline by today:</p>
        <table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>S.No</th>
                <th>Complaint ID</th>
                <th>Registration Date</th>
                <th>Faculty ID</th>
            </tr>";
            $sno = 1;
    }

    while ($row2 = mysqli_fetch_assoc($query_run2)) {
        $id = $row2['id'];
        $rdate = $row2['date_of_reg'];
        $f_id = $row2['fac_id'];

        $emailBody .= "
        <tr>
            <td>$sno</td>
            <td>$id</td>
            <td>$rdate</td>
            <td>$f_id</td>
        </tr>";
        $sno+=1;
    }



    try {
        // SMTP settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mkceinfocorner@gmail.com'; // Your Gmail email address
        $mail->Password = 'npdllnbipximwvnq'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('mkceinfocorner@gmail.com', 'MKCE_INFO_CORNER');
        $mail->addAddress($email);


        // Email content
        $mail->Subject = 'Complaint crossing Deadline';
        $mail->isHTML(true);
        $mail->Body = $emailBody;

        // Send the email
        $mail->send();

        $res = [
            'status' => 200,
            'message' => 'Email sent successfully with all pending complaints!'
        ];
        echo json_encode($res);
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
    }
} else {
    $res = [
        'status' => 500,
        'message' => 'No complaints found with status 9 and manager approval delay!'
    ];
    echo json_encode($res);
}    

if(isset($_POST['approved'])){
    $email = "rabinsmith27124s@gmail.com";
    $id = $_POST['id'];
    $query2 = "SELECT * FROM complaints_detail WHERE id='$id'";
    $query_run2 = mysqli_query($db, $query2);

    if(mysqli_num_rows($query_run2)>0){
        $emailBody = "
        <p>Dear Manager,</p>
        <p>The following complaint has been accepted by the worker:</p>
        <table border='1' cellpadding='5' cellspacing='0'>
            <tr>
                <th>S.No</th>
                <th>Complaint ID</th>
                <th>Registration Date</th>
                <th>Faculty ID</th>
            </tr>";
            $sno = 1;
    }

    while ($row2 = mysqli_fetch_assoc($query_run2)) {
        $id = $row2['id'];
        $rdate = $row2['date_of_reg'];
        $f_id = $row2['fac_id'];

        $emailBody .= "
        <tr>
            <td>$sno</td>
            <td>$id</td>
            <td>$rdate</td>
            <td>$f_id</td>
        </tr>";
        $sno+=1;
    }
    $emailBody .= "
    </table>
    <p>Regards,<br>Complaint Management Team</p>";


    try {
        // SMTP settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mkceinfocorner@gmail.com'; // Your Gmail email address
        $mail->Password = 'npdllnbipximwvnq'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('mkceinfocorner@gmail.com', 'MKCE_INFO_CORNER');
        $mail->addAddress($email);


        // Email content
        $mail->Subject = 'Complaint Accepted';
        $mail->isHTML(true);
        $mail->Body = $emailBody;

        // Send the email
        $mail->send();

        $res = [
            'status' => 200,
            'message' => 'Email sent successfully with all pending complaints!'
        ];
        echo json_encode($res);
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
    }
} else {
    $res = [
        'status' => 500,
        'message' => 'No complaints found with status 9 and manager approval delay!'
    ];
    echo json_encode($res);
}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>

    <script>
        $(document).ready(function(e){
            $.ajax({
                type:"POST",
                url:"email.php",
                data:{
                    deadline:true,
                },
                success:function(response){
                    var res = jQuery.parseJSON(response);
                    if(res.status==200){
                        console.log("success");
                    }
                    else{
                        console.log("error");
                    }
                }
            })
        });

        $(document).ready(function(e) {
$.ajax({
    type: "POST",
    url: "email.php",
    data: {
        noapproval: true,
    },
    success: function(response) {
        var res = jQuery.parseJSON(response);
        if (res.status == 200) {
            console.log("success");
        } else {
            console.log("error");
        }
    }
});



});




    </script>
</body>
</html>