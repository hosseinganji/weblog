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
<div style="width: 80%; height: 90%;" class="d-flex flex-column flex-shrink-0 p-3 overflow-auto float-end">
    <div class="px-3 pt-2">
        <h1 class="h1">Create New Post</h1>
        <hr>
        <?php
            $conn = new mysqli("localhost", "root", "", "weblog");
        ?>


        <form method="post"  enctype="multipart/form-data">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control mb-3" id="title" placeholder="Enter Title...">

                <label for="author" class="form-label">Aauthor</label>
                <input type="text" name="author" class="form-control mb-3" id="author" placeholder="Enter Author...">
                
                <label for="category" class="form-label">Category</label>
                <select name="category" class="form-select" aria-label="Default select example">
                    <option selected>Select Category...</option>
                        <?php
                        $category_data = "SELECT id, title FROM category";
                        $category_query = $conn->query($category_data);
                        foreach($category_query as $row){
                        ?>
                            <option value="<?php echo $row["id"] ?>"><?php echo $row["title"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                <label for="body" class="form-label mt-3">Body</label>
                <textarea name="body" class="form-control mb-3" id="body" rows="5" placeholder="Enter Your Comment..."></textarea>

                    
                <label for="image" class="form-label mt-3">Image</label>
                <input type="file" name="image" class="form-control mb-3" id="image">

                <input type="submit" value="Create" class="btn btn-primary" name="submitnewcategory">
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
                if(move_uploaded_file($image_tmp , "../upload/picture/$image_name")){
                }else{
                    echo "Please choose a picture";
                }
            $post_data = "INSERT INTO posts (title, category_id, body, author, img)
            VALUES ('$title' , '$category_id' , '$body' , '$author', '$image_name')";
                if($conn->query($post_data) === TRUE){
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







