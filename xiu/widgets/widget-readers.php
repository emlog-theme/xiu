<?php
/**
 * 侧边栏组件 - 活跃读者
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
function reader_wall_side($side,$num){
    $CACHE = Cache::getInstance();
    $user_cache = $CACHE->readCache('user');
    if($side=='1'){
        $time_side = strtotime('last Monday',strtotime('Sunday'));
    }elseif($side=='2'){
        $time_side = strtotime('this month',strtotime(date('m/01/y')));
    }else{
        $time_side = 0;
    }
    $DB = MySql::getInstance();
    $userName = $user_cache[1]['name'];
    $sql_side = "SELECT count(1) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date > $time_side and mail != '' and poster != '$userName' and hide ='n' group by mail order by comment_nums DESC limit 0,$num";
    $result_side = $DB->query($sql_side);
    while($row_side = $DB->fetch_array($result_side)){
        $img_side = "<img class=\"avatar avatar-36 photo\" width='36' height='36' alt=''  data-original='".cache_gravatar($row_side['mail'])."' />";
        $tmp_side = "<li><a rel=\"external nofollow\" href='".$row_side['url']."' title='".$row_side['poster']." (吐槽".$row_side['comment_nums']."次)\n".$row_side['url']."' target='_blank'>".$img_side."</a></li>";
        $output_side .= $tmp_side;
    }
    if(empty($output_side)){
        $output_side = "<p style='text-align:center'>墙上还没人，快抢沙发啦~</p>";
    }else{
        $output_side = "<ul>".$output_side."</ul>";
    }
    return $output_side;
}
?>
<div class="widget widget_ui_readers">
    <h3 class="title"><strong>活跃读者</strong></h3>
    <div id="reader"><?php echo reader_wall_side(3,_g('side_readwall_limit_number')); ?></div>
</div>