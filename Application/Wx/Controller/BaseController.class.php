<?php
namespace Wx\Controller;
use Think\Controller;
use EasyWeChat\Foundation\Application;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\FilesystemCache;
class BaseController extends Controller {
    protected $wechat;
    public function _initialize($type=false){
        $wechatConfig = C('wx');
//        $wechatConfig['cache'] = new FilesystemCache(THINK_PATH.RUNTIME_PATH.'/wechart/');
        $this->wechat = new Application($wechatConfig);
        if($type === false){
            getOauth($this->wechat);
        }
    }

    public function _empty(){
        $this->error('页面不存在!');
    }
}