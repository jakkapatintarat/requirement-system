<?php
date_default_timezone_set("Asia/Bangkok");
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

    // แก้ไขข้อมูล customer
    public function update_customer($data)
    {
        $update_customer = $this->pdo->prepare(
            "UPDATE customers 
            SET customer_name = :customer_name, 
            customer_requirement = :customer_requirement, 
            customer_tel = :customer_tel
            WHERE customer_id = :customer_id"
        );
        $update_customer->execute([
            "customer_name" => $data["u_c_name"],
            "customer_requirement" => $data["u_c_req"],
            "customer_tel" => $data["u_c_tel"],
            "customer_id" => $data["u_c_id"],
        ]);

        echo "<script>window.location.href = 'system_customer.php?system_id=" . $data['system_id'] . "'</script>";
    }

    // แก้ไขสถานะ
    public function update_status($data)
    {
        $customer_id = $data['customer_id'];
        $status_id = $data['status_id'];
        $system_id = $data['system_id'];
        $time = date('Y-m-d H:i:s'); //กำหนดวันเวลาที่เพิ่มข้อมูล
        if ($status_id == 2) { // ถ้า status เป็น success ให้เพิ่มเวลาจบ requirement
            $status = $this->pdo->prepare("UPDATE customers SET status_id = :status_id, end_at = :end_at WHERE customer_id = :customer_id");
            $status->execute([
                "customer_id" => $customer_id,
                "status_id" => $status_id,
                "end_at" => $time
            ]);
            echo "<script>window.location.href = 'system_customer.php?system_id=" . $system_id . "'</script>";
        } else { // ถ้า status_id ไม่ใช่ 2 ให้เปลี่ยน end_at เป็น NULL
            $end_at = null;
            $status = $this->pdo->prepare("UPDATE customers SET status_id = :status_id, end_at = :end_at WHERE customer_id = :customer_id");
            $status->execute([
                "customer_id" => $customer_id,
                "status_id" => $status_id,
                "end_at" => $end_at
            ]);
            echo "<script>window.location.href = 'system_customer.php?system_id=" . $system_id . "'</script>";
        }
    }

    // รายละเอียดลูกค้า by Id
    public function customer_detail($customer_id)
    {
        $customer = $this->pdo->prepare("SELECT customers.*, status.status_name FROM customers 
        INNER JOIN status ON customers.status_id = status.status_id WHERE customers.customer_id = :customer_id");
        $customer->execute([
            "customer_id" => $customer_id
        ]);
        return $customer->fetch(PDO::FETCH_ASSOC);
    }

    // นับแถวของแต่ละระบบว่ามีลูกค้าอยู่กี่คน
    public function row_customers()
    {
        // ดึงข้อมูลจากตาราง status
        $all_systems = $this->pdo->prepare("SELECT * FROM systems"); //ดึงข้อมูลของระบบ
        $all_systems->execute();
        $systems = $all_systems->fetchAll(PDO::FETCH_ASSOC);
        // print_r($systems);
        $customer_counts = [];
        foreach ($systems as $system) {
            $customer = $this->pdo->prepare("SELECT * FROM customers WHERE system_id = :system_id");
            $customer->execute([
                "system_id" => $system["system_id"],
            ]);
            $customers = $customer->fetchAll(PDO::FETCH_ASSOC);
            $row = count($customers);

            $customer_counts[$system['system_id']] = $row;
        }
        // print_r($customer_counts);
        return $customer_counts;
    }
}
