<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/9
 * Time: 10:26
 */

namespace Admin\Controller;


class ReController extends BaseController
{
    public function finish(){
        $this->dao=M('Wx_menu');
        $we_menu=$this->dao->where(array('we_menu_leftid'=>0,'status'=>1))->order('we_menu_order desc')->limit(3)->select();
        $amount=count($we_menu);
        $data = '{"button":[';
        $i=0;
        foreach($we_menu as $v){
            $i=$i+1;
            $data.='{"name":"'.$v['we_menu_name'].'",';
            $count=$this->dao->where(array('we_menu_leftid'=>$v['id'],'status'=>1))->limit(5)->order('we_menu_order desc')->count();//判断是否有子栏目
            if($count){//二级栏目
                $data.='"sub_button":[';
                $we_twomenu=$this->dao->where(array('we_menu_leftid'=>$v['id'],'status'=>1))->order(' we_menu_order  desc')->limit(5)->select();
                $k=0;
                foreach($we_twomenu as $t){
                    $k=$k+1;
                    $data.='{"name":"'.$t['we_menu_name'].'",';
                    $data.='"type":"view",';
                    $data.='"url":"'.$t["we_menu_typeval"].'"';
                    if ($k==$count){
                        $data.= '}';
                    }else{
                        $data.= '},';
                    }
                }
                if($i==$amount)
                $data.=']}';
                else
                    $data.=']},';
            }else{
                if($i==$amount){
                    $data.='"type":"view",';
                    $data.='"url":"'.$v['we_menu_typeval'].'"}';}
                else{
                    $data.='"type":"view",';
                    $data.='"url":"'.$v['we_menu_typeval'].'"},';

                }
            }
        }
        $data.= ']';
        $data.= '}';
        $access_token=$this->get_token();
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        if($this->https_request($url,$data)){
            echo($this->https_request($url,$data));
            $datas['code']=200;
            $datas['msg']="菜单生成成功，请重新关注微信即可查看";
            $this->ajaxReturn($datas);
            // echo dump(count($we_menu));
        }
        else{
          echo $access_token;
            $datas['code']=300;
            $datas['msg']="菜单生成失败，请检查菜单";
           // $this->ajaxReturn($datas);
        }

    }

//获取token
    public function get_token(){
        $appid = "wx9e0d7eef1936b445";
        $appsecret = "90adba97c4a95586e5993e2050e9b8ae";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $output = $this->https_request($url);
        $jsoninfo = json_decode($output, true);
        $access_token = $jsoninfo["access_token"];
        return $access_token;

    }
//Cur请求
    public function https_request($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

 }

    //{"button":[{"name":"菜单1","sub_button":[{"name":"公司简介","type":"view","url":http://www.thinkphp.cn/},{"name":"联系我们","type":"view","url":}]}{"name":"菜单二","sub_button":[{"name":"二级菜单","type":"view","url":}]}{"name":"菜单三","sub_button":[{"name":"三级菜单","type":"view","url":}]}]}