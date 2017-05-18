<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"<
    <meta name="renderer" content="webkit">
    <title>鲁豫食府管理系统</title>
    <!-- CSS文件 -->
    <link href="/Public/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/static/css/font-awesome.css" rel="stylesheet">
    <link href="/Public/static/css/animate.css" rel="stylesheet">
    <link href="/Public/static/css/style.css" rel="stylesheet">
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i></div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" style="max-width: 64px;" class="img-circle" src="/Public/home/imgs/lysf-mp-code.jpg" /></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">鲁豫食府</strong></span>
                                <span class="text-muted text-xs block"><?php echo ($user["realname"]); ?></span>
                                </span>
                        </a>
                        <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">-->
                            <!--<li><a class="J_menuItem" href="javascript:void (0);">修改头像</a>-->
                            <!--</li>-->
                        <!--</ul>-->
                    </div>
                    <div class="logo-element">鲁豫食府
                    </div>
                </li>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                    <?php if(empty($v["child"])): ?><a class="J_menuItem" href="<?php echo U($v['name']);?>">
                        <i class="<?php echo ((isset($v["icon"]) && ($v["icon"] !== ""))?($v["icon"]):'fa fa-home'); ?>"></i>
                        <span class="nav-label"><?php echo ($v["title"]); ?></span>
                    </a>
                    <?php else: ?>
                    <a href="#">
                        <i class="<?php echo ((isset($v["icon"]) && ($v["icon"] !== ""))?($v["icon"]):'fa fa-home'); ?>"></i>
                        <span class="nav-label"><?php echo ($v["title"]); ?></span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if(is_array($v["child"])): $i = 0; $__LIST__ = $v["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><li>
                            <a class="J_menuItem" href="<?php echo U($c['name']);?>"><i class="<?php echo ((isset($c["icon"]) && ($c["icon"] !== ""))?($c["icon"]):'fa fa-home'); ?>"></i><?php echo ($c["title"]); ?></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <!--<div class="row border-bottom">-->
        <!--<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">-->

        <!--</nav>-->
        <!--</div>-->
        <div class="row content-tabs">
            <button class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin:0;max-width: 40px;position: absolute;top: 0;left: 0;background: #1ab394;border-radius: 0;"><i class="fa fa-bars"></i> </button>

            <button class="roll-nav roll-left J_tabLeft" style="left:40px;"><i class="fa fa-angle-double-left"></i>
            </button>
            <nav class="page-tabs J_menuTabs" style="margin-left: 80px;">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="<?php echo U('Index/vie');?>">首页</a>
                    <!--默认主页需在对应的选项卡a元素上添加data-id="默认主页的url"-->
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-angle-double-right"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?php echo U('Login/doLoginout');?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main" style="height: calc(100% - 90px);">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?php echo U('Index/vie');?>" frameborder="0" data-id="<?php echo U('Index/vie');?>" seamless></iframe>
            <!--默认主页需在对应的页面显示iframe元素上添加name="iframe0"和data-id="默认主页的url"-->
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2016 <a href="#" target="_blank">亿欣通</a>
            </div>
        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/Public/static/js/jquery.min.js"></script>
<script src="/Public/static/js/bootstrap.min.js"></script>
<script src="/Public/static/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/Public/static/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/Public/static/js/plugins/layer/layer.min.js"></script>

<!-- 自定义js -->
<script src="/Public/static/js/hplus.js"></script>
<script type="text/javascript" src="/Public/static/js/contabs.js"></script>

<!-- 第三方插件 -->
<script src="/Public/static/js/plugins/pace/pace.min.js"></script>
</body>
</html>