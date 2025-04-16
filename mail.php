<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email address from the AJAX request
    $id = $_POST['fid'];
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM basic WHERE email = ? AND id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('si', $email, $id); // 'si' means string and integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
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

        $query2 = "SELECT pass,name FROM faculty WHERE id='$id'";
        $query_run2 = mysqli_query($db, $query2);
        if (mysqli_num_rows($query_run2) > 0) {
            $row2 = mysqli_fetch_assoc($query_run2);
            $f = $row2['pass'];
            $name = $row2['name'];
        }
        try {
            // SMTP settings

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
            $mail->Subject = 'Password Reset for MKCE INFO CORNER';
            $mail->isHTML(true);
            $mail->Body = 'Hello <strong>' . $name . '</strong>,
<br>
<br>
You have requested to recover your password for your account. Your Password is: <strong>' . $f . '</strong>
<br>
<br>
If you did not request a password, please ignore this email.
<br>
<br>
Thank you.!';


            // Send the email
            $mail->send();

            $res = [
                'status' => 200,
                'message' => 'Password sent successfully to your Email!'
            ];
            echo json_encode($res);
            return;
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
        }
    } else {
        // Email not found in the database
        $res = [
            'status' => 500,
            'message' => 'Email not found. Kindly Check your Email and Faculty ID!'
        ];
        echo json_encode($res);
        return;
    }
} else {
    echo 'Invalid request';
}

// Close the database connection
$db->close();
