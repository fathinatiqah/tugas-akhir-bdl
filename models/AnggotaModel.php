<?php 

class AnggotaModel {
    private $conn;
    private $table_name = "anggota_tim";

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // READ
    public function getAllAnggota() {
        $query = "SELECT * FROM $this->table_name ORDER BY \"id_anggota\" ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createAnggota($data) {
        $query = "INSERT INTO $this->table_name (id_tim, nama_anggota, posisi) VALUES (:id_tim, :nama_anggota, :posisi)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_tim", $data['id_tim']);
        $stmt->bindParam(":nama_anggota", $data['nama_anggota']);
        $stmt->bindParam(":posisi", $data['posisi']);
        return $stmt->execute();
    }

    // UPDATE
    public function updateAnggota($id, $data) {
        $query = "UPDATE $this->table_name SET id_tim = :id_tim, nama_anggota = :nama_anggota, posisi = :posisi WHERE id_anggota = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":id_tim", $data['id_tim']);
        $stmt->bindParam(":nama_anggota", $data['nama_anggota']);
        $stmt->bindParam(":posisi", $data['posisi']);
        return $stmt->execute();
    }

    // DELETE
    public function deleteAnggota($id) {
        $query = "DELETE FROM $this->table_name WHERE \"id_anggota\" = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
