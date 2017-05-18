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
    <div class="fixed-table-toolbar">
        <div class="bars pull-left">
            <div class="btn-group hidden-xs">
                <button onclick="_layOpenUrl('<?php echo U('create');?>','添加')" type="button" class="btn btn-outline btn-default" >
                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-outline btn-default">
                    <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="columns columns-right btn-group pull-right">
            <button class="btn btn-default btn-outline" type="button" title="搜索"><i class="glyphicon glyphicon-search"></i></button>
            <button onclick="javascript:window.location.reload();" class="btn btn-default btn-outline" type="button" name="refresh" title="刷新"><i class="glyphicon glyphicon-repeat"></i></button>
        </div>
        <div class="pull-right search">
            <input class="form-control input-outline" type="text" placeholder="请输入关键字">
        </div>
    </div>
    <table data-toggle="table" data-click-to-select="true" data-mobile-responsive="true">
        <thead>
        <tr>
            <th data-field="id" data-checkbox="true"></th>
            <th data-field="name">名称</th>
            <th data-field="total">优惠值</th>
            <th data-field="min_total">最低参与金额</th>
            <th data-field="type">活动类型</th>
            <th data-field="begintime">开始时间</th>
            <th data-field="endtime">结束时间</th>
            <th data-field="order">排序(越大越靠后)</th>
            <th data-field="status" data-align="center">状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($v["id"]); ?>">
            <td><input type="checkbox" name="id" value="<?php echo ($v["id"]); ?>" /></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><?php echo ($v["total"]); ?></td>
            <td><?php echo ($v["min_total"]); ?></td>
            <td><?php echo ($type[$v['type']]); ?></td>
            <td><?php echo ($v["begintime"]); ?></td>
            <td><?php echo ($v["endtime"]); ?></td>
            <td><?php echo ($v["order"]); ?></td>
            <td data-align="center">
                <button id="status<?php echo ($v["id"]); ?>" onclick="_setStatus(<?php echo ($v["id"]); ?>);" class="btn <?php if(($v['status']) == "1"): ?>btn-info<?php else: ?>btn-default<?php endif; ?>" type="button"><?php echo ($status[$v['status']]); ?></button>
            </td>
            <td>
                <button onclick="_layOpenUrl('<?php echo U('create',array('id'=>$v['id']));?>', '修改')" class="btn btn-info " type="button"><i class="fa fa-paste"></i> 编辑</button>
                <button onclick="_del(<?php echo ($v["id"]); ?>);" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> 删除</button>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <?php echo ($page); ?>

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
<script>
    function _setStatus(id) {
        event.stopPropagation();
        layer.confirm('确定修改状态？',{btn: ['修改','取消']},function(index){
            _ajax({
                "url": "<?php echo U('setStatus');?>",
                "data": {id: id},
                "success": function(data){
                    if(data.code == 200){
                        layer.msg(data.msg,{icon: 1,time: 700});
                        var cl = $('#status'+id).attr('class');
                        cl = (cl=='btn btn-info')?'btn btn-defaule':'btn btn-info';
                        $('#status'+id).text(data.data);
                        $('#status'+id).attr('class',cl);

                    } else {
                        layer.alert( data.msg );
                    }
                },
                "param": id
            });
            layer.close(index);
        },function(index){
            layer.close(index);
        })
    }

    function _del(id){
        layer.confirm('确定删除用户？',{btn: ['删除','取消']},function(index){
            _ajax({
                url: "<?php echo U('delete');?>",
                data: {id: id},
                success: function(data){
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
            layer.close(index);
        })
    }

</script>

</body>
</html>