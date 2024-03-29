<?php
include("database.php");

// seed Admin
$email = "admin@example.com";
$password = "password";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $hashed_password);

if ($stmt->execute()) {
    echo "<h3>seed success (user)</h3>";
} else {
    echo "</h3>seed fail (user)</h3>";
}

// seed status
$status = [
    'Pending',
    'Complete',
    'In progress',
    'Cancled'
];

$insert_status = $pdo->prepare('INSERT INTO status (status_name) VALUE (:status_name)');
foreach ($status as $value) {
    if ($insert_status->execute([':status_name' => $value])) {
        echo "</h3>seed success (status '$value')</h3>";
    } else {
        echo "</h3>seed fail (status)</h3>";
    }
}
