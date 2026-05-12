# MPPL

Proyek ini adalah aplikasi Laravel yang dijalankan dengan Docker Compose. Source code aplikasi ada di folder `src/`, sedangkan service pendukung ada di `php/`, `nginx/`, dan `db/`.

## Cara Clone

```bash
git clone <URL_REPOSITORY>
cd mppl
```

Ganti `<URL_REPOSITORY>` dengan URL repository yang kamu gunakan.

## Cara Menjalankan Project

1. Pastikan Docker dan Docker Compose sudah terpasang di komputer.
2. Jalankan container dari root project:

```bash
docker compose up -d --build
```

3. Tunggu sampai proses inisialisasi selesai. Saat pertama kali dijalankan, container PHP akan:
   - membuat project Laravel jika folder `src/` masih kosong,
   - membuat file `.env`,
   - install dependency Composer,
   - menjalankan migrasi database.

4. Buka aplikasi melalui browser:
   - HTTP: `http://localhost`
   - HTTPS: `https://localhost`

## Akses Database

- Host: `127.0.0.1`
- Port: `13306`
- User: `root`
- Password: `p455w0rd`
- Database: mengikuti nilai `PROJECT_NAME` di file `.env`

## Perintah Berguna

```bash
# Melihat log container
docker compose logs -f

# Menghentikan project
docker compose down

# Masuk ke container PHP
docker compose exec php bash

# Jalankan ulang migrasi
docker compose exec php php artisan migrate --force
```

## Catatan

Jika kamu ingin memakai domain lokal seperti `*.test`, sesuaikan konfigurasi `hosts`, SSL, dan nilai `APP_URL` di file `.env` sesuai kebutuhan proyek.
