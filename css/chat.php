<style>
.chatbox {
	position: fixed;
	position:expression("absolute");
	width: 225px;
	display:none;
}

.chatboxhead {

	padding:5px;
	border-left:1px double #999;
	border-right:1px double #999;
	border-top:1px double #999;	
	color:#000;
	}

.chatboxblink {
	background-color: #176689;
	border-left:1px double #999;
	border-right:1px double #999;
}

.chatboxcontent {
	font-family: arial,sans-serif;
	font-size: 13px;
	color: #333333;
	height:220px;
	width:209px;
	overflow-y:auto;
	overflow-x:auto;
	padding:7px;
	border-left:1px double #999;
	border-right:1px double #999;
	background-color:#FFF;
	line-height: 1.3em;
}

.chatboxinput {
	padding: 5px;
	background-image:url(themes/<?php echo  $_SESSION['theme'];?>);	
	border-left:1px double #999;
	border-right:1px double #999;
}

.chatboxtextarea {
	width: 206px;
	height:44px;
	padding:3px 0pt 3px 3px;

	border-left:1px double #999;
	border-right:1px double #999;

	margin: 1px;
	overflow:hidden;
}

.chatboxtextareaselected {
	margin:0;
}

.chatboxmessage {
	margin-left:1em;
	font-size:12px;
	padding-bottom:5px;
	padding-left:0px;
}

.chatboxinfo {

	color:#666666;

}

.chatboxmessagefrom {
	margin-left:-1em;
	font-weight: bold;
}

.chatboxmessagecontent {
}

.chatboxoptions {
	float: right;
	font-size:14px;
}

.chatboxoptions a {
	text-decoration: none;
	color: #000;
	font-weight:bold;
}

.chatboxtitle {
	float: left;
}
</style>