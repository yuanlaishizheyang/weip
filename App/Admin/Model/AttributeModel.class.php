<?php
namespace Admin\Model;

use Think\Model;

class AttributeModel extends Model
{
    /*字段映射*/
    protected $_map = array(
        'name' => 'attr_name',
        'parent_id' => 'type_id',
        'type' => 'attr_type',
        'in_method' => 'attr_input_type',
        'list' => 'attr_value',
    );
    /*字段过滤*/
    protected $insertFields = 'attr_name,type_id,attr_type,attr_input_type,attr_value';
    /*字段验证*/
    protected $_validate = array(
        array('attr_name','require','输入有误',1),
        array('type_id','checkTypeId','输入有误',1,'callback'),
        array('attr_type','0,1','输入有误',1,'in'),
        array('attr_input_type','0,1','输入有误',1,'in'),
        array('attr_value','require','输入有误'),
    );
    protected function checkTypeId($type_id)
    {
        $typeModel = M('Type');
        $types = $typeModel->select();
        $strTypeId= array();
        foreach ($types as $type) {
            array_push($strTypeId,$type['id']);
        }
        return in_array($type_id,$strTypeId)?true:false;
    }

    public function selectAttrByTypeId($where,$firstRow,$listRows)
    {
        return $this->field('a.*,t.type_name')->join('a left join it_type t on a.type_id=t.id')->where($where)
            ->limit($firstRow,$listRows)->select();
    }
}