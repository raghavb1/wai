<script>
   window.onload = function() {
	document.signup_form.email.focus();
   }
</script>
<?php
session_start();
if (isset($_SESSION['email']))
{
	header ('location:home.php');
}
else
{
	include 'style.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php 
include 'db.php';
if (isset($_POST['login']))
{
$email=$_POST['email'];
$email=mysql_real_escape_string($email);
$pass=md5($_POST['pass']);
$pass=mysql_real_escape_string($pass);
$login_query=mysql_query("SELECT * FROM users where email='$email' and password='$pass'");
$login_fetch=mysql_fetch_array($login_query);
if ($email==$login_fetch['email'] && $pass==$login_fetch['password'])
{
	session_start();
	$_SESSION['email']=$email;
	$_SESSION['fname']=$login_fetch['firstname'].'&nbsp;'.$login_fetch['lastname'];
	$_SESSION['theme']=$login_fetch['theme'];
	$_SESSION['picture']=$login_fetch['picture'];
	$_SESSION['uid']=$login_fetch['uid'];
header ('Location:redirecting.php');	
}
else
{
header ('Location:index3.php');	
}
}?>
<body>
    <h1>Login</h1>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" name="signup_form">
    <table>
    <tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
        <tr><td>Pasword:</td><td><input type="password" name="pass" /></td></tr>
        <tr><td><input type="submit" name="login" value="Login" /></td></tr>
        </table>
        </form>
          <?php include'signup.php'; ?>
          </body>
          </html>
<?php 
}
?>