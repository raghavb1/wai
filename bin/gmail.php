<?php
//date_default_timezone_set('Asia/Kolkata');

include('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = "Thank You for joining iProfile.<br><br>Username:".$email."<br>Password:".$pass."<br><br>Below is the Verification link.<br>http://localhost/wai/wai/index?vid=".$vid;
//$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP

$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtpout.asia.secureserver.net";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                  // set the SMTP port for the GMAIL server
$mail->Username   = "contact@iprofile.in";  // GMAIL username
$mail->Password   = "Hash33##";            // GMAIL password

$mail->SetFrom('contact@iprofile.in', 'iProfile.in');

//$mail->AddReplyTo("raghavb1@gmail.com', 'First Last");

$mail->Subject    = "Email ID Verification";

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = 'raghavb11@gmail.com';
$mail->AddAddress($address, $address);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

$send=$mail->Send();
if(!$send){


}


?>
