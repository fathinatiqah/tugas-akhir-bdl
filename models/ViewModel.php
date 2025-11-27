<?php
class ViewModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Simple View
    public function getProyekDetail() {
        $sql = "SELECT * FROM view_proyek_detail ORDER BY id_proyek ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Materialized View
    public function getTotalTugas() {
        $sql = "SELECT * FROM mv_total_tugas ORDER BY id_proyek ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Refresh MV
    public function refreshMV() {
        $this->conn->exec("REFRESH MATERIALIZED VIEW mv_total_tugas");
    }
}
?>
