<?php
include '../db.php';
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');
$date=date('h:i A \| jS F');
function cleaner($value){
$value=mysql_real_escape_string($value);
return $value;

}
session_start();
$fname=cleaner(ucfirst(strtolower($_POST['fname'])));
$lname=cleaner(ucfirst(strtolower($_POST['lname'])));
$email=cleaner($_POST['email']);
$pass=cleaner($_POST['pass']);
$captcha=cleaner($_POST['captcha']);
$email_q=mysql_query("select email from users where email='$email'");
if(mysql_num_rows($email_q)==0){
	$vid=mt_rand().mt_rand().mt_rand().mt_rand();

//include 'gmail.php';
$pass=md5($_POST['pass']);
if(isset($a)){
echo '<div style="color:#F00;margin-top:30px;" align="center">Mail Could not be sent to your email ID.<br> Try again later.</div>';	
}elseif($captcha!=$_SESSION['security_code']){
echo '<br><div style="color:#F00;margin-top:30px;" align="center">Verification Code not filled correctly</div>';	
}
else{
$uid=mt_rand().mt_rand().mt_rand();

$query=mysql_query("INSERT into users(firstname,lastname,email,password,uid,vid) VALUES ('$fname','$lname','$email','$pass','$uid','$vid')");
$query=mysql_query("INSERT into friends(main,friend,approved) VALUES ('$uid','$uid','y')");

$aid=mt_rand().mt_rand().mt_rand();
$query=mysql_query("INSERT into albums(album,uid,aid) VALUES ('Profile Pictures','$uid','$aid')");
$query=mysql_query("INSERT into images(image_thumb,image_orig,uid,aid) VALUES ('images/smalldef.jpg','images/def.jpg','$uid','$aid')");

$upid=mt_rand().mt_rand().mt_rand();
$name=$fname.' '.$lname;
$query=mysql_query("INSERT into updates(upid,msg_from,uid,category,describer,time) VALUES ('$upid','$name','$uid','joined iProfile','joining','$date')");
session_start();
	$_SESSION['email']=$email;
	$_SESSION['fname']=$fname.'&nbsp;'.$lname;
	$_SESSION['picture']='images/blank_face.jpg';
	$_SESSION['uid']=$uid;
	mysql_query("update users set online='y' where uid='$uid'");
echo '<script>window.location.href="index.php#!/profile.php?uid='.$uid.'&sk"</script>';
}
}
else{
echo '	<div style="color:#F00;margin-top:30px" align="center">Email Already Registered</div>';
}

?>