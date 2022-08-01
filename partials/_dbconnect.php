<?php

    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'forum';
    $conn = mysqli_connect($server, $username, $password, $database);
    if(!$conn){
        echo 'The connection was not successful due to '. mysqli_connect_error();
    }




?>