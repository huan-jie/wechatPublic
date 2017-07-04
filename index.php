<?php
/**
  * create by nhj, 2017-06-23
  * 微信公众号
  */

require("signatureClass.php");
require("reciveMessageClass.php");
require("responseMessageClass.php");

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

		// 解析用户发送的内容
		$reciveMessageObj = new reciveMessageClass($postStr);
		$reciveMessageObj->judgeMessageType();

		// 实例回复用户消息类
		$responseMessageObj = new responseMessageClass($reciveMessageObj->toUserName, $reciveMessageObj->fromUserName, $reciveMessageObj->msgType, $reciveMessageObj->resultContent);

		// 对不同的事件做自定义处理
		switch ($reciveMessageObj->msgType) {
			case 'text':
				// 文字
				$responseMessageObj->responseText('hello world');
				break;
			
			default:
				break;
		}
	} else {

		echo "empty data";
	}

}
