<?php
$config['db_host']  = '178.128.55.129';
$config['db_user']  = 'root';
$config['db_pass']  = 'aaaa1111AA';
$config['db_name']  = 'blog';
//vòng lặp key, value
foreach($config as $k => $v){
    //strtoupper() chuyển đổi thành chữ hoa
    define(strtoupper($k),$v);
}