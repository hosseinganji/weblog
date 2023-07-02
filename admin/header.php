<?php
session_start(); 
if( ! isset($_SESSION['email'])){
  header("Location:signin?err_msg=please sign in first");
  exit();
}
?>  


<nav class="navbar navbar-expand-lg navbar-light bg-white" style="box-shadow: 0 0 10px #ccc; height: 10%;">
  <div class="container-fluid px-5">
    <a class="navbar-brand" href="http://localhost/weblog/admin" style="width: 4%;">
        <img class="w-100" src="../img/benz.jpg" alt="">
        <span class="mx-2 fw-bold">Mercedes Benz</span>
    </a>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarSupportedContent">
        <a href="logout.php" class="btn btn-outline-primary" type="submit">Sign Out</a>
    </div>
  </div>
</nav>


