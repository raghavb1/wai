<script type="text/javascript" src="js/jquery.watermarkinput.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$(".search").keyup(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;

if((searchbox==''))
{
$("#display").html(html).hide();
}
else
{

$.ajax({
type: "POST",
url: "univtest.php",
data: dataString,
cache: false,
success: function(html)
{

$("#display").html(html).show();
	
	
	}




});
}return false;    


});
});

jQuery(function($){
   $("#searchbox").Watermark("Search:");
   });
</script>
<style type="text/css">
#searchbox
{
width:200px;
}
#display
{
width:203px;
display:none;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
position:fixed;x
}
.display_box
{
padding:4px; border-top:solid 1px #dedede; font-size:12px; height:30px;
background: #FFF;
;
}

.display_box:hover
{
background:#3b5998;
color:#FFFFFF;
}



</style>
<div>
<input type="text" class="search" id="searchbox" /><br />
<div id="display">
</div>
</div>
