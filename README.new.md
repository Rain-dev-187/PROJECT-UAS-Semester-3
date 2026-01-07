# PULSA — Publik Suara Aspirasi

Singkat
- PULSA adalah aplikasi Laravel untuk jurnalisme warga: berita, opini, dan moderasi.

Persyaratan
- PHP 8.1+ (disarankan 8.2)
- Composer
- Node.js & npm
- MySQL / MariaDB (atau DB lain kompatibel dengan Laravel)

Instalasi (lokal)

1. Clone repository

```bash
git clone <repo-url> .
```

2. Install dependensi PHP

```bash
composer install
```

3. Salin .env dan atur konfigurasi

```bash
copy .env.example .env    # PowerShell
```
Edit `.env` untuk `DB_*`, `APP_URL`, dan kredensial lain.

4. Generate key & migrasi

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

Perintah berguna
- `composer dump-autoload` — regenerasi autoload setelah menambah/hapus kelas
- `php artisan view:clear` — bersihkan cache Blade
- `php artisan cache:clear` — bersihkan cache aplikasi

Catatan penting
- Kirim Opini: pengiriman opini memerlukan autentikasi. Akses `/kirim-opini` akan mengarahkan pengguna yang belum login ke halaman registrasi/login.
- Fitur "Suara Pembaca": UI dan model telah dihapus dari kode; migrasi untuk tabel `suara_pembacas` masih ada. Jika kamu ingin menghapus schema dari database, jalankan:

  - Hapus table manual (MySQL): `DROP TABLE suara_pembacas;`
  - Atau buat migration yang meng-drop table dan jalankan `php artisan migrate`.

Contoh .env (ringkas)

```
APP_NAME=PULSA
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=Pulsacs187@gmail.com
MAIL_FROM_NAME="PULSA"
```

Kontak
- Email: Pulsacs187@gmail.com (link Gmail compose tersedia di antarmuka)
- WhatsApp: +62 882-2058-8345 (wa.me/6288220588345)

Pengembangan dan debugging
- Jika menghapus kelas atau file, jalankan `composer dump-autoload` dan bersihkan view cache: `php artisan view:clear`.

Lisensi
- Tambahkan lisensi proyek bila perlu.

---
Made with care.
