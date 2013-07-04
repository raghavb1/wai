<?php
error_reporting(0);
if(isset($_SESSION))
{
	
}
if(!isset($_SESSION))
{
	session_start();
}
$uid=$_SESSION['uid'];
 function small_pic2($user_id){
$sql_pic=mysql_query("select picture2,firstname,lastname from users where uid='$user_id'");
	$fetch_pic=mysql_fetch_array($sql_pic);
	$s->pic='<img src="'.$fetch_pic['picture2'].'" width="52" height="52" style="float:left; margin-right:5px; margin-bottom:0px" id="profilep"/>';
	$s->name='<font color="#0000CC">'.$fetch_pic['firstname'].' '.$fetch_pic['lastname'].'</font>';
	return $s;	
	 
 }
include 'db.php';
//mysql_query("update users set online='y' where uid='$uid'");
if(!isset($_GET['cond'])){
$alert=mysql_query("select * from notifications where rec_uid='$uid' order by sno desc limit 5");
$alert_count=mysql_num_rows($alert);
}
else{
	$alert=mysql_query("select * from notifications where rec_uid='$uid' order by sno desc");
$alert_count=mysql_num_rows($alert);
}
$alert2=mysql_query("select * from notifications where rec_uid='$uid' and approved='n' order by sno desc");
$alert_count2=mysql_num_rows($alert2);
$alert3=mysql_query("select * from notifications where rec_uid='$uid' order by sno desc");
$alert_count3=mysql_num_rows($alert3);
if(!isset($_GET['cond'])){
echo '<div class="notify" style="margin-top:0px;"><img src="logo/alert.png" style="margin-right:5px"/>iAlerts: ('.$alert_count2.' unread)</div>
<div class="notify_under" id="alert_box_under">';
}
if(isset($_GET['cond'])){
	?>
     <script>

	 $("#album_name").Watermark("Create New Album");
	 $('.sidebarmenu').hide();
	 $('#changer').hide();
	 $('.content').css("width","775px");
 	 $('.content').css("margin-left","-195px");	 	 	 

	 </script>
    <?php echo '<div class="topic">Alerts</div>';}
if($alert_count==0){
echo '<center><font size="+1">You have no Alerts</font></center>';	
}
while($alert_a=mysql_fetch_array($alert))
{
	$picy=small_pic2($alert_a['sender_uid']);
	
echo '<div class="alerts" id="'.$alert_a['sno'].'" style="background-color:';
if($alert_a['approved']=='n'){
echo '#FFC';	
}
else{
echo '';	
}
echo '"><a href="#!/profile.php?uid='.$alert_a['sender_uid'].'">'.$picy->pic.'</a>';
if($alert_a['describer']=='photo'){
$upid=$alert_a['id'];
$uid=$alert_a['rec_uid'];
$pid_q=	mysql_query("select image_orig,aid,uid from images where upid='$upid'");
$pid_r=	mysql_fetch_array($pid_q);
	echo '<a href="#!/album.php?uid='.$pid_r['uid'].'&aid='.$pid_r['aid'].'&pid='.$pid_r['image_orig'].'"><div style="margin-left:35px;">'.$picy->name.' '.$alert_a['msg'].'</div></a></div>';	
}
elseif($alert_a['describer']=='message'){
	$mid=$alert_a['id'];
	echo '<a href="#!/message.php?mid='.$mid.'"><div style="margin-left:35px;">'.$picy->name.' '.$alert_a['msg'].'</div></a></div>';
}
else{
	echo '<a href="#!/alert_open.php?alert_id='.$alert_a['alert_id'].'"><div style="margin-left:35px;">'.$picy->name.' '.$alert_a['msg'].'</div></a></div>';
}

}	if(!isset($_GET['cond'])){
if($alert_count3>5){

echo '<div align="center" style="width:200px;float:left; background-color:#F2F2F2; margin-left:2px; padding:3px"><a href="#!/alerts.php?cond=open_all">View All</a></div> ';
	}}?>
</div>