<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $goodsModel = D('Admin/Goods');
        $infos_isHot = $goodsModel->getGoods('is_hot');
        $this->assign('infos_isHost',$infos_isHot);
        $this->display();
    }
    public function category()
    {
        
        $this->display();
    }
    public function detail()
    {
        $this->display();
    }
}