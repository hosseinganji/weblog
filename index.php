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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>

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

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .swiper {
        margin-left: auto;
        margin-right: auto;
      }
    </style>
</head>
<body>

<?php
  include("./include/header.php")
?>

<?php
  include("./include/slider.php")
?>


<div class="col-lg-11 m-auto">

<div class="col-lg-3 py-5" style="float:left;">
  <?php
    include("./include/slidebar.php")
  ?>
</div>

<div class="col-lg-9" style="float: right;">
<div class="album py-5">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
<?php
$i = 0;
if(isset($_GET["category"])){
  $conn = new mysqli("localhost", "root", "", "weblog");
  $post = "SELECT id, title, category_id, body, author, img FROM posts";
  $results = $conn->query($post);
  if($results->num_rows > 0){

    while($row = $results->fetch_assoc()){
      $catid = $row["category_id"];
      
      $categoryid = "SELECT * FROM category WHERE id=$catid";
      $post_category = $conn->query($categoryid)->fetch_assoc();
      
      if($post_category['id'] == $_GET["category"]){
        $i++;
?>
      <div class="col">
          <div class="card shadow-sm">
          <img src="./upload/picture/<?php echo $row["img"] ?>" alt="">

            <div class="card-body">
            <h5 class="h5 fw-bold card-title">
              <?php echo $row["title"]; ?>
            </h5> 
              <p class="card-text m-0">
              <?php
                $partofbody = substr($row["body"] , 0 , 120) . "...";
                $digestofbody = preg_replace( "/\r|\n/", "", $partofbody );
                 echo $digestofbody;
                 ?>
              </p>
              <small class="text-writer mb-2 mt-1 d-block">
                  <span class="fw-bold">Writer: </span>
                  <span class="writer-card">
                    <?php echo $row["author"]; ?>
                  <span>
                </small>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a href="./single?post=<?php echo $row["id"] ?>" class="btn btn-sm btn-outline-primary">View</a>
                </div>
                <div class="my-2">
                  <span style="font-size: 13px;" class="category-name bg-secondary text-white py-1 my-2 px-2 rounded-5">
                    <?php echo $post_category['title']; ?>
                </span>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php
      }
    }
  }
}elseif(!(isset($_GET["category"]))){
  $conn = new mysqli("localhost", "root", "", "weblog");
  $post = "SELECT id, title, category_id, body, author, img FROM posts";
  $results = $conn->query($post);
  if($results->num_rows > 0){
    while($row = $results->fetch_assoc()){
      $catid = $row["category_id"];
      
      $categoryid = "SELECT * FROM category WHERE id=$catid";
      $post_category = $conn->query($categoryid)->fetch_assoc();
      $i++;
      // if(!(isset($_GET["category"]))){


?>
      <div class="col">
          <div class="card shadow-sm">
          <img src="./upload/picture/<?php echo $row["img"] ?>" alt="">

            <div class="card-body">
            <h5 class="h5 fw-bold card-title">
              <?php echo $row["title"]; ?>
            </h5> 
              <p class="card-text m-0">
                <?php
                $partofbody = substr($row["body"] , 0 , 120) . "...";
                $digestofbody = preg_replace( "/\r|\n/", "", $partofbody );
                 echo $digestofbody;
                 ?>
              </p>
              <small class="text-writer mb-2 mt-1 d-block">
                  <span class="fw-bold">Writer: </span>
                  <span class="writer-card">
                    <?php echo $row["author"]; ?>
                  <span>
                </small>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="./single?post=<?php echo $row["id"] ?>" class="btn btn-sm btn-outline-primary">View</a>
                </div>
                <div class="my-2">
                  <span style="font-size: 13px;" class="category-name bg-secondary text-white py-1 my-2 px-2 rounded-5">
                    <?php echo $post_category['title']; ?>
                </span>
                </div>
              </div>
            </div>
          </div>
        </div>

<?php
    }
  }
// }


}
if($i == 0){
  ?>
  <div class="fw-bold alert alert-danger mx-3 w-100">
    We can't find any blog
  </div>
  <?php
}



?>






        </div>
    </div>
  </div>
 </div>
</div>


<?php
  include("./include/footer.php")
?>






</body>
</html>