<?php
require "Admin/db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/icon">
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Blog</title>
</head>
<body>
    <!-- Navigation -->
 <div class="container navigation">
        <div class="col-md-5">
            <img src="img/logo.png" alt="" class="logoimg img-fluid">
        </div>
        <div class="col-md-7">
        <ul class="list-inline">
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="gallary.php">Shop</a></li>
                <Li><a href="login.html" target="_blank">Log In</a></Li>
                <li><a href="classes.php">Classes</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="admin/dashboard.php">Admin</a></li>
                
            </ul>
        </div>
 </div>

 <!-- Articles -->
 <div class="articles">
     <div class="container">
         <div class="row">
             <div class="col-md-10 col-md-offset-2">
                <div class="article">
                <?php 
                $selectQuery = "SELECT * FROM posts";
                $result = mysqli_query($db,$selectQuery);
                foreach($result as $post){
             ?>
                    
                    <img src="upload/<?php echo $post['image'] ?>" alt="" class="img-responsive"> 

                    <div class="article-meta">
                        <span clas="author-name">AUTHOR: <?php echo $post['author'] ?></span>
                        <span>Date:  <?php echo $post['date'] ?></span>
                    </div>
                    <p class="blog-content"> <?php echo $post['content'] ?></p>
    
                </div>
                <hr>
                <?php
                    } 
                ?>




             </div>
        </div>
         
     </div>
 </div>

<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <p>Thanks For Interesting us.</p>
                <p>Copyright to sajdfie</p>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <p>Phone - 05556564565</p>
                <p>Address - No.65/ Ares Building, Phoenix Street</p>
                <p>Email - customerservice@lightxgym.com</p>
            </div>
        </div>
    </div>
</div>



</body>
</html>