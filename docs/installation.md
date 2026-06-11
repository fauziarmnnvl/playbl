# Installation Documentation

Dokumen ini menjelaskan langkah instalasi proyek **Sistem Informasi Layanan dan Pemesanan Playbox Berbasis Web (BoxPlay.id)** pada lingkungan lokal.

## Persyaratan Sistem

* PHP 8.2 atau lebih baru
* Composer
* Node.js dan NPM
* MySQL atau MariaDB
* Git
* Web browser modern
* Terminal atau PowerShell

## Clone Repository

```bash
git clone <url-repository>
cd playbl
```

Ganti `<url-repository>` dengan URL repository GitHub proyek Kelompok 2.

## Install Dependency Backend

```bash
composer install
```

Perintah ini membaca file `composer.json` dan memasang seluruh dependency PHP yang dibutuhkan aplikasi.

## Install Dependency Frontend

```bash
npm install
```

Perintah ini membaca file `package.json` dan memasang seluruh dependency frontend yang dibutuhkan aplikasi.

## Setup Environment

Salin file environment contoh:

```bash
cp .env.example .env
```

Pada Windows PowerShell, jika perintah `cp` tidak tersedia, gunakan:

```powershell
Copy-Item .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

## Setup Database

Buat database MySQL atau MariaDB melalui phpMyAdmin atau terminal.

Contoh nama database:

```text
db_playbl
```

Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_playbl
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migration dan seeder untuk membuat struktur tabel serta data awal:

```bash
php artisan migrate --seed
```

## Build Asset Frontend

### Production Build

```bash
npm run build
```

### Development Mode

```bash
npm run dev
```

> **Catatan Windows PowerShell:** Jika `npm` diblokir karena execution policy, gunakan `npm.cmd`.

```bash
npm.cmd run build
npm.cmd run dev
```

## Menjalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan pada alamat:

```text
http://127.0.0.1:8000
```

## Menjalankan Test

```bash
php artisan test
```

Proyek menggunakan **Pest PHP** sebagai framework testing. Pest berjalan di atas PHPUnit dan tetap menggunakan ekosistem testing Laravel untuk menguji keandalan sistem BoxPlay.id.

## Kredensial dan Akses Default

Sistem BoxPlay.id memisahkan antarmuka pengguna biasa dan manajemen pengelola. Saat perintah `migrate --seed` dijalankan, sistem akan membuat akun dummy untuk memudahkan proses pengujian selama tahap pengembangan.

### Struktur Akses

#### Pelanggan

* Mengakses halaman utama (Front-end)
* Melakukan pemesanan (Self-service)
* Melihat riwayat bermain

#### Admin

* Mengelola operasional sistem
* Memantau ketersediaan Playbox
* Mengelola data master
* Mengelola transaksi dan laporan sistem

> **Catatan untuk Developer:** Silakan periksa file `DatabaseSeeder.php` untuk melihat email dan password default yang dapat digunakan saat pengujian login.

## Troubleshooting

### APP_KEY Belum Dibuat

**Gejala**

```text
No application encryption key has been specified.
```

**Solusi**

```bash
php artisan key:generate
```

---

### Database Belum Tersedia

**Gejala**

```text
SQLSTATE[HY000] [1049] Unknown database
```

**Solusi**

* Buat database sesuai nilai `DB_DATABASE`
* Periksa `DB_USERNAME` dan `DB_PASSWORD` pada file `.env`
* Jalankan ulang migration

```bash
php artisan migrate --seed
```

---

### NPM Diblokir PowerShell

**Gejala**

```text
npm.ps1 cannot be loaded because running scripts is disabled on this system
```

**Solusi**

```bash
npm.cmd install
npm.cmd run build
```

---

### Asset Masih Mengarah ke Vite Development Server

**Gejala**

```text
http://[::1]:5173
```

* File CSS tidak termuat
* File JavaScript tidak termuat
* Tampilan website tidak sesuai pada mode production

**Solusi**

* Hentikan Vite Development Server jika tidak digunakan
* Hapus file `public/hot` jika masih ada
* Jalankan build ulang

```bash
npm run build
```

---

### Cache Konfigurasi Bermasalah

**Solusi**

```bash
php artisan optimize:clear
```

---

### Permission Storage Bermasalah (Linux/macOS)

**Solusi**

```bash
chmod -R 775 storage bootstrap/cache
```

Pada Windows, pastikan folder `storage` dan `bootstrap/cache` memiliki izin tulis untuk aplikasi.

## Verifikasi Instalasi

Instalasi dianggap berhasil apabila:

* Halaman utama (Self-service) BoxPlay.id dapat diakses
* Halaman registrasi dan login pelanggan berfungsi dengan baik
* Dashboard administrasi dapat diakses sesuai hak akses pengguna
* Migration dan Seeder berhasil dijalankan
* Seluruh test berjalan tanpa kegagalan
* Asset frontend berhasil dibangun menggunakan Vite

## Ringkasan Instalasi Cepat

```bash
git clone <url-repository>
cd playbl

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm run build

php artisan serve
```
