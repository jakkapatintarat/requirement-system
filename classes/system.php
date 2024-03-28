<?php

class System
{
    public $pdo;
    // เชื่อม Database
    public function __construct()
    {
        require "./database.php";
        $this->pdo = $pdo;
    }

    // แสดงรายการระบบ
    public function show()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM systems ORDER BY system_id DESC");
        $stmt->execute();
        $systems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // print_r($systems);
        return $systems;
    }

    // เพิ่มระบบ
    public function add_system($system_name)
    {
        // var_dump($system_name);
        try {
            $stmt = $this->pdo->prepare("INSERT INTO systems (system_name) VALUES (:name)");
            $stmt->execute(['name' => $system_name]);
            return true;
        } catch (PDOException $e) {
            if ($e) {
                return false;
            }
        }
    }

    // ลบระบบ
    public function delete_system($system_id)
    {
        // print_r($system_id);
        $stmt = $this->pdo->prepare('DELETE FROM systems WHERE system_id = :system_id');
        return $stmt->execute(['system_id' => $system_id]);
    }

    // อัพเดทระบบ
    public function update_system($system_name, $system_id)
    {
        // ถ้ามีอยู่แล้วให้ return false
        $check = $this->pdo->prepare('SELECT system_name FROM systems WHERE system_name = :system_name ');
        $check->execute(['system_name' => $system_name]);
        $exist = $check->fetch(PDO::FETCH_ASSOC);
        if ($exist) {
            return false;
        }

        $stmt = $this->pdo->prepare('UPDATE systems SET system_name = :system_name WHERE system_id = :system_id');
        try {
            $stmt->execute(['system_id' => $system_id, 'system_name' => $system_name]);
            return true;
        } catch (PDOException $e) {
            if ($e) {
                return false;
            }
        }
    }

    // ดึงข้อมูล id
    public function find_one($system_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM systems WHERE system_id = :system_id');
        $stmt->execute(['system_id' => $system_id]);
        $system_data = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($system_data);
        return $system_data;
    }
}
