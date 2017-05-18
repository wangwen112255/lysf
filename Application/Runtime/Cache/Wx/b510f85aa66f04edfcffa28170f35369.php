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
        .head {
            max-height: 430px;
            overflow: hidden;
            background: url('/Public/wx/image/user-bg.jpg') 0 0 no-repeat;
            background-size: contain;
        }
        .head-user{
            color: #ffffff;
            position: absolute;
            top: 8%;
            left: 0;
            text-align: center;
            width: 100%;
        }
        .user-pic{
            max-width: 100px;
            border-radius: 50%;
        }
        .list-block{margin: 0;}
        .item {
            width: 49.5%;
            height: 150px;
            display: inline-block;
            text-align: center;
            margin-top: 1%;
            background: #ffffff;
            padding-top: 25px;
        }
        .item img{max-height: 40px;font-size: 20px;}
        .item h5{margin: 0;}
        .f-l{float: left;}
        .f-r{float: right;}
        .list-block ul{overflow: hidden;background: #f0f0f0;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="content">
        <div class="row head">
            <img src="/Public/wx/image/user-bg.jpg" style="width: 100%;visibility: hidden;" alt="">
            <div class="head-user">
                <img class="user-pic" src="<?php echo ($data["avatar"]); ?>">
                <h5><?php echo ($data["nickname"]); ?></h5>
            </div>
        </div>
        <div class="list-block">
            <ul>
                <li class="item f-l">
                    <a href="<?php echo U('Order/index');?>" external>
                    <div class="item-cont">
                        <img src="/Public/wx/image/order.png"/>
                        <h5 class="title">全部订单</h5>
                    </div>
                    </a>
                </li>
                <li class="item f-r">
                    <a href="<?php echo U('Coupon/index');?>" external>
                    <div class="item-cont">
                        <img src="/Public/wx/image/coupon.png"/>
                        <h5 class="title">优惠券</h5>
                    </div>
                    </a>
                </li>
                <li class="item f-l">
                    <a href="javascript:$.alert('敬请期待！');" external>
                    <div class="item-cont">
                        <img src="/Public/wx/image/youhui.png"/>
                        <h5 class="title">优惠活动</h5>
                    </div>
                    </a>
                </li>
                <li class="item f-r">
                    <a href="" external>
                    <div class="item-cont">
                        <img src="/Public/wx/image/qidai.png"/>
                        <h5 class="title">敬请期待</h5>
                    </div>
                    </a>
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