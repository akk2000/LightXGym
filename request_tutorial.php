<?php
    require "Admin/db_connect.php";
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

    <title>Request Tutorial</title>

    <style>
        body{
            margin:50px;
        }
    </style>
</head>
<body>
<?php
// get class applied id
    if(isset($_GET['classeAppliedId'])){
        $classeAppliedId = $_GET['classeAppliedId'];
        $post = mysqli_query($db, "SELECT * FROM class_apply WHERE id=$classeAppliedId");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $classeAppliedId = $row['id'];
                $username = $row['username'];
                $userId = $row['userId'];
                $category = $row['category'];
            }
        }
    }

    // update
    if(isset($_POST['request_btn'])){
        $classeAppliedId = $_POST['classeAppliedId'];
       $userName = $_POST['userName'];
       $userId = $_POST['userId'];
       $category = $_POST['category'];
        $Updatequery = "INSERT INTO request_ticket(classapplied_id,username,userid,category) VALUES($classeAppliedId,'$userName',$userId,'$category')";
            mysqli_query($db,$Updatequery);
            $_SESSION["successMessage"] = "Requested Tutorial Successfully!Please Kindly wait respond from Admin.";
            header('location:profile.php');
    }

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">Request Tutorial</div>
                            </div>
                            <div class="col-md-6">
                                <a href="profile.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="request_tutorial.php" method="POST">
                    <div class="card-body">                       
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $classeAppliedId ?>" name="classeAppliedId"><br>
                                <label for="">Username</label>
                                <input type="text" class="form-control" placeholder="Tutorial" name="userName" value ="<?php echo $username ?>"> 
                                <span class="text-danger">*This field cannot be changed!</span>                                                            
                            </div>

                            <div class="form-group">                               
                                <label for="">User Id</label>
                                <input type="text" class="form-control" placeholder="Tutorial" name="userId" value ="<?php echo $userId ?>">  
                                <span class="text-danger">*This field cannot be changed!</span>                                                              
                            </div>

                            <div class="form-group">                               
                                <label for="">Category</label>
                                <input type="text" class="form-control" placeholder="Tutorial" name="category" value ="<?php echo $category ?>">
                                <span class="text-danger">*This field cannot be changed!</span>                                                                
                            </div>
                             
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-danger" name="request_btn">Request</button>
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