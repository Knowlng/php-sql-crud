<?php include("classes/shopDatabaseClass.php"); ?>
<?php 
$shopDatabase = new shopDatabase();  
$setting=$shopDatabase->selectOneSetting();
$shopDatabase->editSetting();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Setting</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label>Products per page</label>
        <input class="form-control" name="value" value="<?php echo $setting[0]["value"]; ?>" placeholder="value">
        <label>Setting name</label>
        <input class="form-control" name="name" value="<?php echo $setting[0]["name"]; ?>" placeholder="name">
        <button class="btn btn-primary mt-3" type="submit" name="editSetting">Update</button>
    </form>
</body>
</html>