<?php
namespace Admin\Controller;

class CategoryController extends MyController
{
    /**
     * 栏目添加功能
     */
    public function add()
    {
        $catModel = D('Category');
        if (IS_POST) {
            //处理post数据
            if ($catModel->create()) {
                //验证成功,添加数据
                if ($catModel->add()) {
                    //添加成功
                    $this->success('添加成功',U('lst'),3);
                    exit;
                } else {
                    $this->error('添加失败');
                }
            } else {
                //验证失败
                $this->error($catModel->getError());
            }
        } else {
            //获取栏目数据,使用无限极分类
            $info = $catModel->getAll();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 栏目显示功能
     */
    public function lst()
    {
        //获取栏目数据,使用无限极分类
        $catModel = D('Category');
        $info = $catModel->getAll();
        $this->assign('info',$info);
        $this->display();
    }
    /**
     * 栏目删除功能
     */
    public function delete()
    {
        $id = I('get.id')+0;
        if ($id <= 0) {
            $this->error('参数有误');
        }
        //将要删除的栏目如果有子栏目,则不能删除
        $catModel = D('Category');
        $info = $catModel->where('parent_id='.$id)->find();
        if ($info) {
            //有子栏目,不能删
            $this->error('该栏目有子栏目,不能删除');
        } else {
            if ($catModel->delete($id) !== false) {
                //删除成功
                $this->success('删除成功');
                exit;
            } else {
                //删除失败
                $this->error('删除失败');
            }
        }
    }

    /**
     * 栏目修改功能
     */
    public function update()
    {
        $catModel = D('Category');
        if (IS_POST) {
            //处理post数据
            $post = I('post.');
            if ($data = $catModel->create($post,2)) {
                //父栏目不能为子孙栏目
                //获取所有栏目
                $infos = $catModel->select();
                $infos = getTree($infos);
                //获取子孙id
                $ids = getChildIds($infos,$post['id']);
                $ids[] = $post['id'];
                if (in_array($post['parent_id'],$ids)) {
                    $this->error('参数有误');
                } else {
                    if ($catModel->save() !== false) {
                        $this->success('修改成功',U('lst'),3);
                        exit;
                    } else {
                        $this->error('修改失败');
                    }
                }

            } else {
                $this->error($catModel->getError());
            }
        } else {
            $id = I('get.id')+0;
            if ($id <=0) {
                $this->error('参数有误');
            }
            $info = $catModel->find($id);
            if (empty($info)) {
                $this->error('参数有误');
            }
            //获取所有栏目
            $infos = $catModel->select();
            $infos = getTree($infos);
            //获取修改栏目的子孙id
            $ids = getChildIds($infos,$id);
            $ids[] = $id;
            $this->assign('ids',$ids);
            $this->assign('info',$info);
            $this->assign('infos',$infos);
            $this->display();
        }

    }
}