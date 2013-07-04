<?php
include 'db.php';
include 'scripts.php';

class iprofile_comments
{
	
	
	function comment_show($upid,$uuid,$describe,$count)
		{
			$com_query=mysql_query("select * from comment where id='$upid'");
			$com_count=mysql_num_rows($com_query);
			$com_count=$com_count-$count;
			$com_select=mysql_query("select * from comment where id='$upid' limit $com_count,$count");
			$final='<div id="all_comment'.$upid.'"><div id="main_comment_box'.$upid.'">';
			$new_comment_show=new iprofile_comments;
			if($com_count>2)
				{
					$final.= '<div align="center" style="width:100%; background-color:#F2F2F2; padding:3px; float:left; margin-bottom:2px">
									<a class="view_all" id="'.$upid.'">View All  ('.$com_count.')</a>
							  </div>';	
				}
			while($com_show=mysql_fetch_array($com_select))
				{
					$sender=$com_show['sender'];
					$sql_pic=mysql_query("select picture2 from users where uid='$sender'");
					$fetch_pic=mysql_fetch_array($sql_pic);
					$final.=$new_comment_show->comment_show_html($com_show['cid'],$com_show['comment'],$uuid,$fetch_pic['picture2'],$com_show['sender']);
				}
			$final.='
					  </div>
					  <div class=panel id="slidepanel'.$upid.'">
						  <textarea class="comment_input" id="textboxcontent'.$upid.'" name="'.$upid.'" ></textarea>
						  <div style="font-size:9px;float:left;width:100%">Press \'\\\' to break a line&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Press enter to comment</div>
						  <input type="hidden" class="comment_hidden'.$upid.'" id="'.$uuid.'" />
						  <input type="hidden" class="comment_category'.$upid.'" id="'.$describe.'" />
					  </div>
					  <div id=comment>
					  	  <img src="logo/comment.png" width="10px" height="12px" style="float:left; margin-top:2px">&nbsp;
					  	  <a id="'.$upid.'"  class="comment_buttonef">iComment</a>&nbsp;| &nbsp;
					  	  <img src="logo/vote.png" width="10px"><a href="#" class="love" id="'.$upid.'" name="'.$uuid.'"> Vote </a>
					  </div></div>
							  
							';
return $final;
}

	
	
	
	function comment_show_html($cid,$comment,$uuid,$picture,$sender)
	{
				
		$a= ' 
			  <div class="load_comment" id="comment_load'.$cid.'">
				  <div align="left"><div class="delete_button">
					  <a id="'.$cid.'" class="delete_comment" name="'.$uuid.'">&Omega;</a>
				  </div>
			  </div>
			  <a href="#!/profile.php?uid='.$sender.'" onclick="scroll(0,0)" style=color:#00C;>
			  <img src="'.$picture.'" width=32px height=32px id=profilep style="float:left">
			  </a>'.($comment)
			  
			 ;
		  			
		return $a;		
	}
	
	
}

$c=new iprofile_comments;
$d=$c->comment_show('6851721768445553261678985856','87655908118790377881912858517','dd',2);
echo $d;
?>