<?php
include("database.php");

$email = "admin@example.com";
$password = "password";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $hashed_password);

if( $stmt->execute() ){
    echo "seeder success";
}else{
    echo "Error seeder";
}
?>