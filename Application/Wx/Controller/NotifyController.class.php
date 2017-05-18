<?php
/**
 * Created by mumu.
 * Date: 2016/12/1
 * Time: 15:09
 */
namespace Wx\Controller;
class NotifyController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize(true);
    }

    public function wx(){
        $payment = $this->wechat->payment;
        $response = $payment->handleNotify(function($notify, $successful){
            $order = getOrderByTradeNo($notify->out_trade_no);
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            if($order['pay_status'] == 1){
                return true;
            }
            if ($successful) {
                $data = array();
                // 不是已经支付状态则修改为已经支付状态
                $data['pay_status'] = 1; // 支付状态
                $data['status'] = 1;//订单状态
                $data['pay_time'] = date('Y-m-d H:i:s', strtotime($notify->time_end));// 更新支付时间
                if($notify->sub_openid){
                    $data['sub_openid'] = $notify->sub_openid;//用户在子商户appid下的唯一标识
                }
                $data['wx_total'] = $notify->total_fee/100;

                $map = array();
                $map['id'] = $order['id'];
                $res = M('order')->where($map)->save($data);//更新数据库
                if(false !== $res){
                    if($order['coupon_id']){
                        useCoupon($order['coupon_id'],1);
                    }
                    printBill($order['id']);
                    return true;
                }
            } else { // 用户支付失败
                return 'Pay fail.';
            }
            return false; // 或者错误消息
        });
        $response->send(); // Laravel 里请使用：return $response;
    }


}