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
            

    <form class="form-horizontal" action="<?php echo U('insert');?>" method="post" id="signupForm">
    <div class="col-sm-6">
        <div class="panel panel-info">
                <div class="panel-heading">
                    关键词修改
                </div>
                <div class="panel-body">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">关键词名称:</label>
                        <div class="col-sm-6">
                            <input id="keyword"  name="keyword" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>


                    <!--<div class="form-group">-->
                    <!--<label class="col-sm-2 control-label">是否与其他活动叠加：</label>-->
                    <!--<div class="col-sm-8">-->
                    <!--<input type="checkbox" value="1" class="form-control js-switch" id="is_other" name="is_other">-->
                    <!--</div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">状态：</label>
                        <div class="col-sm-6">
                            <input type="checkbox" value="1" class="form-control js-switch" id="restatus" name="restatus" checked>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-3 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>
                </div>
            </div>


    </div>
    <div class="col-sm-4">
        <div class="panel panel-info" id="art">
            <div class="panel-heading">
                文章列表（选择你要显示的文章）
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th data-field="name">请选择</th>
                        <th data-field="name">名称</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                            <td><input class="article-item" type="radio" name="article_id" value="<?php echo ($key); ?>" <?php if($data["article_id"] == $key): ?>checked<?php endif; ?> /></td>
                            <td><?php echo ($v); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <?php echo ($page); ?>
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
        //selectArticle
        var elem = document.querySelectorAll('.js-switch');
        for (var i=0;i<elem.length;i++){
            new Switchery(elem[i],{ color: '#64bd63', secondaryColor: '#f00', jackColor: '#fff'});
        }

        $().ready(function () {
            var icon = "<i class='fa fa-times-circle'></i> ";
            $().ready(function () {
                var icon = "<i class='fa fa-times-circle'></i> ";
                var rules = {
                    keyword: {
                        required:true,
                        maxlength:20

                    },
                    article_id: {
                        required: true,

                    }

                };
                var message = {
                    keyword: {
                        required:"请输入关键词名称",
                        maxlength:"关键词的长度不能超过20个字符"

                    },
                    article_id: {
                        required: "请选择回复图文"

                    }
                };
                _validateForm('signupForm',rules, message);
            });

        });
    </script>

</body>
</html>