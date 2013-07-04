<?php
include('db.php');
if($_POST)
{

$q=$_POST['searchword'];

$sql_res=mysql_query("select * from universities where university like '%$q%' order by university LIMIT 10");
while($row=mysql_fetch_array($sql_res))
{
$fname=$row['university'];
$sno=$row['sno'];
/*$img=$row['img'];
$country=$row['country'];*/

$re_fname='<b>'.$q.'</b>';

$final_fname = str_ireplace($q, $re_fname, $fname);



?>

<div class="display_box" align="left">
<div id="<?php echo $sno; ?>" class="sno"><?php echo $final_fname; ?></div>
</div>




<?php
}

}
else
{

}


?>
