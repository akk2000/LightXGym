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
// get class applied id
    if(isset($_GET['classapply_id'])){
        $classapply_id = $_GET['classapply_id'];
        $post = mysqli_query($db, "SELECT * FROM class_apply WHERE id=$classapply_id");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $tutorial = $row['tutorial'];
            }
        }
    }

    // update
    if(isset($_POST['add_tuto_btn'])){
        $classapply_id = $_POST['classapply_id'];
       $tutorial = $_POST['tutorial'];
        $Updatequery = "UPDATE class_apply SET tutorial='$tutorial' WHERE id = $classapply_id";
            mysqli_query($db,$Updatequery);
            $_SESSION["successMessage"] = "Tutorial added Successfully";
            header('location:admin_classes_apply.php');
    }

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">Add tutorial</div>
                            </div>
                            <div class="col-md-6">
                                <a href="admin_classes_apply.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="edit_addTuto.php" method="POST">
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $classapply_id ?>" name="classapply_id"><br>
                                <label for="">Tutorial</label>
                                <input type="text" class="form-control" placeholder="Tutorial" name="tutorial" value ="">                                                             
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" name="add_tuto_btn">Add</button>
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