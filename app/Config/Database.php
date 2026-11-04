<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private static $koneksi = null;

    public static function connect() {
        if (self::$koneksi === null) {
            $host = 'localhost';
            $db   = 'db_inventaris';
            $user = 'root';
            $pass = '';

            try {
                self::$koneksi = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Koneksi database gagal: " . $e->getMessage());
            }
        }
        return self::$koneksi;
    }
}
