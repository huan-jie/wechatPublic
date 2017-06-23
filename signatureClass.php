<?php
/**
  * create by nhj, 2017-06-23
  * 微信公众号签名验证类
  */
	
class signatureClass
{
	public function checkSignature($token, $timestamp, $nonce, $signature)
	{
		// 微信公众号签名拼接方式
		$signatureArr = array($token, $timestamp, $nonce);
		sort($signatureArr);
		$signatureStr = implode($signatureArr);
		$signatureStr = sha1($signatureStr);

		if ($signatureStr == $signature) {
			return true;
		} else {
			return false;
		}
	}
}