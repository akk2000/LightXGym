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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <title>Contact</title>
</head>
<body>

    <?php 
    $emailError = '';
    $nameError = '';
    $phoneError = '';
    $messageError = '';
        if(isset($_POST['contact_btn'])){
            $userId = $_POST['userId'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            $insert_query = "INSERT INTO contact_info(userId,email,name,phone,message) VALUES($userId,'$email','$name','$phone','$message')";

            if(empty($email)){
                $emailError = "Email field is required";
            }if(empty($name)){
                $nameError = "Name fields is required";
            }if(empty($phone)){
                $phoneError = "Phone fields is required";
            }if(empty($message)){
                $messageError = "Message fields is required";
            }
            
            if(!empty($email && $name && $phone && $message )){
                mysqli_query($db, $insert_query);
                $_SESSION["successMessage"] = "Contact Info sent Successfully! We will contact you soon";
                // header("location:contact.php");
            }
        }
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

 <!-- Hero -->
 <!-- <div class="contact-hero">
    <h1 class="hero-slogan">Contact US</h1>
 </div> -->

 <!-- contact form -->
         <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <?php if(isset($_SESSION['successMessage'])): ?>
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        <?php 
                        echo  $_SESSION["successMessage"];     
                        unset ($_SESSION["successMessage"]);                
                        ?>
                        <button type="button" class="close" data-dismiss="alert">  
                            <span>&times;</span>
                        </button>
                    </div>
                    <?php endif ?>
                </div>
            </div>
         </div>      
<div>
    <h3 class="contact-title">Drop things for us!</h3>
</div>

 <div class="contactform">
     <div class="container">
        <form action="contact.php" method="POST">
            <input type="hidden" class="form-control contact-form" placeholder="Email" name="userId" value="<?php echo $_SESSION['user_array']['id'] ?>">
            

            <input type="text" class="form-control contact-form <?php if(!empty($emailError)) : ?>is-invalid <?php endif ?>" placeholder="Email" name="email">
            <span class="text-danger"><?php echo $emailError ?></span>

            <input type="text" class="form-control contact-form <?php if(!empty($nameError)) : ?>is-invalid <?php endif ?>" placeholder="Name" name="name">
            <span class="text-danger"><?php echo $nameError ?></span>

            <input type="text" class="form-control contact-form <?php if(!empty($phoneError)) : ?>is-invalid <?php endif ?>" placeholder="Phone Number" name="phone">
            <span class="text-danger"><?php echo $phoneError ?></span>

            <textarea class="form-control contact-form <?php if(!empty($messageError)) : ?>is-invalid <?php endif ?>" id="textarea1" rows="3" placeholder="Your Message..." name="message"><?php echo $messageError ?></textarea>
            <button class="btn btn-primary" name="contact_btn">Send</button>
        </form>
     </div>
 </div>

<!-- Footer -->
<div class="footer footer-contact">
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