<?php
error_reporting(0);
session_start();

?>

        <script type="text/javascript">
document.onkeyup=
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
if(unicode==37){

}
if(unicode==39){

}
}
</script> <?php
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{ 
include 'db.php';
include 'changer.php';
if(isset($_GET['uid']))
{
$uid=stripslashes($_GET['uid']);
$uid=htmlspecialchars($uid);
$uid=mysql_real_escape_string($uid);
}
elseif(isset($_POST['uid']))
{
$uid=stripslashes($_POST['uid']);
$uid=htmlspecialchars($uid);
$uid=mysql_real_escape_string($uid);
}
else
{
$uid=$_SESSION['uid'];	
}
if(isset($uid)){
	if($uid!=$_SESSION['uid'])
	{
$pageselect=mysql_query("select uid from users where uid='$uid'");
$pageshow=mysql_num_rows($pageselect);
//echo $pageshow;

if($pageshow==0)
{
echo '<script>window.location.href="home.php";</script>';	
}
 $pic_query=mysql_query("select picture,firstname,lastname from users where uid='$uid'"); 
 
 $pic_result=mysql_fetch_array($pic_query);
	echo '<div class="message_send" style="width:500px"><table border="0"><tr><td>To : </td><td>'.$pic_result['firstname'].'&nbsp;'.$pic_result['lastname'].'</td></tr>';
	echo '<tr><td>Subject :</td><td> <input type="text" style="width:400px" id="message_subject"></td></tr>';
	echo '<tr><td>Message :</td><td> <textarea style="width:400px; height:100px" id="message_message"></textarea></td></tr>';
	echo '<tr><td><input type="submit" id="message_submit" name='.$uid.'></td></tr></table></div>';
	
	}
}
if($uid==$_SESSION['uid'] && !isset($_GET['mid']))
{
	?> 
  
    <?php
	echo '<div class="topic"><a href="#!/message.php?val=r&t=others">Messages</a></div>';
	$messageq=mysql_query("select * from messages where rec='$uid' and type='m' order by sno desc");
	$message_count=mysql_num_rows($messageq);
	if($message_count!=0){
	while($messager=mysql_fetch_array($messageq)){
$sender_id=$messager['sender'];
$sender_info=mysql_query("select firstname,lastname,picture2,uid from users where uid='$sender_id'");
$sender=mysql_fetch_array($sender_info);
echo '<div class="alldesc"><div class="desc_pic"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;><img src='.$sender['picture2'].' id="profilep" width=52 height=52></a></div><div class="desc_from"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;>'.$sender['firstname'].'&nbsp;'.$sender['lastname'].' </a>
</div><br><div class="desc_content" style="width:400px; margin-left:63px;">'.stripslashes($messager['message']).'</div>
<div id="message_reply_response'.$messager['mid'].'"></div><div style="float:right;font-size:13px;background-image:url(themes/53.jpg);padding:5px  "><a href="#!/message.php?mid='.$messager['mid'].'">View Full Conversation</a></div>
</div>';	
	}
	}
	else{
	echo 'No Messages Received';	
	}

}
}
if(isset($_GET['mid'])){
	?>

    <?php
	$mid=$_GET['mid'];
	echo '<div class="topic"><a href="#!/message.php?val=r&t=others">Messages</a>--><a>Full Conversation</a></div>';
	$messageq=mysql_query("select * from messages where mid='$mid' order by sno asc");
	$message_count=mysql_num_rows($messageq);
	while($messager=mysql_fetch_array($messageq)){
	if($message_count!=0){
		$sender_id=$messager['sender'];

$sender_info=mysql_query("select firstname,lastname,picture2,uid from users where uid='$sender_id'");
$sender=mysql_fetch_array($sender_info);
echo '<div class="alldesc"><div class="desc_pic"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;><img src='.$sender['picture2'].' id="profilep" width=52 height=52></a></div>';
echo '<div class="desc_from"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;>'.$sender['firstname'].'&nbsp;'.$sender['lastname'].' </a>
</div><br><div class="desc_content" style="width:400px; margin-left:63px;">'.stripslashes($messager['message']).'</div></div><div style="float:left;	margin-bottom:15px;"></div>';
	}
	}
		echo '<div id="message_reply_response'.$mid.'"></div><span class="message_reply" id="'.$mid.'" style="float:left;font-size:13px;width:490px;background-image:url(themes/53.jpg);padding:10px "><a>Reply</a></span></div>';
}

?>