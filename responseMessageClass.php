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
	public $msgType;
	public $resultContent;	

	function __construct($toUserName, $fromUserName, $msgType, $resultContent)
	{
		$this->toUserName = $fromUserName;
		$this->fromUserName = $toUserName;
		$this->msgType = $msgType;
		$this->resultContent = $resultContent;
	}

	// 关于多媒体类型的数据，需要再设计
	public function responseUser()
	{
		// 根据用户发送的消息，向用户回复不同的内容
		switch ($this->msgType) {
			case 'text':
				// 文字
				$responseStr = $this->responseStr($this->resultContent);
				echo $responseStr;
				break;
			case 'image':
				// 图片
				$responseStr = $this->responseImage($this->resultContent);
				echo $responseStr;
				break;
			case 'voice':
				// 语音
				$responseStr = $this->responseVoice($this->resultContent);
				echo $responseStr;
				break;
			case 'video':
				// 视频
				$responseStr = $this->responseVideo($this->resultContent);
				echo $responseStr;
				break;
			case 'music':
				// 音乐

				break;
			case 'news':
				// 图文

				break;
			default:
				
				break;
		}
	}

	private responseText($textContent)
	{
		$responseStr = sprintf("<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[text]]></MsgType>
								<Content><![CDATA[%s]]></Content>
								</xml>", $this->toUserName, $this->fromUserName, time(), $textContent);
		return $responseStr;
	}

	private responseImage($imageMediaId)
	{
		$responseStr = sprintf("<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[image]]></MsgType>
								<Image>
								<MediaId><![CDATA[%s]]></MediaId>
								</Image>
								</xml>", $this->toUserName, $this->fromUserName, time(), $imageMediaId);
		return $responseStr;
	}

	private responseVoice($voiceMediaId)
	{
		$responseStr = sprintf("<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[voice]]></MsgType>
								<Voice>
								<MediaId><![CDATA[%s]]></MediaId>
								</Voice>
								</xml>", $this->toUserName, $this->fromUserName, time(), $voiceMediaId);
		return $responseStr;
	}

	private responseVideo($videoMediaId, $videoTitle='', $videoDescription='')
	{
		$responseStr = sprintf("<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[video]]></MsgType>
								<Video>
								<MediaId><![CDATA[%s]]></MediaId>
								<Title><![CDATA[%s]]></Title>
								<Description><![CDATA[%s]]></Description>
								</Video> 
								</xml>", $this->toUserName, $this->fromUserName, time(), $videoMediaId, $videoTitle, $videoDescription);
		return $responseStr;
	}

	private responseMusic()
	{

	}

	private responseNews()
	{

	}
	
}