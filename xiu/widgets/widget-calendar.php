<?php
/**
 * 侧边栏组件 - 日历
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
function calendar() {
    $DB = Database::getInstance();
    $timezone = Option::get('timezone');
    $timestamp = time() + $timezone * 3600;
    
    $query = $DB->query("SELECT date FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog'");
    while ($date = $DB->fetch_array($query)) {
        $logdate[] = gmdate("Ymd", $date['date'] + $timezone * 3600);
    }
    $n_year  = gmdate("Y", $timestamp);
    $n_year2 = gmdate("Y", $timestamp);
    $n_month = gmdate("m", $timestamp);
    $n_day   = gmdate("d", $timestamp);
    $time    = gmdate("Ymd", $timestamp);
    $year_month = gmdate("Ym", $timestamp);
    
    if (isset($_GET['record'])) {
        $n_year = substr(intval($_GET['record']),0,4);
        $n_year2 = substr(intval($_GET['record']),0,4);
        $n_month = substr(intval($_GET['record']),4,2);
        $year_month = substr(intval($_GET['record']),0,6);
    }
    
    $m  = $n_month - 1;
    $mj = $n_month + 1;
    $m  = ($m < 10) ? '0' . $m : $m;
    $mj = ($mj < 10) ? '0' . $mj : $mj;
    $year_up = $n_year;
    $year_down = $n_year;
    if ($mj > 12) {
        $mj = '01';
        $year_up = $n_year + 1;
    }
    if ( $m < 1) {
        $m = '12';
        $year_down = $n_year - 1;
    }
    $url = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year - 1) . $n_month;
    $url2 = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year + 1) . $n_month;
    $url3 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_down . $m;
    $url4 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_up . $mj;

    $calendar ="<table id=\"calendar\"><caption>{$n_year2}年{$n_month}月</caption><thead><tr><th scope=\"col\" title=\"星期一\">一</th><th scope=\"col\" title=\"星期二\">二</th><th scope=\"col\" title=\"星期三\">三</th><th scope=\"col\" title=\"星期四\">四</th><th scope=\"col\" title=\"星期五\">五</th><th scope=\"col\" title=\"星期六\">六</th><th scope=\"col\" title=\"星期日\">日</th></tr></thead><tbody>";
        
    $week = @gmdate("w",gmmktime(0,0,0,$n_month,1,$n_year));
    $lastday = @gmdate("t",gmmktime(0,0,0,$n_month,1,$n_year));
    $lastweek = @gmdate("w",gmmktime(0,0,0,$n_month,$lastday,$n_year));
    if ($week == 0) {
        $week = 7;
    }
    $j = 1;
    $w = 7;
    $isend = false;
    for ($i = 1;$i <= 6;$i++) {
        if ($isend || ($i == 6 && $lastweek==0)) {
            break;
        }
        $calendar .= '<tr>';
        for ($j ; $j <= $w; $j++) {
            if ($j < $week) {
                $calendar.= '<td>&nbsp;</td>';
            } elseif ( $j <= 7 ) {
                $r = $j - $week + 1;
                $n_time = $n_year . $n_month . '0' . $r;
                if (@in_array($n_time,$logdate) && $n_time == $time) {
                    $calendar .= '<td id="today">'. $r .'</td>';
                } elseif (@in_array($n_time,$logdate)) {
                    $calendar .= '<td>'. $r .'</td>';
                } elseif ($n_time == $time) {
                    $calendar .= '<td id="today">'. $r .'</td>';
                } else {
                    $calendar.= '<td>'. $r .'</td>';
                }
            } else {
                $t = $j - ($week - 1);
                if ($t > $lastday) {
                    $isend = true;
                    $calendar .= '<td>&nbsp;</td>';
                } else {
                    $t < 10 ? $n_time = $n_year . $n_month . '0' . $t : $n_time = $n_year . $n_month . $t;
                    if (@in_array($n_time,$logdate) && $n_time == $time) {
                        $calendar .= '<td id="today">'. $t .'</td>';
                    } elseif(@in_array($n_time,$logdate)) {
                        $calendar .= '<td>'. $t .'</td>';
                    } elseif($n_time == $time) {
                        $calendar .= '<td id="today">'. $t .'</td>';
                    } else {
                        $calendar .= '<td>'.$t.'</td>';
                    }
                }
            }
        }
        $calendar .= '</tr>';
        $w += 7;
    }
    $calendar .= '</tbody></table>';
    echo $calendar;
}
?>
<div class="widget widget_calendar">
    <h3 class="title"><strong><?php echo $title; ?></strong></h3>
    <div id="calendar_wrap"><?php echo calendar(); ?></div>
</div>