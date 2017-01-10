<?php
namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model
{
    /*字段映射*/
    protected $_map = array(
        'name' => 'cat_name',
        'p_id' => 'parent_id',
    );
    /*字段过滤*/
    protected $insertFields = 'cat_name,parent_id';
    protected $updateFields = 'id,parent_id';
    /*字段验证*/
    protected $_validate = array(
        array('cat_name','require','操作有误1'),
        array('parent_id','number','操作有误2'),
        array('id','number','操作有误3'),
    );

    /**
     * 获取全部栏目
     */
    public function getAll()
    {
       $cats = $this->select();
        return getTree($cats);
    }
}