<script>
	 $("#video").Watermark("Only Valid Youtube Links will be Accepted:");
	 	 $('.sidebarmenu').hide();
	 $('#changer').hide();
	 $('.content').css("width","772px");
 	 $('.content').css("margin-left","-196px");
</script> <?php

include 'db.php';
include 'youtube.php';
//include 'youtube.php';
//session_start();
if(isset($_SESSION))
{
	
}
else{
session_start();	
}
if(isset($_GET['uid']))
{
$uid=$_GET['uid'];
}
elseif(isset($_POST['uid']))
{
$uid=$_POST['uid'];
}
else
{
$uid=$_SESSION['uid'];	
}


if(isset($_GET['v']))
{
	$count=$_GET['v']*8;
	//echo $count;	
}
else{
$count=0;
$_GET['v']=0;
	
} 



$video=mysql_query("select name from videos where uid='$uid'");
$video_fetch=mysql_num_rows($video);
//echo $video_fetch;
$video_fetch=intval($video_fetch/8)+1;
//echo $video_fetch;
$video_s=mysql_query("select * from videos where uid='$uid' order by sno desc limit $count,8");
?>
 <div class="allvideo">
 <?php 
 if($uid==$_SESSION['uid'])
 {
	 ?>
	<div class="share_menu" style="width:97%"><input type="text" id="video"/>
        <input type="submit" class="vid_submit" id="v1" value="Attach"/></div>
        <?php } ?>

   <?php
echo '<div class="video_load"></div>';
echo '<div style="float:left">Page No.</div>';


for ($i=1;$i<=$video_fetch;$i++)
{if($i==$_GET['v']+1)
{
echo '<a href="#!/videos.php?uid='.$uid.'&v='.($i-1).'" style="color:#999">&nbsp;'.$i.'&nbsp;|</a>';
}else
{
echo '<a href="#!/videos.php?uid='.$uid.'&v='.($i-1).'"">&nbsp;'.$i.'&nbsp;|</a>';
}
}


echo '<div class="video_loader"><img src=bigloader.gif width=20 height=20></div>';
if ($video_fetch==0){
echo '<div class="album_cover">No video attached with this account</div>';	
}
while($video_a=mysql_fetch_array($video_s))
{
  echo'<div class="video_first">
  <div class="videos" id="videos'.$video_a['upid'].'">	
  <div class="delete_button">

</div>
 <div class="video_border"><iframe class="youtube-player" type="text/html" width="678" height="420" src="http://www.youtube.com/embed/'.$video_a['name'].'" frameborder="0">
</iframe></div>';
//echo ' <div class="video_info">';
// $videoInfo = parseVideoEntry($video_a[0]);
echo '<div style="float:left;width:100%;font-weight:bold"><a href="'.$video_a['url'].'" target=_blank>'.$video_a['title'].'</a></div>';
//echo '<img src="'.$videoInfo->thumbnailURL.'">';
//echo '<br>';echo '<br>';
//echo '</a><br>';echo '<br>';
//echo 'Description:'.$videoInfo->description;
//echo '<br>';echo '<br>';
//echo  'Number of Views:'.$video_a['views'];
//echo '<br>';echo '<br>';
//echo   'Video Length:'.$video_a['length'].' seconds';
//echo '<br>';echo '<br>';
//echo   'Rating: '.$video_a['rating'];
//echo'</div>';
echo '</div>';
$upid=$video_a['upid'];
   $com_select=mysql_query("select * from comment where id='$upid' order by sno");
   $com_count=mysql_num_rows($com_select);

   $com_select2=mysql_query("select * from votes where id='$upid' order by sno");
   $com_count2=mysql_num_rows($com_select2);
      echo '<div style="float:left;width:100%;margin-top:10px">Comments:&nbsp;'.$com_count.'&nbsp;|&nbsp;Votes:<span id="votes'.$upid.'">&nbsp;'.$com_count2.'</span>&nbsp;|&nbsp</div>';
$iprofile_video_comment=iprofile_comment($upid,$uid,$com_select,$com_count,'video');
echo ''.$iprofile_video_comment.'</div>';
}
?>