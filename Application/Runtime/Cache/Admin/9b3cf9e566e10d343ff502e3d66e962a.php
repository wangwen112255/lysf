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
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" id="id">
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
                    <label class="col-sm-3 control-label">开始时间：</label>
                    <div class="col-sm-8">
                        <input id="begintime" name="begintime" value="<?php echo ($data["begintime"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="true"
                               class="valid">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">截止时间：</label>
                    <div class="col-sm-8" >
                        <input name="endtime" id="endtime" class="form-control" value="<?php echo ($data["endtime"]); ?>"/>
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
    <script>
        // checkbox
        var elem = document.querySelectorAll('.js-switch');
        for (var i=0;i<elem.length;i++){
            new Switchery(elem[i],{ color: '#64bd63', secondaryColor: '#f00', jackColor: '#fff'});
        }

        $().ready(function () {
            var icon = "<i class='fa fa-times-circle'></i> ";
            $().ready(function () {
                var icon = "<i class='fa fa-times-circle'></i> ";
                var rules = {
                    endtime: "required",
                };
                var message = {
                    endtime: icon + "请输入订餐截止时间",
                };
                _validateForm('signupForm',rules, message);
            });

        });

    </script>

</body>
</html>