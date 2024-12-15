<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class DatabaseConnection {
    private $servername = "localhost"; 
    private $username = "vaibhav";
    private $password = "#qwerty#001#"; 
    private $databaseName = "ourdatabase";
    public $conn = "";

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->databaseName", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

// Instantiate the class
$db = new DatabaseConnection();
?>