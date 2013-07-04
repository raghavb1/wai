<?php
if (!empty($_FILES)) {
//error_reporting(0);

$error='';
$msg='';


$max=10000;
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;
  
 {
 	$image =$_FILES["Filedata"]["name"];
	$uploadedfile = $_FILES["Filedata"]["tmp_name"];
     
 
 	if ($image) 
 	{
 	
 		$filename = stripslashes($image);

  		$extension = getExtension($filename);

		
		
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension!="JPG") && ($extension!="JPEG")) 
 		{
		
 			$error= 'Unknown Image extension';
 			$errors=1;
 		}
 		else
 		{

 $size=filesize($uploadedfile);
// echo $filename;
echo $size;
if($size=='')
{
	$error= 'No image';
		$errors=1;
}
if ($size > ($max*1024))
{
	$error= 'Size OverFlow';
	$errors=1;
}

if($extension=="jpg" || $extension=="jpeg" || $extension=="JPG" || $extension=="JPEG" )
{
$uploadedfile = $_FILES['Filedata']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);

}
else if($extension=="png")
{
$uploadedfile = $_FILES['Filedata']['tmp_name'];
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
$tmp=imagecreatetruecolor($width3,$height3);

$newwidth1=185;
$newheight1=($height/$width)*$newwidth1;
$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

imagecopyresampled($tmp,$src,0,0,0,0,$width3,$height3,$width,$height);



$f1 = "images/uploads/".mt_rand().time().rand().md5(rand()).".jpg";
$f2 = "images/uploads/".mt_rand().md5($_SESSION['email']).time().rand().md5(rand()).".jpg";



imagejpeg($tmp,'../../'.$f1);
imagejpeg($tmp1,'../../'.$f2);


imagedestroy($src);
imagedestroy($tmp);
imagedestroy($tmp1);

}}

}
 if($errors==0) 
 {
		include '../../db.php';
	$uid=$_POST['uid'];
	$aid=$_POST['aid'];
	session_start();
	$firstname=$_SESSION['fname'];
	$category='shared a few photos';
	
	$upid=mt_rand().mt_rand().mt_rand();
$msg='hello';
//	$content='<center><img src='.$filename1.'></center>';
	//mysql_query("UPDATE users SET picture='$filename',picture2='$filename2' where uid='$uid'");	

	mysql_query("insert into images(image_thumb,image_orig,aid,uid,upid) values ('$f2','$f1','$aid','$uid','$upid')");	
	//$_SESSION['picture']=$filename;

 }
 else
 {
	//header('location:home'); 
 }
	}
?>