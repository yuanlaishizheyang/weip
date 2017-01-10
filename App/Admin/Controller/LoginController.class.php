<?php
namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    /**
     * 登录功能
     */
    public function login()
    {
        if (IS_POST) {
            //数据验证
            $adminModel = D('Admin');
            if ($data = $adminModel->validate($adminModel->_login_validate)->create()) {
                if ($adminModel->checkLogin($data)) {
                    //验证成功
                    $this->success('登录成功', U('index/index'));
                    exit;
                } else {
                    $this->error('用户名或密码不正确');
                }
            } else {
                $this->error($adminModel->getError());
            }
        }
        $this->display();
    }

    public function captcha()
    {
        //实例化verify类
        $config = array(
            'fontSize' => 10,              // 验证码字体大小(px)
            'useCurve' => false,            // 是否画混淆曲线
            'useNoise' => false,            // 是否添加杂点
            'imageH' => 25,               // 验证码图片高度
            'imageW' => 90,               // 验证码图片宽度
            'length' => 4,               // 验证码位数
            'fontttf' => '4.ttf',              // 验证码字体，不设置随机获取
        );
        $verify = new \Think\Verify($config);
        $verify->entry();
    }
}