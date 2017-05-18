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
        .list-block{margin-top: 0;height: 100%;}
        .list-block .item-after {color: #1ab394;}
        .list-block .item-title {font-size: 0.75rem;}
        .item-content{color: inherit;}
        .remove-btn{color: #666;margin-left: 15px;}
        .other-status{line-height: 1.35rem;}
        .other-status .button{display: inline-block;float: right;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="content infinite-scroll infinite-scroll-bottom" data-distance="50">
        <div class="list-block media-list">
            <ul class="list-container">
                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li id="item<?php echo ($v["id"]); ?>">
                            <a href="<?php echo U('Order/detail', array('id'=>$v['id']));?>" class="item-content" external>
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title">订单编号:<?php echo ($v["trade_no"]); ?></div>
                                        <div class="item-after"><?php echo ($status[$v['status']]); ?><span class="icon icon-remove remove-btn" data-id="<?php echo ($v["id"]); ?>"></span></div>
                                    </div>
                                    <div class="item-subtitle">下单时间：<?php echo ($v["addtime"]); ?></div>
                                    <div class="item-subtitle other-status">订单总价：<?php echo ($v["pay_total"]); ?>元
                                        <?php if($v['review_status'] == 0): ?><button onclick="return false;" data-id="<?php echo ($v["id"]); ?>"  class="button button-warning toreview">去评价</button><?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title">还没有下过单哦</div>
                            </div>
                        </div>
                    </li><?php endif; ?>
            </ul>
        </div>
        <div class="infinite-scroll-preloader">
            <div class="preloader"></div>
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
    
    <script>
        var page = 1;
        var loading = false;

        // 每次加载添加多少条目
        var itemsPerLoad = 10;

        // 注册'infinite'事件处理函数
        $(document).on('infinite', '.infinite-scroll-bottom',function() {
            // 如果正在加载，则退出
            if (loading) return;

            // 设置flag
            loading = true;
            page++;
            $.ajax({
                url: "<?php echo U('Order/index');?>",
                type: 'get',
                dataType: 'json',
                data: {p: page, pageSize: itemsPerLoad},
                success: function (data) {
                    loading = false;
                    if(data.code == 200){
                        var list = data.data;
                        addItems(list);
                    } else {
                        $.detachInfiniteScroll($('.infinite-scroll'));
                        // 删除加载提示符
                        $('.infinite-scroll-preloader').remove();
                        return;
                    }
                },
                error: function () {
                    loading = false;
                    $.detachInfiniteScroll($('.infinite-scroll'));
                    // 删除加载提示符
                    $('.infinite-scroll-preloader').remove();
                }
            });
        });
        function getStatus(type) {
            type = parseInt(type);
            if (type == 1) {
                return '已支付';
            } else {
                return '未支付';
            }
        }


        function getOrderStatus(type){
            type = parseInt(type);
            if(type == 1){
                return '等待配送';
            } else if (type == 2){
                return '配送中';
            } else if (type == 9){
                return '已完成';
            } else {
                return '待支付';
            }
        }

        function addItems(list) {
            // 生成新条目的HTML
            var html = '';
            var len = list.length - 1;
            for (var i = 0; i <= len; i++) {
                var item = list[0];
                html += '<li><a href="#" class="item-link item-content"><div class="item-inner"><div class="item-title-row">'+
                        '<div class="item-title">编号:'+list[i].trade_no+'</div>'+
                        '<div class="item-after">'+list[i].addtime+'</div></div>'+
                        '<div class="item-subtitle">' +
                        '<span class="price t-price">'+list[i].total+'元</span>' +
                        '<button type="button" class="button button-fill f-r">'+getStatus(list[i].pay_status)+'</button></div>'+
                        '<div class="item-text"><button type="button" class="button">'+getOrderStatus(list[i].status)+'</button></div></div></a></li>';
            }
            // 添加新条目
            $('.infinite-scroll-bottom .list-container').append(html);
        }

        $(document).on('click', '.remove-btn',function() {
            var id = $(this).attr('data-id');
            if(!id){
                return;
            }
            $.confirm('确认删除订单？',function () {
                $.ajax({
                    url: "<?php echo U('Order/delete');?>",
                    type: 'post',
                    data: {id: id},
                    success: function (data) {
                        if(data.code == 200){
                            $('#item'+id).hide();
                        } else {
                            $.toast(data.msg);
                        }
                    },
                    error: function () {
                        $.toast('删除失败');
                    }
                })
            });

            return false;
        })

        $(document).on('click','.toreview',function () {
            var id = $(this).attr('data-id');
            if(!id){ return;};
            window.location.href = '<?php echo U("Review/review");?>'+'?id='+id;
        });
    </script>

</body>
</html>