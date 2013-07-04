<?php
session_start();
include 'db.php';
include 'youtube.php';
include 'changer.php';
 function small_pic2($user_id){
$sql_pic=mysql_query("select picture2,firstname,lastname from users where uid='$user_id'");
	$fetch_pic=mysql_fetch_array($sql_pic);
	$s->pic='<img src="'.$fetch_pic['picture2'].'" width="32" height="32" style="float:left; margin-right:5px; margin-bottom:0px" id="profilep"/>';
	$s->name='<font color="#0000CC">'.$fetch_pic['firstname'].' '.$fetch_pic['lastname'].'</font>';
	return $s;	
	 
 }
 ?>
     <script>

	 $("#album_name").Watermark("Create New Album");
	 $('.sidebarmenu').hide();
	 $('#changer').hide();
	 $('.content').css("width","768px");
 	 $('.content').css("margin-left","-195px");	 	 	 

	 </script>
 <?php
if(isset($_GET['alert_id'])){
$alert_id=$_GET['alert_id'];
//echo $alert_id;
$alert_q=mysql_query("select * from notifications where alert_id='$alert_id'");
$alert_r=mysql_fetch_array($alert_q);

$sender_uid=$alert_r['sender_uid'];
$rec_uid=$alert_r['rec_uid'];
$upid=$alert_r['id'];
$alert_1=mysql_query("select * from updates where upid='$upid'");
$alert_num=mysql_num_rows($alert_1);
if($alert_num!=0)
{
echo '<div class="google">
<div class="topic">iAlert</div>
  <ol class="old_updates">';
  $iprofile_main=iprofile_main($alert_1);
  echo $iprofile_main;

echo '</ol></div>';
}
else{
echo '<div class="album_cover">The content you are trying to reach is no longer available. Please check at a later stage<br><a href=#!/main.php>Go back Home</a></div>';	
}
}?>