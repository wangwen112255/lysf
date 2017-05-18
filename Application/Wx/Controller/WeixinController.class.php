<?php
/**
 * Created by mumu.
 * Date: 2016/11/26
 * Time: 16:56
 */
namespace Wx\Controller;
use EasyWeChat\Message\News;
class WeixinController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize(true);
    }

    public function index()
    {
        $server = $this->wechat->server;
        $server->setMessageHandler(function ($message) {
            // 注意，这里的 $message 不仅仅是用户发来的消息，也可能是事件
            // 当 $message->MsgType 为 event 时为事件
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        case 'subscribe':
                            $user = $this->wechat->user;
                            $userData = $user->get($message->FromUserName);
                            addWxUser($userData, 'subscribe');
                            break;
                        case 'unsubscribe':
                            upWxUser(0, $message->FromUserName, 'subscribe');
                            break;
                        case 'LOCATION':
                            break;
                        default:
                            # code...
                            break;
                    }
                    break;
                case 'text':
                    //file_put_contents("log.php","this is test",FILE_APPEND);
                    if($message->Content=='新闻')
                        return $this->get_Newslist($message);
                    else

                    return $this->transmitNews($message);
                   //return new Text(['content' => '您好！overtrue。']);
                    break;
                default:
                    break;
            }

        });
        $server->serve()->send();
    }

    public function transmitNews($message)
    {
        $data['keyword']=$message->Content;
        $data['restatus']=1;
        $reply = M('Wx_reply');
        $replylist = $reply->where($data)->select();
        //dump($replylist);
        if(!$replylist){
            $news="未找到相应内容";
        }
        else{
            foreach ($replylist as $k => $v) {
                $article = M('Article')->where('id=' .$v['article_id'])->find();
                $news= new News([
                    'title' => $article['title'],
                    'description' =>mb_substr(strip_tags(htmlspecialchars_decode($article['desc'])),0,80,'utf-8'),
                    'url' => "http://".$_SERVER['HTTP_HOST'].U("send/index",array('id'=>$article['id'])),
                    'image' =>"http://".$_SERVER['HTTP_HOST'].$article['pic']
                ]);
            }
        }

        return $news;
    }

    public function get_Newslist($message){
        $reply = M('Wx_reply');
        $list=$reply->join(' luu_article ON luu_wx_reply.article_id = luu_article.id')->field('luu_wx_reply.id as rid,title,desc,link,pic,article_id,keyword,luu_article.id as aid')->limit(10)->order('rid desc')->select();
        $news[] = new News(
            ["title" =>"欢迎进入鲁豫食府的新闻页",
            "description" =>"", "url" =>"",
            "image" =>"http://img5.imgtn.bdimg.com/it/u=500196643,3365803642&fm=21&gp=0.jpg"]);
        if(!$list){
            $news="暂时没有任何新闻列表";
        }else{
            foreach ($list as $k => $v) {
                $news[] = new News([
                    'title' => ($k+1).'、'.$v["title"]."\n　　回复【".$v["keyword"].'】查看,也可点击进入详情',
                    'description' => '',
                    'url' => "http://".$_SERVER['HTTP_HOST'].U("send/index",array('id'=>$v['aid'])),
                    'image' => '',
                ]);
            }
            return $news;



        }

    }



}