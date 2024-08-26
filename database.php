<?php
// $host = 'localhost';
// $db = 'requirement_system';
// $username = 'root';
// $password = '';

$host = 'k3xio06abqa902qt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	';
$db = 'qkohpzzxolcaccqk';
$username = 'gisbn60i7vltgfan';
$password = 's4oazrh8ishg1ge9';

try {
    // $dsn = "mysql:host=$host;dbname=$db";
    $dsn = "mysql://gisbn60i7vltgfan:s4oazrh8ishg1ge9@k3xio06abqa902qt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/qkohpzzxolcaccqk";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connect success";
} catch (PDOException $e) {
    die('Connect fail: ' . $e->getMessage());
}
?>