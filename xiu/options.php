<?php
/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$CACHE = Cache::getInstance();
$options_cache = $CACHE->readCache('options');
$options = array(
    /* 全局设置 ======================================================================*/
    'layout' => array(
        'type' => 'radio',
        'name' => '布局选择',
        'values' => array(
            'ui-navtop' => '<img src="'.TEMPLATE_URL.'images/layout/navtop.png" >',
            'ui-c3' => '<img src="'.TEMPLATE_URL.'images/layout/c3.png" >',
            'ui-c2' => '<img src="'.TEMPLATE_URL.'images/layout/c2.png" >',
            'ui-c3-top' => '<img src="'.TEMPLATE_URL.'images/layout/c3-top.png" >',
        ),
        'description' => '4种布局供选择，点击选择你喜欢的布局方式，保存后前端展示会有所改变。',
        'default' => 'ui-c3-top',
    ),
    'theme_skin' => array(
        'type' => 'radio',
        'name' => '主题风格',
        'values' => array(
            '1' => 'DIY主题',
            'FF5E52' => '<span class="swatch" style="background-color:#FF5E52;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '2CDB87' => '<span class="swatch" style="background-color:#2CDB87;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '00D6AC' => '<span class="swatch" style="background-color:#00D6AC;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '16C0F8' => '<span class="swatch" style="background-color:#16C0F8;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'EA84FF' => '<span class="swatch" style="background-color:#EA84FF;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'FDAC5F' => '<span class="swatch" style="background-color:#FDAC5F;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'FD77B2' => '<span class="swatch" style="background-color:#FD77B2;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '76BDFF' => '<span class="swatch" style="background-color:#76BDFF;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'C38CFF' => '<span class="swatch" style="background-color:#C38CFF;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'FF926F' => '<span class="swatch" style="background-color:#FF926F;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '8AC78F' => '<span class="swatch" style="background-color:#8AC78F;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            'C7C183' => '<span class="swatch" style="background-color:#C7C183;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
            '555555' => '<span class="swatch" style="background-color:#555555;display: inline-block;padding: 9px 12px;margin: 0 5px 0 0;line-height: 16px;margin-right: 3px;"></span>',
        ),
        'default' => 'FF5E52',
    ),
    'theme_skin_custom' =>array(
        'type' => 'text',
        'name' => '全站颜色模式设置',
        'description' => '不喜欢上面提供的颜色，你好可以在这里自定义设置，如果不用自定义颜色清空即可（默认不用自定义）<br />颜色代码参考：<br /><a style="color:red" href="http://apps2.bdimg.com/store/static/kvt/0d5af66ae6f8fcfbc5b4ffd8f1d0d6d1.swf" target="_blank">http://apps2.bdimg.com/store/static/kvt/0d5af66ae6f8fcfbc5b4ffd8f1d0d6d1.swf</a><br /><a style="color:red" href="http://www.bootcss.com/p/websafecolors/" target="_blank">http://www.bootcss.com/p/websafecolors/</a>',
        'values' => array(
            '',
        ),
    ),
    'connector' =>array(
        'type' => 'text',
        'name' => '全站连接符',
        'description' => '一经选择，切勿更改，对SEO不友好，一般为“-”或“_”',
        'values' => array(
            '-',
        ),
    ),
    'site_width' =>array(
        'type' => 'text',
        'name' => '网页最大宽度',
        'description' => '默认：1280，单位：px（像素）',
        'values' => array(
            '1280',
        ),
    ),
    'jquery_bom' => array(
        'type' => 'radio',
        'name' => 'jQuery底部加载',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '可提高页面内容加载速度，但部分依赖jQuery的插件可能失效',
        'default' => 'close',
    ),
    'js_outlink' => array(
        'type' => 'radio',
        'name' => 'JS文件托管（可大幅提速JS加载）',
        'values' => array(
            'no' => '不托管',
            'baidu' => '百度',
            '360' => '360',
            'he' => '框架来源站点（分别引入jquery和bootstrap官方站点JS文件）',
        ),
        'default' => 'no',
    ),
    'site_gray' => array(
        'type' => 'radio',
        'name' => '网站整体变灰',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '支持IE、Chrome，基本上覆盖了大部分用户，不会降低访问速度',
        'default' => 'close',
    ),
    'menu_links' => array(
        'type' => 'text',
        'name' => '头部菜单设置',
        'multi' => true,
        'default' => '<a href="'.BLOG_URL.'" title="链接01">链接01</a>|<a href="'.BLOG_URL.'" title="链接02">链接02</a>|<a href="'.BLOG_URL.'" title="链接03">链接03</a>',
        'description' => '案例：&lt;a href="'.BLOG_URL.'" title="链接01"&gt;链接01&lt;/a&gt;',
    ),
    'search_nav' => array(
        'type' => 'radio',
        'name' => '导航搜索框',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '开启后会在导航区域增加搜索框，不同布局不同展示方式',
        'default' => 'close',
    ),
    'sign_f' => array(
        'type' => 'radio',
        'name' => '前端登录注册链接',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '',
        'default' => 'close',
    ),
    /* 基本设置 ======================================================================*/
    'target_blank' => array(
        'type' => 'radio',
        'name' => '新窗口打开文章',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '',
        'default' => 'close',
    ),
    'paging_type' => array(
        'type' => 'radio',
        'name' => '分页模式',
        'values' => array(
            'next' => '上一页 和 下一页',
            'multi' => '显示页码，如：上一页 1 2 3 4 5 下一页',
        ),
        'default' => 'next',
    ),
    'ajaxpager_s' => array(
        'type' => 'radio',
        'name' => 'PC端分页无限加载',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'close',
    ),
    'ajaxpager_s_m' => array(
        'type' => 'radio',
        'name' => '手机端分页无限加载',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'close',
    ),
    'ajaxpager' =>array(
        'type' => 'text',
        'name' => '分页无限加载页数',
        'description' => '为0时表示不开启分页无限加载功能，默认为5',
        'values' => array(
            '5',
        ),
    ),
    'list_thumb_left' => array(
        'type' => 'radio',
        'name' => '列表图片左侧',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'description' => '注：此选择对手机端无效！',
        'default' => 'close',
    ),
    'post_plugin' => array(
        'type' => 'checkbox',
        'name' => '文章小部件开启',
        'values' => array(
            'view' => '阅读量',
            'like' => '点赞',
            'comm' => '列表评论数',
            'siteauthor' => '列表作者名字前加网站名称',
        ),
        'default' => array('view','like','comm'),
    ),
    'author_link' => array(
        'type' => 'radio',
        'name' => '作者加链接',
        'description' => '开启后列表和文章有作者的地方都会加上链接',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'close',
    ),
    'recent_posts_number' => array(
        'type' => 'radio',
        'name' => '首页近期发布文章数目',
        'description' => '例：显示样式：24小时更新：5篇   一周更新：5篇最近更新',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'close',
    ),
    'post_related_s' => array(
        'type' => 'radio',
        'name' => '文章页相关文章',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'open',
    ),
    'post_related_n' =>array(
        'type' => 'text',
        'name' => '文章页相关文章显示数量',
        'description' => '',
        'values' => array(
            '8',
        ),
    ),
    'post_related_model' => array(
        'type' => 'radio',
        'name' => '文章页相关文章模板',
        'values' => array(
            'thumb' => '图文模式',
            'text' => '文字链模式',
        ),
        'default' => 'thumb',
    ),
    /* 首页轮换图 ======================================================================*/
    'focusslide_s' => array(
        'type' => 'radio',
        'name' => '轮换图状态',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'close',
    ),
    'focusslide_s_m' => array(
        'type' => 'radio',
        'name' => '移动端状态',
        'values' => array(
            'open' => '显示',
            'close' => '隐藏',
        ),
        'default' => 'close',
    ),
    'focusslide_title_1' =>array(
        'type' => 'text',
        'name' => '图1-标题',
        'description' => '',
        'values' => array($options_cache['blogname']),
    ),
    'focusslide_href_1' =>array(
        'type' => 'text',
        'name' => '图1-链接',
        'description' => '',
        'values' => array(BLOG_URL),
    ),
    'focusslide_blank_1' => array(
        'type' => 'radio',
        'name' => '图1-是否新窗口',
        'values' => array(
            'open' => '新窗口打开',
            'close' => '关闭新窗口',
        ),
        'default' => 'close',
    ),
    'focusslide_src_1' =>array(
        'type' => 'image',
        'name' => '图1-图片地址',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    
    'focusslide_title_2' =>array(
        'type' => 'text',
        'name' => '图2-标题',
        'description' => '',
        'values' => array($options_cache['blogname']),
    ),
    'focusslide_href_2' =>array(
        'type' => 'text',
        'name' => '图2-链接',
        'description' => '',
        'values' => array(BLOG_URL),
    ),
    'focusslide_blank_2' => array(
        'type' => 'radio',
        'name' => '图2-是否新窗口',
        'values' => array(
            'open' => '新窗口打开',
            'close' => '关闭新窗口',
        ),
        'default' => 'close',
    ),
    'focusslide_src_2' =>array(
        'type' => 'image',
        'name' => '图2-图片地址',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    
    'focusslide_title_3' =>array(
        'type' => 'text',
        'name' => '图3-标题',
        'description' => '',
        'values' => array($options_cache['blogname']),
    ),
    'focusslide_href_3' =>array(
        'type' => 'text',
        'name' => '图3-链接',
        'description' => '',
        'values' => array(BLOG_URL),
    ),
    'focusslide_blank_3' => array(
        'type' => 'radio',
        'name' => '图3-是否新窗口',
        'values' => array(
            'open' => '新窗口打开',
            'close' => '关闭新窗口',
        ),
        'default' => 'close',
    ),
    'focusslide_src_3' =>array(
        'type' => 'image',
        'name' => '图3-图片地址',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    
    'focusslide_title_4' =>array(
        'type' => 'text',
        'name' => '图4-标题',
        'description' => '',
        'values' => array($options_cache['blogname']),
    ),
    'focusslide_href_4' =>array(
        'type' => 'text',
        'name' => '图4-链接',
        'description' => '',
        'values' => array(BLOG_URL),
    ),
    'focusslide_blank_4' => array(
        'type' => 'radio',
        'name' => '图4-是否新窗口',
        'values' => array(
            'open' => '新窗口打开',
            'close' => '关闭新窗口',
        ),
        'default' => 'close',
    ),
    'focusslide_src_4' =>array(
        'type' => 'image',
        'name' => '图4-图片地址',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    
    'focusslide_title_5' =>array(
        'type' => 'text',
        'name' => '图5-标题',
        'description' => '',
        'values' => array($options_cache['blogname']),
    ),
    'focusslide_href_5' =>array(
        'type' => 'text',
        'name' => '图5-链接',
        'description' => '',
        'values' => array(BLOG_URL),
    ),
    'focusslide_blank_5' => array(
        'type' => 'radio',
        'name' => '图5-是否新窗口',
        'values' => array(
            'open' => '新窗口打开',
            'close' => '关闭新窗口',
        ),
        'default' => 'close',
    ),
    'focusslide_src_5' =>array(
        'type' => 'image',
        'name' => '图5-图片地址',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    /* 焦点图 ======================================================================*/
    'focus_s' => array(
        'type' => 'radio',
        'name' => '焦点图状态',
        'description' => '以下设置将显示在焦点图的第一张，其它位置调用的是置顶文章，如未开启其他位置未显示，设置置顶文章方法：后台-文章-选择-置顶选中即可',
        'values' => array(
            'open' => '开启',
            'close' => '隐藏',
        ),
        'default' => 'open',
    ),
    'focus_title' =>array(
        'type' => 'text',
        'name' => '标题',
        'description' => '',
        'values' => array($options_cache['blogname']),
    ),
    'focus_href' =>array(
        'type' => 'text',
        'name' => '链接到',
        'description' => '',
        'values' => array(BLOG_URL),
    ),
    'focus_src' =>array(
        'type' => 'image',
        'name' => '图片地址',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    /* 热门排行 ======================================================================*/
    'most_list_s' => array(
        'type' => 'radio',
        'name' => '热门排行状态',
        'description' => '',
        'values' => array(
            'open' => '开启',
            'close' => '隐藏',
        ),
        'default' => 'open',
    ),
    'most_list_style' => array(
        'type' => 'radio',
        'name' => '排行模式',
        'description' => '',
        'values' => array(
            'comnum' => '按文章评论数',
            'views' => '按文章阅读数',
        ),
        'default' => 'comnum',
    ),
    'most_list_title' =>array(
        'type' => 'text',
        'name' => '标题',
        'description' => '',
        'values' => array('一周热门排行'),
    ),
    'most_list_date' =>array(
        'type' => 'text',
        'name' => '显示最近多少天的热门文章',
        'description' => '',
        'values' => array('7'),
    ),
    'most_list_number' =>array(
        'type' => 'text',
        'name' => '显示数量',
        'description' => '',
        'values' => array('5'),
    ),
    /* 置顶推荐 ======================================================================*/
    'sticky_s' => array(
        'type' => 'radio',
        'name' => '置顶推荐状态',
        'description' => '调取置顶文章，设置置顶文章方法：后台-文章-选择-置顶选中即可',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'open',
    ),
    'sticky_post_s' => array(
        'type' => 'radio',
        'name' => '在文章页面相关文章模块下',
        'description' => '',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'close',
    ),
    'sticky_title' =>array(
        'type' => 'text',
        'name' => '标题',
        'description' => '',
        'values' => array('热门推荐'),
    ),
    'sticky_limit' =>array(
        'type' => 'text',
        'name' => '显示数量',
        'description' => '',
        'values' => array('4'),
    ),
    /* 侧边栏随动 ======================================================================*/
    'sideroll_index_s' => array(
        'type' => 'radio',
        'name' => '侧边栏-首页',
        'description' => '',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'open',
    ),
    'sideroll_index' =>array(
        'type' => 'text',
        'name' => '侧边栏-首页随动模块',
        'description' => '多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块',
        'values' => array('1 2'),
    ),
    'sideroll_list_s' => array(
        'type' => 'radio',
        'name' => '侧边栏-分类/标签/搜索页',
        'description' => '',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'open',
    ),
    'sideroll_list' =>array(
        'type' => 'text',
        'name' => '侧边栏-分类/标签/搜索页随动模块',
        'description' => '多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块',
        'values' => array('1 2'),
    ),
    'sideroll_post_s' => array(
        'type' => 'radio',
        'name' => '侧边栏-文章页',
        'description' => '',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'open',
    ),
    'sideroll_post' =>array(
        'type' => 'text',
        'name' => '侧边栏-文章页随动模块',
        'description' => '多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块',
        'values' => array('1 2'),
    ),
    'sideroll_page_s' => array(
        'type' => 'radio',
        'name' => '侧边栏-页面',
        'description' => '',
        'values' => array(
            'open' => '开启',
            'close' => '关闭',
        ),
        'default' => 'open',
    ),
    'sideroll_page' =>array(
        'type' => 'text',
        'name' => '侧边栏-页面模块',
        'description' => '多个模块之间用空格隔开即可！默认：“1 2”，表示第1和第2个模块，建议最多3个模块',
        'values' => array('1 2'),
    ),
    /* 独立页面 ======================================================================*/
    'side_readwall_limit_number' =>array(
        'type' => 'text',
        'name' => '侧边栏读者墙显示数量',
        'description' => '',
        'values' => array('30'),
    ),
    'readwall_limit_number' =>array(
        'type' => 'text',
        'name' => '读者墙显示数量',
        'description' => '',
        'values' => array('200'),
    ),
    'speed_menu' =>array(
        'type' => 'text',
        'name' => '全局页面左侧菜单设置',
        'description' => '输入自定义页面ID即可，以“,”分割',
        'values' => array(''),
    ),
    'page_side' => array(
        'type' => 'radio',
        'name' => '页面左侧菜单状态',
        'description' => '',
        'values' => array(
            'y' => '开启',
            'n' => '关闭',
        ),
        'default' => 'n',
    ),
    'page_menu' =>array(
        'type' => 'text',
        'name' => '页面左侧菜单设置',
        'description' => '输入自定义页面ID即可，以“,”分割',
        'values' => array(''),
    ),
    /* 字符 ======================================================================*/
    'post_copyright' =>array(
        'type' => 'text',
        'name' => '文章页尾版权提示字符',
        'description' => '',
        'values' => array('未经允许不得转载'),
    ),
    'index_list_title' =>array(
        'type' => 'text',
        'name' => '首页最新发布标题',
        'description' => '',
        'values' => array('最新发布'),
    ),
    'related_title' =>array(
        'type' => 'text',
        'name' => '文章页相关文章标题字符',
        'description' => '',
        'values' => array('相关推荐'),
    ),
    'comment_title' =>array(
        'type' => 'text',
        'name' => '评论标题',
        'description' => '',
        'values' => array('评论'),
    ),
    'comment_text' =>array(
        'type' => 'text',
        'name' => '评论框默认字符',
        'description' => '',
        'values' => array('你的评论可以一针见血'),
    ),
    'comment_submit_text' =>array(
        'type' => 'text',
        'name' => '评论提交按钮字符',
        'description' => '',
        'values' => array('提交评论'),
    ),
    /* 社交 ======================================================================*/
    'weibo' =>array(
        'type' => 'text',
        'name' => '微博',
        'description' => '',
        'values' => array('http://weibo.com/xlonewolf'),
    ),
    'tqq' =>array(
        'type' => 'text',
        'name' => '腾讯微博',
        'description' => '',
        'values' => array('http://t.qq.com'),
    ),
    'wechat' =>array(
        'type' => 'text',
        'name' => '微信帐号',
        'description' => '',
        'values' => array(''),
    ),
    'wechat_qr' =>array(
        'type' => 'image',
        'name' => '微信二维码',
        'description' => '建议图片尺寸：200x200px',
        'values' => array(
            TEMPLATE_URL . 'images/thumbnail.png',
        ),
    ),
    /* 自定义代码 ======================================================================*/
    'csscode' => array(
        'type' => 'text',
        'name' => '自定义CSS样式',
        'description' => '位于之前，直接写样式代码，不用添加&lt;style&gt;标签',
        'multi' => true,
        'default' => '',
    ),
    'headcode' => array(
        'type' => 'text',
        'name' => '自定义头部代码',
        'description' => '位于之前，这部分代码是在主要内容显示之前加载，通常是CSS样式、自定义的标签、全站头部JS等需要提前加载的代码',
        'multi' => true,
        'default' => '',
    ),
    'footcode' => array(
        'type' => 'text',
        'name' => '自定义底部代码',
        'description' => '位于</body>之前，这部分代码是在主要内容加载完毕加载，通常是JS代码',
        'multi' => true,
        'default' => '',
    ),
    /* 广告位 ======================================================================*/
    'ads_index_01_s' => array(
        'type' => 'radio',
        'name' => '首页内容最上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_index_01' => array(
        'type' => 'text',
        'name' => '首页内容最上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_index_01_m' => array(
        'type' => 'text',
        'name' => '首页内容最上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_index_02_s' => array(
        'type' => 'radio',
        'name' => '首页文章列表上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_index_02' => array(
        'type' => 'text',
        'name' => '首页文章列表上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_index_02_m' => array(
        'type' => 'text',
        'name' => '首页文章列表上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_index_03_s' => array(
        'type' => 'radio',
        'name' => '首页分页下',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_index_03' => array(
        'type' => 'text',
        'name' => '首页分页下 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_index_03_m' => array(
        'type' => 'text',
        'name' => '首页分页下 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_post_01_s' => array(
        'type' => 'radio',
        'name' => '文章页正文上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_post_01' => array(
        'type' => 'text',
        'name' => '文章页正文上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_post_01_m' => array(
        'type' => 'text',
        'name' => '文章页正文上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_post_02_s' => array(
        'type' => 'radio',
        'name' => '文章页正文下',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_post_02' => array(
        'type' => 'text',
        'name' => '文章页正文下 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_post_02_m' => array(
        'type' => 'text',
        'name' => '文章页正文下 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_post_03_s' => array(
        'type' => 'radio',
        'name' => '文章页评论上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_post_03' => array(
        'type' => 'text',
        'name' => '文章页评论上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_post_03_m' => array(
        'type' => 'text',
        'name' => '文章页评论上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_cat_01_s' => array(
        'type' => 'radio',
        'name' => '分类页列表上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_cat_01' => array(
        'type' => 'text',
        'name' => '分类页列表上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_cat_01_m' => array(
        'type' => 'text',
        'name' => '分类页列表上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_tag_01_s' => array(
        'type' => 'radio',
        'name' => '标签页列表上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_tag_01' => array(
        'type' => 'text',
        'name' => '标签页列表上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_tag_01_m' => array(
        'type' => 'text',
        'name' => '标签页列表上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
	
    'ads_search_01_s' => array(
        'type' => 'radio',
        'name' => '搜索页列表上',
        'description' => '',
        'values' => array('y' => '开启','n' => '关闭'),
        'default' => 'n'
    ),
    'ads_search_01' => array(
        'type' => 'text',
        'name' => '搜索页列表上 - 非手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
    'ads_search_01_m' => array(
        'type' => 'text',
        'name' => '搜索页列表上 - 手机端',
        'description' => '可添加任意广告联盟代码或自定义代码',
        'multi' => true,
        'default' => '',
    ),
);
