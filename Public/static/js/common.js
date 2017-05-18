/**
 * Created by mumu on 2016/11/7.
 */

/**
 * 弹出层iframe层
 * @param url 地址
 * @param title 标题
 * @private
 */
var autoReload = true;
function _layOpenUrl(url,title){
    var title = title||'操作';
    layer.open({
        type: 2,
        anim: 2,
        title: title,
        area: ['100%', '100%'],
        maxmin: false,
        content: url,
        end: function () {
            _layOpenSuccess();
        }
    });
}

/*
* layero 当前层DOM
* index 当前层索引
* */
function _layOpenSuccess(layero, index){
    // layer.close(index);
}
//layer关闭iframe层
function _layCloseIframe(){
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
}

/**
 *
 * @param obj
 * @private
 */
function _ajax(obj){
    var type = obj.type||'post';
    var success = obj.success||_ajaxSuccess;
    var error = obj.error||_ajaxError;
    var param = obj.param;
    $.ajax({
        url: obj.url,
        type: type,
        data: obj.data,
        dataType: 'json',
        success: function(data){
            success(data,param);
        },
        error: error
    })
}

// ajaxCallback
function _ajaxSuccess(data){
    if(data.code == 200){
        layer.msg(data.msg,{icon:1});
        setTimeout(function(){
            if(autoReload === true){
                parent.window.location.reload();
            }
            _layCloseIframe();
        },1500);
    } else {
        layer.alert(data.msg,{icon:5});
    }
}
//ajaxError
function _ajaxError(x){
    console.log(x)
    layer.alert('服务器错误！',{icon:2});
}

function _validateForm(id, rules, messages, callBack){
    var callBack = callBack||_validateFormCallBack;
    var id = id||'signupForm';

    $("#"+id).validate({
        rules: rules,
        messages: messages,
        submitHandler: callBack
    });
}

function _validateFormCallBack(form){
    var url = $(form).attr('action');
    var data = $(form).serialize();
    _ajax({"url": url,"data": data});
    return false;
}

function _searchData(href){
    var itemList = $('.search .form-control');
    if(!itemList || itemList=='undefined' || itemList.length ==0){
        return;
    }
    var search = '';
    if(href.indexOf('.html') != -1){
       href = href.split('.html')[0];
    }
    for (var i=0;i<itemList.length;i++){
        var k = itemList[i].name;
        var v = itemList[i].value;
        if(k == '' || v == ''){
            continue;
        }
        search += '/'+k+'/'+v;
    }

    if(search == ''){
        return href;
    }
    return href+search+'.html';
}
