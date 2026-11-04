# Aplikasi Web Inventaris Produk (PHP Native MVC)

Proyek aplikasi web inventaris sederhana menggunakan PHP native dengan pola MVC (Model-View-Controller) dan database MySQL (PDO prepared statements).

## Ketentuan yang Terpenuhi
1. **2 Tabel Database**: `kategori` dan `produk` (relasi Foreign Key `kategori_id`).
2. **CRUD Lengkap**:
   - Create: Tambah produk (`/produk/store`)
   - Read: Tampil produk (`/produk`)
   - Update: Edit produk (`/produk/update`)
   - Delete: Hapus produk (`/produk/delete`)
3. **Rute**:
   - GET: `/`, `/produk`, `/produk/create`, `/produk/edit`, `/kategori`
   - POST: `/produk/store`, `/produk/update`, `/produk/delete`, `/kategori/store`
4. **Validasi Controller**:
   - Pengecekan input kosong pada nama produk, harga, stok, dan kategori.
   - Pengecekan nilai numerik dan non-negatif pada harga dan stok.
   - Mengembalikan pesan error ke view jika validasi tidak lolos.

## Cara Menjalankan

1. **Import Database**:
   - Buat database `db_inventaris` di phpMyAdmin atau terminal.
   - Import file `database.sql`.

2. **Pengaturan Koneksi**:
   - Buka `app/Config/Database.php`.
   - Sesuaikan `$host`, `$db`, `$user`, dan `$pass` jika berbeda dari default.

3. **Jalankan Server**:
   Buka terminal di folder proyek lalu ketik:
   ```bash
   php -S localhost:8000 -t public
   ```
   Buka browser di `http://localhost:8000`.
