<?php
namespace Admin\Controller;
use Think\Page;
class WemenuController extends BaseController {
    protected $dao;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->dao =M('Wx_menu');
    }

    public function index()
    {
        $count = $this->dao->where()->count();
        $Page = new \Think\Page($count,10);
        $Page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('last', '末页');
        $Page->setConfig('first', '首页');
        $Page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $list=$this->dao->limit($Page->firstRow.','.$Page->listRows)->select();
		// $list = $this->dao->where()->limit($page->firstRow.','.$page->listRows)->select();
	    //dump($list);
        //$da['we_menu_leftid']=array('')
        $show=$Page->show();
        $this->assign("page",$show);
        $amount=$this->dao->where("we_menu_leftid =0")->getField('id',true);
       // $color=array("5A6547",'476465','2F7B7D')
        $this->assign("amount",$amount);
        $this->assign("list",$list);


         $this->display();
    }

    public function insert(){
        $data=$this->dao->create();
        $data['status']=isset($_POST['status'])?1:0;
        if($data){
            $result=$this->dao->add($data);
            if($result){
                $this->ajaxReturn(toJson(true));
            }
            else{

                $this->ajaxReturn(toJson("请输入指定的内容"));
            }
        }
        else{

            $this->ajaxReturn(toJson("请重新输入数据"));
        }

    }
    public function edit(){

        if(isset($_GET['id'])){
            $list=$this->dao->where('id='.$_GET['id'])->find();
            $this->assign('data',$list);
            $list1=$this->dao->where('we_menu_leftid=0')->order("id desc")->limit()->getField('id,we_menu_name',true);
            $this->assign("list1",$list1);
            $this->display();
        }else
        {
            $data=$this->dao->create();
            $data['status']=isset($_POST['status'])?1:0;
            if($data){
                $result=$this->dao->where('id='.$_POST['id'])->save($data);;
                if($result){
                    $this->ajaxReturn(toJson(true));
                }
                else{

                    $this->ajaxReturn(toJson(true,"菜单未修改或修改失败"));
                }
            }
            else{

                $this->ajaxReturn(toJson("请重新输入"));
            }
        }

    }
    public function del()
    {
        if($this->dao->delete($_POST['id'])){
            $this->ajaxReturn(toJson(true));
        }
        else
            $this->ajaxReturn(toJson("删除失败"));


    }
     public function Setstatu(){
       if($this->dao->where('id='.$_POST['id'])->getField('status')==0)
         {
           $this->dao->where('id='.$_POST['id'])->setField('status',1);
           $data['data']="启用";
           $data['msg']="已启用";

           }
           else {
               $this->dao->where('id=' . $_POST['id'])->setField('status', 0);
               $data['data'] = "禁用";
               $data['msg']="已禁用";

           }
       $data['code']=200;
       $this->ajaxReturn($data);

   }
    public function create(){
        $list1=$this->dao->where('we_menu_leftid=0')->order("id desc")->limit()->getField('id,we_menu_name',true);
        $this->assign("list1",$list1);
        $this->display();
    }
     public function send(){
        echo "http://".$_SERVER['HTTP_HOST'].U("Article");


     }
    public function setOrder(){

        if($this->dao->where('id='.$_POST['id'])->setField('we_menu_order',$_POST['order'])){
            $data['code']=200;
            $data['msg']="修改成功";
            $this->ajaxReturn($data);
        }
        else {
            $data['code'] = 300;
            $data['msg'] = "修改失败";
            $this->ajaxReturn($data);
        }

    }
    public function show(){
        $this->dao=M('Wx_menu');
        $menu=array();
        $we_menu=$this->dao->where(array('we_menu_leftid'=>0,'status'=>1))->order('we_menu_order desc')->limit(3)->select();
        foreach($we_menu as $v){
            $we_twomenu=$this->dao->where(array('we_menu_leftid'=>$v['id'],'status'=>1))->order('we_menu_order desc')->limit(5)->select();
            $menu=array_merge($we_twomenu,$menu);
        }
        $this->assign("fa_menu",$we_menu);
        //dump($menu);
        $this->assign("menu",$menu);
        $this->display("index");
    }
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
                    $data.='"type":"'.$t['we_menu_type'].'",';
                    if($t['we_menu_type']=='view')
                        $data.='"url":"'.$t["we_menu_typeval"].'"';
                    else
                        $data.='"key":"'.$t["id"].'"';
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
                    $data.='"type":"'.$v['we_menu_type'].'",';
                    if($v['we_menu_type']=='view')
                        $data.='"url":"'.$v['we_menu_typeval'].'"}';
                    else
                        $data.='"key":"'.$v['id'].'"}';

                }
                else{
                    $data.='"type":"'.$v['we_menu_type'].'",';
                    if($v['we_menu_type']=='view')
                        $data.='"url":"'.$v['we_menu_typeval'].'"},';
                    else
                        $data.='"key":"'.$v['id'].'"},';

                }
            }
        }
        $data.= ']';
        $data.= '}';
        $access_token=$this->get_token();
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $menuinfo=json_decode($this->https_request($url,$data),true);
        if(!$menuinfo['errcode']){
            //dump($menuinfo);
            $datas['code']=200;
            $datas['msg']="菜单生成成功，请重新关注微信即可查看";
            $this->ajaxReturn($datas);
            // echo dump(count($we_menu));
        }
        else{
            //echo $access_token;
            //echo $data;
            //dump($menuinfo);
            $datas['code']=300;
            $datas['msg']="菜单生成失败，请检查菜单";
            $this->ajaxReturn($datas);
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
