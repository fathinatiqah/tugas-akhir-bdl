<?php
class ViewModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Laporan Detail Proyek (simple view)
    public function getProyekDetail() {
        $sql = "SELECT * FROM view_proyek_detail ORDER BY id_proyek ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Laporan Total Tugas dari Proyek(materialized view)
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

    // Laporan Detail tugas
    public function getDetailTugas() {
        $sql = "SELECT
            p.id_proyek,
            t.nama_tugas,
            t.batas_waktu,
            a.nama_anggota,
            st.nama_status
        FROM
            tugas t
        JOIN
            proyek p ON t.id_proyek = p.id_proyek
        JOIN
            penugasan pg ON t.id_tugas = pg.id_tugas
        JOIN
            anggota_tim a ON pg.id_anggota = a.id_anggota
        JOIN
            status st ON t.id_status = st.id_status
        ORDER BY
            p.id_proyek, t.id_tugas";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
