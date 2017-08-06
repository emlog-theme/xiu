<?php 
/**
 * 文章列表页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<?php doAction('index_loglist_top'); ?>
    <?php if (!empty($logs)):?>
    <div class="content-wrap">
        <div class="content">
            <?php
                $Log_Model = new Log_Model();
                $today = strtotime(date('Y-m-d'));//今天凌晨时间戳
                $tenday = strtotime(date('Y-m-d',strtotime('-7 day')));//一周凌晨时间戳
                $today_sql = "and date>$today";
                $today_num = $Log_Model->getLogNum('n', $today_sql);
                $tenday_sql = "and date>$tenday";
                $tenday_num = $Log_Model->getLogNum('n', $tenday_sql);
				if( $sortName ){ echo _g('ads_cat_01_s')=='y' ? '<div class="ads ads-content">'.hui_get_adcode('ads_cat_01').'</div>' : '';}
				if( $tag ){ echo _g('ads_tag_01_s')=='y' ? '<div class="ads ads-content">'.hui_get_adcode('ads_tag_01').'</div>' : '';}
				if( $keyword ){ echo _g('ads_search_01_s')=='y' ? '<div class="ads ads-content">'.hui_get_adcode('ads_search_01').'</div>' : '';}
            ?>
            <h3 class="title"><?php if(_g('recent_posts_number') == 'open'):?><small class="pull-right">24小时更新：<?php if($today_num=="0"):?>0<?php else:?><?php echo $today_num;?><?php endif;?>篇 &nbsp; &nbsp; 一周更新：<?php if($tenday_num=="0"):?>0<?php else:?><?php echo $tenday_num;?><?php endif;?>篇</small><?php endif;?><?php
if($params[1]=='sort'){
    if (isset($sort_cache[$sort_cache[$sortid]['pid']])){
        echo '<a href="'.Url::sort($sort_cache[$sortid]['pid']).'">'.$sort_cache[$sort_cache[$sortid]['pid']]['sortname'].'</a>&raquo';
    }
    echo '<strong>'.$sortName.'</strong>';
}elseif($params[1]=='tag'){
    echo '<strong>标签：'.htmlspecialchars(urldecode($params[2])).'</strong>';
}elseif($params[1]=='author'){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    echo '<strong>'.$user_cache[$author]['name'].'的文章</strong>';
}elseif($params[1]=='keyword'){
    echo '<strong>'.htmlspecialchars(urldecode($params[2])).' 的搜索结果</strong>';
}elseif($params[1]=='record'){
    echo '<strong>'.substr($params[2],0,4).'年'.substr($params[2],4,2).'月的文章</strong>';
}elseif($params[1]=='page'){
    echo '<strong>最新发布</strong> <small>第 '.htmlspecialchars(urldecode($params[2])).' 页</small>';
}?></h3>
            <?php
                foreach($logs as $value):
                $logdes = blog_tool_purecontent($value['content'], 178);
                if(pic_thumb($value['content'])){
                    $imgsrc = pic_thumb($value['content']);
                }else{
                    $imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,12).'.jpg';
                }
                if(preg_match_all("/<img.*?src=[\"'](.*?)[\"']/i", $value['content'], $imgs) && !empty($imgs[1])){
                    $excerpt = count($imgs[1]) < 4 ? ' excerpt-one' : ' excerpt-multi';
                }else{
                    $excerpt = ' excerpt-one';
                }
            ?>
            <article class="excerpt<?php echo $excerpt; ?>">
                <header>
                    <?php echo xiu_sort($value['logid']); ?>
                    <h2><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>-<?php echo $blogname; ?>"><?php echo $value['log_title']; ?></a></h2>
                    <small class="text-muted"><span class="glyphicon glyphicon-picture"></span><?php echo pic($value['content']);?></small>
                </header>
                <p class="text-muted time"><?php echo excerpt_time($value['author'],$value['date'],'1','2'); ?></p>
                <p class="focus">
                    <a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo $value['log_url']; ?>" class="thumbnail">
                        <?php
                            if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $value['content'], $imgs) && !empty($imgs[1])){
                                $imgNum = count($imgs[1]);
                                if($imgNum < 4){$n = 1;
                                }elseif($imgNum < 8){$n = 4;
                                }else{ $n = 8;}
                                for($i=0; $i < $n; $i++){
                                    $img = $imgs[1][$i];
                                    echo "<span class=\"item\"><span class=\"thumb-span\"><img data-original='$img' class=\"thumb\" ></span></span>";
                                }
                            }else{
                                echo "<span class=\"item\"><span class=\"thumb-span\"><img data-original='$imgsrc' class=\"thumb\" ></span></span>";
                            }
                        ?>
                    </a>
                </p>
                <p class="note"><?php echo $logdes; ?></p>
                <p class="text-muted views">
                    <?php echo in_array('view',_g('post_plugin')) ? '<span class="post-views">阅读('.$value['views'].')</span>' : '' ; ?>
                    <?php echo in_array('comm',_g('post_plugin')) ? '<span class="post-comments">评论('.$value['comnum'].')</span>' : '' ; ?>
                    <?php echo in_array('like',_g('post_plugin')) ? likes($Log_Model->getOneLogForHome($value['logid']),1) : '' ; ?>
                    <span class="post-tags"><?php echo blog_tag($value['logid']); ?></span>
                </p>
            </article>
            <?php endforeach; ?>
            <div class="pagination pagination-multi"><div class="pagination pagination-multi"><?php if( _g('paging_type') == 'next'){echo xiu_page_next($lognum,$index_lognum,$page,$pageurl);}elseif( _g('paging_type') == 'multi'){echo xiu_page($lognum,$index_lognum,$page,$pageurl);}?></div></div>
        </div>
    </div>
    <?php include View::getView('side2');?>
    <?php else:?>
    <div class="content-wrap">
        <div class="content">
            <?php hui_404() ?>
        </div>
    </div>
    <?php endif;?>

<?php include View::getView('footer');?>