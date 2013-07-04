<?php 
session_start();
include 'db.php';
if (isset($_SESSION['email']))
{
	$email=$_SESSION['email'];
	$logy=mysql_query("update users set online='n' where email='$email'");
	session_destroy();
?>
<script>
window.location.href="/wai/wai/";
</script>
<?php
}
else
{
?>
<script>
window.location.href="/wai/wai/";
</script>
<?php
}