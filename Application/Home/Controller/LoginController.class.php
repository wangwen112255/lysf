<?php
/**
 * Created by mumu.
 * Date: 2016/12/13
 * Time: 11:46
 */
namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function index(){
        $this->display();
    }

    public function doLogin(){
        $username = I('username');
        $password = I('password');
        if(!$username || !$password){
            $this->error('请输入用户名和密码');
        }
        $user = M('admin_user');
        $map = array();
        $map['username'] = $username;
        $userData = $user->where($map)->find();
        if(!$userData){
            $this->error('用户名不存在！');
        }
        if($userData['status'] == 0){
            $this->error('用户被禁用，请联系管理员！');
        }
        $pass = encryPtion($password, $userData['code']);
        if($pass != $userData['password']){
            $this->error('密码错误！');
        }
        setUser($userData);
        $this->redirect('Index/index');
    }

    public function doLoginout(){
        setUser(null);
        $this->redirect('Login/index');
    }
}