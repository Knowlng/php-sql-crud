<?php 
include("classes/shopDatabaseClass.php"); 
$shopDatabase = new ShopDatabase();
$shopDatabase->createSetting();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Settings</title>
</head>
<body>
    <form method="POST">
        <label>Products per page</label>
        <input class="form-control" name="value">
        <label>Setting name</label>
        <input class="form-control" name="name">
        <button class="btn btn-primary mt-3" type="submit" name="submitSetting">Add</button>
    </form>
</body>
</html>