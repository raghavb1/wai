<div class="album">
        <script type="text/javascript" src="js/jquery.watermarkinput.js"></script>
<?php
error_reporting(0);
session_start();

if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{
include 'db.php';

if(isset($_GET['uid']))
{
$uid=stripslashes($_GET['uid']);
$uid=htmlspecialchars($uid);
$uid=mysql_real_escape_string($uid);
}
elseif(isset($_POST['uid']))
{
$uid=stripslashes($_POST['uid']);
$uid=htmlspecialchars($uid);
$uid=mysql_real_escape_string($uid);
}
else
{
$uid=$_SESSION['uid'];	
}
$pageselect=mysql_query("select uid from users where uid='$uid'");
$pageshow=mysql_num_rows($pageselect);
//echo $pageshow;
if($pageshow==0)
{
echo '<script>window.location.href="home.php";</script>';	
}
 $pic_query=mysql_query("select picture,firstname,lastname,picture2 from users where uid='$uid'"); 
 
 $pic_result=mysql_fetch_array($pic_query);

include 'youtube.php';
$user=$_SESSION['uid'];
$sql_query=mysql_query("select * from friends where main='$user' and friend='$uid'");
$sql_fetch=mysql_fetch_array($sql_query);
	if($sql_fetch['approved']=='n' || $sql_fetch['approved']=='rec' || $sql_fetch['approved']==''){ ?>
<script>window.location.href="#!/profile.php?uid=<?php echo $uid ?>";</script>
<?php
}
else{
	?>
<script>

	 $("#album_name").Watermark("Create New Album");
	 $('.sidebarmenu').hide();
	 $('#changer').hide();
	 $('.content').css("width","775px");
 	 $('.content').css("margin-left","-195px");	 

	 </script>    
    <?php
if(isset($uid) && isset($_GET['v']))
{ 
if($_GET['v']=='0'){
	echo '<div class="topic"><a href=#!/profile.php?uid='.$uid.'>'.$pic_result['firstname'].' '.$pic_result['lastname'].'</a>&nbsp;&raquo;&raquo;&nbsp;<a href=#!/album.php?uid='.$uid.'&v=0>Albums</a></div>';
		if($uid==$_SESSION['uid'])
	{

?>
<?php
echo '<div class=share_menu style="margin-left:-1px; width:700px"><input type="text" id="album_name"><input type="submit" id="album_submit" value=Submit class="v"></div>';
echo '<div class="album_done" style="margin-bottom:5px;"></div>';
	}
$album_query=mysql_query("select * from albums where uid='$uid' order by sno desc");	
while($album_result=mysql_fetch_array($album_query))
{
	$aid=$album_result['aid'];
	$pic_query=mysql_query("select image_thumb,image_orig from images where uid='$uid' and aid='$aid' order by img_id desc");
	$pic_query2=mysql_query("select image_thumb,image_orig from images where uid='$uid' and aid='$aid' order by img_id desc limit 8");
	$pic_count=mysql_num_rows($pic_query);
	$pic_result=mysql_fetch_array($pic_query);
echo '
<div class="album_cover">

<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1"><div class="image_thumb1" style="background-image:url('.$pic_result['image_thumb'].');"></div></a>
<div style="float:left; text-align:center;width:168px"><a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1" style="font-size:12px;">'.$album_result['album'].' ('.$pic_count.')</a>
<br>'.//$album_result['date'].
'<br>';
	for($i=0;$i<5;$i++)
	{
  //  echo '<img src="smileys/star.gif" onClick="bgpos2('.($i).',this);" style=" cursor:pointer" />';
	}	
	
while($pic_result=mysql_fetch_array($pic_query2))
{
//echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$pic_result['image_orig'].'" onclick="scrolll(0,0)"><img src="'.$pic_result['image_thumb'].'" width="32" height=32 class="image_thumb"></a>';	
}
echo'</div>';
   $com_select=mysql_query("select * from comment where id='$aid' order by sno");
   $com_count=mysql_num_rows($com_select);

   $com_select2=mysql_query("select * from votes where id='$aid' order by sno");
   $com_count2=mysql_num_rows($com_select2);
   //   echo 'Comments:&nbsp;'.$com_count.'&nbsp;|&nbsp;Votes:<span id="votes'.$aid.'">&nbsp;'.$com_count2.'</span>&nbsp;|&nbsp';
$iprofile_comment=iprofile_comment($aid,$uid,$com_select,$com_count,'album');
//echo '<div style="margin-left:0px">'.$iprofile_comment.'</div>';
echo '</div>';
}
}
}
if(isset($_GET['aid']) && isset($uid) && isset($_GET['v']))
{
	if($_GET['v']=='1'){
$aid=$_GET['aid'];
$album_name=mysql_query("select * from albums where aid='$aid'");
$album_name_result=mysql_fetch_array($album_name);	
if(isset($_GET['p'])){ $no=$_GET['p']*36;}
else{$no=0;	}
echo '<div class="topic"><a href=#!/profile.php?uid='.$uid.'>'.$pic_result['firstname'].' '.$pic_result['lastname'].'</a>&nbsp;&raquo;&raquo;&nbsp;<a href=#!/album.php?uid='.$uid.'&v=0>Albums</a>&nbsp;&raquo;&raquo;&nbsp;<a  href=#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1>'.$album_name_result['album'].'</a></div>';
if($album_name_result['album']!='Profile Pictures' && $uid==$_SESSION['uid']){
	echo'<div style="margin-bottom:5px;margin-top:5px;float:left">';
		include 'fileupload/index.php';
		echo '</div><div style="margin-left:4px;float:left;margin-top:12px;">to add to the Album</div>';
}
		
echo '<div class="pictures">';
$query=mysql_query("select image_thumb,img_id,image_orig from images where uid='$uid' and aid='$aid' order by img_id desc limit $no,36");
$no=($no/36)+1;
while($query2=mysql_fetch_array($query))
{
echo '<a href=#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$query2['image_orig'].'><div class="image_thumb1" style="background-image:url('.$query2['image_thumb'].');"></div></a>';	
}
echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1&p='.$no.'" onclick="scroll(0,0)"><div style="float:left;width:100%">Next</div></a><br>';
echo '</div>';
}
	if($_GET['v']=='2'){
		
	}
}



if(isset($_GET['pid']) && isset($_GET['uid']) && isset($_GET['aid']))
{
$pid=$_GET['pid'];
$aid=$_GET['aid'];
$album_name=mysql_query("select * from albums where aid='$aid'");
$album_name_result=mysql_fetch_array($album_name);
$i=1;
$query_again=mysql_query("select image_orig,upid from images where uid='$uid' and aid='$aid' order by img_id desc");
while($query_result=mysql_fetch_array($query_again))
{
	$next[$i]=$query_result['image_orig'];
	$upid[$i]=$query_result['upid'];
		$i=$i+1;
}
$i=$i-1;
$k=1;
?>

<?php

  for($j=$k;$j<=$i;$j++)
  {	  
	  if($pid==$next[$j])
	  {
		     echo '<div class="topic"><a href=#!/profile.php?uid='.$uid.'>'.$pic_result['firstname'].' '.$pic_result['lastname'].'</a>&nbsp;&raquo;&raquo;&nbsp;<a href=#!/album.php?uid='.$uid.'&v=0>Albums</a>&nbsp;&raquo;&raquo;&nbsp;<a  href=#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1>'.$album_name_result['album'].'</a>&nbsp;&raquo;&raquo;&nbsp;<a href=#>'.$j.'/'.$i.'</a></div>';
			 echo '<center><div class="image">';
		  if($j==$i)
	  {
		  
		  if($j==1)
		  {
	  echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j].'">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;';
	  
	    echo '
  <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j].'">
  Next
  </a><br>
';

		  echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j].'"><img src="'.$next[$j].'"></a>';
		  ?>
  <script type="text/javascript">
document.onkeyup=
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
if(unicode==37){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$j]; ?>";
}
if(unicode==39){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$j]; ?>";
}
}
</script>
          <?php		
		  }
		  else
		  {
		  $k=1;
  echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j-1].'">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;';
  
    echo '
  <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$k].'">
  Next
  </a><br>';


		  echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$k].'"><img src="'.$next[$j].'"></a>';
		  		  ?>
  <script type="text/javascript">
document.onkeyup=
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
if(unicode==37){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$j-1]; ?>";
}
if(unicode==39){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$k]; ?>";
}
}
</script>        
          <?php	
		  }
	  }else
	  {
		  if($j==1)
		  {
			  $s=$i;
  echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$s].'">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;';
  
    echo '
  <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j+1].'">
  Next
  </a><br>
';


  echo '
  <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j+1].'">
  <img src="'.$next[$j].'">
  </a>
';
		  ?>
  <script type="text/javascript">
document.onkeyup=
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
if(unicode==37){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$s]; ?>";
}
if(unicode==39){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$j+1]; ?>";
}
}
</script>        
          <?php	
		  }
		  else{
  echo '<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j-1].'">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;';
  
    echo '
  <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j+1].'">
  Next<br>
  </a>
';


  echo '
  <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$next[$j+1].'">
  <img src="'.$next[$j].'">
  </a>
';
		  ?>
  <script type="text/javascript">
document.onkeyup=
function displayunicode(e){
var unicode=e.keyCode? e.keyCode : e.charCode
if(unicode==37){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$j-1]; ?>";
}
if(unicode==39){
window.location.href="#!/album.php?uid=<?php echo $uid; ?>&aid=<?php echo $aid; ?>&pid=<?php echo $next[$j+1]; ?>";
}
}
</script>          
          <?php	
		  }

  }
  echo '<br><br>';


echo ' </div></center>'; 
if($pid!='images/blank_face.jpg' && $pid!='images/def.jpg'){
   $com_select=mysql_query("select * from comment where id='$upid[$j]' order by sno");
   $com_count=mysql_num_rows($com_select);

   $com_select2=mysql_query("select * from votes where id='$upid[$j]' order by sno");
   $com_count2=mysql_num_rows($com_select2);
      echo '<div style="margin-left:5px">Comments:&nbsp;'.$com_count.'&nbsp;|&nbsp;Votes:<span id="votes'.$upid[$j].'">&nbsp;'.$com_count2.'</span>&nbsp;|&nbsp</div>';
$iprofile_comment=iprofile_comment($upid[$j],$uid,$com_select,$com_count,'photo');
echo $iprofile_comment;
}
  }
  }
}

}}
  else 
{
echo '<script>window.location.href="home.php#!/'.$_SERVER['REQUEST_URI'].'"</script>';
}
?>