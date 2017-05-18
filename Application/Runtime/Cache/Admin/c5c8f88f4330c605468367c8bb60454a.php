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
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=FbzOyQ4YujPrZsxiQKoB07aB"></script>

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
            

    <form class="form-horizontal m-t" action="<?php echo U('add');?>" method="post" id="signupForm">
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
        <input type="hidden" name="shop_id" value="<?php echo ($_GET['shop_id']); ?>">
        <div class="form-group">
            <label class="col-sm-3 control-label">用户名：</label>
            <div class="col-sm-8">
                <input id="username" name="username" value="<?php echo ($data["username"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="true"
                       class="error">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">手机号：</label>
            <div class="col-sm-8">
                <input id="phone" name="phone" value="<?php echo ($data["phone"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="false"
                       class="valid">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">邮箱：</label>
            <div class="col-sm-8">
                <input id="email" name="email" value="<?php echo ($data["email"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="false"
                       class="valid">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">密码：</label>
            <div class="col-sm-8">
                <input type="password" name="password" id="password" class="form-control" value="<?php echo ($data["password"]); ?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">确认密码：</label>
            <div class="col-sm-8">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo ($data["password"]); ?>" >
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
    </form>

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

        // 手机号码验证
        $.validator.addMethod("isMobile", function(value, element) {
            var length = value.length;
            var mobile = /^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/;
            return this.optional(element) || (length == 11 && mobile.test(value));
        }, "请正确填写您的手机号码");


        $().ready(function () {
            var icon = "<i class='fa fa-times-circle'></i> ";
            $().ready(function () {
                var icon = "<i class='fa fa-times-circle'></i> ";
                var rules = {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        minlength: 11,
                        isMobile: true
                    }
                };
                var message = {
                    username: {
                        required: icon + "请输入您的用户名",
                        minlength: icon + "用户名必须5个字符以上"
                    },
                    password: {
                        required: icon + "请输入您的密码",
                        minlength: icon + "密码必须5个字符以上"
                    },
                    confirm_password: {
                        required: icon + "请再次输入密码",
                        minlength: icon + "密码必须5个字符以上",
                        equalTo: icon + "两次输入的密码不一致"
                    },
                    email: icon + "请输入您的E-mail",
                    phone: {
                        required: icon + "请输入手机号",
                        minlength: icon + "手机号必须11位数字",
                        isMobile: icon + '请填写正确的手机号码'
                    }
                };
                _validateForm('signupForm',rules, message);
            });

        });
    </script>

</body>
</html>