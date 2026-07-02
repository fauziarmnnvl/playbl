# CHANGELOG

Seluruh perubahan penting pada proyek ini akan dicatat dalam dokumen ini.

---

## [Belum Dirilis]


### Added
* Menambahkan dukungan QRIS berbeda untuk setiap cabang melalui kolom `qris` pada data Cabang.
* Menambahkan penyimpanan path gambar QRIS pada tabel `cabang`.

### Changed
* Halaman Pembayaran Booking Sesi Tetap kini menampilkan QRIS sesuai cabang yang dipilih pelanggan.
* Halaman Pembayaran Booking Sesi Fleksibel kini menampilkan QRIS sesuai cabang tempat pelanggan bermain.

### Documentation
* Memperbarui CHANGELOG sesuai implementasi QRIS dinamis berdasarkan cabang.

## [0.3.0] - 3 Juli 2026

### Added

* Implementasi halaman Riwayat Bermain.
* Fitur filter Riwayat Bermain berdasarkan tanggal, Playbox, dan pelanggan.
* Implementasi halaman Laporan & Statistik.
* Fitur visualisasi data menggunakan Chart.js.
* Fitur export laporan ke PDF dan Excel.
* Implementasi halaman Riwayat Aktivitas (Audit Trail).
* Integrasi Spatie Activity Log untuk pencatatan aktivitas sistem.
* Implementasi halaman Monitoring Playbox berbasis Livewire.
* Monitoring status Playbox secara real-time menggunakan polling setiap 5 detik.
* Menampilkan informasi sesi bermain aktif pada Monitoring Playbox.
* Menambahkan countdown timer untuk sesi tetap dan timer berjalan untuk sesi fleksibel.
* Integrasi notifikasi Telegram untuk operator.
* Notifikasi otomatis kepada operator saat sisa waktu bermain mencapai 5 menit.
* Notifikasi otomatis kepada operator saat sesi bermain berakhir.
* Monitoring sesi bermain menggunakan Laravel Scheduler dan Artisan Command.
* Service Layer untuk pengelolaan monitoring sesi dan notifikasi Telegram.
* Menambahkan penyelesaian sesi otomatis saat waktu bermain habis.
* Integrasi data cabang dengan halaman Booking Playbox.
* Integrasi data cabang dengan halaman Branch pada sisi pelanggan.
* BookingController untuk pengelolaan data cabang pada workflow booking.
* Validasi ketersediaan cabang berdasarkan status operasional.
* Integrasi data Game dengan halaman Games pada sisi pelanggan.
* Menampilkan koleksi game menggunakan data dari database.
* Menampilkan game unggulan (featured games) pada carousel Landing Page.
* Integrasi data Event & Promo dengan halaman Event & Promo pada sisi pelanggan.
* Menampilkan promo aktif berdasarkan data yang dikelola admin.
* Integrasi data Playbox dengan halaman Booking Playbox.
* Menampilkan daftar Playbox berdasarkan cabang yang dipilih pelanggan.
* Menampilkan status ketersediaan Playbox pada proses booking.
* Implementasi workflow Booking Sesi Tetap (Fixed Session) dari pengisian informasi pemain hingga booking berhasil.
* Validasi data pemain pada proses booking.
* Penyimpanan data booking sementara menggunakan session.
* Halaman Review Booking untuk konfirmasi data sebelum pembayaran.
* Integrasi pembayaran QRIS pada proses booking sesi tetap.
* Penyimpanan data pelanggan secara otomatis berdasarkan nomor WhatsApp.
* Penyimpanan data transaksi setelah pengguna mengonfirmasi pembayaran.
* Halaman Booking Success yang menampilkan informasi hasil booking.
* Implementasi workflow Booking Sesi Fleksibel.
* Halaman sesi bermain dan pembayaran untuk Booking Sesi Fleksibel.
* Integrasi SweetAlert2 sebagai dialog konfirmasi pada proses mengakhiri sesi bermain.
* Branding logo BoxPlay.id pada panel admin.


### Changed

* Menyempurnakan tampilan halaman Riwayat Bermain.
* Menyesuaikan tampilan dashboard statistik sesuai desain terbaru.
* Menyederhanakan filter pada halaman Riwayat Aktivitas.
* Melakukan refactor dan pembersihan CSS pada panel admin.
* Menyesuaikan tampilan Monitoring Playbox sesuai desain Figma terbaru.
* Menyempurnakan tampilan status Playbox untuk kondisi Tersedia, Digunakan, Maintenance, dan Rusak.
* Menambahkan perbedaan visual antara sesi tetap dan sesi fleksibel.
* Mengganti ikon berbasis emoji menjadi SVG pada halaman Monitoring Playbox.
* Daftar cabang pada halaman Booking kini menggunakan data dari database dan tidak lagi hardcoded.
* Daftar cabang pada halaman Branch kini menggunakan data dari database dan tidak lagi hardcoded.
* Cabang berstatus Nonaktif tidak dapat dipilih pada proses booking.
* Status cabang pada sisi pelanggan kini mengikuti perubahan yang dilakukan admin pada Manajemen Cabang.
* Terminologi status cabang disesuaikan menjadi Aktif dan Nonaktif.
* Daftar game pada halaman Games kini menggunakan data dari database dan tidak lagi hardcoded.
* Carousel Koleksi Game pada Landing Page kini menggunakan data Game yang dikelola admin.
* Pengelolaan cover game disesuaikan menggunakan direktori public/images/games.
* Halaman Event & Promo kini menggunakan data dari database dan tidak lagi hardcoded.
* Status promo aktif dan nonaktif kini dihitung berdasarkan periode promo.
* Filter promo aktif dan nonaktif pada panel admin disesuaikan dengan status periode promo.
* Pengelolaan banner promo disesuaikan menggunakan direktori public/images/event-promo.
* Halaman Booking Playbox kini menggunakan data Playbox dari database dan tidak lagi hardcoded.
* Status Playbox pada proses booking kini mengikuti kondisi aktual unit yang dikelola admin.
* Menyempurnakan alur multi-step Booking Playbox untuk sesi tetap.
* Menambahkan validasi ketersediaan cabang pada proses booking.
* Menambahkan validasi ketersediaan Playbox berdasarkan status unit.
* Menyesuaikan tampilan halaman Pembayaran dan Success sesuai workflow terbaru.
* Menyederhanakan tampilan halaman Event & Promo agar berfokus sebagai media informasi promo.
* Menghapus tombol "Gunakan Promo" pada halaman Event & Promo.
* Menyesuaikan tampilan game pada Landing Page melalui HomeController.
* Menyempurnakan alur Booking Playbox untuk mendukung sesi tetap dan sesi fleksibel.
* Menyesuaikan Monitoring Playbox agar mendukung proses mulai sesi dan status booking.
* Memindahkan business logic monitoring sesi dan notifikasi Telegram ke dalam Service Layer.
* Menyederhanakan Monitoring Playbox dengan memindahkan proses mulai sesi ke PlayboxSessionService.
* Menambahkan constant dan query scope pada model untuk meningkatkan konsistensi kode.
* Menyesuaikan tampilan halaman Booking Success dan Payment sesuai workflow terbaru.
* Menyempurnakan tampilan branding panel admin menggunakan logo resmi BoxPlay.id.
* Menyesuaikan posisi dan ukuran logo pada sidebar admin agar lebih proporsional.
* Menyesuaikan tampilan halaman Booking Review Sesi Fleksibel.
* Menyesuaikan tampilan halaman Session Sesi Fleksibel.
* Melakukan penyesuaian styling frontend melalui CSS dan JavaScript.

### Documentation

* Memperbarui CHANGELOG sesuai implementasi Booking Sesi Fleksibel.
* Memperbarui CHANGELOG sesuai implementasi workflow Booking Sesi Tetap.
* Memperbarui CHANGELOG sesuai implementasi fitur Laporan & Statistik.
* Memperbarui CHANGELOG sesuai implementasi fitur Riwayat Bermain.
* Memperbarui CHANGELOG sesuai implementasi fitur Riwayat Aktivitas.
* Memperbarui CHANGELOG sesuai implementasi fitur Monitoring Playbox.
* Memperbarui CHANGELOG sesuai implementasi fitur kontrol ketersediaan cabang.
* Memperbarui CHANGELOG sesuai implementasi integrasi Game dengan frontend.
* Memperbarui CHANGELOG sesuai implementasi integrasi Event & Promo dengan frontend.
* Memperbarui CHANGELOG sesuai implementasi integrasi Playbox dengan proses booking.
* Memperbarui CHANGELOG sesuai penyederhanaan halaman Event & Promo.
* Memperbarui CHANGELOG sesuai implementasi monitoring sesi dan notifikasi Telegram.

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
* Implementasi alur Booking Playbox berbasis multi-step (wizard booking).
* Halaman Booking Info untuk pengisian data pemain.
* Halaman Booking Cabang untuk pemilihan cabang Playbox.
* Halaman Booking Playbox untuk pemilihan unit Playbox yang tersedia.
* Halaman Booking Durasi untuk pemilihan durasi bermain.
* Halaman Booking Review untuk menampilkan ringkasan pemesanan sebelum pembayaran.
* Halaman Booking Pembayaran untuk proses pembayaran pesanan.
* Halaman Booking Success sebagai halaman konfirmasi pemesanan berhasil.
* Struktur folder booking yang modular menggunakan Blade View terpisah untuk setiap langkah pemesanan.

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
* Melakukan refactor halaman Booking dari satu halaman menjadi alur pemesanan bertahap (multi-step booking flow).
* Memperbarui routing Booking agar mendukung navigasi antar langkah pemesanan.
* Memperbarui Navbar untuk mendukung akses langsung ke fitur Booking.
* Menyesuaikan struktur view Booking agar lebih mudah dikembangkan dan dipelihara.
* Menyesuaikan tampilan halaman Booking dengan desain Figma terbaru.

### Dependencies

* Menambahkan Swiper.js versi 12.2.0 untuk fitur carousel katalog game.
* Memperbarui konfigurasi frontend menggunakan Vite.
* Menambahkan SweetAlert2 sebagai library dialog konfirmasi interaktif.

### Documentation

* Menambahkan dokumentasi dependency.
* Memperbarui dokumentasi instalasi.
* Memperbarui dokumentasi proyek pada README.md.
* Memperbarui dokumentasi fitur Login, Dashboard, dan Manajemen Cabang.
* Memperbarui dokumentasi fitur Games, Event & Promo, dan Booking.
* Memperbarui dokumentasi fitur Playbox, Game, dan Event & Promo.
* Memperbarui dokumentasi fitur Operator dan manajemen pengguna.
* Memperbarui CHANGELOG sesuai perkembangan fitur terbaru.
* Memperbarui CHANGELOG sesuai perkembangan implementasi fitur Booking terbaru.
* Memperbarui README sesuai dependency dan implementasi terbaru.
* Memperbarui CHANGELOG sesuai penyempurnaan tampilan frontend dan branding admin.
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
