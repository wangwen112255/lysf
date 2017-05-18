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
        .iconfont{font-size: 1rem;}
        .icon-favorfill,.list-block .item-after.score{color: #f60;}
        .row.bar{bottom: 0;margin: 0;padding-right: 0;}
        .row.bar div{height: 100%;line-height: 2.5em;}
        .todo{text-align: center;color: #f60;}
        .list-block{margin-top: 0;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="row bar">
        <div class="todo" id="toReview">发布</div>
    </div>

    <div class="list-block">
        <ul>
            <li class="item-content">
                <div class="item-inner">
                    <div class="item-title" id="star">
                        <i class="icon iconfont icon-favor"></i>
                        <i class="icon iconfont icon-favor"></i>
                        <i class="icon iconfont icon-favor"></i>
                        <i class="icon iconfont icon-favor"></i>
                        <i class="icon iconfont icon-favor"></i>
                    </div>
                    <div class="item-after score" id="score"></div>
                </div>
            </li>
            <li class="item-content">
                <div class="item-inner">
                    <textarea id="desc" placeholder="菜品口味如何，送餐及时吗，有什么建议？（写够15字送3元优惠券哦~）"></textarea>
                </div>
            </li>
        </ul>
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
    
    <script>
        var order_id = '<?php echo ($order_id); ?>';
        $(document).on('click','#toReview',function () {
            var score = parseFloat($('#score').text());
            if(isNaN(score) || !score){
                $.toast('打个评分吧亲');
                return;
            }
            var desc = $('#desc').val();
            if(!desc){
                $.toast('给个评价吧');
                return;
            }
            $.ajax({
                url: "<?php echo U('Review/add');?>",
                data: {score: score, desc: desc, order_id: order_id},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    if(data.code == 200){
                        window.location.href = "<?php echo U('Order/index');?>";
                    } else {
                        $.toast(data.msg);
                    }

                },
                error: function () {
                    $.toast('评价失败了');
                }
            })
        });

        $(document).on('click','.icon.iconfont',function () {
            var el = $(this);
            var index = el.index();
            var len = $('.icon.iconfont').size();
            var score = (parseInt(index)+1).toFixed(1);
            $('.icon').removeClass('icon-favorfill');
            for (var i=0;i<len;i++){
                var item = $('.icon.iconfont').get(i);
                if(i<=index) {
                    $(item).addClass('icon-favorfill');
                } else {
                    $(item).addClass('icon-favor');
                }
            }
            $('#score').text(score);
        });
    </script>

</body>
</html>