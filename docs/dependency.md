# Dependency Documentation

Dokumen ini menjelaskan dependency proyek BoxPlay.id berdasarkan kebutuhan sistem dan kondisi repository saat ini.

## Identitas

* **Nama proyek:** Sistem Informasi Layanan dan Pemesanan Playbox Berbasis Web (BoxPlay.id)
* **Framework utama:** Laravel
* **Tujuan:** Mengidentifikasi dependency/package Laravel yang digunakan maupun yang direncanakan untuk mendukung pengembangan sistem, menjelaskan kegunaannya menggunakan pendekatan 5W+1H, serta menganalisis dampaknya terhadap evolusi perangkat lunak.

## Ringkasan

Dependency dikelola menggunakan Composer untuk package PHP/Laravel dan NPM untuk package frontend. Dependency yang digunakan maupun yang direncanakan dicatat dan dianalisis berdasarkan kebutuhan fitur pada proyek BoxPlay.id.

Dependency pada dokumen ini dikelompokkan menjadi:

* Dependency Backend
* Dependency Development dan Testing
* Dependency Frontend
* Dependency Rencana Pengembangan

## Dependency Backend

| Package             | Fungsi                       | Alasan                                                                            | Versi   | Risiko                                                             |
| ------------------- | ---------------------------- | --------------------------------------------------------------------------------- | ------- | ------------------------------------------------------------------ |
| `laravel/framework` | Framework utama aplikasi     | Menyediakan routing, MVC, ORM, migration, middleware, dan fitur inti Laravel      | `^11.0` | Perubahan major version dapat memerlukan penyesuaian kode          |
| `filament/filament` | Admin Panel dan Autentikasi  | Mempercepat pembuatan dashboard admin, CRUD master data, dan pembatasan hak akses | `^3.2`  | Kustomisasi di luar standar Filament membutuhkan override komponen |
| `livewire/livewire` | Komponen interaktif realtime | Membantu monitoring status Playbox secara realtime tanpa refresh halaman          | `^3.0`  | Membutuhkan pemahaman lifecycle state management PHP               |

## Dependency Development dan Testing

| Package                     | Fungsi                               | Alasan                                                                            | Versi   | Risiko                                             |
| --------------------------- | ------------------------------------ | --------------------------------------------------------------------------------- | ------- | -------------------------------------------------- |
| `barryvdh/laravel-debugbar` | Debugging dan Profiling              | Membantu developer memantau query database, request, dan error selama development | `^3.13` | Membocorkan data sensitif jika aktif di production |
| `pestphp/pest`              | Framework Testing                    | Sintaks pengujian lebih ringkas dan mudah dibaca                                  | `^2.0`  | Tim yang terbiasa PHPUnit klasik perlu beradaptasi |
| `fakerphp/faker`            | Data Dummy untuk Factory dan Testing | Membantu pembuatan data pelanggan palsu untuk pengujian                           | `^1.23` | Data dummy tidak boleh dianggap sebagai data nyata |
| `laravel/tinker`            | REPL Laravel                         | Membantu debugging dan eksplorasi model saat development                          | `^2.9`  | Tidak digunakan pada workflow pengguna production  |

## Dependency Frontend

| Package               | Fungsi                         | Alasan                                                      | Versi   | Risiko                                                              |
| --------------------- | ------------------------------ | ----------------------------------------------------------- | ------- | ------------------------------------------------------------------- |
| `vite`                | Build Tool Frontend            | Mengelola proses build asset CSS dan JavaScript Laravel     | `^5.0`  | Membutuhkan versi Node.js yang kompatibel                           |
| `laravel-vite-plugin` | Integrasi Laravel dengan Vite  | Menghubungkan Blade dengan hasil build Vite                 | `^1.0`  | Asset gagal dimuat jika build atau manifest bermasalah              |
| `tailwindcss`         | Utility CSS Framework          | Membantu pembuatan antarmuka yang responsif dan konsisten   | `^3.4`  | Class dinamis perlu dipastikan ikut ter-build                       |
| `bootstrap`           | Framework UI                   | Dipertimbangkan untuk desain halaman self-service pelanggan | `^5.3`  | Dapat menimbulkan konflik styling jika dicampur dengan Tailwind CSS |
| `alpinejs`            | Interaktivitas Ringan Frontend | Mendukung komponen UI sederhana yang interaktif             | `^3.13` | Tidak cocok untuk state management yang kompleks                    |

## Dependency Rencana Pengembangan

| Package                   | Fungsi                      | Modul Rencana                     | Alasan                                         |
| ------------------------- | --------------------------- | --------------------------------- | ---------------------------------------------- |
| `maatwebsite/excel`       | Import dan Export Excel/CSV | Laporan pendapatan dan statistik  | Memudahkan pengolahan laporan bagi Mitra/Owner |
| `barryvdh/laravel-dompdf` | Generate PDF dari Blade     | Cetak struk transaksi dan laporan | Dokumen mudah dicetak dan diarsipkan           |
| `consoletvs/charts`       | Visualisasi Grafik          | Dashboard laporan admin           | Membantu visualisasi tren penggunaan Playbox   |

## Analisis 5W+1H Dependency Utama

### 1. Filament (Admin Panel dan Autentikasi)

| 5W+1H | Penjelasan                                                                                                   |
| ----- | ------------------------------------------------------------------------------------------------------------ |
| What  | Filament adalah framework admin panel Laravel yang menyediakan autentikasi, form builder, dan table builder. |
| Why   | Digunakan untuk membangun dashboard admin, autentikasi, dan CRUD tanpa membuat antarmuka dari nol.           |
| Who   | Admin dan Mitra/Owner BoxPlay.id.                                                                            |
| When  | Saat admin login dan mengelola data cabang, playbox, game, promo, serta transaksi.                           |
| Where | Modul back-office dan dashboard admin.                                                                       |
| How   | Diinstal melalui Composer dan menghasilkan Resource yang terhubung langsung dengan model Laravel.            |

**Referensi:**

* https://filamentphp.com/docs
* https://github.com/filamentphp/filament

### 2. Laravel Livewire

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

### 3. Laravel Excel

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

### 4. Laravel DOMPDF

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

### 5. Laravel Charts

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

### 6. Laravel Debugbar

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

## Cara Install Dependency

### Install Dependency Composer

```bash
composer require vendor/package
```

### Contoh Install Filament

```bash
composer require filament/filament:"^3.2" -W
```

### Install Dependency Development

```bash
composer require vendor/package --dev
```

### Install Dependency Frontend

```bash
npm install package-name
```

### Build Asset Frontend

```bash
npm run build
```

## Analisis Perubahan File Dependency

### composer.json

Mencatat package utama yang dipasang secara langsung oleh developer. File ini menjelaskan dependency yang dibutuhkan aplikasi agar dapat berjalan dengan baik.

### composer.lock

Mencatat versi pasti package utama dan dependency turunannya sehingga seluruh anggota tim memperoleh versi yang sama saat menjalankan `composer install`.

### package.json

Mencatat package frontend yang dipasang secara langsung, seperti Vite, Tailwind CSS, Bootstrap, dan Alpine.js.

### package-lock.json

Mencatat versi pasti dependency frontend beserta dependency turunannya agar hasil instalasi dan build tetap konsisten.

## Dampak Dependency pada Proyek

* Mempercepat pengembangan fitur karena tidak perlu membangun semuanya dari nol.
* Meningkatkan kualitas dan keamanan aplikasi melalui package yang telah teruji.
* Membantu menjaga konsistensi kode dan antarmuka pengguna.
* Mengurangi waktu pengembangan sehingga target proyek lebih mudah dicapai.
* Memerlukan dokumentasi dan pemeliharaan versi secara berkala.

## Risiko Umum Dependency

* Ketidakcocokan dengan versi Laravel atau PHP terbaru.
* Package tidak lagi dipelihara sehingga berpotensi menimbulkan celah keamanan.
* Kesalahan konfigurasi dapat menyebabkan kebocoran data atau akses yang tidak semestinya.
* Terlalu banyak dependency dapat meningkatkan kompleksitas dan memperlambat aplikasi.

## Evaluasi Dependency

Dependency sangat membantu proses pengembangan karena menyediakan berbagai fitur yang siap digunakan. Package yang telah digunakan saat ini membantu mempercepat pengembangan fitur inti aplikasi. Sementara itu, package yang masih direncanakan seperti Filament, Livewire, Laravel Excel, dan DOMPDF dipertimbangkan untuk mendukung pengembangan fitur dashboard, autentikasi, monitoring realtime, serta pembuatan laporan pada tahap implementasi berikutnya.

Namun, setiap dependency harus dievaluasi secara berkala untuk memastikan kompatibilitas, keamanan, dan keberlanjutan penggunaannya. Sebelum diterapkan pada repositori utama, seluruh package wajib diuji terlebih dahulu pada environment lokal untuk meminimalkan risiko saat deployment.
