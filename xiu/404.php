<?php 
/**
 * 自定义404页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('modules/mo-header');
?>
<div class="content-wrap">
	<div class="content">
		<?php hui_404() ?>
	</div>
</div>
<?php include View::getView('footer');?>