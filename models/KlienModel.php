<?php

class KlienModel {
    private $conn;
    private $table_name = "klien";

    // Constructor
    public function __construct($db) {
        $this->conn = $db;
    }

    // READ
    public function getAllKlien() {
        $query = "SELECT * FROM $this->table_name ORDER BY \"id_klien\" DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createKlien($data) {
        $query = "INSERT INTO $this->table_name (nama_klien, kontak_klien) VALUES (:nama_klien, :kontak_klien)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama_klien", $data['nama_klien']);
        $stmt->bindParam(":kontak_klien", $data['kontak_klien']);
        return $stmt->execute();
    }

    // UPDATE
    public function updateKlien($id, $data) {
        $query = "UPDATE $this->table_name SET nama_klien = :nama_klien, kontak_klien = :kontak_klien WHERE \"id_klien\" = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nama_klien", $data['nama_klien']);
        $stmt->bindParam(":kontak_klien", $data['kontak_klien']);
        return $stmt->execute();
    }

    // DELETE
    public function deleteKlien($id) {
        $query = "DELETE FROM $this->table_name WHERE \"id_klien\" = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
