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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Classes</title>
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

    <!-- Classes -->
    <div class="container">
        <h3 class="text-center text-danger">All classess are 1 hour session.</h3> <br>
        
        <div class="container schedule">
            
            <div class="row">
                <div class="col-md-4">
                    <h2>Monday</h2>
                    9am - 10am <br>
                    1pm - 2pmbr <br>
                    4pm - 5pm <br>
                </div>

                <div class="col-md-4">
                    <h2>Tuesday</h2>
                    9am - 10am <br>
                    1pm - 2pmbr <br>
                    4pm - 5pm <br>
                </div>

                <div class="col-md-4">
                    <h2>Wendesday</h2>
                    9am - 10am <br>
                    1pm - 2pmbr <br>
                    4pm - 5pm <br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h2>Thursday</h2>
                    9am - 10am <br>
                    1pm - 2pmbr <br>
                    4pm - 5pm <br>
                </div>

                <div class="col-md-4">
                    <h2>Friday</h2>
                    9am - 10am <br>
                    1pm - 2pmbr <br>
                    4pm - 5pm <br>
                </div>

                <div class="col-md-4">
                    <h2>Saturday</h2>
                    9am - 10am <br>
                    1pm - 2pmbr <br>
                    4pm - 5pm <br>
                </div>
            </div>
        </div>

        <h2 class="text-danger text-center available-classes">Available classes</h2>
        
        <table class="table table-striped table-dark">
            <thead>
                <tr>
            
                    <th> Category </th>
                    <th>Price</th>
                    <th>Instructor</th>
                    <th>Apply</th>
                </tr>
            </thead>
    
            <tbody>
            <?php 
                $selectQuery = "SELECT * FROM classes";
                $result = mysqli_query($db,$selectQuery);
                foreach($result as $post){
             ?>
                <tr>
                <td><?php echo $post['category'] ?></td>
                <td><?php echo $post['price'] ?></td>
                <td><?php echo $post['instructor'] ?></td>
                    <td><a href="class_confirm.php?class_id=<?php echo $post['id']?>" class="apply" >Apply</a></td>
                </tr>
                <?php
                    } 
                ?>

            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer footer-classes">
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