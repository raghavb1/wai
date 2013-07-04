<?php 
error_reporting(0);
header('Cache-Control: no-cache');
 header('Pragma: no-cache'); 
include 'db.php';
?><?php
error_reporting(0);
session_start();
if(!isset($_SESSION['uid']))
{
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="shortcut icon" HREF="logo/favicon.gif">
<META name="fragment" content="!">
<META HTTP-EQUIV="pragma" CONTENT="NO-CACHE" charset="utf-8" />
<META NAME="AUTHOR" CONTENT="iProfile /">
<META NAME="DESCRIPTION" CONTENT="iProfile helps you connect with your buddies. Share photos and Videos. Track your buddies with iProfile Places Notifier">
<title>iProfile Welcomes You</title>
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
width:180px; height:25px;
padding-top:4px;
font-size:14px;	
}
</style>
</head>
<body style="background-image:url(themes/48.jpg)">
<div class="index_header"><a href="home.php" style="margin-top:5px"><img src="logo/logo.png" style="margin-top:10px"/></a></div><div class="container3">

<div class="index_sidebar12">
<div class="index_sidebar1">
<div  style="padding:8px;	font-size:14px; float:left">
<div class="index_about"><img src="logo/connecti.png"  width="128px" height="128px" />Connect with Buddies.</div>
<div class="index_about"><img src="logo/youtubei.png"   width="128px" height="128px"/>Share photos and Videos.</div>
<div class="index_about"><img src="logo/buddyi.png"    width="128px" height="128px" />Express with Custom Profiles.</div>
<div class="index_about"><img src="logo/googlei.png"   width="128px" height="128px" />Customized Search</div>
<div class="index_about"><img src="logo/gmaps.png"   width="128px" height="128px" />iProfile Places Notifier.</div>
<div class="index_about"><img src="logo/chat.png"   width="128px" height="128px" />Simple and Fast Chatting.</div>
</div></div>
</div>
<div class="index_sidebar12">
<div class="index_sidebar2">
<div style="margin-left:35px">
<form action="login.php" method="post">
    <h1 style="margin-left:110px">Login</h1>
    <div style="color:#F00;margin-left:80px"><?php if(isset($_GET['attempt'])){echo 'Invalid Login';} ?></div>
    <table style="font-size:14px; padding:15px; color:#030"  class="image_thumb">
    <tr><td>Email:</td><td><input type="text" id="email" class="login_email" name="login_email" value="<?php if(isset($_GET['attempt'])){echo $_GET['attempt'];} ?>"/></td></tr>
        <tr><td>Pasword:</td><td><input type="password" id="pass" class="login_pass" name="login_pass"/></td></tr>
        <tr><td></td><td align="center"><input type="submit" value="Login" class="v" id="login_button" name="login_r"/><center><img src="loader2.gif" width="40px" height="10px" style="display:none" id="loaderr2"/></center></td></tr>
        </table></form>
</div>

  <div id="contact_form">
    <div class="register">  <h1 style="margin-left:140px">Sign Up</h1>
</div>
  <form name="contact" method="post">
    <table border="0" style="font-size:14px; padding:10px" class="image_thumb">
    <tr>
     <td><label for="fname" id="fname_label">First Name</label></td>
     <td><input type="text" name="fname" id="fname" size="30" value="" class="text-input" /></td>
     <td style="font-size:9px"> <label class="error" for="fname" id="fname_error" style="display:none; font-size:10px">This field is required.</label></td>
     <td> <label class="error" for="fname" id="fname_error1" style="display:none; font-size:10px">Illegal Characters used.</label>      </td>
     </tr>
     
     <tr>
     <td> 
      <label for="lname" id="lname_label">Last Name</label></td>
     <td><input type="text" name="lname" id="lname" size="30" value="" class="text-input" /></td>
     <td><label class="error" for="lname" id="lname_error" style="display:none; font-size:10px">This field is required.</label></td>
     <td><label class="error" for="lname" id="lname_error1" style="display:none; font-size:10px">Illegal Characters used.</label></td>
      </tr>
      
      <tr>
      <td>
      <label for="emaill" id="email_label">Email</label></td>
     <td><input type="text" name="emaill" id="emaill" size="30" value="" class="text-input" /></td>
     <td><label class="error" for="emaill" id="email_error" style="display:none; font-size:10px">This field is required.</label></td>
    <td><label class="error" for="emaill" id="email_error1" style="display:none; font-size:10px">Illegel Characters used</label></td>
    <td><label class="error" for="emaill" id="email_error2" style="display:none; font-size:10px">Not a valid email Address</label>  </td>
    <td><label class="error" for="emaill" id="email_error3" style="display:none; font-size:10px">email already registred</label>  </td>              
      </tr>
      
      <tr>
      <td>
     Password</td>
     <td><input type="password" name="passs" id="passs" size="30" value="" class="text-input" /></td>
    <td><label class="error" for="passs" id="pass_error" style="display:none; font-size:10px">This field is required.</label></td>
      </tr>
      
            <tr>
      <td>
     Repeat Password</td>
     <td><input type="password" name="passs2" id="passs2" size="30" value="" class="text-input" /></td>
    <td><label class="error" for="passs2" id="pass2_error" style="display:none; font-size:10px">Passwords do not match</label></td>
      </tr>
            <tr>
      <td>
     <img src="captcha.php" /></td>
     <td><input type="text" name="captcha" id="captcha" size="30" value="" class="text-input" /></td>
    <td><label class="error" for="captcha" id="captcha_error" style="display:none; font-size:10px">This field is required.</label></td>
      </tr>
      
      
       <tr><td></td>
       <td><input type="submit" name="submit" id="button" class="v" value="Sign Up" /><center><img src="loader2.gif" width="40px" height="10px" style="display:none" id="loaderr"/></center>
      </td>
      </tr>
      
      </table>
  </form>
</div></div></div>
</div>    <br /><br /><br /><br /><br />    <div  align="center">

			<img src="logo/footer.png" /><br /><a href="#" class="current">Home</a> | <a href="#">Find Friends</a> | <a href="#">Developers</a> | <a href="#">Privacy</a> | <a href="#">Suggestions</a> | <a href="#">Terms</a> | <a href="#">Career</a><br /><br />
    
        	© <a href="">iProfile</a>
            
	    </div>
          </body>
          </html>
<?php 
}
?>