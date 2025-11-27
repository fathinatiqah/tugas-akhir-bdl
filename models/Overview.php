<?php
class Overview {
    private $conn;
    private $table_anggota = 'anggota_tim';
    private $table_tim     = 'tim';
    private $table_klien   = 'klien';
    private $table_proyek  = 'proyek';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTotalAnggota(): int {
        $query = "SELECT COUNT(*) FROM {$this->table_anggota}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function getTotalTim(): int {
        $query = "SELECT COUNT(*) FROM {$this->table_tim}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function getTotalKlien(): int {
        $query = "SELECT COUNT(*) FROM {$this->table_klien}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function getTotalProyekAktif($statusAktif): int {
        $query = "SELECT COUNT(*) FROM {$this->table_proyek} WHERE id_status = :sts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':sts' => $statusAktif]);
        return (int) $stmt->fetchColumn();
    }

    /**
     * Hitung total budget dari semua proyek
     * @return float — total budget (misalnya dalam decimal / integer)
     */
    public function getTotalBudget(): float {
        $query = "SELECT SUM(budget) FROM {$this->table_proyek}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        // fetchColumn akan mendapat nilai SUM(budget), bisa null jika tidak ada row
        $sum = $stmt->fetchColumn();
        return $sum !== null ? (float) $sum : 0.0;
    }
}
?>