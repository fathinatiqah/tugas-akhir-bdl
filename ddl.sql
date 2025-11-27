-- ============================================
-- TABEL KLIEN
-- ============================================
CREATE TABLE klien (
    id_klien SERIAL PRIMARY KEY,
    nama_klien VARCHAR(100),
    kontak_klien VARCHAR(100)
);

-- ============================================
-- TABEL TIM
-- ============================================
CREATE TABLE tim (
    id_tim SERIAL PRIMARY KEY,
    nama_tim VARCHAR(100)
);

-- ============================================
-- TABEL STATUS
-- ============================================
CREATE TABLE status (
    id_status SERIAL PRIMARY KEY,
    nama_status VARCHAR(50)
);

-- ============================================
-- TABEL PROYEK
-- ============================================
CREATE TABLE proyek (
    id_proyek SERIAL PRIMARY KEY,
    id_klien INT,
    id_tim INT,
    id_status INT,

    nama_proyek VARCHAR(150),
    budget NUMERIC(15,2),

    tanggal_mulai DATE DEFAULT CURRENT_DATE,
    tanggal_selesai DATE,

    FOREIGN KEY (id_klien) REFERENCES klien(id_klien),
    FOREIGN KEY (id_tim) REFERENCES tim(id_tim),
    FOREIGN KEY (id_status) REFERENCES status(id_status)
);

-- ============================================
-- TABEL TUGAS
-- ============================================
CREATE TABLE tugas (
    id_tugas SERIAL PRIMARY KEY,
    id_proyek INT,
    id_status INT,

    nama_tugas VARCHAR(150),
    deskripsi TEXT,

    tanggal_mulai DATE DEFAULT CURRENT_DATE,   -- tambahkan default
    batas_waktu DATE,
    tanggal_selesai_actual DATE,              -- tambahan

    FOREIGN KEY (id_proyek) REFERENCES proyek(id_proyek),
    FOREIGN KEY (id_status) REFERENCES status(id_status)
);

-- ============================================
-- TABEL ANGGOTA TIM
-- ============================================
CREATE TABLE anggota_tim (
    id_anggota SERIAL PRIMARY KEY,
    id_tim INT,
    nama_anggota VARCHAR(100),
    posisi VARCHAR(50),

    FOREIGN KEY (id_tim) REFERENCES tim(id_tim)
);

-- ============================================
-- TABEL PENUGASAN (Many-to-Many: tugas <-> anggota)
-- ============================================
CREATE TABLE penugasan (
    id_tugas INT,
    id_anggota INT,

    PRIMARY KEY (id_tugas, id_anggota),

    FOREIGN KEY (id_tugas) REFERENCES tugas(id_tugas),
    FOREIGN KEY (id_anggota) REFERENCES anggota_tim(id_anggota)
);
