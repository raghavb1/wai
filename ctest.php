<?php
error_reporting(0);
if(isset($_SESSION))
{
	
}
if(!isset($_SESSION))
{
	session_start();
}
if(isset($_SESSION['uid']))
{

include 'db.php';
$_SESSION['username'] = $_SESSION['uid'];?>

<?php
$user=$_SESSION['uid'];
$uid=$_SESSION['uid'];
?>
<?php
$select_query1=mysql_query("SELECT firstname,lastname,uid,email,picture2 FROM users where online='y' and uid in (SELECT friend FROM friends where main='$user' and approved='y') order by firstname");
$select_rows=mysql_num_rows($select_query1);
?>
<div class="notify" style="padding:3px">Online Chat Buddies</div>
<?php
if ($select_rows==1){echo '';}
while($select_result=mysql_fetch_array($select_query1))
{
$small_pic=$select_result['picture2'];
$name=$select_result['firstname'].' '.$select_result['lastname'];	
if($select_result['uid']!=$_SESSION['uid'])
{
?>
<a href="javascript:void(0)" onClick="javascript:chatWith('<?php echo $select_result['uid'] ?>','<?php echo $select_result['firstname'].'&nbsp;'.$select_result['lastname']; ?>')" id="ctest" title="<?php echo $select_result['firstname'].'&nbsp;'.$select_result['lastname']; ?>">
<img src="<?php echo $small_pic; ?>" width="32" height="32" style="float:left; margin-right:6px; margin-left:0px; margin-bottom:3px; margin-top:3px" id="profilep" alt="<?php echo $name; ?>"/>
</a>
<?php
}
}

}
else
{
?>
<script>
window.location.href="index.php";
</script>

<?php	
}
?>
