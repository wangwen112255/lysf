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
        .price {
            color: #ff3030;
            font-size: 20px;
            font-weight: bold;
        }
        .button {display: inline-block;}
        .tool {
            color: #b3b3b3;
            border-radius: 50%;
            border-color: #b3b3b3;
            background: #ffffff;
            width: 30px;
            height: 30px;
            padding: 0;
            line-height: 30px;
        }
        .tool.active {color: #fff;background: #ff7012;border: none;}
        .num-tool {text-align: right;}
        .num,.list-block input[type=number] {width: 50px;border: none;padding: 0;color: #000;display: inline-block;}
        .row.bar{bottom: 0;margin: 0;padding-right: 0;}
        .row.bar div{height: 100%;line-height: 2.5em;}
        .todo{background: #ff7012;color: #ffffff;line-height: 2.5;text-align: center;}
        .total span{color: #ff3030;}
        .tool-j{visibility:hidden;}
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">

    <div class="row bar">
        <div class="col-60 total">实付款：<span><big id="total">0.00</big></span></div>
        <div class="col-40 todo" onclick="_toPay()">立即支付</div>
    </div>
    <div class="content">
        <div class="card">
            <div valign="bottom" class="card-header color-white no-border no-padding">
                <img class='card-cover'
                     src="<?php echo (getPicThumb($data["pic"],'l_')); ?>"
                     alt="<?php echo ($data["name"]); ?>">
            </div>
            <div class="card-content">
                <div class="card-content-inner">
                    <p class="color-gray"><?php echo ($data["name"]); ?></p>
                    <div class="row">
                        <div class="price col-20">￥<?php echo ($data["price"]); ?></div>
                        <div class="num-tool col-80">
                            <a href="javascript:void(0)" id="tool-j<?php echo ($data["id"]); ?>" onclick="_setNum(false,<?php echo ($data["id"]); ?>,<?php echo ($data["price"]); ?>);" class="button tool tool-j">-</a>
                            <input type="number" name="num<?php echo ($data["id"]); ?>" value="" id="num<?php echo ($data["id"]); ?>" class="button num"/>
                            <a href="javascript:void(0)" onclick="_setNum(true,<?php echo ($data["id"]); ?>,<?php echo ($data["price"]); ?>);" class="button tool active">+</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">自选汤羹</div>
            <div class="card-content">
                <div class="card-content-inner">
                    <a href="#" onclick="_selectTang(this);" class="button button-light button-round tang">紫菜蛋花汤</a>
                    <a href="#" onclick="_selectTang(this);" class="button button-light button-round tang" style="margin-left: 50px;">玉米羹</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">详细信息</div>
            <div class="card-content">
                <div class="card-content-inner">
                    <?php echo (htmlspecialchars_decode($data["desc"])); ?>
                </div>
            </div>
        </div>
        <?php if(!empty($list)): ?><div class="card">
            <div class="card-header">
                饮品
            </div>
            <div class="card-content">
                <div class="card-content-inner">
                    <div class="list-block media-list">
                        <ul>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li>
                                <div class="item-content">
                                    <div class="item-media"><img src="<?php echo (getPicThumb($v["pic"],'s_')); ?>" style='width: 2.2rem;'></div>
                                    <div class="item-inner">
                                        <div class="item-title-row">
                                            <div class="item-title"><?php echo ($v["name"]); ?></div>
                                        </div>
                                        <div class="item-subtitle row">
                                            <div class="price col-20">￥<?php echo ($v["price"]); ?></div>
                                            <div class="num-tool col-80">
                                                <a href="javascript:void(0)" id="tool-j<?php echo ($v["id"]); ?>" onclick="_setNum(false,<?php echo ($v["id"]); ?>,<?php echo ($v["price"]); ?>);" class="button tool tool-j">-</a>
                                                <input type="number" name="num<?php echo ($v["id"]); ?>" value="" id="num<?php echo ($v["id"]); ?>" class="button num"/>
                                                <a href="javascript:void(0)" onclick="_setNum(true,<?php echo ($v["id"]); ?>,<?php echo ($v["price"]); ?>);" class="button tool active">+</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <!--list结束-->
                </div>
            </div>
        </div><?php endif; ?>
        <!--card结束-->
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
        localStorage.removeItem("goods");
        $(document).ready(function(){
           $('.num').val('');
        });
        var total = 0;

        function _setNum(type, id,price){
            price = parseFloat(price);
            setShoppingCart(id, type,price);
        }

        function _selectTang(el){
            tang = $(el).text();
            var res = $('el').hasClass('active');
            if(res){
                return;
            }
            $('.tang').removeClass('active');
            $(el).addClass('active');
        }

        function _toPay(){
            var goods = localStorage.getItem("goods");
            goods = JSON.parse(goods);
            if(goods==null || goods=="undefined"){
                $.alert('还没有选择商品！');
                return;
            }
            var tang = $('.tang.active').text();
            if(!tang){
               $.confirm('确定不选择免费汤羹吗?',
                    function () {
                        _getOrderConfirm(goods,tang);
                    },
                    function () {
                    }
               );
            } else {
                _getOrderConfirm(goods,tang);
            }
        }

        //请求订单数据
        function _getOrderConfirm(goods,tang){
            $.ajax({
                url: "<?php echo U('Order/setOrder');?>",
                data: {goods: goods, tang: tang},
                type: 'post',
                dataType: 'json',
                success: function(data){
                    if(data.code == 200){
                        window.location.href = "<?php echo U('confirm');?>";
//                        $.router.load("<?php echo U('confirm','','');?>");
                    } else {
                        $.alert(data.msg);
                    }
                },
                error: function(){
                    $.alert('请求订单失败！');
                }
            })
        }

        //添加商品
        function setShoppingCart(id,type,price){
            total = parseFloat(total);
            price = parseFloat(price);
            var isSave=false;
            var goods = localStorage.getItem("goods");
            goods = JSON.parse(goods);
            if(goods!=null&&goods!="undefined"){
//                console.log('购物车有商品');
                //如果不为空，则判断购物车中是否包含了当前购买的商品
                for(var i=0;i<goods.length;i++){
//                    console.log(goods[i]);
                    isSave=false;
                    if(goods[i].id==id){
//                        console.log('添加1个');
                        //说明该商品已在购物车，则数量加1
                        if(type == true){
                            goods[i].num+=1;
                            total += price;
                            _setHide(id,goods[i].num);
                        } else if (type == false){
                            goods[i].num-=1;
                            total -= price;
                            if(goods[i].num == 0){
                                goods.splice(i,1);
                                _setHide(id,0);
                            }
                        }

                        isSave=true;
                        break;
                    }
                }
                if(!isSave){
//                    console.log('没有此商品');
                    goods[goods.length]={id: id,num: 1};
                    total += price;
                    _setHide(id,1);
                }
            }else{
                var goods=[{id: id,num: 1}];
                total += price;
                _setHide(id,1);
            }
//            console.log(goods);
            goods=JSON.stringify(goods);//将JSON对象转化成字符串
            localStorage.setItem("goods",goods);//用localStorage保存转化好的的字符串
            _setTotal();
        }

        function _setTotal(){
            total = parseFloat(total).toFixed(2);
            if(isNaN(total) || total<0){
                total = 0.00;
                $('#total').text('0.00');
            } else {
                $('#total').text(total);
            }
        }

        function _setHide(id,num){
            var el = '#tool-j'+id;
            $('#num'+id).val(num);
            if($(el).hasClass('tool-j')){
                if(num != 0) {
                    $(el).removeClass('tool-j');
                }
            } else {
                if(num == 0){
                    $('#num'+id).val('');
                    $(el).addClass('tool-j');
                }
            }
        }
    </script>

</body>
</html>