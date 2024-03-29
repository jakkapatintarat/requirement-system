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


// customers table
$check_table_customers = "SHOW TABLES LIKE 'customers'";
$stmt_check_customers = $pdo->prepare($check_table_customers);
$stmt_check_customers->execute();
$table_customers_exists = $stmt_check_customers->fetch(PDO::FETCH_ASSOC);

if ($table_customers_exists) {
    $drop_table_customers = "DROP TABLE IF EXISTS customers";
    $stmt_drop_customers = $pdo->prepare($drop_table_customers);
    $stmt_drop_customers->execute();
}

$customers_table = "CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_requirement TEXT NOT NULL,
    customer_tel VARCHAR(10) NOT NULL,
    status_id INT DEFAULT 1,
    start_at  datetime DEFAULT NULL,
    end_at  datetime DEFAULT NULL
)";
$stmt = $pdo->prepare($customers_table);

if ($stmt->execute()) {
    echo "<h3>Migration success (customers)<h3>";
} else {
    echo "Error to migration (customers)";
}

// status table
$check_table_status = "SHOW TABLES LIKE 'status'";
$stmt_check_status = $pdo->prepare($check_table_status);
$stmt_check_status->execute();
$table_status_exists = $stmt_check_status->fetch(PDO::FETCH_ASSOC);

if ($table_status_exists) {
    $drop_table_status = "DROP TABLE IF EXISTS status";
    $stmt_drop_status = $pdo->prepare($drop_table_status);
    $stmt_drop_status->execute();
}

$status_table = "CREATE TABLE status (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(255) UNIQUE NOT NULL
)";
$stmt = $pdo->prepare($status_table);

if ($stmt->execute()) {
    echo "<h3>Migration success (status)<h3>";
} else {
    echo "Error to migration (status)";
}
