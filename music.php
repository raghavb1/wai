<?php
session_start();
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{
include 'db.php';
include 'changer.php';

?>
<script>
$('.music_submit').click(function()  
{
var music = $('.music_search').val();
 var dataString = 'music='+ music;
// 	 $('.vid_submit').css('display','none');
	 

$.ajax({
type: "POST",
 url: "request.php",
  data: dataString,
 cache: false,
 success: function(html){
$('.music_load').html(html);
document.getElementById('video').value='';
//	  	 $('.vid_submit').css('display','inherit');
 }
});
});
</script> 

<div class="music_holder"><iframe src="http://www.saavn.com/popup/psong-FAQkEogF.html" scrolling="no" class="saavn"></iframe></div>
  <?php
}
  else
{
echo '<script>window.location.href="home#!/music"</script>';
}