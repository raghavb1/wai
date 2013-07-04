<?php
include 'db.php';
include 'scripts.php';
session_start();

class iprofile_functions
{
	function function_cleaner($value)
		{
			$value=htmlspecialchars($value);
			$value=addslashes($value);
			$value=str_replace("\n\n","",$value);
			$value=str_replace("\n","<br />",$value);
			return $value;

		}

	function function_curly($url)
		{
			$user_agent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url); 
			curl_setopt($ch, CURLOPT_HEADER, 1); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_FILETIME, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $user_agent); 
			$data = curl_exec($ch);	
			curl_close($ch);
			return $data;
		}

	function function_small_pic($uid)
		{
			$sql_pic=mysql_query("select picture2,firstname,lastname from users where uid='$uid'");
			$fetch_pic=mysql_fetch_array($sql_pic);
			$s->pic='<a href="#!/profile.php?uid='.$uid.'">
						<img src="'.$fetch_pic['picture2'].'" width="64" height="64" style="float:left; margin-right:5px; margin-bottom:0px" id="profilep"/>
					</a>';
					
			$s->name='<a href="#!/profile.php?uid='.$uid.'">
			
						<font color="#0000CC" style="float:left">'.$fetch_pic['firstname'].' '.$fetch_pic['lastname'].'</font>
						
					  </a>
					 ';
					  
			$s->whole=$s->pic.$s->name;
			return $s;	
	 
 		}
		
	function smiley($msg) 
		{
			$msg = str_replace(":)","<img src=smileys/smile.jpg>", $msg); 
			$msg = str_replace(":p","<img src=smileys/tongue.gif>", $msg); 
			$msg = str_replace("<3","<img src=smileys/heart.jpg>", $msg);
			$msg = str_replace("<(\")","<img src=smileys/penguin.gif>", $msg);
			$msg = str_replace("(^^^)","<img src=smileys/shark.jpg>", $msg);
			$msg = str_replace(":D","<img src=smileys/laugh.jpg>", $msg);
			$msg = str_replace("^_^","<img src=smileys/heyes.gif>", $msg);
			$msg = str_replace(">:o","<img src=smileys/leyes.gif>", $msg);
			$msg = str_replace(":3","<img src=smileys/catsmile.jpg>", $msg);
			$msg = str_replace(">:-(","<img src=smileys/grumpy.gif>", $msg);
			$msg = str_replace(":(","<img src=smileys/sad.gif>", $msg);
			$msg = str_replace(":o","<img src=smileys/shocked.jpg>", $msg);
			$msg = str_replace("8)","<img src=smileys/glasses.jpg>", $msg);
			$msg = str_replace("8-|","<img src=smileys/shades.gif>", $msg);
			$msg = str_replace("O.o","<img src=smileys/woot.gif>", $msg);	  	  	  	  	  	  	  	  	  		  	    	  	   	  	  	   
			$msg = str_replace("-_-","<img src=smileys/dork.jpg>", $msg);
			$msg = str_replace(":*","<img src=smileys/kiss.jpg>", $msg);
			$msg = str_replace(":v","<img src=smileys/pacman.jpg>", $msg);
			$msg = str_replace(":|]","<img src=smileys/robot.jpg>", $msg);
			$msg = str_replace(": putnam:","<img src=smileys/wierd.jpg>", $msg);	  	  	  	  	  	  	  	  	  	  	  	  	  		  	    	  	   	  	  	   	  
			return $msg; 
		 }
	 
	 function text_link($msg)
		 {
			$msg=preg_replace("/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i","<a href=$1 target=_blank style=color:#00C>$1</a>",$msg);
			return $msg;	 
	 	 }

	function getMetaTitle($content)
		{
			$pattern = "|<[\s]*title[\s]*>([^<]+)<[\s]*/[\s]*title[\s]*>|Ui";
			if(preg_match($pattern, $content, $match))
				return $match[1];
			else
				return false;
		}
	function function_changer($uid)
		{
			 $pic_query=mysql_query("select picture,firstname,lastname,picture2 from users where uid='$uid'"); 
 
 $pic_result=mysql_fetch_array($pic_query);
			?>
                <script type="text/javascript">
				document.onkeyup=
				function displayunicode(e)
					{
						var unicode=e.keyCode? e.keyCode : e.charCode
						if(unicode==37)
							{
								
							}
						if(unicode==39)
							{
		
							}
					}
				</script>
 				<script>
				   $('.sidebarmenu').show();
				   $('#changer').show();
				   $('.content').css("width","580px");
				   $('.content').css("margin-left","0px");
				</script> 
				<?php
				if($uid!=$_SESSION['uid'])
					{
						$user=$_SESSION['uid'];
 				?>
 
				<script>
  				 $('#changer').html("<?php echo '<table><tr><td><a href=#!/profile.php?uid='.$uid.'><img src='.$pic_result['picture'].' title='.$pic_result['firstname'].'&nbsp;'.							                                           $pic_result['lastname'].'></a></td></tr></table>'?><div style=font-weight:bold align=center><?php echo $pic_result['firstname'].'&nbsp;'.                                           $pic_result['lastname']
				                      ?></div>").fadeIn("fast");
				 	$.ajax({
					type: "POST",
					url: 'left_profile.php',
					data: 'uid=<?php echo $uid;?>',
					cache: false,
					success: function(html)
						{
							$(".sidebarmenu").html(html);
				  			document.title = "<?php  echo $pic_result['firstname'].' '.$pic_result['lastname'] ?> | iProfile";
						}
			  			  });

				</script>
                <?php
		 }
		 else
			{
			?>
				<script>  
   				$('#changer').html("<?php echo '<table><tr><td><a href=#!/profile.php?uid='.$uid.'><img src='.$pic_result['picture'].' title='.                                          $pic_result['firstname'].'&nbsp;'.$pic_result['lastname'].'></td></a></tr></table>'?><div style=font-weight:bold align=center><?php echo                                           $_SESSION['fname'] ?></div>").fadeIn("fast");
  				$(".sidebarmenu").load('left.php');   
				 </script>
			<?php 
			}
		
		}
		
}
echo '<div id="changer">gg</div>';
$c=new iprofile_functions;
$d=$c->function_changer('421327464');
//echo 'gggg'.$d;
?>