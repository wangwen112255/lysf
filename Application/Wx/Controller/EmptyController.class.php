<?php
/**
 * Created by mumu.
 * Date: 2016/12/21
 * Time: 13:51
 */
namespace Wx\Controller;
use Think\Controller;

class EmptyController extends Controller
{
    public function index(){
        $this->error('页面不存在！');
    }
}