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

	public function responseText($textContent)
	{
		$responseStr = sprintf("<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[text]]></MsgType>
								<Content><![CDATA[%s]]></Content>
								</xml>", $this->toUserName, $this->fromUserName, time(), $textContent);
		echo $responseStr;
		return;
	}

	public function responseImage($imageMediaId)
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
		echo $responseStr;
		return;
	}

	public function responseVoice($voiceMediaId)
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
		echo $responseStr;
		return;
	}

	public function responseVideo($videoMediaId, $videoTitle='no title', $videoDescription='no description')
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
		echo $responseStr;
		return;
	}

	public function responseMusic($musicMediaId, $musicTitle, $musicDescription, $musicUrl, $HDMusicUrl)
	{
		$responseStr = sprintf("<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[music]]></MsgType>
								<Music>
								<Title><![CDATA[%s]]></Title>
								<Description><![CDATA[%s]]></Description>
								<MusicUrl><![CDATA[%s]]></MusicUrl>
								<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
								<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
								</Music>
								</xml>", $this->toUserName, $this->fromUserName, time(), $musicTitle, $musicDescription, $musicUrl, $HDMusicUrl, $musicMediaId);
		echo $responseStr;
		return;
	}

	// 有点麻烦，后面再好好设计
	public function responseNews()
	{

	}
	
}