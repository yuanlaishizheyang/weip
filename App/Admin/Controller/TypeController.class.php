<?php
namespace Admin\Controller;

class TypeController extends MyController
{
    public function add()
    {
        if (IS_POST) {
            //处理post数据
            $typeModel = D('Type');
            if ($typeModel->create(I('post.'),1)) {
                //验证成功，添加数据
                if ($typeModel->add()) {
                    //添加商品成功
                    $this->success('添加成功',U('lst'),3);
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($typeModel->getError());
            }
        } else {
            $this->display();
        }
    }

    public function lst()
    {
        //分页
        $typeModel = D('Type');
        //总记录数
        $count = $typeModel->count();
        //每页显示的数量
        $pageSize = 1;
        $page = new \Think\Page($count,$pageSize);
        //分页栏配置
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
        $page->rollPage = 3;
        $page->lastSuffix = false;
        //生成分页按钮
        $show = $page->show();
        //获取数据
        //select t.*,a.type_id,count(*) count from it_type as t left join it_attribute as a on t.id=a.type_id group by a.id
        $typeInfo = $typeModel->field('t.*,a.type_id,count(*) count')->join('t left join it_attribute as a on t.id=a.type_id')
            ->group('t.id')->limit($page->firstRow,$page->listRows)->select();
        $this->assign(array(
            'show' => $show,
            'typeInfo' => $typeInfo,
            'nowPage' => $_GET['p']?:1,
            'pageSize' => $pageSize,
        ));
        $this->display();
    }
}