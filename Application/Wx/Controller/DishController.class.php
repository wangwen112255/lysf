<?php
/**
 * Created by mumu.
 * Date: 2016/12/8
 * Time: 11:08
 */
namespace Wx\Controller;
class DishController extends BaseController
{
    public function index(){
        $categoryMap = [];
        $categoryMap['status'] = 1;
        $categoryMap['is_show'] = 1;
        $category = M('goods_category')->where($categoryMap)->field('id,name')->order('sort DESC')->select();
        $list = [];
        $goods = M('goods');
        $goodsMap = [];
        $goodsMap['status'] = 1;
        foreach ($category as $v){
            $goodsMap['category_id'] = $v['id'];
            $list[] = $goods->where($goodsMap)->field('id,name,pic')->select();
        }

        $this->assign('category', $category);
        $this->assign('list', $list);
        $this->assign('title', '菜品');
        $this->display();
    }

    public function desc(){
        $id = I('id');
        if(!$id) $this->error('商品不存在');
        $map = [];
        $map['id'] = $id;
        $map['status'] = 1;
        $data = M('goods')->where($map)->field('id,name,desc,pic,price')->find();
        if(!$data) $this->error('商品不存在');
        $data['piclist'] = M('goods_pics')->where('good_id='.$data['id'])->select();
        $this->assign('data', $data);
        $this->assign('title', $data['name']);
        $this->display();
    }

    public function recommend(){
        $this->display();
    }
}