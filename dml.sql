INSERT INTO status (nama_status) VALUES
('On Progress'),
('Selesai'),
('Tertunda');

INSERT INTO klien (nama_klien, kontak_klien) VALUES
('PT Maju Jaya', '08123456789');

INSERT INTO tim (nama_tim) VALUES
('Tim A');

INSERT INTO anggota_tim (id_tim, nama_anggota, posisi) VALUES
(1, 'Budi', 'Developer'),
(1, 'Siti', 'UI/UX');

INSERT INTO proyek (id_klien, id_tim, id_status, nama_proyek, budget, tanggal_mulai, tanggal_selesai) VALUES
(1, 1, 1, 'Pengembangan Sistem ERP Klien A', 50000000, '2025-02-01', NULL),
(2, 2, 1, 'Desain Ulang Website E-Commerce', 35000000, '2025-03-15', NULL),
(3, 3, 2, 'Aplikasi Mobile Pemasaran Digital', 75000000, '2024-11-20', '2025-01-30'),
(4, 4, 3, 'Migrasi Database Cloud', 40000000, '2025-01-05', NULL),
(5, 5, 1, 'Analisis Big Data Tahap I', 62000000, '2025-04-10', NULL),
(6, 1, 2, 'Pelatihan Karyawan Sistem Baru', 15000000, '2024-10-01', '2024-12-15'),
(7, 2, 3, 'Integrasi API Layanan Pembayaran', 28000000, '2025-05-01', NULL),
(8, 3, 1, 'Penyempurnaan Modul Akuntansi', 55000000, '2025-06-20', NULL),
(9, 4, 2, 'Pembuatan Laporan Keuangan Otomatis', 22000000, '2025-01-10', '2025-03-05'),
(10, 5, 1, 'Uji Keamanan Jaringan Internal', 30000000, '2025-07-01', NULL),
(11, 1, 3, 'Riset Pasar Produk Baru', 18000000, '2025-04-25', NULL),
(12, 2, 2, 'Pembangunan Aplikasi Inventory', 90000000, '2024-08-01', '2025-01-15'),
(13, 3, 1, 'Kampanye Iklan Digital Q3', 20000000, '2025-08-15', NULL),
(14, 4, 2, 'Audit Sistem Informasi', 12000000, '2025-02-05', '2025-03-20'),
(15, 5, 3, 'Implementasi Chatbot Layanan Pelanggan', 45000000, '2025-09-01', NULL);

INSERT INTO tugas (id_proyek, id_status, nama_tugas, deskripsi, tanggal_mulai, batas_waktu, tanggal_selesai_actual) VALUES

-- Proyek 1 (Status: 1 - On Progress)
(1, 2, 'Pengumpulan Kebutuhan', 'Wawancara user dan dokumentasi Fungsional.', '2025-02-01', '2025-02-20', '2025-02-18'),
(1, 1, 'Development Modul Inventori', 'Koding modul Inti.', '2025-03-01', '2025-04-15', NULL), -- On Progress (Belum Selesai)

-- Proyek 2 (Status: 1 - On Progress)
(2, 2, 'Penyusunan Konten SEO', 'Tulis artikel produk utama.', '2025-03-15', '2025-03-30', '2025-03-29'),
(2, 1, 'Integrasi Payment Gateway', 'Hubungkan sistem dengan midtrans/Xendit.', '2025-04-01', '2025-05-10', NULL), -- On Progress (Sudah Terlambat)

-- Proyek 3 (Status: 2 - Selesai)
(3, 2, 'Riset Audiens Target', 'Kumpulkan data demografi pengguna.', '2024-11-20', '2024-11-27', '2024-11-28'), -- Selesai (Terlambat)
(3, 2, 'Pembangunan Backend API', 'Bangun server side untuk aplikasi.', '2024-11-28', '2025-01-10', '2025-01-05'), -- Selesai (Tepat Waktu)

-- Proyek 4 (Status: 3 - Tertunda)
(4, 2, 'Analisis Struktur Database Lama', 'Pahami skema database yang akan dimigrasi.', '2025-01-05', '2025-01-15', '2025-01-13'),
(4, 3, 'Migrasi Data Produksi', 'Transfer data utama ke Cloud (Tertunda).', '2025-01-16', '2025-03-01', NULL), -- Tertunda (Sudah Terlambat)

-- Proyek 5 (Status: 1 - On Progress)
(5, 2, 'Persiapan Dataset', 'Cleaning dan labeling data.', '2025-04-10', '2025-04-25', '2025-04-24'),
(5, 1, 'Pengembangan Model Analisis', 'Coding algoritma analisis.', '2025-04-26', '2025-06-01', NULL), -- On Progress (Sudah Terlambat)

-- Proyek 6 (Status: 2 - Selesai)
(6, 2, 'Penyusunan Materi Pelatihan', 'Buat modul dan slide presentasi.', '2024-10-01', '2024-10-30', '2024-10-25'),
(6, 2, 'Sesi Pelatihan Akhir', 'Eksekusi pelatihan untuk semua karyawan.', '2024-11-01', '2024-12-15', '2024-12-10'),

-- Proyek 7 (Status: 3 - Tertunda)
(7, 3, 'Dokumentasi API Pembayaran', 'Pelajari dan buat dokumentasi integrasi (Tertunda).', '2025-05-01', '2025-05-15', NULL),
(7, 3, 'Implementasi Endpoint', 'Koding koneksi API di sisi backend (Tertunda).', '2025-05-16', '2025-06-10', NULL),

-- Proyek 8 (Status: 1 - On Progress)
(8, 2, 'Audit Modul Akuntansi Lama', 'Identifikasi area yang perlu disempurnakan.', '2025-06-20', '2025-07-05', '2025-07-05'),
(8, 1, 'Refactoring Code', 'Perbaiki dan optimasi struktur kode.', '2025-07-06', '2025-08-20', NULL),

-- Proyek 9 (Status: 2 - Selesai)
(9, 2, 'Desain Template Laporan', 'Buat desain output laporan keuangan.', '2025-01-10', '2025-01-25', '2025-01-25'),
(9, 2, 'Otomatisasi Data Entry', 'Setup script untuk entri data otomatis.', '2025-01-26', '2025-03-05', '2025-03-05'),

-- Proyek 10 (Status: 1 - On Progress)
(10, 2, 'Penetration Testing Awal', 'Uji kerentanan dasar.', '2025-07-01', '2025-07-20', '2025-07-18'),
(10, 1, 'Laporan dan Rekomendasi', 'Susun laporan hasil uji dan solusi perbaikan.', '2025-07-21', '2025-08-15', NULL),

-- Proyek 11 (Status: 3 - Tertunda)
(11, 3, 'Survei Lapangan', 'Pengumpulan data langsung dari responden (Tertunda).', '2025-04-25', '2025-05-10', NULL),
(11, 3, 'Analisis Data Riset', 'Olah dan interpretasi hasil survei (Tertunda).', '2025-05-11', '2025-06-01', NULL),

-- Proyek 12 (Status: 2 - Selesai)
(12, 2, 'Analisis Sistem Inventory Eksisting', 'Dokumentasi sistem inventori lama.', '2024-08-01', '2024-08-15', '2024-08-14'),
(12, 2, 'Integrasi Barcode Scanner', 'Implementasi fitur scanner produk.', '2024-10-01', '2024-11-30', '2024-11-25'),

-- Proyek 13 (Status: 1 - On Progress)
(13, 1, 'Pembuatan Kreatif Iklan', 'Desain visual dan copywriting.', '2025-08-15', '2025-09-01', NULL), -- On Progress (Sudah Terlambat)
(13, 1, 'Running Ads dan Monitoring', 'Peluncuran iklan dan pantau performa.', '2025-09-02', '2025-10-30', NULL), -- On Progress (Sudah Terlambat)

-- Proyek 14 (Status: 2 - Selesai)
(14, 2, 'Pengumpulan Dokumen Audit', 'Kumpulkan semua dokumen SI yang diperlukan.', '2025-02-05', '2025-02-15', '2025-02-15'),
(14, 2, 'Wawancara Key Personel', 'Lakukan interview dengan manajer terkait.', '2025-02-16', '2025-03-01', '2025-03-01'),

-- Proyek 15 (Status: 3 - Tertunda)
(15, 3, 'Pemilihan Platform Chatbot', 'Tentukan platform yang akan digunakan (Tertunda).', '2025-09-01', '2025-09-15', NULL),
(15, 3, 'Pelatihan Model AI', 'Training chatbot dengan data percakapan (Tertunda).', '2025-09-16', '2025-10-30', NULL);

INSERT INTO penugasan (id_tugas, id_anggota) VALUES
-- Siklus 1 (Tugas 1-10)
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),

-- Siklus 2 (Tugas 11-20)
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(17, 7),
(18, 8),
(19, 9),
(20, 10),

-- Siklus 3 (Tugas 21-30)
(21, 1),
(22, 2),
(23, 3),
(24, 4),
(25, 5),
(26, 6),
(27, 7),
(28, 8),
(29, 9),
(30, 10);

CREATE OR REPLACE VIEW view_proyek_detail AS
SELECT 
    p.id_proyek,
    p.nama_proyek,
    k.nama_klien,
    t.nama_tim,
    s.nama_status,
    p.budget,
    p.tanggal_mulai,
    p.tanggal_selesai
FROM proyek p
LEFT JOIN klien k ON p.id_klien = k.id_klien
LEFT JOIN tim t ON p.id_tim = t.id_tim
LEFT JOIN status s ON p.id_status = s.id_status;

CREATE MATERIALIZED VIEW mv_total_tugas AS
SELECT 
    p.id_proyek,
    p.nama_proyek,
    COUNT(tg.id_tugas) AS total_tugas
FROM proyek p
LEFT JOIN tugas tg ON p.id_proyek = tg.id_proyek
GROUP BY p.id_proyek, p.nama_proyek;

/* INDEXING */
EXPLAIN ANALYZE
SELECT * FROM tugas WHERE id_proyek = 3;

EXPLAIN ANALYZE
SELECT * FROM tugas WHERE id_status = 2;