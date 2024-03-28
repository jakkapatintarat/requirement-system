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
        $stmt = $this->pdo->prepare("INSERT INTO systems (system_name) VALUES (:name)");
        // return $stmt->execute(["name" => $system_name]);
        try {
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
    public function update_system($system_id, $system_name)
    {
        $stmt = $this->pdo->prepare('UPDATE systems SET system_name = :system_name WHERE system_id = :system_id');
        $stmt->execute(['system_id' => $system_id, 'system_name' => $system_name]);
    }
}
