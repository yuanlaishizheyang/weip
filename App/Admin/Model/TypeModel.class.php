<?php
namespace Admin\Model;

use Think\Model;

class TypeModel extends Model
{
    /*字段映射*/
    protected $_map = array(
        'goods_name' => 'type_name',
    );
    /*字段过滤*/
    protected $insertFields = 'type_name';
    /*自动验证*/
    protected $_validate = array(
        array('type_name','require','商品名称不能为空',1),
    );

}