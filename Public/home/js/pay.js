/**
 * Created by Administrator on 2016/12/5.
 */
var code = null;
var goodid = null;
var shop_id = null;
var orderTotal = 0;
var payTotal = 0;
window.onload = function(){
    $('#code').val('');
    $('#total').val('');
}
$('#code').keyup(function(){
    var num = $(this).val();
    _setWarn(goodCodes.indexOf(num), num);
    _getMoney($('#total').val());
});

$('#total').keyup(function(){
    orderTotal = $(this).val();
    _getMoney(orderTotal);
});

/**
 * 判断枪号
 * @param type
 * @param code
 * @private
 */
function _setWarn(type,num){
    code = null;
    $('#good-name').text('');
    if(type == -1 && num == ''){
        if(!$('#tool-money').hasClass('db-color')){
            $('#tool-money').toggleClass('db-color');
        }
        if($('#tool-code').hasClass('weui_cell_warn')){
            $('#tool-code').toggleClass('weui_cell_warn');
        }
        $('#total').attr('disabled', true);
        $('#total').val('');
        return;
    }
    if(type >= 0){
        code = num;
        if($('#tool-money').hasClass('db-color')){
            $('#tool-money').toggleClass('db-color');
        }
        if($('#tool-code').hasClass('weui_cell_warn')){
            $('#tool-code').toggleClass('weui_cell_warn');
        }
        $('#total').attr('disabled', false);
        var good = goods[code];
        $('#good-name').text(good.name);
    } else {
        if(!$('#tool-money').hasClass('db-color')){
            $('#tool-money').toggleClass('db-color');
        }
        $('#total').attr('disabled', true);
        if(!$('#tool-code').hasClass('weui_cell_warn')){
            $('#tool-code').toggleClass('weui_cell_warn');
        }
    }
}

/**
 * 获取优惠，支付金额
 * @param money
 * @private
 */
function _getMoney(money){
    $('#discount').text('');
    $('#activity').text('');
    $('#discount-data').hide();
    $('#pay-total').text('');
    $('#clear-input').hide();
    if(!code){
        return;
    }
    var money = parseFloat(money);//订单金额
    var disTotal = 0;//优惠金额
    var good = goods[code];
    var ac = good.activity;
    if(!good.activity){
        if(!money) return;
        payTotal = money.toFixed(2);
        $('#pay-total').text(payTotal+'元');
        return;
    }

    $('#discount').text(disTotal);
    $('#activity').text(ac.name);
    $('#discount-data').show();

    if(!money){
        return;
    }
    $('#clear-input').show();
    goodid = good.id;
    shop_id = good.shop_id;

    var min_total = parseFloat(ac.min_total);
    var total = parseFloat(ac.total);
    if(ac.type == 1){
        //折扣
        disTotal = money * (total / 100);
    } else if (ac.type == 2){
        //满减
        if(money >= min_total){
            disTotal = total;
        }
    } else if (ac.type == 3){
        //立减
        disTotal = total;
    }
    payTotal = money - disTotal;
    if(payTotal < 0){
        payTotal = 0;
    }
    payTotal = payTotal.toFixed(2);
    $('#pay-total').text(payTotal+'元');
    $('#discount').text(disTotal);
}

function _toPay(url){
    if(!code){
        $.toptip('请输入枪号!', 2000, 'warning');
        return;
    }
    var tot = $('#total').val();
    if( tot== '' || tot == 0){
        $.toptip('请输入消费金额!', 2000, 'warning');
        return;
    }
    window.location.href = url+'?goodid='+goodid+'&shop_id='+shop_id+'&total='+orderTotal+'&pay='+payTotal;
}

$('#clear-input').click(function () {
    $('#total').val('');
    _getMoney(0);
    $(this).hide();
})
