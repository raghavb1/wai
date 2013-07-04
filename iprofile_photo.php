<?php
include 'db.php';
include 'scripts.php';

class iprofile_photo
{
	
	
	function photo_show($uid,$aid,$pid)
	{
		$album_name=mysql_query("select * from albums where aid='$aid'");
		$album_name_result=mysql_fetch_array($album_name);
		$i=1;
		$query_again=mysql_query("select image_orig,upid from images where uid='$uid' and aid='$aid' order by img_id desc");
		while($query_result=mysql_fetch_array($query_again))
		{
			$next[$i]=$query_result['image_orig'];
			$upid[$i]=$query_result['upid'];
			$i=$i+1;
		}
		
		$i=$i-1;
		$k=1;
		$iprofile_photos=new iprofile_photo;
		for($j=$k;$j<=$i;$j++)
			{		  
	 			 if($pid==$next[$j])
	 				 {
						 $iprofile_photo= '<center><div class="image">';
						 if($j==$i)
	 						 {
								  if($j==1)
		 							 { 
									 	$iprofile_photo.=$iprofile_photos->photo_show_html($uid,$aid,$next[$j],$next[$j],$next[$j]);
									 }
								  else
		  							{
										$k=1;
										$iprofile_photo.=$iprofile_photos->photo_show_html($uid,$aid,$next[$j],$next[$k],$next[$j-1]);
									}
							 }
							else
	  						  {
		  						  if($j==1)
		 							 {
						 			  	$s=$i;
  										$iprofile_photo.=$iprofile_photos->photo_show_html($uid,$aid,$next[$j],$next[$j+1],$next[$s]); 
									 }
								  else
								  {
									    $iprofile_photo.=$iprofile_photos->photo_show_html($uid,$aid,$next[$j],$next[$j+1],$next[$j-1]);
								  }
							  }
							$iprofile_photo.= '</div></center>';
					 }
			}
		
		return $iprofile_photo;
	}
	
	
	
	function photo_show_html($uid,$aid,$photo_current,$photo_next,$photo_previous)
	{
		$previous_url='#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$photo_previous;
		$next_url='#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$photo_next;
				
		$a= '
				<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$photo_previous.'">Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;
			    <a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$photo_next.'">Next</a><br>
				<a href="#!/album.php?uid='.$uid.'&aid='.$aid.'&pid='.$photo_next.'"><img src="'.$photo_current.'"></a>';
		 	 ?>
             
  				<script type="text/javascript">
						document.onkeyup=function displayunicode(e)
						{
							var unicode=e.keyCode? e.keyCode : e.charCode;
							
							if(unicode==37)
								{
									window.location.href="<?php echo $previous_url; ?>";
								}
								
							if(unicode==39)
								{
									window.location.href="<?php echo $next_url; ?>";
								}
						}
				</script>
          <?php	
		  			
		return $a;		
	}
	
	
}

$c=new iprofile_photo;
$d=$c->photo_show('421327464','87655908118790377881912858517','images/uploads/275664179130579509122367dbd18fe1f4137d8e0a0cfb72376985ef.jpg');
echo $d;
?>