<?php
$servername = "localhost"; // Specify the port
$username = "vaibhav";
$password = "#qwerty#001#"; // Replace with your MySQL root password if any
$databaseName = "ourdatabase";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
