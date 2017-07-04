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
				$content = $reciveMessageObj->content;		// 文字内容，可自定义处理。如根据内容回复不同消息

				$responseMessageObj->responseText($content);
				break;
			case 'image':
				// 图片
				$mediaId = $reciveMessageObj->mediaId;
				$picUrl = $reciveMessageObj->picUrl;

				$responseMessageObj->responseImage($mediaId);
				break;
			case 'voice':
				// 语音
				$mediaId = $reciveMessageObj->mediaId;
				$format = $reciveMessageObj->format;
				$recognition = $reciveMessageObj->recognition;

				$responseMessageObj->responseVoice($mediaId);
				break;
			case 'video':
				// 视频
				$mediaId = $reciveMessageObj->mediaId;
				$thumbMediaId = $reciveMessageObj->thumbMediaId;

				$responseMessageObj->responseText(sprintf('mediaId:%s, thumbMediaId:%s', $mediaId, $thumbMediaId));
				// $responseMessageObj->responseVideo($mediaId);
				break;
			case 'shortvideo':
				// 小视频	
				$mediaId = $reciveMessageObj->mediaId;
				$thumbMediaId = $reciveMessageObj->thumbMediaId;

				$responseMessageObj->responseText(sprintf('mediaId:%s, thumbMediaId:%s', $mediaId, $thumbMediaId));
				// $responseMessageObj->responseVideo($mediaId);	
				break;
			case 'location':
				// 位置
				$locationX = $reciveMessageObj->locationX;
				$locationY = $reciveMessageObj->locationY;
				$scale = $reciveMessageObj->scale;
				$label = $reciveMessageObj->label;

				$responseMessageObj->responseText(sprintf("纬度：%s；经度：%s；地图缩放：%s；地理位置信息：%s。", $locationX, $locationY, $scale, $label));
				break;
			case 'link':
				// 链接
				$title = $reciveMessageObj->title;
				$description = $reciveMessageObj->description;
				$url = $reciveMessageObj->url;

				$responseMessageObj->responseText(sprintf("标题：%s；详情描述：%s；URL：%s。", $title, $description, $url));
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
