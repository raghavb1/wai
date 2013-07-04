<div class="sidebarmenu">
  <?php
  error_reporting(0);
if(isset($_SESSION))
{
	
}
if(!isset($_SESSION))
{
	session_start();
}
include 'db.php';
$uid=$_SESSION['uid'];
$left=mysql_query("select * from m_menu_master2 order by sno limit 0,3");
$lefty=mysql_query("select * from m_menu_master2 order by sno limit 2,2");
$lefty1=mysql_query("select * from m_menu_master2 order by sno limit 5,2");
$counter=mysql_query("select * from images where uid='$uid'");
$count=mysql_num_rows($counter);
$counter2=mysql_query("select * from videos where uid='$uid'");
$count2=mysql_num_rows($counter2);
//echo $count;
//echo '<hr color="#CCCCCC" size="0" >';
//echo '<hr color="#FFFFFF" size="0" >';
//echo '<br>';
echo '<a href="#!/profile.php?uid='.$uid.'&sk" style="text-decoration:none" class="lefty"><div><img src=logo/pic.jpg class=symbol>View/Edit Profile</div></a>';	
while($lefty_result=mysql_fetch_array($lefty))
{
echo '<a href="#!/'.$lefty_result[3].'.php?val=r&t=others" style="text-decoration:none" class="lefty"><div><img src=logo/'.$lefty_result[2].' class=symbol>'.$lefty_result[0].'</div></a>';	
}
//echo '<hr color="#FFFFFF" size="0">';
//echo '<br>';
while($lefty_result1=mysql_fetch_array($lefty1))
{
echo '<a href="#!/'.$lefty_result1[3].'.php?uid='.$_SESSION['uid'].'&v=0" style=" margin-right:18px;text-decoration:none" class="lefty"><div><img src=logo/'.$lefty_result1[2].'  class=symbol>'.$lefty_result1[0].'';
if($lefty_result1[3]=='album'){echo '('.$count.')';}if($lefty_result1[3]=='videos'){echo '('.$count2.')';}
echo'</div></a>';	
}
$select_query3=mysql_query("SELECT firstname,lastname,picture2,uid,city FROM users where uid in (SELECT friend FROM friends where main='$uid' and approved='y') order by uid");
$count=mysql_num_rows($select_query3)-1;

?><br />
<div class="notify" style="width:182px"><img src="logo/sbuddy.png" style="margin-left:7px"/>&nbsp;&nbsp;<a href="#!/relate.php?t=b&uid=<?php echo $_SESSION['uid']; ?>">Buddies</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (<?php echo $count; ?>)</div>
<?php
$i=0;
while($r=mysql_fetch_array($select_query3))
{
	$firstname[]=$r['firstname'];
	$lastname[]=$r['lastname'];
	$uid8[]=$r['uid'];
	$picture2[]=$r['picture2'];
	$city[]=$r['city'];
$i++;			
}
$characters1 = array();
for($y=0;$y<$i;$y++){
$characters1[]=$y;	
}
$keys1 = array();
while(count($keys1) < $i) {
    $x = mt_rand(0, count($characters1)-1);
    if(!in_array($x, $keys1)) {
       $keys1[] = $x;
    }
}
$m=0;
foreach($keys1 as $key){
$k=$characters1[$key];	if($uid8[$k]!=$uid && $m<10){
	echo '<div class="buddy_names"><a href="#!/profile.php?uid='.$uid8[$k].'">';
	
	if ($picture2[$k]!='')
	echo '<img src="'.$picture2[$k].'" id="profilep" width="52" height="52" style="float:left; margin-right:8px">';
	
	echo '</a>';
	
	echo '<a href="#!/profile.php?uid='.$uid8[$k].'" style="color:#009;">'.$firstname[$k].' '.$lastname[$k].'</a><br><font color="#666">'.$city[$k].'</font>';
	
	echo '</div>';
	$m++;	
}
}
?>
</div>
