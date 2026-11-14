<?php

$host = "localhost";
$dbname = "mini_tracker";
$username = "root";
$password = "";
// this is a commit
try {

    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}

?>