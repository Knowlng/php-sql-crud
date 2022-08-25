<?php include("classes/shopDatabaseClass.php"); ?>
<?php 
$shopDatabase = new shopDatabase();  
$product=$shopDatabase->selectOneProduct();
$shopDatabase->editProduct();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label>Title</label>
        <input class="form-control" name="title" value="<?php echo $product[0]["title"]; ?>" placeholder="Title">
        <label>Description</label>
        <input class="form-control" name="description" value="<?php echo $product[0]["description"]; ?>" placeholder="Description">
        <label>Price</label>
        <input class="form-control" name="price" value="<?php echo $product[0]["price"]; ?>"  placeholder="Price">
        <label>Category</label>
        <select class="form-select" name="category_id">
            <?php foreach($shopDatabase->getCategories() as $category) { ?>
                <?php if($product[0]["category_id"] == $category["id"]) { ?>
                    <option value="<?php echo $category['id']; ?>" selected><?php echo $category['title']; ?></option>
                <?php }  else {?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
        <label>Image</label>
        <input class="form-control" name="image_url" value="<?php echo $product[0]["image_url"]; ?>"  placeholder="Image">
        <button class="btn btn-primary mt-3" type="submit" name="edit">Update</button>
    </form>
</body>
</html>
