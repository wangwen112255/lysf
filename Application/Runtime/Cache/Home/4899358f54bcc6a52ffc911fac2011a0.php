<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"<
    <meta name="renderer" content="webkit">
    <title>管理系统</title>

    <!-- CSS文件 -->
    <link href="/Public/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/static/css/font-awesome.css" rel="stylesheet">
    <link href="/Public/static/css/animate.css" rel="stylesheet">
    <link href="/Public/static/css/style.css" rel="stylesheet">
    
    <link href="/Public/home/css/print.css" rel="stylesheet" type="text/css" media="print">
    <style>
    .page-heading{display: none;}
        .left{
            float: left;
        }
        .right              float:right;
        }
        .clearfix{
            clear: both;
        }
        .title{text-align: center;}
        ul{list-style: none;}
        .print_container{
            padding: 20px;
            width: 188px;
        }
        .section1{
        }
        .section2 label{
            display: block;
        }
        .section3 label{
            display: block;
        }
        .section4{
        }
        .section4 .total label{
            display: block;
        }
        .section4 .other_fee{
            border-bottom: 1px solid #DADADA;
        }
        .section5 label{
            display: block;
        }
        .wrapper-content{padding-left: 0;padding-right: 0;}
        .btn-primary{margin-left: 20px;}
    </style>

</head>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2></h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">这是</a>
            </li>
            <li class="active">
                <strong>包屑式导航</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-3">
        <!-- <div class="title-action">
            <a href="" class="btn btn-primary">活动区域</a>
        </div> -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated bounceInRight">
            
    <div class="print_container" id="bill">
        <h1 class="title">鲁豫食府</h1>
        <span>******************************</span>
        <!--<div class="section2">-->
            <!--<label>期望送达时间：5678</label>-->
            <!--<label>订单备注：1111</label>-->
        <!--</div>-->
        <!--<span>******************************</span>-->
        <div class="section3">
            <label>订单编号：<?php echo ($order["trade_no"]); ?></label>
            <label>下单时间：<?php echo ($order["pay_time"]); ?></label>
        </div>
        <span>******************************</span>
        <div class="section4">
            <div style="border-bottom: 1px solid #DADADA;">
                <!--<ul>
                    <div>菜单名称     数量    金额</div>
                    <li>米饭米饭 米饭 米饭 米饭 米饭 米饭       2    28元</li>
                    <li>米饭      2    28元</li>
                </ul>-->
                <table style="width: 100%;">
                    <thead>
                    <tr>
                        <td width="60%">菜单名称</td>
                        <td width="20%">数量</td>
                        <td width="20%">金额</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($order['goods'])): $i = 0; $__LIST__ = $order['goods'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($g["good_name"]); ?></td>
                        <td><?php echo ($g["good_num"]); ?></td>
                        <td><?php echo ($g['good_price'] * $g['good_num']); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="other_fee">
                <!--<div class="canh">-->
                    <!--<label class="left">餐盒费</label>-->
                    <!--<label class="right">0</label>-->
                    <!--<div class="clearfix"></div>-->
                <!--</div>-->
                <!--<div class="peis">-->
                    <!--<label class="left">配送费</label>-->
                    <!--<label class="right">0</label>-->
                    <!--<div class="clearfix"></div>-->
                <!--</div>-->
                <?php if(!empty($order['coupon'])): ?><div class="manj">
                        <label class="left"><?php echo ($order['coupon']['name']); ?></label>
                        <label class="right">-<?php echo ($order['coupon']['total']); ?></label>
                        <div class="clearfix"></div>
                    </div><?php endif; ?>
            </div>
            <div class="total">
                <label class="left">总计</label>
                <label class="right"><?php echo ($order["pay_total"]); ?></label>
                <div class="clearfix"></div>
            </div>
            <div style="text-align: right;">
                <label><?php echo ($status[$order['pay_status']]); ?></label>
            </div>
            <span>******************************</span>
        </div>
        <div class="section5">
            <?php if(!empty($order['is_ziti'])): ?><label>自提</label>
                <?php else: ?>
                <label>姓名：<?php echo ($order["user"]); ?></label>
                <label>电话：<?php echo ($order["mobile"]); ?></label>
                <label>地址：<?php echo ($order["address"]); ?></label><?php endif; ?>
        </div>
        <span>******************************</span>
    </div>
    <button type="button" class="btn btn-primary" id="toPrint" onclick="_printBill();">打印</button>

        </div>
    </div>
</div>
<!-- 全局js -->
<script src="/Public/static/js/jquery.min.js"></script>
<script src="/Public/static/js/bootstrap.min.js"></script>

<!-- 自定义js -->
<script src="/Public/static/js/content.js"></script>
<script src="/Public/static/js/plugins/layer/layer.js"></script>

<script src="/Public/static/js/base.js"></script>
<script src="/Public/static/js/common.js"></script>

    <script src="/Public/static/js/plugins/jqprint/jquery-migrate-1.2.1.min.js"></script>
    <script src="/Public/static/js/plugins/jqprint/jquery.jqprint-0.3.js"></script>
    <script>
        function _printBill(){

           $('#toPrint').hide();
           window.print();return;
            $("#bill").jqprint({
                debug: false, //如果是true则可以显示iframe查看效果（iframe默认高和宽都很小，可以再源码中调大），默认是false
                importCSS: true, //true表示引进原来的页面的css，默认是true。（如果是true，先会找$("link[media=print]")，若没有会去找$("link")中的css文件）
                printContainer: true, //表示如果原来选择的对象必须被纳入打印（注意：设置为false可能会打破你的CSS规则）。
                operaSupport: true//表示如果插件也必须支持歌opera浏览器，在这种情况下，它提供了建立一个临时的打印选项卡。默认是true
            });
        }
    </script>

</body>
</html>