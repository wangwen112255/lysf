<?php
namespace Admin\Controller;
class IndexController extends BaseController {
    public function index(){
        $navlist = [
            ['title'=>'订单','name'=>'Order/index','icon'=>'fa fa-reorder'],
            ['title'=>'菜单',
                'child'=>[
                    ['title'=>'菜品','name'=>'Goods/index','icon'=>'fa fa-bookmark-o'],
                    ['title'=>'分类','name'=>'Category/index','icon'=>'fa fa-cube']
                ],
                'icon'=>'fa fa-book'
            ],
            ['title'=>'外卖',
                'child'=>[
                    ['title'=>'商品','name'=>'Takeout/index','icon'=>'fa fa-calendar-check-o'],
                    ['title'=>'设置','name'=>'Takeout/setOption','icon'=>'fa fa-gear'],
                ],
                'icon'=> 'fa fa-bicycle',
            ],
            ['title'=>'营销',
                'child'=>[
//                    ['title'=>'活动','name'=>'Activity/index'],
                    ['title'=>'代金券','name'=>'Coupon/index','icon'=>'fa fa-money']
                ],
                'icon'=>'fa fa-line-chart'
            ],
            ['title'=>'用户','name'=>'User/index','icon'=>'fa fa-users'],
            ['title'=>'自动回复',
                'child'=>[
                    ['title'=>'关键词','name'=>'Replay/index','icon'=>'fa fa-key'],
                    ['title'=>'回复文章','name'=>'Article/index','icon'=>'fa fa-comment'],
                ],
                'icon'=>'fa fa-volume-up'
            ],
        ];
        $user = getUser();
        $this->assign('list', $navlist);
        $this->assign('user', $user);
        $this->display();
    }

    public function vie(){
        $this->display();
    }
}