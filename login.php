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

    <title>Login</title>
</head>
<style>
    .reg-form{
        margin-top:44px;
    }

</style>
<body>
<?php
    $errorMessage= '';
    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $select_query = "SELECT * FROM user WHERE email='$email' AND password='$password'";

        $user = mysqli_query($db,$select_query);
        $user_count = mysqli_num_rows($user);

        if($user_count === 1){
            $user_array = mysqli_fetch_assoc($user);
            $_SESSION['user_array'] = $user_array;
            if($user_array['role'] == 'user'){
                header('location:login_index.php');    
            }else{
                header('location:admin/dashboard.php');
            }
            
        }else{
            $errorMessage = "Invalid Username or Password";
        }
    }
?>
    <!-- navigation -->
    <div class="loginpage-logo">
        <img src="img/logo.png" alt="" class="logoimg img-fluid">
    </div>

    <!-- Register form -->
    
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card reg-form">

                        <div class="card-header">
                            <h4 class="text-center">Login</h4>
                        </div>
                    <form action="login.php" method="POST">
                        <div class="card-body">

                    <?php 
                        if(!empty($errorMessage)): 
                    ?>

                        <div class="alert alert-danger alert-dismissible show" role="alert">
                        <?php 
                        echo $errorMessage;                
                        ?>
                        <button type="button" class="close" data-dismiss="alert">  
                            <span>&times;</span>
                        </button>
                        </div>
                    <?php endif ?>
                                                        
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
                    
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>                               

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                            
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" name="login_btn">Login</button>
                            <span class="float-right">If you do not have account.
                                <a href="register.php">register here</a>
                            </span>
                        </div>
                    </form>

                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>