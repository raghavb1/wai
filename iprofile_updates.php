<?php
//include 'db.php';
//include 'scripts.php';

class iprofile_updates
{
	function updates_show($uid,$type,$d)
		{
		   $sql_in= mysql_query("SELECT * FROM updates where reader='y' and uid in (SELECT friend FROM friends where main='$uid' and approved='y') and uid!='$uid' order by msg_id 		                                  desc limit 0,24");
		   $tt=mysql_num_rows($sql_in);
		   $sql_num=mysql_num_rows($sql_in);		   
		   $a=0;
		   $b=1;
		   $uid2='';
		   $c='';
		   $final='';
		   $z=1;		   
			if($d=='')
				{
					$d=1;
				}
			else
				{
					$d=$d;
				}
		   $final.='<div class="old_updates">';
		   while($r=mysql_fetch_array($sql_in))
			  {
				  $uid=$r['uid'];				  
				  $id=$r['upid'];
				  $describe=$r['describer'];				  
				  $final.='<input type="hidden" id="'.$r['upid'].'" class="more_updater" name="'.$type.'">';
				  $sql_pic=mysql_query("select picture2 from users where uid='$uid'");
				  $fetch_pic=mysql_fetch_array($sql_pic);
	  
				  if($r['uid']==$uid2 && $type=='main')
					  {
						  $a=$a+1;
						  $final.= '<div id="more_updates" class="'.$uid2.$a.$d.'"><li  class="bar'.$r['upid'].'">';	
					  }
				  else
					  {
						  //$picy=small_pic($uid2);
						  $a=0;
						  $b=0;
						  if($c!=0)
							  {
								  $final.='<div class="more_updates_click" id="'.$uid2.'" " name="'.$c.'" value="'.$d.'">
								  <a style=font-size:15px>'.($c).' more Update(s) from</a>
								  </div>';
							  }
							  
						  $d=$d+1;
						  $final.= '<span class="bar'.$r['upid'].'">';
					  }
				  $final.= '<div class="delete_button">
							    <a id="'.$r['upid'].'" class="delete_update" style="margin-left:10px;">&Delta;</a>
							</div>
							
							<div id="update_from">
								<a href="#!/profile.php?uid='.$uid.'" onclick="scroll(0,0)" style=color:#009;>
									<img src='.$fetch_pic['picture2'].' width="52" height="52"  style="float:left;" id=profilep>
								</a>
								<div style="padding-top:0px; font-size:11px; padding-left:66px;">
									<a href="#!/profile.php?uid='.$uid.'" onclick="scroll(0,0)" style="color:#009;font-weight:bold;font-size:12px">'.$r['msg_from'].'</a>
									<font  color="#333">'.$r['category'].'</font><br>
								</div>
							</div>
							
							<div id="update">'.stripslashes(($r['msg'])).'</div>
							
							<div class="margin_box">
								<div style="color:#666; font-size:10px; margin-top:8px;margin-left:5px; float:left;">'.$r['time'].'</div>
							</div>
							</span>';
				  $c=$a;
				  
				  if($r['uid']==$uid2 && $type=='main')
					  {
						  $final.= '</div>';
					  }
				  //$picy=small_pic($uid);
				  if($r['uid']==$uid && $z==$tt && $c!=0 && $type=='main')
					  {
						  $final.='<div class="more_updates_click" id="'.$uid2.'" " name="'.$c.'" value="'.$d.'">
						  <a style=font-size:15px>'.($c).' more Update(s) from </a>
						  </div>';
					  }
				  $uid2=$r['uid'];
				  $z++;
			  }
		$final.='</div>';
		return $final;
	}

}

//$c=new iprofile_updates;
//$d=$c->updates_show('421327464','main',1);
//echo $d;
?>