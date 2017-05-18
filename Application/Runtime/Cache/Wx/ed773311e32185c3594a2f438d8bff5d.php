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
        .content {margin-top: 0;margin-bottom: 2.5rem;}
        .row.bar{bottom: 0;margin: 0;padding-right: 0;}
        .row.bar div{height: 100%;line-height: 2.5em;}
        .todo{background: #ff7012;color: #ffffff;line-height: 2.5;text-align: center;}
        .total span{color: #ff3030;}
        .item-media img {max-width: 24px;}
        .content-block {margin: 0;}
        .list-block {margin: 1rem 0;}
        .list-block .list-group-title {color: #2f4050;}
        .list-block .item-title.address{white-space: pre-wrap;}
        .icon {color:#ff3030;}
        .list-block .item-content.hide {display: none;}
        .item-title.buttons-row{margin: 0 auto;}
        .buttons-row .button{border-color: #e7e7e7;border-left-color: #0894ec;}
        .buttons-row .left{border-left-color: #e7e7e7;}
        .popup {height: 70%;top: 30%;}
        .list-block .item-input {background: #f7f7f7;}
        .content-block-title{margin-top: 0.5rem;}
        .center {text-align: center;color: #0894ec;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
    <div class="row bar">
        <div class="col-60 total">实付款：<span><big id="total"><?php echo ($order["pay_total"]); ?></big></span></div>
        <div class="col-40 todo" id="toPay">立即支付</div>
    </div>
    <div class="content">
        <div class="content-block-title center"><span class="icon iconfont icon-notification" style="margin-top: -0.2rem;margin-right: 5px;"></span>到店自提送饮料</div>
        <div class="content-block">
            <div class="list-block contacts-block">
                <div class="list-group">
                    <ul>
                        <li class="list-group-title">收货地址<span class="icon iconfont icon-location"></span></li>

                        <li class="item-content <?php if(empty($address)): ?>hide<?php endif; ?>" id="show-address">
                            <div class="item-inner">
                                <div class="item-title address" id="show-address-item"><?php echo ($address["username"]); ?> <?php echo ($address["mobile"]); ?> <?php echo ($address["address"]); ?></div>
                            </div>
                        </li>
                        <li class="item-content">
                            <div class="item-inner a-c">
                                <div class="item-title buttons-row">
                                    <a href="#" id="ziti-address" class="button left">我要自提</a>
                                    <a href="#" id="add-address" class="button">添加地址</a>
                                    <a href="#" id="add-address-list" class="button">选择地址</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content-block">
            <div class="list-block contacts-block">
                <div class="list-group">
                    <ul>
                        <li class="list-group-title">商品清单<span class="icon iconfont icon-cart"></span></li>
                        <?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><li class="item-content">
                            <div class="item-inner">
                                <div class="item-title"><?php echo ($g["name"]); ?></div>
                                <div class="item-after"><?php echo ($g["num"]); ?>份</div>
                            </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php if(!empty($order['meno'])): ?><li class="item-content">
                                <div class="item-media"><i class="icon icon-gift"></i></div>
                                <div class="item-inner">
                                    <div class="item-title">汤羹</div>
                                    <div class="item-after"><?php echo ($order["meno"]); ?></div>
                                </div>
                            </li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content-block">
            <div class="list-block">
                <ul>
                    <?php if(!empty($couponlist)): ?><li style="background: #e7e7e7;">
                        <a href="#" id="select-coupon" class="item-link item-content">
                            <div class="item-inner" id="coupon-item-checked">
                                <div class="item-title">有可用代金券</div>
                            </div>
                        </a>
                    </li><?php endif; ?>
                    <li class="item-content">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">总计</div>
                            <div class="item-after"><?php echo ($order["total"]); ?></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    </div>
</div>
    
</div>

    <div class="popup popup-address">
        <div class="content" style="margin-bottom: 0;">
            <div class="list-block">
                <ul>
                    <li>
                        <div class="item-content">
                            <div class="item-inner">
                                <div class="item-title">
                                    郑州市 郑东新区
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-me"></i></div>
                            <div class="item-inner">
                                <div class="item-title label">姓名</div>
                                <div class="item-input">
                                    <input type="text" id="user-name" placeholder="收货人姓名">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-phone"></i></div>
                            <div class="item-inner">
                                <div class="item-title label">电话</div>
                                <div class="item-input">
                                    <input type="number" id="user-mobile" placeholder="手机号码">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item-content">
                            <div class="item-media"><i class="icon icon-message"></i></div>
                            <div class="item-inner">
                                <div class="item-title label">地址</div>
                                <div class="item-input">
                                    <textarea id="user-address"></textarea>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="content-block">
                <div class="row">
                    <div class="col-40">　</div>
                    <div class="col-40"><a href="#" id="add-user-address" class="button button-fill button-success">添加</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup popup-address-list" style="height: 100%;top: 0;">
        <div class="content" style="margin-bottom: 0;">
            <div class="content-block-title">地址列表</div>
            <div class="list-block media-list">
                <ul>
                    <?php if(!empty($addresslist)): if(is_array($addresslist)): $i = 0; $__LIST__ = $addresslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$address): $mod = ($i % 2 );++$i;?><li class="select-address" data-id="<?php echo ($address["id"]); ?>">
                        <label class="label-checkbox item-content">
                            <input type="radio" name="select-address">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">
                                        <?php if(($address['is_default']) == "1"): ?><span class="icon icon-me"></span><?php endif; ?>
                                        <?php echo ($address["username"]); ?>
                                    </div>
                                    <div class="item-after"><?php echo ($address["mobile"]); ?></div>
                                </div>
                                <div class="item-text"><?php echo ($address["address"]); ?></div>
                            </div>
                        </label>
                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="popup popup-coupon" style="height: 100%;top: 0;">
        <div class="content" style="margin-bottom: 0;">
            <div class="content-block-title">代金券列表</div>
            <div class="list-block media-list">
                <ul>
                    <li class="select-coupon-item" data-id="" data-name="有可用代金券" data-total="">
                        <label class="label-checkbox item-content">
                            <input type="radio" name="select-coupon">
                            <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">
                                        不使用代金券
                                    </div>
                                </div>
                            </div>
                        </label>
                    </li>
                    <?php if(!empty($couponlist)): if(is_array($couponlist)): $i = 0; $__LIST__ = $couponlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$coupon): $mod = ($i % 2 );++$i;?><li class="select-coupon-item" data-id="<?php echo ($coupon["id"]); ?>" data-name="<?php echo ($coupon["name"]); ?>" data-total="<?php echo ($coupon["total"]); ?>">
                                <label class="label-checkbox item-content">
                                    <input type="radio" name="select-coupon">
                                    <div class="item-media"><i class="icon icon-form-checkbox"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title">
                                                <?php echo ($coupon["name"]); ?>
                                            </div>
                                            <div class="item-after"><?php echo ($coupon["total"]); ?></div>
                                        </div>
                                    </div>
                                </label>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                        <li class="item-content item-link">
                            <div class="item-inner">
                                <div class="item-title">没有代金券</div>
                            </div>
                        </li><?php endif; ?>
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
        var addressId = '<?php echo ($address["id"]); ?>';
        var coupon_id = '';
        var payTotal = '<?php echo ($order["total"]); ?>';
        var addressList = true;
        <?php if(empty($addressList)): ?>addressList = false;<?php endif; ?>


        $(document).on('click','#toPay', function () {
            var is_ziti = 0;
            $.showPreloader();
            if($('#ziti-address').hasClass('active')){
                is_ziti = 1;
                addressId = 0;
            }
            $.ajax({
                url: "<?php echo U('Pay/pay');?>",
                type: 'post',
                dataType: 'json',
                data: {address: addressId, coupon_id: coupon_id,is_ziti: is_ziti},
                success: function(data){
                    $.hidePreloader();
                    if(data.code == 200){
                        var config = data.data;
                        if(typeof config == 'string') {
                            config = JSON.parse(config);
                        }

                        _toDo(config);
                    } else {
                        $.alert(data.msg);
                    }
                },
                error: function (x) {
                    $.hidePreloader();
                    $.alert('支付失败了！');
                }
            })
        });
        //微信支付
        function onBridgeReady(config){
//            console.log(config);
            WeixinJSBridge.invoke(
                    'getBrandWCPayRequest', config,
                    function(res){
//                        alert(JSON.stringify(res));
                        if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                            window.location.href = "<?php echo U('Order/res');?>";
                        } else if(res.err_msg == "get_brand_wcpay_request:cancel"){
                        } else {
                            $.alert('支付失败,请重试！');
                        }
                    }
            );
        }

        function _toDo(config){
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', onBridgeReady(config), false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', onBridgeReady(config));
                    document.attachEvent('onWeixinJSBridgeReady', onBridgeReady(config));
                }
            }else{
                onBridgeReady(config);
            }
        }

        //选择代金券
        $(document).on('click','#select-coupon', function () {
            $.popup('.popup-coupon');
        });
        $(document).on('click','.select-coupon-item', function () {
            coupon_id = $(this).attr('data-id');
            var coupont_total = $(this).attr('data-total')||0;
            var coupon_name = $(this).attr('data-name');

            var total = parseFloat(payTotal).toFixed(2);
            coupont_total = parseFloat(coupont_total).toFixed(2);
            total = parseFloat(total) - coupont_total;
            if(total <= 0){
                total = '0.00';
            } else {
                total = total.toFixed(2);
            }
            if(coupont_total == 0){
                coupont_total = '';
            }
            $('#total').text(total);
            var html = '<div class="item-title">'+coupon_name+'</div><div class="item-after">'+coupont_total+'</div>';
            $('#coupon-item-checked').html(html);
            $.closeModal('.popup-coupon');
        });


        //添加地址
        $(document).on('click','#add-address', function () {
            $.popup('.popup-address');
        });
        $(document).on('click','#add-address-list', function () {
            if(addressList === true){
                $.popup('.popup-address-list');
            } else {
                $.toast("请先添加地址");
            }
        });

        $(document).on('click','.popup-overlay', function () {
            $.closeModal('.popup-address');
        });
        //自提
        $(document).on('click', '#ziti-address', function () {
            var check = $(this).hasClass('active');
            console.log(check);
            if(check){
                $('#show-address').hide();
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
                $('#show-address').show();
                $('#show-address-item').text('自提地址：郑东新区绿地原盛国际7号楼附5号千品百汇二楼');
            }

        });

        $(document).on('click','.select-address', function () {
            var username = Trim($(this).find('.item-title').text());
            var mobile = Trim($(this).find('.item-after').text());
            var address = Trim($(this).find('.item-text').text());
            addressId = $(this).attr('data-id');
            $('#ziti-address').removeClass('active');
            $('#show-address-item').text(username+' '+mobile+' '+ address);
            if($('#show-address').hasClass('hide')){
                $('#show-address').removeClass('hide');
            }
            setTimeout(function () {
                $.closeModal('.popup-address-list');
            },200)
        });

        $(document).on('click', '#add-user-address', function(){
            var username = Trim($('#user-name').val());
            var mobile = Trim($('#user-mobile').val());
            var address = Trim($('#user-address').val());
            $.ajax({
                url: "<?php echo U('Address/save');?>",
                type: 'post',
                dataType: 'json',
                data: {username: username, mobile: mobile, address: address},
                success: function(data){
                    if(data.code == 200){
                        addressId = data.data;
                        $('#ziti-address').removeClass('active');
                        $('#show-address-item').text(username+' '+mobile+' '+ address);
                        $('#show-address').removeClass('hide');
                        $.closeModal('.popup-address');

                        addressList = true;
                    }
                },
                error: function () {
                    $.alert('添加失败！');
                }
            })
        });

        //去两端空格
        function Trim(str)
        {
            return str.replace(/(^\s*)|(\s*$)/g, "");
        }
    </script>

</body>
</html>