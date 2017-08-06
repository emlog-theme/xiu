<?php
/**
 * Template name: 标签云
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if( $tpl_side == 'y' ){include View::getView('page/pagemenu');}
?>
    <div class="content-wrap">
        <div class="content page-tags <?php if( $tpl_side == 'y' ){echo ' no-sidebar';}?>">
            <h1 class="title"><strong><a href="<?php echo URL::log($logid); ?>"><?php echo $log_title; ?></a></strong></h1>
            <p>&nbsp;</p>
            <article class="article-content">
                <?php echo $log_content; ?>
            </article>
			<ul class="tagslist">
                <?php
                    global $CACHE;
                    $tag_cache = $CACHE->readCache('tags');
                    foreach($tag_cache as $value){
                        if($value['usenum']<=0){
                            $usenum = '';
                        }else{
                            $usenum = '<strong>x '.$value['usenum'].'</strong>';
                        }
                        echo '<li><a class="tagname" href="'.Url::tag($value['tagurl']).'">'.$value['tagname'].'</a>'.$usenum.'</li>';
                    }
                ?>
            </ul>
            <p>&nbsp;</p>
            <?php if( $allow_remark == 'y' ):?>
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