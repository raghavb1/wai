<?php 
error_reporting(0);
header('Cache-Control: no-cache');
 header('Pragma: no-cache'); 
include 'db.php';
error_reporting(0);
session_start();
include 'youtube.php';
if (isset($_POST['login_email']))
{
$email=cleaner($_POST['login_email']);
$pass=md5(cleaner($_POST['login_pass']));
$login_query=mysql_query("SELECT * FROM users where email='$email' and password='$pass'");
$login_fetch=mysql_fetch_array($login_query);
if ($email==$login_fetch['email'] && $pass==$login_fetch['password'])
{
	$uid=$login_fetch['uid'];
	if($login_fetch['approved']=='y')
	{
	//session_start();
	include 'browser.php'; 
$browser = new browser ;
	$_SESSION['approved']=$login_fetch['approved'];

	$_SESSION['browser']=$browser->Name;
	$_SESSION['bversion']=$browser->Version;
	$_SESSION['email']=$email;
	$_SESSION['fname']=$login_fetch['firstname'].'&nbsp;'.$login_fetch['lastname'];
	$_SESSION['theme']=$login_fetch['theme'];
	$_SESSION['picture']=$login_fetch['picture'];
	$_SESSION['uid']=$login_fetch['uid'];
	$_COOKIE['uid']=$login_fetch['uid'];	
	mysql_query("update users set online='y' where uid='$uid'");
	
	}
}

}

if(isset($_SESSION['uid'])){
?>
<script>
window.location.href="/";
</script>
<?php
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="shortcut icon" HREF="logo/favicon.gif">
<META name="fragment" content="!">
<META HTTP-EQUIV="pragma" CONTENT="NO-CACHE" charset="utf-8" />
<META NAME="ROBOTS" CONTENT="INDEX,NOFOLLOW" />
<META NAME="AUTHOR" CONTENT="iProfile /">
<META NAME="DESCRIPTION" CONTENT="iProfile helps you connect with your buddies. Share photos and Videos. Track your buddies with iProfile Places Notifier">
<title>iProfile</title>
<title>iProfile</title>
<?php
//include 'style.php';
include 'scripts.php'; ?>
<script>
$(function() {

   $("#email").Watermark("Email ID");
      $("#pass").Watermark("Password:");
	        $("#provider").Watermark("Service Provider");
});
   
   </script>
   <script>
   window.onload = function() {
	$('.login_email').focus();
   }
</script>
<style>
.container3 input{
width:150px; height:25px;	
}
</style>
</head>
<body style="background-image:url(themes/48.jpg)">
<div class="index_header"><a href="home.php" style="margin-top:5px"><img src="logo/logo.png" style="margin-top:10px"/></a></div>
<div class="container3">
<div align="center"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<form action="login.php" method="post">
    <h1 style="margin-left:15px">Login</h1>
    <div style="color:#F00;margin-left:80px"><?php if(isset($_GET['attempt'])){echo 'Invalid Login';} ?></div>
    <table style="font-size:14px; padding:15px; color:#030"  id="profilep">
    <tr><td>Email:</td><td><input type="text" id="email" class="login_email" name="login_email" value="<?php if (isset($_POST['login_email'])){ echo $_POST['login_email'];} ?>"/></td></tr>
        <tr><td>Pasword:</td><td><input type="password" id="pass" class="login_pass" name="login_pass"/></td></tr>
        <tr><td></td><td align="center"><input type="submit" value="Login" class="v" id="login_button" name="login_r"/><center><img src="loader2.gif" width="40px" height="10px" style="display:none" id="loaderr2"/></center></td></tr>
        </table></form>
</div></div></body></html>
<?php 
}
?>