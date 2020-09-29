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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title">Post List</div>
                            </div>
                            <div class="col-md-6">
                                <a href="post-create.php" class="float-right btn btn-primary"> + Add Post</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>123</td>
                                    <td>sdafsdfsdf</td>
                                    <td>123dsafsdfsf</td>
                                    <td>
                                        <a href="">Edit</a> | <a href="">Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>123</td>
                                    <td>sdafsdfsdf</td>
                                    <td>123dsafsdfsf</td>
                                    <td>
                                        <a href="">Edit</a> | <a href="">Delete</a>
                                    </td>
                                </tr>

                                <tr>    
                                    <td>123</td>
                                    <td>sdafsdfsdf</td>
                                    <td>123dsafsdfsf</td>
                                    <td>
                                        <a href="">Edit</a> | <a href="">Delete</a>
                                    </td>
                                </tr>
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