<?php 
    session_start();
    require "db_connect.php";
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
                $title = $row['title'];
                $desc = $row['description'];
            }
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
                                <div class="card-title">Post Creation</div>
                            </div>
                            <div class="col-md-6">
                                <a href="index.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="post-create.php" method="POST">
                    <div class="card-body">                       
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control <?php if(!empty($titleError)) : ?>is-invalid <?php endif ?>" placeholder="Title" name="title" value ="<?php echo $title ?> ">
                                
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control <?php if(!empty($descError)) :?> is-invalid <?php endif ?> " placeholder="Description.."><?php echo $desc ?></textarea>
                                
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="post_create_btn">Create</button>
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