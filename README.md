 # PULSA — Publik Suara Aspirasi

**Kelompok:** Kelompok 4

## Deskripsi Aplikasi
PULSA adalah aplikasi web untuk jurnalisme warga dan partisipasi publik. Aplikasi ini memungkinkan masyarakat mengirimkan opini dan suara pembaca, sementara tim admin dapat memoderasi konten, mengelola tim, serta mengatur pengguna.

Fitur utama:
- Halaman depan (landing page) yang menampilkan berita, opini, dan suara pembaca
- Panel admin untuk moderasi berita, opini, suara pembaca, tim, dan pengguna
- Panel pengguna untuk mengirim opini dan suara serta melihat status kiriman
- Upload gambar untuk penulis/opini dan anggota tim

## Cara Instalasi (Lokal)
Persyaratan minimal:
- PHP 8.1 atau lebih baru
- Composer
- Node.js dan npm
- MySQL (atau database lain yang kompatibel dengan Laravel)

Langkah instalasi:

1. Clone repository ke direktori kerja:

```bash
git clone <repo-url> .
```

2. Install dependensi PHP:

```bash
composer install
```

3. Salin file environment dan atur konfigurasi database:

```bash
cp .env.example .env
# Pada Windows PowerShell gunakan:
copy .env.example .env
```

Edit file `.env` untuk mengisi `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai pengaturan lokal Anda.

4. Generate application key:

```bash
php artisan key:generate
```

5. Jalankan migrasi dan seeder (opsional):

```bash
php artisan migrate --seed
```

6. Buat symlink storage agar file hasil upload dapat diakses melalui web:

```bash
php artisan storage:link
```

7. Install dependensi frontend dan build aset:

```bash
npm install
npm run dev
# atau untuk produksi:
npm run build
```

8. Jalankan server lokal:

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser.

Catatan penting:
- Pastikan folder `storage` dan `bootstrap/cache` dapat ditulisi (writable).
- Jika aset CSS/JS tidak muncul, jalankan `npm run dev` lalu refresh browser.

## Akun Dummy (untuk testing)
Jika Anda membutuhkan akun untuk pengujian, gunakan akun berikut (atau buat lewat seeder/register):

- Admin (super-admin / staff):
	- Email: admin@pulsa.test
	- Password: password123

- Staff:
	- Email: staff@pulsa.test
	- Password: password123

- User biasa: Daftar Manual
	

Jika seeder belum tersedia, Anda dapat membuat akun secara manual melalui halaman pendaftaran atau menggunakan `php artisan tinker`. Contoh membuat akun melalui Tinker:

```php
// Jalankan pada terminal: php artisan tinker
\App\Models\User::create([
		'name' => 'Admin',
		'email' => 'admin@pulsa.test',
		'password' => bcrypt('password123'),
]);
```

## Catatan Tambahan
- Opini dan Suara Pembaca yang dikirim biasanya disimpan dengan status `pending` dan perlu disetujui oleh admin agar muncul di halaman depan.
- Jika gambar hasil upload tidak terlihat, pastikan `php artisan storage:link` sudah dijalankan dan file tersimpan di `public/storage`.

---
Kelompok 4 — PULSA

