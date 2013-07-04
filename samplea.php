<?php
if(isset($_SESSION))
{
	
}
if(!isset($_SESSION))
{
	session_start();
}

if((defined( 'parentFile' ) || isset($_SERVER['HTTP_REFERER'])))
{
$_SESSION['username'] = $_SESSION['uid'];
$user=$_SESSION['uid'];
include 'db.php';


//include 'css/chat.php'; ?>
<div  id="responsecontainer">
<?php
if(isset($_POST['a']))
{

$select_query=mysql_query("SELECT firstname,lastname,uid,email FROM users where uid in (SELECT friend FROM friends where main='$user' and approved='y') order by firstname");
$select_query1=mysql_query("SELECT uid,firstname,lastname,email FROM users where uid in (SELECT friend FROM friends where main='$user' and approved='y') order by firstname");
?>
<font size="-1">Online Buddies<?php $i=0;while($select_result1=mysql_fetch_array($select_query))
{$i=$i+1;} echo '('.$i.')'; ?></font><br />
<table cellspacing="1" width="235px">
<?php
if ($i==0){echo '<font size="-2">No Buddy is Online</font>';}
while($select_result=mysql_fetch_array($select_query1))
{
	$email=$select_result['email'];
$sql_pic=mysql_query("select uid,picture2 from users where email='$email'");
	$fetch_pic=mysql_fetch_array($sql_pic);	
 ?>
<tr><td><div class="lefty1"><img src="<?php echo $fetch_pic['picture2']; ?>" width="32" height="32" style="float:left;"/><div style="float:left; padding-left:10px; padding-top:7px;"><a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $select_result['uid']?>')"><?php echo $select_result['firstname'].'&nbsp;'.$select_result['lastname']; ?></a></div></div></td></tr>
<?php } ?>
</table>
<?php } else {echo 'Loading Chat<br><br><img src=bigloader.gif width="33" height="33">';}?>
</div>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<?php // include 'js/chat.php';
 }
else{
header('location:home.php');	
}
?>
