<?php 
/**
 * Template name: Menu
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<div class="pageside">
    <div class="pagemenus">
        <ul class="pagemenu">
            <?php
                $explode=explode(",",_g('page_menu'));
                foreach ($explode as $k => $id){
                    $db = MySql::getInstance();
                    $sql = "SELECT * FROM " . DB_PREFIX . "blog WHERE gid='$id'";
                    $list = $db->query($sql);
                    $page_menus = $db->fetch_array($list);
                    $page_currents = BLOG_URL . trim(Dispatcher::setPath(), '/') == Url::log($page_menus['gid']) ? ' class="active"' : '';
                    echo "<li ".$page_currents."><a href=".Url::log($page_menus['gid']).">".$page_menus['title']."</a></li>";
                }
            ?>
        </ul>
    </div>
</div>