<?php

require __DIR__ . '/vendor/autoload.php';
$clientName =  $_POST["name"];
$clientEmail = $_POST["email"];
$clientSubject = $_POST["subject"];
$clientMessage = $_POST["textarea"];
$clientNumber = $_POST["number"];
$message = `<html>
<head>
    <style>
        h1 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Name:$clientName</h1>
    <p>Email: $clientEmail</p>
    <p>Mobile: $clientNumber</p>
    <p>Subject: $clientSubject</p>
    <p>Message: $clientMessage</p>
</body>
</html>`;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//pluggin
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username = 'email@delightfulstudios.in';
        $mail->Password   = 'email@A123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->setFrom("email@delightfulstudios.in", 'Client');
        $mail->addBCC('vijaydrive14@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'Client Alert!';
        $mail->msgHTML("<h1>Name:$clientName</h1> <p>Email: $clientEmail</p>
        <p>Mobile: $clientNumber</p>
        <p>Subject: $clientSubject</p>
        <p>Message: $clientMessage</p>");
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {

            header("Location:http://localhost:8000/index.php");
            // header("Location: https://delightfulstudios.in/index.php");
            exit;
        }
    } catch (Exception $ex) {
        die('exception occoured: ' . $ex);
    }
} else {
    echo 'You are not allowed to access this page';
}
