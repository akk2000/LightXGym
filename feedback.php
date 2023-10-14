<?php
    require "Admin/db_connect.php";
    session_start();

    if(!isset($_SESSION['user_array'])){
        header("location:login.php");
    }else{
        if($_SESSION['user_array']['role'] != 'user'){
            header('location:admin/dashboard.php');
        }
    }
    
?>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Feedback</title>
</head>
<body>
    
    <?php 
    // getting userid from homepage
         if(isset($_GET['userId'])){
            $userId = $_GET['userId'];
            $post = mysqli_query($db, "SELECT * FROM user WHERE id=$userId");

            if(mysqli_num_rows($post) == 1){
                foreach($post as $row){
                    $id = $row['id'];
                    $username = $row['name'];
                }
            }
         }

         //adding post data to database
         $titleError = '';
         $contentError = '';

         if(isset($_POST['post_btn'])){

            $username = $_POST['username'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $insert_query = "INSERT INTO feedback(username,title,content) VALUES('$username','$title','$content')";

            if(empty($title)){
                $titleError = "Title field is required";
            }if(empty($content)){
                $contentError = "Content fields is required";
            }

            if(!empty($title && $content )){
                mysqli_query($db, $insert_query);
                header('location:feedback.php');
            }
         }

        //  Select Feedback
            $selectQuery = "SELECT * FROM feedback";
            $result = mysqli_query($db,$selectQuery);
                 
    ?>
    <!-- Navigation -->
 <div class="container navigation">
        <div class="col-md-5">
            <img src="img/logo.png" alt="" class="logoimg img-fluid">
        </div>
        <div class="col-md-7">
        <ul class="list-inline">
                 <li><a href="<?php if(isset($_SESSION['user_array'])){?> login_index.php <?php }if(!isset($_SESSION['user_array'])){ ?> index.php <?php } ?>">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="gallary.php">Shop</a></li>
                <li><a href="classes.php">Classes</a></li>
                <li><a href="blog.php">Blog</a></li>
                <?php if(isset($_SESSION['user_array'])) : ?>
                    <li class="nav-item dropdown" style="display:inline-block!important">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php">See your profile</a>
                        
                        <form action="logout.php" method="GET">                   
                            <button class="btn btn-danger btn-sm float-right dropdown-item" style="margin-top:10px"  onclick="return confirm('Are you sure want to logout?');">Logout</button>
                        </form>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
 </div>

 <!-- Feedbacks -->
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center"><h4>Feedbacks</h4></div>
                </div>
                <div class="card-body">
                    <?php foreach($result as $post){?>
                        <h4>Feedback From : <?php echo $post['username'] ?></h4><br>
                        <h3 class="font-weight-bold"><?php echo $post['title'] ?></h3>
                        <p><?php echo $post['content'] ?></p>
                        <hr>
                    <?php
                    } 
                    ?>
                </div>
                <div class="card-footer">
                    <h4>Write Your feedack</h4>
                    <form action="feedback.php" method="POST">
                    <div class="form-group">
                    
                    <input type="hidden" class="form-control " placeholder="Title" name="id" value ="<?php echo $id ?>">
                    <span class="text-danger"></span>
                </div>

                <div class="form-group">
                    
                    <input type="hidden" class="form-control " placeholder="Title" name="username" value ="<?php echo $username ?>">
                    <span class="text-danger"></span>
                </div>

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control <?php if(!empty($titleError)) : ?>is-invalid <?php endif ?> " placeholder="Title" name="title" value ="">
                    <span class="text-danger"><?php echo $titleError ?></span>
                </div>

                <div class="form-group">
                    <label for="">Message</label>
                    <textarea name="content" id="" class="form-control <?php if(!empty($contentError)) : ?>is-invalid <?php endif ?>" placeholder="Write your message..." ></textarea>   
                    <span class="text-danger"><?php echo $contentError ?></span>                           
                </div>
                    <button class="btn btn-success float-right" name="post_btn">Post</button>
                </form>

                </div>
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>