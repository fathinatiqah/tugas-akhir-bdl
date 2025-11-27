INSERT INTO status (nama_status) VALUES
('On Progress'),
('Selesai'),
('Tertunda');

INSERT INTO klien (nama_klien, kontak_klien) VALUES
('PT Maju Jaya', '08123456789');

INSERT INTO tim (nama_tim) VALUES
('Tim A');

INSERT INTO proyek (id_klien, id_tim, id_status, nama_proyek, budget, tanggal_selesai, tanggal_selesai_actual) VALUES
(
    1, 1, 1, 'Sistem Manajemen Proyek', 50000000, '2025-02-01', NULL
);

INSERT INTO anggota_tim (id_tim, nama_anggota, posisi) VALUES
(1, 'Budi', 'Developer'),
(1, 'Siti', 'UI/UX');

tugas 1 -- selesai tepat waktu
INSERT INTO tugas (
    id_proyek, id_status, nama_tugas,
    tanggal_mulai, batas_waktu, tanggal_selesai_actual
) VALUES (
    1, 2, 'Desain UI Login',
    '2025-01-01', '2025-01-05', '2025-01-04'
);

tugas 2 -- selesai terlambat
INSERT INTO tugas (
    id_proyek, id_status, nama_tugas,
    tanggal_mulai, batas_waktu, tanggal_selesai_actual
) VALUES (
    1, 2, 'Backend Autentikasi',
    '2025-01-01', '2025-01-05', '2025-01-08'
);

tugas 3 -- belum selesai dan terlambat
INSERT INTO tugas (
    id_proyek, id_status, nama_tugas,
    batas_waktu
) VALUES (
    1, 1, 'Integrasi API', '2025-01-10'
);

tugas 4 -- belum selesai dan belum terlambat
INSERT INTO tugas (
    id_proyek, id_status, nama_tugas,
    batas_waktu
) VALUES (
    1, 1, 'Deploy ke Server', '2025-12-31'
);

INSERT INTO penugasan (id_tugas, id_anggota) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2);
