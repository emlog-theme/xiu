<?php 
/**
 * 侧边栏组件 - 搜索
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="widget widget_searchbox">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <form name="keyform" method="get" class="search-form" action="<?php echo BLOG_URL; ?>index.php">
        <input class="form-control" name="keyword" type="text" placeholder="输入关键字" value="">
        <input class="btn" type="submit" value="搜索">
    </form>
</div>