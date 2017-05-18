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
    
    <link href="/Public/static/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">

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

        <table data-toggle="table" data-click-to-select="true" data-mobile-responsive="true">
            <thead>
            <tr>
                <th data-field="name">名称</th>
                <th data-field="pic">图片</th>
                <th data-field="price">价格</th>
                <th data-field="num">数量</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($v["id"]); ?>">
                    <td><?php echo ($v["name"]); ?></td>
                    <td><img src="<?php echo (getPicThumb($v["pic"],'s_')); ?>" /></td>
                    <td><?php echo ($v["good_price"]); ?></td>
                    <td><?php echo ($v["good_num"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

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
    <script src="/Public/static/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
    <script src="/Public/static/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
    <script src="/Public/static/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>


</body>
</html>