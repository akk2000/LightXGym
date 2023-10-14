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
        $categoryError='';
        $priceError='';
        $instructorError='';

        if(isset($_POST['class_create_btn'])){
            $category = $_POST['category'];
            $price = $_POST['price'];
            $instructor = $_POST['instructor'];
            $insert_query = "INSERT INTO classes(category,price,instructor) VALUES('$category','$price','$instructor')";
            
            if(empty($category)){
                $categoryError = "Category field is required";
            }if(empty($price)){
                $priceError = "Price fields is required";
            }if(empty($instructor)){
                $instructorError = "Instructor fields is required";
            }

            if(!empty($category && $price && $instructor )){
                mysqli_query($db, $insert_query);
                $_SESSION["successMessage"] = "Class created Successfully";
                header("location:admin_classes.php");
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
                                <div class="card-title">Add Classes</div>
                            </div>
                            <div class="col-md-6">
                                <a href="classes.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="create_classes.php" method="POST">
                    <div class="card-body">                       
                            <div class="form-group">
                                <label for="">Category</label>
                                <input type="text" class="form-control <?php if(!empty($categoryError)) : ?>is-invalid <?php endif ?> " placeholder="Category" name="category" value ="">
                                <span class="text-danger"><?php echo $categoryError ?></span>
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" class="form-control <?php if(!empty($priceError)) : ?>is-invalid <?php endif ?> " placeholder="Price" name="price" value ="">   
                                <span class="text-danger"><?php echo $priceError ?></span>                           
                            </div>

                            <div class="form-group">
                                <label for="">Instructor</label>
                                <input type="text" class="form-control <?php if(!empty($instructorError)) : ?>is-invalid <?php endif ?> " placeholder="Instructor" name="instructor" value ="">   
                                <span class="text-danger"><?php echo $instructorError ?></span>                           
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="class_create_btn">Create</button>
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