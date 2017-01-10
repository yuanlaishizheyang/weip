<?php
namespace Admin\Controller;

class GoodsController extends MyController
{
    /**
     * 商品添加功能
     */
    public function add()
    {
        $goodsModel = D('Goods');
        if (IS_POST) {
            if ($goodsModel->create()) {
                if ($goodsModel->add()) {
                    //添加数据成功
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    $error = $goodsModel->getError();
                    if (empty($error)) {
                        $error = '添加失败';
                    }
                    $this->error($error);
                }
            } else {
                $this->error($goodsModel->getError());
            }
        }
        //取出栏目数据
        $catModel = D('Category');
        $cats = $catModel->select();
        $cats = getTree($cats);
        $this->assign('cats', $cats);
        $this->display();
    }

    /**
     * 显示功能
     */
    public function lst()
    {
        //获取商品数据
        $infos = M('Goods')->where('is_deleted=0')->select();
        $this->assign('infos', $infos);
        $this->display();
    }

    public function isToggle()
    {
        $field = I('get.field');
        $value = I('get.value');
        $goods_id = I('get.goods_id');
        $info = M('Goods')->where('id=' . $goods_id)->setField($field, $value);
       /* if ($info) {
            echo 1;
        } else {
            echo 0;
        }*/
        echo $info;
    }

    public function changeContent()
    {
        $goods_id = I('get.goods_id');
        $field = I('get.field');
        $value = I('get.value');
        $info = M('Goods')->where('id='.$goods_id)->setField($field,$value);
        /*if ($info) {
            echo 1;
        } else {
            echo 0;
        }*/
        echo $info;
    }
}