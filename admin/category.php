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
    height: 100%;
}
html {
    height: 100%;
}
</style>
</head>
<body>

<?php
include("./header.php");
?>


<?php
include("./slidebar.php");
?>

<div style="width: 80%; height: 90%;" class="d-flex flex-column flex-shrink-0 p-3 overflow-auto float-end">
    <div class="px-3 pt-2">
        <div class="col-md-10">
            <span class="h1">Category</span>
        </div>
        <div class="col-md-2 float-end" style="margin-top: -30px;">
            <a href="new_category" class="btn btn-outline-success px-2 py-1" type="submit">Create New Category</a>
        </div>
        <hr>
        <?php
            $conn = new mysqli("localhost", "root", "", "weblog");
            if(isset($_GET["type"]) && isset($_GET["action"]) && isset($_GET["id"])){
                if($_GET["type"] = "category"){
                    $id = $_GET["id"];
                    $categorydelete = "DELETE FROM category WHERE id = $id";
                    if($conn->query($categorydelete) === TRUE){
                        ?><div class="alert alert-success">category deleted successfully</div><?php 
                    }else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
        ?>
        <div class="mb-3 bg-white rounded-3 px-4 pb-2 pt-4 part-dashboard categories">
            <div class="table-responsive">
            <?php
                $category = "SELECT id, title FROM category ORDER BY id";
                $categoryquery = $conn->query($category);
                if($categoryquery->num_rows > 0){
            ?>
            <table class="table table-striped table-sm">
            <thead>
                <tr class="align-middle">
                <th class="col-md-2">Id</th>
                <th class="col-md-8">Title</th>
                <th class="col-md-3">Setting</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        foreach($categoryquery as $row){
                ?>
                    <tr class="align-middle">
                    <td class="col-md-2"><?php echo $row["id"] ?></td>
                    <td class="col-md-8"><?php echo $row["title"] ?></td>
                    <td class="col-md-2">
                    <a href="./edit_category?id=<?php echo $row["id"] ?>" class="btn btn-outline-primary px-2 py-1 mx-2" type="submit">Edite</a>
                    <a href="category?type=category&action=delete&id=<?php echo $row["id"] ?>" class="btn btn-outline-danger px-2 py-1" type="submit">Delete</a>
                    </td>
                    </tr>
                <?php
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            We not find a category
                        </div>
                        <?php
                    }
                ?>
            </tbody>
            </table>
            </div>
        </div>

    </div>
</div>
    




</body>
</html>
