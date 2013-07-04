<?php
include 'db.php';
include 'scripts.php';

class iprofile_message
{
	function message_send($uid)
	{
		$message_send='';
		$pic_query=mysql_query("select picture,firstname,lastname from users where uid='$uid'"); 
		$pic_result=mysql_fetch_array($pic_query);
		$message_send.='<div class="message_send" style="width:500px">
						<table border="0"><tr><td>To : </td><td>'.$pic_result['firstname'].'&nbsp;'.$pic_result['lastname'].'</td></tr>';
						
		$message_send.='<tr><td>Subject :</td><td> <input type="text" style="width:400px" id="message_subject"></td></tr>';
		
		$message_send.='<tr><td>Message :</td><td> <textarea style="width:400px; height:100px" id="message_message"></textarea></td></tr>';
		
		$message_send.='<tr><td><input type="submit" id="message_submit" name='.$uid.'></td></tr></table>
		
						</div>';
		return $message_send;
	}
	
		function message_show($uid)
	{
		$messageq=mysql_query("select * from messages where rec='$uid' and type='m' order by sno desc");
		$message_count=mysql_num_rows($messageq);
		if($message_count!=0)
			{
				$message_show='';
				while($messager=mysql_fetch_array($messageq))
					{
						$sender_id=$messager['sender'];
						$sender_info=mysql_query("select firstname,lastname,picture2,uid from users where uid='$sender_id'");
						$sender=mysql_fetch_array($sender_info);
						$message_show.='
									   <div class="alldesc">
										<div class="desc_pic">
											<a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;>
												<img src='.$sender['picture2'].' id="profilep" width=52 height=52>
											</a>
										</div>
									   <div class="desc_from">
									   	<a href="#!/profile.php?uid='.$sender['uid'].'" onclick="scroll(0,0)" style=color:#00C;>'.$sender['firstname'].'&nbsp;'.$sender['lastname'].'			                                        </a>
									   </div><br>
									   <div class="desc_content" style="width:90%; margin-left:63px;">'.stripslashes($messager['message']).'</div>
									   <div id="message_reply_response'.$messager['mid'].'"></div>
									   <div style="float:right;font-size:13px;background-image:url(themes/53.jpg);padding:5px  ">
									   	<a href="#!/message.php?mid='.$messager['mid'].'">View Full Conversation</a>
									   </div>
									   </div>
									   ';	
					}
			}
		return $message_show;
	}
	
		function message_delete($uid)
	{
		$message_send='';
		$pic_query=mysql_query("select picture,firstname,lastname from users where uid='$uid'"); 
		$pic_result=mysql_fetch_array($pic_query);
		$message_send.='<div class="message_send" style="width:500px">
						<table border="0"><tr><td>To : </td><td>'.$pic_result['firstname'].'&nbsp;'.$pic_result['lastname'].'</td></tr>';
						
		$message_send.='<tr><td>Subject :</td><td> <input type="text" style="width:400px" id="message_subject"></td></tr>';
		
		$message_send.='<tr><td>Message :</td><td> <textarea style="width:400px; height:100px" id="message_message"></textarea></td></tr>';
		
		$message_send.='<tr><td><input type="submit" id="message_submit" name='.$uid.'></td></tr></table>
		
						</div>';
		return $message_send;
	}

}

$c=new iprofile_message;
$d=$c->message_show('421327464');
echo $d;
?>