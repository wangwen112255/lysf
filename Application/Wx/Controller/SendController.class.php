<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/9
 * Time: 19:53
 */

namespace Wx\Controller;


use Admin\Controller\BaseController;

class SendController extends BaseController
{

    public function index(){

        $ar=M('Article');
        $list=$ar->where('id='.$_GET['id'])->find();
        $url="http://".$_SERVER['HTTP_HOST'].$list['pic'];
        $desc=htmlspecialchars_decode($list['desc']);
        $this->assign('desc',$desc);
        $this->assign('data',$list);
        $this->assign('img',$url);
        //dump($list);
        $this->display('Public/send');
    }
}