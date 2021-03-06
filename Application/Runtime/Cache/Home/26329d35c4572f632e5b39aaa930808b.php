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
                <button onclick="_layOpenUrl('<?php echo U('create',array('shop_id'=>$shop_id));?>','添加')" type="button" class="btn btn-outline btn-default" >
                    <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                </button>
                <button type="button" class="btn btn-outline btn-default">
                    <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="columns columns-right btn-group pull-right">
            <button onclick="_search();"  class="btn btn-default btn-outline" type="button" title="搜索"><i class="glyphicon glyphicon-search"></i></button>
            <button onclick="javascript:window.location.reload();" class="btn btn-default btn-outline" type="button" name="refresh" title="刷新"><i class="glyphicon glyphicon-repeat"></i></button>
        </div>
        <div class="pull-right search">
            <input name="name" value="<?php echo ($_GET['name']); ?>" class="form-control input-outline" type="text" placeholder="名称">
        </div>
        <div class="pull-right search">
            <select name="status" class="form-control input-outline">
                <option value="">全部状态</option>
                <option value="1" <?php if(($_GET['status'] == 1) AND (isset($_GET['status'])) ): ?>selected<?php endif; ?> >启用</option>
                <option value="0" <?php if(($_GET['status'] == 0) AND ($_GET['status'] != '') ): ?>selected<?php endif; ?>>禁用</option>
            </select>
        </div>
    </div>
    <table data-toggle="table" data-click-to-select="true" data-mobile-responsive="true">
        <thead>
        <tr>
            <th data-field="id" data-checkbox="true"></th>
            <th data-field="name">名称</th>
            <th data-field="pic">展示</th>
            <th data-field="category_id">类别</th>
            <th data-field="price">价格</th>
            <th data-field="week">时间</th>
            <th data-field="status" data-align="center">状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($v["id"]); ?>">
            <td><input type="checkbox" name="id" value="<?php echo ($v["id"]); ?>" /></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><img src="<?php echo (getPicThumb($v["pic"],'s_')); ?>" title="图片" style="max-height: 46px;"/></td>
            <td><?php echo ($v["category_id"]); ?></td>
            <td><?php echo ($v["price"]); ?></td>
            <td><?php echo ($week[$v['week']]); ?></td>
            <td data-align="center">
                <button id="status<?php echo ($v["id"]); ?>" onclick="_setStatus(<?php echo ($v["id"]); ?>);" class="btn <?php if(($v['status']) == "1"): ?>btn-info<?php else: ?>btn-default<?php endif; ?>" type="button"><?php echo ($status[$v['status']]); ?></button>
            </td>
            <td>
                <button onclick="_layOpenUrl('<?php echo U('Goods/create',array('id'=>$v['id']));?>', '修改')" class="btn btn-info " type="button"><i class="fa fa-paste"></i> 编辑</button>
                <button onclick="_layOpenUrl('<?php echo U('Goods/pics',array('id'=>$v['id']));?>', '图库')" class="btn btn-info " type="button"><i class="fa fa-paste"></i> 图库</button>
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
        layer.confirm('确定修改？',{btn: ['修改','取消']},function(index){
            _ajax({
                "url": "<?php echo U('Goods/setStatus');?>",
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
        layer.confirm('确定删除？',{btn: ['删除','取消']},function(index){
            _ajax({
                url: "<?php echo U('Goods/delete');?>",
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

    function _search(){
        var href = '<?php echo U("Takeout/index", "","");?>';
        var src = _searchData(href);
        if(src){
            window.location.href = src;
        }
    }
</script>

</body>
</html>