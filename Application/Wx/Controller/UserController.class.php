<?php
/**
 * Created by mumu.
 * Date: 2016/12/10
 * Time: 17:05
 */
namespace Wx\Controller;
class UserController extends BaseController
{
    public function index(){
        $id = getUserId();
        $user = M('user')->find($id);
        $this->assign('data', $user);
        $this->display();
    }
}