<?php
/**
 * Created by mumu.
 * Date: 2016/12/16
 * Time: 11:36
 */
namespace Api\Controller;
class NotifyController extends BaseController
{
    public function yly(){
        $data = $_REQUEST;
        $name = time().'txt';
//        file_put_contents($name, json_encode($data));
    }
}