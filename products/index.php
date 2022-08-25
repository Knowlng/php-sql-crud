<?php 
    include("classes/shopDatabaseClass.php"); 
    $products = new ShopDatabase();
    $products->deleteProduct();
    $product=$products->selectOneProduct();
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
    <form method="POST">
    <select class="form-select" name="category_id">
    <option value="`categories`.`id`">All</option>
            <?php foreach($products->getCategories() as $category) { ?>
                <option <?php if (isset($_POST["category_id"]) && $_POST["category_id"]==$category['id']) echo "selected";?> value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
            <?php } ?>
        </select>
        <button class="btn btn-primary mt-3 mb-3" type="submit" name="filter">Filter</button>
    </form>
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
            <?php $products->getProducts("products"); ?>
        </tr>
    </table>
</body>
</html>