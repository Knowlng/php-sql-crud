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
        <th class="text-nowrap">ID
                <form method="POST" class="d-inline 
                    <?php 

                        if(isset($_POST["submitDescID"])) {
                        $hidden = "d-none";
                        echo $hidden;
                        }

                        if(isset($show)) {
                            echo $show; 
                        }

                    ?>">
                    <input type='hidden' name='descID' value="DESC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitDescID">∨</button>
                </form>
                <?php 
                    if(isset($_POST["submitDescID"])) {
                ?>
                <form method="POST" class="d-inline
                <?php

                if(isset($_POST["submitAscID"])) {
                    $show = "d-inline";
                    $hidden = "d-none";
                }

                if(isset($show)) {
                    echo $show; 
                }
            
                ?>">
                    <input type='hidden' name='ascID' value="ASC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitAscID">∧</button>
                </form>
                <?php } ?>
            </th>
            <th class="text-nowrap">Title
                <form method="POST" class="d-inline 
                    <?php 

                        if(isset($_POST["submitDescTitle"])) {
                        $hidden = "d-none";
                        echo $hidden;
                        }

                        if(isset($show)) {
                            echo $show; 
                        }

                    ?>">
                    <input type='hidden' name='descTitle' value="DESC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitDescTitle">∨</button>
                </form>
                <?php 
                    if(isset($_POST["submitDescTitle"])) {
                ?>
                <form method="POST" class="d-inline
                <?php

                if(isset($_POST["submitAscTitle"])) {
                    $show = "d-inline";
                    $hidden = "d-none";
                }

                if(isset($show)) {
                    echo $show; 
                }
            
                ?>">
                    <input type='hidden' name='ascTitle' value="ASC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitAscTitle">∧</button>
                </form>
                <?php } ?>
            </th>
            <th class="text-nowrap">Description
                <form method="POST" class="d-inline 
                    <?php 

                        if(isset($_POST["submitDescDesc"])) {
                        $hidden = "d-none";
                        echo $hidden;
                        }

                        if(isset($show)) {
                            echo $show; 
                        }

                    ?>">
                    <input type='hidden' name='descDesc' value="DESC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitDescDesc">∨</button>
                </form>
                <?php 
                    if(isset($_POST["submitDescDesc"])) {
                ?>
                <form method="POST" class="d-inline
                <?php

                if(isset($_POST["submitAscDesc"])) {
                    $show = "d-inline";
                    $hidden = "d-none";
                }

                if(isset($show)) {
                    echo $show; 
                }
            
                ?>">
                    <input type='hidden' name='ascDesc' value="ASC">
                    <button class="btn btn-link btn-sm text-decoration-none" type="submit" name="submitAscDesc">∧</button>
                </form>
                <?php } ?>
            </th>
            <th>Actions</th>
            <?php $categories->displayCategories("categories", "id", "ASC"); ?>
        </tr>
    </table>
</body>
</html>