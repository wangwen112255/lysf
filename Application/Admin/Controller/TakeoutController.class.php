<?php
/**
 * Created by mumu.
 * Date: 2016/12/13
 * Time: 16:35
 */
namespace Admin\Controller;
class TakeoutController extends BaseController
{
    protected $dao;
    public function index(){
        $this->dao = M('goods');
        $map = [];
        if($_GET){
            foreach ($_GET as $k=>$v){
                if (isset($v) && $v != '' && $k != 'p'){
                    if($k == 'name'){
                        $map[$k] = array('like', '%'.$v.'%');
                        continue;
                    }
                    $map[$k] = $v;
                }
            }
        }
        $map['is_takeout'] = 1;
        $count = $this->dao->where($map)->count();
        $page = new \Think\Page($count,10);
        $show = $page->show();
        $field = 'id,name,pic,price,desc,status,category_id';
        $list = $this->dao->where($map)->field($field)->order('id ASC')->limit($page->firstRow.','.$page->listRows)->select();
        foreach ($list as &$v){
            $v['category_name'] = M('goods_category')->where('id='.$v['category_id'])->getField('name');
            $v['week'] = M('takeout_ext')->where('good_id='.$v['id'])->getField('week');
        }
        $status = [0=>'禁用',1=>'启用'];
        $week = [1=>'周一',2=>'周二',3=>'周三',4=>'周四',5=>'周五'];
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('status', $status);
        $this->assign('week', $week);
        $this->display();
    }

    public function setOption(){
        $data = M('takeout_conf')->find(1);
        $this->assign('data', $data);
        $this->display();
    }

    public function save(){
        $this->dao = M('takeout_conf');

        if($this->dao->create()){
            if($_POST['id']){
                if($this->dao->save() !== false){
                    $this->ajaxReturn(toJson(true));
                }
            }
            if($this->dao->add()){
                $this->ajaxReturn(toJson(true));
            }
        }
        $this->ajaxReturn(toJson('操作失败'));
    }
}