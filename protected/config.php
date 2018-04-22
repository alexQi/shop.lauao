<?php
date_default_timezone_set('PRC');

return array
(
    'mysql' => array
    (
        'MYSQL_HOST' => 'www.lauao.com',
        'MYSQL_PORT' => '3306',
        'MYSQL_USER' => 'root',
        'MYSQL_DB'   => 'morechic',
        'MYSQL_PASS' => 'woshishei@1',
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
        'AppID'     => 'wxa361d238b92607b4',
        'AppSecret' => 'ac0f02b70d5c11621e0b85a5d4e7d357',
        'Token'     => 'morechic',
        'ApiUrl'    => 'api.weixin.qq.com',
        'EncodingAESKey' => 'hgCl8JV1q29i8Yrem9OZ9aCbY9PSAjj1SPFA1qfnNkm',
        'getToken'  => 'https://api.weixin.qq.com/cgi-bin/token',
    )
);
