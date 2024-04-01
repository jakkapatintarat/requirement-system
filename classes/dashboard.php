<?php

class Dashboard
{
    public $pdo;

    public function __construct()
    {
        require './database.php';
        $this->pdo = $pdo;
    }

    // ดึงข้อมูล system โดยนับแถว และ ดึงข้อมูลระบบที่สร้างล่าสุด
    public function get_system()
    {
        $count_system = $this->pdo->prepare('SELECT COUNT(*) as count FROM systems');
        $count_system->execute();
        $count = $count_system->fetch(PDO::FETCH_ASSOC);

        $last_row = $this->pdo->prepare('SELECT * FROM systems WHERE system_id = (SELECT MAX(system_id) FROM systems)');
        $last_row->execute();
        $latest = $last_row->fetch(PDO::FETCH_ASSOC);

        $result = ['system_count' => $count, 'system' => $latest];

        return $result;
    }

    // ดึงข้อมูล customer โดยนับแถว และ ดึงข้อมูลวันที่สร้างล่าสุด
    public function get_customer()
    {
        $count_customer = $this->pdo->prepare('SELECT COUNT(*) as count FROM customers');
        $count_customer->execute();
        $count = $count_customer->fetch(PDO::FETCH_ASSOC);

        $last_row = $this->pdo->prepare(
            'SELECT customers.*, systems.system_name FROM customers
            INNER JOIN systems ON customers.system_id = systems.system_id 
            ORDER BY customers.start_at DESC LIMIT 1
        '
        );
        $last_row->execute();
        $latest = $last_row->fetch(PDO::FETCH_ASSOC);

        $result = ['customer_count' => $count, 'customer' => $latest];

        return $result;
    }

    // filter หาข้อมูลด้วย ระบบ และ สถานะ
    public function filter($system_id, $status)
    {
        // ค้นหาข้อมูลระบบ
        if ($status != '') {
            $stmt = $this->pdo->prepare(
                'SELECT c.*, s.status_name 
                FROM customers c
                INNER JOIN status s ON c.status_id = s.status_id
                WHERE c.system_id = :system_id AND c.status_id = :status_id'
            );
            $stmt->execute([
                'system_id' => $system_id,
                'status_id' => $status
            ]);
            // $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($result);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->pdo->prepare(
                'SELECT customers.*, status.status_name
                FROM customers 
                INNER JOIN status ON customers.status_id = status.status_id 
                WHERE customers.system_id = :system_id'
            );
            $stmt->execute([
                'system_id' => $system_id
            ]);
            // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($result);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
