<?php
$conn = new mysqli("localhost", "root", "", "weblog");
$categories = "SELECT id, title FROM category";
$results = $conn->query($categories);
?>




<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-fluid px-5">
    <a class="navbar-brand" href="http://localhost/weblog" style="width: 4%;">
        <img class="w-100" src="./img/benz.jpg" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
    <?php
      while($category = $results->fetch_assoc()){
          foreach($results as $category){
    ?>
        
        <li class="nav-item">
          <a class="nav-link <?php echo(isset($_GET['category']) && $_GET['category'] == $category["id"] ? "active" : "");?>" aria-current="page" href="index.php?category=<?php echo $category["id"]?>">
          <?php echo $category["title"]?>
        </a>
        </li>

    <?php
      }
    }
    ?>
        
      </ul>
      <form class="d-flex" method="get" action="search">
        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
      <?php
        if(isset($_GET["name_search"])){

          $search = isset($_GET['search']) ? $_GET['search'] : '';


        }
        ?>
    </div>
  </div>
</nav>