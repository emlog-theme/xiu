<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>

    <div class="content-wrap">
        <div class="content">
            <header class="article-header">
                <h1 class="article-title"><a href="<?php echo URL::log($logid); ?>"><?php echo $log_title; ?></a></h1>
                <ul class="article-meta">
                    <li><?php echo excerpt_time($author,$date,'1','1'); ?></li>
                    <li><?php echo blog_sort($logid); ?></li>
                    <?php echo in_array('view',_g('post_plugin')) ? '<li><span class="post-views">阅读('.$views.')</span></li>' : '' ; ?>
                    <span><?php if($comnum<=0):?>暂无评论<?php else:?>评论(<?php echo $comnum;?>)<?php endif;?></span>
                    <li><?php editflg($logid,$author); ?></li>
                </ul>
            </header>
            <?php if( _g('ads_post_01_s')=='y' ) echo '<div class="ads ads-content ads-post">'.hui_get_adcode('ads_post_01').'</div>'; ?>
            <article class="article-content">
                <?php echo $log_content; ?>
                <?php doAction('log_related', $logData); ?>
                <p class="post-copyright"><?php echo _g('post_copyright'); ?><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a> &raquo; <a href="<?php echo $log_url; ?>"><?php echo $log_title; ?></a></p>
            </article>
            
            <?php echo in_array('like',_g('post_plugin')) ? '<div class="article-social">'.likes($logData,2).'</div>' : '' ; ?>
            
            
            <div class="action-share bdsharebuttonbox"><?php echo get_share(); ?></div>
            
            <div class="article-tags"><?php blog_tag($logid); ?></div>
            
            <nav class="article-nav">
                <?php neighbor_log($neighborLog); ?>
            </nav>
			<?php if( _g('ads_post_02_s') == 'y' ) echo '<div class="ads ads-content ads-related">'.hui_get_adcode('ads_post_02').'</div>'; ?>
            <!-- relates-model-text relates-model-thumb -->
            <?php
                if( _g('post_related_s') == 'open'):
                if( _g('post_related_model') == 'thumb' ){
                    $model = ' relates-model-thumb';
                    $models = '1';
                }elseif( _g('post_related_model') == 'text' ){
                    $model = ' relates-model-text';
                    $models = '2';
                }
            ?>
            <div class="relates<?php echo $model; ?>">
                <div class="title"><h3><?php echo _g('related_title'); ?></h3></div>
                <ul><?php related_logs($logData,_g('post_related_n'),$models);?></ul>
            </div>
            <?php endif; ?>
            
            <?php if( _g('sticky_s') == 'open' && _g('sticky_post_s') == 'open' ):?>
            <div class="sticky">
                <h3 class="title"><strong><?php echo _g('sticky_title'); ?></strong></h3>
                <ul><?php echo Home_hot_logs_sev(_g('sticky_limit')); ?></ul>
            </div>
            <?php endif;?>
			<?php if( _g('ads_post_03_s') == 'y' ) echo '<div class="ads ads-content ads-comment">'.hui_get_adcode('ads_post_03').'</div>'; ?>
            <h3 class="title" id="comments"><?php if(ROLE == 'admin' || ROLE == 'writer'):?><div class="text-muted pull-right"><a href="<?php echo BLOG_URL; ?>admin/?action=logout"><span class="glyphicon glyphicon-user"></span> 退出</a></div><?php endif;?><strong><?php if($comnum<=0):?>暂无评论<?php else:?><?php echo _g('comment_title'); ?> <b> <?php echo $comnum;?> </b><?php endif;?></strong></h3>
            
            <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
            
            <div id="postcomments">
            <?php blog_comments($comments); ?>
            </div>
            
            
            
        </div>
    </div>
    <?php include View::getView('side3');?>

<?php include View::getView('footer');?>