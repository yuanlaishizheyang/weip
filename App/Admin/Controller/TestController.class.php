<?php
namespace Admin\Controller;

use Think\Controller;

class TestController extends Controller
{
    public static $ACCESS_TOKEN = 'e78GBLtWRc5oWmBBoZbBmumrkD6piiQHGQ8iYAjb_TQXBHSUbypub_d-m1B-ljjTBTeWQ04NZENVnzvEmhiLhaENkcELFvI7OQmgiYdGQcwJIAgADAVUM';
    public function createMenu()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.self::$ACCESS_TOKEN;
        $param = <<<EOT
{
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://weipeng2.duapp.com/index.php"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://weipeng2.duapp.com/index.php/Admin/Test/test"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }
EOT;

        dump(http_post($url,$param));
    }
    public function delMenu()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.self::$ACCESS_TOKEN;
        dump(http_get($url));
    }
    public function test()
    {
//        dump($_SERVER['HTTP_REFERER']);
//        dump(pathinfo($_SERVER['HTTP_REFERER']));
//        $m = 'http://mvc.com/bbb/index.php?module=admin&controller=gate&action=showindex';
//        dump(pathinfo($m));
//        $this->display();
        /*$url = 'https://weipeng2.duapp.com/Admin/Test/test';
        echo urlencode($url),'<br/>';
        echo urlencode(urlencode(urlencode($url))),'<br/>';
        $url_eo = 'http%3A%2F%2Fweipeng2.duapp.com%2Findex.php';
        $url_et = 'http%25253A%25252F%25252Fweipeng2.duapp.com%25252Findex.php';
        echo urldecode($url_eo),'<br/>';
        echo urldecode(urldecode(urldecode($url_et))),'<br/>';*/
//        
//        $this->display();
//        $param = '{"id":10,"name":"zhangsan"}';
////        $param = 'id=10&name=zhangsan';
////        $param = 'x=';
//        $url = 'http://www.shop.com/Admin/Test/test2';
////        $res = http_post($url,$param);
//        $ocurl = curl_init();
//        curl_setopt($ocurl,CURLOPT_URL,$url);
//        curl_setopt($ocurl,CURLOPT_POST,1);
//        curl_setopt($ocurl,CURLOPT_POSTFIELDS,$param);
//        curl_exec($ocurl);
//        curl_close($ocurl);
//        dump($res);
//        print_r($res);
//        $this->display();
        /*$str = 'ab111-252-111fd';
        $reg = '/(\d)\1{2}-(\d)\d\2-\1{3}/';
//        preg_match($reg,$str,$match);
        dump(preg_replace($reg,'$1',$str));*/
        $this->display();
    }
    public function test2()
    {
//        dump($_SERVER['SCRIPT_FILENAME']);
//        dump($_SERVER['DOCUMENT_ROOT']);
//        dump($_SERVER['SERVER_NAME']);
//        dump($_SERVER['SCRIPT_NAME']);
//        dump($_SERVER['REQUEST_URI']);
//        echo '<hr>';
//        dump($_SERVER['HTTP_HOST']);
//        dump($_SERVER['PHP_SELF']);
//        dump($_SERVER['QUERY_STRING']);
//        $testModel = M('Test');
//        $res = $testModel->where('id=2')->getField('age');
//        dump($res);
//        dump(I('post.'));
//        $post = I('post.');
//        file_put_contents('./text.txt',$post);
        print_r($_POST);
    }
}

