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
				$responseMessageObj->responseText($reciveMessageObj->content);
				break;
			case 'image':
				// 图片
				break;
			case 'voice':
				// 语音
				break;
			case 'video':
				// 视频
				break;
			case 'shortvideo':
				// 小视频		
				break;
			case 'location':
				// 位置
				break;
			case 'link':
				// 链接
				break;
			case 'event':
				// 事件
				switch ($event) {
					case 'subscribe':
						// 关注

						break;
					case 'unsubscribe':
						// 取消关注
					
						break;
					case 'SCAN':
						// 扫描
					
						break;
					case 'LOCATION':
						// 上报地理位置
					
						break;
					case 'CLICK':
						// 点击菜单拉取消息
					
						break;
					case 'VIEW':
						// 点击菜单跳转链接
					
						break;
					default:
						# code...
						break;
				}
				break;
			default:
				break;
		}
	} else {

		echo "empty data";
	}

}
