<?php
/**
 * 侧边栏组件 - 分类
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
global $CACHE;
$sort_cache = $CACHE->readCache('sort');
?>
<div class="widget widget_categories">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul>
        <?php
            foreach($sort_cache as $value):
                if ($value['pid'] != 0) continue;
        ?>
        <li class="cat-item cat-item-<?php echo $value['sid']; ?>"><i class="fa fa-folder-o fa-fw"></i><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo Url::sort($value['sid']); ?>" > <?php echo $value['sortname']; ?></a></li>
        <?php
            if(!empty($value['children'])):
            $children = $value['children'];
            foreach ($children as $key):
            $value = $sort_cache[$key];
        ?>
        <li class="cat-item cat-item-<?php echo $value['sid']; ?>"><i class="fa fa-folder-o fa-fw"></i><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo Url::sort($value['sid']); ?>"> <?php echo $value['sortname']; ?></a></li>
        <?php
            endforeach;
            endif;
        ?>
        <?php endforeach; ?>
    </ul>
</div>