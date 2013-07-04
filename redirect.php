<?php 
include 'db.php';
$tau=$_SERVER['REQUEST_URI'];
$tau=str_replace("/wai/wai/","",$tau);
$tau_q=mysql_query("select uid from users where email='$tau'");
$tau_r=mysql_fetch_array($tau_q);
$tau_num=mysql_num_rows($tau_q);
if($tau_num!=0){
include 'home.php';?>
<script>
$.ajax({
url: 'profile.php?uid=<?php echo $tau_r['uid'] ?>&sk',
success: function(html){
$('.content1').html(html)	
}});
</script>
<?php
}
else{
include 'index.php';	
}
?>

