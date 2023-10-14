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
    if(isset($_GET['postId'])){
        $postIdToUpdate = $_GET['postId'];
        $post = mysqli_query($db, "SELECT * FROM classes WHERE id=$postIdToUpdate");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $category = $row['category'];
                $price = $row['price'];
                $instructor = $row['instructor'];
            }
        }
    }
    $categoryError= '';
    $priceError = '';
    $instructorError = '';
    if(isset($_POST['update_class_btn'])){
        $postId = $_POST['postId'];
        $category = $_POST['category'];
       $price = $_POST['price'];
       $instructor = $_POST['instructor'];
        $Updatequery = "UPDATE classes SET category='$category', price='$price', instructor='$instructor' WHERE id = $postId";

        if(empty($category)){
            $categoryError = "Category field is required";
        }if(empty($price)){
            $priceError = "Price fields is required";
        }if(empty($instructor)){
            $instructorError = "Instructor fields is required";
        }

        if(!empty($category && $price && $instructor )){
            mysqli_query($db,$Updatequery);
            $_SESSION["successMessage"] = "Class Information Updated Successfully";
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
                                <div class="card-title">Classes Update</div>
                            </div>
                            <div class="col-md-6">
                                <a href="classes.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="edit_classes.php" method="POST">
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" name="postId" value="<?php echo $postIdToUpdate; ?>"> <br>
                                <label for="">Category</label>
                                <input type="text" class="form-control <?php if(!empty($categoryError)) : ?>is-invalid <?php endif ?>" placeholder="Category" name="category" value =" <?php echo $category ?>">
                                <span class="text-danger"><?php echo $categoryError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" class="form-control <?php if(!empty($priceError)) : ?>is-invalid <?php endif ?>" placeholder="Price" name="price" value =" <?php echo $price ?>">
                                    <span class="text-danger"><?php echo $priceError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Instructor</label>
                                <input type="text" class="form-control <?php if(!empty($instructorError)) : ?>is-invalid <?php endif ?>" placeholder="Price" name="instructor" value =" <?php echo $instructor ?>">
                                <span class="text-danger"><?php echo $instructorError ?></span>
                                
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="update_class_btn">Update</button>
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