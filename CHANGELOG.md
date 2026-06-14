# CHANGELOG

Seluruh perubahan penting pada proyek ini akan dicatat dalam dokumen ini.

---

## [Belum Dirilis]

### Added

* Belum ada perubahan.

---

## [0.2.0] - 14 Juni 2026

### Added

* Struktur Landing Page menggunakan komponen Blade Laravel.
* Halaman Hero sebagai tampilan utama BoxPlay.id.
* Section Call To Action (CTA).
* Section Koleksi Game dengan implementasi carousel menggunakan Swiper.js.
* Komponen Navbar yang responsif.
* Komponen Footer.
* Struktur section yang modular untuk memudahkan pengembangan Landing Page.
* Halaman Login Admin untuk autentikasi pengguna.
* Dashboard Admin untuk menampilkan ringkasan operasional sistem.
* Modul Manajemen Cabang.
* Fitur CRUD Cabang (Tambah, Lihat, Ubah, Hapus).
* Routing admin untuk Dashboard, Cabang, Monitoring, dan modul terkait.
* Halaman Games untuk menampilkan katalog game yang tersedia.
* Halaman Event & Promo untuk menampilkan promo dan informasi event yang sedang berlangsung.
* Halaman Booking sebagai antarmuka awal proses pemesanan Playbox.
* Section modular untuk Games, Event & Promo, dan Booking.
* Asset gambar pendukung untuk halaman Games dan Event & Promo.
* Routing publik untuk halaman Games, Event & Promo, Branch, dan Booking.
* Modul Manajemen Playbox.
* Fitur CRUD Playbox (Tambah, Lihat, Ubah, Hapus).
* Modul Manajemen Game.
* Fitur CRUD Game (Tambah, Lihat, Ubah, Hapus).
* Modul Manajemen Event & Promo.
* Fitur CRUD Event & Promo (Tambah, Lihat, Ubah, Hapus).
* Halaman Edit untuk Playbox, Game, dan Event & Promo.
* Modul Manajemen Operator.
* Fitur pencarian Data Pelanggan berdasarkan nama dan nomor HP.
* Seeder pengguna untuk kebutuhan pengujian dan inisialisasi data.
* Migration pendukung untuk pengelolaan Operator dan User.

### Changed

* Memperbarui dokumentasi proyek pada README.md.
* Memperbarui dokumentasi dependency.
* Memperbarui dokumentasi teknologi yang digunakan.
* Meningkatkan tampilan antarmuka menggunakan Tailwind CSS.
* Meningkatkan responsivitas dan estetika Landing Page.
* Menyesuaikan tampilan Dashboard Admin.
* Menyesuaikan tampilan Manajemen Cabang.
* Menyesuaikan topbar dan layout panel admin.
* Mengganti beberapa ikon berbasis emoji menjadi SVG agar konsisten dengan desain aplikasi.
* Menyempurnakan tampilan halaman Login Admin.
* Memperbarui navigasi Navbar agar mendukung halaman Games, Event & Promo, dan Booking.
* Menambahkan status aktif (active state) pada menu navigasi berdasarkan halaman yang sedang dibuka.
* Memperbarui Footer agar konsisten dengan pengembangan halaman frontend terbaru.
* Memulihkan akses publik pada Landing Page dan halaman Branch tanpa memerlukan autentikasi.
* Menyesuaikan struktur autentikasi aplikasi dari model Admin ke model User.
* Memperbarui konfigurasi autentikasi dan manajemen pengguna.
* Menyesuaikan status mesin pada modul Playbox.
* Menyempurnakan tampilan halaman Manajemen Playbox.
* Menyempurnakan tampilan halaman Manajemen Game.
* Menyempurnakan tampilan halaman Manajemen Event & Promo.
* Menyempurnakan tampilan halaman Data Pelanggan.
* Menyeragamkan desain toolbar, tombol aksi, dan komponen pencarian pada panel admin.

### Dependencies

* Menambahkan Swiper.js versi 12.2.0 untuk fitur carousel katalog game.
* Memperbarui konfigurasi frontend menggunakan Vite.

### Documentation

* Menambahkan dokumentasi dependency.
* Memperbarui dokumentasi instalasi.
* Memperbarui dokumentasi proyek pada README.md.
* Memperbarui dokumentasi fitur Login, Dashboard, dan Manajemen Cabang.
* Memperbarui dokumentasi fitur Games, Event & Promo, dan Booking.
* Memperbarui dokumentasi fitur Playbox, Game, dan Event & Promo.
* Memperbarui dokumentasi fitur Operator dan manajemen pengguna.
* Memperbarui CHANGELOG sesuai perkembangan fitur terbaru.

---

## [0.1.0] - 12 Juni 2026

### Added

* Inisialisasi proyek Laravel.
* Integrasi Tailwind CSS.
* Implementasi Laravel Breeze untuk autentikasi.
* Struktur dasar dokumentasi proyek.
* Inisialisasi repository GitHub.

### Documentation

* Pembuatan README.md.
* Pembuatan Installation Documentation.
* Pembuatan Feature Documentation.
* Pembuatan Dependency Documentation.
* Pembuatan CHANGELOG.md.
