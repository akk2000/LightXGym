<?php
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

    <title>Register</title>
</head>
<style>
    .reg-form{
        margin-top:44px;
    }

</style>
<body>
<?php
    require 'admin/db_connect.php';

    $nameError='';
    $emailError='';
    $addressError='';
    $passwordError='';
    $confirmPasswordError='';

    if(isset($_POST['register_btn'])){

        $name = $_POST['name'];
        $email= $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if(empty($name)){
            $nameError ="Name Field is require";
        }if(empty($email)){
            $emailError ="Email Field is require";
        }if(empty($address)){
            $addressError ="Address Field is require";
        }if(empty($password)){
            $passwordError ="Password Field is require";
        }if(empty($confirmPassword)){
            $confirmPasswordError ="Confirm Password Field is require";
        }if($password != $confirmPassword){
            $confirmPasswordError ="Password is not match";
        }

        if(!empty($name && $email && $address && $password && $confirmPassword) && $password==$confirmPassword){
        $encrypted_password=md5($password);
        $insert_query = "INSERT INTO user(name,email,address,password) VALUES('$name','$email','$address','$encrypted_password')";
        mysqli_query($db,$insert_query);
        $_SESSION['successMessage'] = "Registered Successfully. Login Now!";
        header('location:login.php');
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
                            <h4 class="text-center">Register</h4>
                        </div>
                        <form action="register.php" method="POST">
                        <div class="card-body">
                            
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control <?php if(!empty($nameError)){ ?> is-invalid <?php }?>" name="name" value="<?php
                                            if(isset($_POST['register_btn']))
                                            echo $name; 
                                            ?>"  >
                                    <span><?php echo $nameError; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control <?php if(!empty($emailError)){ ?> is-invalid <?php }?>" name="email" value="<?php
                                            if(isset($_POST['register_btn']))
                                            echo $email; 
                                            ?>"  >
                                    <span><?php echo $emailError; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control <?php if(!empty($addressError)){ ?> is-invalid <?php }?>"><?php
                                            if(isset($_POST['register_btn']))
                                            echo $address; 
                                            ?></textarea>
                                    <span><?php echo $addressError; ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control <?php if(!empty($passwordError)){ ?> is-invalid <?php }?>" name="password">
                                    <span><?php echo $passwordError ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control <?php if(!empty($confirmPasswordError)){ ?> is-invalid <?php }?>" name="confirmPassword">
                                    <span><?php echo $confirmPasswordError ?></span>
                                </div>
                            
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" name="register_btn">Register</button>
                            <span class="float-right">If you already have account.
                                <a href="login.php">Login here</a>
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