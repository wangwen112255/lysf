<?php
/**
 * Created by mumu.
 * Date: 2016/12/8
 * Time: 11:08
 */
namespace Wx\Controller;
class TakeoutController extends BaseController
{
    protected $user;
    public function _initialize($type = false)
    {
        parent::_initialize($type);
        $this->user = getWxUser();
        $this->error('外卖维护中','/wx.php/Dish/index',5);
    }

    public function index(){
        setWxOrder(null);
        $option = M('takeout_conf')->find(1);
        $time = time();
        if($option['begintime']){
            $begintime = strtotime($option['begintime']);
            if($time < $begintime){
                $this->error('订餐还没开始，'.$option['begintime'].'后再来吧','/wx.php/Dish/index',5);
            }
        }
        if($option['endtime']){
            $begintime = strtotime($option['endtime']);
            if($time > $begintime){
                $uid = getUserId();
//                if($uid != 6){
//                    $this->error('订餐已经结束了，明天'.$option['endtime'].'前来哦','/wx.php/Dish/index',5);
//
//                }
                $this->error('订餐已经结束了，明天'.$option['endtime'].'前来哦','/wx.php/Dish/index',5);
            }
        }
        $week = date('w');
        $good_id = M('takeout_ext')->where('week='.$week)->getField('good_id');
        if(!$good_id){
            $this->error('今天没有外卖哦亲！');
        }
        $map = [];
        $map['status'] = 1;
        $map['is_takeout'] = 1;
        $map['id'] = $good_id;
        $data = M('goods')->where($map)->field('id,desc,name,price,pic')->order('id DESC')->find();
        if(!$data){
            $this->error('今天没有外卖');
        }
        unset($map['id']);
        $map['category_id'] = array('neq', 5);
        $list = M('goods')->where($map)->field('id,desc,name,price,pic')->order('price ASC')->select();
        $this->assign('data', $data);
        $this->assign('list', $list);
        $this->display();
    }

    public function confirm(){
        $order = getWxOrder();
        if(!$order){
            $this->error('购物车是空的，先添加个商品吧！');
        }
        $total = 0;

        $goodsList = $order['goods'];
        if(!$goodsList){
            $this->error('先添加个商品再结算吧！');
        }
        $good = M('goods');
        $goodMap = [];
        $goodMap['status'] = 1;
        $check = true;
        $detail = '';
        foreach ($goodsList as &$v){
            $goodMap['id'] = $v['id'];
            if(!$v['id']){
                $check=false;
                break;
            }
            $goodItem = $good->where($goodMap)->field('price,name,pic')->find();
            if(!$goodItem) {
                $check=false;
                break;
            }
            $total += $v['num']*$goodItem['price'];
            $v['price'] = $goodItem['price'];
            $v['name'] = $goodItem['name'];
            $v['pic'] = $goodItem['pic'];
            $detail .= ' '.$goodItem['name'];
        }
        if($check == false){
            $this->error('你要的外卖没有了');
        }

        $order['goods'] = $goodsList;
        $order['pay_total'] = $total;
        $order['total'] = $total;
        $order['meno'] = $order['tang'];
        $order['detail'] = $detail;
        $order['body'] = '鲁豫食府-外卖';

        $adderssMap['openid'] = $this->user['openid'];
        $addressList = M('user_address')->where($adderssMap)->field('id,username,mobile,province,city,address,is_default')->select();

        $adderssMap['is_default'] = 1;
        $address = M('user_address')->where($adderssMap)->field('id,username,mobile,province,city,address')->find();
        if($address){
            $order['address'] = $address;
        }
        setWxOrder($order);
        $couponList = getCoupon();
        $this->assign('address', $address);
        $this->assign('addresslist', $addressList);
        $this->assign('goods', $goodsList);
        $this->assign('order', $order);
        $this->assign('couponlist', $couponList);
        $this->display();
    }
}