<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
$Log_Model = new Log_Model();
?>
<?php doAction('index_loglist_top'); ?>
    <div class="content-wrap">
        <div class="content excerpts">
            <?php
                $Log_Model = new Log_Model();
                $today = strtotime(date('Y-m-d'));//今天凌晨时间戳
                $tenday = strtotime(date('Y-m-d',strtotime('-7 day')));//一周凌晨时间戳
                $today_sql = "and date>$today";
                $today_num = $Log_Model->getLogNum('n', $today_sql);
                $tenday_sql = "and date>$tenday";
                $tenday_num = $Log_Model->getLogNum('n', $tenday_sql);
				if( _g('ads_index_01_s') == 'y' ) echo '<div class="ads ads-content">'.hui_get_adcode('ads_index_01').'</div>';
				echo _g('ads_index_02_s')=='y' ? '<div class="ads ads-content">'.hui_get_adcode('ads_index_02').'</div>' : '';
            ?>
            <h3 class="title"><?php if(_g('recent_posts_number') == 'open'):?><small class="pull-right">24小时更新：<?php if($today_num=="0"):?>0<?php else:?><?php echo $today_num;?><?php endif;?>篇 &nbsp; &nbsp; 一周更新：<?php if($tenday_num=="0"):?>0<?php else:?><?php echo $tenday_num;?><?php endif;?>篇</small><?php endif;?><strong><?php echo _g('index_list_title'); ?></strong></h3>
            <?php
                foreach($logs as $value):
                $logdes = blog_tool_purecontent($value['content'], 178);
                if(pic_thumb($value['content'])){
                    $imgsrc = pic_thumb($value['content']);
                }else{
                    $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,12).'.jpg';
                }
            ?>
            <article class="excerpt">
                <a class="thumbnail" href="<?php echo $value['log_url']; ?>"><img data-original="<?php echo $imgsrc; ?>" class="thumb"></a>
                <h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>-<?php echo $blogname; ?>"><?php echo $value['log_title']; ?></a></h2>
                <p class="note"><?php echo $logdes; ?></p>
                <footer>
                    <time class="new"><?php echo timeago($value['date'],1); ?></time>
                    /<?php echo in_array('like',_g('post_plugin')) ? likes($Log_Model->getOneLogForHome($value['logid']),1) : '' ; ?>
                    <?php echo in_array('view',_g('post_plugin')) ? '<span class="post-views">阅读('.$value['views'].')</span>' : '' ; ?>
                </footer>
            </article>
            <?php endforeach; ?>
            <div class="pagination pagination-multi"><?php if( _g('paging_type') == 'next'){echo xiu_page_next($lognum,$index_lognum,$page,$pageurl);}elseif( _g('paging_type') == 'multi'){echo xiu_page($lognum,$index_lognum,$page,$pageurl);}?></div>
			<?php echo _g('ads_index_03_s')=='y' ? '<div class="ads ads-content">'.hui_get_adcode('ads_index_03').'</div>' : '' ?>
        </div>
    </div>
    <?php include View::getView('side1');?>

<?php include View::getView('footer');?>