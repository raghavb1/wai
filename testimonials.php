<script>
 $(".sidebar2").css('display','inherit');
 </script>
 <?php
session_start();
include 'db.php';
$uid=$_SESSION['uid'];	
echo $uid;

if($_GET['val']=='r')
{?>
<div>
Testimonials i recieved
</div>
<div>
Testimonials i wrote
</div>
<?php
}
elseif($_GET['val']=='w' && isset($_POST['uid']))
{
?>
Write a testimonial here
<?php }
else{
echo '<script>top.location.href=\'home.php\';</script>';
}
?>