<?php
if(defined( 'parentFile' ))
{
?>		<style type="text/css" media="screen">
			#list{
				margin:0 auto;
				height:150px;
				width:50px;
				position:relative;
			}
			#list ul,
			#list li{
				list-style:none;
				margin:0;
				padding:0;
			}
			#list a{
				position:absolute;
				text-decoration: none;
				color: #000;
			}
			#list a:hover{
				color:#00C;
			}
		</style>

		
		<div id="list">
			<ul>
				<li><a href="#">Collegues</a></li>
				<li><a href="#">MyMates</a></li>
				<li><a href="#">PartTime</a></li>
				<li><a href="#">Proffesion</a></li>
				<li><a href="#">GroupBuddies</a></li>
				<li><a href="#">Relatives</a></li>
				<li><a href="#">Common</a></li>
			
			</ul>
		</div>

<script type="text/javascript">


$(document).ready(function(){
	
	var element = $('#list a');;
	var offset = 0; 
	var stepping = 0.02 ;
	var list = $('#list');
	var $list = $(list)
	
	$list.mousemove(function(e){
		var topOfList = $list.eq(0).offset().top
		var listHeight = $list.height()
		stepping = (e.clientY - topOfList) /  listHeight * 0.2 - 0.1;
		
	});
	

	for (var i = element.length - 1; i >= 0; i--)
	{
		element[i].elemAngle = i * Math.PI * 2 / element.length;
	}
	
	
	setInterval(render, 40);
	
	
	function render(){
		for (var i = element.length - 1; i >= 0; i--){
			
			var angle = element[i].elemAngle + offset;
			
			x = 100 + Math.sin(angle) * 0;
			y = 45 + Math.cos(angle) * 40;
			size = Math.round(15 - Math.sin(angle) * 12);
			
			var elementCenter = $(element[i]).width() / 2;
	
			var leftValue = (($list.width()/2) * x / 100 - elementCenter) + "px"
	
			$(element[i]).css("fontSize", size + "pt");
			$(element[i]).css("opacity",size/70);
			$(element[i]).css("zIndex" ,size);
			$(element[i]).css("left" ,leftValue);
			$(element[i]).css("top", y + "%");
		}
		
		offset += stepping;
	}
	
	
});


</script>
<?php } ?>