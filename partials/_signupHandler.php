<?php
$passError = false;
$emailError = false;
$alert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['signupemail'];
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $existSql = "select * from `users` where `user_email` = '$email' and `uname` = '$uname'";
    $result = mysqli_query($conn, $existSql);
    $num = mysqli_num_rows($result);
    if($num>0){
        $emailError = true;
        header('location: /forum/index.php?signup=false');
    } else {
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `uname`, `user_password`, `timestamp`) VALUES ( '$email', '$uname', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                $alert = true;
                header('location: /forum/index.php?signup=true');
            }
        } else {
            $passError = true;
            header('location: /forum/index.php?signup=false');
        }
    }

}




?>