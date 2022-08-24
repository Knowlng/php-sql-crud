<?php

class DatabaseConnection {
    private $host ="localhost";
    private $user = "root";
    private $password = "";
    private $database = "parduotuve";

    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            echo "Prisijungta prie duomenu bazes sekmingai";
        } catch(PDOException $e) {
            echo "Prisijungti nepavyko: ".$e->getMessage();
        }
        // perkelti i kita faila veliau ir pasivogti konstrukta
        for($i=1; $i<=5; $i++) {
            $randomPrice = rand(1, 100);
            $randomCategory = rand(1,3);
            $this->insertAction("products", ["title", "description", "price", "category_id", "image_url"], ["'item"."$i'", "'item"."$i'", "'$randomPrice'", "'$randomCategory'", "'url"."$i'"]);
        }
    }


    public function insertAction($table, $cols, $values) {

        $cols = implode(",", $cols);
        $values = implode(",", $values);

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO `$table` ($cols) VALUES ($values)";
            $this->conn->exec($sql);
            echo "Pavyko sukurti nauja irasa";

        } catch (PDOException $e) {
            echo "Nepavyko sukurti naujo iraso: " . $e->getMessage();
        }

    }


    public function __destruct() {
        $this->conn=null;
        echo "Atsijungta sekmingai";
    }
}



$test = new DatabaseConnection;

?>