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
    <title>Blog</title>
    <style>
        .footer-fixed{
            position:fixed;
            bottom:0;
        }
    </style>
</head>
<body>

<?php
    // fetching user array
    $user_id = $_SESSION['user_array']['id'];
    $query = "SELECT * FROM user WHERE id = $user_id";

    $result = mysqli_query($db,$query);

    if($result){
        $user_array = mysqli_fetch_assoc($result);      
    }

    // update user
    if(isset($_POST['update_user_btn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $user_result = mysqli_query($db,"SELECT * FROM user WHERE id = $id");
        $user = mysqli_fetch_assoc($user_result);

        if($user['password'] != $password){
            $new_password = md5($password);
        }else{
            $new_password = $password;
        }

        $Updatequery = "UPDATE user SET name='$name', email='$email', address='$address', password = '$new_password' WHERE id = $id";
         if($Updatequery){
            mysqli_query($db, $Updatequery);
            $_SESSION["successMessage"] = "User updated Successfully";
            header("location:profile.php");
         }else{
             Die('Error:' . mysqli_error($db));
         }           
    }

    // delete
    if(isset($_GET['item_id_to_delete'])){
        $item_id_to_delete = $_GET['item_id_to_delete'];
        $deleteQuery = "DELETE FROM item_order WHERE id = $item_id_to_delete";
        mysqli_query($db,$deleteQuery);
        $_SESSION["successMessage"] = "Order was canceled Successfully";
        header('location:profile.php');
    }

    if(isset($_GET['classapply_id_to_delete'])){
        $classapply_id_to_delete = $_GET['classapply_id_to_delete'];
        $deleteQuery = "DELETE FROM class_apply WHERE id = $classapply_id_to_delete";
        mysqli_query($db,$deleteQuery);
        $_SESSION["successMessage"] = "Class was canceled Successfully";
        header('location:profile.php');
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

<!-- Profile -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    <div class="card-title text-center">Your Profile</div>
                    </div>
                    <div class="card-body">
                        Current User :  <?php echo $user_array['name'] ?>  <br>
                        Address : <?php echo $user_array['address'] ?> <br>
                        Role : <span class="badge badge-danger"><?php echo $user_array['role'] ?><br></span><br>
                        Email : <?php echo $user_array['email'] ?> 
                    </div>
                    <div class="card-footer">
                        <a href="profile.php?user_id_to_update=<?php echo $user_array['id'] ?> "><button class="btn btn-success float-right" name="update_profile_btn">Update Your Profile</button></a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
            <?php if(isset($_GET['user_id_to_update'])): ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update Your Information</div>
                    </div>
                    <form action="profile.php" method="POST">
                        <div class="card-body">

                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $user_array['id'] ?>"> <br>
                            </div>

                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" placeholder="" name="name" value ="<?php echo $user_array['name'] ?>">                                     
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" placeholder="" name="email" value ="<?php echo $user_array['email'] ?>"> 
                            </div>

                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" class="form-control " placeholder=""><?php echo $user_array['address'] ?></textarea> 
                            </div>

                            <div class="form-group">
                                
                                <input type="hidden" class="form-control" placeholder="" name="password" value ="<?php echo $user_array['password'] ?>">                                     
                            </div>


                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" name="update_user_btn">Update</button>
                        </div>
                    </form>
                </div>
            <?php endif ?>
            </div>
        </div> 
                <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Your Classes</div>
                    </div>
                    <div class="card-body">
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
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Instructor</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th>Tutorial</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                $userID = $_SESSION['user_array']['id'];
                                $selectQuery = "SELECT * FROM class_apply WHERE userId =$userID";
                                $result = mysqli_query($db,$selectQuery);
                                foreach($result as $post){
                                ?>
                                    <tr>
                                        <td><?php echo $post['category'] ?></td>
                                        <td><?php echo $post['price'] ?></td>
                                        <td><?php echo $post['instructor'] ?></td>
                                        <td><?php echo $post['time'] ?></td>                                       
                                        <td><?php echo $post['date'] ?></td>
                                        <td>
                                            <a href="<?php echo $post['tutorial'] ?>" target="_blank"><?php echo $post['tutorial'] ?></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-sm"><a href="request_tutorial.php?classeAppliedId=<?php echo $post['id']; ?>" style="color:white;">Request Online Tutorial</a></button> | 
                                            <a href="profile.php?classapply_id_to_delete=<?php echo $post['id']; ?>" onclick="return confirm('Are you Sure want to delete?')" style="color:red;">Cancel your applied class</a>
                                        </td>
                                    </tr>
                                <?php
                                } 
                                ?>
                                    
                                </tbody>
                        </table>
                    </div>
                    
                </div>

                <hr>

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Ordered Items</div>
                    </div>
                    <div class="card-body">
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
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Title</th>
                                        <th>Unit</th>
                                        <th>Price</th>
                                        <th>Shipping Address</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                $userID = $_SESSION['user_array']['id'];
                                $selectQuery = "SELECT * FROM item_order WHERE userId =$userID";
                                $result = mysqli_query($db,$selectQuery);
                                foreach($result as $post){
                                ?>
                                    <tr>
                                        <td><?php echo $post['itemId'] ?></td>
                                        <td><?php echo $post['itemtitle'] ?></td>
                                        <td><?php echo $post['unit'] ?></td>
                                        <td><?php echo $post['price'] ?></td>                                       
                                        <td><?php echo $post['shippingaddresss'] ?></td>
                                        <td><?php echo $post['date'] ?></td>
                                        <td>
                                             <a href="edit_order.php?orderId=<?php echo $post['id'];?>"  style="color:red;">Edit</a> |
                                            <a href="profile.php?item_id_to_delete=<?php echo $post['id']; ?>" onclick="return confirm('Are you Sure want to delete?')" style="color:red;">Cancel your Order</a>
                                        </td>
                                    </tr>
                                <?php
                                } 
                                ?>
                                    
                                </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>           
    </div>
<!-- Footer -->
<div class="footer " >
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