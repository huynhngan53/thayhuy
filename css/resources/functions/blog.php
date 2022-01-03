<?php
//Lấy dữ liệu từ sql để quản lý post và category
function add_post($title,$contents,$category){
  global $conn;
  //hàm mysqli_real_escape_string(connection, escap) để thoát các ký tự đặc biệt từ sql
    $title      = mysqli_real_escape_string($conn,$title);
    $contents   = mysqli_real_escape_string($conn,$contents);
    $category   = (int)$category;
    
    mysqli_query($conn,"INSERT INTO `posts` SET
                `cat_id`     = {$category},
                `title`      = '{$title}',
                `contents`   = '{$contents}',
                `date_posted`= NOW()");
}

function edit_post($id,$title,$contents,$category){
  global $conn;
    $id         = (int)$id;
    $title      = mysqli_real_escape_string($conn,$title);
    $contents   = mysqli_real_escape_string($conn,$contents);
    $category   = (int)$category;
    
    mysqli_query($conn,"UPDATE `posts` SET
                `cat_id`     = {$category},
                `title`      = '{$title}',
                `contents`   = '{$contents}'
                WHERE `id` = {$id}");  
}

function add_category($name){
  global $conn;
  $name = mysqli_real_escape_string($conn,$name);
  
  mysqli_query($conn,"INSERT INTO `categories` SET `name` = '{$name}'");
}

function delete($table, $id){
  global $conn;
    $table = mysqli_real_escape_string($conn,$table);
    $id    = (int)$id;
    
    mysqli_query($conn,"DELETE FROM `{$table}` WHERE `id`= {$id} ");    
}
//hàm lấy trong post
function get_posts($id = null, $cat_id = null){
  global $conn;
    $posts = array();
    //nối dữ liệu 2 bảng posts và catergories bên trong
    $query = "SELECT
              `posts`.`id` AS `post_id` ,
               `categories`.`id` AS `category_id`,
               `title`,`contents`,`date_posted`,
               `categories`.`name`
               FROM `posts`
               INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id` " ;
    if(isset($id)){
        $id = (int)$id;
        $query .= " WHERE `posts`.`id` = {$id} ";
             }
    if(isset($cat_id)){
        $cat_id = (int)$cat_id;
        $query .= " WHERE `cat_id` = {$cat_id} ";
             }         
    //sắp xếp giảm dần theo post_id    
    $query .= "ORDER BY `post_id` DESC";
    
    $query = mysqli_query($conn,$query);
  //hàm mysqli_fetch_assoc() sẽ trả về mảng khóa được lập chuỗi và không có mảng số, 
  //do đó sẽ không có tùy chọn ở đây bằng cách sử dụng các phím số như thế nào $row[0]  
    while($row = mysqli_fetch_assoc($query)){
    $posts[] = $row;
   }
   return $posts;
}
//hàm tạo danh mục
function get_categories($id = null){
  global $conn;
   $categories = array();
   
   $query = mysqli_query($conn,"SELECT `id`,`name` FROM `categories`");
   
   while($row = mysqli_fetch_assoc($query)){
    $categories[] = $row;
   }
   return $categories;
}
//hàm kiểm tra danh mục có tồn tại 
function category_exists($field,$name){
  global $conn;
    $name = mysqli_real_escape_string($conn,$name);
    $field = mysqli_real_escape_string($conn,$field);
    $query = mysqli_query($conn,"SELECT * FROM categories WHERE `{$field}` = '{$name}'");
    // var_dump(mysqli_num_rows($query));exit;
    
    return(mysqli_num_rows($query) == 0)?false : true;
}