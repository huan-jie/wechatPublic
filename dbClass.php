<?php
/**
  * create by nhj, 2017-07-24
  * 微信公众号mysql数据库操作
  */

// define("SERVER", '39.108.174.188');
// define("USER", 'root');
// define("PWD", '111111');

class dbClass
{
	public $dbConnect;		// 数据库连接标识

	function __construct()
	{
		$con = mysql_connect('39.108.174.188:3306', 'root', '111111');
		var_dump($con);
		if ($con) {
			
			mysql_select_db("wechatPublic", $this->dbConnect);
			$this->dbConnect = $con;
		} else {

			$this->dbConnect = "connect error";
		}
	}

	public function connectDB()
	{
		if ($this->dbConnect) {
			
			return $this->dbConnect;
		} else {

			return NULL;
		}
	}
}
