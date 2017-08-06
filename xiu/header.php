<?php
/*
Template Name:xiu
Description:xiu主题（付费） 技术支持：<a href="http://www.xlonewolf.net">独狼博客</a>
Version:4.1
Author:lonewolf
Author Url:http://www.xlonewolf.net
Sidebar Amount:4
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}

define('THEME_VER', '4.1');
define('THEME_FUN', 'inc/fn');

require_once View::getView('functions');

require_once View::getView('module');

$layout = _g('layout');

$tpl_side = _g('page_side');

if(ROLE == 'admin' || ROLE == 'writer'){
    $User_Model = new User_Model();
    $row = $User_Model->getOneUser(UID);
    $row['nickname'] = empty($row['nickname']) ? $row['username'] : $row['nickname'];
    extract($row);
}

if($log_title !=="likes" ){
	require_once View::getView('modules/mo-header');
}