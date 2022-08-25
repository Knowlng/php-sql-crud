<?php 
    include("classes/shopDatabaseClass.php"); 
    $categories = new ShopDatabase();
    // $products->deleteProduct();
    // $product=$products->selectOneProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1>Categories Main</h1>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <?php $categories->getCategories(); ?>
        </tr>
    </table>
</body>
</html>