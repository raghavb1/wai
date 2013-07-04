 <?php 
 error_reporting(0);
session_start();
if(isset($_SESSION['email']) && isset($_SERVER['HTTP_REFERER']))
{
	if(isset($_GET['pid']) && isset($_GET['w']) && isset($_GET['h']) && isset($_GET['thumb'])  && isset($_GET['rand']))
	{if($_GET['rand']==$_SESSION['rand']){
		$_SESSION['rand']=mt_rand();
?><script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript">
function preview(img, selection) { 
	var scaleX = <?php echo '72';?> / selection.width; 
	var scaleY = <?php echo '72'?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $_GET['w'];?>) + 'px', 
		height: Math.round(scaleY * <?php echo $_GET['h']?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 
 
	$('#save_thumb').live("click",function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			$(this).hide();
			return true;
		}
	});


	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview }); 

</script>

<script>

	 $("#album_name").Watermark("Create New Album");
	 $('.sidebarmenu').hide();
	 $('#changer').hide();
	 $('.content').css("width","775px");
 	 $('.content').css("margin-left","-195px");	 

	 </script>    

		<div class="topic">Create Thumbnail</div>
                            <div class="final_loader" style="width:700px; float:left; text-align:center">Select Area You Want to make as thumbnail</div>
        			<form name="thumbnail" action="picscaler.php" method="post" style="float:left">
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
				<input type="hidden" name="orig_img" value="<?php echo $_GET['pid']?>" /> 
            	<input type="hidden" name="thumb_img" value="<?php echo $_GET['thumb']?>" />                
				<input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" style="float:left;width:700px; font-size:16px; height:24px; text-align:center" />
			</form>
		<div align="center" style="width:700px; background-color:#f2f2f2">
			<center><img src="<?php echo $_GET['pid']?>" id="thumbnail" alt="Create Thumbnail" /></center>
<!--			<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:72px; height:72px;">
				<img src="<?php //echo $_GET['pid']?>" style="position: relative;" alt="Thumbnail Preview" id="profilep" />
			</div>-->

		</div>

<?php
	}
}else{
	?><script>
	$('#mybut').live("click",function(){
	$('#mybut').hide();
	$('#mybut2').html('Uploading');	
	});
	</script>
	<div align="left" style="width:480px; padding:10px;\">
    <img src="<?php echo $_SESSION['picture'] ?>" style="float:left; margin-bottom:10px" />
<div style="float:left"> <form method="post" action="picscaler.php" enctype="multipart/form-data" name="form1">
  <input size="25" name="file" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt" class="box"/><br />
<input type="submit" id="mybut" value="       Upload        " name="Submit" style="margin-top:4px;"/><div id="mybut2" style="font-size:15px"></div>
 </form>
 </div>
</div>




<?php
	}
}
else{
header("location:#!/main.php");	
}
?>