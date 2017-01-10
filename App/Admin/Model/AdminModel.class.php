<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model
{
    /*字段映射*/
    protected $_map = array(
        'username' => 'admin_name',
        'password' => 'admin_password',
    );
    /*字段过滤*/
    protected $insertFields = 'admin_name,admin_password,captcha,confirm_password,role_id';
    /*添加管理员验证*/
    protected $_validate = array(
        array('admin_name', 'require', '管理员不能为空', 1),
        array('admin_password', '6,12', '密码有误', 1, 'length'),
        array('confirm_password', 'admin_password', '密码不一致', 1, 'confirm'),
        array('role_id', 'number', '参数不对', 1),
    );
    /*动态验证*/
    public $_login_validate = array(
        array('admin_name', 'require', '用户名不能为空', 1),
        array('admin_password', 'require', '密码不能为空', 1),
        array('captcha', 'checkCaptcha', '验证码不正确', 1, 'function'),
    );

    /**验证码验证
     * @param $captcha
     * @return bool
     */
    /* public function checkCaptcha($captcha)
     {
         $verify = new \Think\Verify();
         return $verify->check($captcha);
     }*/

    /**登录验证
     * @param array $data
     * @return bool
     */
    public function checkLogin($data)
    {
        $admin_name = addslashes($data['admin_name']);
        $admin_password = $data['admin_password'];
        $info = M('Admin')->where("admin_name='$admin_name'")->find();
        if (!$info) {
            return false;
        }
        $admin_password = md5(md5($admin_password) . $info['salt']);
        if ($admin_password == $info['admin_password']) {
            session('admin_id', $info['id']);
            session('admin_name', $info['admin_name']);
            return true;
        } else {
            return false;
        }
    }

    /**添加管理员
     * @return mixed 失败返回false,成功返回管理员id
     */
    public function addAdmin()
    {
        $pwd = I('post.admin_password');
        $salt = substr(uniqid(), -6);
        $pwd = md5(md5($pwd) . $salt);
        $this->admin_password = $pwd;
        $this->salt = $salt;
        return $this->add();
    }

    public function _after_insert($data, $options)
    {
        $admin_id = $data['id'];
        $role_id = I('post.role_id');
        M('AdminRole')->add(array(
            'admin_id' => $admin_id,
            'role_id' => $role_id,
        ));
    }

    public function getAdminRole()
    {
        $sql = 'select a.id,a.admin_name,r.role_name from it_admin a left join it_admin_role a_r on a.id=a_r.admin_id left join it_role r on a_r.role_id=r.id';
        return $this->query($sql);
    }

    /**
     * 删除it_admin_role数据
     */
    public function _after_delete($data, $options)
    {
        $admin_id = $data['id'];
        M('AdminRole')->where('admin_id=' . $admin_id)->delete();
    }

    /*
     * 获取登录管理员的权限
     */
    public function getButtons()
    {
        $admin_id = session('admin_id');
        if ($admin_id == 1) {
            $sql = "select * from it_privilege";
        } else {
            $sql = "select p.* from it_admin_role a_r left join it_role_privilege r_p on a_r.role_id=r_p.role_id left join it_privilege p on r_p.priv_id=p.id where a_r.admin_id=admin_id";
        }
        $info = $this->query($sql);
        return getTree($info);
    }

    /**
     * 权限判断
     */
    public function checkButtons()
    {
        $mca = strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);
        //首页不做判断
        if (dirname($mca) == 'admin/index') {
            return true;
        }
        //超级管理员不做判断
        if (session('admin_id') == 1) {
            return true;
        }
        $sql = "select concat(module_name,'/',controller_name,'/',action_name) privileges from it_admin_role a_r left join it_role_privilege r_p on a_r.role_id=r_p.role_id left join it_privilege p on r_p.priv_id=p.id where a_r.admin_id=3 and p.parent_id !=0;";
        $privileges = $this->query($sql);
        $arrPriv = array();
        foreach ($privileges as $privilege) {
            array_push($arrPriv, strtolower($privilege['privileges']));
        }
        if (in_array($mca, $arrPriv)) {
            return true;
        } else {
            return false;
        }

    }
}