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
            <button onclick="_search();" class="btn btn-default btn-outline" type="button" title="搜索"><i class="glyphicon glyphicon-search"></i></button>
            <button onclick="javascript:window.location.reload();" class="btn btn-default btn-outline" type="button" name="refresh" title="刷新"><i class="glyphicon glyphicon-repeat"></i></button>
        </div>
        <div class="pull-right search">
            <input name="trade_no" value="<?php echo ($_GET['trade_no']); ?>" class="form-control input-outline" type="text" placeholder="订单号">
        </div>
        <div class="pull-right search">
            <select name="status" class="form-control input-outline">
                <option value="">全部状态</option>
                <option value="1" <?php if(($_GET['status'] == 1) AND (isset($_GET['status'])) ): ?>selected<?php endif; ?> >已支付</option>
                <option value="0" <?php if(($_GET['status'] == 0) AND ($_GET['status'] != '') ): ?>selected<?php endif; ?>>未支付</option>
                <option value="2" <?php if(($_GET['status'] == 2) AND (isset($_GET['status'])) ): ?>selected<?php endif; ?>>配送中</option>
                <option value="9" <?php if(($_GET['status'] == 9) AND (isset($_GET['status'])) ): ?>selected<?php endif; ?>>已完成</option>
            </select>
        </div>
    </div>
    <table data-toggle="table" data-click-to-select="true" data-mobile-responsive="true">
        <thead>
        <tr>
            <th data-field="id" data-checkbox="true"></th>
            <th data-field="trade_no">订单号</th>
            <th data-field="total">金额</th>
            <th data-field="pay_total">支付金额</th>
            <th data-field="discount_total">优惠金额</th>
            <th data-field="meno">备注</th>
            <th data-field="pay_time">支付时间</th>
            <th data-field="poay_status">支付状态</th>
            <th data-field="is_ziti">自提</th>
            <th data-field="status" data-align="center">订单状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="item<?php echo ($v["id"]); ?>">
            <td><input type="checkbox" name="id" value="<?php echo ($v["id"]); ?>" /></td>
            <td><?php echo ($v["trade_no"]); ?></td>
            <td><?php echo ($v["total"]); ?></td>
            <td><?php echo ($v["pay_total"]); ?></td>
            <td><?php echo ($v["discount_total"]); ?></td>
            <td><?php echo ($v["meno"]); ?></td>
            <td><?php echo ($v["pay_time"]); ?></td>
            <td><?php echo ($payStatus[$v['pay_status']]); ?></td>
            <td><?php echo ($takeout[$v['is_ziti']]); ?></td>
            <td data-align="center">
                <span class="badge <?php if($v['status'] == 1): ?>badge-primary<?php elseif($v['status'] == 2): ?>badge-info<?php elseif($v['status'] == 9): ?>badge-success<?php else: endif; ?> "><?php echo ($status[$v['status']]); ?></span>
            </td>
            <td>
                <button onclick="_layOpenUrl('<?php echo U('goods',array('id'=>$v['id']));?>', '订单商品')" class="btn btn-info "
                        type="button"><i class="fa fa-paste"></i> 商品
                </button>
                <?php if(($v['pay_status']) == "1"): ?><button onclick="_printBill(<?php echo ($v['id']); ?>);" class="btn btn-primary" type="button"><i
                        class="fa fa-print"></i> 打印
                </button><?php endif; ?>
                <?php if(($v['status']) == "1"): ?><button onclick="_setStatus(<?php echo ($v["id"]); ?>);" class="btn btn-danger" type="button"><i
                            class="fa fa-bicycle"></i> 配送
                    </button><?php endif; ?>
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
        layer.confirm('确定删除？',{btn: ['删除','取消']},function(index){
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

    function _search(){
        var href = '<?php echo U("Order/index", "","");?>';
        var src = _searchData(href);
        if(src){
            window.location.href = src;
        }
    }

    function _printBill(id){
        _ajax({
            url: '<?php echo U("Printbill/index");?>',
            success: _printSuccess,
            data: {id: id}
        });
    }
    function _printSuccess(data){
        if(data.code == 200){
            layer.msg('打印成功',{icon:1});
        } else {
            layer.alert(data.msg,{icon:5});
        }
    }
</script>

</body>
</html>