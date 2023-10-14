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
    if(isset($_GET['itemId'])){
        $itemIdToUpdate = $_GET['itemId'];
        $post = mysqli_query($db, "SELECT * FROM inventory WHERE id=$itemIdToUpdate");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $image = $row['item_image'];
                $title = $row['item_title'];
                $price = $row['price'];
            }
        }
    }


    $imageError='';
    $titleError='';
    $priceError='';
    if(isset($_POST['update_item_btn'])){
        $itemId = $_POST['itemId'];

        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];       
        $title = $_POST['title'];
        $price = $_POST['price'];
        move_uploaded_file($image_temp,"../upload/$image");
        
        $Updatequery = "UPDATE inventory SET item_image='$image', item_title='$title', price='$price' WHERE id = $itemId";

        if(empty($image)){
            $imageError = "Image field is required";
        }if(empty($title)){
            $titleError = "Title fields is required";
        }if(empty($price)){
            $priceError = "Price fields is required";
        }

        if(!empty($image && $title && $price )){
            mysqli_query($db, $Updatequery);
            $_SESSION["successMessage"] = "Item was updated Successfully";
            header("location:inventory.php");
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
                                <div class="card-title">Item Update</div>
                            </div>
                            <div class="col-md-6">
                                <a href="inventory.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="edit_item.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" name="itemId" value="<?php echo $itemIdToUpdate; ?>"> <br>

                                <label for="">Image</label>
                                <input type="file" class=" <?php if(!empty($imageError)) : ?>is-invalid <?php endif ?> " placeholder="" name="image" value ="<?php echo $image ?>">                                   
                                <span class="text-danger"><?php echo $imageError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control <?php if(!empty($titleError)) : ?>is-invalid <?php endif ?> " placeholder="Author" name="title" value ="<?php echo $title ?>"> 
                                    
                                    <span class="text-danger"><?php echo $titleError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Price</label>
                                <textarea name="price" class="form-control <?php if(!empty($priceError)) : ?>is-invalid <?php endif ?> " placeholder="Price"><?php echo $price ?></textarea> 
                                    
                                <span class="text-danger"><?php echo $priceError ?></span>
                                
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="update_item_btn">Update</button>
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