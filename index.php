<?php 
error_reporting(0);
header('Cache-Control: no-cache');
 header('Pragma: no-cache');
session_start();
include 'db.php';
$tau=$_SERVER['REQUEST_URI'];
$tau=str_replace("/","",$tau);
$tau_q=mysql_query("select uid from users where uid='$tau'");
$tau_r=mysql_fetch_array($tau_q);
$tau_num=mysql_num_rows($tau_q);
if($tau_num!=0){
include 'home.php';?>
<script>
$('.content1').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>');
$.ajax({
url: 'profile.php?uid=<?php echo $tau_r['uid'] ?>',
success: function(html){
$('.content1').html(html)	
}});
</script>
<?php
}else{
if(isset($_SESSION['uid'])){
	include 'home.php';
	?>
<script>
var r=window.location.hash;
if(r==''){
	$('.content1').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>');
$.ajax({
url: 'main.php',
success: function(html){
$('.content1').html(html);
cache[0]=html;
page[0]='main.php';
i++;	
}});
}

</script>
<?php
}
elseif(isset($_COOKIE['uid'])){
}
else{
include 'ini.php';	
}
}


