<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'szshop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'it_',    // 数据库表前缀

    /*模板常量*/
    'TMPL_PARSE_STRING' => array(
        '__ADMIN__' => __ROOT__.'/Public/Admin',
        '__HOME__' => __ROOT__.'/Public/Home',
    ),
    /*url重写模式*/
    'URL_MODEL' => 2,
    
    /*配置redis缓存系统*/
    'DATA_CACHE_TYPE' => 'Redis',
    'REDIS_HOST' => '192.168.13.30',
    'REDIS_PORT' => '6379',

    /*图片文件上传配置*/
    'UPLOAD_ROOT_PATH' => './Public/Uploads/',
    'UPLOAD_ALLOW_EXT' => array('jepg','jpg','png','gif','bmp'),
    'UPLOAD_MAX_FILESIZE' => '3M',
);