<?php 
    include("classes/shopDatabaseClass.php"); 
    $settings = new ShopDatabase();
    $settings->deleteSetting();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
</head>
<body>
    <h1>Settings</h1>
    <form class="GET">
        <a href='index.php?page=createSetting' class='btn btn-primary mt-3 mb-3'>Create</a>
    </form>
    <table class="table table-striped">
        <tr>
        <th class="text-nowrap">ID</th>
            <th class="text-nowrap">Value</th>
            <th class="text-nowrap">Name</th>
            <th>Actions</th>
            <?php $settings->displaySettings(); ?>
        </tr>
    </table>
</body>
</html>