<?php
class TimModel {
    private $conn;
    private $table_name = "tim";

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // READ
    public function getAllTim() {
        $query = "SELECT * FROM $this->table_name ORDER BY \"id_tim\" ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createTim($data) {
        $query = "INSERT INTO $this->table_name (nama_tim) VALUES (:nama_tim)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama_tim", $data['nama_tim']);
        return $stmt->execute();
    }

    // UPDATE
    public function updateTim($id, $data) {
        $query = "UPDATE $this->table_name SET nama_tim = :nama_tim WHERE \"id_tim\" = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nama_tim", $data['nama_tim']);
        return $stmt->execute();
    }

    // DELETE
    public function deleteTim($id) {
        $query = "DELETE FROM $this->table_name WHERE \"id_tim\" = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // READ TIM berdasarkan nama
    public function readTim() {
        $query = "SELECT id_tim, nama_tim FROM tim ORDER BY nama_tim";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
