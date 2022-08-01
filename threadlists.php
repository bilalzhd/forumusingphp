<?php require 'partials/_dbconnect.php'; ?>
<?php
$showerr = false;
$questionPosted = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_POST['id'];
    $id = $_GET['cat_id'];
    $title = $_POST['title'];
    $title = str_replace("<", "&lt;", $title);
    $title = str_replace(">", "&gt;", $title);
    $desc = $_POST['desc'];
    $desc = str_replace("<", "&lt;", $desc);
    $desc = str_replace(">", "&gt;", $desc);
    if (strlen($title) > 2 && strlen($desc) > 2) {
        $sql = "INSERT INTO `threads` ( `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `dt`) VALUES ( '$title', '$desc', '$id', '$user_id', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $questionPosted = true;
        }
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

</head>

<body>
    <?php include 'partials/_header.php';
    if ($questionPosted) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread has been inserted successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if ($showerr) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Warning!</strong> Please insert more characters.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <?php
    $id = $_GET['cat_id'];
    $sql = "SELECT * FROM `categories` WHERE cat_id =$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    echo '<div class="container my-4">
            <div class="jumbotron">
            <h1 class="display-4">This is ' . $row['cat_title'] . ' forum</h1>
            <p class="lead">' . $row['cat_desc'] . '</p>
            <hr class="my-4">
            <p>Forum Rules</p>
            <p>- Keep it friendly.
                - Be courteous and respectful.
                - Appreciate that others may have an opinion different from yours.
                - Stay on topic.
                - Share your knowledge.
                - Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
            
            </div>
            </div>';
    ?>


    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        echo '<div class="container my-2">
        <h2>Start a Discussion</h2>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
            <div class="mb-3 row g-3">
                <div class="col-sm-7">
                    <div class="col-sm">
                    <input name="id" type="hidden" value="' . $_SESSION['id'] . '">
                        <input placeholder="Thread Title" type="text" name="title" class="form-control" id="threadtitle"
                            aria-describedby="titlehelp">
                        <div id="titlehelp" class="form-text my-2">Try to keep the question as short and crisp as
                            possible
                        </div>
                    </div>
                    <div class="col-sm">

                        <textarea placeholder="Elaborate Your Problem" type="text" class="form-control" id="desc"
                            name="desc" rows="2"></textarea>
                    </div>
                    <div class="col-sm my-3">
                        <button type="submit" class="btn btn-success">Submit Thread</button>
                    </div>
                </div>

            </div>
        </form>';
    } else {
        echo '<div class="container">
        <p class="lead">Log in to start discussions.</p>
    </div>';
    }

    ?>

    <div class="container" style="min-height: 150px;">
        <h1>Browse Questions</h1>
        <br>


        <!-- -----------------------------------------PPHPHPHPHPHPHPHPHPHHPPHPHPHPHPH ----------- -->

        <?php
            $numrows = mysqli_num_rows($result);
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $numResult = 5;
                $numPages = ceil($numrows / $numResult);
                $startFrom = ($page - 1) * $numResult;
                $id = $_GET['cat_id'];
                $sql = "SELECT * FROM `threads` WHERE thread_cat_id =$id";
                $result = mysqli_query($conn, $sql);
                $sqli = "SELECT * FROM `threads` WHERE thread_cat_id = $id LIMIT $startFrom, $numResult";
                $resulti = mysqli_query($conn, $sqli);
                $noResult = true;
                while ($row = mysqli_fetch_assoc($resulti)) {
                    $noResult = false;
                    $thread_user_id = $row['thread_user_id'];
                    $sql2 = "SELECT `uname` FROM `users` WHERE `user_id` = $thread_user_id;";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    echo '<div class="media my-3">
                    <img class="mr-3" src="partials/img/user.png" width="50px" height="50px" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0"><a href="thread.php?thread_id=' . $row['thread_id'] . ' "class="text-dark">' . $row['thread_title'] . '</a></h5>
                        ' . $row['thread_description'] . '</div>
                        <p>Asked by: <b>' . $row2['uname'] . '</b></p>
                    </div>';
                }
                if ($noResult) {
                    echo '<p class="display-5">No Threads Found</p>
                <p class="lead">Be the first to ask a question</p>';
                }

            ?>

    </div>
    </div>
    </div>
    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link">Previous</a>
    </li>
    <?php
    if(isset($_GET['page'])){
        $currentpage = $_GET['page'];
    } else {
        $currentpage = 1;
    }
    $nextpage = $currentpage + 1;
    $numResult = 5;
    $numrow = mysqli_num_rows($result);
    $numPages = ceil($numrow / $numResult);
    for($i = 1; $i<=$numPages; $i++){
        echo '<li class="page-item"><a class="page-link" href="threadlists.php?cat_id='.$id.'&page='.$i.'">'.$i.'</a></li>';
    }
    ?>
    <li class="page-item">
        <?php
      echo '<a class="page-link" href="threadlists.php?cat_id='.$id.'&page='.$nextpage.'">Next</a>';
      ?>
    </li>
  </ul>
</nav>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <?php include 'partials/_footer.php'; ?>
</body>

</html>