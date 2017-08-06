<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php if( $layout == 'ui-navtop' || $layout == 'ui-c3-top' ){ ?>
</div>
</section>
<?php } ?>
<footer class="footer">
    <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a> / <a href="http://www.emlog.net" target="_blank">Emlog</a> Theme Modify By lonewolf <a target="_blank" href="<?php echo BLOG_URL; ?>sitemap.xml">网站地图</a></p>
    <p><?php if(!empty($icp)):?><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a><?php endif;?></p>
</footer>
<?php if( $layout !== 'ui-navtop' ){ ?>
</section>
<?php } ?>

<?php  
$roll = '';
if( blog_tool_ishome() && _g('sideroll_index_s') == 'open' ){
    $roll = _g('sideroll_index');
}else if( ( $sortName || $tag || $keyword ) && _g('sideroll_list_s') == 'open' ){
    $roll = _g('sideroll_list');
}else if( $logid && _g('sideroll_post_s') == 'open' ){
    $roll = _g('sideroll_post');
}else if( $type=='page' && _g('sideroll_page_s') == 'open' ){
    $roll = _g('sideroll_page');
}

$ajaxpager = '0';
if( ((!em_is_mobile() && _g('ajaxpager_s') == 'open' ) || (em_is_mobile() && _g('ajaxpager_s_m') == 'open' )) && _g('ajaxpager') != 0 ){
    $ajaxpager = _g('ajaxpager');
}

?>
<script>
window.jui = {
    www: '<?php echo BLOG_URL; ?>',
    uri: '<?php echo TEMPLATE_URL ?>',
    roll: '<?php echo $roll ?>',
    ajaxpager: '<?php echo $ajaxpager ?>'
}
</script>
<div class="hide"><?php echo $footer_info; ?></div>
<?php echo load_script(); ?>
<?php doAction('index_footer'); ?>
</body>
</html>