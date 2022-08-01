<?php 
    require 'partials/_dbconnect.php'; 
    $showerr = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_GET['thread_id'];
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
        $userid = $_POST['id'];
        if(strlen($comment) > 2){
            $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `dt`) VALUES ( '$comment', '$id', $userid, current_timestamp())";
            $result = mysqli_query($conn, $sql);
        } else {
            $showerr = true;
        }

    }


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
       

</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php
     if ($showerr) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Please insert more characters.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
?>
    <?php
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `threads` WHERE thread_id =$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $comment_by = $row['thread_user_id'];
    $sql2 = "SELECT `uname` FROM `users` WHERE `user_id` = $comment_by;";
    $result2 = mysqli_query($conn, $sql2);  
    $row2 = mysqli_fetch_assoc($result2);
    echo '<div class="container my-4">
            <div class="jumbotron">
            <h1 class="display-6">'.$row['thread_title'].'</h1>
            <p class="lead">'.$row['thread_description'].'</p>
            <hr class="my-4">
           
            <p class="lead fw-bold">
                Posted By: '. $row2['uname'].'
            </p>
            </div>
            </div>';
?>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        echo '
        <div class="container discussions">
        <div class="row-gx-3">
        <div class="col-sm-3">
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
        <input name="id" type="hidden" value="'.$_SESSION['id'].'">
        <label for="comment" class="form-label">Post Your Comment</label>
        <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
        <div class="my-3">
        <button class="btn btn-success">Comment</button>
        </div>
        </form>
        </div>
        <hr>
        </div>
        ';
    }

    

?>
    <div class="container">
        <h2>Comments</h2>  
        <div class="container comments">    
    </div>
    <?php

    
    $sql = "SELECT * FROM `comments` WHERE thread_id =$id";
    $result = mysqli_query($conn, $sql);
    $comments = false;
    while($row = mysqli_fetch_assoc($result)){
        $comments = true;
        $comment_by= $row['comment_by'];
        $sql2 = "SELECT `uname` FROM `users` WHERE `user_id` = $comment_by;";
        $result2 = mysqli_query($conn, $sql2);  
        $row2 = mysqli_fetch_assoc($result2);
        $date= new DateTime($row['dt']);
        $comment_time = $date->format('d-M ,h:i');

        echo '
        <div class="media my-3 mx-2">
                <img class="mr-3" src="partials/img/user.png" width="50px" height="50px" alt="Generic placeholder image">
                <div class="media-body py-0"><b>'.$row2['uname'].' at '.$comment_time.'</b> <br>   
                '.$row['comment_content'].'
                </div>
                </div>
                ';
            }
            if(!$comments){
                echo '<p class="lead">&nbsp;&nbsp;No comments found start discussions by commenting';
            }
            if(!isset($_SESSION['loggedin'])){
                echo '<p class="lead">&nbsp;&nbsp;Login to start posting comments.';
            }
            
            ?>
            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <?php include 'partials/_footer.php'; ?>
</body>

</html>