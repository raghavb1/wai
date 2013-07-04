
<?php
include("db.php");
if($_POST['msg_id'])
{
$id=$_POST['msg_id'];
$id = mysql_escape_string($id);
$sql = "delete from comment where sno='$id'";
mysql_query( $sql);
}
?>