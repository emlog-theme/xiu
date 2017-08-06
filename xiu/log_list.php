<?php
/**
 * 站点模板加载判断
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(blog_tool_ishome()){
    if( $layout == 'ui-c3-top' ){
        include View::getView('modules/mo-c3t');
    }else{
        include View::getView('modules/mo-index');
    }
}else{
    if( $layout == 'ui-c3-top' ){
        include View::getView('modules/mo-c3t-log');
    }else{
        include View::getView('modules/mo-log');
    }
}
?>