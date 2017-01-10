<?php
namespace Admin\Controller;
class AdminController extends MyController
{
    public function add()
    {
        if (IS_POST) {
            $adminModel = D('Admin');
            if ($adminModel->create()) {
                if ($adminModel->addAdmin()) {
                    $this->success('添加成功', U('lst'));
                    exit;
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($adminModel->getError());
            }
        }
        //获取角色
        $roleModel = M('Role');
        $infos = $roleModel->select();
        $this->infos = $infos;
        $this->display();
    }

    /**
     * 显示功能
     */
    public function lst()
    {
        $adminModel = D('Admin');
        $infos = $adminModel->getAdminRole();
        $this->assign('infos', $infos);
        $this->display();
    }

    /**
     * 删除功能
     */
    public function delete()
    {
        $admin_id = I('get.id') + 0;
        if ($admin_id<=0) {
            $this->error('参数不对');
        }
        $adminModel = D('Admin');
        if ($adminModel->delete($admin_id) !==false) {
            $this->success('删除成功',U('lst'));
            exit;
        } else {
            $this->error('删除失败');
        }
    }
}