<?php

class Databaseconnection{
private $servername = "localhost:3307"; // Specify the port
 private $username = "vaibhav";
private $password = "#qwerty#001#"; // Replace with your MySQL root password if any
private $databaseName = "ourdatabase";
public $conn="";
public function __construct(){
    try {
        $this-> conn = new PDO("mysql:host=$this->servername;dbname=$this->databaseName", $this->username, $this->password);
        // Set the PDO error mode to exception
        $this->conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

}

?>