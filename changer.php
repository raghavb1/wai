<?php
include 'db.php';
//error_reporting(0);
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
$pageselect=mysql_query("select uid from users where uid='$uid'");
$pageshow=mysql_num_rows($pageselect);
//echo $pageshow;
if($pageshow==0)
{
echo '<script>window.location.href="home.php";</script>';	
}
 $pic_query=mysql_query("select picture,firstname,lastname,picture2 from users where uid='$uid'"); 
 
 $pic_result=mysql_fetch_array($pic_query);
if($uid!=$_SESSION['uid'])
{
	$user=$_SESSION['uid'];

 ?>
 
  <script>
   	 $('.sidebarmenu').show();
	 $('#changer').show();
	 $('.content').css("width","580px");
 	 $('.content').css("margin-left","0px");
   $('#changer').html("<?php echo '<table><tr><td><a href=#!/profile.php?uid='.$uid.'><img src='.$pic_result['picture'].' title='.$pic_result['firstname'].'&nbsp;'.$pic_result['lastname'].'></a></td></tr></table>'?><div style=font-weight:bold align=center><?php echo $pic_result['firstname'].'&nbsp;'.$pic_result['lastname'] ?></div>").fadeIn("fast");
	$.ajax({
		type: "POST",
  url: 'left_profile.php',
   data: 'uid=<?php echo $uid;?>',
  cache: false,
  success: function(html){
	  
  $(".sidebarmenu").html(html);
     document.title = "<?php  echo $pic_result['firstname'].' '.$pic_result['lastname'] ?> | iProfile";
  }
 });

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
 <?php
 }
 else
{
?>
<script>  
   	 $('.sidebarmenu').show();
	 $('#changer').show();
	 $('.content').css("width","580px");
 	 $('.content').css("margin-left","0px"); 
   $('#changer').html("<img src=loader.gif>").html("<?php echo '<table><tr><td><a href=#!/profile.php?uid='.$uid.'><img src='.$pic_result['picture'].' title='.$pic_result['firstname'].'&nbsp;'.$pic_result['lastname'].'></td></a></tr></table>'?><div style=font-weight:bold align=center><?php echo $_SESSION['fname'] ?></div>").fadeIn("fast");
   $(".sidebarmenu").load('left.php');
 
   
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
<?php 
}
?>

