<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Produk</h4>
    <a href="<?= BASE_URL ?>/produk/create" class="btn btn-primary">+ Tambah Produk</a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="<?= BASE_URL ?>/produk" class="row g-2">
            <div class="col-md-10">
                <input type="text" name="cari" class="form-control" placeholder="Cari nama produk atau kategori..." value="<?= htmlspecialchars($cari ?? '') ?>">
            </div>
            <div class="col-md-2 d-flex gap-1">
                <button type="submit" class="btn btn-dark w-100">Cari</button>
                <?php if (!empty($cari)): ?>
                    <a href="<?= BASE_URL ?>/produk" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarProduk)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Data produk tidak ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarProduk as $i => $row): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= htmlspecialchars($row['nama_produk']) ?></strong></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($row['nama_kategori']) ?></span></td>
                                <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                                <td><?= $row['stok'] ?></td>
                                <td><?= htmlspecialchars($row['deskripsi'] ?? '-') ?></td>
                                <td class="text-center">
                                    <a href="<?= BASE_URL ?>/produk/edit?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form method="POST" action="<?= BASE_URL ?>/produk/delete" class="d-inline" onsubmit="return confirm('Hapus produk ini?');">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
