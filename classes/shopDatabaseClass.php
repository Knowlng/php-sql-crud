<?php
include("classes/databaseConnectionClass.php");

class ShopDatabase extends DatabaseConnection{
    public $products;
    public $categories;

    public function __construct() {
        parent::__construct();
    }

    public function getProducts($table) {
        $this->products = $this->selectAction("$table");
        foreach ($this->products as $product) {
            echo "<tr>";
            echo "<td>".$product["id"]."</td>";
            echo "<td>".$product["title"]."</td>";
            echo "<td>".$product["description"]."</td>";
            echo "<td>".$product["price"]."</td>";
            echo "<td>".$product["category_id"]."</td>";
            echo "<td>".$product["image_url"]."</td>";
            echo "<td>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='".$product["id"]."'>";
            echo "<button class='btn btn-danger' type='submit' name='delete'>DELETE</button>";
            echo "</form>";
            echo "</tr>";
        }
    }

    public function addRandomProducts($quantity) {

        for($i=1; $i<=$quantity; $i++) {
            $randomPrice = rand(1, 100);
            $randomCategory = rand(1,3);
            $this->insertAction("products", ["title", "description", "price", "category_id", "image_url"], ["'item"."$i'", "'item"."$i'", "'$randomPrice'", "'$randomCategory'", "'url"."$i'"]);
        }

    }

    public function createProduct() {
        if(isset($_POST["submit"])) {
            $products = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "price" => $_POST["price"],
                "categoryID" => $_POST["categoryID"],
                "imageURL" => $_POST["imageURL"]
            );
            $products["title"] = '"' . $products["title"] . '"';
            $products["description"] = '"' . $products["description"] . '"';
            $products["price"] = '"' . $products["price"] . '"';
            $products["categoryID"] = '"' . $products["categoryID"] . '"';
            $products["imageURL"] = '"' . $products["imageURL"] . '"';
            $this->insertAction("products", ["title", "description", "price", "category_id", "image_url"],[$products["title"], $products["description"], $products["price"], $products["categoryID"], $products["imageURL"]]);
            header("Location: index.php");
        }
    }

    public function deleteProduct() {
        if(isset($_POST["delete"])) {
            $this->deleteAction("products", $_POST["id"]);
            header("Location: index.php"); 
        }
    }
}
?>