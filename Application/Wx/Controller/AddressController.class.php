<?php
/**
 * Created by mumu.
 * Date: 2016/12/9
 * Time: 14:33
 */
namespace Wx\Controller;
class AddressController extends BaseController
{
    public function index(){

    }

    public function save(){
        $dao = M('user_address');
        $user = getWxUser();
        $_POST['openid'] = $user['openid'];
        $_POST['province'] = $_POST['province']?$_POST['province']:'河南省';
        $_POST['city'] = $_POST['city']?$_POST['city']:'郑州市';
        $_POST['county'] = $_POST['county']?$_POST['county']:'郑东新区';
        if(!$_POST['is_default']){
            $count = $dao->where('openid="'.$user['openid'].'"')->count();
            if($count == 0){
                $_POST['is_default'] = 1;
            }
        }
        if($dao->create()){
            if($id = $dao->add()){
                $this->ajaxReturn(toJson(true,$id));
            }
        }
        $this->ajaxReturn(toJson('添加失败!'));
    }
}