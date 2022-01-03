<?php
$config['db_host']  = 'localhost';
$config['db_user']  = 'root';
$config['db_pass']  = '';
$config['db_name']  = 'blog';
//vòng lặp key, value
foreach($config as $k => $v){
    //strtoupper() chuyển đổi thành chữ hoa
    define(strtoupper($k),$v);
}