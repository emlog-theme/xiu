<?php 
/**
 * 导航顶部三栏模式
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if( $layout !== 'ui-c3-top' ) return false;
?>
<aside class="speedbar-wrap">
    <div class="speedbar">
        <ul class="speedbar-menu">
            <?php
                $explode=explode(",",_g('speed_menu'));
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
        <div class="speedbar-weixin">
            <h5>微信关注“<?php echo _g('wechat'); ?>”<br>每天分享有趣的事儿</h5>
            <img src="<?php echo _g('wechat_qr'); ?>" alt="">
        </div>
    </div>
</aside>