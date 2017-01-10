<?php
namespace Admin\Model;

use Think\Model;

class GoodsModel extends Model
{
    public $album = '';
    /*字段验证*/
    protected $_validate = array(
        array('goods_name','require','商品名称不能为空',1),
    );

    /**钩子函数，添加商品号和时间,处理图片文件上传
     * @param $data post数据
     * @param $options
     */
    protected function _before_insert(&$data,$options)
    {
        //判断是否有商品号,没有则添加
        if (isset($data['id'])) {
            unset($data[id]);
        }
        $goods_sn = I('post.goods_sn');
        if (empty($goods_sn)) {
            $goods_sn = strtoupper('SN_'.uniqid());
            $data['goods_sn'] = $goods_sn;
        }
        $data['add_time'] = time();
        if ($_FILES['goods_img']['error'] == 0) {
            //图片文件上传
          /*  $upload_max_filesize = min((int)C('UPLOAD_MAX_FILESIZE'),(int)ini_get('upload_max_filesize'));  //文件上传大小限制
            $upload_allow_ext = C('UPLOAD_ALLOW_EXT');  //上传文件后缀类型('jpeg','jpg','png','gif','bmp')
            $upload_root_path = C('UPLOAD_ROOT_PATH'); //上传文件根路径
            $cfg = array(
                'maxSize' => $upload_max_filesize*1024*1024,
                'exts' => $upload_allow_ext,
                'rootPath' => WORKING_PATH.$upload_root_path,
                'subName' => array('date','Y/m'),
                'saveName' => array('md5','__FILE__'),
            );
            $upload= new \Think\Upload($cfg);
            $info = $upload->upload();
            if ($info) {
                //图片上传成功,生成缩略图
                $good_ori = $upload_root_path.$info['goods_img']['savepath'].$info['goods_img']['savename'];    //原图地址
                $good_img = $upload_root_path.$info['goods_img']['savepath'].'img_'.$info['goods_img']['savename']; //中图地址
                $good_thumb = $upload_root_path.$info['goods_img']['savepath'].'thumb_'.$info['goods_img']['savename']; //小图地址
                $img = new \Think\Image();
                $img->open(WORKING_PATH.$good_ori)->thumb(350,350)->save(WORKING_PATH.$good_img);
                $img->open(WORKING_PATH.$good_ori)->thumb(150,150)->save(WORKING_PATH.$good_thumb);
                $data['goods_ori'] = $good_ori;
                $data['goods_img'] = $good_img;
                $data['goods_thumb'] = $good_thumb;
            } else {
                //上传失败
                $this->error = $upload->getError();
                return false;
            }*/

            $info = uploadOneImage('goods_img','Goods',array(array(350,350),array(150,150)));
            if ($info['status']) {
                //上传成功
                $data['goods_ori'] = $info['info'][0];
                $data['goods_img'] = $info['info'][1];
                $data['goods_thumb'] = $info['info'][2];
            } else {
                //上传失败
                $this->error = $info['info'];
                return false;
            }
        }
        if (hasImage('album')) {
            //album域有文件上传
            $info = uploadMoreImage('album','album',array(array(350,350),array(150,150)));
            if ($info['status']) {
                //上传成功
                $this->album = $info; 
            } else {
                //上传失败
                $this->error = $info['info'];
                return false;
            }
        }
    }
    protected function _after_insert($data,$options)
    {
        $goods_id = $data['id'];
        $info = $this->album;
        foreach ($info['info'] as $item) {
            $album_ori = $item[0];
            $album_img = $item[1];
            $album_thumb = $item[2];
            M('Album')->add(array(
                'goods_id' => $goods_id,
                'album_ori' => $album_ori,
                'album_img' => $album_img,
                'album_thumb' => $album_thumb,
            ));
        }
    }

    /**获取热销等商品
     * @param string $field 字段
     * @return mixed
     */
    public function getGoods($field)
    {
        return $this->where("is_deleted=0 and is_sale=1 and $field=1")->order('id desc')->limit(5)->select();
    }
}