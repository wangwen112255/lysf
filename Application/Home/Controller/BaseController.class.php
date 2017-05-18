<?php
namespace Home\Controller;
use Think\Controller;
use think\Request;
class BaseController extends Controller {
    public function _initialize(){
        getUser();
    }

    public function setStatus(){
        $id = $_POST['id'];
        if(!$id){
            $this->ajaxReturn(toJson('ID错误'));
        }
        $user = $this->dao->where('id='.$id)->find();
        if(!$user){
            $this->ajaxReturn(toJson('数据不存在'));
        }
        $status = [0=>'启用',1=>'禁用'];
        $res = $this->dao->where('id='.$id)->setField('status', abs($user['status'] - 1));
        if($res){
            $this->ajaxReturn(toJson(true,$status[$user['status']]));
        }
        $this->ajaxReturn(toJson('修改失败'));
    }

    public function _before_save(){
        if(!$_POST['status']){
            $_POST['status'] = 0;
        }
    }

    public function delete(){
        $id = $_POST['id'];
        if(!$id){
            $this->ajaxReturn(toJson('ID错误'));
        }
        if($this->dao->delete($id)){
            $this->ajaxReturn(toJson(true));
        }
        $this->ajaxReturn(toJson('删除失败'));
    }
}