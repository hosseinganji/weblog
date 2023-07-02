


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />


<style>
body {
    background: #eee;
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: #000;
    margin: 0;
    padding: 0;
}

</style>
</head>
<body>


<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white" style="box-shadow: 0 0 10px #ccc; height: 70px;">
  <div class="container-fluid px-5">
    <a class="navbar-brand" href="http://localhost/weblog/admin" style="width: 4%;">
        <img class="w-100" src="../img/benz.jpg" alt="">
        <span class="mx-2 fw-bold">Mercedes Benz</span>
    </a>
  </div>
</nav>




<?php

if(isset($_POST["signin"])){
    if(trim($_POST["email"]) != "" && trim($_POST["password"]) != ""){
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $conn = new mysqli("localhost", "root", "", "weblog");  
        $signin = "SELECT email , password FROM admin_users WHERE email='$email' AND password='$password'";
        $signinquery = $conn->query($signin);
        if($signinquery->num_rows == 1){
            foreach($signinquery as $row){                
                $_SESSION["email"] = $email;
                header("Location:index.php");
                exit();
            }
        }else{
            ?><div class="alert alert-danger m-3">Email or Password Incorrect</div><?php 
        }
    }else{
        ?><div class="alert alert-danger m-3">Email or Password Empty</div><?php
    }
}

?>




<div style="width: 100%; height: 90%;" class="d-flex flex-column flex-shrink-0 p-3 overflow-auto float-end">
    <div class="px-3 pt-2">
        <main class="form-signin m-auto text-center w-25 p-3 rounded-3 bg-white mt-5">
            <form method="post">
                <h2 class="h2 mb-3 fw-normal mb-4 mt-2">Sign in</h2>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-4">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>
                <button name="signin" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
                <p class="mt-4 mb-2 text-muted">© 2017–2022</p>
            </form>
        </main>
    </div>
</div>






</body>
</html>







