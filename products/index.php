<?php 
    include("classes/shopDatabaseClass.php"); 
    $products = new ShopDatabase();
    $products->deleteProduct();
    $products->addRandomProducts();
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
    <div class="d-flex justify-content-between">
        <h1 class="d-inline">Shop Main</h1>
        <form class="d-flex justify-content-end align-items-center" method="POST">
            <label class="me-2">Create new random rows (max 150)</label>
            <input class="form-control w-25 d-inline" name="quantity">
            <button class="btn btn-primary d-inline ms-2" type="submit" name="createRandom">Create</button>
        </form>
    </div>
    <form class="d-flex justify-content-end align-items-center" method="GET">
        <input class="form-control w-25 d-inline me-2 mb-3" name="searchInput" placeholder="<?php if(isset($_GET["search"]) && $_GET["searchInput"]!=""){ echo $_GET["searchInput"];}else {echo "Product name";}?>">
        <button class="btn btn-primary d-block mb-3" type="submit" name="search">Search</button>
    </form>
    <form method="GET">
        <select class="form-select mb-3" name="category_id">
        <option value=" ">All</option>
        <option <?php if (isset($_GET["category_id"]) && $_GET["category_id"]=="none") echo "selected";?> value="none">No Category</option>
            <?php foreach($products->getCategories() as $category) { ?>
                <option <?php if (isset($_GET["category_id"]) && $_GET["category_id"]==$category['id']) echo "selected";?> value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
            <?php } ?>
        </select>
        <?php foreach($products->getSettings() as $setting) { ?>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="pageLimit" value="<?php echo $setting["value"];?>" id="<?php echo $setting["value"];?>" <?php if(isset($_GET["pageLimit"]) && $_GET["pageLimit"]==$setting["value"]) echo "checked";?>>
            <label class="form-check-label" for="<?php echo $setting["id"];?>"><?php echo $setting["name"];?></label>
        </div>
        <?php } ?>
        <button class="btn btn-primary mt-3 mb-3" type="submit" name="filter">Filter</button>
    </form>
    <?php $products->getPagination("1","1");?>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th class="text-nowrap">Price (€)</th>
                <th class="text-nowrap">Category
                    <form method="POST" class="d-inline
                        <?php 

                            if(isset($_POST["descendingSubmit"])) {
                            $hidden = "d-none";
                            echo $hidden;
                            }

                            if(isset($show)) {
                                echo $show; 
                            }

                        ?>">
                        <input type='hidden' name='descending' value="DESC">
                        <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="descendingSubmit">∨</button>
                    </form>
                    <?php 
                        if(isset($_POST["descendingSubmit"])) {
                    ?>
                    <form method="POST" class="d-inline
                        <?php

                        if(isset($_POST["ascendingSubmit"])) {
                            $show = "d-inline";
                            $hidden = "d-none";
                        }

                        if(isset($show)) {
                            echo $show; 
                        }
                    
                        ?>">
                        <input type='hidden' name='ascending' value="ASC">
                        <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="ascendingSubmit">∧</button>
                    </form>
                    <?php } ?>
                </th>
                <th>Image</th>
                <th>Actions</th>
                <?php $products->getProducts(); ?>
            </tr>
        </table>
    </div>
    <?php $products->getPagination("1","0");?>
</body>
</html>