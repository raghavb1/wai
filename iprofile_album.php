<?php
include 'db.php';
include 'scripts.php';

class iprofile_album
{
	
	
	function album_names($uid)
	{
		$album_names_query=mysql_query("select * from albums where uid='$uid' order by sno desc");
		$album_names_html=new iprofile_functions;
		$album_names_html=$album_names_html->function_share_menu($uid);
		while($album_result=mysql_fetch_array($album_names_query))
			{
				$aid=$album_result['aid'];
				$pic_query=mysql_query("select image_thumb,image_orig from images where uid='$uid' and aid='$aid' order by img_id desc");
				$pic_query2=mysql_query("select image_thumb,image_orig from images where uid='$uid' and aid='$aid' order by img_id desc limit 8");
				$pic_count=mysql_num_rows($pic_query);
				$pic_result=mysql_fetch_array($pic_query);
				$new_album_names_html=new iprofile_album;
				$album_names_html.=$new_album_names_html->album_names_html($uid,$aid,$pic_result['image_thumb'],$album_result['album'],$pic_count);
			}
				return $album_names_html;
	}
	
	
	
	function album_names_html($uid,$aid,$pic_result,$album_result,$pic_count)
	{
		$a= '
				<div class="album_cover">
					<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1">
						<div class="image_thumb1" style="background-image:url('.$pic_result.');"></div>
					</a>
					<div style="float:left; text-align:center;width:168px">
						<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&v=1" style="font-size:12px;">'.$album_result.' ('.$pic_count.')</a>
						<br><br>
					</div>
				</div>
			';				
		return $a;		
	}
	
	function album_photos($uid,$aid)
	{
		$album_photos_html='';
		$album_name=mysql_query("select * from albums where aid='$aid'");
		$album_name_result=mysql_fetch_array($album_name);
		$query=mysql_query("select image_thumb,img_id,image_orig from images where uid='$uid' and aid='$aid' order by img_id desc limit 36");
		while($query2=mysql_fetch_array($query))
		  {
			$new_album_photos_html=new iprofile_album;
		  	$album_photos_html.= $new_album_photos_html->album_photos_html($uid,$aid,$query2['image_thumb'],$query2['image_orig']);	
		  }
		
		
		return $album_photos_html;
	}
	
	
	
	function album_photos_html($uid,$aid,$image_thumb,$image_orig)
	{
		$a= '
				<a href=#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$image_orig.'>
		  			<div class="image_thumb1" style="background-image:url('.$image_thumb.');"></div>
				</a>
				
			';	
						
		return $a;		
	}	
}

$c=new iprofile_album;
$d=$c->album_photos('421327464','87655908118790377881912858517');
echo $d;
?>