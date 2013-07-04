<?php

include 'db.php';

session_start();

$_SESSION['username']=$_SESSION['uid'];
if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { sendChat(); } 
if ($_GET['action'] == "closechat") { closeChat(); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 

if (!isset($_SESSION['chatHistory'])) {
	$_SESSION['chatHistory'] = array();	
}

if (!isset($_SESSION['openChatBoxes'])) {
	$_SESSION['openChatBoxes'] = array();	
}
function sanitize($text) {
	$text = htmlspecialchars($text);
		$text = addslashes($text);
	return $text;
}

function chatHeartbeat() {
	
	$sql = "select * from chat where (chat.to = '".mysql_real_escape_string($_SESSION['username'])."' AND recd = 0) order by id ASC";
	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}

		$chat['message'] = sanitize($chat['message']);
$chatter=$chat['from'];
$pic_q=mysql_query("select picture2,firstname,lastname from users where uid='$chatter'");
$pic_r=mysql_fetch_array($pic_q);
$ichat=$pic_r['picture2'];
$ichat2=$pic_r['firstname'].' '.$pic_r['lastname'];
		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"i": "{$ichat}",
			"n": "{$ichat2}",						
			"m": "{$chat['message']}"
	   },
EOD;
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}
	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"i": "{$ichat}",
			"n": "{$ichat2}",						
			"m": "{$chat['message']}"
	   },
EOD;
		

		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			//$message = "Sent at $time";

			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"i": "{$ichat}",
"n": "{$ichat2}",	
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"i": "{$ichat}",
"n": "{$ichat2}",	
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($_SESSION['username'])."' and recd = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}
	$chatter=$_SESSION['uid'];
$pic_q=mysql_query("select picture2,firstname,lastname from users where uid='$chatter'");
$pic_r=mysql_fetch_array($pic_q);
$ichat=$pic_r['picture2'];
$ichat2=$pic_r['firstname'].' '.$pic_r['lastname'];
header('Content-type: application/json');

?>
{
		"username": "<?php echo $ichat;?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}

function sendChat() {
	$from = $_SESSION['username'];
	$to = $_POST['to'];
	$message = $_POST['message'];

	$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
		$_SESSION['chatHistory'][$_POST['to']] = '';
	}
		$chatter=$chat['to'];
$pic_q=mysql_query("select picture2,firstname,lastname from users where uid='$chatter'");
$pic_r=mysql_fetch_array($pic_q);
$ichat=$pic_r['picture2'];
$ichat2=$pic_r['firstname'].' '.$pic_r['lastname'];
	$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"i": "{$ichat}",
			"n": "{$ichat2}",						
			"m": "{$messagesan}"
	   },
EOD;

	unset($_SESSION['tsChatBoxes'][$_POST['to']]);


	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
	$query = mysql_query($sql);
	echo "1";
	exit(0);
}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

