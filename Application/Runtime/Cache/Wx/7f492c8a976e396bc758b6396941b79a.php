<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php echo ((isset($title) && ($title !== ""))?($title):"鲁豫食府"); ?></title>
    <!--<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">-->
    <!--<link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/??sm.min.css,sm-extend.min.css">-->
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.css">
    <link rel="stylesheet" href="/Public/wx/css/iconfont.css">
    
    <style>
        .head{
            color: #ffffff;
            width: 100px;
            height: 100px;
            background: #ff7012;
            text-align: center;
        }
        .total{padding-top: 20px;}
        .head h5{margin: 0;padding-top: 5px;}
        .list-block .item-content,.list-block.media-list .item-media,.list-block.media-list .item-inner{padding: 0;}
        .list-block{margin-top: 1rem;}
        .item-title-row{padding-top: 5px;}
        #no-coupon{padding-top: 0.5rem;text-align: center;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="content">
        <div class="list-block media-list">
            <ul>
                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                            <div class="item-content">
                                <div class="item-media">
                                    <div class="head">
                                        <div class="total">￥<big><?php echo ($v["total"]); ?></big></div>
                                        <h5>x <?php echo ($v["num"]); ?> </h5>
                                    </div>
                                </div>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title"><?php echo ($v["name"]); ?></div>
                                    </div>
                                    <div class="item-subtitle">不可叠加使用</div>
                                    <div class="item-text">
                                        <?php if(!empty($v['begintime'])): echo ($v["begintime"]); endif; ?>至
                                        <?php if(!empty($v['endtime'])): echo ($v["endtime"]); else: ?>无限制<?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                    <li id="no-coupon">
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title">还没有代金券</div>
                            </div>
                        </div>
                    </li><?php endif; ?>
            </ul>
        </div>
    </div>
</div>
    
</div>

    <!--<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>-->
    <!--<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/??sm.min.js,sm-extend.min.js' charset='utf-8'></script>-->

<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.js' charset='utf-8'></script>
<script>
        $.init();
    </script>
    
</body>
</html>