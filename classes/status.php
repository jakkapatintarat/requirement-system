<?php

class Status
{
    public $pdo;

    public function __construct()
    {
        require "./database.php";
        $this->pdo = $pdo;
    }

    public function show()
    {
        $status = $this->pdo->prepare("SELECT * FROM status ORDER BY status_id ASC");
        $status->execute();
        return $status->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create_status($status_name)
    {
        // print_r($status_name);
        try {
            $status = $this->pdo->prepare("INSERT INTO status (status_name) VALUES (:status_name)");
            $status->execute([
                "status_name" => $status_name,
            ]);
            return true;
        } catch (PDOException $e) {
            if ($e) {
                return false;
            }
        }
    }

    public function delete_status($status_id)
    {
        // print_r($status_id);
        $status = $this->pdo->prepare("DELETE FROM status WHERE status_id = :status_id");
        $status->execute([
            "status_id" => $status_id,
        ]);
        echo "<script>window.location.href = 'system.php'</script>";
    }
}
