<?php
/**
 * 侧边栏组件 - 随机文章
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
global $CACHE;
$index_randlognum = Option::get('index_randlognum');
$sta_cache = $CACHE->readCache('sta');
$lognum = $sta_cache['lognum'];
$start = $lognum > $index_randlognum ? mt_rand(0, $lognum - $index_randlognum): 0;
$db = MySql::getInstance();
$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog' LIMIT $start, $index_randlognum");
?>
<div class="widget widget_postlist">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul class="items-01">
        <?php
            while($row = $db->fetch_array($sql)){
            if(pic_thumb($row['content'])){
                $imgsrc = pic_thumb($row['content']);
            }else
                $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,40).'.jpg';
            $comment = ($row['comnum'] != 0) ? '评论('.$row['comnum'].')' : '暂无评论';
        ?>
        <li>
            <li><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo Url::log($row['gid']); ?>"><span class="thumbnail"><span><img data-original="<?php echo $imgsrc; ?>" class="thumb"/></span></span><span class="text"><?php echo $row['title']; ?></span><span class="text-muted post-views">阅读(<?php echo $row['views']; ?>)</span></a></li>
        </li>
        <?php } ?>
    </ul>
</div>