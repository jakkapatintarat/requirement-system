<?php

class Customer
{
    public $pdo;

    public function __construct()
    {
        require './database.php';
        $this->pdo = $pdo;
    }

    // แสดงรายการ customer
    public function show()
    {
        $customers = $this->pdo->prepare('SELECT customers.*, status.status_name FROM customers INNER JOIN status ON customers.status_id = status.status_id');
        $customers->execute();
        return $customers->fetchAll(PDO::FETCH_ASSOC);
    }

    // สร้าง customer
    public function create_customer(array $data)
    {
        // print_r($data);
        $time = date('Y-m-d H:i:s'); //กำหนดวันเวลาที่เพิ่มข้อมูล
        $stmt = $this->pdo->prepare('INSERT INTO customers (customer_name, customer_requirement, customer_tel, start_at) VALUES 
        (:c_name, :c_req, :c_tel, :start_at)');
        $stmt->execute([
            'c_name' => $data['c_name'],
            'c_req' => $data['c_req'],
            'c_tel' => $data['c_tel'],
            'start_at' => $time,
        ]);
    }
}
