<?php
/**
 * Created by mumu.
 * Date: 2016/12/6
 * Time: 17:38
 */

/**
 * ajax返回处理，code=200成功，code=100失败
 * @param $res
 * @param null $data
 * @param string $msg
 * @return array
 */
function toJson($res,$data=array(),$msg='操作成功!'){
    if(true === $res){
        $rs = array('code'=>200, 'msg'=>$msg);
        if(!empty($data))$rs['data'] = $data;
        return $rs;
    } else {
        return array('code'=>100, 'msg'=>$res);
    }
}

/**
 * 获取商品缩略图
 * @param $str
 * @param string $h
 * @return string
 */
function getPicThumb($str, $h='s_'){
    $i = strripos($str,"/");
    $path = substr($str, 0, $i+1);
    $pic =  substr($str, $i+1);
    return $path.$h.$pic;
}