<script type="text/javascript">
$(document).ready(function()
{
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
var ID2=$(this).attr('title');
$("#first_"+ID).hide();
$("#last_"+ID).hide();
$("#first_input_"+ID).show();
$("#last_input_"+ID).show();
$("#last_input_"+ID).focus();
}).change(function()
{
var ID=$(this).attr('id');
var ID2=$(this).attr('title');
var first=$("#first_input_"+ID).val();
var last=$("#last_input_"+ID).val();
var dataString = 'profiler_id='+ ID +'&profiler_content='+last+'&sql_id='+ID2;



	$("#first_"+ID).html(first);
$("#last_"+ID).html(last);
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html)
{


}
});


});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script><?php
error_reporting(0);
session_start();
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{ 
include 'db.php';
	include 'changer.php'; ?>
    <script type='text/javascript'>
$(function() {
  $('.change_pic').click(function() {
Boxy.load('pic.php',{title:"Change iPic"});
  });
});
</script>
<div class="topic" style="font-size:14px;margin-left:5px"><?php echo $pic_result['firstname'].' '.$pic_result['lastname']; ?></div>
<?php
$user=$_SESSION['uid'];
$sql_query=mysql_query("select * from friends where main='$user' and friend='$uid'");
$sql_query2=mysql_query("select * from friends where main='$uid' and friend='$user'");
$sql_result=mysql_fetch_array($sql_query2);
$sql_fetch=mysql_num_rows($sql_query);

if($uid==$_SESSION['uid'])
{
?>
<?php
}

	include 'youtube.php';
$user=$_SESSION['uid'];
if(isset($_POST['c']))
{
	$no=$_POST['c'];
$count=24*$no;	
}
else{
$count=24;
$no=1;	
}
$sql_in= mysql_query("SELECT * FROM updates where uid='$uid' and reader='y' order by msg_id desc");
$sql_num=mysql_num_rows($sql_in);
$no=$no+1;
if($sql_fetch!=0 && !isset($_GET['sk']))
{
//echo'<div style="color:#999; margin-top:9px;margin-bottom:8px; text-align:center; font-size:13px"><a id="latest_updates" style="font-weight:bold">New Updates </a>| <a>Real-Time Updates</a><span style="color:#999; font-size:9px">(Coming Soon)</span>| <a>i-Likes</a><span style="color:#999; font-size:9px">(Coming Soon)</span></div>';
}
if(isset($_GET['sk']) && $uid==$_SESSION['uid'])
{
echo '<div style=" text-align:center; font-size:14px;width:510px" class="final_loader"><a class="change_pic">Change iPic</a></div>';
}

if($sql_fetch==0 && !isset($_GET['sk'])){ ?>
<div class=req style="float:left; font-size:12px; background-image:url(themes/52.jpg); width:486px; padding:10px; font-weight:bold; text-align:center; border-top:2px dashed #CCC">
<a id="<?php echo $uid; ?>" class="request">Send Buddy Request</a>
</div>
<?php
}
elseif($sql_result['approved']=='rec'&& !isset($_GET['sk'])){
echo '<br><div class=req style="float:left; font-size:12px; background-image:url(themes/52.jpg); width:486px; padding:10px; font-weight:bold; text-align:center; border-top:2px dashed #CCC"">Your buddy request has been sent. Wait for response.</div>';	
}
elseif(!isset($_GET['sk']))
{
	if($sql_result['approved']=='n'){
echo '<script>window.location.href="#!/profile.php?uid='.$uid.'&sk"</script>';
		
	}else{
		?>
        <div class="share_menu" style="margin-left:3px">
 <?php
$i=11;
$top_q=mysql_query("select * from m_menu_master2 order by sno limit 23,4");
while($top_r=mysql_fetch_array($top_q))
{
echo '<div class="share_menu_options"><img src="logo/'.$top_r['link'].'" width=18 height=18 style="margin-left:4px"></div><a id="'.$i.'" class="todo" style=" float:left; margin-right:3px">'.$top_r['MENU_NAME'].'</a><div style="float:left; margin-top:2px;margin-right:2px">&nbsp;&nbsp;| </div>';
$i=$i+1;
}
?>
<!--<div class="share_menu_options"><img src="logo/map.png" width="18" height="18"  style="margin-left:6px" /></div><a class="todo" style=" float:left; margin-right:2px" id="place_coord">Places</a>--><br />
<div class="update_box">
</div>
</div>
<div class="help_loader"></div>
 <div class="old_updates">
        <?php
$iprofile_main=iprofile_main($sql_in,'profile');
echo $iprofile_main;
echo '</div>';
if($sql_num>23)
{
//echo '<a><div id="older" name="'.$no.'">Show Older Posts</div></a>';
}
	}
}
if(isset($_GET['sk']) || $sql_result['approved']=='rec' || $sql_result['approved']==''){
	
$names[0]='<img src="logo/info.png" width="20" height="20" style="margin-right:10px; float:left"><div style="float:left; margin-top:2px">Basic Information</div>';
$names[1]='<img src="logo/education.png" width="20" height="20" style="margin-right:10px; float:left""><div style="float:left; margin-top:2px">Education And Work</div>';
$names[5]='<img src="logo/contact.png" width="20" height="20" style="margin-right:10px; float:left""><div style="float:left; margin-top:2px">Contact Information</div>';
$names[2]='<img src="logo/philosophy.png" width="20" height="20" style="margin-right:10px; float:left""><div style="float:left; margin-top:2px">Philosophy</div>';
$names[3]='<img src="logo/entertainment.png" width="20" height="20" style="margin-right:10px; float:left""><div style="float:left; margin-top:2px">Entertainment</div>';
$names[4]='<img src="logo/activities.png" width="20" height="20" style="margin-right:10px; float:left""><div style="float:left; margin-top:2px">Activities And Interests</div>';

$a[0][0]='Current City';$a[0][1]='Hometown';		 $a[0][2]='Gender';						$a[0][9]='Birthday';		$a[0][4]='About Me';
$a[1][0]='Employer';	$a[1][1]='University';		 $a[1][2]='High School';
$a[2][0]='Religion';	$a[2][1]='Political Beliefs';$a[2][2]='Favourite Quotations';
$a[3][0]='Favourite Music';		$a[3][1]='Books I Like';			 $a[3][2]='Movies I Like';						$a[3][3]='TV Shows';		$a[3][4]='Games I Play';
$a[4][0]='Activities';	$a[4][1]='Interests';
$a[5][0]='Email';		$a[5][1]='Phone';			 $a[5][2]='Address';					$a[5][3]='Website';	

$sql=mysql_query("select * from users where uid='$uid'");

$row=mysql_fetch_array($sql);
{
$b[0][0]=$row['city'];		$b[0][1]=$row['hometown'];	 $b[0][2]=$row['gender'];			$b[0][9]=$row['birthday'];		$b[0][4]=$row['aboutme'];
$b[1][0]=$row['employer'];	$b[1][1]=$row['university']; $b[1][2]=$row['highschool'];
$b[2][0]=$row['religion'];	$b[2][1]=$row['politics'];   $b[2][2]=$row['quotes'];
$b[3][0]=$row['music'];		$b[3][1]=$row['books'];		 $b[3][2]=$row['movies'];			$b[3][3]=$row['tvshows'];		$b[3][4]=$row['games'];
$b[4][0]=$row['activities'];$b[4][1]=$row['interests'];
$b[5][0]=$row['email'];		$b[5][1]=$row['phone'];		 $b[5][2]=$row['address'];			$b[5][3]=$row['website'];					
}

$c[0][0]='city';		$c[0][1]='hometown';		 $c[0][2]='gender';						$c[0][9]='birthday';		$c[0][4]='aboutme';
$c[1][0]='employer';	$c[1][1]='university';		 $c[1][2]='highschool';
$c[2][0]='religion';	$c[2][1]='politics';			$c[2][2]='quotes';
$c[3][0]='music';		$c[3][1]='books';			 $c[3][2]='movies';						$c[3][3]='tvshows';		$c[3][4]='games';
$c[4][0]='activities';	$c[4][1]='interests';
$c[5][0]='emails';		$c[5][1]='phone';			 $c[5][2]='address';					$c[5][3]='website';			


?>
<div class="profiler" style="float:left">

<table width="100%">
<?php
for ($i=0;$i<6;$i++){
 ?>
<tr class="head">
<th colspan="2"><?php echo $names[$i] ?></th>
</tr>
<?php
for ($j=0;$j<6;$j++){
	if($a[$i][$j]!=''){ if($uid==$_SESSION['uid']){?>
<tr id="<?php echo $i.$j ?>" <?php if($uid==$_SESSION['uid'] && $c[$i][$j]!='emails') { echo 'class="edit_tr"'; }?> title="<?php echo $c[$i][$j] ?>">
<td width="30%"><?php echo ($a[$i][$j]).'<div style="float:right">:</div>'; ?></td>
<td width="70%" class="edit_td"><span id="last_<?php echo $i.$j ?>" class="text"><?php if ($b[$i][$j]=='' && $uid==$_SESSION['uid']){echo '<font color="#999999">Click to update '.$a[$i][$j].'</font>';}else{echo '<a>'.stripslashes($b[$i][$j]).'</a>';} ?></span> <input type="text" value="<?php echo stripslashes($b[$i][$j]); ?>"  class="editbox" id="last_input_<?php echo $i.$j ?>"/></td>
<?php }elseif($uid!=$_SESSION['uid'] && $b[$i][$j]!=''){
	?>
    <tr id="<?php echo $i.$j ?>" <?php if($uid==$_SESSION['uid']){ echo 'class="edit_tr"'; }?>>
<td width="30%"><?php echo ($a[$i][$j]).'<div style="float:right">:</div>'; ?></td>
<td width="70%" class="edit_td"><span id="last_<?php echo $i.$j ?>" class="text"><?php if ($b[$i][$j]=='' && $uid==$_SESSION['uid']){echo '<font color="#999999">Click to update '.$a[$i][$j].'</font>';}else{echo '<a>'.stripslashes($b[$i][$j]).'</a>';} ?></span> <input type="text" value="<?php echo stripslashes($b[$i][$j]); ?>"  class="editbox" id="last_input_<?php echo $i.$j ?>"/></td>
    <?php
	} } }?>
</tr>
<?php }
?>
</table>
</div>
<?php

}
}
  else 
{
echo '<script>window.location.href="home.php#!/'.$_SERVER['REQUEST_URI'].'"</script>';
}

?>



