<?php
namespace Admin\Controller;

use Think\Controller;

class MyController extends Controller
{
    protected function _initialize()
    {/*echo session('admin_id');*/
        $id = session('admin_id');
        if (empty($id)) {
            //木有登录
           // $this->error('请先登录',U('Login/login'));//不好
//            $url = U('Login/login');
            $url = '/';
            //用户木有登录,跳转登录
            echo '<script>top.location.href="'.$url.'"</script>';
            exit;
        }
        //权限判断,首页不做判断
        $adminModel = D('Admin');
        $res = $adminModel->checkButtons();
        if (!$res) {
            $this->error('木有权限',U('index/index'));
        }
    }
}