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

    <title>Order</title>

    <style>
        body{
            margin:50px;
        }
    </style>
</head>
<body>
<?php
// get class applied id
    if(isset($_GET['itemId'])){
        $itemId = $_GET['itemId'];
        $post = mysqli_query($db, "SELECT * FROM inventory WHERE id=$itemId");

        if(mysqli_num_rows($post) == 1){
            foreach($post as $row){
                $itemId = $row['id'];
                $itemTitle = $row['item_title'];
                $price = $row['price'];
            }
        }
    }

    // update
    if(isset($_POST['order_btn'])){
        $itemId = $_POST['itemId'];
       $userId = $_POST['userId'];
       $itemTitle = $_POST['itemTitle'];
       $price = $_POST['price'];
       $shippingAddress = $_POST['shippingAddress'];
        $Updatequery = "INSERT INTO item_order(userId,itemId,itemtitle,price,shippingaddresss) VALUES($userId,$itemId,'$itemTitle','$price','$shippingAddress')";
            mysqli_query($db,$Updatequery);
            $_SESSION["successMessage"] = "Order Confirmed! Shop more items.";
            header('location:gallary.php');
    }

?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">Order Confirmation</div>
                            </div>
                            <div class="col-md-6">
                                <a href="gallary.php" class="float-right btn btn-secondary"> << Back</a>
                            </div>
                        </div>
                    </div>
                <form action="order.php" method="POST">
                    <div class="card-body">     
                    <?php 
                        $userId = $_SESSION['user_array']['id'];
                    ?>                  
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $itemId ?>" name="itemId"><br>
                                <input type="hidden" value="<?php echo $userId ?>" name="userId"><br>
                                <label for="">Item Title</label>
                                <input type="text" class="form-control" placeholder="Item" name="itemTitle" value ="<?php echo $itemTitle ?>">  
                                <span class="text-danger">*This field cannot be changed!</span>                                                                                           
                            </div>

                            <div class="form-group">                               
                                <label for="">Price</label>
                                <input type="text" class="form-control" placeholder="Price" name="price" value ="<?php echo $price ?>">  
                                <span class="text-danger">*This field cannot be changed!</span>                                                              
                            </div>   

   
                            <div class="form-group">                               
                                <label for="">Shipping Address</label>
                                <textarea name="shippingAddress" class="form-control" placeholder="Shipping Address" ></textarea>                                                                
                            </div>                        
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-danger" name="order_btn">Confirm Order</button>
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