 <?php
include 'db.php';
if(isset($_POST['textcontent']))

{
$textcontent=$_POST['textcontent'];
$id=$_POST['com_msgid'];
$com_insert=mysql_query("insert into comment(comment,id) values('$textcontent','$id')");

}

?>
<div class="load_comment"><?php echo $textcontent; ?></div>

 


