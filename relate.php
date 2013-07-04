    <script type='text/javascript'>
  $('.send_message').click(function() {
	  		var uid3=$(this).attr('name');
Boxy.load('message.php?uid='+uid3,{title:"Send Message"});

});
</script>
<script type="text/javascript" language="JavaScript">

    function bgpos(left,top) {
        $("#starBlue").css("background-position",(left + "px " + top + "px"));
    }

    function bgpos2(val,which) {
		uid=$(which).attr("id");
		$.ajax({
type: "POST",
url: "request.php",
data: 'rating='+ val+'&uid2='+uid,
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
session_start();
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{
include 'db.php';
include 'changer.php';
if(isset($_GET['t']))
{
	if($_GET['t']=='b')
	{
//include 'changer.php';
$select_query=mysql_query("SELECT firstname,lastname,uid,picture2 FROM users where uid in (SELECT friend FROM friends where main='$uid' and approved='y') order by firstname");
?>
<div class="topic">Buddies</div>
<?php
while($select_result=mysql_fetch_array($select_query))
{
		if($select_result['uid']!=$uid){
 ?>
<div class="alldesc" style="margin-bottom:3px" id="remove_bud<?php echo $select_result['uid']; ?>">
 <div>

<?php

{
if($uid==$_SESSION['uid']){
	?>
    <div style="float:right; font-size:12px; color:#999; padding-right:10px">
   <a class="send_message" name="<?php echo $select_result['uid']; ?>"> Send a Message</a><br>
    <a href="#!/describe.php?val=w&uid=<?php echo $select_result['uid']; ?>">Describe</a><br>
    <a id="<?php echo $select_result['uid'] ?>" class="buddy_remove"> Remove</a><br>
    </div>
    <?php }} ?>
<div style="float:left">
<a href="#!/profile.php?uid=<?php echo $select_result['uid']  ?>" onClick="scroll(0,0)">
<img src="<?php echo $select_result['picture2']; ?>" width="52" height="52" id="profilep"/>
</a>
</div>
<div style="float:left; padding-left:5px;">
<a href="#!/profile.php?uid=<?php echo $select_result['uid']  ?>" onClick="scroll(0,0)">
<?php echo $select_result['firstname'].'&nbsp;'.$select_result['lastname']; ?>
</a>
</div><br>
    <div>
    <?php 
	$friend=$select_result['uid'];
	$rate_query=mysql_query("select rating from friends where main='$uid' and friend='$friend'");
	$rate_fetch=mysql_fetch_array($rate_query);
	$j=$rate_fetch['rating'];
	if($uid==$_SESSION['uid']){
	for($i=0;$i<$j;$i++)
	{
    echo '<img src="smileys/star_blue.gif" onClick="bgpos2('.($i).',this);" style=" cursor:pointer" id="'.$select_result['uid'].'"/>';
	}
	for($i=$j+1;$i<=5;$i++)
	{
    echo '<img src="smileys/star.gif" onClick="bgpos2('.($i).',this);" style=" cursor:pointer" id="'.$select_result['uid'].'"/>';
	}
	}
?>
    </div></div></div>

<?php }}
}
}
}?>