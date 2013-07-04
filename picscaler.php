<?php
		include 'db.php';
		session_start();
		error_reporting(0);	
$uid=$_SESSION['uid'];
if (isset($_POST["upload_thumbnail"])) {
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);	
	return $thumb_image_name;
}
	//Get the new coordinates to crop the image.
	$x1 = $_POST["x1"];
	$y1 = $_POST["y1"];
	$x2 = $_POST["x2"];
	$y2 = $_POST["y2"];
	$w = $_POST["w"];
	$h = $_POST["h"];
	//Scale the image to the thumb_width set above
	$scale = '72'/$w;
	$thumb_image_location=$_POST['thumb_img'];
	$large_image_location=$_POST['orig_img'];	
	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
		mysql_query("UPDATE users SET picture2='$cropped' where uid='$uid'");	
	//Reload the page again to view the thumbnail
	header("location:home.php#!/main.php");
	exit();
} 
else{
$change="";
$abc="";


 define ("MAX_SIZE","5600");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;
  
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
 	$image =$_FILES["file"]["name"];
	$uploadedfile = $_FILES['file']['tmp_name'];
     
 
 	if ($image) 
 	{
 	
 		$filename = stripslashes($_FILES['file']['name']);
 	
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
		
		
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{
		
 			$change='<div class="msgdiv">Unknown Image extension </div> ';
 			$errors=1;
 		}
 		else
 		{

 $size=filesize($_FILES['file']['tmp_name']);


if ($size > MAX_SIZE*1024)
{
	$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
	$errors=1;
}


}}

}
//If no errors registred, print the success message
 if($errors==0 && $filename!='') 
 {
	 if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['file']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);

}
else 
{
$src = imagecreatefromgif($uploadedfile);
}

echo $scr;

list($width,$height)=getimagesize($uploadedfile);

if($width>=700)
{
	$width3=700;
	$height3=($height/$width)*$width3;
if($height3>=520)
{
	$height3=520;
	$width3=($width/$height)*$height3;
	
}	
}
else{
	$width3=$width;
	$height3=$height;
}
$tmp3=imagecreatetruecolor($width3,$height3);


$newwidth1=185;
$newheight1=($height/$width)*$newwidth1;

$tmp1=imagecreatetruecolor($newwidth1,$newheight1);


$newwidth2=52;
$newheight2=52;
$tmp2=imagecreatetruecolor($newwidth2,$newheight2);


imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$width,$height);

imagecopyresampled($tmp3,$src,0,0,0,0,$width3,$height3,$width,$height);



$filename1 = "images/small".mt_rand().md5($_SESSION['email']).time().rand().md5(rand()).".jpg";

$filename2 = "images/smallest".mt_rand().md5($_SESSION['email']).time().rand().md5(rand()).".jpg";

$filename3 = "images/original".mt_rand().md5($_SESSION['email']).time().rand().md5(rand()).".jpg";




imagejpeg($tmp1,$filename1);

imagejpeg($tmp2,$filename2);

imagejpeg($tmp3,$filename3);

imagedestroy($src);
imagedestroy($tmp1);
imagedestroy($tmp2);
imagedestroy($tmp3);
	$email=$_SESSION['email'];
	$uid=$_SESSION['uid'];
	$firstname=$_SESSION['fname'];
	$alumq=mysql_query("select aid from albums where uid='$uid' and album='Profile Pictures'");
   $albumr=mysql_fetch_array($alumq);
   $aid=$albumr['aid'];
	$content='changed <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$filename3.'">Profile Picture</a>';
	
	$upid=	$upid=(mt_rand().mt_rand().mt_rand());
$date=date('jS \of F Y h:i:s A');
$msg='<div style="width:100%;float:left"><a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$filename3.'" style="float:left"><div style="background-image:url('.$filename1.');float:left;width:140px;height:'.round($newheight1-40).'px" class="image_thumb1"></div></a></div>';
//	$content='<center><img src='.$filename.'></center>';
	mysql_query("UPDATE users SET picture='$filename1',picture2='$filename2' where uid='$uid'");	
	mysql_query("insert into updates(upid,msg_from,category,uid,time,msg,describer) values ('$upid','$firstname','$content','$uid','$date','$msg','Profile Picture')");
	mysql_query("insert into images(image_thumb,image_orig,aid,uid,upid) values ('$filename1','$filename3','$aid','$uid','$upid')");	
	$_SESSION['picture']=$filename1;
	$_SESSION['rand']=mt_rand();
	$rand=$_SESSION['rand'];
echo'<script>window.location.href="index.php#!/pic.php?pid='.$filename3.'&w='.$width3.'&h='.$height3.'&thumb='.$filename2.'&rand='.$rand.'"</script>';

 }
 else
 {
	 $error='Unsuccessful';
	 echo '<script>alert("'.$error.'")</script>';
	 echo'<script>window.location.href="index.php"</script>';
	//header('location:home'); 
 }
}
?>