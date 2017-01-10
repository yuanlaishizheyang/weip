<?php
namespace Admin\Controller;
class privilegeController extends MyController
{
    public function add()
    {
        $priModel = D('Privilege');
        if (IS_POST) {
            if ($priModel->validate($priModel->_pri_validate)->create()) {
                $priModel->module_name = trim(I('post.module'));
                $priModel->controller_name = trim(I('post.controller'));
                $priModel->action_name = trim(I('post.action'));
                if($priModel->add()) {
                    $this->success('添加成功',U('lst'));
                    exit;
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($priModel->getError());
            }
        }
        //获取权限数据
        $infos = $priModel->getTree();
        $this->infos = $infos;
        $this->display();
    }
    public function lst()
    {
        $priModel = D('Privilege');
        $infos = $priModel->getTree();
        $this->infos = $infos;
        $this->display();
    }
}