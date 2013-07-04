<?php
session_start();
include 'db.php';
if(isset($_GET['uid']))
{
$uid=$_GET['uid'];
}
else
{
$uid=$_SESSION['uid'];	
}
echo $uid;
?>
<div>
Personal
</div>
<div>
Buddies
</div>
<div>
Relations
</div>
<div>
Acedamic & Profession
</div>
<div>
Hobbies
</div>
<div>
Places
</div>
<div>
iLikes
</div>
<div>
Activities
</div>