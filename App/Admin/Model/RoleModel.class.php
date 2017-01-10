<?php
namespace Admin\Model;

use Think\Model;

class RoleModel extends Model
{
    /*静态验证*/
    protected $_validate = array(
        array('role_name','require','角色名称不能为空'),
    );

    protected function _after_insert($data,$options) {
        $role_id = $data['id'];
        $priv_ids = I('priv_id');
        foreach ($priv_ids as $priv_id) {
            M('RolePrivilege')->add(array(
                'role_id' => $role_id,
                'priv_id' => $priv_id,
            ));
        }
    }
    public function getAll()
    {
        $sql = 'select r.*,group_concat(p.priv_name) priv_name from it_role r left join it_role_privilege r_p on r.id=r_p.role_id left join it_privilege p on r_p.priv_id=p.id group by r.id';
        return $this->query($sql);
    }
    protected function _after_delete($data,$options)
    {
        $role_id = $data['id'];
        M('RolePrivilege')->where('role_id='.$role_id)->delete();
    }
}