<?php
/**
 * Created by mumu.
 * Date: 2016/12/6
 * Time: 13:30
 */
/**
 * 微信注册用户
 * @param $data
 * @param string $type
 * @return bool
 */
function addWxUser($data, $type='wx'){
    if(!$data){
        return;
    }
    $dao = M('user');
    $res = $dao->where('openid="'.$data->openid.'"')->field('openid,nickname,mobile,avatar,integral')->find();

    $user = [];
    foreach ($data as $k=>$v){
        if($k == 'id'){
            continue;
        }
        if($k == 'headimgurl'){
            $user['avatar'] = $v;
            continue;
        }
        if($k == 'subscribe_time'){
            $user[$k] = date('Y-m-d H:i:s', $v);
            continue;
        }
        $user[$k] = $v;
    }

    if($res){
        upWxUser($user,$user['openid']);
        return true;
    }

    $user['reg_type'] = $type;
    $user['addtime'] = date('Y-m-d H:i:s', time());
    $user['reg_ip'] = get_client_ip();

    if($dao->create($user)){
        if($user_id = $dao->add()){
            setWxUser($user);
            sendCoupon(1,$user_id,10);
            return true;
        }
    }
}

/**
 * 设置微信OPENID session
 * @param $openid
 */
function setWxUser($user){
    session('wx_user', $user);
}

/**
 * 获取微信在线session OPENID
 * @return mixed
 */
function getWxUser(){
    return session('wx_user');
}

/**
 * 更新用户数据
 * @param $data array|string
 * @param null $openid
 * @param null $field
 * @return bool
 */
function upWxUser($data,$openid=null, $field=null){
    if(!isset($data)){
        return false;
    }
    $dao = M('user');
    $upData = array();
    if(is_array($data)){
        $upData = $data;
    } else {
        $upData[$field] = $data;
    }

    if(empty($openid)){
        $user = getWxUser();
        $openid = $user['openid'];
    }
    $upData['id'] = $dao->where('openid="'.$openid.'"')->getField('id');

    if(!$upData['id']){
        return false;
    }

    if($dao->create($upData)){
        $res = $dao->save();
        setWxUser(getUserById($upData['id']));
        return $res !== false ? true : false;
    }
}

/**
 * 根据用户ID获取用户信息
 * @param $id
 * @return mixed
 */
function getUserById($id){
    $dao = M('user');
    return $dao->field('openid,nickname,mobile,avatar,integral')->find($id);
}

/**
 * 获取用户ID
 * @return mixed
 */
function getUserId(){
    $user_id = session('wx_userid');
    if(!$user_id){
        $dao = M('user');
        $user = getWxUser();
        $user_id = $dao->where('openid="'.$user['openid'].'"')->getField('id');
        session('wx_userid', $user_id);
    }
    return $user_id;
}

/**
 * 根据用户OPENDID获取用户信息
 * @param $openid
 * @return mixed
 */
function getUserByOpenid($openid){
    $dao = M('user');
    return $dao->where('openid="'.$openid.'"')->field('openid,nickname,mobile,avatar,integral')->find();
}

/**
 * 获取微信授权
 * @param $app
 * @return mixed
 */
function getOauth($app){
    $user = getWxUser();
    if($user){
        return $user;
    }
    $oauth = $app->oauth;
    if(!$user && !$_GET['code']){
        $oauth->redirect()->send();
    }
    $openid = $oauth->user()->id;
    $user = getUserByOpenid($openid);
    file_put_contents('t.txt',json_encode($user));
    if(!$user){
        $user = $app->user->get($openid);
        file_put_contents('t1.txt',json_encode($user));
        addWxUser($user);
        return getWxUser();
    } else {
        setWxUser($user);
        return $user;
    }
}

/**
 * 设置订单信息
 * @param $order
 */
function setWxOrder($order){
    $user = getWxUser();
    $openid = $user['openid'];
    session('order_'.$openid, $order);
}

/**
 * 获取订单信息
 * @return mixed
 */
function getWxOrder(){
    $user = getWxUser();
    $openid = $user['openid'];
    return session('order_'.$openid);
}

/**
 * 提交订单,写入数据库
 * @return array
 */
function submitWxOrder(){
    $order = getWxOrder();
    $user_id = getUserId();
    $trade_no = getOrderSn($user_id);
    if($order['coupon_id']){
        $coupon = checkCoupon($order['coupon_id']);
        if($coupon){
            if($order['coupon_total']){
                $order['pay_total'] += $order['coupon_total'];
            }
            $order['pay_total'] -= $coupon['total'];
            $order['discount_total'] = $coupon['total'];
            $order['coupon_total'] = $coupon['total'];
            if($order['pay_total'] <= 0){
                $order['pay_total'] = 0;
            }
        }
    } else {
        $order['pay_total'] += $order['coupon_total'];
        $order['coupon_total'] = 0;
    }
    $order['user_id'] = $user_id;
    $order['trade_no'] = $trade_no;
    $order['addtime'] = date('Y-m-d H:i:s', time());
    $o = M('order');
    if($order['id']){
        if($o->create($order)){
            if($o->save() !== false){
                setWxOrder($order);
                setOrderAddress($order['address_id'],$order['id']);
                return $order;
            }
        }
    }
    if($o->create($order)){
        if($order_id = $o->add()){
            $order['id'] = $order_id;
            setWxOrder($order);
            $setOrder = setOrderGoods($order['goods'],$order_id);
            if(!$setOrder){
                $o->delete($order_id);
                return false;
            }
            setOrderAddress($order['address_id'],$order_id);
            return $order;
        }
    }
}

/**
 * 生成订单编号(年两位+月两位+user_id+小时两位+分钟两位+秒两位)
 * @return string
 */
function getOrderSn($user_id){
    return date('y').date('m').$user_id.date('H').date('i').date('s');
}

/**
 * 设置订单收货地址
 * @param $id
 * @param $order_id
 * @return bool
 */
function setOrderAddress($id,$order_id){
    if(!$id || !$order_id){
        return false;
    }
    $address = M('user_address')->find($id);
    if(!$address){
        return false;
    }
    setAddressDefault($id);
    $data = [];
    $data['order_id'] = $order_id;
    $data['username'] = $address['username'];
    $data['mobile'] = $address['mobile'];
    $data['address'] = $address['city'].' '.$address['county'].' '.$address['address'];
    $count = M('order_address')->where('order_id='.$order_id)->count();
    if($count>0){
        $res = M('order_address')->where('id='.$id)->save($data);
    } else {
        M('order_address')->add($data);
    }
    if($res !== false){
        return true;
    }
    return false;
}

/**
 * 设置订单商品
 * @param $goods
 * @param $order_id
 */
function setOrderGoods($goods,$order_id){
    $good = M('order_goods');
    $ids = [];
    $check = true;
    foreach ($goods as $v){
        $data = [];
        $data['order_id'] = $order_id;
        $data['good_id'] = $v['id'];
        $data['good_num'] = $v['num'];
        $data['good_price'] = $v['price'];
        $data['good_name'] = $v['name'];
        $data['good_pic'] = $v['pic'];
        $id = $good->add($data);
        if(!$id){
            $check = false;
            break;
        }
        $ids[] = $id;
    }
    //模拟回滚
    if($ids && $check===false){
        foreach ($ids as $v){
            $good->delete($v);
        }
        return false;
    }
    return true;
}

/**
 * 设置默认收货地址
 * @param $user_id
 * @param $id
 */
function setAddressDefault($id){
    $user = getWxUser();
    $default_id = M('user_address')->where('openid="'.$user['openid'].'" AND is_default=1')->getField('id');
    if($default_id && $default_id != $id){
        M('user_address')->where('id='.$default_id)->setField('is_default',0);
    }
    M('user_address')->where('id='.$id)->setField('is_default',1);
}

/**
 * 发放代金券
 * @param $user_id
 * @param $coupon_id
 * @param $num
 * @return string
 */
function sendCoupon($coupon_id, $user_id, $num){
    $coupon = M('coupon');
    $couponData = $coupon->find($coupon_id);
    if(!$couponData){
        return '代金券不存在';
    }
    if($num > $couponData['num'] && $couponData['num']!=0){
        return '代金券数量已经被抢完了';
//        return '代金券数量只有'.$couponData['num'].'个了';
    }
    if($num > $couponData['available_num'] && $couponData['available_num']!=0){
        return '每个用户最多可以发放'.$couponData['available_num'].'个';
    }

    $uCoupon = M('user_coupon');
    $data = [];

    $countCoupon = $uCoupon->where('coupon_id='.$coupon_id.' AND user_id='.$user_id)->find();
    if($countCoupon){
        return '已经领取过该代金券了';
        $data['num'] = $countCoupon['num'] + $num;
        $data['status'] = 1;
        $res = $uCoupon->where('id='.$countCoupon['id'])->setField($data);
        if($res != false){
            return true;
        }
        return '发放失败';
    }
    $data['coupon_id'] = $coupon_id;
    $data['user_id'] = $user_id;
    $data['name'] = $couponData['name'];
    $data['total'] = $couponData['total'];
    $data['begintime'] = $couponData['begintime'];
    $data['endtime'] = $couponData['endtime'];
    $data['num'] = $num;
    $data['available_num'] = $couponData['available_num'];
    $data['status'] = 1;
    if($uCoupon->create($data)){
        if($uCoupon->add()){
            return true;
        }
    }
    return '发放失败';
}

/**
 * 使用代金券
 * @param $id
 * @param $num
 */
function useCoupon($id,$num){
    M('user_coupon')->where('id='.$id)->setDec('num',$num);
    M('coupon')->where('id='.$id)->setInc('user_num',$num);
}

/**
 * 获取用户订单
 * @return mixed
 */
function getOrderList(){
    $user_id = getUserId();
    $map = [];
    $map['user_id'] = $user_id;
    $map['status'] = ['neq', 4];//删除
    $count = M('order')->where($map)->count();
    $page = new \Think\Page($count,6);
    $field = 'id,trade_no,total,pay_total,discount_total,coupon_total,addtime,pay_time,pay_status,status,review_status,meno';
    $list = M('order')->where($map)->field($field)->order('id DESC')->limit($page->firstRow.','.$page->listRows)->order('id DESC')->select();
    return $list;
}

/**
 * 根据订单号查询订单
 * @param $trade_no
 * @return mixed
 */
function getOrderByTradeNo($trade_no){
    $order = M('order')->where('trade_no="'.$trade_no.'"')->find();
    return $order;
}

/**
 * 获取可用优惠券
 * @return array|void
 */
function getCoupon(){
    $order = getWxOrder();
    $user_id = getUserId();
    $couponList = M('user_coupon')->where('user_id='.$user_id.' AND status=1 AND num>0')->order('id DESC')->select();
    if(!$couponList){
        return;
    }
    $coupon = [];
    foreach ($couponList as $v){
        if($v['begintime']){
            //开始时间
            if(time() < strtotime($v['begintime'])){
                continue;
            }
        }
        if($v['endtime']){
            //结束时间
            if(time() > strtotime($v['endtime'])){
                continue;
            }
        }
        if($v['min_total']){
            //最小支付金额
            if($order['pay_total'] < $v['min_total']){
                continue;
            }
        }
        $coupon[] = $v;
    }
    if(empty($coupon)){
        return;
    }
    usort($coupon, function($a,$b){
        $al = $a['total'];
        $bl = $b['total'];
        if($al == $bl) return 0;
        return $al >$bl ? -1 : 1;
    });/*按从大到小排序*/
    return $coupon;
}

/**
 * 校验优惠券
 * @param $id
 * @return mixed|void
 */
function checkCoupon($id){
    $order = getWxOrder();
    $coupon = M('user_coupon')->find($id);
    if(!$coupon){
        return;
    }
    if($coupon['status'] == 0){
        return;
    }
    if($coupon['num'] <= 0){
        return;
    }
    if($coupon['begintime']){
        //开始时间
        if(time() < strtotime($coupon['begintime'])){
            return;
        }
    }
    if($coupon['endtime']){
        //结束时间
        if(time() > strtotime($coupon['endtime'])){
            return;
        }
    }
    if($coupon['min_total']){
        //最小支付金额
        if($order['pay_total'] < $coupon['min_total']){
            return;
        }
    }
    return $coupon;
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