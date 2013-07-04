<?php
session_start();
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{

include('db.php');

$firstname=$_SESSION['fname'];
$uid=$_SESSION['uid'];
if(isset($_POST['content']))
{
$content=$_POST['content'];
if (get_magic_quotes_gpc()) {
  $content = stripslashes($content);
}

$content=mysql_real_escape_string($content);
$content=htmlspecialchars($content);
$category='shared his thought';
$user=$_SESSION['email'];
mysql_query("insert into updates(msg_from,msg,uid,category) values ('$firstname','$content','$uid','$category')");

}
}
?>
