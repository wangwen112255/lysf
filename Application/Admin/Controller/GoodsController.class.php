<?php
/**
 * Created by mumu.
 * Date: 2016/12/6
 * Time: 18:31
 */
namespace Admin\Controller;

class GoodsController extends BaseController{
    protected $dao;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->dao = M('goods');
    }

    public function index(){
        $map = [];
        $count = $this->dao->where($map)->count();
        $page = new \Think\Page($count,10);
        $show = $page->show();
        $field = 'id,name,pic,price,desc,status,category_id';
        $list = $this->dao->where($map)->field($field)->order('id DESC')->limit($page->firstRow.','.$page->listRows)->select();
        foreach ($list as &$v){
            $v['category_name'] = M('goods_category')->where('id='.$v['category_id'])->getField('name');
        }
        $status = [0=>'禁用',1=>'启用'];

        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('status', $status);
        $this->display();
    }

    public function create(){
        $list = M('goods_category')->where('status=1')->select();
        $data = [];
        $pid = $_GET['pid'];
        if($_GET['id']){
            $data = $this->dao->find($_GET['id']);
            $pid = $data['category_id'];
        }
        $fileServer = '/api.php/File/upfile.html';
        $week = ['周一','周二','周三','周四','周五'];
        $this->assign('data', $data);
        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->assign('week', $week);
        $this->assign('fileServer', $fileServer);
        $this->display();
    }

    public function save(){
//        $this->ajaxReturn(toJson(json_encode($_POST)));
        if(!$_POST['is_takeout']){
            $_POST['is_takeout'] = 0;
        }
        if($this->dao->create()){

            if($_POST['id']){
                if($this->dao->save()){
                    $this->ajaxReturn(toJson(true));
                }
                $this->ajaxReturn(toJson('修改失败'));
            }
            if($this->dao->add()){
                $this->ajaxReturn(toJson(true));
            }
        }
        $this->ajaxReturn(toJson('添加失败'));
    }

    public function pics(){
        $id = $_GET['id'];
        $list = M('goods_pics')->where('good_id='.$id)->select();
        $fileServer = '/api.php/File/upfile.html';
        $this->assign('fileServer', $fileServer);
        $this->assign('good_id', $id);
        $this->assign('list', $list);
        $this->display();
    }

    public function setPics(){
        $pic = M('goods_pics');
        if($pic->create()){
            if($id = $pic->add()){
                $this->ajaxReturn(toJson(true,$id));
            }
        }
        $this->ajaxReturn('添加失败');
    }

    public function delPics(){
        $id = $_POST['id'];
        if(!$id){
            $this->ajaxReturn(toJson('ID错误！'));
        }
        $data = M('goods_pics')->find($id);
        if(!$data){
            $this->ajaxReturn(toJson('数据错误！'));
        }
        $pic = $data['pic'];
        @unlink(THINK_PATH.$pic);
        if(M('goods_pics')->delete($id)){
            $this->ajaxReturn(toJson(true));
        }
        $this->ajaxReturn(toJson('删除失败！'));
    }

}