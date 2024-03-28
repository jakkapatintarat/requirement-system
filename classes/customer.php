<?php

class Customer
{
    public $pdo;

    public function __construct() {
        require './database.php';
        $this->pdo = $pdo;
    }

    // รับ array data มา
    public function create_customer(array $data) {
        print_r($data);
        $stmt = $this->pdo->prepare('INSERT ');
    }
}
