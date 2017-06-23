<?php
/**
  * create by nhj, 2017-06-23
  * 微信公众号回复消息类
  */


class responseMessageClass
{
	// 接收和发送的时候toUserName、fromUserName是相反的
	// 这里采用reciveMessageClass中的结果赋值，在使用时需注意
	public $toUserName;
	public $fromUserName;
	public $createTime;
	public $msgType;
	public $resultContent;	

	function __construct($toUserName, $fromUserName, $createTime, $msgType, $resultContent)
	{
		$this->toUserName = $fromUserName;
		$this->fromUserName = $toUserName;
		$this->createTime = $createTime;
		$this->msgType = $msgType;
		$this->esultContent = $resultContent;
	}

	// 关于多媒体类型的数据，需要再设计
	public function responseUser()
	{
		switch ($this->msgType) {
			case 'text':
				// 文字
				$responseStr = sprintf("<xml>
										<ToUserName><![CDATA[%s]]></ToUserName>
										<FromUserName><![CDATA[%s]]></FromUserName>
										<CreateTime>%s</CreateTime>
										<MsgType><![CDATA[text]]></MsgType>
										<Content><![CDATA[%s]]></Content>
										</xml>", $this->toUserName, $this->fromUserName, time(), $this->esultContent);
				echo $responseStr;
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
			case 'music':
				// 小视频

				break;
			case 'news':
				// 位置

				break;
			default:
				
				break;
		}
	}
	
}