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
    <link href="/Public/static/css/fileinput.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/static/css/plugins/wangEditor/css/wangEditor.min.css">
    <style>
        #map_container{
            height: 400px;
        }
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
            

    <div class="col-sm-12">
        <form class="form-horizontal" action="<?php echo U('insert');?>" method="post" id="signupForm">
            <div class="panel panel-info">
                <div class="panel-heading">
                    添加文章
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">文章名称:</label>
                        <div class="col-sm-7">
                            <input id="title" name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">图片:</label>
                        <div class="col-sm-7">
                            <input type="file" name="uploadfile"  value="" id="uploadfile"  accept="image/*"  class="file-loading error" />
                            <input type="hidden" name="pic" class="form-control" id="pic" aria-required="true" aria-invalid="true" class="error"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"  >文章内容:</label>
                        <div class="col-sm-7">
                            <textarea id="desc" name="desc" style="height: 300px;"  class="form-control" aria-required="true" aria-invalid="true"  class=" error"></textarea>
                        </div>
                    </div>
                    <!--<div class="form-group">-->
                    <!--<label class="col-sm-2 control-label">是否与其他活动叠加：</label>-->
                    <!--<div class="col-sm-8">-->
                    <!--<input type="checkbox" value="1" class="form-control js-switch" id="is_other" name="is_other">-->
                    <!--</div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="col-sm-7">
                            <input type="checkbox" value="1" class="form-control js-switch" id="status" name="status"  checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-2">
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
    <script src="/Public/static/js/fileinput.min.js"></script>
    <script src="/Public/static/js/zh.js"></script>
    <script src="/Public/static/js/plugins/wangEditor/plupload/plupload.full.min.js"></script>
    <script src="/Public/static/js/plugins/wangEditor/wangEditor.min.js"></script>


    <script>
        function _uploadFile(uploadid,picid) {
            $("#" + uploadid).fileinput({
                language: 'zh', //设置语言
                uploadUrl: '/api.php/File/upfile',//上传的地址
                allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
                //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
                uploadAsync: true, //默认异步上传
                showUpload: true, //是否显示上传按钮
                showRemove: true, //显示移除按钮
                showPreview: true, //是否显示预览
                showCaption: false,//是否显示标题
                autoReplace: true,
                browseClass: "btn btn-primary", //按钮样式
                dropZoneEnabled: true,//是否显示拖拽区
                maxImageHeight: 1000,//图片的最大高度
                maxFileCount: 1,
                uploadExtraData:{ 'path':'Article'},
                validateInitialCount: true,
                previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
                msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！"
            }).on("fileuploaded", function (e, data) {
                var res=data.response;
                if(res.code==200){
                    var s=res.data;
                    var pic=s[0].src;
                    $("#" + picid).val(pic);
                    layer.msg("上传成功",{icon:1,time:500});
                }
                else {

                    layer.alert(res.msg);
                }
            });
        }
        _uploadFile("uploadfile","pic");
        // checkbox
        var elem = document.querySelectorAll('.js-switch');
        for (var i=0;i<elem.length;i++){
            new Switchery(elem[i],{ color: '#64bd63', secondaryColor: '#f00', jackColor: '#fff'});
        }
        //编辑器
        _initEditor();
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
                url: '/api.php/File/upfile',  // 服务器端的上传地址
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
        $.validator.addMethod("isUrl", function(value, element) {
            var links =/^([hH][tT]{2}[pP]:\/\/|[hH][tT]{2}[pP][sS]:\/\/)(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/;
            return this.optional(element) || (links.test(value));
        }, "请输进去正确的链接地址");


        $().ready(function () {
            var icon = "<i class='fa fa-times-circle'></i> ";
            $().ready(function () {
                var icon = "<i class='fa fa-times-circle'></i> ";
                var rules = {
                    title: {
                        required: true,
                        minlength:5,
                        maxlength:40
                    },
                    desc: "required",
                    pic: "required",
                    link: {required:true,
                        url:true
                              }

                };
                var message = {
                    title: {
                        required: "请输入图文名称",
                        maxlength:"请输入长度小于40的文章标题",
                        minlength:"请输入长度大于5的文章标题"

                    },
                    desc: "请图文内容",
                    pic: "请选择图片",
                    link: {
                        required:"请输入图文链接",
                        url:"请输入正确的URL"
                    }
                };
                _validateForm('signupForm',rules, message);
            });

        });
    </script>

</body>
</html>