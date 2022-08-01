<?php require 'partials/_dbconnect.php'; ?>
<?php include 'partials/_header.php'; ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<style>
  .ques{
    min-height: 75.5vh;
  }
</style>

<body>
  <?php
    $query = $_GET['query'];
    echo '<div class="container my-3 ques">
    <h2 class="text-center">Search Results for <em>"'.$query .'"</em></h1>
    <div class="d-flex flex-row flex-wrap mb-3">';
    $sql = "SELECT * FROM `threads` where match (`thread_title`, `thread_description`) against ('$query');";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)){
      $title = $row['thread_title']; 
      $desc = $row['thread_description'];
      echo '<div class="row-md-4 mx-2">
              <div class="card my-4" style="width: 16rem;">
                <div class="card-body">
                  <h5 class="card-title">'.$title.'</h5>
                  <p class="card-text">'.substr($desc, 0, 50).'...</p>
                  <a href="thread.php?thread_id='.$row['thread_id'].'" class="btn btn-primary">View Threads</a>
                </div>
              </div>
              </div>';
      }
      if($num<1){
        echo '<h3 class="display-6 my-3">No results found for your search <b>'.$_GET['query'].'</b></h3><br>
        <div class="container">
        <p class="lead">Suggestions:</p>
        <div class="container"> 
        <ul>
        <li class="lead">Make sure that all words are spelled correctly.</ li>
        <li class="lead">Try different keywords.</li>
        <li class="lead">Try more general keywords.</li>
        </ul>
        </div>
        </div>';
      }
    
    ?>
    </div>
    </div>
 


  
      
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <?php include 'partials/_footer.php'; ?>
</body>

</html>