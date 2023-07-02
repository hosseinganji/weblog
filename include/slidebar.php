<?php
$conn = new mysqli("localhost", "root", "", "weblog");


$categories = "SELECT id, title FROM category";
$lastidquerys = $conn->query($categories);



?>


<div class="d-flex flex-column flex-shrink-0 p-3 bg-white rounded-2 shadow-sm m-auto">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none m-auto">
      <span class="fs-4 fw-bold">Sidebar</span>
    </a>
    <hr>
    <h3 class="h5 mb-3 fw-normal">Categories</h3>

    <ul class="nav nav-pills flex-column mb-auto">
      
    <?php
      while($category = $lastidquerys->fetch_assoc()){
          foreach($lastidquerys as $category){
    ?>


    <li class="nav-item">
        <a href="index.php?category=<?php echo $category["id"]?>" class="nav-link <?php echo(isset($_GET['category']) && $_GET['category'] == $category["id"] ? "active" : "link-dark");?>" aria-current="page">
          <?php echo $category["title"]?>
        </a>
      </li>

    <?php
      }
    }
    ?>


    </ul>
    <hr>
  <form method="post">
    <h3 class="h5 mb-3 fw-normal">Get Our New News</h3>
    <div class="form-floating mt-2 mb-2">
      <input name="fullname" type="text" class="form-control" id="fullname" placeholder="Full Name">
      <label for="floatingPassword">Full Name</label>
    </div>
    <div class="form-floating mt-2 mb-2">
      <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <input name="subscribe" id="submit" class="w-100 btn btn-lg btn-primary" value="Send"></input>
  </form>



  <?php
  if(isset($_POST["subscribe"])){
    echo "cristiano";
    if(trim($_POST['fullname']) != "" || trim($_POST['email']) != ""){
      $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
      $email = isset($_POST['email']) ? $_POST['email'] : '';

      $lastid = "SELECT id FROM subscribers ORDER BY id DESC LIMIT 1";
      $lastidquery = $conn->query($lastid);

      if ($lastidquery->num_rows > 0) {
        while($row = $lastidquery->fetch_assoc()) {
          $lastidchoos = $row["id"]+1;
          $insertsubs = "INSERT INTO subscribers (id, fullname, email)
          VALUES ('$lastidchoos', '$fullname', '$email')";

          $conn->query($insertsubs);

          // if ($conn->query($insertsubs) === TRUE) {
          //   echo "New record created successfully";
          //   $_POST = array();
            
          //   // $conn->close();
          // } else {
          //   echo "<script>alert('Error');<script>";
          // }
          
        }
      } else {
        echo "0 results";
      }
    }else{
      echo "field(s) is empty";
    }
  }


// if(isset($_POST["subscribe"])){
//   if(trim($_POST['fullname']) != "" || trim($_POST['email']) != ""){
//     $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
//     $email = isset($_POST['email']) ? $_POST['email'] : '';
      
//     $subsinsert = $conn->prepare("INSERT INTO subscribers (fullname , email) VALUES (:fullname , :email)");
//     $subsinsert->execute(['fullname' => $fullname, 'email' => $email]);
//   }else{
//     echo "empty";
//   }
// }

    


?>




    <hr>
    <h3 class="h5 mb-3 fw-normal">About Us</h3>
    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
  </div>