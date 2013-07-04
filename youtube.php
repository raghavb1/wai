<?php 
error_reporting(0);
function cleaner($value){
$value=htmlspecialchars($value);
$value=addslashes($value);
$value=str_replace("\n\n","",$value);
$value=str_replace("\n","<br />",$value);
return $value;

}
function curly($url){
	$user_agent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HEADER, 1); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_FILETIME, true);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent); 
$data = curl_exec($ch);	
curl_close($ch);
return $data;
}
 //   header('Content-type:html');
 //   header('Content-type:image/jpg');
 // function to encode the image
 // returns the image as base64 encoded string
function iprofile_main($sql_in,$type,$d){
$a=0;$b=0+1;$uid2='';
if($d==''){$d=1;}else{$d=$d;}$sql5=$sql_in;
	$final=''; 	$z=1;
	$tt=mysql_num_rows($sql_in);
	$sql_num=mysql_num_rows($sql_in);
 while($r=mysql_fetch_array($sql_in))
{

	$final.='<input type="hidden" id="'.$r['upid'].'" class="more_updater" name="'.$type.'">';
	$uid=$r['uid'];
	$sql_pic=mysql_query("select picture2 from users where uid='$uid'");
	$fetch_pic=mysql_fetch_array($sql_pic);
	$id=$r['upid'];
	$describe=$r['describer'];
$com_select0=mysql_query("select * from comment where id='$id' order by sno");
$com_count=mysql_num_rows($com_select0);
$vote_select0=mysql_query("select * from votes where id='$id' order by sno");
$vote_count=mysql_num_rows($vote_select0);
$counting=$com_count-2;

if($counting>0)
{
$com_select=mysql_query("select * from comment where id='$id' order by sno limit $counting,2");
}
else
{
$com_select=$com_select0;
}
	if($r['uid']==$uid2 && $type=='main'){
	$a=$a+1;
	$final.= '<div id="more_updates" class="'.$uid2.$a.$d.'"><li  class="bar'.$r['upid'].'">';	
	}
	else{
		$picy=small_pic($uid2);
$a=0;$b=0;
		if($c!=0)
{$final.='<div class="more_updates_click" id="'.$uid2.'" " name="'.$c.'" value="'.$d.'"><a style=font-size:15px>'.($c).' more Update(s) from '.$picy->name.'</a></div>';}
$d=$d+1;
$final.= '<span class="bar'.$r['upid'].'">';
	}
if ($_SESSION['uid']==$r['uid'])
{
$final.= '<div class="delete_button">
<a id="'.$r['upid'].'" class="delete_update" style="margin-left:10px;">&Delta;</a></div>';
}

$final.= '
<div id="update_from">
<a href="#!/profile.php?uid='.$uid.'" onclick="scroll(0,0)" style=color:#009;>
<img src='.$fetch_pic['picture2'].' width="52" height="52"  style="float:left;" id=profilep></a>
<div style="padding-top:0px; font-size:11px; padding-left:66px;">
<a href="#!/profile.php?uid='.$uid.'" onclick="scroll(0,0)" style="color:#009;font-weight:bold;font-size:12px">'.$r['msg_from'].'</a> <font  color="#333">'.$r['category'].'</font>
<br>
</div>

<div style="color:#666;font-size:10px;padding-left:65px">';
//echo 'Comments:&nbsp;'.$com_count.'&nbsp;|&nbsp;Votes:<span id="votes'.$r['upid'].'">&nbsp;'.$vote_count.'</span>&nbsp;|&nbsp;'.$r['time'].'<br>';
$rating_q=mysql_query("select * from rating where upid='$id'");
$rating_count=mysql_num_rows($rating_q);
$rating=0;
while($rating_r=mysql_fetch_array($rating_q)){
	$rating=$rating+$rating_r['ratings'];
}
if($rating_count!=0)
$rating=$rating/$rating_count;
//$final.='<div style="float:left;margin-bottom:4px">Rating:</div>';;
	for($i=0;$i<$rating;$i++)
	{
   // $final.= '<img src="smileys/star_blue.gif" onClick="bgpos2('.($i).',this);" style=" cursor:pointer" id="'.$r['upid'].'" name="'.$r['uid'].'"/>';
	}
	for($i=$rating+1;$i<=5;$i++)
	{
   // $final.= '<img src="smileys/star.gif" onClick="bgpos2('.($i).',this);" style=" cursor:pointer" id="'.$r['upid'].'" name="'.$r['uid'].'"/>';
	}

$final.= '</div></div><div id="update">'.stripslashes(smiley($r['msg'])).'</div><div class="margin_box">';
	$final.='<div style="color:#666; font-size:10px; margin-top:8px;margin-left:5px; float:left;">'.$r['time'].'</div>';
if($com_count>2)
{
$final.= '<div align="center" style="width:398px; background-color:#F2F2F2; padding:3px; float:left;margin-left:5px"><a class="view_all" id="'.$r['upid'].'">View All  ('.$com_count.')</a></div>';	
}
$final.=iprofile_comment($r['upid'],$r['uid'],$com_select,$com_count,$describe);
$final.='</div>';
$final.='</span>';
$c=$a;
	if($r['uid']==$uid2 && $type=='main'){
	$final.= '</div>';
	}
		$picy=small_pic($uid);
	if($r['uid']==$uid && $z==$tt && $c!=0 && $type=='main'){
{$final.='<div class="more_updates_click" id="'.$uid2.'" " name="'.$c.'" value="'.$d.'"><a style=font-size:15px>'.($c).' more Update(s) from '.$picy->name.'</a></div>';}
	}
	$uid2=$r['uid'];
$z++;
}

return $final;
}

function iprofile_comment($upid,$uuid,$com_select,$com_count,$describe){
$final='
<div id="all_comment'.$upid.'" style="margin-left:5px"><div id="main_comment_box'.$upid.'" style=" float:left; width:100%; margin-top:2px;">';

while($com_show=mysql_fetch_array($com_select))
{
	$sender=$com_show['sender'];
$sql_pic=mysql_query("select picture2 from users where uid='$sender'");
$fetch_pic=mysql_fetch_array($sql_pic);
	$final.= '<div class="load_comment" id="comment_load'.$com_show['cid'].'">
<div align="left">';
//echo $com_show['sender'];
//echo $r['uid'];

if ($com_show['sender']==$_SESSION['uid'] || $uuid==$_SESSION['uid'])
{
$final.= '	<div class="delete_button">
<a id="'.$com_show['cid'].'" class="delete_comment" name="'.$uuid.'">&Omega;</a>
</div>';
}

$final.='</div><a href="#!/profile.php?uid='.$com_show['sender'].'" onclick="scroll(0,0)" style=color:#00C;>
<img src="'.$fetch_pic['picture2'].'" width=32px height=32px id=profilep style="float:left">
</a>'.($com_show['comment']);
}
$final.= '</div>';
$final.='<div class=panel id="slidepanel'.$upid.'">
<textarea class="comment_input" id="textboxcontent'.$upid.'" name="'.$upid.'" ></textarea>
<div style="font-size:9px;float:left;width:100%">Press \'\\\' to break a line&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Press enter to comment</div>
<input type="hidden" class="comment_hidden'.$upid.'" id="'.$uuid.'" />
<input type="hidden" class="comment_category'.$upid.'" id="'.$describe.'" />

</div>
<div id=comment><img src="logo/comment.png" width="10px" height="12px" style="float:left; margin-top:2px">&nbsp;<a id="'.$upid.'"  class="comment_buttonef">iComment</a>
&nbsp;| &nbsp;
<img src="logo/vote.png" width="10px"><a href="#" class="love" id="'.$upid.'" name="'.$uuid.'">
 Vote </a>';
if($uuid!=$_SESSION['uid']){
//$final.= '&nbsp;| &nbsp;<img src="logo/sbuddy.png" width="12px"><a class="lover" id="'.$upid.'" name="'.$uuid.'" title="'.$describe.'">Share</a>';
}
$final.='</div></div>';
return $final;
}



function iprofile_chat($chat_rec){
$chat_sender=$_SESSION['uid'];
$uid=$_SESSION['uid'];
$s=small_pic($chat_rec);
$chat_s=mysql_query("select * from friends where friend='$chat_rec' and main='$uid'");
$chat_r=mysql_fetch_array($chat_s);
$chat_online2=mysql_query("select firstname,lastname from users where uid='$chat_rec'");
$chat_online_r2=mysql_fetch_array($chat_online2);
$chat_online3=mysql_query("select * from chat where (sender='$chat_sender' or sender='$chat_rec') and (rec='$chat_sender' or rec='$chat_rec')  order by id");
//echo '<div style="float:right">'.$chat_r['chatting'].'</div>';
if($chat_r['chatting']!='y')
{
$sql2=mysql_query("UPDATE friends SET chatting='y'  WHERE friend='$chat_rec' and main='$uid'");
$sql3=mysql_query("UPDATE friends SET chatting='y'  WHERE friend='$uid' and main='$chat_rec'");
echo '<div id="chat_box2" class="chat_box'.$chat_rec.'">
<div id="chat_name" class="'.$chat_rec.'" name="y"><font color="#666">'.$chat_online_r2['firstname'].' '.$chat_online_r2['lastname'].'</font>
<a class=chat_close id='.$chat_rec.'>x</a>
</div>
<div class="chat_hide'.$chat_rec.'" style="float:left">
<div class="chat_body" id="chat_body'.$chat_rec.'"></div>
<div style="border:1px solid #CCC">
<textarea style="width:232px" class="sendie'.$chat_rec.'" id="sendie'.$chat_rec.'"></textarea></div>
</div>
</div>';
?>
<script>
 $('.sendie<?php echo $chat_rec; ?>').keyup(function(e) {	
 var unicode=e.keyCode? e.keyCode : e.charCode   		 					 
  if (unicode == 13) { 
var message=$(this).val();
document.getElementById("sendie<?php echo $chat_rec; ?>").value='';
$.ajax({
type: "POST",
url: "request.php",
data: 'message='+message+'&chat_sender3=<?php echo $chat_sender; ?>&chat_rec3=<?php echo $chat_rec; ?>',
cache: false,
success: function(html){

 }
});
 }
 });
 setInterval(
function(){var speed = 10000;
var div = document.getElementById("chat_body<?php echo $chat_rec; ?>")
div.scrollTop = speed;
},10);
setInterval(
function(){ 
	$.ajax({
type: "POST",
 url: "request.php",
  data: 'chatting=y&chat_sender=<?php echo $chat_sender; ?>&chat_rec=<?php echo $chat_rec; ?>',
 cache: false,
 success: function(html){
$('#chat_body<?php echo $chat_rec ?>').html(html);
 }
});
},100);
</script>
<?php
	
}	
}

 function small_pic($user_id){
$sql_pic=mysql_query("select picture2,firstname,lastname from users where uid='$user_id'");
	$fetch_pic=mysql_fetch_array($sql_pic);
	$s->pic='<img src="'.$fetch_pic['picture2'].'" width="32" height="32" style="float:left; margin-right:5px; margin-bottom:0px" id="profilep"/>';
	$s->name='<font color="#0000CC">'.$fetch_pic['firstname'].' '.$fetch_pic['lastname'].'</font>';
	return $s;	
	 
 }
 function encode_img($img)
 {
     $fd = fopen($img, 'rb');
     $size = filesize($img);
     $cont = fread($fd, $size);
     fclose($fd);
     $encimg = base64_encode($cont);
     return $encimg;
 }

  
 // function to display the image
function display_img($imgcode,$type)
 {
    header('Content-type: image/'.$type);
     echo base64_decode($imgcode);
 }
  
 // use like
 // specify the image to encode
//$img = 'themes/26.jpg';
 
// encode the image
//$encoded_img = encode_img($img);

 
// use this to split the code into managable pieces
// i.e. if you want to save the string to a file
 
// show the image directly
// display_img($encoded_img,'jpg');

function parseVideoEntry($youtubeVideoID) 
{      
 $obj= new stdClass;
      
 // set video data feed URL

     $feedURL = 'http://gdata.youtube.com/feeds/api/videos/' . $youtubeVideoID;
     // read feed into SimpleXML object
     $entry = simplexml_load_file($feedURL);

      
       // get nodes in media: namespace for media information
       $media = $entry->children('http://search.yahoo.com/mrss/');
       $obj->title = $media->group->title;
       $obj->description = $media->group->description;
      
       // get video player URL
       $attrs = $media->group->player->attributes();
       $obj->watchURL = $attrs['url']; 
      
       // get video thumbnail
       $attrs = $media->group->thumbnail[0]->attributes();
       $obj->thumbnailURL = $attrs['url']; 
            
       // get <yt:duration> node for video length
       $yt = $media->children('http://gdata.youtube.com/schemas/2007');
       $attrs = $yt->duration->attributes();
       $obj->length = $attrs['seconds']; 
      
       // get <yt:stats> node for viewer statistics
       $yt = $entry->children('http://gdata.youtube.com/schemas/2007');
       $attrs = $yt->statistics->attributes();
       $obj->viewCount = $attrs['viewCount']; 
      
       // get <gd:rating> node for video ratings
       $gd = $entry->children('http://schemas.google.com/g/2005');
	 
       if ($gd->rating) 
 { 
         $attrs = $gd->rating->attributes();
         $obj->rating = $attrs['average']; 
       } 
 else 
 {
        $obj->rating = 0;         
       }
        
 // get <gd:comments> node for video comments
       $gd = $entry->children('http://schemas.google.com/g/2005');
       if ($gd->comments->feedLink) 
 { 
         $attrs = $gd->comments->feedLink->attributes();
         $obj->commentsURL = $attrs['href']; 
         $obj->commentsCount = $attrs['countHint']; 
       }

       return $obj;      
}
?>

<?php
	 function smiley($msg) {
      $msg = str_replace(":)","<img src=smileys/smile.jpg>", $msg); 
	  $msg = str_replace(":p","<img src=smileys/tongue.gif>", $msg); 
      $msg = str_replace("<3","<img src=smileys/heart.jpg>", $msg);
      $msg = str_replace("<(\")","<img src=smileys/penguin.gif>", $msg);
      $msg = str_replace("(^^^)","<img src=smileys/shark.jpg>", $msg);
      $msg = str_replace(":D","<img src=smileys/laugh.jpg>", $msg);
      $msg = str_replace("^_^","<img src=smileys/heyes.gif>", $msg);
      $msg = str_replace(">:o","<img src=smileys/leyes.gif>", $msg);
      $msg = str_replace(":3","<img src=smileys/catsmile.jpg>", $msg);
      $msg = str_replace(">:-(","<img src=smileys/grumpy.gif>", $msg);
      $msg = str_replace(":(","<img src=smileys/sad.gif>", $msg);
      $msg = str_replace(":o","<img src=smileys/shocked.jpg>", $msg);
      $msg = str_replace("8)","<img src=smileys/glasses.jpg>", $msg);
      $msg = str_replace("8-|","<img src=smileys/shades.gif>", $msg);
      $msg = str_replace("O.o","<img src=smileys/woot.gif>", $msg);	  	  	  	  	  	  	  	  	  		  	    	  	   	  	  	   
      $msg = str_replace("-_-","<img src=smileys/dork.jpg>", $msg);
      $msg = str_replace(":*","<img src=smileys/kiss.jpg>", $msg);
      $msg = str_replace(":v","<img src=smileys/pacman.jpg>", $msg);
      $msg = str_replace(":|]","<img src=smileys/robot.jpg>", $msg);
      $msg = str_replace(": putnam:","<img src=smileys/wierd.jpg>", $msg);	  	  	  	  	  	  	  	  	  	  	  	  	  		  	    	  	   	  	  	   	  
      return $msg; 
	 }
	 
	 function text_link($msg)
	 {
	$msg=preg_replace("/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i","<a href=$1 target=_blank style=color:#00C>$1</a>",$msg);
	return $msg;	 
	 }

function getMetaTitle($content){
$pattern = "|<[\s]*title[\s]*>([^<]+)<[\s]*/[\s]*title[\s]*>|Ui";
if(preg_match($pattern, $content, $match))
return $match[1];
else
return false;
}

?>