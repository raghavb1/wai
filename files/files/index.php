<?php include('simple_html_dom.php');  
$html = new simple_html_dom();
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 
'http://www.google.com/search?hl=en&q='.urlencode('raghav').'&btnG=Google+Search&meta='); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_FILETIME, true); 
$data = curl_exec($ch); 
curl_close($ch);  
$html->load($data);  
  
# get an element representing the second paragraph  
$element = $html->find("li");  
  
  echo $element[32];
?>