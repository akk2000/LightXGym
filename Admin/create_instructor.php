<?php
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
        require "db_connect.php";
        $nameError='';
        $ageError='';
        $professionError='';
        $imageError = '';

        if(isset($_POST['instructor_create_btn'])){
            $image = $_FILES['image']['name'];
            $image_temp = $_FILES['image']['tmp_name'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $profession = $_POST['profession'];
            move_uploaded_file($image_temp,"../upload/$image");

            $insert_query = "INSERT INTO instructor(photo,name,age,profession) VALUES('$image','$name','$age','$profession')";
            
            if(empty($name)){
                $nameError = "Name field is required";
            }if(empty($age)){
                $ageError = "Age fields is required";
            }if(empty($profession)){
                $professionError = "Profession fields is required";
            }if(empty($image)){
                $imageError = "Image fields is required";
            }

            if(!empty($name && $age && $profession && $image )){
                mysqli_query($db, $insert_query);
                $_SESSION["successMessage"] = "Instructor created Successfully";
                header("location:admin_instructor.php");
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
                                <div class="card-title">Add Instructor</div>
                            </div>
                            <div class="col-md-6">
                                <a href="admin_instructor.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="create_instructor.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">    
                            <div class="form-group">
                                <label for="">Image</label><br>
                                <input type="file" class=" <?php if(!empty($imageError)) : ?>is-invalid <?php endif ?> " placeholder="" name="image" value ="">
                                <span class="text-danger"><?php echo $imageError ?></span>
                            </div>    

                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" value ="">
                                <span class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Age</label>
                                <input type="text" class="form-control " placeholder="Age" name="age" value ="">   
                                <span class="text-danger"></span>                           
                            </div>

                            <div class="form-group">
                                <label for="">Profession</label>
                                <input type="text" class="form-control  " placeholder="Profession" name="profession" value ="">   
                                <span class="text-danger"></span>                           
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="instructor_create_btn">Create</button>
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