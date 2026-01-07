
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
# PULSA — Publik Suara Aspirasi

Ringkasan singkat
- PULSA adalah aplikasi web untuk jurnalisme warga dan partisipasi publik. Pengguna bisa melihat berita/opini dan — jika terdaftar — mengirim opini. Admin dapat memoderasi konten, mengelola tim, dan pengguna.

Persyaratan
- PHP 8.1+ (disarankan 8.2)
- Composer
- Node.js & npm
- Database MySQL / MariaDB (atau driver DB lain yang kompatibel dengan Laravel)

Setup (lokal)
1. Clone repository

```bash
git clone <repo-url> .
```

2. Install dependensi PHP

```bash
composer install
```

3. Environment

```bash
cp .env.example .env   # (PowerShell: copy .env.example .env)
```
Edit `.env` untuk set `DB_*`, `APP_URL`, dan kredensial lain.

4. Key & database

```bash
php artisan key:generate
php artisan migrate --seed   # seeder opsional
```

5. Storage link

```bash
php artisan storage:link
```

6. Frontend

```bash
npm install
npm run dev    # atau `npm run build` untuk produksi
```

7. Jalankan server

```bash
php artisan serve
```

Umum: buka http://127.0.0.1:8000

Perintah berguna
- `composer dump-autoload` — regenerate autoload classmap setelah menambah/hapus kelas
- `php artisan view:clear` — bersihkan cache Blade
- `php artisan cache:clear` — bersihkan cache aplikasi

Akun demo (opsional)
- Buat user lewat halaman register, atau gunakan seeder/tinker untuk membuat admin manual.

Perilaku aplikasi penting
- Kirim Opini: pengiriman opini membutuhkan autentikasi. Jika pengguna belum login, akses `/kirim-opini` akan diarahkan ke halaman registrasi/login.
- Upload file: pastikan `public/storage` tersedia (jalankan `php artisan storage:link`).

Kontak maintainers
- Email: Pulsacs187@gmail.com (link membuka Gmail compose di antarmuka)

Catatan pengembangan
- Beberapa fitur (mis. Suara Pembaca) sempat dimodifikasi/dihapus di kode — cek migration/file terkait jika ingin sepenuhnya menghapus schema.

Lisensi & Kontribusi
- Tambahkan keterangan lisensi atau aturan kontribusi jika diperlukan.

---
Kelompok 4 — PULSA

