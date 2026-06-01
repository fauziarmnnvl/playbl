# Sistem Informasi Layanan dan Pemesanan Playbox Berbasis Web

## Deskripsi Proyek
Proyek ini bertujuan untuk mengembangkan Sistem Informasi Layanan dan Pemesanan Playbox Berbasis Web sebagai solusi digital untuk meningkatkan efisiensi operasional pada usaha penyewaan Playbox (Mitra: BoxPlay.id). Sistem ini mengusung konsep self-service, yang memungkinkan pelanggan untuk melihat informasi layanan, katalog game, dan promo, serta melakukan pemesanan dan pembayaran secara mandiri melalui website.

Dokumentasi proyek disusun agar aplikasi mudah dipasang, dipelihara, dikembangkan, dan digunakan sebagai dasar kolaborasi tim. Proyek ini juga dirancang untuk mendukung pencapaian SDGs 8 (Pekerjaan Layak dan Pertumbuhan Ekonomi) melalui digitalisasi proses bisnis UMKM.

## Tujuan Proyek
- Mengembangkan aplikasi pemesanan Playbox berbasis web yang dapat digunakan secara mandiri oleh pelanggan (mengurangi ketergantungan pada kasir).
- Mengimplementasikan sistem pembayaran otomatis berbasis QRIS.
- Menyediakan dashboard untuk memonitor status penggunaan Playbox secara real-time.
- Menyajikan laporan pendapatan dan statistik operasional untuk mendukung pengambilan keputusan bisnis mitra.
- Membangun struktur kode dan sistem yang scalable agar mudah dipelihara serta dikembangkan secara kolaboratif untuk kebutuhan bisnis di masa depan.

## Masalah Yang Diselesaikan
- Proses pemesanan yang sebelumnya masih dilakukan secara manual melalui kasir, sehingga berpotensi menimbulkan antrean panjang saat kondisi ramai.
- Ketergantungan operasional yang tinggi terhadap operator kasir.
- Pengelolaan layanan dan pencatatan sesi waktu bermain yang belum terintegrasi langsung dengan antarmuka pelanggan.

## Target Pengguna
- Pelanggan: Mengakses web untuk melihat katalog, melakukan penyewaan, dan membayar sesi bermain.
- Admin: Memantau dasbor real-time, mengelola master data (Cabang, Playbox, Game, Promo), dan melihat riwayat penggunaan.
- Owner / Mitra: Memantau laporan pendapatan operasional dan kinerja bisnis dari jarak jauh.

## Fitur Utama

### Sisi Pelanggan (User Side)
- Melihat Informasi Website: Menampilkan Halaman Home, Daftar Cabang, Katalog Game, serta Event & Promo yang sedang aktif.
- Melakukan Pemesanan Playbox: Memilih Playbox, menentukan durasi bermain (1 jam, 2 jam, atau unlimited), dan kalkulasi harga otomatis.
- Konfirmasi Pembayaran: Integrasi scan barcode QRIS dan perubahan status transaksi.

### Sisi Admin (Back-Office)
- Autentikasi: Login dan Logout dengan pembatasan hak akses dasbor.
- Manajemen Master Data: 
  - Kelola Cabang 
  - Kelola Data Playbox 
  - Kelola Game 
  - Kelola Event & Promo 
- Monitoring Playbox: Memantau status mesin secara real-time (tersedia/digunakan/selesai) dan melihat data pelanggan yang sedang bermain.
- Melihat Riwayat Bermain: Arsip riwayat penggunaan Playbox oleh pelanggan.
- Melihat Laporan & Statistik: 
  - Laporan Pendapatan 
  - Statistik Penggunaan 

## Tech Stack
- Framework & Language: Laravel 11 / PHP 8.2+
- Database: MySQL / MariaDB
- Frontend: Bootstrap, Tailwind CSS, Blade Templates, Alpine.js
- Build Tool: Vite, Node.js & NPM
- Dependency / Packages:
  - Filament (Admin Panel, CRUD Builder & Autentikasi)
  - Laravel Livewire (Monitoring Timer Real-time)
  - Laravel Excel (Export laporan format .xlsx)
  - Laravel DOMPDF (Export laporan transaksi format .pdf)
  - Laravel Charts (Visualisasi statistik dasbor)
  - Laravel Debugbar (Pemantauan dan debugging sistem)

## Instalasi Singkat

```bash
git clone https://github.com/fauziarmnnvl/playbl.git
cd playbl
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

**Catatan Windows PowerShell:** jika `npm` atau `npx` diblokir karena execution policy, gunakan `npm.cmd` dan `npx.cmd`.

Dokumentasi instalasi lengkap tersedia di `docs/installation.md`.

## Struktur Dokumentasi

README.md
CHANGELOG.md

docs/
├── installation.md
├── features.md
├── dependency.md
├── refactoring.md
└── github-actions.md

## Screenshot Proyek

Screenshot aplikasi akan ditambahkan setelah halaman siap digunakan dan telah diverifikasi.

Rencana screenshot minimal:
- Halaman utama (informasi layanan, cabang, dan promo).
- Halaman pemesanan Playbox dan katalog game.
- Halaman konfirmasi pembayaran QRIS.
- Halaman login admin.
- Dashboard admin untuk monitoring status Playbox secara real-time.
- Halaman laporan pendapatan dan statistik penggunaan.

## Documentation

| Dokumen | Deskripsi |
|---|---|
| docs/installation.md | Panduan instalasi lokal, setup database, dan troubleshooting |
| docs/features.md | Dokumentasi Use Case dan alur kerja fitur aplikasi |
| docs/dependency.md | Dokumentasi package Laravel pihak ketiga beserta analisa risikonya |
| docs/refactoring.md | Catatan refactoring dan perbaikan struktur kode |
| docs/github-actions.md | Rencana workflow CI/CD untuk repositori |
| CHANGELOG.md | Riwayat perubahan proyek dan evolusi sistem dari seluruh tim |

## Tim Pengembang (Kelompok 2)
| Nama | NIM | Peran Proyek |
|---|---|---|
| Chayo Qalbi Yuhak | 2411082033 | Project Manager |
| Maharani Saputri | 2411081034 | System Analyst |
| Fauzi Arman Nauval | 2411082038 | Lead Programmer |
| Patra | 2411083022 | AI Specialist |
| Syoffi Irzayuni | 2411081040 | Quality Assurance |

## Repository
Repositori ini digunakan sebagai pusat manajemen versi (version control), kolaborasi penulisan kode, penyimpanan dokumentasi teknis, serta pencatatan riwayat evolusi perangkat lunak (changelog) dari awal pengembangan hingga rilis final.