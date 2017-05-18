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
    <link href="/Public/static/css/plugins/datapicker/datetimepicker.min.css" rel="stylesheet">
    <link type="text/css" href="https://cdn.staticfile.org/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet" />
    <!--<link rel="stylesheet" href="/Public/static/js/plugins/timepicker-Addon/jquery-ui-timepicker-addon.css">-->
    <link rel="stylesheet" href="//cdn.bootcss.com/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">

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
            <div class="col-sm-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                    基本信息
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">活动名称：</label>
                        <div class="col-sm-8">
                            <input id="name" name="name" value="<?php echo ($data["name"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">金额：</label>
                        <div class="col-sm-3">
                            <input id="total" name="total" value="<?php echo ($data["total"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">开始时间：</label>
                        <div class="col-sm-3">
                            <input id="begintime" name="begintime" value="<?php echo ($data["begintime"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">结束时间：</label>
                        <div class="col-sm-3">
                            <input id="endtime" name="endtime" value="<?php echo ($data["endtime"]); ?>" class="form-control" type="text" aria-required="true" aria-invalid="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">最低消费金额</label>
                        <div class="col-sm-3">
                            <input id="min_total" name="min_total" value="<?php echo ((isset($data["min_total"]) && ($data["min_total"] !== ""))?($data["min_total"]):0); ?>" placeholder="" class="form-control" type="text" aria-required="true" aria-invalid="false" class="valid">
                            <span class="help-block m-b-none">0为不限制</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">数量</label>
                        <div class="col-sm-3">
                            <input id="num" name="num" value="<?php echo ($data["num"]); ?>" placeholder="" class="form-control" type="text" aria-required="true" aria-invalid="false" class="valid">
                            <span class="help-block m-b-none">0为不限制</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">每个用户可用数量</label>
                        <div class="col-sm-3">
                            <input id="available_num" name="available_num" value="<?php echo ((isset($data["available_num"]) && ($data["available_num"] !== ""))?($data["available_num"]):0); ?>" placeholder="" class="form-control" type="text" aria-required="true" aria-invalid="false" class="valid">
                            <span class="help-block m-b-none">0为不限制</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">状态：</label>
                        <div class="col-sm-8">
                            <input type="checkbox" value="1" class="form-control js-switch" id="status" name="status" <?php if($data['status'] == 1): ?>checked<?php elseif(!isset($data['status'])): ?>checked<?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    商品列表（不选择商品视为不限制）
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th data-field="id" data-checkbox="true"><input type="checkbox" id="select-all">全选</th>
                            <th data-field="name">名称</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                                <td><input class="goods-item" type="checkbox" name="goods_id[]" value="<?php echo ($v["id"]); ?>" <?php if(in_array($v['id'], $data['goods_id'])): ?>checked<?php endif; ?> /></td>
                                <td><?php echo ($v["name"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </form>
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
    <script type="text/javascript" src="https://cdn.staticfile.org/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
    <!--<script src="/Public/static/js/plugins/timepicker-Addon/jquery-ui-timepicker-addon.js"></script>-->
    <script src="/Public/static/js/plugins/timepicker-Addon/jquery.ui.datepicker-zh-CN.js.js"></script>
    <script src="/Public/static/js/plugins/timepicker-Addon/jquery-ui-timepicker-zh-CN.js"></script>
    <!--<script src="/Public/static/js/plugins/datapicker/locales/bootstrap-datetimepicker.zh-CN.js"></script>-->
    <script>
        // checkbox
        var elem = document.querySelectorAll('.js-switch');
        for (var i=0;i<elem.length;i++){
            new Switchery(elem[i],{ color: '#64bd63', secondaryColor: '#f00', jackColor: '#fff'});
        }
//        $('#begintime').datetimepicker({
//            inline:true
//        });
        var startDateTextBox = $('#begintime');
        var endDateTextBox = $('#endtime');

        $.timepicker.datetimeRange(
                startDateTextBox,
                endDateTextBox,
                {
                    dateFormat: 'yy-mm-dd',
                    minInterval: (1000*60*60), // 1hr
                }
        );

        $().ready(function () {
            var icon = "<i class='fa fa-times-circle'></i> ";
            $().ready(function () {
                var icon = "<i class='fa fa-times-circle'></i> ";
                var rules = {
                    name: "required",
                    total: {
                        required: true,
                        number: true
                    },
                    begintime: "required",
                    endtime: "required",
                };
                var message = {
                    name: icon + "请填写名称",
                    total: {
                        required: icon + "请填写优惠值",
                        number: icon + '请输入合法数值'
                    },
                    begintime: icon + "请填写开始时间",
                    endtime: icon + "请填写结束时间",
                };
                _validateForm('signupForm',rules, message);
            });

        });

        $('#select-all').click(function(){
            var list = $('input.goods-item');
            for (var i=0;i<list.length;i++){
                list[i].checked = this.checked
            }
        });

        $('input.goods-item').click(function () {
            if(!this.checked){
                $('#select-all').attr('checked', false);
            }
        });
    </script>

</body>
</html>