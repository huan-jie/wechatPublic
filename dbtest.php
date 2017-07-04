<?php
	
require("dbClass.php");

$db = new dbClass();

$sql = "select * from accessToken where 1";
$res = mysql_query($sql, $db->dbConnect);
// var_dump($sql);
// var_dump($db);
// var_dump($db->dbConnect);
$data = mysql_fetch_row($res);

// var_dump($data);