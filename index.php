<?php require 'partials/_dbconnect.php'; ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include 'partials/_header.php'; ?>
  <?php
    if(isset($_GET['signup']) && $_GET['signup'] == "true"){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> You can login now.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      ';
    }
    if(isset($_GET['login']) && $_GET['login'] == "true"){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> You are logged in now.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      ';
    }
    if(isset($_GET['error']) && $_GET['error'] == "true"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Error!</strong> Invalid Credentials.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
      ';
    }
?>
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="partials/img/1.jpg" height="380px" width="200px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="partials/img/c-2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="partials/img/2.jpg" height="380px" width="200px" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


  <div class="container">
    <h2 class="display-6 my-3">iDiscuss Categories</h2>
    
    <hr>
    <div class="d-flex flex-row flex-wrap mb-3">
      <?php
      $sql = "SELECT * FROM `categories`";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        $title = $row['cat_title'];
        $desc = $row['cat_desc'];
        echo '<div class="row-md-4 mx-2">
                <div class="card my-4" style="width: 16rem;">
                  <img src="https://source.unsplash.com/400x300/?'.$title.',coding" class="card-img-top" alt="" height="200px" width="200px">
                  <div class="card-body">
                    <h5 class="card-title">'.$row['cat_title'].'</h5>
                    <p class="card-text">'.substr($row['cat_desc'], 0, 74).'...</p>
                    <a href="threadlists.php?cat_id='.$row['cat_id'].'" class="btn btn-primary">View Threads</a>
                  </div>
                </div>
                </div>';
        }
      
      ?>
      </div>
  </div>
</div>
</div>
  <?php include 'partials/_footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  

</body>

</html>