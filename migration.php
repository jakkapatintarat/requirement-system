<?php
require_once('database.php');

// users table
$check_table_users = "SHOW TABLES LIKE 'users'"; // ตรวจสอบว่ามีตาราง users อยู่ไหม
$stmt_check_users = $pdo->prepare($check_table_users);
$stmt_check_users->execute();
$table_users_exists = $stmt_check_users->fetch(PDO::FETCH_ASSOC);

if ($table_users_exists) {
    $drop_table_users = "DROP TABLE IF EXISTS users";
    $stmt_drop_users = $pdo->prepare($drop_table_users);
    $stmt_drop_users->execute();
}

$users_table = "CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
$stmt = $pdo->prepare($users_table);

if ($stmt->execute()) {
    echo "<h3>Migration success (users)</h3>";
} else {
    echo "Error to migration (users)";
}

// systems table
$check_table_systems = "SHOW TABLES LIKE 'systems'";
$stmt_check_systems = $pdo->prepare($check_table_systems);
$stmt_check_systems->execute();
$table_systems_exists = $stmt_check_systems->fetch(PDO::FETCH_ASSOC);

if ($table_systems_exists) {
    $drop_table_systems = "DROP TABLE IF EXISTS systems";
    $stmt_drop_systems = $pdo->prepare($drop_table_systems);
    $stmt_drop_systems->execute();
}

$systems_table = "CREATE TABLE systems (
    system_id INT AUTO_INCREMENT PRIMARY KEY,
    system_name VARCHAR(255) NOT NULL UNIQUE
)";
$stmt = $pdo->prepare($systems_table);

if ($stmt->execute()) {
    echo "<h3>Migration success (systems)<h3>";
} else {
    echo "Error to migration (systems)";
}
