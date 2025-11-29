<?php

class TugasModel {
    private $conn;
    private $table_name = "tugas";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ semua tugas -> return array associative
    public function getAllTugas(): array {
        $query = "SELECT t.*,
                         p.id_proyek,
                         s.nama_status
                  FROM tugas t
                  LEFT JOIN proyek p ON t.id_proyek = p.id_proyek
                  LEFT JOIN status s ON t.id_status = s.id_status
                  ORDER BY t.id_tugas ASC";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ tugas berdasarkan ID
    public function getTugasById($id) {
        $query = "SELECT * FROM {$this->table_name} WHERE id_tugas = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE tugas baru
    public function createTugas($data) {
        $query = "INSERT INTO {$this->table_name} 
            (id_proyek, id_status, nama_tugas, deskripsi, tanggal_mulai, batas_waktu, tanggal_selesai_actual)
        VALUES 
            (:id_proyek, :id_status, :nama_tugas, :deskripsi, :tanggal_mulai, :batas_waktu, :tanggal_selesai_actual)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_proyek", $data['id_proyek'], PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $data['id_status'], PDO::PARAM_INT);
        $stmt->bindParam(":nama_tugas", $data['nama_tugas'], PDO::PARAM_STR);
        $stmt->bindParam(":deskripsi", $data['deskripsi'], PDO::PARAM_STR);

        $tanggal_mulai = (!empty($data['tanggal_mulai']))
            ? $data['tanggal_mulai']
            : date("Y-m-d");   // <-- Auto today

        $batas_waktu = (!empty($data['batas_waktu'])) ? $data['batas_waktu'] : null;
        $tanggal_selesai_actual = (!empty($data['tanggal_selesai_actual'])) ? $data['tanggal_selesai_actual'] : null;

        $stmt->bindValue(":tanggal_mulai", $tanggal_mulai, PDO::PARAM_STR);
        $stmt->bindValue(":batas_waktu", $batas_waktu, $batas_waktu === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(":tanggal_selesai_actual", $tanggal_selesai_actual, $tanggal_selesai_actual === null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        return $stmt->execute();
    }

    // UPDATE tugas
    public function updateTugas($id, $data) {
        $query = "UPDATE {$this->table_name} SET
            id_proyek = :id_proyek,
            id_status = :id_status,
            nama_tugas = :nama_tugas,
            deskripsi = :deskripsi,
            tanggal_mulai = :tanggal_mulai,
            batas_waktu = :batas_waktu,
            tanggal_selesai_actual = :tanggal_selesai_actual
          WHERE id_tugas = :id";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_proyek", $data['id_proyek'], PDO::PARAM_INT);
        $stmt->bindParam(":id_status", $data['id_status'], PDO::PARAM_INT);
        $stmt->bindParam(":nama_tugas", $data['nama_tugas'], PDO::PARAM_STR);
        $stmt->bindParam(":deskripsi", $data['deskripsi'], PDO::PARAM_STR);
    
        $tanggal_mulai = (!empty($data['tanggal_mulai']))
            ? $data['tanggal_mulai']
            : date("Y-m-d");   // <-- Auto today
    
        $batas_waktu = (!empty($data['batas_waktu'])) ? $data['batas_waktu'] : null;
        $tanggal_selesai_actual = (!empty($data['tanggal_selesai_actual'])) ? $data['tanggal_selesai_actual'] : null;
    
        $stmt->bindValue(":tanggal_mulai", $tanggal_mulai, PDO::PARAM_STR);
        $stmt->bindValue(":batas_waktu", $batas_waktu, $batas_waktu === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(":tanggal_selesai_actual", $tanggal_selesai_actual, $tanggal_selesai_actual === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    
        return $stmt->execute();
    }

    // DELETE tugas
    public function deleteTugas($id) {
        $query = "DELETE FROM {$this->table_name} WHERE id_tugas = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //SEARCH tugas
    public function searchTugas($keyword) {
        $keyword = "%$keyword%";
    
        $query = "SELECT t.*,
                         p.nama_proyek,
                         s.nama_status
                  FROM tugas t
                  LEFT JOIN proyek p ON t.id_proyek = p.id_proyek
                  LEFT JOIN status s ON t.id_status = s.id_status
                  WHERE 
                       CAST(t.id_tugas AS TEXT) LIKE :keyword
                    OR CAST(t.id_proyek AS TEXT) LIKE :keyword
                    OR t.nama_tugas LIKE :keyword
                    OR p.nama_proyek LIKE :keyword
                    OR s.nama_status LIKE :keyword
                  ORDER BY t.id_tugas ASC";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":keyword", $keyword);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
}
