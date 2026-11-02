dokter =	id_dokter, nama_dokter, tanggal_lahir, alamat_dokter, no_hp, spesialis, waktu_kerja
pasien =	id_pasien, nama_pasien, jenis_kelamin, alamat_pasien
administrator =	id_admin, nama_admin, waktu_jaga
pasien_dokter =	id, id_dokter, id_pasien, waktu_periksa, resep
daftar =	id_daftar, id_admin, id_pasien
dokter_admin =	id_data, id_admin, id_dokter


-- 1. MEMBUAT DATABASE

CREATE DATABASE IF NOT EXISTS rumah_sakit;

USE rumah_sakit;



-- 2. MEMBUAT TABEL DOKTER

CREATE TABLE IF NOT EXISTS dokter (
    id_dokter INT AUTO_INCREMENT PRIMARY KEY,
    nama_dokter VARCHAR(100) NOT NULL,
    tanggal_lahir DATE,
    alamat_dokter TEXT,
    no_hp VARCHAR(20),
    spesialis VARCHAR(100),
    waktu_kerja VARCHAR(100)
) ENGINE=InnoDB;


-- 3. MEMBUAT TABEL PASIEN

CREATE TABLE IF NOT EXISTS pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    nama_pasien VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan'),
    alamat_pasien TEXT
) ENGINE=InnoDB;


-- 4. MEMBUAT TABEL ADMINISTRATOR

CREATE TABLE IF NOT EXISTS administrator (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nama_admin VARCHAR(100) NOT NULL,
    waktu_jaga VARCHAR(100)
) ENGINE=InnoDB;


-- 5. MEMBUAT TABEL PASIEN_DOKTER

CREATE TABLE IF NOT EXISTS pasien_dokter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_dokter INT NOT NULL,
    id_pasien INT NOT NULL,
    waktu_periksa DATETIME,
    resep TEXT,

    CONSTRAINT fk_pd_dokter
        FOREIGN KEY (id_dokter)
        REFERENCES dokter(id_dokter)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_pd_pasien
        FOREIGN KEY (id_pasien)
        REFERENCES pasien(id_pasien)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;


-- 6. MEMBUAT TABEL DAFTAR

CREATE TABLE IF NOT EXISTS daftar (
    id_daftar INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT NOT NULL,
    id_pasien INT NOT NULL,

    CONSTRAINT fk_daftar_admin
        FOREIGN KEY (id_admin)
        REFERENCES administrator(id_admin)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_daftar_pasien
        FOREIGN KEY (id_pasien)
        REFERENCES pasien(id_pasien)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 7. MEMBUAT TABEL DOKTER_ADMIN

CREATE TABLE IF NOT EXISTS dokter_admin (
    id_data INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT NOT NULL,
    id_dokter INT NOT NULL,

    CONSTRAINT fk_da_admin
        FOREIGN KEY (id_admin)
        REFERENCES administrator(id_admin)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_da_dokter
        FOREIGN KEY (id_dokter)
        REFERENCES dokter(id_dokter)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;


-- 8. MEMERIKSA STRUKTUR TABEL

SHOW TABLES;

DESCRIBE dokter;

DESCRIBE pasien;

DESCRIBE administrator;

DESCRIBE pasien_dokter;

DESCRIBE daftar;

DESCRIBE dokter_admin;


-- 9. MEMERIKSA RELASI FOREIGN KEY

SELECT
    TABLE_NAME,
    COLUMN_NAME,
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = 'rumah_sakit'
AND REFERENCED_TABLE_NAME IS NOT NULL;
