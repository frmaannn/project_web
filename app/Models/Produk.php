<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Produk {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Ambil semua data produk dengan join ke kategori
    public function getAll($keyword = null) {
        $sql = "SELECT p.*, k.nama_kategori 
                FROM produk p 
                JOIN kategori k ON p.kategori_id = k.id";

        if (!empty($keyword)) {
            $sql .= " WHERE p.nama_produk LIKE :cari OR k.nama_kategori LIKE :cari";
        }

        $sql .= " ORDER BY p.id DESC";
        $stmt = $this->db->prepare($sql);

        if (!empty($keyword)) {
            $stmt->bindValue(':cari', '%' . $keyword . '%', PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produk WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function tambah($data) {
        $sql = "INSERT INTO produk (kategori_id, nama_produk, harga, stok, deskripsi) 
                VALUES (:kategori_id, :nama_produk, :harga, :stok, :deskripsi)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':kategori_id' => $data['kategori_id'],
            ':nama_produk' => $data['nama_produk'],
            ':harga'       => $data['harga'],
            ':stok'        => $data['stok'],
            ':deskripsi'   => $data['deskripsi']
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE produk 
                SET kategori_id = :kategori_id,
                    nama_produk = :nama_produk,
                    harga = :harga,
                    stok = :stok,
                    deskripsi = :deskripsi 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'          => $id,
            ':kategori_id' => $data['kategori_id'],
            ':nama_produk' => $data['nama_produk'],
            ':harga'       => $data['harga'],
            ':stok'        => $data['stok'],
            ':deskripsi'   => $data['deskripsi']
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produk WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function hitungTotal() {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total_produk, COALESCE(SUM(stok), 0) as total_stok FROM produk");
        $stmt->execute();
        return $stmt->fetch();
    }
}
