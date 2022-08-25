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
        <label>Title</label>
        <input class="form-control" name="title">
        <label>Description</label>
        <input class="form-control" name="description">
        <label>Price</label>
        <input class="form-control" name="price" value="0">
        <label>Category</label>
        <select class="form-select" name="category_id">
        <?php foreach($shopDatabase->getCategories() as $category) { ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
            <?php } ?>
        </select>
        <label>Image</label>
        <input class="form-control" name="image_url">
        <button class="btn btn-primary mt-3" type="submit" name="submit">Add</button>
    </form>
</body>
</html>