<?php 
error_reporting(0);
header('Cache-Control: no-cache');
 header('Pragma: no-cache');
session_start();
if (isset($_SESSION['email']) && !(isset($a)))
{
	$uid=$_SESSION['uid'];
	include 'db.php';
	 $parent1=mysql_query(" SELECT * FROM m_menu_master2");
	 	 $parent2=mysql_query(" SELECT * FROM m_menu_master2 order by sno limit 8,4");
		 	 	 $parent3=mysql_query(" SELECT * FROM m_menu_master2 limit 11,3");
		 	 	 $sugg_q=mysql_query("select * from users where uid not in (SELECT friend FROM friends where main='$uid') order by uid");				 
				 define( 'parentFile' , 1 );
				 $alert2=mysql_query("select * from notifications where rec_uid='$uid' and approved='n' order by sno desc");
				 $num=mysql_num_rows($alert2);
				 

	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK REL="shortcut icon" HREF="logo/favicon.gif">
<?php
include 'scripts.php';
//include 'style.php';
//echo $_SESSION['browser'];?>
<script type="text/javascript" src="js/chat.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<meta name="fragment" content="!">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iProfile</title>
</head>
<body onunload="chatoffline('<?php echo $_SESSION['uid'] ?>')" onload="chatonline('<?php echo $_SESSION['uid'] ?>')">
 <div class="header">
  <div class="header2">
   <div style="padding-left:2px; padding-right:6px; margin-top:4px; float:left;"> <a href="/wai/wai/" style=" text-decoration:none"><div class="logo">iProfile</div></a>
    </div>
   <div class="home">
<a href="#!/main.php"><img src="logo/home.png" width="28" height="28" style="padding:3px;" title="Home"/></a>
</div>
    <div class="home">
<a href="#!/relate.php?t=b">
<img src="logo/buddyi.png" width="28" height="28" style="padding:3px" title="Manage Buddies" /></a>
</div>
     <div style="float:left; padding-left:0px">   <?php  include 'auto.php'; ?></div>

 <div class="home">
<a class="ialerts_click"><img src="logo/web.png" width="26" height="26" style="padding:4px;" title="iAlerts"/><div style="font-size:18px; float: right; font-weight: bold; margin-top:5px; margin-right:3px; color:#000" class="alert_num"><?php
if($num==0){
	
}
else{
echo '+'.$num;	
}
 ?></div></a>
</div>
    <div class="home">
<a class="ibuddy_click"><img src="logo/relate.png" width="28" height="28" style="padding:3px" title="Buddy Requests" /></a>
</div>     


    <div style="float:right; padding-top:14px; color:#FFF; font-size:14px"><a href="logout.php" style="color:#FFF">Logout&nbsp;</a></div>
  </div></div>
<div class="container">
 
  <div class="container1">
    <div class="sidebar1">
        <div class="header1">
                                <a class="change_pic2" href="#!/pic" onMouseOver="change_pic2('show')">Change Picture</a>
          <div id="changer" style="float:left">
 
          </div>
        </div>
        <!--        
		<div class="header2">
		<table height="100%" width="100%">
        <?php 
		//while ($menu_left=mysql_fetch_array($parent2))
		{
		//echo '<tr><td  class="optiont"><a href="#!/'.rand(100,999).'/'.$menu_left[3].'">'.$menu_left[0].'</a></td></tr>';			
		}
		?>
        
		</table>
		</div>-->
      <div id="cstatus"></div>
<?php
include 'left.php';
?>

<div>

</div>
    </div>
    <div class="content">
      <div class="content1">  
        <?php
//  include'main.php'; ?>
</div>       
    </div>
    <div class="sidebar2">
    <div class="right_toggle2" style="float:left"><div class="notify" style="margin-top:5px">Buddy Requests:</div>
<div class="notify_under">
<?php
$uid2=$_SESSION['uid']; 
$sql_query=mysql_query("select * from friends where friend='$uid2' and approved='n' ");
$sql_num=mysql_num_rows($sql_query);
if($sql_num==0)
{
echo 'No Buddy Requests';	
}
while($sql_fetch=mysql_fetch_array($sql_query))
{
	$request=$sql_fetch['main'];
$frequest=mysql_query("select firstname,lastname,picture2 from users where uid='$request'");
$frequest_fetch=mysql_fetch_array($frequest);
echo '<div style="height:48px;background-color:#FFC;width:257px;float:left" class="accepted'.$request.'"><div style="float:left"><a href="#!/profile.php?uid='.$request.'" onclick="scroll(0,0)" style=color:#00C;><img src='.$frequest_fetch['picture2'].' id="profilep" width=42 height=42></a></div>';
echo '<div style="float:left; margin-left:5px"><a href="#!/profile.php?uid='.$request.'" onclick="scroll(0,0)" style=color:#00C;>'.$frequest_fetch['firstname'].'&nbsp;'.$frequest_fetch['lastname'].' </a><br>
<a class="frequest" id="accept" name="'.$request.'">Accept</a>&nbsp;|&nbsp;<a class="frequest" id="decline" name="'.$request.'">Decline</a>
</div></div>';	
}

$sql_query2=mysql_query("select * from testimonials where msg_to='$uid2' and approved='n' ");
while($sql_fetch2=mysql_fetch_array($sql_query2))
{
	$t=$sql_fetch2['msg_from'];
$trequest=mysql_query("select firstname,lastname from users where uid='$t'");
$trequest_fetch=mysql_fetch_array($trequest);
echo '<br>Testimonial from '.$trequest_fetch['firstname'].'&nbsp;'.$trequest_fetch['lastname'].'<br><a class="trequest" id="trequest'.$t.'" name="'.$t.'">Accept</a><br>';	
}
?>
</div></div>
      <div class="chatrefresh" style="margin-bottom:30px; float:left"><?php include 'ctest.php'; ?></div>
<div class="right_toggle" style="float:left"><div class="alert_box" style="float:left">
<?php 
include 'alerts.php';
?>
</div></div>


<div class="invited2" style="float:left">
<?php
include 'invited/index.php'; ?>
</div> 
    </div>
  </div>
        <div id="footer">

			<img src="logo/footer.png" /><a href="#" class="current">Home</a> | <a href="#">Find Friends</a> | <a href="#">Developers</a> | <a href="#">Privacy</a> | <a href="#">Suggestions</a> | <a href="#">Terms</a> | <a href="#">Career</a><br /><br />
    
        	© <a href="#">iProfile</a>
            
	    </div>
</div>
    
</body>
</html>
<?php 
}
else
{
echo '<script>window.location.href="index.php"</script>	';
}
?>
