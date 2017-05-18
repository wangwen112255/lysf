<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>鲁豫食府</title>
    <!-- 引入 WeUI -->
    <link rel="stylesheet" href="//res.wx.qq.com/open/libs/weui/1.1.0/weui.min.css"/>
</head>
<body>


    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">支付成功</h2>
            <p class="weui-msg__desc">支付成功了，如有任何疑问，请拨打电话63355589<a href="javascript:void(0);"></a></p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="<?php echo U('Order/index');?>" class="weui-btn weui-btn_primary">查看订单</a>
                <a href="<?php echo U('Dish/index');?>" class="weui-btn weui-btn_default">看看其他美食</a>
            </p>
        </div>
        <div class="weui-msg__extra-area">
            <div class="weui-footer">
                <p class="weui-footer__links">
                    <a href="javascript:void(0);" class="weui-footer__link"></a>
                </p>
                <p class="weui-footer__text">Copyright &copy; 2016 鲁豫食府</p>
            </div>
        </div>
    </div>


</body>
</html>