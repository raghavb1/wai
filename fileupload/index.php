<link href="fileupload/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="fileupload/uploadify/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="fileupload/uploadify/swfobject.js"></script>
<script type="text/javascript" src="fileupload/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">
  $('#file_upload').uploadify({
    'uploader'  : 'fileupload/uploadify/uploadify.swf',
	'multi' 	: true, 
    'script'    : 'fileupload/uploadify/uploadify.php',
    'cancelImg' : 'fileupload/uploadify/cancel.png',
	'fileExt'   : '*.jpg;*.gif',
	'fileDesc'    : 'Image Files',
	'queueSizeLimit' : 80,
	'onAllComplete' : function(event,data) {
var dataString="album_id=<?php echo $aid ?>&user_id=<?php echo $_SESSION['uid']; ?>";
$.ajax({
type: "POST",
 url: "request.php",
  data: dataString,
 cache: false,
 success: function(html){
window.location.href='#!/album.php?aid=<?php echo $aid ?>&v=1';
 }
});
    },
	'scriptData'  : {'uid':'<?php echo $_SESSION['uid']; ?>','aid':'<?php echo $aid; ?>'},
    'auto'      : true
  });
</script>
<input id="file_upload" name="file_upload" type="file" />