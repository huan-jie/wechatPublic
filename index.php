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

	// 接收消息，微信服务器会post xml类型的数据过来
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	if (!empty($postStr)) {

		include("reciveMessageClass.php");
		include("responseMessageClass.php");

		$reciveMessageObj = new reciveMessageClass($postStr);
		$reciveMessageObj->judgeMessageType();

		$responseMessageObj = new responseMessageClass($reciveMessageObj->toUserName, $reciveMessageObj->fromUserName, $reciveMessageObj->msgType, $reciveMessageObj->resultContent);
		$responseMessageObj->responseUser();
	}

}
