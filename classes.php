<?php
require "Admin/db_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/icon">
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
                    <td><a href="" class="apply">Apply</a></td>
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
</body>
</html>