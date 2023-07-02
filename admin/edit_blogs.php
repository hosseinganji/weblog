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
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>

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
<?php
    $conn = new mysqli("localhost", "root", "", "weblog");
    $id = $_GET["id"];
    $thispost = "SELECT * FROM posts WHERE id = $id";
    $thispost_query = $conn->query($thispost)->fetch_assoc();       
?>

<div style="width: 80%; height: 90%;" class="d-flex flex-column flex-shrink-0 p-3 overflow-auto float-end">
    <div class="px-3 pt-2">
        <h1 class="h1"><?php echo $thispost_query["title"] ?></h1>
        <hr>
        <form method="post"  enctype="multipart/form-data">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control mb-3"  value="<?php echo $thispost_query["title"] ?>" id="title" placeholder="Enter Title...">

                <label for="author" class="form-label">Aauthor</label>
                <input type="text" name="author" class="form-control mb-3"  value="<?php echo $thispost_query["author"] ?>" id="author" placeholder="Enter Author...">
                
                <label for="category" class="form-label">Category</label>
                <select name="category" class="form-select" aria-label="Default select example">
                    <option selected>Select Category...</option>
                    <?php
                        $category_data = "SELECT id, title FROM category";
                        $category_query = $conn->query($category_data);
                        foreach($category_query as $row){
                        ?>
                            <option value="<?php echo $row["id"] ?>" <?php if($row["id"] == $thispost_query["category_id"]){echo "selected";} ?>><?php echo $row["title"] ?></option>
                        <?php
                        }
                    ?>
                </select>

                <label for="body" class="form-label mt-3">Body</label>
                <textarea name="body" class="form-control mb-3" id="body" rows="5" placeholder="Enter Your Comment...">
                    <?php echo $thispost_query["body"] ?>
                </textarea>

                <div class="bg-white p-2 w-25 rounded-2 my-3" style="border: 1px solid #ced4da;">
                    <img class="w-100 mb-2 rounded-2" src="../upload/picture/<?php echo $thispost_query["img"] ?>">
                    <p class="m-0 text-center"><?php echo $thispost_query["img"] ?></p>
                </div>
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control mb-3" id="image">

                <input type="submit" value="Edit" class="btn btn-primary" name="submitnewcategory">
        </form>
<?php
    if(isset($_POST["submitnewcategory"])){
        if(trim($_POST["title"]) != "" && trim($_POST["author"]) != "" && trim($_POST["category"]) != "" && trim($_POST["body"]) != ""){
            $title = isset($_POST["title"]) ? $_POST["title"] : "";
            $author = isset($_POST["author"]) ? $_POST["author"] : ""; 
            $category_id = isset($_POST["category"]) ? $_POST["category"] : ""; 
            $body = isset($_POST["body"]) ? $_POST["body"] : "";
            $image_name = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
            $image_tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"] : "";
            if($image_name == ""){

            }else{
                if(move_uploaded_file($image_tmp , "../upload/picture/$image_name")){
                }else{
                    echo "Please choose a picture";
                }
                $uploadimage = "UPDATE posts SET img='$image_name' WHERE id=$id";
                $conn->query($uploadimage);
            }

            $updatepost = "UPDATE posts SET title='$title' , category_id='$category_id' , author='$author' , body='$body' WHERE id = $id";
            if($conn->query($updatepost) === TRUE){
                echo "success";
            }else{
                echo $conn->error;
            }
            }else{
                echo "all of the fildes neccessery";
        }
    }
?>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("body");
</script>

</body>
</html>







