<?php
$mysql_host = 'localhost';
$mysql_user = 'enquirysquad';
$mysql_pass = 'enquirysquad69';
$mysql_db = 'lr';
$status = 'NOT CONNECTED';
if(!@mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysql_select_db($mysql_db)){
	die('<center><h1>SORRY! WE\'RE EXPERIENCING DOWNTIME</h1></center>');
}else{
	$status = 'CONNECTED';
}
?>