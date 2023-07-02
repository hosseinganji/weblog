<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">


    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />
    <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />

    <!-- Demo styles -->
    <style>
      .card.shadow-sm img {
    border-radius: 5px 5px 0 0;
}

      html,
      body {
        position: relative;
        height: 100%;
      }

      body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
      }

      .swiper {
        width: 100%;
        height: 100%;
      }

    </style>
</head>
<body>

<?php
  include("./include/header.php")
?>

<div class="col-lg-11 m-auto">

<div class="col-lg-3 py-5" style="float:left;">
    <?php
        include("./include/slidebar.php")
    ?>
</div>

<div class="col-lg-9 my-5" style="float: right;">        
       


<?php
$i = 0;
$conn = new mysqli("localhost", "root", "", "weblog");
$thispost = $_GET["post"];
$posts_id = "SELECT * FROM posts WHERE id = $thispost";
$post_content = $conn->query($posts_id)->fetch_assoc();

if(isset($post_content)){
  $i++;
?>


<!-- blog content start -->
<div class="col-lg-11 m-auto bg-white rounded-2 shadow-sm p-3"> 
  <div class="rounded-2">
    <img src="./upload/picture/<?php echo $post_content["img"] ?>" alt="" class="w-100 rounded-2">
        </div>
        <div class="mt-3">
            <div class="col-lg-8 float-start" style="height:50px;">
              <h2 class="fw-bold title-blogs"><?php echo $post_content["title"] ?></h2>
            </div>
            <div class="col-lg-4 float-end" style="height:46px; margin-top: 4px;">
              <span class="category-name bg-primary text-white py-1 px-2 rounded-5 float-end">
                <?php
                  $catid = $post_content["category_id"];
                  $categoryid = "SELECT id, title FROM category WHERE id=$catid";
                  $post_category = $conn->query($categoryid)->fetch_assoc();
                  echo $post_category["title"];                
                ?>
              </span>
            </div>  
            <div>
              <hr>
            </div>

            <div class="customer-writed">
            <hr>
              <?php echo $post_content["body"] ?>
            </div>
            <p class="fw-bold">
                <span>Writter:</span>
                <span><?php echo $post_content["author"] ?></span>
            </p>
            <hr>
            <h3>Comment</h3>
            <form method="post">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="namecomment" class="form-control mb-3" id="name" placeholder="Enter Your Name...">
                <label for="comment" class="form-label">Comment Text</label>
                <textarea name="comment" class="form-control mb-3" id="comment" rows="5" placeholder="Enter Your Comment..."></textarea>
                <input type="submit" value="Send" class="btn btn-primary" name="submitcomment"></input>
            </form>

            <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
               if(isset($_POST["submitcomment"])){
                if(trim($_POST['namecomment']) != "" || trim($_POST['comment']) != ""){
                  $namecomment = isset($_POST['namecomment']) ? $_POST['namecomment'] : '';
                  $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
                  $postidcomment = $post_content["id"];
                  $date = date("Y-m-d");
                  $commentdata = "INSERT INTO comment (name, comment, post_id, date)
                  VALUES ('$namecomment', '$comment', '$postidcomment', '$date')";
                  $conn->query($commentdata);
                }else{
                  echo "field(s) is empty";
                }
              }
            }


            
            }elseif($i == 0){

              ?>

                <div class="w-100 mx-3 alert alert-danger">
                  We can't find a blog
                </div>

              <?php

            }
            
            ?>

            <hr>
          
            <h6>number of comment: 
              <?php 
                $poatidrow = $post_content["id"];
                $rowcomment = "SELECT * FROM comment WHERE status = 1 AND post_id = $poatidrow ";
                $row_comment = $conn->query($rowcomment);
                echo $row_comment->num_rows;   
              ?>
            </h6>

            <?php
              $comment = "SELECT * FROM comment";
              $result = $conn->query($comment);
              while($row = $result->fetch_assoc()){
                if($row["post_id"] == $post_content["id"]){
                  if($row["status"] == 1){
            ?>
            <div class="col-md-12">
              <div style="background: #eee;" class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                  <h4 class="mb-0 fw-bold"><?php echo $row["name"] ?></h4>
                  <div class="mb-1 text-muted"><?php echo $row["date"] ?></div>
                  <p class="mb-auto"><?php echo $row["comment"] ?></p>
                </div>
              </div>
            </div>
            <?php
                }
              }
            }

            ?>


        </div>
    </div>
</div>
</div>


<?php
  include("./include/footer.php")
?>

</body>
</html>