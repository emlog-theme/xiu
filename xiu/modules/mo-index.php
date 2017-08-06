<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<?php doAction('index_loglist_top'); ?>
    <div class="content-wrap">
        <div class="content">
            <?php
				if( _g('ads_index_01_s') == 'y' ) echo '<div class="ads ads-content">'.hui_get_adcode('ads_index_01').'</div>';
				if(_g('focusslide_s')=='open'):
			?>
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                    <li data-target="#slider" data-slide-to="3"></li>
                    <li data-target="#slider" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <a<?php echo target_blank(_g('focusslide_blank_1')); ?> href="<?php echo _g('focusslide_href_1'); ?>"><img src="<?php echo _g('focusslide_src_1'); ?>"><span class="carousel-caption"><?php echo _g('focusslide_title_1'); ?></span><span class="carousel-bg"></span></a>
                    </div>
                    <div class="item">
                        <a<?php echo target_blank(_g('focusslide_blank_2')); ?> href="<?php echo _g('focusslide_href_2'); ?>"><img src="<?php echo _g('focusslide_src_2'); ?>"><span class="carousel-caption"><?php echo _g('focusslide_title_2'); ?></span><span class="carousel-bg"></span></a>
                    </div>
                    <div class="item">
                        <a<?php echo target_blank(_g('focusslide_blank_3')); ?> href="<?php echo _g('focusslide_href_3'); ?>"><img src="<?php echo _g('focusslide_src_3'); ?>"><span class="carousel-caption"><?php echo _g('focusslide_title_3'); ?></span><span class="carousel-bg"></span></a>
                    </div>
                    <div class="item">
                        <a<?php echo target_blank(_g('focusslide_blank_4')); ?> href="<?php echo _g('focusslide_href_4'); ?>"><img src="<?php echo _g('focusslide_src_4'); ?>"><span class="carousel-caption"><?php echo _g('focusslide_title_4'); ?></span><span class="carousel-bg"></span></a>
                    </div>
                    <div class="item">
                        <a<?php echo target_blank(_g('focusslide_blank_5')); ?> href="<?php echo _g('focusslide_href_5'); ?>"><img src="<?php echo _g('focusslide_src_5'); ?>"><span class="carousel-caption"><?php echo _g('focusslide_title_5'); ?></span><span class="carousel-bg"></span></a>
                    </div>
                </div>
                <a class="left carousel-control" href="#slider" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
                <a class="right carousel-control" href="#slider" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
            </div>
            <?php endif;?>
            <?php if(_g('focus_s')=='open'): ?>
            <div class="focusmo">
                <ul>
                    <li class="large"><a href="<?php echo _g('focus_href'); ?>"><img class="thumb" data-original="<?php echo _g('focus_src'); ?>"><h4><?php echo _g('focus_title'); ?></h4></a></li>
                    <?php echo Home_Top_Logs(); ?>
                </ul>
            </div>
            <?php endif;?>
            <?php if(_g('most_list_s')=='open'):?>
            <div class="most-comment-posts">
                <h3 class="title"><strong><?php echo _g('most_list_title'); ?></strong></h3>
                <ul>
                    <?php
                        $i=0;
                        $db = MySql::getInstance();
                        $times = _g('most_list_date');
                        $time = time();
                        $num = _g('most_list_number');
                        $type = _g('most_list_style');
                        $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - {$times}*24*60*60 ORDER BY `{$type}` DESC LIMIT 0,{$num}";
                        $list = $db->query($sql);
                        while($row = $db->fetch_array($list)){
                            $i++;
                    ?>
                    <li><p class="text-muted"><span class="post-comments">阅读 (<?php echo $row['comnum']; ?>)</span><?php doAction('ja_praise', $row['gid']); ?></p><span class="label label-<?php echo $i; ?>"><?php echo $i; ?></span><a target="_blank" href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></li>
                    <?php }?>
                </ul>
            </div>
            <?php endif;?>
            <?php if(_g('sticky_s')=='open'):?>
            <div class="sticky">
                <h3 class="title"><strong><?php echo _g('sticky_title'); ?></strong></h3>
                <ul><?php echo Home_hot_logs_sev(_g('sticky_limit')); ?></ul>
            </div>
            <?php endif;?>
            <?php
                $Log_Model = new Log_Model();
                $today = strtotime(date('Y-m-d'));//今天凌晨时间戳
                $tenday = strtotime(date('Y-m-d',strtotime('-7 day')));//一周凌晨时间戳
                $today_sql = "and date>$today";
                $today_num = $Log_Model->getLogNum('n', $today_sql);
                $tenday_sql = "and date>$tenday";
                $tenday_num = $Log_Model->getLogNum('n', $tenday_sql);
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
                if(preg_match_all("/<img.*?src=[\"'](.*?)[\"']/i", $value['content'], $imgs) && !empty($imgs[1])){
                    $excerpt = count($imgs[1]) < 4 ? ' excerpt-one' : ' excerpt-multi';
                }else{
                    $excerpt = ' excerpt-one';
                }
            ?>
            <article class="excerpt<?php echo $excerpt; ?>">
                <header>
                    <?php echo xiu_sort($value['logid']); ?>
                    <h2><a<?php echo target_blank(_g('target_blank')); ?> href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']._g('connector').$blogname; ?>"><?php echo $value['log_title']; ?></a></h2>
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
            <div class="pagination pagination-multi"><?php if( _g('paging_type') == 'next'){echo xiu_page_next($lognum,$index_lognum,$page,$pageurl);}elseif( _g('paging_type') == 'multi'){echo xiu_page($lognum,$index_lognum,$page,$pageurl);}?></div>
			<?php echo _g('ads_index_03_s')=='y' ? '<div class="ads ads-content">'.hui_get_adcode('ads_index_03').'</div>' : '' ?>
        </div>
    </div>
    <?php include View::getView('side1');?>

<?php include View::getView('footer');?>