<?php
/**
  * create by nhj, 2017-06-23
  * 微信公众号接收消息类
  */


class reciveMessageClass
{
	public $postStr;			// 微信服务器post传入内容
	// 一些参数
	public $toUserName;
	public $fromUserName;
	public $createTime;
	public $msgType;
	public $msgId;
	/*
	 * 不同的类型得到不同的数据
	 * 文本消息：content
	 * 图片消息：PicUrl、MediaId
	 * 语音消息：Format（语音格式）、MediaId、Recognition（语音识别，需自行开通）
	 * 视频消息：ThumbMediaId（视频消息缩略图）、MediaId
	 * 小视频消息：MediaId、ThumbMediaId
	 * 地理位置消息：Location_X（纬度）、Location_Y（经度）、Scale（缩放大小）、Label（地理位置信息）
	 * 链接消息：Title（消息标题）、Description（消息描述）、Url（消息链接）
	 * 事件推送：Event(事件类型)
	 */
	public $content;		
	public $picUrl;			
	public $mediaId;
	public $format;
	public $recognition;
	public $thumbMediaId;
	public $locationX;
	public $locationY;
	public $scale;
	public $label;
	public $title;
	public $description;
	public $url;

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
		$this->msgId = trim($postObj->MsgId);

		switch ($msgType) {
			case 'text':
				// 文字
				$this->content = trim($postObj->Content);
				break;
			case 'image':
				// 图片
				$this->mediaId = trim($postObj->MediaId);
				$this->picUrl = trim($post->PicUrl);
				break;
			case 'voice':
				// 语音
				$this->mediaId = trim($postObj->MediaId);
				$this->format = trim($postObj->Format);
				$this->recognition = trim($post->Recognition);
				break;
			case 'video':
				// 视频
				$this->mediaId = trim($postObj->MediaId);
				$this->thumbMediaId = trim($postObj->ThumbMediaId);
				break;
			case 'shortvideo':
				// 小视频		
				$this->mediaId = trim($postObj->MediaId);
				$this->thumbMediaId = trim($postObj->ThumbMediaId);
				break;
			case 'location':
				// 位置
				$this->locationX = trim($postObj->Location_X);
				$this->locationY = trim($postObj->Location_Y);
				$this->scale = trim($postObj->Scale);
				$this->label = trim($postObj->Label);
				break;
			case 'link':
				// 链接
				$this->title = trim($postObj->Title);
				$this->Description = trim($postObj->description);
				$this->url = trim($postObj->Url);
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
