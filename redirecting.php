<?php 
session_start();
error_reporting(0);
if (isset($_SESSION['email']))
{
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta HTTP-EQUIV="REFRESH" content="0; url=home">
<title>Redirecting</title>
<script language="javascript">
if (window.location.search == "") {
top.location.href = window.location + "?width=" + screen.width;
} 
</script>
<?php
$width = $_GET['width'];
$_SESSION['width']=$width;

?> 

</head>
</html>
<?php }
else
{
header('Location:index');	
} ?>
