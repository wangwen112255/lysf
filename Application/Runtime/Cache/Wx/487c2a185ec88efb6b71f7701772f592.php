<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo ((isset($title) && ($title !== ""))?($title):"鲁豫食府"); ?></title>
    <link rel="stylesheet" href="/Public/wx/dist/css/frozen.css">
    <link rel="stylesheet" href="/Public/wx/app.css">
    
    <style>
        a{color: #666;}
        .left,.right{min-height: 100%;}
        .left{background: #f0f0f0;position: fixed;left: 0;top:0;}
        .right{background: #fff;position: absolute;right: 0;top:0;}
        .ui-list {background: #f0f0f0;}
        .ui-list li.active{background: #fff;}
        .item{height: 100%;display: none;}
        .item.active{display: block;}
        .ui-grid-trisect > li {width: 50%;}
        .ui-grid-trisect-img {padding-top: 100%;}
        .ui-grid-trisect-img > span{background-position: center;background-size: contain;}
        .ui-list-text>li, .ui-list-pure>li,.ui-list>li.active+li.ui-border-t{padding-right: 0;}
    </style>

</head>
<body ontouchstart="">


<section class="ui-container">
    
    <section id="tab" class="full">
        <div class="ui-col ui-col-25 left">
            <ul class="ui-list ui-list-pure ui-border-tb">
                <?php if(!empty($category)): if(is_array($category)): $k = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><li class="ui-border-t <?php if($k == 1): ?>active<?php endif; ?>">
                            <h4><?php echo ($v["name"]); ?></h4>
                        </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
            </ul>
        </div>
        <div class="ui-col ui-col-75 right">
            <?php if(!empty($list)): if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><ul class="ui-grid-trisect ui-border-b item <?php if($k == 1): ?>active<?php endif; ?>">
                        <?php if(!empty($v)): if(is_array($v)): $i = 0; $__LIST__ = $v;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><li>
                                <a href="<?php echo U('desc', array('id'=>$g['id']));?>">
                                    <div class="ui-grid-trisect-img">
                                        <span style="background-image:url(<?php echo (getPicThumb($g["pic"],'m_')); ?>)"></span>
                                    </div>
                                    <h5 class="ui-nowrap ui-whitespace ui-flex ui-flex-pack-center"><?php echo ($g["name"]); ?></h5>
                                </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                            <?php else: ?>
                            <li style="font-size: 24px;text-align: center;width: 100%;">敬请期待.</li><?php endif; ?>
                    </ul><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div>
    </section>

</section>
<script src="/Public/wx/dist/lib/zepto.min.js"></script>
<script src="/Public/wx/dist/js/frozen.js"></script>

    <script>
        (function (){
            $('.ui-list li').click(function () {
                var index = $(this).index();
                var active = $(this).hasClass('active');
                if(!active){
                    $('.ui-list li').removeClass('active');
                    $(this).addClass('active');
                    _setShow(index);
                }
            })

            function _setShow(index){
                $('.item').hide();
                $('.item').eq(index).show();
            }
        })();
    </script>

</body>
</html>