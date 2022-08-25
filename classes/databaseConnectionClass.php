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
    }

    public function selectAction($table) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM `$table`";
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


    public function __destruct() {
        $this->conn=null;
        echo "Atsijungta sekmingai";
    }
}

?>