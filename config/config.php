<?php
$token = ""; #your token bot 
$main_host = "localhost"; #host
$main_user = ""; #user in sql db
$main_pass = ""; #pass in sql db
$main_db = ""; #sql db name

$main_pdo = new PDO(
    "mysql:host=$main_host;dbname=$main_db;charset=utf8mb4",
    $main_user,
    $main_pass, 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);
?>