<?php
include 'db.php';
session_start();
 $uid=$_SESSION['uid'];

if($_POST['id'])
{
$id=$_POST['id'];

$ip_sql=mysql_query("select uid from votes where id='$id' and uid='$uid'");
$count=mysql_num_rows($ip_sql);

if($count==0)
{
$sql = "update updates set votes=votes+1 where msg_id='$id'";
mysql_query( $sql);
$sql_in = "insert into votes (uid,id) values ('$uid','$id')";
mysql_query( $sql_in);

$result=mysql_query("select votes from updates where msg_id='$id'");
$row=mysql_fetch_array($result);
$love=$row['votes'];
?>
<span class="on_img" align="left"><?php echo $love; ?></span>
<?php
}
else
{
	$result=mysql_query("select votes from updates where msg_id='$id'");
$row=mysql_fetch_array($result);
$love=$row['votes'];

echo '<span class="on_img" align="left">'.$love.'</span>&nbsp;<font color="#666" size=1>You have already voted</font>';
}



}

?>