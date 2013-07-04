<?php
session_start();
if(isset($_SESSION['sesid'])){
$link = mysql_connect('localhost', 'root','');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
else{
//echo 'Connected successfully';
}$pass= rand(10000,99999);
$pass1=md5($pass);
	
mysql_select_db('prs');
if (isset($_POST['submit'])) {
	$us=$_POST['user'];
	$te=$_POST['tele'];
	
$sql=mysql_query("SELECT * FROM reg WHERE username='$us'");
$sql2=mysql_fetch_array($sql);
if (($sql2[4]==$us) && ($sql2[6]==$te))
{ $sql3="UPDATE reg SET password='$pass1' where username='$us' ";
	if (!mysql_query($sql3,$link))
  {
  die('Error: ' . mysql_error());
  }else{
	  $sql4=mysql_query("UPDATE m_users SET PASSWD='$pass1' where USER_NAME ='$us' ");}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<SCRIPT LANGUAGE="JavaScript">
setTimeout('document.test.submit()',0);
//--></SCRIPT>

<body>
<form method="post" action="../sendsms.php" name="test">

<input type="hidden" name="uid" value="9463414386" />

<input type="hidden" name="pwd" value="PRSPSOFC" />
<input type="hidden" name="sesid" value="$ses_id" />
<input type="hidden" name="phone" value="<?php echo $te ;?>" />

<input type="hidden" name="msg" value="<?php echo "HELLO ".$us.",
 Your password is  ". $pass."


From PRSPS



" ?>" />

<input type="submit" disabled="disabled" readonly="readonly" value="sending data"  />

</form>
<center><b> The password for your PRSPS account is being sent . </b></center>

</body>
</html>
<?php


}else{
?>
<html>
<body bgcolor="#0099FF">
<center> Use our sms service</center>
<center><form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table border="1">
<tr>
<td>Re-enter your telephone number</td>
<td><input type="text" name="tele" maxlength="10" /></td>
</tr>
<tr>
<td>Re-enter your username</td>
<td><input type="text" name="user" maxlength="20" /></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="GET IT" /></td>
</tr>
</table></form></center></body></html>
<?php
}
if(isset($_POST['sub'])){
	$us=$_POST['user'];
	$em=$_POST['email'];
	
	$sql=mysql_query("SELECT * FROM reg WHERE username='$us'");
$sql2=mysql_fetch_array($sql);
if (($sql2[4]==$us) && ($sql2[3]==$em))
{ $sql3="UPDATE reg SET password='$pass1' where username='$us' ";
	if (!mysql_query($sql3,$link))
  {
  die('Error: ' . mysql_error());
  }else{
	  $sql4=mysql_query("UPDATE m_users SET PASSWD='$pass1' where USER_NAME ='$us' ");}
}
	
	error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = "this is your password".$pass;
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "contact.prsps@gmail.com";  // GMAIL username
$mail->Password   = "training1011";            // GMAIL password

$mail->SetFrom('contact.prsps@gmail.com', 'PRSPS');

//$mail->AddReplyTo("raghavb1@gmail.com', 'First Last");

$mail->Subject    = "PRSPS REGISTRATION";

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = $_POST['email'];
$mail->AddAddress($address);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	session_unset();
	session_destroy();
  header("location:../log2.php");
}


}
else{?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body bgcolor="#0099FF">
<br><br><center> OR GET IT via EMAIL</center>
<center>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
<table>
<tr>
<td>Re-enter your username</td>
<td><input type="text" name="user" maxlength="20" /></td>
</tr>
<tr>
<td>re-enter email</td>
 <td><input type="text" name="email" maxlength="30" /></td></tr>
<tr><td><input type="submit" value="submit" name="sub" /></td></tr>
</table></form></center>
</body>
</html>
<?php }

}
else{ header("location:log2.php");}?>