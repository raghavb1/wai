<?php
error_reporting(0);
if(defined( 'parentFile' ) || isset($_SERVER['HTTP_REFERER']))
{
/*	$entry = 'http://en.wikipedia.org/w/api.php?action=opensearch&search=wood&format=xml&limit=1';
$xml=wikipedia($entry);
$final=($xml->Section->Item->Description);
echo $final;*/
 


if(isset($_SESSION))
{
	
}
if(!isset($_SESSION))
{
	session_start();
}
//error_reporting(0);
?>
<?php
include('db.php');
$uid=$_SESSION['uid'];
$top_q=mysql_query("select * from m_menu_master2 order by sno limit 23,4");
?> 
<div class="topic" style="margin-left:2px;">Welcome, <?php echo $_SESSION['fname'] ?></div>
<div class="share_menu">
 <?php
$i=11;
while($top_r=mysql_fetch_array($top_q))
{
echo '<div class="share_menu_options"><img src="logo/'.$top_r['link'].'" width=18 height=18 style="margin-left:4px"></div><a id="'.$i.'" class="todo" style=" float:left; margin-right:3px">'.$top_r['MENU_NAME'].'</a><div style="float:left; margin-top:2px;margin-right:2px">&nbsp;&nbsp;| </div>';
$i=$i+1;
}
?>
<!--<div class="share_menu_options"><img src="logo/map.png" width="18" height="18"  style="margin-left:6px" /></div><a class="todo" style=" float:left; margin-right:2px" id="place_coord">Places</a>--><br />
<div class="update_box">
</div>
</div><script>
   	 $('.sidebarmenu').show();
	 $('#changer').show();
	 $('.content').css("width","580px");
 	 $('.content').css("margin-left","0px");
	 </script>
   <script type="text/javascript">
document.onkeyup=
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
if(unicode==37){

}
if(unicode==39){

}
}
</script>
  <script>
  
<?php 
$pic_query=mysql_query("select picture from users where uid='$uid'");
				 $pic_result=mysql_fetch_array($pic_query);
				 
				 ?>
 $('#changer').html("<img src=loader.gif>").html("<?php echo '<table><tr><td><a href=#!/profile.php?uid='.$uid.'><img src='.$pic_result['picture'].' title='.$_SESSION['fname'].'></td></a></tr></table>'?><div align=center style=font-weight:bold><?php echo $_SESSION['fname'] ?></div>").fadeIn("fast");
   $(".sidebarmenu").load('left.php');
   document.title="iProfile Welcomes You";  
</script>
    <script type='text/javascript'>

  $('#change_pic').click(function() {
$('.change_pic_loader').html('<center>Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></center>').load('pic.php');
  });
    $('#search_buddies').click(function() {
$('.search_box').focus();
  });

</script>
<?php
if($pic_result['picture']=='images/blank_face.jpg'){
echo '<div style="width:100%;margin-top:5px;font-size:14px;float:left" class="final_loader"><a id="change_pic">Upload your iPic</a>&nbsp|&nbsp<a id="search_buddies">Search Buddies</a></div>';
}
echo '<div class="change_pic_loader"></div>';
//echo'<div style="color:#999; margin-top:9px;margin-bottom:8px; text-align:center; font-size:13px"><a id="latest_updates" style="font-weight:bold">New Updates </a>| <a>Real-Time Updates</a><span style="color:#999; font-size:9px">(Coming Soon)</span>| <a>i-Likes</a><span style="color:#999; font-size:9px">(Coming Soon)</span></div>';
include 'update_delete.php';
}
else{
header('location:home.php#!/main.php');	
}

?>