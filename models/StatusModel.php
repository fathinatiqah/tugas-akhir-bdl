<?php

class StatusModel {
    private $conn;
    private $table_name = "status";

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }
    // READ STATUS berdasarkan nama
    public function readStatus() {
        $query = "SELECT id_status, nama_status FROM status ORDER BY nama_status";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>