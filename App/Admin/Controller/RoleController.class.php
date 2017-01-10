<?php
namespace Admin\Controller;
class RoleController extends MyController
{
    public function add()
    {
        if (IS_POST) {
            $roleModel = D('Role');
            if ($roleModel->create()) {
                if ($roleModel->add()) {
                    //添加成功
                    $this->success('添加成功', U('lst'));
                    exit();
                } else {
                    $this->error('添加失败');
                }
            } else {
                $this->error($roleModel->getError());
            }
        }
        //获取权限
        $priModel = D('Privilege');
        $infos = $priModel->getTree();
        $infos = getFormat($infos);
        $this->infos = $infos;
        $this->display();
    }

    /**
     * 显示功能
     */
    public function lst()
    {
        //获取角色和权限数据
        $roleModel = D('Role');
        $infos = $roleModel->getAll();
        $this->assign('infos', $infos);
        $this->display();
    }

    /**
     * 删除功能
     */
    public function delete()
    {
        $role_id = I('get.id') + 0;
        if ($role_id <= 0) {
            $this->error('参数错误');
        }
        //当管理员拥有该角色时，不能删除
        $rolePrivModel = M('AdminRole');
        if ($data=$rolePrivModel->where('role_id='.$role_id)->find()) {
            $this->error('该角色使用中，不能删除');
        }
        $roleModel = D('Role');
        if ($roleModel->delete($role_id) !== false) {
            //删除成功
            $this->success('删除成功',U('lst'));
            exit;
        } else {
            $this->error('删除失败');
        }
    }
}
