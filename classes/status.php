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

}
