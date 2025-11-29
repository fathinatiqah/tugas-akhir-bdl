<?php
class TransactionModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Skenario insert proyek dan tugas dalam satu transaksi
    public function createProyekDenganTugas($proyekData, $tugasData) {

        try {
            // Mulai Transaction
            $this->conn->beginTransaction();

            // Insert proyek
            $sqlProyek = "INSERT INTO proyek (nama_proyek, id_klien, id_tim, id_status, budget, tanggal_mulai) 
                          VALUES (:nama, :klien, :tim, :status, :budget, CURRENT_DATE)
                          RETURNING id_proyek";
            $stmt1 = $this->conn->prepare($sqlProyek);
            $stmt1->execute([
                ':nama' => $proyekData['nama_proyek'],
                ':klien' => $proyekData['id_klien'],
                ':tim'   => $proyekData['id_tim'],
                ':status'=> $proyekData['id_status'],
                ':budget'=> $proyekData['budget']
            ]);
            $idProyek = $stmt1->fetchColumn(); // Dapat id proyek baru

            // Insert tugas (menggunakan id proyek di atas)
            $sqlTugas = "INSERT INTO tugas (id_proyek, id_status, nama_tugas, deskripsi, tanggal_mulai)
                         VALUES (:proyek, :status, :nama, :desk, CURRENT_DATE)";
            $stmt2 = $this->conn->prepare($sqlTugas);
            $stmt2->execute([
                ':proyek' => $idProyek,
                ':status' => $tugasData['id_status'],
                ':nama'   => $tugasData['nama_tugas'],
                ':desk'   => $tugasData['deskripsi']
            ]);

            // Jika semua berhasil → commit
            $this->conn->commit();
            return ["status" => "success", "msg" => "Transaksi berhasil! Data proyek & tugas tersimpan."];

        } catch (Exception $e) {

            // Jika ada error → rollback
            $this->conn->rollBack();
            return ["status" => "error", "msg" => "Transaksi gagal: " . $e->getMessage()];
        }
    }
}
?>
