 # PULSA — Publik Suara Aspirasi

**Kelompok:** Kelompok 4
- Ahmad Sahrul F - 20241320031

## Deskripsi Aplikasi
PULSA adalah aplikasi web untuk jurnalisme warga dan partisipasi publik. Aplikasi ini memungkinkan masyarakat mengirimkan opini dan berita, sementara tim admin dapat memoderasi konten, mengelola tim, serta mengatur pengguna.

Fitur utama:
- Halaman depan (landing page) yang menampilkan berita, opini terbaru, dan informasi tentang PULSA
- Sistem komentar pada berita detail untuk partisipasi pembaca
- Panel admin untuk moderasi berita, opini, tim, dan pengguna
- Panel pengguna untuk mengirim opini, melihat status, dan mengedit profil
- Upload foto untuk profil pengguna dan penulis opini
- Sistem role berbasis (super-admin dan Admin)
- Auto-approve opini untuk pengguna terautentikasi

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
Jika Anda membutuhkan akun untuk pengujian, gunakan akun berikut:

- Super Admin (Full Access):
	- Email: admin@pulsa.id
	- Password: password

- Admin (Limited Access - Manage berita, opini, tim):
	- Email: staff@pulsa.id
	- Password: password

- User biasa: Daftar melalui halaman register atau gunakan:
	- Email: rain@pulsa.id
	- Password: password
	- Profesi: RR

**Catatan:** Pengguna baru dapat langsung mengirim opini dan akan langsung diapprove jika sudah terdaftar.


## Catatan Tambahan
- Opini yang dikirim oleh pengguna terautentikasi langsung disetujui (status: approved) dan muncul di dashboard
- Opini dari guest dikirim dengan status pending dan menunggu approval dari admin
- Pengguna dapat menambah komentar pada berita detail untuk berpartisipasi lebih lanjut
- Foto profil yang di-upload harus berformat JPG/PNG dengan ukuran max 2MB
- Jika gambar hasil upload tidak terlihat, pastikan `php artisan storage:link` sudah dijalankan
- Admin panel dapat diakses di `/admin` dengan role super-admin atau Admin
- User panel dapat diakses di `/user/panel` untuk melihat opini yang telah dikirim

## Teknologi yang Digunakan
- Laravel 10.50.0 - Backend framework
- PHP 8.2.12 - Language runtime
- MySQL - Database
- Bootstrap 5.3.2 - Frontend framework
- Font Awesome 6 - Icon library
- Spatie Permission - Role & permission management
- Blade Template Engine - Server-side templating


---
Kelompok 4 — PULSA

