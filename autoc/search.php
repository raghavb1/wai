<?php
include '../db.php';
$q = '';
if (isset($_GET['q'])) {
    $q = strtolower($_GET['q']);
}
if (!$q) {
    return;
}

$sql_res=mysql_query("select * from users where firstname like '%$q%' or lastname like '%$q%' order by sno LIMIT 5");
while($row=mysql_fetch_array($sql_res))
{
$fname=$row['firstname'];
$lname=$row['lastname'];
$uid=$row['uid'];
/*$img=$row['img'];
$country=$row['country'];*/


echo $fname.' '.$lname.'|'.'#!/profile?uid='.$uid ?>



<?php
}
?>