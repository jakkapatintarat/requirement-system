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
    public function show($system_id)
    {
        $customers = $this->pdo->prepare(
            'SELECT customers.*, status.status_name FROM customers 
            INNER JOIN status ON customers.status_id = status.status_id WHERE customers.system_id = :system_id'
        );
        $customers->execute([
            'system_id' => $system_id
        ]);
        return $customers->fetchAll(PDO::FETCH_ASSOC);
    }

    // สร้าง customer
    public function create_customer(array $data)
    {
        // print_r($data);
        $time = date('Y-m-d H:i:s'); //กำหนดวันเวลาที่เพิ่มข้อมูล
        $stmt = $this->pdo->prepare('INSERT INTO customers (customer_name, customer_requirement, customer_tel, start_at, system_id) VALUES 
        (:c_name, :c_req, :c_tel, :start_at, :system_id)');
        $stmt->execute([
            'c_name' => $data['c_name'],
            'c_req' => $data['c_req'],
            'c_tel' => $data['c_tel'],
            'start_at' => $time,
            'system_id' => $data['system_id'],
        ]);

        echo "<script>window.location.href = 'system_customer.php?system_id=" . $data['system_id'] . "'</script>";
    }

    // ลบ customer
    public function delete_customer($data)
    {
        // print_r($data);
        $stmt = $this->pdo->prepare('DELETE FROM customers WHERE customer_id = :customer_id');
        $stmt->execute([
            'customer_id' => $data['del_c_id']
        ]);

        echo "<script>window.location.href = 'system_customer.php?system_id=" . $data['del_c_system_id'] . "'</script>";
    }

    // แก้ไขสถานะ
    public function update_status($data)
    {
        $customer_id = $data['customer_id'];
        $status_id = $data['status_id'];
        $system_id = $data['system_id'];

        $status = $this->pdo->prepare("UPDATE customers SET status_id = :status_id WHERE customer_id = :customer_id");
        $status->execute([
            "customer_id" => $customer_id,
            "status_id" => $status_id
        ]);
        echo "<script>window.location.href = 'system_customer.php?system_id=" . $system_id . "'</script>";
    }
}
