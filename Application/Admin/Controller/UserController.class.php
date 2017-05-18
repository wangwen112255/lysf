<?php
/**
 * Created by mumu.
 * Date: 2016/12/6
 * Time: 16:54
 */
namespace Admin\Controller;
class UserController extends BaseController{
    protected $dao;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->dao = M('user');
    }

    public function index(){
        $map = [];
        $count = $this->dao->where($map)->count();
        $page = new \Think\Page($count,10);
        $show = $page->show();
        $field = 'id,nickname,avatar,mobile,sex,integral,remark,subscribe,addtime,subscribe_time,status,reg_type,reg_ip';
        $list = $this->dao->where($map)->field($field)->order('id DESC')->limit($page->firstRow.','.$page->listRows)->select();

        $status = [0=>'禁用',1=>'启用'];
        $subscribe = [0=>'未关注',1=>'已关注'];
        $reg_type = ['wx'=>'微信网页','subscribe'=>'关注公众号'];
        $sex = [0=>'未知',1=>'男',2=>'女'];

        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('status', $status);
        $this->assign('subscribe', $subscribe);
        $this->assign('reg_type', $reg_type);
        $this->assign('sex', $sex);
        $this->display();

    }
}