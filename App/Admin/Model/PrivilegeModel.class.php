<?php
namespace Admin\Model;

use Think\Model;

class PrivilegeModel extends Model
{
    /*字段映射*/
    protected $_map = array(
        'name' => 'priv_name',
        'p_id' => 'parent_id',
        'module' => 'module_name',
        'controller' => 'controller_name',
        'action' => 'action_name',
    );
    /*字段验证*/
    public $_pri_validate = array(
        array('priv_name','require','权限名称不能为空',1),
        array('parent_id','number','参数错误',1),
    );

    /**获取所有权限数据
     * @return array
     */
    public function getTree()
    {header('Content-type:text/html;charset=utf8');
        $info = $this->select();
        return getTree($info);
    }
}