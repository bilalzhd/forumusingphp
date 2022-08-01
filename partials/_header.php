<?php
session_start();
echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Corums</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu">';
        $sql = "Select * from categories limit 3";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          echo '
            <li><a class="dropdown-item" href="/forum/threadlists.php?cat_id='.$row['cat_id'].'">'.$row['cat_title'].'</a></li>';
        }
        
          
        echo '</ul>
      </li>
      </ul> 
      <div d-flex flex-row justify-content-center >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <form autocomplete="off" class="d-flex" role="search" action="search.php" method="get">
        <input autocomplete="false"  class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button></form>
        ';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
      echo'<p class="text-light align-self-center my-0 mx-1">Welcome '.$_SESSION['username'].'</p>
      <a class="btn btn-outline-success ml-2" href="logout.php">Logout</a>';
    } else {
  echo ' 
  <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
  <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
}
  echo '</div>
</div>
</ul>
</div>  

</nav>';
  require 'partials/_loginModal.php';
  require 'partials/_signupModal.php';

?>