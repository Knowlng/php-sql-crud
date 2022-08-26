<?php 
    include("classes/shopDatabaseClass.php"); 
    $categories = new ShopDatabase();
    $categories->deleteCategory();
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
            <th>ID
            <form method="POST" class="d-inline">
                    <input type='hidden' name='ascID' value="ASC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitAscID">∧</button>
                </form>
                <form method="POST" class="d-inline">
                    <input type='hidden' name='descID' value="DESC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitDescID">∨</button>
                </form>
            </th>
            <th>Title
            <form method="POST" class="d-inline">
                    <input type='hidden' name='ascTitle' value="ASC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitAscTitle">∧</button>
                </form>
                <form method="POST" class="d-inline">
                    <input type='hidden' name='descTitle' value="DESC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitdescTitle">∨</button>
                </form>
            </th>
            <th>Description
            <form method="POST" class="d-inline">
                    <input type='hidden' name='ascDesc' value="ASC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitAscDesc">∧</button>
                </form>
                <form method="POST" class="d-inline">
                    <input type='hidden' name='descDesc' value="DESC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitDescDesc">∨</button>
                </form>
            </th>
            <th>Actions</th>
            <?php $categories->displayCategories("categories", "id", "ASC"); ?>
        </tr>
    </table>
</body>
</html>