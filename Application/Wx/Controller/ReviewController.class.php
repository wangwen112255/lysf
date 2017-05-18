<?php
/**
 * Created by mumu.
 * Date: 2016/12/20
 * Time: 16:39
 */
namespace Wx\Controller;
class ReviewController extends BaseController
{
    public function index(){
    }

    public function review(){
        $id = I('id');
        if(!$id){
            $this->error('ID错误');
        }
        $this->assign('order_id', $id);
        $this->display();
    }

    public function add(){
        if(!$_POST['score'] || !$_POST['desc'] || !$_POST['order_id']){
            $this->ajaxReturn(toJson('您还没有评价呢亲'));
        }
        $_POST['user_id'] = getUserId();
        $_POST['addtime'] = date('Y-m-d H:i:s',time());
        $r = M('review');
        if($r->create()){
            if($r->add()){
                M('order')->where('id='.$_POST['order_id'])->setField('review_status',1);
                sendCoupon(1,$_POST['user_id'],1);
                $this->ajaxReturn(toJson(true));
            }
        }
        $this->ajaxReturn(toJson('评价失败'));
    }
}