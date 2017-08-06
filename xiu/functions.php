<?php 
/**
 * 全局函数加载库
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView(THEME_FUN);
//index 分页函数
function xiu_page($count,$perlogs,$page,$url,$anchor=''){
    $pnums = @ceil($count / $perlogs);
    $page = @min($pnums,$page);
    $prepg=$page-1;//上一页
    $nextpg=($page==$pnums ? 0 : $page+1); //下一页
    $urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
    //开始分页导航内容
    $re = "<ul>";
    if($pnums<=1){
        return false;//如果只有一页则跳出
    }
    if($prepg){
        $re .="<li class=\"prev-page\"><a href=\"$url$prepg$anchor\">上一页</a></li>";
    }else{
        $re .="<li class=\"prev-page\"></li>";
    }
    for($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
        if($i > 0){
            if($i == $page){
                $re .= "<li class=\"active\"><span>$i</span></li>";
            }elseif($i == 1){
                $re .= "<li><a href=\"$urlHome$anchor\">$i</a></li>";
            }else{
                $re .= "<li><a href=\"$url$i$anchor\">$i</a></li>";
            }
        }
    }
    if($nextpg){
        $re .="<li class=\"next-page\"><a href=\"$url$nextpg$anchor\">下一页</a></li>";
    }
    $re .="<li><span>共 $pnums 页</span></li>";
    $re .="</ul>";
    return $re;
}
//index 分页函数
function xiu_page_next($count,$perlogs,$page,$url,$anchor=''){
    $pnums = @ceil($count / $perlogs);
    $page = @min($pnums,$page);
    $prepg=$page-1;//上一页
    $nextpg=($page==$pnums ? 0 : $page+1); //下一页
    $urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
    //开始分页导航内容
    $re = "<ul>";
    if($pnums<=1){
        return false;//如果只有一页则跳出
    }
    /*if($page!=1){
        $re .=" <a href=\"$urlHome$anchor\">首页</a> ";
    }*/
    if($prepg){
        $re .="<li class=\"prev-page\"><a href=\"$url$prepg$anchor\">上一页</a></li>";
    }else{
        $re .="<li class=\"prev-page\"></li>";
    }
    if($nextpg){
        $re .="<li class=\"next-page\"><a href=\"$url$nextpg$anchor\">下一页</a></li>";
    }
    $re .="</ul>";
    return $re;
}
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
    if($imgsrc):
        return $imgsrc;
    endif;
}

//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
//是否新窗口
function target_blank($type){
    if($type=='open'){
        echo ' target="_blank"';
    }else{
        echo '';
    }
}
//首页列表分类
function xiu_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    if(!empty($log_cache_sort[$blogid])){
        $sorts = '<a class="cat label label-important" href="'.Url::sort($log_cache_sort[$blogid]['id']).'">'.$log_cache_sort[$blogid]['name'].'<i class="label-arrow"></i></a>';
    }
    return $sorts;
}
//获取文章图片数量
function pic($content){
    if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
        $imgNum = count($img[1]);
    }else{
        $imgNum = "0";
    }
    return $imgNum;
}
//文章列表输出作者组
function excerpt_time($uid,$time,$type,$posts){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $options_cache = $CACHE->readCache('options');
    $author = _g('author_link') == 'open' ? '<a href="'.Url::author($uid).'">'.$user_cache[$uid]['name'].'</a>' : $user_cache[$uid]['name'];
    $post = in_array('siteauthor',_g('post_plugin')) ? $options_cache['blogname'].' - '.$author : $author ;
    if($type==1){
        $time = timeago($time,1);
    }else{
        $time = gmdate('M Y-n-j H:i', $time);
    }
    if($posts=='1'){
        return $author.' 发布于 '.$time;
    }else{
        return $post.' 发布于 '.$time;
    }
}
//首页置顶文章
function Home_Top_Logs() {
    $db = MySql::getInstance();
    $sql =     "SELECT gid,title,content,date FROM ".DB_PREFIX."blog WHERE type='blog' and top='y' ORDER BY `top` DESC ,`date` DESC LIMIT 0,4";
    $list = $db->query($sql);
    while($value = $db->fetch_array($list)){
        if(pic_thumb($value['content'])){
            $imgsrc = pic_thumb($value['content']);
        }else{
            $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,12).'.jpg';
        }
        echo "<li><a href=\"".Url::log($value['gid'])."\"><img class=\"thumb\" data-original=\"{$imgsrc}\"><h4>{$value['title']}</h4></a></li>";
    }
}
//首页热门推荐
function Home_hot_logs_sev($nums){
    $db = MySql::getInstance();
    $time = time();
    $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,$nums";
    $list = $db->query($sql);
    while($value = $db->fetch_array($list)){
        if(pic_thumb($value['content'])){
            $imgsrc = pic_thumb($value['content']);
        }else{
            $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,12).'.jpg';
        }
        echo '<li class="item"><a href="'.Url::log($value['gid']).'"><img data-original="'.$imgsrc.'" class="thumb"/>'.$value['title'].'</a></li>';
    }
}
//文章分享
function get_share(){
    $shares = array(
        'qzone',
        'tsina',
        'weixin',
        'tqq',
        'sqq',
        'bdhome',
        'tqf',
        'renren',
        'diandian',
        'youdao',
        'ty',
        'kaixin001',
        'taobao',
        'douban',
        'fbook',
        'twi',
        'mail',
        'copy'
    );

    $html = '';
    foreach ($shares as $value) {
        $html .= '<a class="bds_'.$value.'" data-cmd="'.$value.'"></a>';
    }

    return '分享到：'.$html.'<a class="bds_more" data-cmd="more">更多</a> (<a class="bds_count" data-cmd="count"></a>)';
}
//文章详情页下相关文章
function related_logs($logData = array(),$log_num,$log_type){
    if(is_file($configfile)){
        require $configfile;
    }else{
        $related_log_type = 'sort';//相关日志类型，sort为分类，tag为标签；
        $related_log_sort = 'views_desc';//排列方式，views_desc 为点击数（降序）comnum_desc 为评论数（降序） rand 为随机 views_asc 为点击数（升序）comnum_asc 为评论数（升序）
        $related_log_num = $log_num; //显示文章数
        $related_inrss = 'y'; //是否显示在rss订阅中，y为是，其它值为否
    }
    global $value;
    $DB = MySql::getInstance();
    $CACHE = Cache::getInstance();
    extract($logData);
    if($value){
        $logid = $value['id'];
        $sortid = $value['sortid'];
        global $abstract;
    }
    $sql = "SELECT gid,title,content FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog'";
    if($related_log_type == 'tag'){
        $log_cache_tags = $CACHE->readCache('logtags');
        $Tag_Model = new Tag_Model();
        $related_log_id_str = '0';
        foreach($log_cache_tags[$logid] as $key => $val){
            $related_log_id_str .= ','.$Tag_Model->getTagByName($val['tagname']);
        }
        $sql .= " AND gid!=$logid AND gid IN ($related_log_id_str)";
    }else{
        $sql .= " AND gid!=$logid AND sortid=$sortid";
    }
    switch($related_log_sort){
        case 'views_desc':{
            $sql .= " ORDER BY views DESC";break;
        }
        case 'views_asc':{
            $sql .= " ORDER BY views ASC";
            break;
        }
        case 'comnum_desc':{
            $sql .= " ORDER BY comnum DESC";
            break;
        }
        case 'comnum_asc':{
            $sql .= " ORDER BY comnum ASC";
            break;
        }
        case 'rand':{
            $sql .= " ORDER BY rand()";
        break;
        }
    }
    $sql .= " LIMIT 0,$related_log_num";
    $related_logs = array();
    $query = $DB->query($sql);
    while($row = $DB->fetch_array($query)){
        $row['gid'] = intval($row['gid']);
        $row['title'] = htmlspecialchars($row['title']);
        $related_logs[] = $row;
    }
    $out = '';
    if($log_type==1){
        if(!empty($related_logs)){
            foreach($related_logs as $val){
                if(pic_thumb($value['content'])){
                    $imgsrc = pic_thumb($value['content']);
                }else{
                    $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,12).'.jpg';
                }
                $out .= "<li><a href=\"".Url::log($val['gid'])."\" title=\"{$val['title']}\"><span><img data-original=\"{$imgsrc}\" class=\"thumb\"/></span>{$val['title']}</a></li>";
            }
        }
    }else{
        if(!empty($related_logs)){
            foreach($related_logs as $val){
                $out .= "<li><a href=\"".Url::log($val['gid'])."\" title=\"{$val['title']}\">{$val['title']}</a></li>";
            }
        }
    }
    if(!empty($value['content'])){
        if($related_inrss == 'y'){
            $abstract .= $out;
        }
    }else{
        echo $out;
    }
}
//文章点赞
function likes($log,$type='2'){
    if(!is_array($log)) $log = array('logid' => $log);
    if($type=='1'){
        $l = '<a href="javascript:;" class="likes post-like" data-pid="'.$log['logid'] .'"><i class="glyphicon glyphicon-thumbs-up"></i>赞 (<span>'.(isset($log['praise']) ? $log['praise'] : likes_getNum($log['logid'])).'</span>)</a>';
    }elseif($type=='2'){
        $l = '<a class="likes action action-like" data-pid="'. $log['logid'] .'"><i class="glyphicon glyphicon-thumbs-up"></i>赞 (<span>'.(isset($log['praise']) ? $log['praise'] : likes_getNum($log['logid'])).'</span>)</a>';
    }
    return $l;
}
//获取指定文章点赞数量
function likes_getNum($logid){
    static $arr = array();
    $DB = Database::getInstance();
    if(isset($arr[$logid])) return $arr[$logid];
    $sql = "SELECT praise FROM " . DB_PREFIX . "blog WHERE gid=$logid";
    $res = $DB->query($sql);
    $row = $DB->fetch_array($res);
    $arr[$logid] = intval($row['praise']);
    return $arr[$logid];
}
//评论列表文章标题显示
function commtent_title($gid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' and gid in ($gid) ORDER BY `date` DESC LIMIT 0,1";
    $list = $db->query($sql);
    while($row = $db->fetch_array($list)){
        return $row['title'];
    }
}
//检测是否为手机
function em_is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            $is_mobile = true;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
//根据时间G来判断
function get_time_type($t){
    if($t<=3){
        $ts = '拂晓';
    }elseif($t<=6){
        $ts = '黎明';
    }elseif($t<=9){
        $ts = '清晨';
    }elseif($t<=12){
        $ts = '早上';
    }elseif($t<=15){
        $ts = '中午';
    }elseif($t<=18){
        $ts = '下午';
    }elseif($t<=21){
        $ts = '傍晚';
    }elseif($t<=00){
        $ts = '深夜/午夜';
    }
    return $ts;
}
//评论时间格式获取
function timeago( $ptime , $type) {
    //$ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    if($type == 1){
        $interval = array (
            12 * 30 * 24 * 60 * 60  =>  '年前'.' ('.date('Y-m-d', $ptime).')',
            30 * 24 * 60 * 60       =>  '个月前'.' ('.date('m-d', $ptime).')',
            7 * 24 * 60 * 60        =>  '周前'.' ('.date('m-d', $ptime).')',
            24 * 60 * 60            =>  '天前',
            60 * 60                 =>  '小时前',
            60                      =>  '分钟前',
            1                       =>  '秒前',
        );
    }
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
//Gravatar头像缓存
function cache_gravatar($email, $s = 44, $d = 'identicon', $r = 'g'){
    $f = md5($email);
    $a = TEMPLATE_URL.'images/avatar/'.$f.'.jpg';
    $e = EMLOG_ROOT.'/content/templates/xiu/images/avatar/'.$f.'.jpg';
    $t = 1296000;
    if(empty($email)){
        $a = TEMPLATE_URL.'images/avatar-default.png';
    }
    if(!is_file($e) || (time() - filemtime($e)) > $t ){
        $g = sprintf("http://secure.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f;copy($g,$e); $a=$g;
    }
    if(filesize($e) < 500){
        copy($d,$e);
    }
    return $a;
}
//404
function hui_404(){
    echo '<div class="e404"><img src="'.TEMPLATE_URL.'images/404.png"><h1>404 . Not Found</h1><p>沒有找到你要的内容！</p><br><p><a class="btn btn-primary" href="'.BLOG_URL.'">返回首页</a></p></div>';
}
function show_tags(){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');
	$categories =array();
	foreach($tag_cache as $value){
		$vs = array('term_url'=>$value['tagurl'],'name'=>$value['tagname'],'num'=>$value['usenum'],);
		$tag = strtoupper(Chinese_to_PY::getPY($value['tagname']));
		$t = strlen($tag);
		$ts = $t-1;
		$s = substr($tag,0,-$ts);
		$categories[$s][] = $vs;
	}
	ksort($categories);
	echo "<ul class='list-inline' id='tag_letter'>";
	for($i=65;$i<=90;$i++){
		echo "<li><a href='#".chr($i)."'>".chr($i)."</a></li>";
	}
	for($i=48;$i<=57;$i++){
		echo "<li><a href='#".chr($i)."'>".chr($i)."</a></li>";
	}
	echo "</ul>";
	echo "<ul id='all_tags' class='list-unstyled'>";
	for($i=65;$i<=90;$i++){
		$tagi = $categories[chr($i)];
		if(is_array($tagi)){
			echo "<li id='".chr($i)."'><h4 class='tag_name'>".chr($i)."</h4>";
			foreach($tagi as $tag){
				echo "<a href='".Url::tag($tag['term_url'])."'>".$tag['name']."<sup>(".$tag['num'].")</sup></a>";
			}
		}
	}
	for($i=48;$i<=57;$i++){
		$tagi = $categories[chr($i)];
		if(is_array($tagi)){
			echo "<li id='".chr($i)."'><h4 class='tag_name'>".chr($i)."</h4>";
			foreach($tagi as $tag){
				echo "<a href='".Url::tag($tag['term_url'])."'>".$tag['name']."<sup>(".$tag['num'].")</sup></a>";
			}
		}
	}
	echo "</ul>";
}
function Index_head(){
    echo "<link rel='stylesheet' id='main-css'  href='".TEMPLATE_URL."style.css?ver=".THEME_VER."' type='text/css' media='all' />\n";
    if( _g('layout') == 'ui-c3-top' ){
        echo "<link rel='stylesheet' id='excerpt-css'  href='".TEMPLATE_URL."css/excerpts.css?ver=".THEME_VER."' type='text/css' media='all' />\n";
    }
    if( _g('jquery_bom') == 'close' ){
        echo "<script type='text/javascript' src='".TEMPLATE_URL."js/jquery.js?ver=".THEME_VER."'></script>\n";
    }
    echo "<link rel=\"EditURI\" type=\"application/rsd+xml\" title=\"RSD\" href=\"".BLOG_URL."xmlrpc.php?rsd\" />\n<link rel=\"wlwmanifest\" type=\"application/wlwmanifest+xml\" href=\"".BLOG_URL."wlwmanifest.xml\" />\n<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\"  href=\"".BLOG_URL."rss.php\" />\n";
}
//remove head
function EM_head(){
    g_head();
    head_css();
}
//custom code
function g_head() {
    if( _g('headcode') ) echo "<!--ADD_CODE_HEADER_START-->\n"._g('headcode')."\n<!--ADD_CODE_HEADER_END-->\n";
}
function g_footer() { 
    if( _g('footcode') ) echo "<!--ADD_CODE_FOOTER_START-->\n"._g('footcode')."\n<!--ADD_CODE_FOOTER_END-->\n";
}
//import style
function head_css() {

    $styles = '';

    $site_width = _g('site_width');
    if( $site_width && $site_width !== '1280' ){
        $styles .= ".container{max-width:{$site_width}px}";
    }

    if( _g('site_gray') == 'open' ){
        $styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}";
    }

    if( _g('theme_skin_custom') ){
        $skin_option = _g('theme_skin_custom');
        $skc = $skin_option;
    }else{
        $skin_option = _g('theme_skin');
        $skc = '#'.$skin_option;
    }
    
    if( $skin_option && $skin_option !== 'FF5E52' ){
        $styles .= "a:hover, a:focus,.post-like.actived,.excerpt h2 a:hover,.user-welcome strong,.article-title a:hover,#comments b,.text-muted a:hover,.relates a:hover,.archives .item:hover h3,.linkcat h2,.sticky a:hover,.article-content a:hover,.nav li.current-menu-item > a, .nav li.current-menu-parent > a, .nav li.current_page_item > a, .nav li.current-posa,.article-meta a:hover{color:{$skc};}.logo a,.article-tags a,.search-form .btn,#bdcs .bdcs-search-form-submit,.widget_tags_inner a:hover:hover,.focusmo a:hover h4,.tagslist .tagname:hover,.pagination ul > li.next-page > a{background-color:{$skc};}.pagemenu li.active a{background-color:{$skc};}.label-important,.badge-important{background-color:{$skc};}.label-important .label-arrow,.badge-important .label-arrow{border-left-color:{$skc};}.title strong{border-bottom-color:{$skc};}#submit{background: {$skc};border-right: 2px solid {$skc};border-bottom: 2px solid {$skc};}";
    }

    $styles .= _g('csscode');

    if( $styles ) echo '<style>'.$styles.'</style>';
}
//import javascript
function load_script(){
    
    $jss = array(
        'no' => array(
            'jquery' => TEMPLATE_URL.'js/jquery.js',
            'bootstrap' => TEMPLATE_URL . 'js/bootstrap.js'
        ),
        'baidu' => array(
            'jquery' => 'http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js',
            'bootstrap' => 'http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js'
        ),
        '360' => array(
            'jquery' => 'http://libs.useso.com/js/jquery/2.0.0/jquery.min.js',
            'bootstrap' => 'http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js'
        ),
        'he' => array(
            'jquery' => '//code.jquery.com/jquery-2.0.0.min.js',
            'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
        )
    );
    $jquery = _g('js_outlink') ? $jss[_g('js_outlink')]['jquery'] : TEMPLATE_URL.'js/jquery.js';
    $bootstrap = _g('js_outlink') ? $jss[_g('js_outlink')]['bootstrap'] : TEMPLATE_URL . 'js/bootstrap.js';
    if( _g('jquery_bom') == 'open' ){
        echo "<script type='text/javascript' src='{$jquery}?ver=".THEME_VER."'></script>\n";
    }
    echo "<script type='text/javascript' src='{$bootstrap}?ver=".THEME_VER."'></script>\n";
    if( _g('focusslide_s') == 'open' && _g('focusslide_s_m') == 'open' ){
        echo "<script type='text/javascript' src='".TEMPLATE_URL."js/hammer.min.js?ver=".THEME_VER."'></script>\n";
    }
    echo "<script type='text/javascript' src='".TEMPLATE_URL."js/custom.js?ver=".THEME_VER."'></script>\n";
    echo g_footer();
    
}

function hui_get_adcode($name){
    if( !$name ) return '';
    if( em_is_mobile() ){
        return _g($name.'_m');
    }else{
        return _g($name);
    }
}