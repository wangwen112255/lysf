<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>跳转提示</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css">
    <link rel="stylesheet" href="__PUBLIC__/home/css/common.css">

</head>

<body ontouchstart>
    <div class="weui_msg">
        <?php if(isset($message)) {?>
        <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
        <?php }else{?>
        <div class="weui_icon_area"><i class="weui_icon_msg weui_icon_warn"></i></div>
        <?php }?>
        <div class="weui_text_area">
            <?php if(isset($message)) {?>
            <h2 class="weui_msg_title">操作成功</h2>
            <p class="weui_msg_desc"><?php echo($message); ?></p>
            <?php }else{?>
            <h2 class="weui_msg_title">操作失败</h2>
            <p class="weui_msg_desc"><?php echo($error); ?></p>
            <?php }?>


        </div>
        <div class="weui_opr_area">
            <p class="weui_btn_area">
                <a href="javascript:;" onclick="window.location.href='<?php echo($jumpUrl); ?>';" class="weui_btn weui_btn_primary">确定</a>
            </p>
        </div>
        <div class="weui_extra_area">
            <a id="href" href="<?php echo($jumpUrl); ?>">自动跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
        </div>
    </div>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
</body>
</html>