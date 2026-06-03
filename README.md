# MPPL HR System

MPPL HR System adalah aplikasi manajemen HR berbasis Laravel 12 dan Filament 3. Aplikasi ini berisi satu landing page publik dan panel admin Filament untuk mengelola data karyawan, pengajuan cuti, penggajian, dan laporan.

Project ini berjalan di atas Docker Compose dengan service terpisah untuk PHP, Nginx, dan MariaDB. Source code Laravel berada di folder `src/`.

## Ringkasan Fitur

- Landing page publik di `/`.
- Panel admin Filament di `/admin`.
- CRUD data karyawan di `/admin/karyawan`.
- Pengajuan cuti dan approval/reject cuti di `/admin/cuti`.
- Data penggajian dan detail slip gaji di `/admin/penggajian`.
- Pusat laporan dan preview laporan di `/admin/laporan`.
- Authentication Filament, edit profile, role/permission via Filament Shield.
- Bootstrap otomatis saat container PHP start: membuat `src/.env`, install Composer dependency, install Node dependency, build Vite asset, migrasi, dan seed data.
- Seed data awal untuk user admin, role, karyawan, cuti, dan gaji.
- Testing menggunakan Pest PHP.
- Formatting PHP menggunakan Laravel Pint.

## Tech Stack

- Laravel 12
- PHP 8.2+
- Filament 3.3
- Filament Shield
- Spatie Laravel Permission
- Tailwind CSS 3.4
- Vite
- Pest PHP
- Laravel Pint
- MariaDB 10.11
- Docker Compose

## Struktur Project

```text
.
├── docker-compose.yml        # Definisi service php, nginx, db
├── .env                      # Variabel Docker Compose root
├── php/                      # Dockerfile dan konfigurasi PHP-FPM
├── nginx/                    # Dockerfile, vhost, dan sertifikat lokal
├── db/                       # Konfigurasi dan data MariaDB
└── src/                      # Root aplikasi Laravel
    ├── app/Filament/Admin/   # Resource, page, widget panel admin
    ├── app/Models/           # Model Eloquent
    ├── database/migrations/  # Migration aplikasi
    ├── database/seeders/     # Seeder user, role, dan data HR
    ├── resources/views/      # Landing page dan view Filament custom
    ├── routes/web.php        # Route publik dan redirect lama
    └── tests/                # Test Pest
```

## Modul Aplikasi

### Landing Page

Route `/` menampilkan landing page di `src/resources/views/landing.blade.php`. Halaman ini berisi pintasan ke panel admin dan ringkasan jumlah data HR.

### Panel Admin Filament

Panel Filament tersedia di:

```text
https://mppl.test/admin
```

Resource utama:

- `EmployeeResource` untuk data karyawan.
- `LeaveRequestResource` untuk pengajuan dan approval cuti.
- `PayrollRecordResource` untuk penggajian dan slip gaji.
- `ReportCenter` dan `ReportPreview` untuk pusat laporan.

### Karyawan

URL:

```text
/admin/karyawan
```

Data utama:

- NIK
- Nama
- Jabatan
- Departemen
- Tanggal masuk
- Email
- Telepon
- Status

### Cuti

URL:

```text
/admin/cuti
```

Fitur:

- Membuat pengajuan cuti.
- Melihat status cuti: `Menunggu`, `Disetujui`, `Ditolak`.
- Approve cuti langsung dari tabel.
- Reject cuti dengan catatan reviewer.

### Penggajian

URL:

```text
/admin/penggajian
```

Komponen gaji:

- Gaji pokok
- Tunjangan
- Potongan kehadiran
- Gaji bersih

Rumus:

```text
gaji bersih = gaji pokok + tunjangan - potongan kehadiran
```

### Laporan

URL:

```text
/admin/laporan
```

Jenis laporan:

- Daftar Karyawan
- Riwayat Cuti
- Slip Gaji

Format preview:

- PDF
- Excel

Catatan: fitur laporan saat ini berupa preview berbasis tabel. Export file fisik PDF/XLSX belum dibuat.

## Route Publik dan Redirect

Halaman prototype lama sudah dihapus. Route lama tetap diarahkan ke halaman Filament agar link lama tidak langsung 404.

| Route Lama | Redirect Ke |
| --- | --- |
| `/dashboard` | `/` |
| `/karyawan` | `/admin/karyawan` |
| `/karyawan/create` | `/admin/karyawan/create` |
| `/cuti` | `/admin/cuti` |
| `/cuti/pengajuan` | `/admin/cuti/create` |
| `/cuti/approval` | `/admin/cuti` |
| `/penggajian` | `/admin/penggajian` |
| `/penggajian/slip` | `/admin/penggajian` |
| `/laporan` | `/admin/laporan` |

## Akun Login Default

Seeder membuat akun berikut:

```text
Email: admin@admin.com
Password: password
Role: super_admin
```

```text
Email: user@admin.com
Password: password
Role: user
```

## Data Seed HR

Seeder `HrDataSeeder` menambahkan data contoh:

- Karyawan: Ayu Permata Sari, Bima Pratama, Citra Lestari.
- Cuti: contoh status menunggu, disetujui, dan ditolak.
- Penggajian: data gaji periode Mei 2026.

Seeder utama berada di:

```text
src/database/seeders/DatabaseSeeder.php
```

## Menjalankan Project

Pastikan Docker dan Docker Compose sudah tersedia.

1. Clone repository.

```bash
git clone <URL_REPOSITORY>
cd mppl
```

2. Daftarkan domain lokal.

```bash
./scripts/setup-hosts.sh
```

Script ini menambahkan entry berikut ke `/etc/hosts` jika belum ada, dan akan meminta password `sudo`:

```text
127.0.0.1 mppl.test
```

3. Jalankan container.

```bash
docker compose up -d --build
```

Perintah ini sudah menyiapkan aplikasi secara otomatis:

- Membuat `src/.env` jika belum ada.
- Menunggu database siap.
- Menjalankan `composer install` jika `src/vendor/` belum ada.
- Menjalankan `npm ci` jika `src/node_modules/` belum ada.
- Menjalankan `npm run build` jika `src/public/build/manifest.json` belum ada.
- Menjalankan migrasi database.
- Menjalankan seeder.
- Membuat storage link.
- Membersihkan cache Laravel.

4. Buka aplikasi.

```text
https://mppl.test
https://mppl.test/admin
```

Jika browser menampilkan peringatan SSL, lanjutkan melalui opsi advanced karena sertifikat lokal di `nginx/ssl` bersifat self-signed.

## Konfigurasi Environment

Root `.env` bersifat opsional. `docker-compose.yml` sudah memiliki default `mppl`, sehingga fresh clone bisa langsung menjalankan `docker compose up -d --build` tanpa membuat file `.env` terlebih dahulu.

Jika perlu override nama project, salin `.env.example` menjadi `.env`.

```text
COMPOSE_PROJECT_NAME=mppl
PROJECT_NAME=mppl
```

File `src/.env` dipakai Laravel. Pada fresh clone file ini dibuat otomatis oleh `php/docker-entrypoint.sh`. Jika perlu membuat manual, gunakan `src/.env.example` sebagai acuan.

```env
APP_URL=https://mppl.test
ASSET_URL=https://mppl.test
DB_CONNECTION=mariadb
DB_HOST=db
DB_PORT=3306
DB_DATABASE=mppl
DB_USERNAME=root
DB_PASSWORD=p455w0rd
```

## Akses Database

MariaDB diekspos ke host melalui port `13306`.

```text
Host: 127.0.0.1
Port: 13306
User: root
Password: p455w0rd
Database: mppl
```

Nama database mengikuti `PROJECT_NAME` di root `.env`.

## Command Penting

Semua command Laravel/Composer/PHP dijalankan melalui container PHP.

```bash
# Melihat status container
docker compose ps

# Melihat log semua service
docker compose logs -f

# Masuk ke shell container PHP
docker compose exec php bash

# Menjalankan migrasi
docker compose exec php php artisan migrate

# Menjalankan seeder
docker compose exec php php artisan db:seed

# Reset database lalu seed ulang
docker compose exec php php artisan migrate:fresh --seed

# Melihat route admin
docker compose exec php php artisan route:list --path=admin

# Membersihkan cache Laravel
docker compose exec php php artisan optimize:clear

# Compile cache Blade untuk validasi syntax view
docker compose exec php php artisan view:cache

# Membersihkan cache Blade setelah validasi
docker compose exec php php artisan view:clear
```

## Frontend Assets

Vite asset di `src/public/build/` tidak disimpan di Git karena merupakan hasil build. Pada fresh clone, entrypoint PHP akan menjalankan `npm ci` dan `npm run build` otomatis ketika manifest belum ada.

Untuk development manual, Vite dijalankan dari folder `src/`.

```bash
docker compose exec php npm install
docker compose exec php npm run dev
```

Build production:

```bash
docker compose exec php npm run build
```

## Testing dan Formatting

Jalankan test Pest:

```bash
docker compose exec php php artisan test
```

Jalankan Laravel Pint:

```bash
docker compose exec php ./vendor/bin/pint
```

Test yang sudah ada:

- Feature test root `/`.
- Unit test perhitungan gaji bersih.

## Troubleshooting

### Error halaman laporan: `unexpected token "use"`

Pastikan tidak ada `use` statement PHP di dalam blok `@php` pada Blade. Import class di Blade sebaiknya memakai fully qualified class name seperti:

```php
\App\Filament\Admin\Pages\ReportPreview::getUrl()
```

### Landing page error tabel tidak ditemukan

Landing page sudah dibuat aman untuk database kosong dengan pengecekan `Schema::hasTable()`. Jika data tidak muncul, jalankan:

```bash
docker compose exec php php artisan migrate --force
docker compose exec php php artisan db:seed --force
```

### Perubahan view tidak muncul

Bersihkan cache:

```bash
docker compose exec php php artisan view:clear
docker compose exec php php artisan optimize:clear
```

### Domain lokal belum terbuka

Cek:

- Entry hosts `127.0.0.1 mppl.test`.
- Container Nginx sudah berjalan.
- `APP_URL` dan `ASSET_URL` di `src/.env`.
- Sertifikat lokal di `nginx/ssl/`.

## Catatan Pengembangan

- Jangan mengedit halaman prototype lama karena view tersebut sudah dihapus.
- Tambahkan fitur admin baru melalui Filament Resource atau Filament Page.
- Simpan logic domain di model/service, bukan di Blade.
- Gunakan Pest untuk test baru.
- Gunakan Pint sebelum commit.
- Untuk permission, gunakan Filament Shield dan role `super_admin`.
