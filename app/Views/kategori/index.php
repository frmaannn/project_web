<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Daftar Kategori</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Jumlah Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarKategori)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">Belum ada kategori.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($daftarKategori as $kat): ?>
                                <tr>
                                    <td><?= $kat['id'] ?></td>
                                    <td><strong><?= htmlspecialchars($kat['nama_kategori']) ?></strong></td>
                                    <td><?= htmlspecialchars($kat['keterangan'] ?? '-') ?></td>
                                    <td><?= $kat['total_produk'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Tambah Kategori</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>/kategori/store">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control <?= isset($errors['nama_kategori']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['nama_kategori'] ?? '') ?>">
                        <?php if (isset($errors['nama_kategori'])): ?>
                            <div class="invalid-feedback"><?= $errors['nama_kategori'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($old['keterangan'] ?? '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Kategori</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
