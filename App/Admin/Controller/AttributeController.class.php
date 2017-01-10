<?php
namespace Admin\Controller;

class AttributeController extends MyController
{
    /*添加功能*/
    public function add()
    {
        if (IS_POST) {
            //处理post数据
            $attrModel = D('Attribute');
            if ($attrModel->create()) {
                //验证成功
                if ($attrModel->add()) {
                    //添加成功
                    $this->success('添加成功',U('lst'),3);
                } else {
                    //添加失败
                    $this->error('添加失败');
                }
            } else {
                //验证失败
                $this->error($attrModel->getError());
            }
        } else {
            //获取商品类型
            $typeModel = D('Type');
            $types = $typeModel->select();
            $this->assign('types',$types);
            $this->display();
        }
    }
    /**
     * 显示功能
     */
    public function lst()
    {
        //获取属性数据
        $id = I('get.id')+0;
        if ($id < 0) {
            $this->error('操作有误');
        }
        if ($id == 0) {
            $where = 1;
        } else {
            $where = 'type_id='.$id;
        }
        $attrModel = D('Attribute');
        //分页
        $count = $attrModel->where($where)->count();
        $pageSize=2;
        $page = new \Think\Page($count,$pageSize);
        //配置分页信息
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('first','首页');
        $page->setConfig('last','末页');
        $page->rollPage = 5;
        $page->lastSuffix = false;
        //生成分页按钮
        $show = $page->show();
        //生成分页内容
        $info = $attrModel->selectAttrByTypeId($where,$page->firstRow,$page->listRows);
        //获取全部的商品类型
        $types = M('Type')->select();
        $this->assign('show',$show);
        $this->assign('info',$info);
        $this->assign('types',$types);
        $this->assign('id',$id);
        $this->display();
    }
}