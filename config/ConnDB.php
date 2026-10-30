<?php
class Database {
    private $servername = "localhost";
    private $username = "root";       
    private $password = "root";       
    private $dbname = "db_northwind"; 
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=utf8", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Connection failed: " . $e->getMessage()]);
            exit;
        }
        return $this->conn;
    }
}
?>