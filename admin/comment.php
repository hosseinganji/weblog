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
        <span class="h1">Comments</span>
        <hr>
        <?php
        $conn = new mysqli("localhost", "root", "", "weblog");
        if(isset($_GET["type"]) && isset($_GET["action"]) && isset($_GET["id"])){
            if($_GET["type"] == "comment"){
                if($_GET["action"] == "delete"){
                    $id = $_GET["id"];
                    $commentdelete = "DELETE FROM comment WHERE id = $id";
                    if ($conn->query($commentdelete) === TRUE) {
                        ?><div class="alert alert-success">comment deleted successfully</div><?php
                    }else{
                        echo "Error deleting record: " . $conn->error;
                    }
                }elseif($_GET["action"] == "confirm"){
                    $id = $_GET["id"];
                    $commentconfirm = "UPDATE comment SET status='1' WHERE id = $id";
                    if ($conn->query($commentconfirm) === TRUE) {
                        ?><div class="alert alert-success">comment confirm successfully</div><?php
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
        }
        ?>
        <div class="mb-3 bg-white rounded-3 px-4 pb-2 pt-4 part-dashboard last-comments">
            <h3>Last Comments</h3>
            <div class="table-responsive">
            <?php
                $comment = "SELECT id, date, name, comment, post_id status FROM comment";
                $commentquery = $conn->query($comment);
                if($commentquery->num_rows > 0){
            ?>
            <table class="table table-striped table-sm">
            <thead>
                <tr class="align-middle">
                <th class="col-md-1">Id</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-3">Comment</th>
                <th class="col-md-2">Date Created</th>
                <th class="col-md-4">Setting</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    foreach($commentquery as $row){
                ?>
                    <tr class="align-middle">
                    <td class="col-md-1"><?php echo $row["id"] ?></td>
                    <td class="col-md-2"><?php echo $row["name"] ?></td>
                    <td class="col-md-3"><?php echo $row["comment"] ?></td>
                    <td class="col-md-2"><?php echo $row["date"] ?></td>
                    <td class="col-md-4 text-end">
                    <?php if($row["status"] == 0){ ?>
                        <p class="btn btn-primary pe-none px-2 py-1 mx-1 my-0">Awaiting Confirmation</p>
                        <a href="comment?type=comment&action=confirm&id=<?php echo $row["id"] ?>" class="btn btn-outline-success px-2 py-1 mx-1" type="submit">Confirm</a>
                    <?php } ?>
                    <a href="comment?type=comment&action=delete&id=<?php echo $row["id"] ?>" class="btn btn-outline-danger px-2 py-1 mx-1" type="submit">Delete</a>
                    </td>
                    </tr>
                    <?php
                        }
                    }else{
                        ?>
                        <div class="alert alert-danger">
                            We not find a comment for confirmation
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
