<?php
/**
  * create by nhj, 2017-06-23
  * 微信公众号
  */

require("signatureClass.php");

// define custom token
define("TOKEN", "nahuanjie");

if (isset($_GET['echostr'])) {
	
	// 验证签名
	$signatureObj = new signatureClass();
	$echostr = $_GET['echostr'];
	
	if ($signatureObj->checkSignature(TOKEN, $_GET['timestamp'], $_GET['nonce'], $_GET['signature'])) {
		
		echo $echostr;
		exit;
	}
} else {

	// 接收消息

}
