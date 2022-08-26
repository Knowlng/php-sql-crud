<?php include("classes/shopDatabaseClass.php"); ?>
<?php 
$shopDatabase = new shopDatabase();  
$category=$shopDatabase->selectOneCategory();
$shopDatabase->editCategory();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label>Title</label>
        <input class="form-control" name="title" value="<?php echo $category[0]["title"]; ?>" placeholder="Title">
        <label>Description</label>
        <input class="form-control" name="description" value="<?php echo $category[0]["description"]; ?>" placeholder="Description">
        <button class="btn btn-primary mt-3" type="submit" name="editCategory">Update</button>
    </form>
</body>
</html>
