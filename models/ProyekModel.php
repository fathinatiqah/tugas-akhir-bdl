<?php

class ProyekModel {
    private $conn;
    private $table_name = "proyek";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ semua proyek
    public function getAllProyek() {
        $query = "SELECT * FROM {$this->table_name} ORDER BY id_proyek DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;  // akan mengembalikan PDOStatement
    }

    // READ satu proyek berdasarkan ID
    public function getProyekById($id) {
        $query = "SELECT * FROM {$this->table_name} WHERE id_proyek = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE proyek baru
    public function createProyek($data) {
        $query = "INSERT INTO {$this->table_name} 
            (id_klien, id_tim, id_status, nama_proyek, budget, tanggal_mulai, tanggal_selesai)
            VALUES (:id_klien, :id_tim, :id_status, :nama_proyek, :budget, :tanggal_mulai, :tanggal_selesai)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_klien", $data['id_klien'], PDO::PARAM_INT);
        $stmt->bindParam(":id_tim", $data['id_tim'], PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $data['id_status'], PDO::PARAM_INT);
        $stmt->bindParam(":nama_proyek", $data['nama_proyek'], PDO::PARAM_STR);
        $stmt->bindParam(":budget", $data['budget']);
        $stmt->bindParam(":tanggal_mulai", $data['tanggal_mulai']);  // format YYYY-MM-DD
        $stmt->bindParam(":tanggal_selesai", $data['tanggal_selesai']);  // bisa NULL atau tanggal

        return $stmt->execute();
    }

    // UPDATE proyek
    public function updateProyek($id, $data) {
        $query = "UPDATE {$this->table_name} SET
            id_klien = :id_klien,
            id_tim = :id_tim,
            id_status = :id_status,
            nama_proyek = :nama_proyek,
            budget = :budget,
            tanggal_mulai = :tanggal_mulai,
            tanggal_selesai = :tanggal_selesai
          WHERE id_proyek = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_klien", $data['id_klien'], PDO::PARAM_INT);
        $stmt->bindParam(":id_tim", $data['id_tim'], PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $data['id_status'], PDO::PARAM_INT);
        $stmt->bindParam(":nama_proyek", $data['nama_proyek'], PDO::PARAM_STR);
        $stmt->bindParam(":budget", $data['budget']);
        $stmt->bindParam(":tanggal_mulai", $data['tanggal_mulai']);
        $stmt->bindParam(":tanggal_selesai", $data['tanggal_selesai']);

        return $stmt->execute();
    }

    // DELETE proyek
    public function deleteProyek($id) {
        $query = "DELETE FROM {$this->table_name} WHERE id_proyek = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // READ proyek berdasarkan klien
    public function getProyekByKlien($id_klien) {
        $query = "SELECT * FROM {$this->table_name} WHERE id_klien = :id_klien ORDER BY id_proyek";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_klien", $id_klien, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

