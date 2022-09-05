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
            $this->conn->exec("set names utf8");
            // echo "Prisijungta prie duomenu bazes sekmingai";
        } catch(PDOException $e) {
            echo "Prisijungti nepavyko: ".$e->getMessage();
        }
    }

    public function selectAction($table, $col, $sortDir) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table`
            ORDER BY `$table`.`$col` $sortDir";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            return $result;

        } catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
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

    public function deleteAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `$table` WHERE id = $id";
            $this->conn->exec($sql);
            echo "Pavyko istrinti irasa";
        }
        catch(PDOException $e) {
            echo "Nepavyko istrinti iraso: " . $e->getMessage();
        }
    }

    public function updateAction($table, $id, $data) {
        $cols = array_keys($data);
        $values = array_values($data);

        $dataString = [];
        for ($i=0; $i<count($cols); $i++) {
           $dataString[] = $cols[$i] . " = '" . $values[$i]. "'";
        }
        $dataString = implode(",", $dataString);

        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `$table` SET $dataString WHERE id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            echo "Pavyko atnaujinti irasa";
        } 
        catch(PDOException $e) {
            echo "Nepavyko atnaujinti iraso: " . $e->getMessage();
        }
    }

    public function selectOneAction($table, $id) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table` WHERE id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function selectWithJoin($table1, $table2, $table1RelationCol, $table2RelationCol, $join, $cols, $sort, $filterCat) {
        $cols = implode(",", $cols);
        $productsPerPage=$this->getPagination("0","0");

        $offset = 0;

        $currentPage = $this->currentPage();

        if($currentPage!=0){
            $offset = ($currentPage - 1) * $productsPerPage;
        }
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT $cols FROM $table1 
            $join $table2
            ON $table1.$table1RelationCol = $table2.$table2RelationCol
            $filterCat
            $sort
            LIMIT $offset, $productsPerPage";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function checkIfImageExists($url){
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT 1 FROM products WHERE image_url = '$url'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function totalCount($table1, $table2, $table1RelationCol, $table2RelationCol, $join, $filterCat) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(*) AS totalCount FROM $table1
            $join $table2
            ON $table1.$table1RelationCol = $table2.$table2RelationCol
            $filterCat";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        }
        catch(PDOException $e) {
            return "Nepavyko vykdyti uzklausos: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn=null;
        // echo "Atsijungta sekmingai";
    }
}

?>