<?php 
    include("classes/shopDatabaseClass.php"); 
    $products = new ShopDatabase();
    $products->deleteProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <h1>Shop Main</h1>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
            <?php $products->getProducts("products"); ?>
        </tr>
    </table>
</body>
</html>