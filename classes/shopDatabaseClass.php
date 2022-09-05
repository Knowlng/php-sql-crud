<?php
include("classes/databaseConnectionClass.php");

class ShopDatabase extends DatabaseConnection{
    public $products;
    public $categories;
    public $settings;

    public function __construct() {
        parent::__construct();
    }

    public function getProducts() {
        if(isset($_GET["filter"])) {
            $filterCat = $_GET["category_id"];
            if($filterCat==" "){
                $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"ORDER BY `products`.`id` ASC", $filterCat);
            } else {
                $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"ORDER BY `products`.`id` ASC", "WHERE `categories`.`id` = $filterCat");
            }   
            if($filterCat=="none") {
                $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"ORDER BY `products`.`id` ASC", "WHERE `categories`.`title` IS NULL");
            }
        } else {
            $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"ORDER BY `products`.`id` ASC", " ");
        }

        if(isset($_GET["search"]) && $_GET["searchInput"]!="") {
            $search = $_GET["searchInput"];
            $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"", "WHERE `products`.`title` LIKE '$search%'");
        }

        if(isset($_POST["ascendingSubmit"])) {
            $dir = $_POST["ascending"];
            $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"ORDER BY `categories`.`title` $dir", " ");
        }

        if(isset($_POST["descendingSubmit"])) {
            $dir = $_POST["descending"];
            $this->products= $this->selectWithJoin("products", "categories","category_id", "id", "LEFT JOIN",["products.id", "products.title", "products.description", "products.price", "categories.title as category_id", "products.image_url"],"ORDER BY `categories`.`title` $dir", " ");
        }

        foreach ($this->products as $product) {
            echo "<tr>";
            echo "<td>".$product["id"]."</td>";
            echo "<td style='width:120px;'>".$product["title"]."</td>";
            echo "<td style='width:620px;'>".$product["description"]."</td>";
            echo "<td>".$product["price"]."</td>";
            if(empty($product["category_id"])) {
                echo "<td>No category set</td>";
            } else {
                echo "<td>".$product["category_id"]."</td>";
            }
            if(file_exists($product['image_url']) && $product['image_url'] != "images/") {
                echo "<td class='text-center' style='width:300px;'><img class='mw-100' src=".$product["image_url"]."></td>";
            } else {
                echo "<td class='text-center' style='width:300px;'><img class='mw-100' src='images/default.jpg'></td>";
            }
            echo "<td>";
            echo "<form method='POST' class='text-center'>";
            echo "<input type='hidden' name='imageURL' value='".$product['image_url']."'>";
            echo "<input type='hidden' name='id' value='".$product["id"]."'>";
            echo "<button class='btn btn-danger' type='submit' name='delete'>DELETE</button>";
            echo "<a href='index.php?page=update&id=".$product["id"]."' class='btn btn-success'>EDIT</a>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }

    public function getCategories() {
        $this->categories = $this->selectAction("categories","id","ASC");
        return $this->categories;
    }

    public function getSettings() {
        $this->settings = $this->selectAction("settings","id","ASC");
        return $this->settings;
    }

    public function displayCategories() {
        $this->categories = $this->selectAction("categories","id","ASC");

        if(isset($_POST["submitAscID"])) {
            $dir = $_POST["ascID"];
            $this->categories = $this->selectAction("categories","id", $dir);
        }

        if (isset($_POST["submitDescID"])) {
            $dir = $_POST["descID"];
            $this->categories = $this->selectAction("categories","id", $dir);
        } 

        if(isset($_POST["submitAscTitle"])) {
            $dir = $_POST["ascTitle"];
            $this->categories = $this->selectAction("categories","title", $dir);
        }

        if (isset($_POST["submitDescTitle"])) {
            $dir = $_POST["descTitle"];
            $this->categories = $this->selectAction("categories","title", $dir);
        } 

        if(isset($_POST["submitAscDesc"])) {
            $dir = $_POST["ascDesc"];
            $this->categories = $this->selectAction("categories","description", $dir);
        }

        if (isset($_POST["submitDescDesc"])) {
            $dir = $_POST["descDesc"];
            $this->categories = $this->selectAction("categories","description", $dir);
        } 

        foreach ($this->categories as $category) {
            echo "<tr>";
            echo "<td>".$category["id"]."</td>";
            echo "<td>".$category["title"]."</td>";
            echo "<td>".$category["description"]."</td>";
            echo "<td>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='id' value='".$category["id"]."'>";
            echo "<button class='btn btn-danger' type='submit' name='deleteCategory'>DELETE</button>";
            echo "<a href='index.php?page=updateCategories&id=".$category["id"]."' class='btn btn-success'>EDIT</a>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

        }
        return $this->categories;
    }

    public function deleteSetting() {
        if(isset($_POST["deleteSetting"])) {
            $this->deleteAction("settings", $_POST["settingID"]);
        }
    }

    public function displaySettings() {
        $this->settings = $this->selectAction("settings","id","ASC");
        foreach ($this->settings as $setting) {
            echo "<tr>";
            echo "<td>".$setting["id"]."</td>";
            echo "<td>".$setting["value"]."</td>";
            echo "<td>".$setting["name"]."</td>";
            echo "<td>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='settingID' value='".$setting["id"]."'>";
            echo "<button class='btn btn-danger' type='submit' name='deleteSetting'>DELETE</button>";
            echo "<a href='index.php?page=updateSetting&id=".$setting["id"]."' class='btn btn-success'>EDIT</a>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

        }
        return $this->settings;
    }

    public function createSetting(){
        if(isset($_POST["submitSetting"])) {
            $settings = array(
                "value" => $_POST["value"],
                "name" => $_POST["name"]
            );
            $settings["value"] = '"' . $settings["value"] . '"';
            $settings["name"] = '"' . $settings["name"] . '"';           
            $this->insertAction("settings", ["value", "name"],[$settings["value"], $settings["name"]]);
            header("Location: index.php?page=settings");
        }
    }   

    public function editSetting() {
        if(isset($_POST["editSetting"])) {
            $settings = array(
                "value" => $_POST["value"],
                "name" => $_POST["name"]
            );
            $this->updateAction("settings", $_POST["id"] , $settings);
            header("Location: index.php?page=settings");
        }
    }

    public function addRandomProducts() {
        if(isset($_POST["createRandom"])){
            $quantity = $_POST["quantity"];
            if(ctype_digit($quantity) && $quantity>0 && $quantity<=150) {
                $catArray = $this->getCategories();
                $idArray = [];
                foreach($catArray as $id) {
                    $idArray[] = $id["id"];
                }

                for($i=1; $i<=$quantity; $i++) {
                    $randomPrice = rand(1, 100);
                    $randomKey = array_rand($idArray);
                    $randomCategory = $idArray[$randomKey];
                    $randomImage = $this->getRandomImage();
                    $this->insertAction("products", ["title", "description", "price", "category_id", "image_url"], ["'item"."$i'", "'item"."$i'", "'$randomPrice'", "'$randomCategory'", "'$randomImage'"]);
                }
                header("Location: index.php");
            }
        }
    }

    protected function getRandomImage() {
        $files = glob(realpath('images') . '/*.*');
        $file = array_rand($files);
        $result = substr($files[$file], strpos($files[$file], 'images'));
        return $result;
    }

    public function createProduct() {
        if(isset($_POST["submit"])) {
            $products = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"],
                "price" => $_POST["price"],
                "category_id" => $_POST["category_id"],
                "image_url" => $this->uploadImage($_FILES["image_url"])
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

    private function uploadImage($file) {

        $fileDir = "images/";
        $fileTarget = $fileDir . basename($file["name"]);
        $fileType = strtolower(pathinfo($fileTarget, PATHINFO_EXTENSION));

        if($fileType != "jpg") {
            return "images/default.jpg"; 
        }

        if($file["error"] == 0) {
            if(move_uploaded_file($file["tmp_name"], $fileTarget)) {
                return $fileTarget;
            } else {
                return "images/default.jpg";           
            }
        }
        return $fileTarget;
    }

    public function deleteProduct() {
        if(isset($_POST["delete"])) {
            $imageArray =& $this->checkIfImageExists($_POST["imageURL"]);
            if(count($imageArray) == 1 && $_POST["imageURL"] != "images/default.jpg") {
                unlink($_POST["imageURL"]);
            }
            $this->deleteAction("products", $_POST["id"]);
            header("Location: index.php"); 
        }
    }

    public function deleteCategory() {
        if(isset($_POST["deleteCategory"])) {
            $this->deleteAction("categories", $_POST["id"]);
            header("Location: index.php?page=categories"); 
        }
    }

    public function selectOneProduct() {
        $product = $this->selectOneAction("products", $_GET["id"]);
        return $product;
    }

    public function selectOneCategory() {
        $category = $this->selectOneAction("categories", $_GET["id"]);
        return $category;
    }

    public function selectOneSetting() {
        $setting = $this->selectOneAction("settings", $_GET["id"]);
        return $setting;
    }

    public function editProduct() {
        if(isset($_POST["edit"])) {
            if(strlen($_FILES["image_url"]['name'])!==0) {
                $products = array(
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "price" => $_POST["price"],
                    "category_id" => $_POST["category_id"],
                    "image_url" => $this->uploadImage($_FILES["image_url"])
                );
                $imageArray =& $this->checkIfImageExists($_POST["keepImg"]);
                if(count($imageArray) == 1 && $_POST["keepImg"] != "images/default.jpg") {
                    unlink($_POST["keepImg"]);
                }
            } else {
                $products = array(
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "price" => $_POST["price"],
                    "category_id" => $_POST["category_id"],
                    "image_url" => $_POST["keepImg"]

                );
            }
            $this->updateAction("products", $_POST["id"] , $products);
            header("Location: index.php");
        }
    }

    public function editCategory() {
        if(isset($_POST["editCategory"])) {
            $categories = array(
                "title" => $_POST["title"],
                "description" => $_POST["description"]
            );
            $this->updateAction("categories", $_POST["id"] , $categories);
            header("Location: index.php?page=categories");
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
            header("Location: index.php?page=categories");
        }
    }

    public function getPagination($showPagination, $showCount) {
        $filterCat = " ";
        $search = " ";
        $limit = $_GET["pageLimit"] ?? 15;

        if(isset($_GET["search"]) && $_GET["searchInput"]!=""){
            $limit = 0;
        }

        if(isset($_GET["category_id"])){
            $filterCat = $_GET["category_id"];
        }

        $productsCount = floatval($this->totalCount("products", "categories","category_id", "id", "LEFT JOIN", "WHERE `categories`.`id` = '$filterCat'")[0]["totalCount"]);
        if($filterCat==" "){
            $productsCount = floatval($this->totalCount("products", "categories","category_id", "id", "LEFT JOIN", $filterCat)[0]["totalCount"]);
        } else if($filterCat=="none"){
            $productsCount = floatval($this->totalCount("products", "categories","category_id", "id", "LEFT JOIN", "WHERE `categories`.`id` IS NULL")[0]["totalCount"]);
        }

        $productsPerPage = $limit;
        if ($productsPerPage == 0){
            $productsPerPage = $productsCount;
            $showPagination=0;
        }
        
        if ($productsPerPage==0 && $productsCount==0 || $productsCount <= $productsPerPage) {
            $showPagination=0;
        }
        if($showCount==1){
            echo "<p class='text-center'>Amount of products: ".$productsCount."</p>";
        }

        if($showPagination==1) {
            $currentPage=$this->currentPage();
            $pagesCount = ceil($productsCount / $productsPerPage);
            $buttonArray = [];
            echo "<div class='text-center mb-3'>";
            for($i = 1; $i <= $pagesCount; $i++) {
                if($currentPage==$i || $currentPage==0 && $i<=1){
                    $buttonArray [] = "<a class='btn btn-danger' href='index.php?category_id=$filterCat&pageLimit=$limit&filter=&paginatorPage=$i'>$i</a>";
                } else {
                    $buttonArray [] = "<a class='btn btn-link text-decoration-none' href='index.php?category_id=$filterCat&pageLimit=$limit&filter=&paginatorPage=$i'>$i</a>";
                }
            }
            foreach($buttonArray as $page) {
                echo $page;
            }            
            echo "</div>";
        }

        return $productsPerPage;
    }

    public function currentPage(){

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            $url = "https://";   
        } else  {
            $url = "http://";
            $url.= $_SERVER['HTTP_HOST'];    
            $url.= $_SERVER['REQUEST_URI'];  
        }

        $currentPage = 0;
        $string="paginatorPage=";
        if(strpos($url, $string) !== false){ 
            $currentPage = substr($url, strpos($url,"paginatorPage=")+14);
        }

        return $currentPage;
    }
}
?>