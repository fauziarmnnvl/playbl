# Panduan Instalasi Lokal (BoxPlay.id)

Dokumentasi ini berisi langkah-langkah untuk menginstal dan menjalankan Sistem Informasi Layanan dan Pemesanan Playbox secara lokal di komputer masing-masing pengembang.

## Persyaratan Sistem (Prerequisites)
Sebelum memulai instalasi, pastikan laptop/komputer kamu sudah terinstal perangkat lunak berikut:
- **PHP** (Minimal versi 8.2 atau lebih baru)
- **Composer** (Package manager untuk PHP)
- **Node.js & NPM** (Untuk kompilasi asset Front-End)
- **MySQL / MariaDB** (Bisa menggunakan XAMPP, Laragon, atau native)
- **Git** (Untuk version control)

---

## Langkah Instalasi

**1. Clone Repositori**
Buka terminal (atau Git Bash) dan jalankan perintah berikut untuk mengunduh kode dari GitHub:
`git clone https://github.com/fauziarmnnvl/playbl.git`
`cd playbl`
*(Catatan untuk tim: Pastikan kalian berada di branch yang tepat, misal development, menggunakan perintah: `git checkout development`)*

**2. Instal Dependensi Back-End (PHP)**
Unduh semua library pihak ketiga (termasuk Filament, Livewire, dll) dengan Composer:
`composer install`

**3. Instal Dependensi Front-End (JavaScript & CSS)**
Unduh package bawaan untuk UI (seperti Tailwind CSS dan Bootstrap):
`npm install`

**4. Siapkan File Konfigurasi Environment**
Gandakan file `.env.example` menjadi `.env` agar aplikasi memiliki pengaturan lokal:
`cp .env.example .env`
*(Pengguna Windows CMD bisa menggunakan perintah: `copy .env.example .env`)*

**5. Konfigurasi Database**
- Buka aplikasi XAMPP / Laragon dan jalankan **MySQL**.
- Buat database baru bernama `playbl` (atau nama lain sesuai kesepakatan) melalui phpMyAdmin atau terminal MySQL.
- Buka file `.env` di text editor (VS Code), lalu sesuaikan bagian ini:
  `DB_CONNECTION=mysql`
  `DB_HOST=127.0.0.1`
  `DB_PORT=3306`
  `DB_DATABASE=playbl`
  `DB_USERNAME=root`
  `DB_PASSWORD=`
*(Kosongkan DB_PASSWORD jika menggunakan XAMPP default, atau sesuaikan dengan password database-mu).*

**6. Generate Application Key**
Buat kunci enkripsi unik untuk keamanan aplikasi Laravel:
`php artisan key:generate`

**7. Jalankan Migrasi Database**
Buat struktur tabel ke dalam database MySQL yang sudah disiapkan:
`php artisan migrate`

**8. Buat Akun Admin (Filament)**
Karena sistem admin menggunakan Filament, buat satu akun utama untuk bisa login ke dashboard back-office:
`php artisan make:filament-user`
*(Terminal akan meminta kamu memasukkan Nama, Email, dan Password untuk akun admin).*

**9. Build Asset Front-End**
Proses file CSS dan JavaScript agar tampilan website tidak berantakan. 
- Untuk tahap pengembangan (development), gunakan: `npm run dev`
- Untuk produksi (final), gunakan: `npm run build`

**10. Jalankan Server Lokal**
Buka terminal baru (biarkan terminal npm run dev tetap berjalan), lalu ketik:
`php artisan serve`

Aplikasi sekarang bisa diakses melalui browser di alamat:
- **Halaman Pelanggan:** http://localhost:8000
- **Halaman Admin:** http://localhost:8000/admin (Gunakan akun admin yang dibuat pada langkah 8).

---

## Troubleshooting (Solusi Masalah Umum)

| Masalah | Penyebab & Solusi |
| :--- | :--- |
| **Error 500 / No Application Encryption Key** | Lupa menjalankan perintah `php artisan key:generate`. Jalankan perintah tersebut lalu refresh browser. |
| **SQLSTATE[HY000] [1049] Unknown database** | Nama database di file `.env` tidak sama dengan yang ada di phpMyAdmin, atau kamu belum membuat databasenya. |
| **Tampilan Website Hancur / Berantakan** | File CSS belum dikompilasi. Pastikan kamu sudah menjalankan `npm install` dan membiarkan `npm run dev` berjalan di terminal. |
| **Target class [Controller] does not exist** | Periksa file `routes/web.php`. Pastikan namespace dan import Controller sudah ditulis dengan benar di Laravel 11. |
| **Gagal menjalankan composer install** | Versi PHP di laptopmu terlalu rendah (dibawah 8.2). Silakan update XAMPP/Laragon atau instal versi PHP yang sesuai. |