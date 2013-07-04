
<?php
include("db.php");
if($_POST['msg_id'])
{
$id=$_POST['msg_id'];
$id = mysql_escape_string($id);
$sql = "delete from updates where msg_id='$id'";
mysql_query( $sql);
}
?>