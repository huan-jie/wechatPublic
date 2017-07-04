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
	 * 事件推送：
	 * 关注取消关注事件：Event(事件类型，subscribe、unsubscribe)
	 * 扫描带参二维码事件：1.未关注：Event（subscribe）、EventKey（qrscene_为前缀，后面为二维码的参数值）、Ticket（二维码的ticket，可用来换取二维码图片）
	 				    2.已关注：Event（SCAN）、EventKey（二维码id）、Ticket
	 * 上报地理位置事件：用户同意上报地理位置后，每次进入公众号或一段时间内上报一次地理位置，可设置。Event（LOCATION）、Latitude、Longitude、Precision（精度）
	 * 自定义菜单事件：1.点击菜单拉取消息时：Event（CLICK）、EventKey（事件KEY值，接口菜单中KEY值相对应）
	 	             2.点击菜单跳转链接时：Event（VIEW）、EventKey（事件KEY值，设置的跳转URL）
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
	public $event;
	public $eventKey;
	public $ticket;
	public $latitude;
	public $longitude;
	public $precision;

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
				$this->event = $event;
				switch ($event) {
					case 'subscribe':
						// 关注
						// 扫描带参二维码关注时可得到以下信息
						$this->eventKey = trim($postObj->EventKey);
						$this->ticket = trim($postObj->Ticket);
						break;
					case 'unsubscribe':
						// 取消关注
					
						break;
					case 'SCAN':
						// 扫描
						$this->eventKey = trim($postObj->EventKey);
						$this->ticket = trim($postObj->Ticket);
						break;
					case 'LOCATION':
						// 上报地理位置
						$this->latitude = trim($postStr->Latitude);
						$this->longitude = trim($postStr->Longitude);
						$this->precision = trim($postStr->Precision);
						break;
					case 'CLICK':
						// 点击菜单拉取消息
						$this->eventKey = trim($postObj->EventKey);
						break;
					case 'VIEW':
						// 点击菜单跳转链接
						$this->eventKey = trim($postObj->EventKey);
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
