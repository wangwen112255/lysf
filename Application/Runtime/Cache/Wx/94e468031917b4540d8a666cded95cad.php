<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo ((isset($title) && ($title !== ""))?($title):"鲁豫食府"); ?></title>
    <link rel="stylesheet" href="/Public/wx/dist/css/frozen.css">
    <link rel="stylesheet" href="/Public/wx/app.css">
    
</head>
<body ontouchstart="">

<!--<header class="ui-header ui-header-positive ui-border-b">-->
    <!--<i class="ui-icon-return" onclick="history.back()"></i>-->
    <!--<h1></h1>-->
    <!--<button class="ui-btn">回首页</button>-->
<!--</header>-->


<!--<footer class="ui-footer ui-footer-btn">-->
    <!--<ul class="ui-tiled ui-border-t">-->
        <!--<li data-href="index.html" class="ui-border-r"><div>基础样式</div></li>-->
        <!--<li data-href="ui.html" class="ui-border-r"><div>UI组件</div></li>-->
        <!--<li data-href="js.html"><div>JS插件</div></li>-->
    <!--</ul>-->
<!--</footer>-->

<section class="ui-container">
    
    <?php if(!empty($data['piclist'])): ?><div class="ui-slider">
            <ul class="ui-slider-content">
                <?php if(is_array($data['piclist'])): $i = 0; $__LIST__ = $data['piclist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><span style="background-image:url(<?php echo (getPicThumb($v["pic"],'l_')); ?>)"></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <?php else: ?>
        <div class="ui-row" style="max-height:200px;overflow: hidden;">
            <img src="<?php echo (getPicThumb($data["pic"],'l_')); ?>" alt="图片" style="width: 100%;margin-top: -70px;">
        </div><?php endif; ?>

</section>
<script src="/Public/wx/dist/lib/zepto.min.js"></script>
<script src="/Public/wx/dist/js/frozen.js"></script>

    <?php if(!empty($data['piclist'])): ?><script>
            (function(){
                 new fz.Scroll('.ui-slider', {
                    role: 'slider',
                    indicator: true,
                    autoplay: true,
                    interval: 3000
                });
            })();
        </script><?php endif; ?>

</body>
</html>