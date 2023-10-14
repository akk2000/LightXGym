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
    if(isset($_GET['instructorId'])){
        $instructorIdToUpdate = $_GET['instructorId'];
        $post = mysqli_query($db, "SELECT * FROM instructor WHERE id=$instructorIdToUpdate");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $name = $row['name'];
                $age = $row['age'];
                $profession = $row['profession'];
            }
        }
    }
    $nameError= '';
    $ageError = '';
    $professionError = '';
    $imageError = '';
    if(isset($_POST['update_instructor_btn'])){
        $instructorId = $_POST['instructorId'];
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $name = $_POST['name'];
       $age = $_POST['age'];
       $profession = $_POST['profession'];
       move_uploaded_file($image_temp,"../upload/$image");
        $Updatequery = "UPDATE instructor SET photo='$image',name='$name', age='$age', profession='$profession' WHERE id = $instructorId";

        if(empty($name)){
            $nameError = "Name field is required";
        }if(empty($age)){
            $ageError = "Age fields is required";
        }if(empty($profession)){
            $professionError = "Professions fields is required";
        }if(empty($image)){
            $imageError = "Image fields is required";
        }

        if(!empty($name && $age && $profession && $image )){
            mysqli_query($db,$Updatequery);
            $_SESSION["successMessage"] = "Instructor Updated Successfully";
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
                                <div class="card-title">Instructor Update</div>
                            </div>
                            <div class="col-md-6">
                                <a href="admin_instructor.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="edit_instructor.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" name="instructorId" value="<?php echo $instructorIdToUpdate; ?>"> <br>

                                <label for="">Image</label>
                                <input type="file" class=" <?php if(!empty($imageError)) : ?>is-invalid <?php endif ?> " placeholder="" name="image" value ="<?php echo $image ?>">                                   
                                <span class="text-danger"><?php echo $imageError ?></span>
                            </div>
                                    
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control <?php if(!empty($nameError)) : ?>is-invalid <?php endif ?>" placeholder="Name" name="name" value =" <?php echo $name ?>">
                                <span class="text-danger"><?php echo $nameError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Age</label>
                                <input type="text" class="form-control <?php if(!empty($ageError)) : ?>is-invalid <?php endif ?>" placeholder="Age" name="age" value =" <?php echo $age ?>">
                                    <span class="text-danger"><?php echo $ageError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Profession</label>
                                <input type="text" class="form-control <?php if(!empty($professionError)) : ?>is-invalid <?php endif ?>" placeholder="Profession" name="profession" value =" <?php echo $profession ?>">
                                <span class="text-danger"><?php echo $professionError ?></span>
                                
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="update_instructor_btn">Update</button>
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