<?php
/**
 * 侧边栏组件 - 归档
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
global $CACHE; 
$record_cache = $CACHE->readCache('record');
?>
<div class="widget widget_archive">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul>
        <?php foreach($record_cache as $value): ?>
        <li><a<?php echo target_blank(_g('target_blank')); ?> href='<?php echo Url::record($value['date']); ?>'><?php echo $value['record']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>