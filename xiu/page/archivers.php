<?php
/**
 * Template name: 文章存档
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if( $tpl_side == 'y' ){include View::getView('page/pagemenu');}
function displayRecord(){
    global $CACHE; 
    $record_cache = $CACHE->readCache('record');
    $output = '';
    foreach($record_cache as $value){
        $output .= '<div class="item"><h3>'.$value['record'].'</h3>'.displayRecordItem($value['date']).'</div>';
    }
    $output = '<article class="archives">'.$output.'</article>';
    return $output;
}
function displayRecordItem($record){
    if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
        $days = getMonthDayNum($match[2], $match[1]);
        $record_stime = emStrtotime($record . '01');
        $record_etime = $record_stime + 3600 * 24 * $days;
    } else {
        $record_stime = emStrtotime($record);
        $record_etime = $record_stime + 3600 * 24;
    }
    $sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
    $result = archiver_db($sql);
    return $result;
}
function archiver_db($condition = ''){
    $DB = MySql::getInstance();
    $sql = "SELECT gid, title,comnum, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
    $result = $DB->query($sql);
    $output = '';
    while ($row = $DB->fetch_array($result)) {
        $log_url = Url::log($row['gid']);
        $output .= '<li><time>'.date('d日',$row['date']).'</time><a href="'.$log_url.'">'.$row['title'].' </a><span class="muted">'.$row['comnum'].'评论</span></li>';
    }
    $output = empty($output) ? '<li>暂无文章</li>' : $output;
    $output = '<ul class="archives-list">'.$output.'</ul>';
    return $output;
}
?>
    <div class="content-wrap">
        <div class="content<?php if( $tpl_side == 'y' ){echo ' no-sidebar';}?>">
            <h1 class="title"><strong><a href="<?php echo URL::log($logid); ?>"><?php echo $log_title; ?></a></strong></h1>
            <p>&nbsp;</p>
            <article class="article-content">
                <?php echo $log_content; ?>
            </article>
			<?php echo displayRecord();?>
            <p>&nbsp;</p>
            <?php if( $allow_remark == 'y' ):?>
            <h3 class="title" id="comments"><?php if(ROLE == 'admin' || ROLE == 'writer'):?><div class="text-muted pull-right"><a href="<?php echo BLOG_URL; ?>admin/?action=logout"><span class="glyphicon glyphicon-user"></span> 退出</a></div><?php endif;?><strong><?php if($comnum<=0):?>暂无评论<?php else:?><?php echo _g('comment_title'); ?> <b> <?php echo $comnum;?> </b><?php endif;?></strong></h3>
            <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
            <div id="postcomments">
            <?php blog_comments($comments); ?>
            </div>
            <?php endif;?>
            
        </div>
    </div>
    <?php include View::getView('side4');?>

<?php include View::getView('footer');?>