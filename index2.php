<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Collapsible Message Panels</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	//hide message_body after the first one
	$(".message_list .message_body:gt(0)").hide();
	
	//hide message li after the 5th
	$(".message_list li:gt(4)").show();

	
	//toggle message_body
	$(".message_head").click(function(){
		$(this).next(".message_body").slideToggle(500)
		return false;
	});

	//collapse all messages
	$(".collpase_all_message").click(function(){
		$(".message_body").slideUp(500)
		return false;
	});

	//show all messages
	$(".show_all_message").click(function(){
		$(this).hide()
		$(".show_recent_only").show()
		$(".message_list li:gt(4)").slideDown()
		return false;
	});

	//show recent messages only
	$(".show_recent_only").click(function(){
		$(this).hide()
		$(".show_all_message").show()
		$(".message_list li:gt(4)").slideUp()
		return false;
	});

});
</script>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}
p {
	padding: 0 0 1em;
}
/* message display page */
.message_list {
	list-style: none;
	margin: 0;
	padding: 0;
	width:100%;
}
.message_list li {
	padding: 0;
	margin: 0;
}
.message_head {
	padding:0px;
	cursor: pointer;
	position: relative;
	background-image:url(themes/3.jpg);
	border-bottom:2px solid;
	border-right:1px double;
	border-left:1px double;
	font-size:12px;
	padding-left:2px;
}
.message_head .timestamp {
	color: #666666;
	font-size:10px;
}
.message_head cite {
	font-weight: bolder;
	font-style: normal;
}

.message_head cite:hover
{
	color:#00C;
	opacity:0.6;
}
.message_body {
	font-size:12px;
}
.collapse_buttons {
	text-align: right;
	border-top: solid 1px #e4e4e4;
	padding: 0px 0;
	width:100%;
}
.collapse_buttons a {

}
.show_all_message {
	float:left;
}
.show_recent_only {
	display: none;
	float:left;
}
.collpase_all_message {
	color: #666666;
}
</style>
</head>
<body>
<ol class="message_list">
	<li>
		<p class="message_head"><cite>Most Popular -</cite> <span class="timestamp">Network</span></p>
		<div class="message_body">
			<p>here the popular friends will come and those who are not ur friends also</p>
		</div>
	</li>
    	<li>
		<p class="message_head"><cite>iB-Marks -</cite> <span class="timestamp">Favourites</span></p>
		<div class="message_body">
			<p>Here the pages i like and those i visit often will come</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Horoscope -</cite><span class="timestamp"><?php include 'date.php' ?></span></p>
		<div class="message_body">
			<p>
				This is the latest message display. The rest are collapsed by default</p>
		</div>
	</li>
        	<li>
		<p class="message_head"><cite>Sponsored Results -</cite> <span class="timestamp">Ads</span></p>
		<div class="message_body">
			<p>Here results according to your info will appear.This will be important for generation of income as well as expansion of web.</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Daily Analyzer -</cite> <span class="timestamp">Personal</span></p>
		<div class="message_body">
			<p>This gives you your daily routine in the basis of what you do everyday and show you how to analyze your routine</p>
		</div>
	</li>	<li>
		<p class="message_head"><cite>Most Popular -</cite> <span class="timestamp">Network</span></p>
		<div class="message_body">
			<p>here the popular friends will come and those who are not ur friends also</p>
		</div>
	</li>
    	<li>
		<p class="message_head"><cite>iB-Marks -</cite> <span class="timestamp">Favourites</span></p>
		<div class="message_body">
			<p>Here the pages i like and those i visit often will come</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Horoscope -</cite><span class="timestamp"><?php include 'date.php' ?></span></p>
		<div class="message_body">
			<p>
				This is the latest message display. The rest are collapsed by default</p>
		</div>
	</li>
        	<li>
		<p class="message_head"><cite>Sponsored Results -</cite> <span class="timestamp">Ads</span></p>
		<div class="message_body">
			<p>Here results according to your info will appear.This will be important for generation of income as well as expansion of web.</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Daily Analyzer -</cite> <span class="timestamp">Personal</span></p>
		<div class="message_body">
			<p>This gives you your daily routine in the basis of what you do everyday and show you how to analyze your routine</p>
		</div>
	</li>	<li>
		<p class="message_head"><cite>Most Popular -</cite> <span class="timestamp">Network</span></p>
		<div class="message_body">
			<p>here the popular friends will come and those who are not ur friends also</p>
		</div>
	</li>
    	<li>
		<p class="message_head"><cite>iB-Marks -</cite> <span class="timestamp">Favourites</span></p>
		<div class="message_body">
			<p>Here the pages i like and those i visit often will come</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Horoscope -</cite><span class="timestamp"><?php include 'date.php' ?></span></p>
		<div class="message_body">
			<p>
				This is the latest message display. The rest are collapsed by default</p>
		</div>
	</li>
        	<li>
		<p class="message_head"><cite>Sponsored Results -</cite> <span class="timestamp">Ads</span></p>
		<div class="message_body">
			<p>Here results according to your info will appear.This will be important for generation of income as well as expansion of web.</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Daily Analyzer -</cite> <span class="timestamp">Personal</span></p>
		<div class="message_body">
			<p>This gives you your daily routine in the basis of what you do everyday and show you how to analyze your routine</p>
		</div>
	</li>	<li>
		<p class="message_head"><cite>Most Popular -</cite> <span class="timestamp">Network</span></p>
		<div class="message_body">
			<p>here the popular friends will come and those who are not ur friends also</p>
		</div>
	</li>
    	<li>
		<p class="message_head"><cite>iB-Marks -</cite> <span class="timestamp">Favourites</span></p>
		<div class="message_body">
			<p>Here the pages i like and those i visit often will come</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Horoscope -</cite><span class="timestamp"><?php include 'date.php' ?></span></p>
		<div class="message_body">
			<p>
				This is the latest message display. The rest are collapsed by default</p>
		</div>
	</li>
        	<li>
		<p class="message_head"><cite>Sponsored Results -</cite> <span class="timestamp">Ads</span></p>
		<div class="message_body">
			<p>Here results according to your info will appear.This will be important for generation of income as well as expansion of web.</p>
		</div>
	</li>
	<li>
		<p class="message_head"><cite>Daily Analyzer -</cite> <span class="timestamp">Personal</span></p>
		<div class="message_body">
			<p>This gives you your daily routine in the basis of what you do everyday and show you how to analyze your routine</p>
		</div>
	</li>

	</ol>
