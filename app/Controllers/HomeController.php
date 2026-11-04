<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Produk;
use App\Models\Kategori;

class HomeController extends Controller {
    public function index() {
        $produkModel = new Produk();
        $kategoriModel = new Kategori();

        $ringkasan = $produkModel->hitungTotal();
        $semuaKategori = $kategoriModel->getAll();
        $produkTerbaru = array_slice($produkModel->getAll(), 0, 5);

        $this->view('home/index', [
            'ringkasan'     => $ringkasan,
            'totalKategori' => count($semuaKategori),
            'produkTerbaru' => $produkTerbaru
        ]);
    }
}
