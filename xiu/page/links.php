<?php
/**
 * Template name: 友情链接
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if( $tpl_side == 'y' ){include View::getView('page/pagemenu');}
?>

    <div class="content-wrap">
        <div class="content page-links<?php if( $tpl_side == 'y' ){echo ' no-sidebar';}?>">
            <h1 class="title"><strong><a href="<?php echo URL::log($logid); ?>"><?php echo $log_title; ?></a></strong></h1>
            <p>&nbsp;</p>
            <article class="article-content">
                <?php echo $log_content; ?>
            </article>
            <ul class="plinks linkcat">
                <ul class='xoxo blogroll'>
                    <?php
                        global $CACHE; 
                        $link_cache = $CACHE->readCache('link');
                        foreach($link_cache as $value):
                    ?>
                    <li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </ul>
            <?php if( $allow_remark == 'y' ):?>
            <p>&nbsp;</p>
            <h3 class="title" id="comments"><?php if(ROLE == 'admin' || ROLE == 'writer'):?><div class="text-muted pull-right"><a href="<?php echo BLOG_URL; ?>admin/?action=logout"><span class="glyphicon glyphicon-user"></span> 退出</a></div><?php endif;?><strong><?php if($comnum<=0):?>暂无评论<?php else:?><?php echo _g('comment_title'); ?> <b> <?php echo $comnum;?> </b><?php endif;?></strong></h3>
            <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
            <div id="postcomments">
            <?php blog_comments($comments); ?>
            </div>
            <?php endif;?>
            
        </div>
    </div>
    <?php include View::getView('side4');?>

<?php include View::getView('footer');?>