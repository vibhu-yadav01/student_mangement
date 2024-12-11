<?php
try {
    $conn = new PDO("mysql:host=localhost:3307;dbname=ourdatabase;charset=utf8mb4", "vaibhav", "#qwerty#001#");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    $conn->query('SELECT 1');
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

