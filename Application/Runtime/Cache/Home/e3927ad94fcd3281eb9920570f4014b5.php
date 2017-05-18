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
        <form class="form-horizontal" action="<?php echo U('save');?>" method="post" id="signupForm">
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
            <input type="hidden" name="pic" value="<?php echo ($data["pic"]); ?>">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    基本信息
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">父类：</label>
                        <div class="col-sm-8">
                            <select name="pid" id="pid" class="form-control">
                                <option value="0">顶级</option>
                                <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php if($v['id'] == $pid): ?>selected<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">分类名称：</label>
                        <div class="col-sm-8">
                            <input id="name" name="name" value="<?php echo ($data["name"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="false"
                                   class="valid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">排序：</label>
                        <div class="col-sm-8">
                            <input id="sort" name="sort" value="<?php echo ($data["sort"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="false"
                                   class="valid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否展示：</label>
                        <div class="col-sm-8">
                            <input type="checkbox" value="1" <?php if($data['is_show'] == 1): ?>checked<?php elseif(!isset($data['is_show'])): ?>checked<?php else: endif; ?> class="form-control js-switch" id="status" name="is_show" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="col-sm-8">
                            <input type="checkbox" value="1" <?php if($data['status'] == 1): ?>checked<?php elseif(!isset($data['status'])): ?>checked<?php else: endif; ?> class="form-control js-switch" id="status" name="status" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
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
                    name: "required",
                };
                var message = {
                    name: icon + "请填写分类名称",
                };
                _validateForm('signupForm',rules, message);
            });

        });
    </script>

</body>
</html>