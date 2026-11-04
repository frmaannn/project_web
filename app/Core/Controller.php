<?php
namespace App\Core;

class Controller {
    protected function view($namaView, $data = []) {
        extract($data);
        $file = __DIR__ . '/../Views/' . $namaView . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            die("File view {$namaView} tidak ditemukan.");
        }
    }

    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit;
    }
}
