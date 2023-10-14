<?php
    session_start();
    require 'Admin/db_connect.php';

    if(!isset($_SESSION['user_array'])){
        header("location:login.php");
    }else{
        if($_SESSION['user_array']['role'] != 'user'){
            header('location:admin/dashboard.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/icon">
    <link href="https://fonts.googleapis.com/css2?family=Ranchers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>

<?php
    if(isset($_POST['btn_logout'])){
        session_destroy();
        header("location:login.php");
    }
?>
    <!-- Navigation -->
 <div class="container navigation">
        <div class="col-md-5">
            <img src="img/logo.png" alt="" class="logoimg img-fluid">
        </div>
        <div class="col-md-7">
            <ul class="list-inline">
                <li><a href="login_index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="gallary.php">Shop</a></li>
                <li><a href="classes.php">Classes</a></li>
                <li><a href="blog.php">Blog</a></li>
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
            </ul>
        </div>
        <!-- <div class="col-md-2">
            <h6><?php echo "Username:" . $_SESSION['user_array']['name']; ?> </h6>
        </div>
        <div class="col-md-1">
            <form action="logout.php" method="GET">                   
                    <button class="btn btn-danger btn-sm float-right"  onclick="return confirm('Are you sure want to logout?');">Logout</button>
            </form>
        </div> -->
 </div>

 <!-- Hero -->
 <div class="hero">
    <h1 class="hero-slogan">Physical Activity Enhence the positive energy.</h1>
    <h1 class="hero-slogan">If you appreciate quality, then we are for you.</h1>
    <a href="feedback.php?userId=<?php echo $_SESSION['user_array']['id']; ?>" target="_blank"><button class="btn btn-hero">See Feedbacks</button></a>

     
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>