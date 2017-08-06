<?php
/**
 * 安装程序
 * @copyright (c) Emlog All Rights Reserved
 */

require_once ('../../../init.php');
global $CACHE;
error_reporting(0);

define('DEL_INSTALLER', 1);

define('THEME_VER', '4.1');

$DB = MySql::getInstance();

date_default_timezone_set('Asia/Shanghai');

header('Content-Type: text/html; charset=UTF-8');

$act = isset($_GET['action'])? $_GET['action'] : '';

if (PHP_VERSION < '5.0'){
    emMsg('您的php版本过低，请选用支持PHP5的环境配置。');
}

if(!$act){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Emlog XIU</title>
<style type="text/css">
<!--
body {background-color:#F7F7F7;font-family: Arial;font-size: 12px;line-height:150%;}
.main {background-color:#FFFFFF;font-size: 12px;color: #666666;width:750px;margin:30px auto;padding:10px;list-style:none;border:#DFDFDF 1px solid; border-radius: 4px;}
.title{text-align:center; font-size: 14px;}
.input {border: 1px solid #CCCCCC;font-family: Arial;font-size: 18px;height:28px;background-color:#F7F7F7;color: #666666;margin:0px 0px 0px 25px;}
.submit{cursor: pointer;font-size: 12px;padding: 4px 10px;}
.care{color:#0066CC;}
.title2{font-size:18px;color:#666666;border-bottom: #CCCCCC 1px solid; margin:40px 0px 20px 0px;padding:10px 0px;}
.foot{text-align:center;}
.main li{ margin:20px 0px;}
-->
</style>
</head>
<body>
<form name="form1" method="post" action="install.php?action=install">
<div class="main">
<p class="title"><h1 style="text-align: center;">XIU</h1></p>
<p align="center">检测到您第一次使用XIU主题，请先点击开始配置按钮，配置相关内容！</p>
<div>
<p class="foot">
<input type="submit" class="submit" value="开始配置">
</p>
</div>
</div>
</form>
</body>
</html>
<?php
}
if($act == 'install' || $act == 'reinstall'){
    if( !file_exists(EMLOG_ROOT."/content/templates/xiu/inc/setted.xiu.inc")){
        $user_cache = $CACHE->readCache('user');
        $incFile = EMLOG_ROOT."/content/templates/xiu/inc/setted.xiu.inc";
        $myfile = fopen($incFile, "w") or die("Unable to open file!");
        fwrite($myfile,''); 
        fclose($myfile);
    }
    if($DB->num_rows($DB->query("show columns from ".DB_PREFIX."blog like 'praise'")) == 0){
        $sql = "ALTER TABLE ".DB_PREFIX."blog ADD praise varchar(500) DEFAULT '0'";
        $DB->query($sql);
    }
	$row = $DB->once_fetch_array("SELECT * FROM ".DB_PREFIX."blog WHERE title='likes' and type='page' and hide='n' and alias='likes' ");
	if(!$row['title']){
		$Log_Model = new Log_Model();
		$logData = array('title'=>'likes','content'=>'','excerpt'=>'','date'=>Option::get('timezone'),'allow_remark'=>'n','hide'=>'n','alias'=>'likes','type'=>'page','template' => 'action/likes');
		$Log_Model->addlog($logData);
		$CACHE->updateCache(array('options', 'logalias'));
	}
	
    $result .= "<p style=\"font-size:24px; border-bottom:1px solid #E6E6E6; padding:10px 0px;\">恭喜，配置成功！</p><p>您的XIU主题相关配置已配置完毕，现在可以开始您的创作了，就这么简单!</p>";
    /*
	if (DEL_INSTALLER === 1 && !@unlink('./install.php') || DEL_INSTALLER === 0) {
        $result .= '<p style="color:red;margin:10px 20px;">警告：请手动删除主题目录下安装文件：install.php</p> ';
    }
	*/
    $result .= "<p style=\"text-align:right;\"><a href=\"".BLOG_URL."\">访问首页</a> | <a href=\"".BLOG_URL."/admin/\">登录后台</a></p>";
    emMsg($result, 'none');
}
?>