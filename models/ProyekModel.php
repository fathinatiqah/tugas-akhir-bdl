<?php

class ProyekModel {
    private $conn;
    private $table_name = "proyek";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ semua proyek
    public function getAllProyek() {
        $query = "SELECT p.*,
                         k.nama_klien,
                         t.nama_tim,
                         s.nama_status
                  FROM proyek p
                  LEFT JOIN klien k ON p.id_klien = k.id_klien
                  LEFT JOIN tim t ON p.id_tim = t.id_tim
                  LEFT JOIN status s ON p.id_status = s.id_status
                  ORDER BY p.id_proyek ASC";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
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
        $tanggal_mulai = !empty($data['tanggal_mulai']) ? $data['tanggal_mulai'] : date("Y-m-d");

        $stmt->bindParam(":tanggal_mulai", $tanggal_mulai);

        // tanggal_selesai
        if ($data['tanggal_selesai'] === null) {
            $stmt->bindValue(":tanggal_selesai", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(":tanggal_selesai", $data['tanggal_selesai']);
        }

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
        $tanggal_mulai = !empty($data['tanggal_mulai']) ? $data['tanggal_mulai'] : date("Y-m-d");

        $stmt->bindParam(":tanggal_mulai", $tanggal_mulai);

        // tanggal_selesai
        if ($data['tanggal_selesai'] === null) {
            $stmt->bindValue(":tanggal_selesai", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(":tanggal_selesai", $data['tanggal_selesai']);
        }

        return $stmt->execute();
    }

    // DELETE proyek
    public function deleteProyek($id) {
        $query = "DELETE FROM {$this->table_name} WHERE id_proyek = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //SEARCH proyek
    public function searchProyek($keyword) {
        $sql = "SELECT p.*, k.nama_klien, t.nama_tim, s.nama_status
                FROM proyek p
                LEFT JOIN klien k ON p.id_klien = k.id_klien
                LEFT JOIN tim t ON p.id_tim = t.id_tim
                LEFT JOIN status s ON p.id_status = s.id_status
                WHERE p.nama_proyek ILIKE :kw
                ORDER BY p.id_proyek ASC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':kw' => "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // READ PROYEK berdasarkan nama
    public function readProyek() {
        $query = "SELECT id_proyek, nama_proyek FROM proyek ORDER BY nama_proyek";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hitung total data proyek
    public function countProyek() {
        $sql = "SELECT COUNT(*) AS total FROM proyek";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Ambil data dengan pagination
    public function getPaginatedProyek($limit, $offset) {
        $sql = "SELECT p.*, k.nama_klien, t.nama_tim, s.nama_status
                FROM proyek p
                LEFT JOIN klien k ON p.id_klien = k.id_klien
                LEFT JOIN tim t ON p.id_tim = t.id_tim
                LEFT JOIN status s ON p.id_status = s.id_status
                ORDER BY p.id_proyek ASC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

