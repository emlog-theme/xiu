<?php
/**
 * 点赞处理
 * @copyright (c) Emlog All Rights Reserved
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
date_default_timezone_set('Asia/Shanghai');
$DB = MySql::getInstance();
if(!$_POST){
	exit();
}
if(isset($_POST['id'])){
	static $arr = array();
	$id = intval($_POST['id']);
	header("Access-Control-Allow-Origin: *");
	$DB->query("UPDATE " . DB_PREFIX . "blog SET praise=praise+1 WHERE gid=$id");
	if(isset($arr[$id])) return $arr[$id];
	$sql = "SELECT praise FROM " . DB_PREFIX . "blog WHERE gid=$id";
	$res = $DB->query($sql);
	$row = $DB->fetch_array($res);
	setcookie("lslike_{$id}",'1', time() + 3600 * 24 * 30 * 12);
	echo intval($row['praise']);
	exit();
}