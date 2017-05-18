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
    
    <link href="/Public/static/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/Public/static/css/plugins/fileinput/fileinput.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/static/css/plugins/wangEditor/css/wangEditor.min.css">

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
            
    <div class="col-sm-12">
    <form class="form-horizontal" action="<?php echo U('save');?>" method="post" id="signupForm" enctype="multipart/form-data" >
        <input type="hidden" name="pic" value="<?php echo ($data["pic"]); ?>" id="pic">
        <div class="panel panel-info">
            <div class="panel-heading">
                基本信息
            </div>
            <div class="panel-body">
                <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label">名称：</label>
                    <div class="col-sm-8">
                        <input id="name" name="name" value="<?php echo ($data["name"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="true"
                               class="error">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">价格：</label>
                    <div class="col-sm-8">
                        <input id="price" name="price" value="<?php echo ($data["price"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="true"
                               class="valid">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">单位：</label>
                    <div class="col-sm-8">
                        <select name="unit" id="unit" class="form-control">
                            <option value="份">每份</option>
                            <option value="位">每位</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">时间：</label>
                    <div class="col-sm-8">
                        <select name="week" id="week" class="form-control">
                            <option value="0">请选择时间</option>
                            <?php if(!empty($list)): if(is_array($week)): $k = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>" <?php if($weekDay == $k): ?>selected<?php endif; ?> ><?php echo ($v); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">类别：</label>
                    <div class="col-sm-8">
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">请选择类别</option>
                            <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $pid): ?>selected<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </select>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">展示图：</label>
                        <div class="col-sm-8">
                            <input id="file" name="file" type="file" multiple=true >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">描述：</label>
                    <div class="col-sm-8" >
                        <textarea name="desc" id="desc" class="form-control" style="height: 300px;max-height: 500px;"><?php echo ($data["desc"]); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">外卖：</label>
                    <div class="col-sm-8">
                        <input type="checkbox" value="1" <?php if($data['is_takeout'] == 1): ?>checked<?php endif; ?> class="form-control js-switch" id="is_takeout" name="is_takeout">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">状态：</label>
                    <div class="col-sm-8">
                        <input type="checkbox" value="1" <?php if(($data['status'] == 1) or !isset($data['status'])): ?>checked<?php endif; ?> class="form-control js-switch" id="status" name="status">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-3">
                        <button class="btn btn-primary" type="submit">提交</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
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

    <script src="/Public/static/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="/Public/static/js/plugins/validate/messages_zh.min.js"></script>
    <script src="/Public/static/js/plugins/switchery/switchery.js"></script>
    <script src="/Public/static/js/plugins/fileinput/fileinput.min.js"></script>
    <script src="/Public/static/js/plugins/fileinput/fileinput_locale_zh.js"></script>
    <script src="/Public/static/js/plugins/wangEditor/plupload/plupload.full.min.js"></script>
    <script src="/Public/static/js/plugins/wangEditor/wangEditor.min.js"></script>
    <script>
        // checkbox
        var elem = document.querySelectorAll('.js-switch');
        for (var i=0;i<elem.length;i++){
            new Switchery(elem[i],{ color: '#64bd63', secondaryColor: '#f00', jackColor: '#fff'});
        }
        _initEditor();

        $().ready(function () {
            var icon = "<i class='fa fa-times-circle'></i> ";
            $().ready(function () {
                var icon = "<i class='fa fa-times-circle'></i> ";
                var rules = {
                    name: "required",
                    week: "required",
//                    category_id: {
//                        required: true,
//                        min: 1
//                    },
                    desc: "required",
                    /*price: {
                        required: true,
                        number:true,
                        min: 0
                    }*/
                };
                var message = {
                    name: icon + "请输入名称",
                    week: icon + "请选择时间",
                    category_id: {
                        required: icon + "请选择类别",
                        min: icon + "请选择类别"
                    },
                    desc: icon + "请输入描述",
                    /*price: {
                        required: icon+'请输入价格',
                        number: icon + '请输入正确的价格',
                        min: icon + '价格不能小于0'
                    }*/
                };
                _validateForm('signupForm',rules, message);
            });

        });

        $("#file").fileinput({
            language: 'zh',
            showUpload: true,
            showCaption: false,
            uploadUrl: "<?php echo ($fileServer); ?>",
            uploadExtraData: {'path':'Goods', 'size': '100'},
            browseClass: "btn btn-primary",
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png','gif'],
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
        });

        $("#file").on("fileuploaded", function (event, data, previewId, index) {
            var res = data.response;
            console.log(res)
            if(res.code == 200){
                pics = res.data;
                $('#pic').val(pics[0].src);
            } else {
                layer.alert(res.msg);
            }
        });

        <?php if(!empty($data['pic'])): ?>initPortrait('file', '<?php echo ($data["pic"]); ?>')<?php endif; ?>

        //初始化图像信息
        function initPortrait(ctrlName, src) {
            var control = $('#' + ctrlName);
            var imageurl = ''+src;

            //重要，需要更新控件的附加参数内容，以及图片初始化显示
            control.fileinput('refresh', {
                initialPreview: [ //预览图片的设置
                    "<img src='" + imageurl + "' class='file-preview-image' alt='图片' title='图片'>",
                ],
            });
        }

        function _initEditor(){
            wangEditor.config.printLog = false;// 取消粘贴过滤
            var editor = new wangEditor('desc');
            editor.config.pasteFilter = false;//取消打印log
            editor.config.zindex = 20000;//全屏
            editor.config.customUpload = true;  // 配置自定义上传的开关
            editor.config.customUploadInit = uploadInit;  // 配置上传事件，uploadInit方法已经在上面定义了
            editor.create();
        }

        // 封装console.log
        function printLog(title, info) {
            window.console && console.log(title, info);
        }

        // ------- 配置上传的初始化事件 -------
        function uploadInit () {
            var editor = this;
            // 编辑器中，触发选择图片的按钮的id
            var btnId = editor.customUploadBtnId;
            // 编辑器中，触发选择图片的按钮的父元素的id
            var containerId = editor.customUploadContainerId;

            //实例化一个上传对象
            var uploader = new plupload.Uploader({
                browse_button: btnId,  // 选择文件的按钮的id
                url: '<?php echo ($fileServer); ?>',  // 服务器端的上传地址
                flash_swf_url: 'plupload/plupload/Moxie.swf',
                sliverlight_xap_url: 'plupload/plupload/Moxie.xap',
                filters: {
                    mime_types: [
                        //只允许上传图片文件 （注意，extensions中，逗号后面不要加空格）
                        { title: "图片文件", extensions: "jpg,gif,png,bmp" }
                    ]
                }
            });

            //存储所有图片的url地址
            var urls = [];

            //初始化
            uploader.init();

            //绑定文件添加到队列的事件
            uploader.bind('FilesAdded', function (uploader, files) {
                //显示添加进来的文件名
//                $.each(files, function(key, value){
//                    printLog('添加文件' + value.name);
//                });

                // 文件添加之后，开始执行上传
                uploader.start();
            });

            //单个文件上传之后
            uploader.bind('FileUploaded', function (uploader, file, responseObject) {

                //注意，要从服务器返回图片的url地址，否则上传的图片无法显示在编辑器中
                var data = responseObject.response;
                if(typeof data == 'string'){
                    data = JSON.parse(data);
                }
                if(data.code == 200){
                    var pics = data.data;
                    urls.push(pics[0].src);
                }
                //先将url地址存储来，待所有图片都上传完了，再统一处理
            });

            //全部文件上传时候
            uploader.bind('UploadComplete', function (uploader, files) {
                // 用 try catch 兼容IE低版本的异常情况
                try {
                    //打印出所有图片的url地址
                    $.each(urls, function (key, value) {
                        // 插入到编辑器中
                        editor.command(null, 'insertHtml', '<img src="' + value + '" style="max-width:100%;"/>');
                    });
                } catch (ex) {
                    // 此处可不写代码
                } finally {
                    //清空url数组
                    urls = [];

                    // 隐藏进度条
                    editor.hideUploadProgress();
                }
            });

            // 上传进度条
            uploader.bind('UploadProgress', function (uploader, file) {
                // 显示进度条
                editor.showUploadProgress(file.percent);
            });
        }
    </script>

</body>
</html>