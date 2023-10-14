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
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <link rel="stylesheet" href="../style.css">


    <title>Admin Dashboard</title>

    <style>
        .table-content{
            margin:50px;
        }
    </style>
</head>
<body>
<div id="wrapper">

<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="dashboard.php">Dashboard</a>
                </li>              
                <li>
                    <a href="admin_posts.php">Posts</a>
                </li>
                <li>
                    <a href="admin_classes.php">Classes</a>
                </li>
                <li>
                    <a href="inventory.php">Inventory</a>
                </li>
                <li>
                    <a href="admin_users.php">Users</a>
                </li>
                <li>
                    <a href="admin_adv_articles.php">Advanced Articles</a>
                </li>
                <li>
                    <a href="admin_feedback.php">Feedback</a>
                </li>
                <li>
                    <a href="admin_contact.php">Contact Info</a>
                </li>
                <li>
                    <a href="admin_instructor.php">Instructor</a>
                </li>
                <li>
                    <a href="admin_classes_apply.php">Applied Classes</a>
                </li>
                <li>
                    <a href="admin_req_ticket.php">Requested Tickets</a>
                </li>
                <li>
                    <a href="admin_order.php">Orders</a>
                </li>
            </ul>
        </div>
</div>

<!-- <script>
("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});
</script> -->
<?php
    if(isset($_GET['ticket_id_to_delete'])){
        $ticket_id_to_delete = $_GET['ticket_id_to_delete'];
        $deleteQuery = "DELETE FROM request_ticket WHERE id = $ticket_id_to_delete";
        mysqli_query($db,$deleteQuery);
        $_SESSION["successMessage"] = "A ticket was deleted Successfully";
        header('location:admin_req_ticket.php');
    }
?>
    <div class="container content">
        <div class="row">
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">Requested Tickets</div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                    <?php if(isset($_SESSION['successMessage'])): ?>
                    <div class="alert alert-success alert-dismissible show" role="alert">
                        <?php 
                        echo  $_SESSION["successMessage"];     
                        unset ($_SESSION["successMessage"]);                
                        ?>
                        <button type="button" class="close" data-dismiss="alert">  
                            <span>&times;</span>
                        </button>
                    </div>
                    <?php endif ?>
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Class Applied ID</th>
                                    <th>User Name</th>
                                    <th>User Id</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                            $selectQuery = "SELECT * FROM request_ticket";
                            $result = mysqli_query($db,$selectQuery);
                            foreach($result as $post){
                            ?>
                                <tr>
                                    <td><?php echo $post['id'] ?></td>
                                    <td><?php echo $post['classapplied_id'] ?></td>
                                    <td><?php echo $post['username'] ?></td>
                                    <td><?php echo $post['userid'] ?></td>
                                    <td><?php echo $post['category'] ?></td>
                                    <td>                                       
                                        <a href="admin_req_ticket.php?ticket_id_to_delete=<?php echo $post['id']; ?>" onclick="return confirm('Are you Sure want to delete?')" >Delete</a>
                                    </td>
                                </tr>
                            <?php
                            } 
                            ?>
                                
                            </tbody>
                     </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>