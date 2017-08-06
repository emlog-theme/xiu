<?php
$DB = MySql::getInstance();
if (PHP_VERSION < '5.0'){
    emMsg('您的php版本过低，请选用支持PHP5的环境配置。');
    exit();
}

if( !file_exists(EMLOG_ROOT."/content/templates/xiu/inc/setted.xiu.inc")){
    emDirect(TEMPLATE_URL.'install.php');
    exit();
}

if($DB->num_rows($DB->query("show columns from ".DB_PREFIX."blog like 'praise'")) == 0){
    emDirect(TEMPLATE_URL.'install.php');
    exit();
}

$row = $DB->once_fetch_array("SELECT * FROM ".DB_PREFIX."blog WHERE title='likes' and type='page' and hide='n' and alias='likes' ");
if(!$row['title']){
    emDirect(TEMPLATE_URL.'install.php');
    exit();
}

?>