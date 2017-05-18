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
        .content-block{
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            background: url('/Public/wx/images/1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .border-bg{background: url('/Public/wx/images/3.png');}
        .food{background: url('/Public/Upload/Goods/m_5848f13a819b9.jpg');}
        .border-bg,.food {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .food{
            width: 200px;
            height: 200px;
            left: 50%;
            top: 50%;
            margin-top: -120px;
            margin-left: -100px;
            border-radius: 50%;
            display: block;
        }
        .title{
            position: absolute;
            padding: 0;
            margin: 0;
            top: 50%;
            margin-top: 80px;
            text-align: center;
            width: 100%;
            font-size: 30px;
            color: #000;
            font-weight: 700;
        }
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="content-block">
        <div class="border-bg"></div>
        <div class="food"></div>
        <p class="title">法式小羊排</p>
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