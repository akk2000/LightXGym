<?php

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Confirm Class Apply</title>

    <style>
        body{
            margin:50px;
        }
    </style>
</head>
<body>
    <?php
        require "Admin/db_connect.php";
        // getting userId from class page
        if(isset($_GET['class_id'])){
            $class_id = $_GET['class_id'];
            $post = mysqli_query($db, "SELECT * FROM classes WHERE id=$class_id");
    
            if(mysqli_num_rows($post) == 1){
                foreach($post as $row){
                    $userid = $row['id'];
                    $category = $row['category'];
                    $price = $row['price'];
                    $instructor = $row['instructor'];
                }
            }
        }

        // insert data to db
        $imageError='';
        $authorError='';
        $contentError='';

        if(isset($_POST['confirm_btn'])){

           $userId= $_POST['userId'];
           $userName = $_POST['userName'];
           $classId = $_POST['classId'];
           $category = $_POST['category'];
           $price = $_POST['price'];
           $instructor = $_POST['instructor'];
           $time = $_POST['time'];
           $date = $_POST['date'];
 
            $insert_query = "INSERT INTO class_apply(userId,username,classId,category,price,instructor,time,date) VALUES($userId,'$userName',$classId,'$category','$price','$instructor','$time','$date')";


                mysqli_query($db, $insert_query);
                $_SESSION["successMessage"] = "Your confirmed the class Successfully";
                header("location:classes.php");
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">Confirm Class Apply Process</div>
                            </div>
                            <div class="col-md-6">
                                <a href="classes.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="class_confirm.php" method="POST" >
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="userId" value ="<?php echo $_SESSION['user_array']['id'] ?>">  
                                               
                                <input type="hidden" class="form-control"  name="userName" value ="<?php echo $_SESSION['user_array']['name']  ?>">  

                                <input type="hidden" class="form-control"  name="classId" value ="<?php echo $class_id  ?>">       
                            </div>

                            <div class="form-group">
                                <label for="">Category</label><br>
                                
                                <input type="text" class="form-control"  name="category" value ="<?php echo $category  ?>" > 
                                <span class="text-danger">This Field Cannot be changed!</span>                          
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" class="form-control"  name="price" value ="<?php echo $price  ?>" > 
                                <span class="text-danger">This Field Cannot be changed!</span>                          
                            </div>

                            <div class="form-group">
                                <label for="">Instructor</label>
                                <input type="text" class="form-control"  name="instructor" value ="<?php echo $instructor  ?> "  > 
                                <span class="text-danger">This Field Cannot be changed!</span>                           
                            </div>

                            <div class="form-group">
                                <label for="">Time</label>
                                <select name="time" class="form-control">
                                    <option >Choose one</option>
                                    <option >9am - 10am</option>
                                    <option>1pm - 2pm</option>
                                    <option>4pm - 5pm</option>
                                </select>                           
                            </div>

                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" class="form-control"  name="date" value ="<?php echo $instructor  ?>"> 
                                <span class="text-danger"><?php echo $contentError ?></span>                           
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="confirm_btn">Confirm </button>
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