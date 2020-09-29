<?php
    $server = "localhost";
    $server_name = "root";
    $pass = "";
    $db_name = "basic_crud";

    $db = mysqli_connect($server,$server_name,$pass,$db_name);

    if($db == false){
        die("ERROR:" . mysqli_connect_error($db));
    }

?>