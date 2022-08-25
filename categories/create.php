<?php 
include("classes/shopDatabaseClass.php"); 
$shopDatabase = new ShopDatabase();
$shopDatabase->createCategory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
    <form method="POST">
        <label>Category name</label>
        <input class="form-control" name="title">
        <label>Description</label>
        <input class="form-control" name="description">
        <button class="btn btn-primary mt-3" type="submit" name="submitCategory">Add</button>
    </form>
</body>
</html>