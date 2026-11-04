<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Kategori;

class KategoriController extends Controller {
    private $kategoriModel;

    public function __construct() {
        $this->kategoriModel = new Kategori();
    }

    public function index() {
        $daftarKategori = $this->kategoriModel->getAll();
        $this->view('kategori/index', [
            'daftarKategori' => $daftarKategori,
            'errors'         => [],
            'old'            => []
        ]);
    }

    public function store() {
        $nama = trim($_POST['nama_kategori'] ?? '');
        $ket  = trim($_POST['keterangan'] ?? '');

        $errors = [];
        if ($nama === '') {
            $errors['nama_kategori'] = 'Nama kategori tidak boleh kosong.';
        }

        if (!empty($errors)) {
            $daftarKategori = $this->kategoriModel->getAll();
            $this->view('kategori/index', [
                'daftarKategori' => $daftarKategori,
                'errors'         => $errors,
                'old'            => $_POST
            ]);
            return;
        }

        $this->kategoriModel->tambah([
            'nama_kategori' => $nama,
            'keterangan'    => $ket
        ]);

        $_SESSION['pesan_sukses'] = 'Kategori baru berhasil ditambahkan!';
        $this->redirect('/kategori');
    }
}
