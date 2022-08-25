<?php
include("classes/databaseConnectionClass.php");

class ShopDatabase extends DatabaseConnection{
    public $products;
    public $categories;

    public function __construct() {
        parent::__construct();
    }

    public function getProducts($table) {
        if(isset($_POST["filter"])) {
            $filterCat = $_POST["category_id"];
            $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"], "id", "ASC", "WHERE `categories`.`id` = $filterCat");
        } else {
            $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"], "id", "ASC", " ");
        }
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
            echo "<a href='index.php?page=update&id=".$product["id"]."' class='btn btn-success'>EDIT</a>";
            echo "</form>";
            echo "</tr>";
        }
    }

    public function getCategories() {
        $this->categories = $this->selectAction("categories");
        foreach ($this->categories as $category) {
            echo "<tr>";
            echo "<td>".$category["id"]."</td>";
            echo "<td>".$category["title"]."</td>";
            echo "<td>".$category["description"]."</td>";
            echo "</tr>";

        }
        return $this->categories;
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
                "category_id" => $_POST["category_id"],
                "image_url" => $_POST["image_url"]
            );
            $products["title"] = '"' . $products["title"] . '"';
            $products["description"] = '"' . $products["description"] . '"';
            $products["price"] = '"' . $products["price"] . '"';
            $products["category_id"] = '"' . $products["category_id"] . '"';
            $products["image_url"] = '"' . $products["image_url"] . '"';
            $this->insertAction("products", ["title", "description", "price", "category_id", "image_url"],[$products["title"], $products["description"], $products["price"], $products["category_id"], $products["image_url"]]);
            header("Location: index.php");
        }
    }

    public function deleteProduct() {
        if(isset($_POST["delete"])) {
            $this->deleteAction("products", $_POST["id"]);
            header("Location: index.php"); 
        }
    }

    public function selectOneProduct() {
        if(isset($_GET["page"]) && ($_GET["page"] == "update" && isset($_GET["id"]))) {
            $product = $this->selectOneAction("products", $_GET["id"]);
            return $product;
            
        }
    }

    public function editProduct() {
        if(isset($_POST["edit"])) {
            $products = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "price" => $_POST["price"],
                "category_id" => $_POST["category_id"],
                "image_url" => $_POST["image_url"]
            );
            $this->updateAction("products", $_POST["id"] , $products);
            header("Location: index.php");
        }
    }

    public function createCategory() {
        if(isset($_POST["submitCategory"])) {
            $categories = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"]
            );
            $categories["title"] = '"' . $categories["title"] . '"';
            $categories["description"] = '"' . $categories["description"] . '"';           
            $this->insertAction("categories", ["title", "description"],[$categories["title"], $categories["description"]]);
            header("Location: index.php");
        }
    }
}
?>