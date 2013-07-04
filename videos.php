<?php
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
?>
<script>
$("#older2").live("click",function(){

var element = $(this);
var I = element.attr("name");
$('.video_loader').css('display','inherit');
var datas= "c2="+ I;	
$.ajax({
type: "POST",
url: "video_help.php?uid=<?php echo $uid; ?>",
data: datas,
cache: false,
success: function(html){
$(".allvideo").html(html);
}
});	
	
}); 

</script>
<div class="topic"><a href="#!/profile.php?uid=<?php echo $uid;?>"><?php echo $pic_result['firstname'].' '.$pic_result['lastname'] ?></a>&nbsp;&raquo;&raquo;&nbsp;<a>Videos</a></div>
 <?php include 'video_help.php'; ?>  
  </div>
  <?php
}}
  else
{
echo '<script>window.location.href="#!/videos.php"</script>';
}