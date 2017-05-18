<?php
/**
 * Created by mumu.
 * Date: 2016/12/6
 * Time: 17:26
 */
function replaceStr($str,$handle,$star=0,$end=-1){
    $str = substr($str,$star,$end);
    return $str.$handle;
}

/**
 * 加密字符串
 * @param $pass 字符串
 * @param $prefix 前缀
 * @return string 加密后字符串
 */
function encryPtion($pass, $prefix=''){
    return md5($prefix.$pass);
}

/**
 * 获取随机字符串
 * @param int $length 字符串长度
 * @return string
 */
function getRandStr($length = 5){
    $str = '0123456789abcdefghighlmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $len = strlen($str)-1;
    $code = '';
    for ($i=0; $i < $length; $i++) {
        $k = mt_rand(0,$len);
        $code .= substr($str, $k,1);
    }
    return $code;
}

/**
 * 设置用户信息
 * @param $data
 */
function setUser($data){
    session(MODULE_NAME.'_user', $data);
}

/**
 * 获取用户信息
 * @param string $type
 * @return int|mixed
 */
function getUser(){
    $user = session(MODULE_NAME.'_user');
    if(!$user){
        redirect('/admin.php/Login/index');
    }
    return $user;
}