<?php
$login = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $existSql = "select * from `users` where `user_email` = '$email'";
    $result = mysqli_query($conn, $existSql);
    $num = mysqli_num_rows($result);
    if ($num==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['user_password'])){
            $uname = $row['uname'];
            $id = $row['user_id'];
            $login = true;  
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $uname;
            $_SESSION['id'] = $id;
            header('location: /forum/index.php?login=true');
        } else {
            header('location: /forum/index.php?login=false&error=true');
        } 
    } else {
        header('location: /forum/index.php?login=false&error=true');
    }
}