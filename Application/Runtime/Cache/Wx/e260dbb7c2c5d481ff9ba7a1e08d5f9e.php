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
        .list-block{margin: 0;}
        .list-block ul{background: #fff;}
        .content-block-title{margin: 0.5rem 0.75rem;}
        .num{color: #c0c0c0;}
        .price{color: #fe4d3d;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="content">
        <div class="content-block-title">订单明细</div>
        <div class="list-block">
            <ul>
                <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><li class="item-content">
                        <div class="item-inner">
                            <div class="item-title"><?php echo ($g["good_name"]); ?><small class="num">x<?php echo ($g["good_num"]); ?></small></div>
                            <div class="item-after">￥<?php echo ($g['good_price'] * $g['good_num']); ?></div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="item-content">
                    <div class="item-media"><i class="icon icon-f7"></i></div>
                    <div class="item-inner">
                        <div class="item-title">优惠</div>
                        <div class="item-after">-￥<?php echo ($order["discount_total"]); ?></div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">总计</div>
                        <div class="item-after">实付<span class="price">￥<?php echo ($order["pay_total"]); ?></span></div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="content-block-title">配送信息</div>
        <div class="list-block">
            <ul>
                <?php if(($order['is_ziti']) == "1"): ?><li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">配送方式</div>
                            <div class="item-after">自提</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">客服电话</div>
                            <div class="item-after">17320105511</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-text">自提地址:郑东新区绿地原盛国际7号楼附5号千品百汇二楼</div>
                        </div>
                    </li>
                    <?php else: ?>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">收货人</div>
                            <div class="item-after"><?php echo ($address["username"]); ?></div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-title">联系电话</div>
                            <div class="item-after"><?php echo ($address["mobile"]); ?></div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-inner">
                            <div class="item-text">配送地址:<?php echo ($address["address"]); ?></div>
                        </div>
                    </li><?php endif; ?>

            </ul>
        </div>
        <div class="content-block-title">订单信息</div>
        <div class="list-block">
            <ul>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">订单编号</div>
                        <div class="item-after"><?php echo ($order["trade_no"]); ?></div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">下单时间</div>
                        <div class="item-after"><?php echo ($order["addtime"]); ?></div>
                    </div>
                </li>
                <li class="item-content">
                    <div class="item-inner">
                        <div class="item-title">支付时间</div>
                        <div class="item-after"><?php echo ($order["pay_time"]); ?></div>
                    </div>
                </li>
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