# Dependency Documentation

Dokumen ini menjelaskan dependency proyek BoxPlay.id berdasarkan kebutuhan sistem dan kondisi repository saat ini.

## Identitas

* **Nama proyek:** Sistem Informasi Layanan dan Pemesanan Playbox Berbasis Web (BoxPlay.id)
* **Framework utama:** Laravel
* **Tujuan:** Mengidentifikasi dependency/package Laravel yang digunakan maupun yang direncanakan untuk mendukung pengembangan sistem, menjelaskan kegunaannya menggunakan pendekatan 5W+1H, serta menganalisis dampaknya terhadap evolusi perangkat lunak.

## Ringkasan

Dependency dikelola menggunakan Composer untuk package PHP/Laravel dan NPM untuk package frontend.

Seluruh dependency yang tercantum pada dokumen ini merupakan package yang telah digunakan pada repository BoxPlay.id, baik untuk kebutuhan backend, frontend, maupun proses development.

Dependency pada dokumen ini dikelompokkan menjadi:

* Dependency Backend
* Dependency Development dan Testing
* Dependency Frontend

---

# Dependency Backend

| Package | Fungsi | Alasan | Versi | Risiko |
|----------|--------|--------|--------|--------|
| `laravel/framework` | Framework utama aplikasi | Menyediakan routing, MVC, Eloquent ORM, Migration, Middleware, dan fitur inti Laravel | `^12.0` | Perubahan major version dapat memerlukan penyesuaian kode |
| `livewire/livewire` | Komponen interaktif realtime | Mendukung monitoring status Playbox secara realtime tanpa perlu refresh halaman | `*` | Membutuhkan pemahaman mengenai lifecycle dan state management Livewire |
| `spatie/laravel-activitylog` | Audit Trail | Mencatat aktivitas pengguna serta perubahan data untuk kebutuhan audit trail | `^5.0` | Ukuran database dapat bertambah apabila log tidak dikelola secara berkala |
| `maatwebsite/excel` | Import & Export Excel | Digunakan untuk menghasilkan laporan pendapatan dan statistik dalam format Excel | `^3.1` | Pengolahan data dalam jumlah besar membutuhkan memori lebih tinggi |
| `barryvdh/laravel-dompdf` | Generate PDF | Digunakan untuk mencetak laporan maupun transaksi dalam format PDF | `^3.1` | Rendering dokumen yang kompleks dapat memperlambat proses pembuatan PDF |
| `consoletvs/charts` | Visualisasi Grafik | Menampilkan statistik penggunaan Playbox dalam bentuk grafik | `6.*` | Bergantung pada library visualisasi frontend agar grafik dapat ditampilkan |
| `laravel/tinker` | Laravel REPL | Membantu proses debugging dan eksplorasi model melalui terminal | `^2.10.1` | Tidak digunakan pada lingkungan production |

# Dependency Development dan Testing

| Package | Fungsi | Alasan | Versi | Risiko |
|----------|--------|--------|--------|--------|
| `laravel/breeze` | Starter Kit Authentication | Menyediakan fondasi autentikasi (Login & Logout) yang ringan dan mudah dikustomisasi | `^2.4` | Perlu pengembangan antarmuka secara manual sesuai kebutuhan sistem |
| `barryvdh/laravel-debugbar` | Debugging & Profiling | Membantu memantau query database, request, response, serta performa aplikasi saat development | `^4.2` | Tidak boleh diaktifkan pada production karena dapat menampilkan informasi sensitif |
| `fakerphp/faker` | Data Dummy | Membuat data uji untuk kebutuhan seeder dan testing | `^1.23` | Data dummy tidak boleh digunakan sebagai data nyata |
| `mockery/mockery` | Mock Object Testing | Membantu proses pengujian unit dengan membuat objek tiruan | `^1.6` | Memerlukan pemahaman konsep mocking agar pengujian efektif |
| `phpunit/phpunit` | Unit Testing | Framework utama untuk melakukan pengujian aplikasi Laravel | `^11.5.50` | Membutuhkan pemeliharaan test seiring perkembangan sistem |
| `laravel/pint` | Code Formatter | Menjaga konsistensi penulisan kode sesuai standar Laravel | `^1.24` | Perubahan format otomatis dapat memengaruhi hasil merge jika tidak dikelola dengan baik |
| `laravel/pail` | Log Monitoring | Membantu memantau log Laravel secara realtime selama development | `^1.2.2` | Digunakan hanya pada proses pengembangan |
| `laravel/sail` | Docker Development Environment | Menyediakan lingkungan pengembangan berbasis Docker | `^1.41` | Membutuhkan Docker untuk menjalankannya |

# Dependency Frontend

| Package | Fungsi | Alasan | Versi | Risiko |
|----------|--------|--------|--------|--------|
| `vite` | Build Tool | Mengelola proses build CSS dan JavaScript pada Laravel | `^7.0.7` | Membutuhkan versi Node.js yang kompatibel |
| `laravel-vite-plugin` | Integrasi Laravel dengan Vite | Menghubungkan asset Vite dengan Blade Laravel | `^2.0.0` | Asset tidak dapat dimuat apabila proses build gagal |
| `tailwindcss` | Utility CSS Framework | Mempermudah pembuatan antarmuka yang responsif dan konsisten | `^3.1.0` | Class dinamis harus dipastikan ikut ter-build |
| `@tailwindcss/forms` | Styling Form | Memberikan tampilan form yang konsisten dengan Tailwind CSS | `^0.5.2` | Hanya mengubah tampilan elemen form |
| `@tailwindcss/vite` | Integrasi Tailwind + Vite | Mengoptimalkan proses build Tailwind melalui Vite | `^4.3.0` | Bergantung pada konfigurasi Vite |
| `bootstrap` | CSS Framework | Digunakan sebagai framework CSS pendukung untuk membangun antarmuka Admin Panel | `^5.3.8` | Penggunaan bersamaan dengan Tailwind perlu pengelolaan style agar tidak bentrok |
| `@popperjs/core` | Positioning Library | Mendukung komponen Bootstrap seperti dropdown dan tooltip | `^2.11.8` | Digunakan sebagai dependency Bootstrap |
| `alpinejs` | Interaktivitas Ringan | Membantu membangun komponen frontend yang interaktif | `^3.15.12` | Kurang cocok untuk state management yang kompleks |
| `@alpinejs/collapse` | Collapse Component | Menambahkan efek expand/collapse pada komponen Alpine.js | `^3.15.12` | Bergantung pada Alpine.js |
| `swiper` | Interactive Carousel | Menampilkan katalog game dalam bentuk carousel pada Landing Page | `^12.2.0` | Perubahan API pada versi mayor dapat memerlukan penyesuaian konfigurasi |
| `chart.js` | Visualisasi Grafik | Menampilkan grafik statistik penggunaan Playbox pada Dashboard | `^4.5.1` | Membutuhkan konfigurasi data yang sesuai agar grafik tampil dengan benar |
| `sweetalert2` | Dialog Interaktif | Menampilkan dialog konfirmasi dan notifikasi yang lebih menarik | `^11.26.25` | Bergantung pada JavaScript untuk menjalankan dialog |
| `axios` | HTTP Client | Mengirim request HTTP secara asynchronous dari frontend | `^1.11.0` | Perlu penanganan error agar request tetap aman |
| `autoprefixer` | CSS Prefixer | Menambahkan vendor prefix CSS secara otomatis | `^10.4.2` | Digunakan saat proses build |
| `postcss` | CSS Processor | Memproses CSS sebelum dibuild oleh Vite | `^8.4.31` | Bergantung pada konfigurasi PostCSS |
| `concurrently` | Multiple Process Runner | Menjalankan Laravel Server, Queue, dan Vite secara bersamaan saat development | `^9.0.1` | Digunakan hanya pada lingkungan development |

# External Service

| Service | Fungsi | Alasan | Risiko |
|----------|--------|--------|--------|
| `Telegram Bot API` | Mengirim notifikasi otomatis kepada operator | Mendukung monitoring sesi bermain secara real-time melalui Telegram | Bergantung pada koneksi internet, Bot Token, dan ketersediaan layanan Telegram |

---

# Analisis 5W+1H Dependency Utama

## Laravel Livewire

| 5W+1H | Penjelasan                                                                                     |
| ----- | ---------------------------------------------------------------------------------------------- |
| What  | Framework full-stack Laravel untuk membuat komponen interaktif tanpa JavaScript yang kompleks. |
| Why   | Membantu fitur monitoring Playbox secara realtime tanpa refresh halaman.                       |
| Who   | Admin dan petugas operasional.                                                                 |
| When  | Saat halaman monitoring dibuka.                                                                |
| Where | Modul monitoring dan dashboard realtime.                                                       |
| How   | Komponen Livewire mengelola state di server dan memperbarui tampilan browser secara otomatis.  |

**Referensi:**
* https://livewire.laravel.com/docs
* https://github.com/livewire/livewire

## Laravel Breeze

| 5W+1H | Penjelasan                                                                                             |
| ----- | ------------------------------------------------------------------------------------------------------ |
| What  | Starter kit autentikasi bawaan Laravel yang minimalis dan ringan.                                      |
| Why   | Memberikan fondasi keamanan (login/logout) sekaligus kebebasan penuh dalam membangun Custom Admin Panel. |
| Who   | Admin dan Mitra/Owner.                                                                                 |
| When  | Saat pengguna melakukan proses autentikasi ke dalam sistem back-office.                                |
| Where | Modul autentikasi dan kerangka dasar antarmuka pengguna (UI).                                          |
| How   | Menyediakan controller, route, dan view Blade dasar yang siap dikustomisasi secara manual.             |

**Referensi:**
* https://laravel.com/docs/starter-kits#laravel-breeze

## Spatie Activitylog

| 5W+1H | Penjelasan                                                                                                |
| ----- | --------------------------------------------------------------------------------------------------------- |
| What  | Package Laravel untuk mencatat aktivitas pengguna dan perubahan data pada model.                          |
| Why   | Penting untuk audit trail, keamanan, dan pelacakan perubahan data penting dalam sistem.                   |
| Who   | Sistem (otomatis) serta Admin dan Mitra sebagai pihak yang dapat melihat log aktivitas.                   |
| When  | Saat terjadi operasi Create, Update, Delete, atau aktivitas penting lainnya pada sistem.                  |
| Where | Modul audit trail, monitoring sistem, dan laporan aktivitas.                                              |
| How   | Menggunakan trait `LogsActivity` pada model Laravel untuk mencatat perubahan ke database secara otomatis. |

**Referensi:**
* https://spatie.be/docs/laravel-activitylog
* https://github.com/spatie/laravel-activitylog

## Laravel Excel

| 5W+1H | Penjelasan                                                            |
| ----- | --------------------------------------------------------------------- |
| What  | Package Laravel untuk import dan export data Excel maupun CSV.        |
| Why   | Mempermudah pembuatan laporan pendapatan dan statistik.               |
| Who   | Admin dan Mitra/Owner.                                                |
| When  | Saat proses rekap laporan harian, mingguan, atau bulanan.             |
| Where | Modul laporan dan statistik.                                          |
| How   | Data query dikonversi menjadi file Excel yang dapat diunduh pengguna. |

**Referensi:**
* https://docs.laravel-excel.com
* https://github.com/SpartnerNL/Laravel-Excel

## Laravel DOMPDF

| 5W+1H | Penjelasan                                                       |
| ----- | ---------------------------------------------------------------- |
| What  | Package Laravel untuk menghasilkan file PDF dari tampilan Blade. |
| Why   | Digunakan untuk mencetak struk transaksi dan laporan.            |
| Who   | Pelanggan, Admin, dan Mitra.                                     |
| When  | Setelah transaksi selesai atau saat laporan diunduh.             |
| Where | Modul pemesanan dan laporan.                                     |
| How   | View Blade dirender menjadi PDF yang dapat diunduh atau dicetak. |

**Referensi:**
* https://github.com/barryvdh/laravel-dompdf

## Laravel Charts

| 5W+1H | Penjelasan                                                          |
| ----- | ------------------------------------------------------------------- |
| What  | Library visualisasi data berbentuk grafik.                          |
| Why   | Membantu analisis data melalui tampilan grafik yang mudah dipahami. |
| Who   | Mitra/Owner dan Admin.                                              |
| When  | Saat melihat dashboard dan laporan statistik.                       |
| Where | Dashboard dan menu laporan.                                         |
| How   | Data agregasi dari database dirender menjadi grafik interaktif.     |

**Referensi:**
* https://charts.erik.cat/

## Laravel Debugbar

| 5W+1H | Penjelasan                                                         |
| ----- | ------------------------------------------------------------------ |
| What  | Package debugging untuk Laravel.                                   |
| Why   | Membantu memantau query, request, dan error selama pengembangan.   |
| Who   | Tim Pengembang.                                                    |
| When  | Saat aplikasi berjalan pada mode development.                      |
| Where | Seluruh halaman aplikasi selama development.                       |
| How   | Menampilkan informasi debugging melalui panel Debugbar di browser. |

**Referensi:**
* https://github.com/barryvdh/laravel-debugbar

## Swiper.js

| 5W+1H | Penjelasan |
|--------|--------|
| What | Library JavaScript modern untuk membuat slider dan carousel interaktif. |
| Why | Digunakan untuk menampilkan koleksi game secara menarik pada Landing Page BoxPlay.id. |
| Who | Pelanggan yang mengakses website. |
| When | Saat pengguna membuka halaman utama website. |
| Where | Section Game Showcase pada Landing Page. |
| How | Swiper diintegrasikan melalui NPM dan diinisialisasi menggunakan JavaScript untuk menghasilkan carousel otomatis dan responsif. |

### Referensi

- https://swiperjs.com/
- https://github.com/nolimits4web/swiper


## SweetAlert2

| 5W+1H | Penjelasan |
|--------|------------|
| **What** | SweetAlert2 adalah library JavaScript untuk menampilkan dialog interaktif seperti konfirmasi, peringatan, notifikasi, dan pesan sukses dengan tampilan yang lebih modern dibandingkan alert bawaan browser. |
| **Why** | Digunakan untuk meningkatkan pengalaman pengguna ketika melakukan aksi penting, seperti mengakhiri sesi bermain atau melakukan konfirmasi tindakan tertentu. |
| **Who** | Digunakan oleh Pelanggan maupun Operator saat berinteraksi dengan sistem. |
| **When** | Ditampilkan ketika pengguna melakukan aksi yang memerlukan konfirmasi atau pemberitahuan hasil proses. |
| **Where** | Digunakan pada halaman Booking Playbox, Monitoring Playbox, maupun halaman lain yang memerlukan dialog interaktif. |
| **How** | Diintegrasikan melalui NPM kemudian dipanggil menggunakan JavaScript pada halaman yang membutuhkan dialog konfirmasi atau notifikasi. |

**Referensi:**
- https://sweetalert2.github.io/

## Telegram Bot API

| 5W+1H | Penjelasan |
|--------|------------|
| **What** | Layanan API dari Telegram yang memungkinkan aplikasi mengirim pesan melalui Bot Telegram. |
| **Why** | Digunakan untuk mengirim notifikasi otomatis kepada operator ketika sesi bermain akan berakhir dan saat sesi telah selesai. |
| **Who** | Operator yang telah menghubungkan akun Telegram dengan sistem. |
| **When** | Saat sisa waktu bermain mencapai 5 menit dan ketika sesi bermain berakhir. |
| **Where** | Modul Monitoring Playbox dan Session Notification Service. |
| **How** | Sistem mengirim HTTP Request ke endpoint Telegram Bot API menggunakan Laravel HTTP Client (`Http::post`) dengan Bot Token dan Chat ID operator. |

**Referensi:**
- https://core.telegram.org/bots/api

---

# Cara Install Dependency

## Install Seluruh Dependency Project

```bash
composer install
npm install
```

## Install Dependency Composer

```bash
composer require vendor/package
```

## Contoh Install Backend

```bash
composer require spatie/laravel-activitylog:"^5.0"
```

## Install Dependency Development

```bash
composer require vendor/package --dev
```

## Install Dependency Frontend

```bash
npm install package-name
```

## Build Asset Frontend

```bash
npm run build
```

---

# Perubahan Dependency Terbaru

## Swiper.js

### Versi
12.2.0

### Tanggal Penambahan
12 Juni 2026

### Tujuan
Menampilkan katalog game dalam bentuk carousel interaktif pada Landing Page.

### Instalasi

```bash
npm install swiper
```
## SweetAlert2

### Versi
11.26.25

### Tanggal Penambahan
29 Juni 2026

### Tujuan
Digunakan untuk menampilkan dialog konfirmasi dan notifikasi interaktif, seperti konfirmasi mengakhiri sesi bermain, sehingga memberikan pengalaman pengguna yang lebih baik dibandingkan dialog bawaan browser.

### Instalasi

```bash
npm install sweetalert2
```

---

# Analisis Perubahan File Dependency

## composer.json

Mencatat seluruh dependency backend yang dipasang secara langsung menggunakan Composer beserta informasi versi yang dibutuhkan oleh aplikasi.

## composer.lock

Mencatat versi pasti seluruh dependency backend beserta dependency turunannya sehingga seluruh anggota tim memperoleh versi package yang sama ketika menjalankan perintah `composer install`.

## package.json

Mencatat seluruh dependency frontend yang digunakan pada proyek, seperti Vite, Tailwind CSS, Bootstrap, Alpine.js, Swiper.js, SweetAlert2, Chart.js, dan package frontend lainnya.

## package-lock.json

Mencatat versi pasti seluruh dependency frontend beserta dependency turunannya agar proses instalasi dan build menghasilkan lingkungan yang konsisten pada setiap perangkat pengembang.

---

# Dampak Dependency pada Proyek

- Mempercepat proses pengembangan karena menyediakan berbagai fitur yang siap digunakan.
- Meningkatkan kualitas antarmuka pengguna melalui library frontend yang modern.
- Membantu menjaga konsistensi struktur kode dan tampilan aplikasi.
- Mengurangi waktu pengembangan sehingga target implementasi lebih mudah dicapai.
- Mempermudah proses pemeliharaan dan pengembangan fitur baru melalui package yang telah terdokumentasi dengan baik.

---

# Risiko Umum Dependency

- Ketidakcocokan dengan versi Laravel, PHP, maupun Node.js terbaru.
- Package yang tidak lagi dipelihara berpotensi menimbulkan celah keamanan.
- Kesalahan konfigurasi dependency dapat menyebabkan aplikasi gagal dijalankan atau proses build mengalami error.
- Terlalu banyak dependency dapat meningkatkan kompleksitas aplikasi serta memengaruhi performa.

---

# Evaluasi Dependency

Dependency yang digunakan pada proyek **BoxPlay.id** membantu mempercepat proses pengembangan karena menyediakan berbagai fitur yang siap digunakan tanpa harus membangun semuanya dari awal. Laravel Breeze menjadi fondasi autentikasi, Livewire mendukung monitoring Playbox secara realtime, Spatie Activitylog digunakan untuk audit trail, Laravel Excel dan Laravel DOMPDF digunakan untuk pembuatan laporan, sedangkan Chart.js, Swiper.js, Bootstrap, Tailwind CSS, dan SweetAlert2 meningkatkan kualitas antarmuka serta pengalaman pengguna.

Seluruh dependency dievaluasi secara berkala untuk memastikan kompatibilitas dengan Laravel 12, PHP 8.2, keamanan, serta kemudahan pemeliharaan sehingga aplikasi tetap stabil selama proses pengembangan maupun setelah implementasi.