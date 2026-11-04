<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Edit Data Produk</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>/produk/update">
                    <input type="hidden" name="id" value="<?= $produk['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control <?= isset($errors['nama_produk']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['nama_produk'] ?? '') ?>">
                        <?php if (isset($errors['nama_produk'])): ?>
                            <div class="invalid-feedback"><?= $errors['nama_produk'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select <?= isset($errors['kategori_id']) ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($daftarKategori as $kat): ?>
                                <option value="<?= $kat['id'] ?>" <?= ((isset($old['kategori_id']) ? $old['kategori_id'] : '') == $kat['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kat['nama_kategori']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['kategori_id'])): ?>
                            <div class="invalid-feedback"><?= $errors['kategori_id'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control <?= isset($errors['harga']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['harga'] ?? '') ?>">
                            <?php if (isset($errors['harga'])): ?>
                                <div class="invalid-feedback"><?= $errors['harga'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control <?= isset($errors['stok']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($old['stok'] ?? '') ?>">
                            <?php if (isset($errors['stok'])): ?>
                                <div class="invalid-feedback"><?= $errors['stok'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($old['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= BASE_URL ?>/produk" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
