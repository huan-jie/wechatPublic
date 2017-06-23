<?php
/**
  * create by nhj, 2017-06-23
  * 微信公众号接收消息类
  */


class reciveMessageClass
{
	public $postStr;
	public $toUserName;
	public $fromUserName;
	public $createTime;
	public $msgType;
	public $resultContent;		// 返回结果，多媒体类型的再说吧

	function __construct($postStr)
	{
		$this->postStr = $postStr;
	}

	/*判断消息类型*/
	public function judgeMessageType()
	{
		// 解析xml数据至对象
		$postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		// 根据MsgType确定消息类型
		$msgType = trim($postObj->MsgType);

		// 记录公共参数
		$this->toUserName = trim($postObj->ToUserName);
		$this->fromUserName = trim($postObj->FromUserName);
		$this->createTime = trim($postObj->CreateTime);
		$this->msgType = trim($postObj->MsgType);

		switch ($msgType) {
			case 'text':
				// 文字
				$this->resultContent = trim($postObj->Content);
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
				$event = trim($postObj->Event);
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
				$result = "unknown msgtype: ". $msgType;
				break;
		}
	}

}
