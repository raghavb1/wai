 <?php
include("db.php");


if(isset($_POST['lastmsg']))
{
$lastmsg=$_POST['lastmsg'];
$result=mysql_query("select * from updates where msg_id<'$lastmsg' order by msg_id desc limit 9");
$count=mysql_num_rows($result);
while($row=mysql_fetch_array($result))
{
$msg_id=$row['msg_id'];
$message=$row['msg'];
?>
 

<li>
<?php echo $message; ?>
</li>


<?php
}


?>

<div id="more<?php echo $msg_id; ?>" class="morebox">
<a href="#" id="<?php echo $msg_id; ?>" class="more">more</a>
</div>

<?php
}
?>