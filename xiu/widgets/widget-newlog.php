<?php
/**
 * 侧边栏组件 - 最新文章
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
$index_newlognum = Option::get('index_newlognum');
$db = MySql::getInstance();
$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog' AND top='n' order by date DESC limit 0,$index_newlognum");
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
        <li><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo Url::log($row['gid']); ?>"><span class="thumbnail"><span><img data-original="<?php echo $imgsrc; ?>" class="thumb"/></span></span><span class="text"><?php echo $row['title']; ?></span><span class="text-muted post-views">阅读(<?php echo $row['views']; ?>)</span></a></li>
        <?php } ?>
    </ul>
</div>