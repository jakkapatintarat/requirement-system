<?php
$host = 'localhost';
$db = 'requirement_system';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$db";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connect success";
} catch (PDOException $e) {
    die('Connect fail: ' . $e->getMessage());
}
?>