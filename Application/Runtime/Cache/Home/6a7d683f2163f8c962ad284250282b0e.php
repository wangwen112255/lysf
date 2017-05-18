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
    
<link href="/Public/static/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="/Public/static/css/plugins/fileinput/fileinput.min.css" rel="stylesheet">
<link href="/Public/static/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <style>
        .tool {margin-top: -5px;}
        .del-pic{
            font-size: 24px;
            color: #ff4500;}
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
            
    <div class="col-sm-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                图片列表
            </div>
            <div class="panel-body" id="pic-list">
                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a id="item<?php echo ($v["id"]); ?>" class="fancybox" href="<?php echo ($v["pic"]); ?>" title="图片">
                            <img alt="image" src="<?php echo ($v["pic"]); ?>" />
                            <i class="fa fa-trash del-pic" onclick="_del('<?php echo ($v["id"]); ?>')"></i>
                        </a><?php endforeach; endif; else: echo "" ;endif; endif; ?>

            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                添加图片
                <span class="pull-right m-r tool"><button class="btn btn-primary"><i class="fa fa-plus"></i></button></span>
            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input id="file" name="file" type="file" multiple=true >
                            <span class="help-block m-b-none">建议尺寸640x200</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                轮播展示
            </div>
            <div class="panel-body">
                <div class="carousel slide" id="carousel1">
                    <div class="carousel-inner">
                        <?php if(!empty($list)): if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="item <?php if(($k) == "1"): ?>active<?php endif; ?>">
                                <img alt="image" class="img-responsive" src="<?php echo ($v["pic"]); ?>">
                            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </div>
                    <a data-slide="prev" href="carousel.html#carousel1" class="left carousel-control">
                        <span class="icon-prev"></span>
                    </a>
                    <a data-slide="next" href="carousel.html#carousel1" class="right carousel-control">
                        <span class="icon-next"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>


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

<!-- Bootstrap table -->
<script src="/Public/static/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/Public/static/js/plugins/fancybox/jquery.fancybox.js"></script>
<script src="/Public/static/js/plugins/fileinput/fileinput.min.js"></script>
<script src="/Public/static/js/plugins/fileinput/fileinput_locale_zh.js"></script>
<script src="/Public/static/js/plugins/toastr/toastr.min.js"></script>
<script>
    var good_id = '<?php echo ($good_id); ?>';
    $(document).ready(function () {
        $('.fancybox').fancybox({
            openEffect: 'none',
            closeEffect: 'none'
        });
    });

    $("#file").fileinput({
        language: 'zh',
        showUpload: true,
        showCaption: false,
        uploadUrl: "<?php echo ($fileServer); ?>",
        uploadExtraData: {'path':'Goods'},
        browseClass: "btn btn-primary",
        allowedFileTypes: ['image'],
        allowedFileExtensions: ['jpg', 'png','gif'],
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });

    $("#file").on("fileuploaded", function (event, data, previewId, index) {
        var res = data.response;
        if(res.code == 200){
            pics = res.data;
            _setPics(pics[0].src);
        } else {
            layer.alert(res.msg);
        }
    });

    function _del(id){
        $.fancybox.close()
        layer.confirm('确定删除？',{btn: ['删除','取消']},function(index){
            _ajax({
                url: "<?php echo U('delPics');?>",
                data: {id: id},
                success: function(data){
                    $.fancybox.close()
                    if(data.code == 200){
                        $('#item'+id).hide();
                        layer.msg(data.msg,{icon: 1,time: 700});
                    } else {
                        layer.alert(data.msg);
                    }
                },
                param: id
            });
            layer.close(index);
        },function(index){
            $.fancybox.close()
            layer.close(index);
        })
    }

    function _setPics(src){
        $.ajax({
            url: "<?php echo U('Goods/setPics');?>",
            type: 'post',
            data: {'good_id': good_id, 'pic': src},
            dataType: 'json',
            success: function (data) {
                if(data.code == 200){
                    _addPic(src,data.data);
                    toastr.success(data.msg);
                } else {
                    layer.alert(data.msg);
                }
            }
        })
    }

    function _addPic(src,id){
        var item = '<a id="item'+id+'" class="fancybox" href="'+src+'" title="图片">'+
                '<img alt="image" src="'+src+'" />'+
                '<i class="fa fa-trash del-pic" onclick="_del("'+id+'")"></i></a>';
        $('#pic-list').append(item);
    }

</script>

</body>
</html>