<?php
      $fullname = $_POST["fullname"];
      $email = $_POST["email"];
      $subscribers = "SELECT fullname, email FROM subscribers";
      $subsquery = $conn->query($subscribers);
      if($subsquery->num_rows > 0){
        $sqlvalue = "INSERT INTO subscribers (fullname) VALUES ('$fullname' , '$email')";
      }

?>