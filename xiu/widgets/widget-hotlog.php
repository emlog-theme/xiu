<?php
/**
 * 侧边栏组件 - 热门文章
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
$index_hotlognum = Option::get('index_hotlognum');
$db = MySql::getInstance();
$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog' ORDER BY views DESC, comnum DESC LIMIT 0, $index_hotlognum");
?>
<div class="widget widget_postlist">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul class="items-01">
    <ul>
        <?php
            while($row = $db->fetch_array($sql)){
            if(pic_thumb($row['content'])){
                $imgsrc = pic_thumb($row['content']);
            }else
                $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,40).'.jpg';
            $comment = ($row['comnum'] != 0) ? '评论('.$row['comnum'].')' : '暂无评论';
        ?>
        <li><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo Url::log($row['gid']); ?>"><span class="thumbnail"><img data-original="<?php echo $imgsrc; ?>" class="thumb"></span><span class="text"><?php echo $row['title']; ?></span><span class="muted"><?php echo gmdate('Y-n-j', $row['date']); ?></span><span class="muted"><?php echo $comment; ?></span></a></li>
        <?php } ?>
    </ul>
</div>