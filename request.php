<?php
session_start();
$uid=$_SESSION['uid'];
include('db.php');
date_default_timezone_set('Asia/Kolkata');
$date=date('h:i A \| jS F');
include 'youtube.php';

if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{


	$upid=(mt_rand().mt_rand().mt_rand());
	$cid=(mt_rand().mt_rand().mt_rand());
	$al_id=(mt_rand().mt_rand().mt_rand());	


$firstname=$_SESSION['fname'];
if(isset($_POST['ser']))
{
$uid2=$_POST['uider'];
$uid2=cleaner($uid2);
mysql_query("insert into friends(main,friend) values ('$uid','$uid2')");
mysql_query("insert into friends(main,friend,approved) values ('$uid2','$uid','rec')");
}
if(isset($_POST['alert_num'])){
	$alert2=mysql_query("select * from notifications where rec_uid='$uid' and approved='n' order by sno desc");
$num=mysql_num_rows($alert2);
if($num==0){
	
}
else{
echo '+'.$num;	
?>
<script>$(".right_toggle").fadeIn("slow");
</script>
<?php
}
}
if(isset($_POST['remove_buddy']))
{
$uid2=$_POST['remove_buddy'];
$uid2=cleaner($uid2);

$t=mysql_query("delete from friends where main='$uid' and friend='$uid2'");
$r=mysql_query("delete from friends where friend='$uid' and main='$uid2'");
//echo mysql_error($t);
}
if(isset($_POST['chatonline_uid']))
{$uid=$_POST['chatonline_uid'];
		mysql_query("update users set online='y' where uid='$uid'");
}
if(isset($_POST['chatoffline_uid']))
{$uid=$_POST['chatoffline_uid'];
		mysql_query("update users set online='n' where uid='$uid'");
}

if(isset($_POST['rating']))
{
$rating=cleaner($_POST['rating']);
$rating=cleaner($rating);
$uid2=cleaner($_POST['uid2']);
$uid2=cleaner($uid2);
$sql2=mysql_query("UPDATE friends SET rating='$rating'  WHERE friend='$uid2' and main='$uid'");
}
if(isset($_POST['album_name']))
{
	$album_name=cleaner($_POST['album_name']);
$aid=(mt_rand().mt_rand().mt_rand());
$query=mysql_query("INSERT into albums(album,uid,aid) VALUES ('$album_name','$uid','$aid')");
}

if(isset($_POST['frequest']))
{
$uid2=cleaner($_POST['frequest']);
$name_query=mysql_query("select firstname,lastname from users where uid='$uid2'");
$name_final=mysql_fetch_array($name_query);
$category='is now buddy with <a href="#!/profile.php?uid='.$uid2.'" style="text-decoration:none; color:#00C; font-size:11px;">'.$name_final['firstname'].'&nbsp;'.$name_final['lastname'].'</a>';
//$sql=mysql_query("UPDATE testimonials SET approved='y'  WHERE msg_to='$uid' and msg_from='$uid2'");
//mysql_query("insert into updates(upid,msg_from,uid,category) values ('$upid','$firstname','$uid','$category')");
$sql=mysql_query("UPDATE friends SET approved='y'  WHERE main='$uid' and friend='$uid2'");
$sql2=mysql_query("UPDATE friends SET approved='y'  WHERE friend='$uid' and main='$uid2'");
}
if(isset($_POST['frequest_decline']))
{
$uid2=cleaner($_POST['frequest_decline']);
$name_query=mysql_query("select firstname,lastname from users where uid='$uid2'");
$name_final=mysql_fetch_array($name_query);
$category='is now buddy with <a href="#!/profile.php?uid='.$uid2.'" style="text-decoration:none; color:#00C; font-size:11px;">'.$name_final['firstname'].'&nbsp;'.$name_final['lastname'].'</a>';
//$sql=mysql_query("UPDATE testimonials SET approved='y'  WHERE msg_to='$uid' and msg_from='$uid2'");
//mysql_query("insert into updates(upid,msg_from,uid,category) values ('$upid','$firstname','$uid','$category')");
$sql=mysql_query("delete from friends WHERE main='$uid' and friend='$uid2'");
$sql2=mysql_query("delete from friends  WHERE friend='$uid' and main='$uid2'");
}

if(isset($_POST['trequest']))
{
$uid2=cleaner($_POST['trequest']);
$name_query=mysql_query("select firstname,lastname from users where uid='$uid2'");
$name_final=mysql_fetch_array($name_query);
$category='received an <a href="#!/describe.php?val=m&uid='.$uid.'" style="text-decoration:none; color:#00C; font-size:11px;">iDescribe</a> from <a href="#!/profile.php?uid='.$uid2.'" style="text-decoration:none; color:#00C; font-size:11px;">'.$name_final['firstname'].'&nbsp;'.$name_final['lastname'].'</a>';
$sql=mysql_query("UPDATE testimonials SET approved='y'  WHERE msg_to='$uid' and msg_from='$uid2'");
$describe='idescribe';
mysql_query("insert into updates(upid,msg_from,uid,category,time,describer) values ('$upid','$firstname','$uid','$category','$date','$describe')");
}

if(isset($_POST['alert_id']))
{
	$alert_id=cleaner($_POST['alert_id']);
//	echo $alert_id;
$sql=mysql_query("UPDATE notifications SET approved='y'  WHERE sno='$alert_id'");

}

if(isset($_POST['textcontent']))

{
$textcontent=cleaner($_POST['textcontent']);
$describer=cleaner($_POST['describe']);
$id=cleaner($_POST['com_msgid']);
$id2=cleaner($_POST['com_msgid2']);
$name=$_SESSION['fname'];
//echo $id2;
$final='
<div style="margin-left:40px;">
<a href="#!/profile.php?uid='.$uid.'" onclick="scroll(0,0)" style="color:#00C;">'.$_SESSION['fname'].' </a><div style="width:95%;color:#333">'.stripslashes($textcontent).'</div><span style="font-size:9px;color:#666; float:right">'.$date.'</span></div></div>';
mysql_query("insert into comment(comment,id,sender,cid) values('$final','$id','$uid',$cid)");
$alert_select=mysql_query("select * from notifications where id='$id'");
$alert_select_count=mysql_fetch_array($alert_select);
$notif_q=mysql_query("select * from comment where id='$id'");
$notif_num=mysql_num_rows($notif_q);
if($notif_num==1){
	if($id2!=$uid){
	$desc_cat='commented on your '.cleaner($_POST['describe']);
mysql_query("insert into notifications(alert_id,sender_uid,rec_uid,id,msg,people,describer) values('$al_id','$uid','$id2','$id','$desc_cat','1','$describer')");	
	}
}
while($notif_r=mysql_fetch_array($notif_q)){
	$notif_rec=$notif_r['sender'];
	if($notif_rec==$id2)
	$desc_cat='commented on your '.cleaner($_POST['describe']);
	elseif($id2==$uid){
		$name2=small_pic($id2);
	$desc_cat='commented on his '.cleaner($_POST['describe']);
	}
	else{
		$name2=small_pic($id2);
	$desc_cat='commented on '.$name2->name.'&rsquo;s&nbsp;'.cleaner($_POST['describe']);
	}
		if($notif_rec!=$uid){
mysql_query("delete from notifications where id='$id' and rec_uid='$notif_rec'");			
mysql_query("insert into notifications(alert_id,sender_uid,rec_uid,id,msg,people,describer) values('$al_id','$uid','$notif_rec','$id','$desc_cat','1','$describer')");	
	}
}
$sql_pic=mysql_query("select picture2 from users where uid='$uid'");
$fetch_pic=mysql_fetch_array($sql_pic);
echo '<div class="load_comment" id="comment_load'.$cid.'"><div align="left">';
	echo '<div class="delete_button">
<a id="'.$cid.'" class="delete_comment">&Omega;</a>
</div>
</div><a href="#!/profile.php?uid='.$uid.'" onclick="scroll(0,0)" style=color:#00C;>
<img src="'.$fetch_pic['picture2'].'" width=32px height=32px id=profilep style="float:left">
</a>'.stripslashes($final).'</div>';	

}
if(isset($_POST['album_id']))
{
		$user_id=cleaner($_POST['user_id']);
		$aid=cleaner($_POST['album_id']);
		$album_name=mysql_query("select album from albums where aid='$aid'");
		$album_name_result=mysql_fetch_array($album_name);
		$album_g=mysql_query("select image_thumb,image_orig from images where aid='$aid' order by img_id desc");
		while($album_r=mysql_fetch_array($album_g))
		{$album_q[]=$album_r['image_thumb'];$album_t[]=$album_r['image_orig'];}
		$content='';
		for($i=0;$i<3;$i++)
		{
			if($album_q[$i]!='')
		$all[$i]='<a href=#!/album.php?uid='.$user_id.'&aid='.$aid.'&pid='.$album_t[$i].' style="float:left"><div style="background-image:url('.$album_q[$i].'); width:125px; height:95px" class="image_thumb1"></div></a>';
		$content.=$all[$i];	
		}
		$category='';
		$content.='<a href="#!/album.php?uid='.$user_id.'&aid='.$aid.'&v=1" style="font-weight:bold; float:left;width:100%">'.$album_name_result['album'].'</a>';
		$describe='album';
mysql_query("delete from updates where upid='$aid'");		
mysql_query("insert into updates(upid,msg_from,msg,uid,category,time,describer) values ('$aid','$firstname','$content','$uid','$category','$date','$describe')");
}
if(isset($_POST['content']))
{

$uid=cleaner($_SESSION['uid']);
$content='<div style="color:#000; width:87%">'.cleaner($_POST['content']).'</div>';
$category='';
$describe='thought';
mysql_query("insert into updates(upid,msg_from,msg,uid,category,time,describer) values ('$upid','$firstname','$content','$uid','$category','$date','$describe')");
$place_coord_q=mysql_query("select * from updates where upid='$upid'");
$ip_m=iprofile_main($place_coord_q,'main');
echo $ip_m;

}

if(isset($_POST['msg_id']))
{
$id=cleaner($_POST['msg_id']);
$sql = "update updates set reader='n' where upid='$id'";
mysql_query( $sql);
}

if(isset($_POST['msg_id2']))
{
	$msg_upid=cleaner($_POST['msg_upid']);
$id=cleaner($_POST['msg_id2']);
$sql = "delete from comment where cid='$id'";
mysql_query( $sql);
$al=mysql_query("select * from notifications where id='$msg_upid'");
$al_r=mysql_fetch_array($al);
$people=$al_r['people'];
$people=$people-1;
mysql_query("update notifications set people='$people' where id='$msg_upid' ");
}


if(isset($_POST['vote']))
{
$id=cleaner($_POST['vote']);
$id2=cleaner($_POST['upid']);
$vote_describe=cleaner($_POST['vote_describe']);
$ip_sql=mysql_query("select uid from votes where id='$id' and uid='$uid'");
$count=mysql_num_rows($ip_sql);
$vote_notify='voted for your '.$vote_describe;
if($count==0)
{
$sql_in = "insert into votes (uid,id) values ('$uid','$id')";
mysql_query( $sql_in);
$alert_select=mysql_query("select * from notifications where id='$id'");
$alert_select_count=mysql_fetch_array($alert_select);
if($alert_select_count['people']==0){
if($id2!=$uid)
mysql_query("insert into notifications(alert_id,sender_uid,rec_uid,id,msg,people,describer) values('$al_id','$uid','$id2','$id','$vote_notify','1','$vote_describe')");
}
else{
	$alert_select_counter=$alert_select_count['people'];
	$alert_select_counter1=$alert_select_count['people']+1;
	$desc_cat2='voted along with '.$alert_select_counter.' other on your '.$vote_describe;
	if($id2!=$uid){
mysql_query("delete from notifications where id='$id'");
mysql_query("insert into notifications(alert_id,sender_uid,rec_uid,id,msg,people,describer) values('$al_id','$uid','$id2','$id','$desc_cat2','$alert_select_counter1','$vote_describe')");	
	}
}
$result=mysql_query("select sno from votes where id='$id'");
$love=mysql_num_rows($result);
echo $love;
}
else
{
$result=mysql_query("select sno from votes where id='$id'");
$love=mysql_num_rows($result);

echo $love.'&nbsp;<font color="#666" size=1>You have already voted</font>';
}
}

if(isset($_POST['video']))
{
	error_reporting(0);
	$a=0;
$firstname=$_SESSION['fname'];
$content='shared a video';
$video=cleaner($_POST['video']);
preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$video,$matches);	
$url_check= parse_url($video, PHP_URL_HOST);
if($url_check=='www.youtube.com'){
	$video_check=mysql_query("select name from videos where uid='$uid'");
	while($video_check_array=mysql_fetch_array($video_check))
	{
	if($matches[1]==$video_check_array['name'])
	{
	echo '-->You have already added this video to your playlist<br>';
	$a=1;	
	}
	}

	
if( $a==0)
{
 $videoInfo = parseVideoEntry($matches[1]);
 $title=$videoInfo->title;
  $url=$videoInfo->watchURL;
   $count=$videoInfo->viewCount;
    $length=$videoInfo->length;
	 $rating=$videoInfo->rating;
	 $video_info2=$videoInfo->description;
	 $video_info3=strlen($video_info2);
	 if($video_info3>150){
		$video_info2=strtolower(substr($video_info2,0,150)).'...'; 
	 }
	 else{
			$video_info2=strtolower($video_info2); 	 
	 }
	 
 
$msg='<div class="leftt">
<div style="float:left"><div class="yoyo" id="video_thumbnail'.$upid.'" name="'.$upid.'"><img src="'.$videoInfo->thumbnailURL.'" width="150" height="110" class="image_thumb2" style="float:left;"><img src="logo/side_video.png" style="margin-left:-58px;margin-top:65px"></div></div>
<div class="video_update"  id="video_video'.$upid.'">
<iframe class="youtube-player" type="text/html" width="380" height="260" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0">
</iframe></div>
</div>
<div style="float:left; width:100%;"><a href="'.$url.'" target=_blank style="font-weight:bold">'.$title.'</a><br><font color="#666666">'.$video_info2.'</font>
</div>';
$describe='video';
$video_query_update=mysql_query("insert into updates(upid,msg_from,msg,category,uid,time,describer) values ('$upid','$firstname','$msg','$content','$uid','$date','$describe')");
$video_query=mysql_query("insert into videos(name,upid,uid,title,url,views,length,rating) values('$matches[1]','$upid','$uid','$title','$url','$count','$length','$rating')");
	if($video_query && $video_query_update)
	{
echo 'The video has been successfully attached to your account.';
	}
	else{
		echo 'Oops Some error occured. Try Again Later';	
	}
}
}
else
{
	echo'The video cannot not be attached.';
}
}

if(isset($_POST['music']))
{
$music=cleaner($_POST['music']);
//echo $music;
//echo 'http://www.google.co.in/music/search?q='.$music;
echo '<center><div class="music_holder"><iframe src="http://www.saavn.com/search.php?q='.$music.'" width="552px" height="1000px" scrolling="no" marginheight="10" style=border:0></iframe></div></center>';
}

if(isset($_POST['desc']))
{
	$sendto=cleaner($_POST['sendto']);
$describe=cleaner($_POST['desc']);
$sql = "insert into testimonials(msg_from,msg_to,msg,approved) values('$uid','$sendto','$describe','n')";
mysql_query( $sql);
echo 'submitted';
}
if(isset($_POST['chat_open']))
{
$chat_rec=cleaner($_POST['chat_rec2']);
$iprofile_chat=iprofile_chat($chat_rec);
}
if(isset($_POST['chatting']))
{
$chat_sender=$_POST['chat_sender'];
$chat_rec=cleaner($_POST['chat_rec']);	
$chat_online3=mysql_query("select * from chat where (sender='$chat_sender' or sender='$chat_rec') and (rec='$chat_sender' or rec='$chat_rec')  order by id");
while($chat_online_r3=mysql_fetch_array($chat_online3))
{
$s=small_pic($chat_online_r3['sender']);
echo '<div style="float:left">'.$s->pic.$chat_online_r3['message'].'<div><br><br>';	
}
}
if(isset($_POST['message']))
{
	$message=cleaner($_POST['message']);
$chat_sender=cleaner($_POST['chat_sender3']);
$chat_rec=cleaner($_POST['chat_rec3']);
$message=mysql_query("insert into chat(sender,rec,message) values ('$chat_sender','$chat_rec','$message')");
}
if(isset($_POST['chat_close']))
{
$uid2=cleaner($_POST['chat_id']);
$sql2=mysql_query("UPDATE friends SET chatting='n'  WHERE friend='$uid2' and main='$uid'");	
}
if(isset($_POST['wlink']))
{
$url=cleaner($_POST['wlink']);
$title = getMetaTitle(file_get_contents($url));
$video_info3=strlen($title);
	 if($video_info3>50){
		$title=(substr($title,0,50)).'...'; 
	 }
$content2=get_meta_tags($url);
$descrip=strtolower($content2['description']);
$a= '<div style="float:left; width:100%;border-left:2px solid #CCC; padding-left:5px;">';
//echo '<a style="float:left;" href="'.$url.'" target="_blank"><img src="http://open.thumbshots.org/image.pxf?url='.$url.'" class="image_thumb2" style="margin-right:5px; margin-top:5px; margin-bottom:5px; float:left;"></a>';
if(isset($title))
{
$b='<div><a href="'.$url.'" target="_blank" style="font-weight:bold">'.$title.'</a></div>';
}
if(isset($content2['description']))
{
$c='<div style="color:#666;width:370px">'.$descrip.'</div>';
}

$msg=$a.'<div style="width:370px;float:left">'.$b.$c.'</div></div><br>';
$content='shared a link';
$describe='link';
$link_update=mysql_query("insert into updates(upid,msg_from,msg,category,uid,time,describer) values ('$upid','$firstname','$msg','$content','$uid','$date','$describe')");
$place_coord_q=mysql_query("select * from updates where upid='$upid'");
$ip_m=iprofile_main($place_coord_q,'main');
echo $ip_m;
}

if(isset($_POST['logger']))
{
header('location:logout');
}

if(isset($_POST['message_subject']))
{
	$mid=mt_rand().mt_rand().mt_rand();
$message_to=cleaner($_POST['message_to']);
$message_subject=cleaner($_POST['message_subject']);
$message_message=cleaner($_POST['message_message']);
$message=mysql_query("insert into messages(sender,rec,subject,message,mid,type) values ('$uid','$message_to','$message_subject','$message_message','$mid','m')");
mysql_query("insert into notifications(alert_id,sender_uid,rec_uid,id,msg,describer) values('$al_id','$uid','$message_to','$mid','sent you a message','message')");
echo 'Message Sent';
}

if(isset($_POST['place_coord']))
{
include('simple_html_dom.php');	
// echo $element2[1]
$html2 = new simple_html_dom();	
$url2='http://maps.google.com/maps?q='.urlencode(cleaner($_POST['place_coord']));
$data2=curly($url2); 
$html2->load($data2);
$element2=$html2->find("div[class=noprint res]");
$element2=preg_replace("/href=\"(.*)\"/", ' target="_blank" href="http://www.maps.google.com$1"', $element2);
$msg= '<a href="http://maps.google.com/maps?q='.urlencode($_POST['place_coord']).'" target="_blank"><img src="http://maps.google.com/maps/api/staticmap?center='.urlencode($_POST['place_coord']).'&zoom=12&size=150x150&sensor=true&maptype=roadmap" style="float:left" id="profilep"></a><div style="height:160px; margin-left:170px;">'.addslashes($element2[0]).'</div>';	
echo $msg;
$content='is currently near:-';
$describe='location';
$link_update=mysql_query("insert into updates(upid,msg_from,msg,category,uid,time,describer) values ('$upid','$firstname','$msg','$content','$uid','$date','$describe')");
$place_coord_q=mysql_query("select * from updates where upid='$upid'");
$ip_m=iprofile_main($place_coord_q,'main');
echo $ip_m;
}


if(isset($_POST['google_search']))
{

}

if(isset($_POST['torrent_search']))
{
	error_reporting(0);
	 include('simple_html_dom.php');  
$html = new simple_html_dom();
$html2= new simple_html_dom();
$url='http://www.themoviedb.org/search?search='.urlencode(cleaner($_POST['torrent_search'])).'';
$data=curly($url);
$url2='http://torrentz.eu/search?f='.urlencode(cleaner($_POST['torrent_search'])).'';
$data2=curly($url2); 
$html->load($data);
$html2->load($data2);     
# get an element representing the second paragraph  
$element = $html->find("div[class=result]");
$element2 = $html2->find("dt");
$element3 = $html2->find("span[class=s]");$element4 = $html2->find("span[class=a]");
//$element= $html->find("span[class=outline]");
// echo $element2[1];
//echo 'Top 5 Torrent results';
echo '<div class="desc_current">
<a>Top Torrentz</a>
</div>
<br /><br />';
		for($i=4;$i<=18;$i++)
{
	if(isset($element2[$i]))
	{
$item=preg_replace("/href=\"(.*)\"/", ' target="_blank" href="http://www.torrentz.eu$1" onclick="torrent_share(\'http://www.torrentz.eu$1\')"', $element2[$i]);
echo '<li style="padding:15px">'.$item.'Size:'.$element3[$i].'&nbsp;&nbsp;Added:'.$element4[$i].'</li>';
	}
}
echo '<br>';
		foreach($element as $item)
{
$item=preg_replace("/href=\"(.*)\"/", ' target="_blank" href="http://www.themoviedb.org$1"', $item);
echo '<li style="padding:10px">'.$item.'</li>';	
}		
}
if(isset($_POST['torrent_share_link']))
{
$url=cleaner($_POST['torrent_share_link']);
$title = getMetaTitle(file_get_contents($url));
//$content2=get_meta_tags($url);
$a= '<div style="float:left; padding:3px; width:100%"><img src="logo/torrentz.png" id="profilep">';
if(isset($title))
{
$b='<div style="margin-top:2px">'.$title.'</div><div><a href="'.$url.'" target="_blank">'.$url.'</a></div><br>';
}

$msg=$a.$b.'</div>';
$content='is downloading via torrent';
$describe='torrent link';
$link_update=mysql_query("insert into updates(upid,msg_from,msg,category,uid,time,describer) values ('$upid','$firstname','$msg','$content','$uid','$date','$describe')");	
}

if(isset($_POST['c'])){
	$user=cleaner($_SESSION['uid']);
		$no=cleaner($_POST['c']);
$count=24*$no;
	$sql_in= mysql_query("SELECT * FROM updates where reader='y' and uid in (SELECT friend FROM friends where main='$user' and approved='y') and uid!='$user' order by msg_id desc limit $count,24");
$sql_num=mysql_num_rows($sql_in);
$no=$no+1;
$iprofile_main=iprofile_main($sql_in,'main',$count);
echo $iprofile_main;
echo '<div class="wassup"><a id="older" class="'.$no.'">Show Older Posts</a></div>';
}
if(isset($_POST['view_upid'])){
	$view_upid=$_POST['view_upid'];
	$view_uuid=$_POST['view_uuid'];	
$sql_in= mysql_query("SELECT * FROM comment where id='$view_upid' order by sno");
$sql_count=mysql_num_rows($sql_in);
$iprofile_main=iprofile_comment($view_upid,$view_uuid,$sql_in,$sql_count,$_POST['view_describe']);
echo '<div style="margin-left:-5px">'.$iprofile_main.'</div>';	
}
if(isset($_POST['mid'])){
	$mid=cleaner($_POST['mid']);
	$mid_value=cleaner($_POST['mid_value']);
	$messageq=mysql_query("select * from messages where mid='$mid' order by sno asc");
	$message_count=mysql_num_rows($messageq);
	if($message_count!=0){
$messager=mysql_fetch_array($messageq);
$message_to=$messager['sender'];
if($message_to==$uid){$message_to=$messager['rec'];}
$message_from=$uid;
$message_subject=$messager['subject'];
$message_message=$mid_value;
mysql_query("insert into messages(sender,rec,message,mid,type) values ('$message_from','$message_to','$message_message','$mid','r')");
mysql_query("delete from notifications where id='$mid' and sender_uid='$uid'");
mysql_query("insert into notifications(alert_id,sender_uid,rec_uid,id,msg,describer) values('$al_id','$uid','$message_to','$mid','replied to your message','message')");
$sender_info=mysql_query("select firstname,lastname,picture2,uid from users where uid='$uid'");
$sender=mysql_fetch_array($sender_info);
echo'<div class="alldesc"><div class="desc_pic"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;><img src='.$sender['picture2'].' id="profilep" width=42 height=42></a></div><div class="desc_from"><a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;>'.$sender['firstname'].'&nbsp;'.$sender['lastname'].' </a></div><br><div class="desc_content" style="width:500px; margin-left:50px;">'.($mid_value).'</div></div><div style="float:left;	margin-bottom:15px;"><div id="message_reply_response'.$messager['mid'].'"></div></div>';
}
}
if(isset($_POST['update_rating'])){
	$rating=$_POST['update_rating'];
	$update_uid=$_POST['update_uid'];
		$update_upid=$_POST['update_upid'];
		$update_s=mysql_query("select * from rating where upid='$update_upid' and uid='$uid'");
		$update_c=mysql_num_rows($update_s);
		if($update_c==0){
		mysql_query("insert into rating(upid,uid,ratings) values ('$update_upid','$uid','$rating')");
		}
		else{
					mysql_query("update rating set ratings='$rating' where upid='$update_upid' and uid='$uid'");
		}
}
if(isset($_POST['profiler_id'])){
$profiler_id=cleaner($_POST['profiler_id']);
$sql_id=cleaner($_POST['sql_id']);
$profiler_content=cleaner($_POST['profiler_content']);	
mysql_query("update users set $sql_id='$profiler_content' where uid='$uid'");
}
if(isset($_POST['share_upid'])){
	$upid2=$_POST['share_upid'];
	$uid=$_SESSION['uid'];
	$uid2=$_POST['share_uid'];
	$share_sel=mysql_query("select msg from updates where upid='$upid2' and uid='$uid'");
	$share_sel2=mysql_query("select msg from updates where upid='$upid2' and uid='$uid2'");
	$share_num=mysql_num_rows($share_sel);
	if($share_num==0)
	{
	$share_res=mysql_fetch_array($share_sel2);
	$msg=$share_res['msg'];
	$share_name=small_pic($uid2);
	$describe=$_POST['share_describe'];
	$category='&hArr;<a href="#!/profile.php?uid='.$uid2.'">'.$share_name->name.'</a> ['.$describe.']';
mysql_query("insert into updates(upid,msg_from,msg,uid,category,time,describer) values ('$upid','$firstname','$msg','$uid','$category','$date','$describe')");
	}
}
if(isset($_POST['more_updates'])){
	$more_id=$_POST['more_updates'];
	$user=$_SESSION['uid'];
	$sql_in2= mysql_query("SELECT * FROM updates where reader='y' and uid in (SELECT friend FROM friends where main='$user' and approved='y') order by msg_id desc limit 1");
	$sql_2=mysql_fetch_array($sql_in2);
	$more_id2=$sql_2['upid'];
	if($more_id==$more_id2)
	{
	echo '';	
	}
	else{
echo '';	$sql_in2= mysql_query("SELECT * FROM updates where reader='y' and upid='$more_id2' and uid in (SELECT friend FROM friends where main='$user' and approved='y')");		
$ip_m=iprofile_main($sql_in2,'main')	;
echo $ip_m;
	}
}
}
?>
