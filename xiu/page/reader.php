<?php
/**
 * Template name: 读者墙
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if( $tpl_side == 'y' ){include View::getView('page/pagemenu');}
function reader($readernum){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $name = $user_cache[1]['name'];
    $DB = MySql :: getInstance();
    $sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='匿名' and hide ='n' group by poster order by comment_nums DESC limit 0,$readernum";
    $result = $DB->query( $sql );
    $x=1;
    while($row = $DB->fetch_array($result))
        if($x<=1){
            if($row['url']){
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }else{
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }
            $output .= $tmp;
            $x++;
        }elseif($x<=2){
            if($row['url']){
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }else{
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }
            $output .= $tmp;
            $x++;
        }elseif($x<=3){            
            if($row[ 'url']){
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }else{
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }
            $output .= $tmp;
            $x++;
        }elseif($x>=4){
            $img = "";
            if($row['url']){
                $tmp = "<a target=\"_blank\" href=\"{$row['url']}\" title=\"{$row['poster']} 评论{$row[ 'comment_nums' ]}次\"><img data-original=\"".cache_gravatar($row['mail'])."\" class=\"avatar avatar-100\" height=\"100\" width=\"100\"></a>";
            }else{
                $tmp = $img;
            }
            $output .= $tmp;
            $x++;
        }
        $output = '<div class="readers">'. $output .'</div>';
        echo $output ;
}
?>

    <div class="content-wrap">
        <div class="content page-readerwall<?php if( $tpl_side == 'y' ){echo ' no-sidebar';}?>">
            <h1 class="title"><strong><a href="<?php echo URL::log($logid); ?>"><?php echo $log_title; ?></a></strong></h1>
            <article class="article-content">
                <?php echo $log_content; ?>
            </article>
            <?php echo reader(_g('readwall_limit_number'));?>
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