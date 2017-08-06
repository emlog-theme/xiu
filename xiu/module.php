<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
//widget：blogger
function widget_blogger($title){
    require_once View::getView('widgets/widget-readers');
}
//widget：日历
function widget_calendar($title){
    require_once View::getView('widgets/widget-calendar');
}
//widget：最新微语
function widget_twitter($title){
    require_once View::getView('widgets/widget-twitter');
}
//widget：标签
function widget_tag($title){
    require_once View::getView('widgets/widget-tags');
}
//widget：分类
function widget_sort($title){
    require_once View::getView('widgets/widget-sort');
}
//widget：归档
function widget_archive($title){
    require_once View::getView('widgets/widget-archive');
}
//widget：最新评论
function widget_newcomm($title){
    require_once View::getView('widgets/widget-comment');
}
//widget：最新文章
function widget_newlog($title){
    require_once View::getView('widgets/widget-newlog');
}
//widget：热门文章
function widget_hotlog($title){
    require_once View::getView('widgets/widget-hotlog');
}
//widget：随机文章
function widget_random_log($title){
    require_once View::getView('widgets/widget-random-log');
}
//widget：链接
function widget_link($title){
    require_once View::getView('widgets/widget-links');
}
//widget：搜索
function widget_search($title){
    require_once View::getView('widgets/widget-search');
}
//widget：自定义组件
function widget_custom_text($title, $content){
    require_once View::getView('widgets/widget-text');
}
//blog：导航
function blog_navi(){
    global $CACHE; 
    $navi_cache = $CACHE->readCache('navi');
    foreach($navi_cache as $value):
        if ($value['pid'] != 0) {
            continue;
        }
        $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current-menu-item ' : '';
        $nav_id = $value['id'];
?><li id="menu-item-<?php echo $nav_id; ?>" class="menu-item menu-item-type-taxonomy menu-item-object-category <?php echo $current_tab; ?>menu-item-<?php echo $nav_id; ?>"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a><?php if (!empty($value['children'])) :?><ul class="sub-menu"><?php foreach ($value['children'] as $row){echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';}?></ul><?php endif;?><?php if (!empty($value['childnavi'])) :?><ul class="sub-menu"><?php foreach ($value['childnavi'] as $row){$newtab = $row['newtab'] == 'y' ? ' target="_blank" ' : '';echo '<li><a href="' . $row['url'] . "\"$newtab>" . $row['naviname'].'</a></li>';}?></ul><?php endif;?></li><?php endforeach;}
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
//blog：编辑
function editflg($logid,$author){
    $editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
    echo $editflg;
}
//blog：分类
function blog_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    if(!empty($log_cache_sort[$blogid])){
        echo '分类：<a href="'.Url::sort($log_cache_sort[$blogid]['id']).'" rel="category">'.$log_cache_sort[$blogid]['name'].'</a>';
    }
}
//blog：文章标签
function blog_tag($blogid){
    global $CACHE;
    $log_cache_tags = $CACHE->readCache('logtags');
    if (!empty($log_cache_tags[$blogid])){
        $tag = '标签:';
        foreach ($log_cache_tags[$blogid] as $value){
            $tag .= "    <a href=\"".Url::tag($value['tagurl'])."\" rel=\"tag\">".$value['tagname'].'</a>';
        }
        echo $tag;
    }
}
//blog：文章作者
function blog_author($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
//blog：相邻文章
function neighbor_log($neighborLog){
    extract($neighborLog);
    if($prevLog){
        echo '<span class="article-nav-prev">上一篇<br><a href="'.Url::log($prevLog['gid']).'" rel="prev">'.$prevLog['title'].'</a></span>';
    }
    if($nextLog && $prevLog){
        echo '';
    }
    if($nextLog){
        echo '<span class="article-nav-next">下一篇<br><a href="'.Url::log($nextLog['gid']).'" rel="next">'.$nextLog['title'].'</a></span>';
    }
}
//blog：评论列表
function blog_comments($comments){
    extract($comments);
?><a name="comments"></a><div id="postcomments"><div id="loading-comments" style="display:none"><span>数据加载中......</span></div>
<ol class="commentlist">
    <?php
    $isGravatar = Option::get('isgravatar');
    foreach($commentStacks as $cid):
    $comment = $comments[$cid];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" rel="external nofollow" class="url" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    
    ?>
    <li class="comment depth-1" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <div class="c-avatar"><img data-original="<?php echo cache_gravatar($comment['mail']); ?>" class="avatar avatar-100" height="100" width="100"></div>
        <div class="c-main" id="div-comment-<?php echo $comment['cid']; ?>">
            <span class="c-author"><?php echo $comment['poster']; ?></span><?php echo $comment['content']; ?>
            <time class="c-time"><?php echo timeago($comment['date'],1); ?></time>
            <a class='comment-reply-link' href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
        </div>
        <ul class="children"><?php blog_comments_children($comments, $comment['children']); ?></ul><!-- .children -->
    </li><!-- #comment-## -->
    <?php endforeach; ?>
</ol>
<div class="pagenav" id="pagenavi"><?php echo $commentPageUrl;?></div>
</div>
<?php
}
//blog：子评论列表
function blog_comments_children($comments, $children){
    $isGravatar = Option::get('isgravatar');
    foreach($children as $child):
    $comment = $comments[$child];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" rel="external nofollow" class="url" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
<li class="comment depth-<?php echo $comment['cid']; ?>" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <div class="c-avatar"><img data-original="<?php echo cache_gravatar($comment['mail']); ?>" class="avatar avatar-100" height="100" width="100"></div>
        <div class="c-main" id="div-comment-<?php echo $comment['cid']; ?>">
            <span class="c-author"><?php echo $comment['poster']; ?></span><?php echo $comment['content']; ?>
            <time class="c-time"><?php echo timeago($comment['date'],1); ?></time>
            <a class='comment-reply-link' href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
        </div>
        <?php blog_comments_children($comments, $comment['children']); ?>
    </li><!-- #comment-## -->
    <?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
    if($allow_remark == 'y'): ?>
<a name="respond"></a>
<div id="comment-place">
    <div class="comment-post" id="comment-post">
        <form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
            <input type="hidden" name="gid" value="<?php echo $logid; ?>" />
            <div class="comt-title">
                <div class="comt-avatar">
                    <img data-original="<?php echo cache_gravatar($ckmail); ?>" class="avatar avatar-100" height="100" width="100">
                </div>
                <div class="comt-author"></div>
                <div class="cancel-reply" id="cancel-reply" style="display:none"><a id="cancel-comment-reply-link" href="javascript:void(0);" onclick="cancelReply()">取消</a></div>
            </div>
            <div class="comt">
                <div class="comt-box">
                    <textarea placeholder="<?php echo _g('comment_text'); ?>" class="input-block-level comt-area" name="comment" id="comment" cols="100%" rows="3" tabindex="1" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
                    <div class="comt-ctrl">
                        <div class="comt-tips">
                            <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
                            <div class="comt-tip comt-loading" style="display: none;">正在提交, 请稍候...</div>
                            <div class="comt-tip comt-error" style="display: none;">请填写昵称和邮箱！</div>
                            <?php echo $verifyCode; ?>
                        </div>
                        <button type="submit" name="submit" id="submit" tabindex="5"><i class="icon-ok-circle icon-white icon12"></i> <?php echo _g('comment_submit_text'); ?></button>
                    </div>
                </div>
                <?php if(ROLE == ROLE_VISITOR): ?>
                <div class="comt-comterinfo" id="comment-author-info">
                    <ul>
                        <li class="form-inline"><label class="hide" for="author">昵称</label><input class="ipt" type="text" name="comname" id="comname" value="<?php echo $ckname; ?>" tabindex="2" placeholder="昵称"><span class="text-muted">昵称 (必填)</span></li>
                        <li class="form-inline"><label class="hide" for="email">邮箱</label><input class="ipt" type="text" name="commail" id="commail" value="<?php echo $ckmail; ?>" tabindex="3" placeholder="邮箱"><span class="text-muted">邮箱 (必填)</span></li>
                        <li class="form-inline"><label class="hide" for="url">网址</label><input class="ipt" type="text" name="comurl" id="comurl" value="<?php echo $ckurl; ?>" tabindex="4" placeholder="网址"><span class="text-muted">网址</span></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
    <?php endif; ?>
<?php }?>