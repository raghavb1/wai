<?php
include 'db.php';
$q = '';
if (isset($_GET['q'])) {
    $q =($_GET['q']);
	
$sql_res=mysql_query("select * from users where firstname like '%$q%' or lastname like '%$q%' order by sno limit 8");
while($row=mysql_fetch_array($sql_res))
{
$fname=$row['firstname'];
$lname=$row['lastname'];
$uid=$row['uid'];
$pic=$row['picture2'];
$city=$row['city'];
/*$img=$row['img'];
$country=$row['country'];*/


echo '<img src="'.$pic.'" width="38" height="38" style="float:left" id="profilep"><div style="padding-top:2px; margin-left:45px;"><a href=#!/profile.php?uid='.$uid.' style=" color:#009; font-size:12px;">'.$fname.' '.$lname.'</a><br><font color="#666">'.$city.'</font></div>|'.'#!/profile.php?uid='.$uid ?>



<?php
}

}
if (isset($_GET['g'])) {
	?>
<div class="topic">Search</div>     
    <?php
 
function cleaner($value){
$value=htmlspecialchars($value);
$value=addslashes($value);
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
	 include('simple_html_dom.php');  
$html = new simple_html_dom();
$url='http://www.google.co.in/search?hl=en&q='.urlencode(cleaner($_GET['g'])).'&btnG=Google+Search&meta='; 
$data=curly($url);  
$html->load($data);    
# get an element representing the second paragraph  
$element = $html->find("li[class=g]");

//$element2 = $html->find("[src]");
// echo $element2[1];
echo '<div class="google"><ol class="old_updates">';
		foreach($element as $item)
{
$item=preg_replace("/href=\"(.*)\"/", ' target="_blank" href="http://www.google.com$1"', $item);
$item=preg_replace("/src=\"(.*)\"/", '', $item);
$item=preg_replace("/<blockquote style=\"margin-bottom:0\">/", '', $item);	
echo ($item);	
}	
echo '</ol></div>';	
}
