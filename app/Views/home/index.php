<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-primary text-white mb-3">
            <div class="card-body">
                <h6 class="card-title">Total Jenis Produk</h6>
                <h2 class="fw-bold"><?= $ringkasan['total_produk'] ?? 0 ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-success text-white mb-3">
            <div class="card-body">
                <h6 class="card-title">Total Stok Barang</h6>
                <h2 class="fw-bold"><?= $ringkasan['total_stok'] ?? 0 ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-secondary text-white mb-3">
            <div class="card-body">
                <h6 class="card-title">Kategori Terdaftar</h6>
                <h2 class="fw-bold"><?= $totalKategori ?? 0 ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Produk Terbaru</h5>
            <a href="<?= BASE_URL ?>/produk" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produkTerbaru)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-3">Belum ada data produk.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($produkTerbaru as $i => $item): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= htmlspecialchars($item['nama_produk']) ?></strong></td>
                                <td><?= htmlspecialchars($item['nama_kategori']) ?></td>
                                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td><?= $item['stok'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
