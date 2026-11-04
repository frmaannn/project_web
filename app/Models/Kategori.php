<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Kategori {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $sql = "SELECT k.*, COUNT(p.id) as total_produk 
                FROM kategori k 
                LEFT JOIN produk p ON k.id = p.kategori_id 
                GROUP BY k.id 
                ORDER BY k.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function tambah($data) {
        $sql = "INSERT INTO kategori (nama_kategori, keterangan) VALUES (:nama_kategori, :keterangan)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama_kategori' => $data['nama_kategori'],
            ':keterangan'    => $data['keterangan']
        ]);
    }
}
