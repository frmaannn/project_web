-- Database: db_inventaris
CREATE DATABASE IF NOT EXISTS db_inventaris;
USE db_inventaris;

DROP TABLE IF EXISTS produk;
DROP TABLE IF EXISTS kategori;

-- Tabel 1: Kategori barang
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    keterangan TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel 2: Data produk
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kategori_id INT NOT NULL,
    nama_produk VARCHAR(150) NOT NULL,
    harga INT NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_produk_kategori FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE
);

-- Data contoh
INSERT INTO kategori (id, nama_kategori, keterangan) VALUES
(1, 'Elektronik', 'Barang elektronik dan aksesoris komputer'),
(2, 'Pakaian', 'Koleksi busana pria dan wanita'),
(3, 'Makanan & Minuman', 'Kebutuhan konsumsi harian'),
(4, 'Alat Tulis', 'Buku, pulpen, dan perlengkapan kantor');

INSERT INTO produk (kategori_id, nama_produk, harga, stok, deskripsi) VALUES
(1, 'Mouse Wireless Logitech', 185000, 25, 'Mouse tanpa kabel dengan baterai awet'),
(1, 'Keyboard Mechanical TKL', 450000, 12, 'Switch biru dengan lampu RGB'),
(2, 'Kaos Polos Cotton Combed', 65000, 50, 'Bahan adem 30s warna hitam'),
(3, 'Kopi Robusta 250gr', 45000, 30, 'Biji kopi sangrai khas Dampit Malang'),
(4, 'Buku Catatan Spiral A5', 25000, 40, 'Kertas tebal 80 gsm isi 100 lembar');
