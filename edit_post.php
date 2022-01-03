<?php
include_once('resources/init.php');
$post = get_posts($_GET['id']);
if(isset($_POST['title'],$_POST['contents'],$_POST['category'])){
    
    $errors = array();
   //Hàm trim dùng để xóa ký tự trắng (hoặc ký tự khác) ở đầu và cuối một chuỗi.
    $title = trim($_POST['title']);
    $contents = trim($_POST['contents']);
    
    if(empty($title)){
       //Bạn cần cung cấp 1 tiêu đề
     $errors[] = 'You need to supply a title';
    }
    else if(strlen($title)>255){
       //Tiêu đề không được dài hơn 255 ký tự
     $errors[] = 'The title can not be longer than 255 characters';   
    }
    
    if(empty($contents)){
       // Bạn cần cung cấp một số văn bản
     $errors[] = 'You need to supply some text';   
    }
    if(!category_exists('id',$_POST['category'])){
       //Danh mục đó đã tồn tại
    $errors[] = 'That category does not exists';   
    }
    
    if(empty($errors)){
        edit_post($_GET['id'],$title,$contents,$_POST['category']);
       
        header("Location:index.php?id={$post[0]['post_id']}");
        die();
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en"> 
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
	<title>NNT!</title>
	<meta name="description" content="">  
	<meta name="author" content="">

	<!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- CSS
    ================================================== -->
   <link rel="stylesheet" href="css/default.css">
	<link rel="stylesheet" href="css/layout.css">  
	<link rel="stylesheet" href="css/media-queries.css"> 

   <!-- Script
   ================================================== -->
	<script src="js/modernizr.js"></script>

</head>

<body>

   <!-- Header
   ================================================== -->
   <header id="top">

   	<div class="row">

   		<div class="header-content twelve columns">

		      <h1 id="logo-text"><a href="index.php" title="">NNT!</a></h1>
				<p id="intro">The only source of knowledge is experience.</p>

			</div>			

	   </div>

	   <nav id="nav-wrap"> 

	   	<div class="row">    		            

			   	<ul id="nav" class="nav">
               <li class="current"><a href="index.php">Home</a></li>
			      	<li><a href="page.html">About</a></li>
                  <li><a href="login.php">Login</a></li>
                  <li><a href="profile.php">Profile</a></li>
                  <li><a href="logout.php">Logout</a></li>
                  <li><a href="admin.php">Manager</a></li>
			   	</ul> <!-- end #nav -->			   	 

	   	</div> 

	   </nav> <!-- end #nav-wrap --> 	     

   </header> <!-- Header End -->

   <!-- Content
   ================================================== -->
   <div id="content-wrap">

   	<div class="row">

   		<div id="main" class="eight columns">

	   		<article class="entry">
					<header class="entry-header">
	       <?php
        if(isset($errors) && !empty($errors)){
           //hàm implode() nối các phần tử mảng với một chuỗi
            echo"<ul><li>",implode("</li><li>",$errors),"</li></ul>";
        }
        ?>
						<h2 class="entry-title">
							<h2>Add Category</h2>
						</h2> 				 
					
						<div class="entry-meta">
		        <form action='' method='post'>
     <div>
        <label for='title'>Title</label>
         <input type='text' name='title' value='<?php echo $post[0]['title']; ?>' />
     </div>
     <div>
         <label for='contents'>Content</label>
         <textarea name='contents' cols=20 rows=10><?php echo $post[0]['contents']; ?></textarea>
      </div>
     <div>
       <label for='category'>Category</label>
       <select name='category'>
        <?php
        foreach(get_categories() as $category){
         $selected = ($category['name'] == $post[0]['name']) ? 'selected' : '';   
         ?>
         <!-- thẻ <option> tùy chọn trong 1 danh sách tùy chọn -->
         <option value='<?php echo $category['id'] ?>' <?php echo $selected; ?> ><?php echo $category['name'] ?></option>
         <?php
        }
        ?>
       </select>
     </div>
     <p><input type='submit' value='Add Post' /></p>
     </form>
						</div> 
					 
					</header> 
	
					
					<div class="entry-content">
					</div> 


				</article> <!-- end entry -->

   		</div> <!-- end main -->

   		<div id="sidebar" class="four columns">
   			<div class="widget widget_categories group">
   				<h3>Categories</h3> 
   				<?php
     foreach(get_categories() as $category){
     ?>
      <p><a href="manage_category.php?id=<?php echo $category['id'];?>"><?php echo $category['name']; ?></a>
     <?php  
     }
     ?>
				</div>

				<div class="widget widget_text group">
					<h3>Daily Quote of the Day</h3>
   				<p>“Sometimes the questions are complicated and the answers are simple.” ― Dr. Seuss</p>

   			</div>
            <div class="widget widget_text group">
					<h3>Follow us</h3>
               <a href="https://phys.hcmus.edu.vn/vat-ly-tin-hoc">Vật Lý Tin Học</a>
            </div>
   			
   		</div> <!-- end sidebar -->

   	</div> <!-- end row -->

   </div> <!-- end content-wrap -->
   

   <!-- Footer
   ================================================== -->
   <footer>

      <div class="row"> 

      	<div class="twelve columns">	
				<ul class="social-links">
            <li><a href="https://facebook.com/"><i class="fa fa-facebook"></i></a></li>
               <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
               <li><a href="https://www.google.com.sg/"><i class="fa fa-google-plus"></i></a></li>               
               <li><a href="https://github.com/"><i class="fa fa-github-square"></i></a></li>
               <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>              
               <li><a href="https://www.skype.com/en/"><i class="fa fa-skype"></i></a></li>
            </ul>			
      	</div>
      
         <div class="six columns info">

            <h3>About The Blog</h3> 

            <p>Just Keep it Simple!
            </p>

         </div>

        <div class="four columns">

            <h3>Photostream</h3>
            
            <ul class="photostream group">
               <li><a><img alt="thumbnail" src="images/nhom.jpg"></a></li>
               <li><a><img alt="thumbnail" src="images/tra.jpg"></a></li>
               <li><a><img alt="thumbnail" src="images/ngan.jpg"></a></li>
               <li><a><img alt="thumbnail" src="images/nganhuynh.jpg"></a></li>
            </ul>           

         </div>

        <div class="two columns">
            <h3 class="social">Information</h3>
            <ul class="navigate group">
            <li><a href="index.php">Home</a></li>
               <li><a href="page.html">About</a></li>
               <li><a href="profile.php">Profile</a></li>
               <li><a href="admin.php">Manager</a></li>
            </ul>
         </div>

         <p class="copyright">&copy; Copyright 2021. The Blog. &nbsp; Design by NNT Team.</p>
        
      </div> <!-- End row -->

      <div id="go-top"><a class="smoothscroll" title="Back to Top" href="#top"><i class="fa fa-chevron-up"></i></a></div>

   </footer> <!-- End Footer-->


   <!-- Java Script
   ================================================== -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
   <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>  
   <script src="js/main.js"></script>

</body>

</html>