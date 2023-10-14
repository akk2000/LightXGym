<?php
    require "db_connect.php";
    session_start();

    if(!isset($_SESSION['user_array'])){
        header("location:../login.php");
    }else{
        if($_SESSION['user_array']['role'] != 'admin'){
            header('location:../login_index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Admin Dashboard</title>

    <style>
        body{
            margin:50px;
        }
    </style>
</head>
<body>
<?php
    //Delete USER
    if(isset($_GET['user_id_to_update'])){
        $user_id_to_update = $_GET['user_id_to_update'];
        $post = mysqli_query($db, "SELECT * FROM user WHERE id=$user_id_to_update");

        if($post){
            $user_array = mysqli_fetch_assoc($post);  
        }
    }
    
    //UPDATE USER
    if(isset($_POST['update_user_btn'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $user_result = mysqli_query($db,"SELECT * FROM user WHERE id = $id");
        $user = mysqli_fetch_assoc($user_result);

        if($user['password'] != $password){
            $new_password = md5($password);
        }else{
            $new_password = $password;
        }
        $Updatequery = "UPDATE user SET name='$name', email='$email', address='$address', password = '$new_password', role = '$role' WHERE id = $id";
         if($Updatequery){
            mysqli_query($db, $Updatequery);
            $_SESSION["successMessage"] = "User Data updated Successfully";
            header("location:admin_users.php");
         }else{
             Die('Error:' . mysqli_error($db));
         }           
    }

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">User Update</div>
                            </div>
                            <div class="col-md-6">
                                <a href="admin_users.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="edit_user.php" method="POST">

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
                                <label for="">Password</label>
                                <input type="text" class="form-control" value="<?php echo $user_array['password'] ?>" name="password">                                
                            </div>

                            <div class="form-group">
                            <label for="">Role</label><br>
                                <select name="role" id="" class="form-control">
                                    <option value="None">None</option>
                                    <option value="admin" <?php if($user_array['role'] == 'admin'): ?> selected <?php endif ?>>admin</option>
                                    <option value="user" <?php if($user_array['role'] == 'user'): ?> selected <?php endif ?>>user</option>
                                </select>                                                  
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="update_user_btn">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>