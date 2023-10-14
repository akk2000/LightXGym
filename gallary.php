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
    <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Gallary</title>
</head>
<body>
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

    <!-- Gallary Items -->
            <?php if(isset($_SESSION['successMessage'])): ?>
                <div class="alert alert-success alert-dismissible show text-center" role="alert">
                    <?php 
                    echo  $_SESSION["successMessage"];     
                    unset ($_SESSION["successMessage"]);                
                    ?>
                    <button type="button" class="close" data-dismiss="alert">  
                        <span>&times;</span>
                    </button>
                </div>
            <?php endif ?>
    <div class="container">
        <div class="col-md-5 col-md-offset-3 gallary-items ">
        <?php 
                $selectQuery = "SELECT * FROM inventory";
                $result = mysqli_query($db,$selectQuery);
                foreach($result as $post){
             ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="item">
                        <img src="upload/<?php echo $post['item_image'] ?>" alt="" class="img-responsive">

                    <div class="item-data">
                        <span><?php echo $post['item_title'] ?></span> <br>
                        <span><?php echo $post['price'] ?></span>
                    </div>

                    <div class="buy-button">
                        <a href="order.php?itemId=<?php echo $post['id'] ?> "><button class="btn-buy-now"> Buy Now </button></a>
                    </div>
                    </div>
                </div>

            </div>
            

            <hr>
            <?php
                    } 
                ?>
            



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