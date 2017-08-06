<?php
/**
 * 侧边栏组件 - 标签
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
global $CACHE;
$tag_cache = $CACHE->readCache('tags');
?>
<div class="widget widget_tags">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul class="widget_tags_inner">
        <?php foreach($tag_cache as $value): ?>
        <li><a<?php echo target_blank(_g('target_blank')); ?> title="<?php echo $value['usenum']; ?>个话题" href="<?php echo Url::tag($value['tagurl']); ?>"><?php echo $value['tagname']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>