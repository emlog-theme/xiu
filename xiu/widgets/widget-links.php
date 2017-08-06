<?php
/**
 * 侧边栏组件 - 友情链接
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
global $CACHE; 
$link_cache = $CACHE->readCache('link');
//if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
?>
<div class="widget widget_links" >
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <ul>
        <?php foreach($link_cache as $value): ?>
        <li><i class="fa fa-link fa-fw"></i><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>