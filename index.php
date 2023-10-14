<?php
    require "Admin/db_connect.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/icon">
    <link href="https://fonts.googleapis.com/css2?family=Ranchers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
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
                <li><a href="contact.php">Contact</a></li>
                <li><a href="gallary.php">Shop</a></li>
                <Li><a href="login.php" target="_blank">Log In</a></Li>
                <li><a href="classes.php">Classes</a></li>
                <li><a href="blog.php">Blog</a></li>
                
            </ul>
        </div>
 </div>

 <!-- Hero -->
 <div class="hero">
    <h1 class="hero-slogan">Physical Activity Enhence the positive energy.</h1>
    <h1 class="hero-slogan">If you appreciate quality, then we are for you.</h1>

     <a href="register.php" target="_blank"><button class="btn btn-hero">Become a Member</button></a>
 </div>

 <!-- BMI -->
    <!-- <div class="BMI">
        <div class="container">
        <div class="text-center">
            <iframe src="https://bmicalculatorusa.com/widgets/widget.php?t=550x480" width="550" height="480" frameborder="0"></iframe><p style=" font-family: sans-serif; font-size: 14px"></p>
        </div>
        </div>
    </div> -->

<!-- Instructor -->
<div class="instructors">
        <div class="container">
            <h3 class="instructor-title">Instructors</h3>
            <div class="row row-space">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php 
                        $selectQuery = "SELECT * FROM instructor";
                        $result = mysqli_query($db,$selectQuery);
                        foreach($result as $post){
                    ?>
                        <div class="instructor">
                            <img src="upload/<?php echo $post['photo'] ?>" alt="" class="img-circle img-responsive instructor-img">

                            <div class="about-instructor">
                                <span><?php echo $post['name'] ?></span> <br>
                                <span><?php echo $post['age'] ?></span> <br>
                                <span><?php echo $post['profession'] ?></span>
                            </div>
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