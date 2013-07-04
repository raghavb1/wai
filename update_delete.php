<script type="text/javascript" language="JavaScript">

    function bgpos(left,top) {
        $("#starBlue").css("background-position",(left + "px " + top + "px"));
    }

    function bgpos2(val,which) {
		upid=$(which).attr("id");
				uid=$(which).attr("name");
		$.ajax({
type: "POST",
url: "request.php",
data: 'update_rating='+ val+'&update_uid='+uid+'&update_upid='+upid,
cache: false,
success: function(html){

}
});
        if($(which).attr("src") == "smileys/star.gif") {
                $(which).attr("src","smileys/star_blue.gif");
                $(which).prevAll().attr("src","smileys/star_blue.gif");
        }
        else { 
                $(which).attr("src","smileys/star.gif");
                $(which).nextAll().attr("src","smileys/star.gif");
        }
    }

    </script>
      <?php
	  error_reporting(0);
if(isset($_SESSION))
{
	
}
if(!isset($_SESSION))
{
	session_start();
}
include 'db.php';
	include 'youtube.php';
$user=$_SESSION['uid'];
if(isset($_POST['c']))
{
	$no=$_POST['c'];
$count=24*$no;	
}
else{
$count=0;
$no=0;	
}
$sql_in= mysql_query("SELECT * FROM updates where reader='y' and uid in (SELECT friend FROM friends where main='$user' and approved='y') and uid!='$user' order by msg_id desc limit $count,24");
$sql_in2= mysql_query("SELECT * FROM updates where reader='y' and uid in (SELECT friend FROM friends where main='$user' and approved='y') and uid!='$user' order by msg_id desc limit 1");
$sql_2=mysql_fetch_array($sql_in2);
$sql_num=mysql_num_rows($sql_in);
$no=$no+1;
?>
<div class="first" style="float:left">
<div class="google">
<div class="help_loader"></div>
  <div class="old_updates">
    <?php
$iprofile_main=iprofile_main($sql_in,'main');
echo $iprofile_main;
?>
  </ol>
  <?php 
  
  if($sql_num>23)
{
echo '<div class="wassup"><a id="older" class="'.$no.'">Show Older Posts</a></div>';
}?>
  </div></div>