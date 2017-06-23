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
	$token = TOKEN;
	$timestamp = $_GET['timestamp'];
	$nonce = $_GET['nonce'];
	$signature = $_GET['signature'];
	$echostr = $_GET['echostr'];
	
	if ($signatureObj->checkcheckSignature(TOKEN, $timestamp, $nonce, $signature)) {
		
		echo $echostr;
		exit;
	}
} else {

	// 接收消息
	
}
