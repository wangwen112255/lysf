<?php
namespace Wx\Controller;
class IndexController extends BaseController {
    public function index(){
//        echo '<pre>';
//        var_dump($users = getWxUser());
//        $user = $this->wechat->user;
//        $userData = $user->get($users['openid']);
//        var_dump($userData);
//        addWxUser($userData);
//        var_dump($users = getWxUser());
        $this->display();
    }
}