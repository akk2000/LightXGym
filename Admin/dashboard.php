<?php
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
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../style.css">
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
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li><br>
 
            </ul>

        </div>
    </div>

    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-danger text-center">WELCOME FROM ADMIN DASHBOARD</h1>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center text-danger">Admin Info</div>
                    </div>
                    <div class="card-body">
                        Current User :  <?php echo $_SESSION['user_array']['name'] ?><br>
                        Address : <?php echo $_SESSION['user_array']['address'] ?><br>
                        Role : <span class="badge badge-danger"><?php echo $_SESSION['user_array']['role'] ?><br></span><br>
                        Email : contact@lightXgym.com

                    </div>
                    <div class="card-footer">
                        <form action="../logout.php" method="GET">                   
                        <button class="btn btn-danger btn-sm float-right"  onclick="return confirm('Are you sure want to logout?');">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>
   