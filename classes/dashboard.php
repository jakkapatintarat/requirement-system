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

    // filter หาข้อมูลด้วย ระบบ หรือ สถานะ หรือ ชื่อ
    public function filter($system_id, $status, $c_name)
    {
        // ดึงข้อมูลตามที่ได้จาก system_id status และ name
        $stmt = $this->pdo->prepare(
            'SELECT c.*, s.status_name 
                FROM customers c
                LEFT JOIN status s ON c.status_id = s.status_id
                WHERE c.system_id LIKE :system_id 
                AND (c.status_id LIKE :status_id OR :status_id IS NULL) 
                AND (c.customer_name LIKE :c_name OR :c_name IS NULL)'
        ); // ตั้งเงื่อนไขว่าถ้าไม่มีข้อมูลของ status หรือ name ให้ทำการตั้งเป็น NULL เพื่อให้ไม่มีผลในการดึงข้อมูล
        $stmt->execute([
            'system_id' => '%' . $system_id . '%',
            'status_id' => '%' . $status . '%',
            'c_name' => '%' . $c_name . '%',
        ]);
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($result);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
