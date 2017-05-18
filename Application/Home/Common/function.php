<?php
/**
 * Created by mumu.
 * Date: 2016/12/6
 * Time: 17:26
 */
function replaceStr($str,$handle,$star=0,$end=-1){
    $str = substr($str,$star,$end);
    return $str.$handle;
}

/**
 * 加密字符串
 * @param $pass 字符串
 * @param $prefix 前缀
 * @return string 加密后字符串
 */
function encryPtion($pass, $prefix=''){
    return md5($prefix.$pass);
}

/**
 * 获取随机字符串
 * @param int $length 字符串长度
 * @return string
 */
function getRandStr($length = 5){
    $str = '0123456789abcdefghighlmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $len = strlen($str)-1;
    $code = '';
    for ($i=0; $i < $length; $i++) {
        $k = mt_rand(0,$len);
        $code .= substr($str, $k,1);
    }
    return $code;
}

/**
 * 设置用户信息
 * @param $data
 */
function setUser($data){
    session(MODULE_NAME.'_user', $data);
}

/**
 * 获取用户信息
 * @param string $type
 * @return int|mixed
 */
function getUser(){
    $user = session(MODULE_NAME.'_user');
    if(!$user){
        redirect('/index.php/Login/index');
    }
    return $user;
}

/**
 * 打印订单
 * @param $id
 * @return bool|string
 */
function printBill($id){
    if(!$id){
        return 'ID错误';
    }
    $data = M('order')->where('status != 0')->find($id);
    if(!$data){
        return '订单不存在';
    }
    if($data['is_takeout'] == 0){
        $address = M('order_address')->where('order_id='.$id)->find();
    }
    $goods = M('order_goods')->where('order_id='.$id)->select();
    $printNum = 3;
    if(count($goods) > 1){
        $printNum = 4;
    }
    $msg = "<MN>".$printNum."</MN>";
    $msg .= "<center><FH2><FW>鲁豫食府</FW></FH2></center>\r\n";
    $msg .= "********************************\r\n";
    $msg .= "订单编号：".$data['trade_no']."\r\n";
    $msg .= "下单时间：".$data['pay_time']."\r\n";
    $msg .= "********************************\r\n";
    $msg .= "<table><tr><td>菜品名称</td><td>数量</td><td>金额</td></tr>";
    foreach($goods as $v){
        $msg .= "<tr><td>".$v['good_name']."</td><td>".$v['good_num']."</td><td>".$v['good_price']."</td></tr>";
    }

    $msg .= "</tr></table>";
    $msg .= "********************************\r\n";
    if($data['discount_total'] > 0){
        $msg .= "优惠：-".$data['discount_total']."\r\n";
        $msg .= "********************************\r\n";
    }
    $msg .= "总计：".$data['pay_total']."\r\n";
    $msg .= "********************************\r\n";
    if($data['is_ziti'] == 1){
        $msg .= "自提\r\n";
    } else {
        $msg .= "姓名：".$address['username']."\r\n";
        $msg .= "手机号：".$address['mobile']."\r\n";
        $msg .= "地址：".$address['address']."\r\n";
    }
    $msg .= "********************************\r\n";
    $msg .= "<FB>客服电话:17320105511</FB>";
    Vendor('Print.Yprint');
    $print = new \Yprint();
    $apiKey = "71e75ffb55bd5500a7ab21544aaac5bb8a82c000";
    $msign = '22i4phqk4zj7';
    $res = $print->action_print(4548,'4004508598',$msg,$apiKey,$msign);
    $res = json_decode($res,true);
    if($res['state'] == 1){
        return true;
    }
    return '打印失败！';
}