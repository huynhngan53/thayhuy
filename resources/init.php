<?php
/* Error Message: Deprecated: mysqli_connect(): The mysqli extension is deprecated and will be removed in the future: use mysqlii or PDO instead in C:\wamp64\www\kblog\resources\init.php on line 4 */
//Không được dùng nữa: mysqli_connect (): Phần mở rộng mysqli không được dùng nữa và sẽ bị xóa trong tương lai: 
//hãy sử dụng mysqlii hoặc PDO thay thế trong C: \ wamp64 \ www \ kblog \ resources \ init.php trên dòng 4 * /
//xử lý lỗi để chấp nhận tiện ích mở rộng mysqli không dùng nữa
error_reporting(1); //handles error to accept deprecated mysqli extension

include_once('config.inc.php');
$conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
include_once('functions/blog.php');
?>