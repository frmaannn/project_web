<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100 text-center">
    <div>
        <h1 class="display-1 fw-bold text-danger">404</h1>
        <h4>Halaman Tidak Ditemukan</h4>
        <p class="text-muted">Rute URL yang dituju tidak ada.</p>
        <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" class="btn btn-primary btn-sm">Kembali ke Home</a>
    </div>
</body>
</html>
