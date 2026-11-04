<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller {
    private $produkModel;
    private $kategoriModel;

    public function __construct() {
        $this->produkModel = new Produk();
        $this->kategoriModel = new Kategori();
    }

    // [GET /produk] Daftar semua produk
    public function index() {
        $cari = isset($_GET['cari']) ? trim($_GET['cari']) : null;
        $daftarProduk = $this->produkModel->getAll($cari);

        $this->view('produk/index', [
            'daftarProduk' => $daftarProduk,
            'cari'         => $cari
        ]);
    }

    // [GET /produk/create] Halaman form tambah produk
    public function create() {
        $daftarKategori = $this->kategoriModel->getAll();

        $this->view('produk/create', [
            'daftarKategori' => $daftarKategori,
            'errors'         => [],
            'old'            => []
        ]);
    }

    // [POST /produk/store] Proses simpan produk baru
    public function store() {
        $nama      = trim($_POST['nama_produk'] ?? '');
        $kategori  = $_POST['kategori_id'] ?? '';
        $harga     = trim($_POST['harga'] ?? '');
        $stok      = trim($_POST['stok'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');

        // Validasi input di controller
        $errors = [];

        if ($nama === '') {
            $errors['nama_produk'] = 'Nama produk wajib diisi.';
        } elseif (strlen($nama) < 3) {
            $errors['nama_produk'] = 'Nama produk minimal 3 karakter.';
        }

        if ($kategori === '' || !$this->kategoriModel->getById($kategori)) {
            $errors['kategori_id'] = 'Pilih kategori yang valid.';
        }

        if ($harga === '') {
            $errors['harga'] = 'Harga tidak boleh kosong.';
        } elseif (!is_numeric($harga) || $harga < 0) {
            $errors['harga'] = 'Harga harus berupa angka dan tidak boleh minus.';
        }

        if ($stok === '') {
            $errors['stok'] = 'Stok tidak boleh kosong.';
        } elseif (!is_numeric($stok) || $stok < 0) {
            $errors['stok'] = 'Stok harus berupa angka dan minimal 0.';
        }

        // Kalau ada input yang salah, balikkan ke form create
        if (!empty($errors)) {
            $daftarKategori = $this->kategoriModel->getAll();
            $this->view('produk/create', [
                'daftarKategori' => $daftarKategori,
                'errors'         => $errors,
                'old'            => $_POST
            ]);
            return;
        }

        // Simpan data
        $this->produkModel->tambah([
            'kategori_id' => $kategori,
            'nama_produk' => $nama,
            'harga'       => $harga,
            'stok'        => $stok,
            'deskripsi'   => $deskripsi
        ]);

        $_SESSION['pesan_sukses'] = 'Produk berhasil ditambahkan!';
        $this->redirect('/produk');
    }

    // [GET /produk/edit] Halaman form edit produk
    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/produk');
        }

        $produk = $this->produkModel->getById($id);
        if (!$produk) {
            $this->redirect('/produk');
        }

        $daftarKategori = $this->kategoriModel->getAll();

        $this->view('produk/edit', [
            'produk'         => $produk,
            'daftarKategori' => $daftarKategori,
            'errors'         => [],
            'old'            => $produk
        ]);
    }

    // [POST /produk/update] Proses update data produk
    public function update() {
        $id        = $_POST['id'] ?? null;
        $nama      = trim($_POST['nama_produk'] ?? '');
        $kategori  = $_POST['kategori_id'] ?? '';
        $harga     = trim($_POST['harga'] ?? '');
        $stok      = trim($_POST['stok'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');

        if (!$id) {
            $this->redirect('/produk');
        }

        // Validasi input
        $errors = [];

        if ($nama === '') {
            $errors['nama_produk'] = 'Nama produk tidak boleh kosong.';
        } elseif (strlen($nama) < 3) {
            $errors['nama_produk'] = 'Nama produk minimal 3 karakter.';
        }

        if ($kategori === '' || !$this->kategoriModel->getById($kategori)) {
            $errors['kategori_id'] = 'Pilih kategori yang valid.';
        }

        if ($harga === '' || !is_numeric($harga) || $harga < 0) {
            $errors['harga'] = 'Harga harus berupa angka dan tidak boleh minus.';
        }

        if ($stok === '' || !is_numeric($stok) || $stok < 0) {
            $errors['stok'] = 'Stok harus berupa angka positif.';
        }

        if (!empty($errors)) {
            $daftarKategori = $this->kategoriModel->getAll();
            $this->view('produk/edit', [
                'produk'         => ['id' => $id],
                'daftarKategori' => $daftarKategori,
                'errors'         => $errors,
                'old'            => $_POST
            ]);
            return;
        }

        $this->produkModel->update($id, [
            'kategori_id' => $kategori,
            'nama_produk' => $nama,
            'harga'       => $harga,
            'stok'        => $stok,
            'deskripsi'   => $deskripsi
        ]);

        $_SESSION['pesan_sukses'] = 'Data produk berhasil diperbarui!';
        $this->redirect('/produk');
    }

    // [POST /produk/delete] Hapus data produk
    public function delete() {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $this->produkModel->delete($id);
            $_SESSION['pesan_sukses'] = 'Produk berhasil dihapus!';
        }
        $this->redirect('/produk');
    }
}
