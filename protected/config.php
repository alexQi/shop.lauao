<?php
date_default_timezone_set('PRC');

return array
(
    'mysql' => array
    (
        'MYSQL_HOST' => 'localhost',
        'MYSQL_PORT' => '3306',
        'MYSQL_USER' => 'root',
        'MYSQL_DB'   => 'akmall',
        'MYSQL_PASS' => 'woshishei',
        'MYSQL_DB_TABLE_PRE' => 'akmall_',
        'MYSQL_CHARSET' => 'UTF8',
    ),
    
    'verydows' => array
    (
        'VERSION' => '2.0',
        'RELEASE' => '20161112',
        'COMMENCED' => '1516204800',
    ),
    'wechat' => array
    (
        'AppID'     => 'wx1bfc2ed71e8d48e3',
        'AppSecret' => 'c43a4f7aac4863b667d9863d0051f6d2',
        'Token'     => 'tianruiyuan',
        'ApiUrl'    => 'api.weixin.qq.com',
        'EncodingAESKey' => '1hfZHDMMGjSvL2sehimtkxpgdVJ88lAm7GL7Fv1DawK',
        'getToken'  => 'https://api.weixin.qq.com/cgi-bin/token',
    )
);
