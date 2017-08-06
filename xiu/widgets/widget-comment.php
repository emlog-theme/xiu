<?php
/**
 * 侧边栏组件 - 友情链接
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
global $CACHE; 
$com_cache = $CACHE->readCache('comment');
?>
<div class="widget widget_comments">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul>
        <?php
            foreach($com_cache as $value):
            $url = Url::comment($value['gid'], $value['page'], $value['cid']);
        ?>
        <li><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo $url; ?>" title="<?php echo commtent_title($value['gid']);?>上的评论"><img data-original="<?php echo cache_gravatar($value['mail']); ?>" class="avatar avatar-50" height="50" width="50"><?php echo $value['name']; ?> <span class="text-muted"><?php echo smartDate($value['date']); ?>说：<br><?php echo subString(strip_tags($value['content']),0,160); ?></span></a></li>
        <?php endforeach; ?>
    </ul>
</div>