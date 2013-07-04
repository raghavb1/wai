<div class="topic">iDescribe</div><?php
error_reporting(0);
session_start();
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{
include 'db.php';
include 'changer.php';
$user=$_SESSION['uid'];
$sql_query=mysql_query("select * from friends where main='$user' and friend='$uid'");
$sql_fetch=mysql_fetch_array($sql_query);
	if($sql_fetch['approved']=='n' || $sql_fetch['approved']=='rec' || $sql_fetch['approved']==''){ ?>
<script>window.location.href="#!/profile.php?uid=<?php echo $uid ?>";</script>
<?php
}
else{
if($_GET['val']=='r' && $_GET['t']=='others')
{?>
<div class="desc_current">
What others wrote
</div>

<div class="desc_head">
<a href="#!/describe.php?val=r&t=me">What I wrote</a>
</div>
<br /><br />
<?php
$desc_read=mysql_query("select * from testimonials where msg_to='$uid' and approved='y' order by sno desc");
while($desc_write=mysql_fetch_array($desc_read))
{
$sender_id=$desc_write['msg_from'];
$sender_info=mysql_query("select firstname,lastname,picture2,uid from users where uid='$sender_id'");
$sender=mysql_fetch_array($sender_info);
echo '<div class="alldesc"><div class="desc_pic"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;><img src='.$sender['picture2'].' id="profilep" width=52 height=52></a></div>';
echo '<div class="desc_from"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;>'.$sender['firstname'].'&nbsp;'.$sender['lastname'].' </a></div><br><div class="desc_content">'.$desc_write['msg'].'</div></div>';	
}
}
elseif($_GET['val']=='r' && $_GET['t']=='me')
{ ?>
<div class="desc_head">
<a href="#!/describe.php?val=r&t=others">What others wrote</a>
</div>

<div class="desc_current">
What I wrote
</div>
<br /><br />
<?php
$desc_read2=mysql_query("select * from testimonials where msg_from='$uid' and approved='y' order by sno desc");
while($desc_write2=mysql_fetch_array($desc_read2))
{
$sender_id=$desc_write2['msg_to'];
$sender_info=mysql_query("select firstname,lastname,picture2 from users where uid='$sender_id'");
$sender=mysql_fetch_array($sender_info);
echo '<div class="alldesc"><div class="desc_pic"><img src='.$sender['picture2'].' id="profilep" width=52 height=52></div>';
echo '<div class="desc_from">'.$sender['firstname'].'&nbsp;'.$sender['lastname'].'</div><br>';
echo '<div class="desc_content">'.$desc_write2['msg'].'</div></div>';	
}

}
elseif($_GET['val']=='w' && isset($_GET['uid']))
{
?>
<script>
$('.desc_submit').click(function()  
{
var desc = $('.describe').val();
 var dataString = 'desc='+ desc+ '&sendto=<?php echo $uid; ?>';
 	 $('.desc_submit').css('display','none');
	 

$.ajax({
type: "POST",
 url: "request.php",
  data: dataString,
 cache: false,
 success: function(html){
$('.desc_load').html(html);
document.getElementById('describe').value='';
	  	 $('.desc_submit').css('display','inherit');
 }
});
});
</script>
<div class="desc_head"><a href="#!/describe.php?val=m&uid=<?php echo $uid ?>">Read Descriptions</a></div>
<div class="desc_current">Write a description here</div>

<textarea class="describe" id="describe"></textarea>
<div><input type="submit" class="desc_submit" id="v1"/></div>
<div class="desc_load"></div>
<?php }
elseif($_GET['val']=='m' && isset($_GET['uid']))
{
?>
<div class="desc_current">Read Descriptions</a></div>
<div class="desc_head"><a href="#!/describe.php?val=w&uid=<?php echo $uid ?>">Write a description here</a></div><br /><br />
<?php
$desc_read2=mysql_query("select * from testimonials where msg_to='$uid' and approved='y' order by sno desc");
while($desc_write2=mysql_fetch_array($desc_read2))
{
$sender_id=$desc_write2['msg_from'];
$sender_info=mysql_query("select firstname,lastname,picture2 from users where uid='$sender_id'");
$sender=mysql_fetch_array($sender_info);
echo '<div class="alldesc"><div class="desc_pic"><img src='.$sender['picture2'].' id="profilep" width=52 height=52></div>';
echo '<div class="desc_from">'.$sender['firstname'].'&nbsp;'.$sender['lastname'].'</div><br>';
echo '<div class="desc_content">'.$desc_write2['msg'].'</div></div>';	
}
}
else{
echo '<script>top.location.href=\'home.php#!/main.php\';</script>';
}
?>
  <?php
}}
  else
{
echo '<script>window.location.href="#!/describe.php?val=r&t=others"</script>';
}
?>
