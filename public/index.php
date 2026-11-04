<?php
session_start();

// Deteksi base URL otomatis
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$subDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = rtrim('http://' . $host . $subDir, '/');
define('BASE_URL', $baseUrl);

// Autoload class sederhana
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    if (strncmp($prefix, $class, strlen($prefix)) === 0) {
        $rel = substr($class, strlen($prefix));
        $file = $baseDir . str_replace('\\', '/', $rel) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\ProdukController;
use App\Controllers\KategoriController;

$router = new Router();

// Rute GET
$router->get('/', [HomeController::class, 'index']);
$router->get('/produk', [ProdukController::class, 'index']);
$router->get('/produk/create', [ProdukController::class, 'create']);
$router->get('/produk/edit', [ProdukController::class, 'edit']);
$router->get('/kategori', [KategoriController::class, 'index']);

// Rute POST
$router->post('/produk/store', [ProdukController::class, 'store']);
$router->post('/produk/update', [ProdukController::class, 'update']);
$router->post('/produk/delete', [ProdukController::class, 'delete']);
$router->post('/kategori/store', [KategoriController::class, 'store']);

$router->run();
