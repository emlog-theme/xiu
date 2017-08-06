<?php
/*
 *   首页header文件
 *
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(blog_tool_ishome()){
    $site_title = $blogname.'-'.$bloginfo;
}elseif(!empty($tws)){
    $site_title = '微语 - '.$blogname;
}else{
    $site_title = $site_title;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Cache-Control" content="no-siteapp">
<title><?php echo $site_title; ?></title> 
<?php Index_head(); ?>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<link rel="shortcut icon" href="<?php echo BLOG_URL.'/favicon.ico' ?>">
<!--[if lt IE 9]><script src="<?php echo TEMPLATE_URL ?>js/html5.js"></script><![endif]-->
<?php EM_head(); ?>
<?php doAction('index_head'); ?>
</head>
<?php
if( $layout == 'ui-navtop' || $layout == 'ui-c3-top' ){
    $nav_layout = ' ui-navtop';
}elseif( $layout == 'ui-c2'){
    $nav_layout = ' ui-c2';
}
if(ROLE == 'admin' || ROLE == 'writer'){
    $role = ' logged-in';
}
if(!empty($logs)){
    $show404='search search-results ';
}else{
    $show404='search search-no-results ';
}
if( _g('list_thumb_left') == 'open' ){
    $list_thumb_left = ' excerpt_thumb_left';
}
if( _g('focusslide_s_m') == 'open' ){
    $focusslide_s_m = ' focusslide_s_m';
}
if(blog_tool_ishome()){//判断首页输出
    echo '<body class="home blog'.$list_thumb_left.$focusslide_s_m.$role.$nav_layout.'">';
}elseif($keyword){//判断搜索页
    echo '<body class="'.$show404.$role.$nav_layout.'">';
}elseif($tag){//判断标签
    echo '<body class="archive tag tag-'.$id.$role.$nav_layout.'">';
}elseif($type=='page'){//判断自定义页
    if($tpl_side == 'y'){
        $page = ' page-template-pagehasmenu ';
    }
    if($template == 'page/archivers'){
        $page_n = ' page-template-archives page-template-pagesarchives-php ';
    }elseif($template == 'page/links'){
        $page_n = ' page-template-links page-template-pageslinks-php ';
    }elseif($template == 'page/tags'){
        $page_n = ' page-template-tags page-template-pagestags-php ';
    }elseif($template == 'page/reader'){
        $page_n = ' page-template-readers page-template-pagesreaders-php ';
    }
    echo '<body class="page page-id-'.$logid.' page-template page-template-pages'.$page.$page_n.$role.$nav_layout.'">';
}elseif($sortName){//判断分类
    echo '<body class="archive category category-'.$sortid.$role.$nav_layout.'">';
}elseif($params[1]=='author'){//判断作者
    echo '<body class="archive author author-'.$author.$role.$nav_layout.'">';
}elseif($logs || $logid || $tws){
    echo '<body class="single single-post postid-'.$logid.' single-format-standard'.$role.$nav_layout.'">';
}else{
    echo '<body>';
}
?>
<?php if( $layout == 'ui-navtop' || $layout == 'ui-c3-top' ){ ?>
<header class="header">
<div class="container">
<?php }else{ ?>
<section class="container">
<header class="header">
<?php } ?>
    <div class="container">
        <h1 class="logo"><a href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname._g('connector').$bloginfo; ?>"><?php echo $blogname; ?></a></h1>
        <ul class="nav">
            <?php blog_navi();?>
        </ul>
        <?php if(_g('search_nav') == 'open' ):?>
        <form name="keyform" method="get" class="search-form" action="<?php echo BLOG_URL; ?>index.php">
            <input class="form-control" name="keyword" type="text" placeholder="输入关键字" value="">
            <input class="btn" type="submit" value="搜索">
        </form>
        <?php endif; ?>
        <span class="glyphicon glyphicon-search m-search"></span>
        <div class="feeds">
            <a class="feed feed-weibo" rel="external nofollow" href="<?php echo _g('weibo'); ?>" target="_blank"><i></i>微博</a>
            <a class="feed feed-tqq" rel="external nofollow" href="<?php echo _g('tqq'); ?>" target="_blank"><i></i>腾讯微博</a>
            <a class="feed feed-rss" rel="external nofollow" href="<?php echo _g('wechat'); ?>" target="_blank"><i></i>RSS订阅</a>
            <a class="feed feed-weixin" rel="external nofollow" href="javascript:;" title="关注”<?php echo _g('wechat'); ?>“" data-content="<img src='<?php echo _g('wechat_qr'); ?>'>"><i></i>微信</a>
        </div>
        <div class="slinks">
            <?php echo _g('menu_links'); ?>
        </div>
        <?php
            if(_g('sign_f')=='open'):
            if(ROLE == 'admin' || ROLE == 'writer'):
            if(ROLE == ROLE_ADMIN){$user_url=BLOG_URL.'admin/';}else{$user_url=BLOG_URL.'user';}
        ?>
        <div class="user-welcome">
            <a title="点此进入后台" href="<?php echo $user_url; ?>"><img src="<?php echo cache_gravatar($email); ?>" class="avatar avatar-50" height="50" width="50"></a>
            <strong><?php echo $nickname; ?></strong><span class="text-muted">欢迎登录！</span>
        </div>
        <p class="user-logout">
            <a href="">退出</a>
        </p>
        <?php else:?>
        <div class="user-signin">
            <span evt="login">登陆</span><br>
            <span evt="login" reg="1">注册</span>
        </div>
        <?php endif;endif;?>
<?php if( $layout == 'ui-navtop' || $layout == 'ui-c3-top' ){ ?>
</div>
</header>
<section class="container">
<?php }else{ ?>
</header>
<?php } ?>