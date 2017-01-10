<?php
/*无限极分类*/
function getTree($list,$pid=0,$level=0)
{
    static $tree = array();
    foreach ($list as $row) {
        if ($row['parent_id'] == $pid) {
            $row['level'] = $level;
            $tree[] = $row;
            getTree($list, $row['id'], $level + 1);
        }
    }
    return $tree;
}
/*递归方法实现获取子孙id*/
function getChildIds($arr,$cat_id){
    static $ids = array();
    foreach($arr as $v){
        if($v['parent_id']==$cat_id){
            $ids[]=$v['id'];
            getChildIds($arr,$v['id']);
        }
    }
    return $ids;
}
/*格式化数据*/
function getFormat($list) {
    $tree = array();
    $key = 0;
    foreach ($list as $k=>$row) {
        if ($row['parent_id'] == 0){
            $tree[$k] = $row;
            $key = $k;
        } else {
            $tree[$key]['child'][] = $row;
        }
    }
    return $tree;
}
/**单个图片文件上传
 * @param string $filename 文件域名
 * @param string $dir 保存路径(相对于文件保存的根路径rootPath)
 * @param array $arr 是否制作缩略图
 * @return array
 */
function uploadOneImage($filename,$dir='',$arr=array()){
    $upload_max_filesize = min((int)C('UPLOAD_MAX_FILESIZE'),(int)ini_get('upload_max_filesize'));  //文件上传大小限制
    $upload_allow_ext = C('UPLOAD_ALLOW_EXT');  //上传文件后缀类型('jpeg','jpg','png','gif','bmp')
    $upload_root_path = C('UPLOAD_ROOT_PATH'); //上传文件根路径
    $cfg = array(
        'maxSize' => $upload_max_filesize*1024*1024,
        'exts' => $upload_allow_ext,
        'rootPath' => $upload_root_path,
        'savePath' => empty($dir)?$dir:$dir.'/',
        'subName' => array('date','Y/m'),
        'saveName' => array('md5','__FILE__'),
    );
    $upload= new \Think\Upload($cfg);
    //upload参数表示指定文件域,防止多个文件域上传时发生冲突
    $info = $upload->upload(array("$filename"=>$_FILES[$filename]));
    if ($info) {
        //生成缩略图
        $save_path = $upload_root_path.$info[$filename]['savepath'].$info[$filename]['savename'];    //原图地址
        $msg[] = ltrim($save_path,'.');
        if ($arr) {
            foreach ($arr as $key=>$item) {
                $thumb_path = $upload_root_path.$info[$filename]['savepath'].$key.$info[$filename]['savename']; //缩略图地址
                $img = new \Think\Image();
                $img->open($save_path)->thumb($item[0],$item[1])->save($thumb_path);
                $msg[] = ltrim($thumb_path,'.');
            }
        }
        return array(
            'status' => '1',
            'info' => $msg,
        );
    } else {
        //上传失败
        $msg = $upload->getError();
        return array(
            'status' => '0',
            'info' => $msg,
        );
    }
}

/**判断多文件上传时,是否有文件上传
 * @param string $filename 文件域名
 * @return bool
 */
function hasImage($filename){
    $errs = $_FILES[$filename]['error'];
    foreach ($errs as $err) {
        if ($err == 0) {
            return true;
        }
    }
    return false;
}

/**多个图片文件上传
 * @param string $filename 文件域名
 * @param string $dir 保存路径(相对于文件保存的根路径rootPath)
 * @param array $arr 是否制作缩略图
 * @return array
 */
function uploadMoreImage($filename,$dir='',$arr=array()){
    $upload_max_filesize = min((int)C('UPLOAD_MAX_FILESIZE'),(int)ini_get('upload_max_filesize'));  //文件上传大小限制
    $upload_allow_ext = C('UPLOAD_ALLOW_EXT');  //上传文件后缀类型('jpeg','jpg','png','gif','bmp')
    $upload_root_path = C('UPLOAD_ROOT_PATH'); //上传文件根路径
    $cfg = array(
        'maxSize' => $upload_max_filesize*1024*1024,
        'exts' => $upload_allow_ext,
        'rootPath' => $upload_root_path,
        'savePath' => empty($dir)?$dir:$dir.'/',
        'subName' => array('date','Y/m'),
        'saveName' => array('md5','__FILE__'),
    );
    $upload= new \Think\Upload($cfg);
    //upload参数表示指定文件域,防止多个文件域上传时发生冲突
    $info = $upload->upload(array("$filename"=>$_FILES[$filename]));
    if ($info) {
        //生成缩略图
        foreach ($info as $item) {
            $save_path = $upload_root_path.$item['savepath'].$item['savename'];    //原图地址
            $tmp = array();
            $tmp[] = ltrim($save_path,'.');
            if ($arr) {
                foreach ($arr as $key=>$row) {
                    $thumb_path = $upload_root_path.$item['savepath'].$key.$item['savename']; //缩略图地址
                    $img = new \Think\Image();
                    $img->open($save_path)->thumb($row[0],$row[1])->save($thumb_path);
                    $tmp[] = ltrim($thumb_path,'.');
                }
            }
            $msg[] = $tmp;
        }
        return array(
            'status' => '1',
            'info' => $msg,
        );
    } else {
        //上传失败
        $msg = $upload->getError();
        return array(
            'status' => '0',
            'info' => $msg,
        );
    }
}

/**
 * GET 请求
 * 需要curl扩展支持
 */
function http_get($url){
    $oCurl = curl_init();
    if(stripos($url,"https://")!==FALSE){
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($oCurl, CURLOPT_SSLVERSION, 1);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"])==200){
        return $sContent;
    }else{
        return false;
    }
}

/**
 * POST 请求
 * 需要curl扩展支持
 */
function http_post($url,$param,$post_file=false){
    $oCurl = curl_init();
    if(stripos($url,"https://") !== FALSE){
        curl_setopt($oCurl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($oCurl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($oCurl,CURLOPT_SSLVERSION,1);
    }
    if (is_string($param) || $post_file){
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach($param as $key => $val){
            $aPOST[] = $key."=" . urlencode($val);
        }
        $strPOST = join("&",$aPOST);
    }
    curl_setopt($oCurl,CURLOPT_URL,$url);
    curl_setopt($oCurl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($oCurl,CURLOPT_POST,true);
    curl_setopt($oCurl,CURLOPT_POSTFIELDS,$strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if(intval($aStatus["http_code"]) == 200){
        return $sContent;
    }else{
        return false;
    }
}