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
        <h1 class="h1">Edit Category</h1>
        <hr>
        <?php
            $id = $_GET["id"];
            $conn = new mysqli("localhost", "root", "", "weblog");
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if(isset($_POST["editcategory"])){
                    if(trim($_POST['categoryname']) != ""){
                        $namecategory = isset($_POST['categoryname']) ? $_POST['categoryname'] : '';
                        $sql = "UPDATE category SET title='$namecategory' WHERE id=$id";
                        if ($conn->query($sql) === TRUE) {
                        ?><div class="alert alert-success">Category Update Successfuly</div><?php
                        } else {
                        echo "Error updating record: " . $conn->error;
                        }
                    }else{
                        echo "field is empty";
                    }
                }
            }
            $editcategory = "SELECT id, title FROM category WHERE id = $id";
            $editcategoryquery = $conn->query($editcategory)->fetch_assoc();
        ?>
        <form method="post">
                <label for="categoryname" class="form-label">Category Name</label>
                <input type="text" name="categoryname" class="form-control mb-3" id="categoryname" value="<?php echo $editcategoryquery["title"] ?>">
                <input type="submit" value="Update" class="btn btn-primary" name="editcategory">
        </form>
    </div>
</div>

</body>
</html>







