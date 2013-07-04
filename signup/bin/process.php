<?php
include 'db.php';
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$query=mysql_query("INSERT into users(firstname,lastname,email,password) VALUES ('$fname','$lname','$email','$pass')");
if($query)
{
	echo "submitted";
}
else
{
	echo "error";
}
?>