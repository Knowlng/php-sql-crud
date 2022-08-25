<?php 
include("classes/shopDatabaseClass.php"); 
$shopDatabase = new ShopDatabase();
$shopDatabase->createProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <form method="POST">
        <input class="form-control" name="title" placeholder="Title">
        <input class="form-control" name="description" placeholder="Description">
        <input class="form-control" name="price" placeholder="Price">
        <input class="form-control" name="categoryID" placeholder="Category">
        <input class="form-control" name="imageURL" placeholder="Image">
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form>
</body>
</html>