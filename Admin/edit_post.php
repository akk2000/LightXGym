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
        $post = mysqli_query($db, "SELECT * FROM posts WHERE id=$postIdToUpdate");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $image = $row['image'];
                $author = $row['author'];
                $content = $row['content'];
            }
        }
    }
    $imageError='';
    $authorError='';
    $contentError='';
    if(isset($_POST['update_post_btn'])){
        $postId = $_POST['postId'];
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $author = $_POST['author'];
        $content = $_POST['content'];
        move_uploaded_file($image_temp,"../upload/$image");
        $Updatequery = "UPDATE posts SET image='$image', author='$author', content='$content' WHERE id = $postId";

        if(empty($image)){
            $imageError = "Image field is required";
        }if(empty($author)){
            $authorError = "Author fields is required";
        }if(empty($content)){
            $contentError = "Content fields is required";
        }

        if(!empty($image && $author && $content )){
            mysqli_query($db, $Updatequery);
            $_SESSION["successMessage"] = "Post updated Successfully";
            header("location:admin_posts.php");
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
                                <a href="admin_posts.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="edit_post.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" name="postId" value="<?php echo $postIdToUpdate; ?>"> <br>
                                
                                <label for="">Image</label>
                                <input type="file" class=" <?php if(!empty($imageError)) : ?>is-invalid <?php endif ?> " placeholder="" name="image" value ="<?php echo $image ?>">                                   
                                <span class="text-danger"><?php echo $imageError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Author</label>
                                <input type="text" class="form-control <?php if(!empty($authorError)) : ?>is-invalid <?php endif ?> " placeholder="Author" name="author" value ="<?php echo $author ?>"> 
                                    
                                    <span class="text-danger"><?php echo $authorError ?></span>
                                
                            </div>

                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="content" class="form-control <?php if(!empty($contentError)) : ?>is-invalid <?php endif ?> " placeholder="Content"><?php echo $content ?></textarea> 
                                    
                                <span class="text-danger"><?php echo $contentError ?></span>
                                
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="update_post_btn">Update</button>
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