# Feature Documentation

Dokumen ini menjelaskan fitur-fitur utama yang tersedia pada sistem **BoxPlay.id**, meliputi tujuan fitur, aktor yang menggunakan, alur penggunaan, serta route dan controller yang mendukung implementasi setiap fitur.

---

## 1. Login

### Tujuan

Login digunakan untuk mengautentikasi pengguna sebelum mengakses sistem. Setelah proses autentikasi berhasil, pengguna akan diarahkan ke halaman sesuai dengan hak akses yang dimiliki.

### Aktor

- Admin
- Operator

### Alur

1. Pengguna membuka halaman Login.
2. Pengguna memasukkan email dan password.
3. Sistem melakukan proses validasi.
4. Jika data valid, pengguna diarahkan ke dashboard sesuai role.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/login` | `AuthenticatedSessionController@create` |
| POST | `/login` | `AuthenticatedSessionController@store` |

### Dokumentasi Tampilan

> Screenshot fitur Login akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 2. Landing Page

### Tujuan

Landing Page merupakan halaman utama yang dapat diakses oleh seluruh pengunjung. Halaman ini menyediakan informasi mengenai BoxPlay.id, daftar cabang, katalog game, serta event dan promo yang sedang berlangsung.

### Aktor

- Pelanggan

### Alur

1. Pengunjung membuka website.
2. Sistem menampilkan informasi mengenai BoxPlay.id.
3. Pengunjung dapat melihat daftar cabang, game, dan event & promo.
4. Pengunjung dapat melanjutkan ke proses booking Playbox.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/` | `HomeController@index` |
| GET | `/branch` | `CabangController@index` |
| GET | `/games` | `GameController@index` |
| GET | `/event-promo` | `EventPromoController@index` |

### Dokumentasi Tampilan

> Screenshot Landing Page akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 3. Booking Playbox (Sesi Tetap)

### Tujuan

Fitur ini digunakan untuk melakukan pemesanan Playbox dengan durasi bermain yang telah ditentukan sebelum permainan dimulai.

### Aktor

- Pelanggan

### Alur

1. Pelanggan mengisi informasi diri.
2. Memilih cabang.
3. Memilih Playbox yang tersedia.
4. Memilih durasi bermain.
5. Melakukan review booking.
6. Melakukan pembayaran menggunakan QRIS.
7. Sistem menyimpan data booking dan menampilkan halaman Booking Berhasil.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/booking` | `BookingController@index` |
| POST | `/booking/*` | `BookingController` |

### Dokumentasi Tampilan

> Screenshot proses Booking Sesi Tetap akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 4. Booking Playbox (Sesi Fleksibel)

### Tujuan

Fitur ini memungkinkan pelanggan melakukan booking tanpa menentukan durasi bermain di awal. Lama bermain akan dihitung berdasarkan waktu penggunaan Playbox.

### Aktor

- Pelanggan

### Alur

1. Pelanggan mengisi informasi diri.
2. Memilih cabang dan Playbox.
3. Melakukan review booking.
4. Melakukan pembayaran.
5. Operator memulai sesi bermain.
6. Sistem menghitung durasi bermain hingga sesi selesai.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/booking/session-flexible` | `BookingController` |
| POST | `/booking/*` | `BookingController` |

### Dokumentasi Tampilan

> Screenshot proses Booking Sesi Fleksibel akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 5. Dashboard Admin

### Tujuan

Dashboard berfungsi sebagai halaman utama Admin yang menampilkan ringkasan informasi operasional sistem sehingga kondisi sistem dapat dipantau secara cepat.

### Aktor

- Admin

### Alur

1. Admin berhasil login.
2. Sistem menampilkan ringkasan operasional.
3. Dashboard menampilkan informasi Playbox, sesi aktif, pendapatan, grafik penggunaan, distribusi penggunaan, serta aktivitas terbaru.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin` | `DashboardController@index` |

### Dokumentasi Tampilan

> Screenshot Dashboard Admin akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 6. Monitoring Playbox

### Tujuan

Monitoring Playbox digunakan untuk memantau kondisi setiap Playbox secara real-time selama operasional berlangsung.

### Aktor

- Admin
- Operator

### Alur

1. Pengguna membuka halaman Monitoring Playbox.
2. Sistem menampilkan daftar Playbox sesuai hak akses.
3. Status Playbox diperbarui secara otomatis mengikuti kondisi sesi bermain.
4. Operator dapat memulai sesi bermain untuk booking sesi tetap.
5. Setelah sesi selesai, status Playbox kembali menjadi tersedia.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/monitoring` | `MonitoringController@index` |
| GET | `/operator/monitoring` | `OperatorMonitoringController@index` |

**Livewire Component**

- `MonitoringPlaybox`

### Dokumentasi Tampilan

> Screenshot halaman Monitoring Playbox akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 7. Manajemen Playbox

### Tujuan

Fitur ini digunakan untuk mengelola data Playbox pada setiap cabang agar informasi yang ditampilkan sesuai dengan kondisi operasional.

### Aktor

- Admin

### Alur

1. Admin membuka menu Manajemen Playbox.
2. Sistem menampilkan daftar Playbox.
3. Admin dapat menambah, mengubah, maupun menghapus data Playbox.
4. Sistem menyimpan perubahan yang dilakukan.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/playbox` | `PlayboxController@index` |
| POST | `/admin/playbox` | `PlayboxController@store` |
| PUT | `/admin/playbox/{id}` | `PlayboxController@update` |
| DELETE | `/admin/playbox/{id}` | `PlayboxController@destroy` |

### Dokumentasi Tampilan

> Screenshot halaman Manajemen Playbox akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 8. Manajemen Cabang

### Tujuan

Manajemen Cabang digunakan untuk mengelola informasi seluruh cabang BoxPlay.id yang tersedia pada sistem.

### Aktor

- Admin

### Alur

1. Admin membuka menu Manajemen Cabang.
2. Sistem menampilkan daftar cabang.
3. Admin dapat menambah, mengubah, maupun menghapus data cabang.
4. Sistem menyimpan perubahan yang dilakukan.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/cabang` | `CabangController@index` |
| POST | `/admin/cabang` | `CabangController@store` |
| PUT | `/admin/cabang/{id}` | `CabangController@update` |
| DELETE | `/admin/cabang/{id}` | `CabangController@destroy` |

### Dokumentasi Tampilan

> Screenshot halaman Manajemen Cabang akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 9. Manajemen Game

### Tujuan

Fitur ini digunakan untuk mengelola daftar game yang tersedia pada sistem sehingga informasi game yang ditampilkan kepada pelanggan selalu diperbarui.

### Aktor

- Admin

### Alur

1. Admin membuka menu Manajemen Game.
2. Sistem menampilkan daftar game.
3. Admin dapat menambah, mengubah, maupun menghapus data game.
4. Sistem menyimpan perubahan yang dilakukan.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/game` | `GameController@index` |
| POST | `/admin/game` | `GameController@store` |
| PUT | `/admin/game/{id}` | `GameController@update` |
| DELETE | `/admin/game/{id}` | `GameController@destroy` |

### Dokumentasi Tampilan

> Screenshot halaman Manajemen Game akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 10. Manajemen Event & Promo

### Tujuan

Fitur ini digunakan untuk mengelola informasi event dan promo yang ditampilkan pada website BoxPlay.id.

### Aktor

- Admin

### Alur

1. Admin membuka menu Event & Promo.
2. Sistem menampilkan daftar event dan promo.
3. Admin dapat menambah, mengubah, maupun menghapus data.
4. Perubahan akan langsung ditampilkan pada website.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/promo` | `EventPromoController@index` |
| POST | `/admin/promo` | `EventPromoController@store` |
| PUT | `/admin/promo/{id}` | `EventPromoController@update` |
| DELETE | `/admin/promo/{id}` | `EventPromoController@destroy` |

### Dokumentasi Tampilan

> Screenshot halaman Event & Promo akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 11. Manajemen Operator

### Tujuan

Fitur ini digunakan untuk mengelola akun operator yang bertugas pada setiap cabang.

### Aktor

- Admin

### Alur

1. Admin membuka menu Manajemen Operator.
2. Sistem menampilkan daftar operator.
3. Admin dapat menambah, mengubah, maupun menghapus akun operator.
4. Sistem menyimpan perubahan yang dilakukan.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/operator` | `OperatorController@index` |
| POST | `/admin/operator` | `OperatorController@store` |
| PUT | `/admin/operator/{id}` | `OperatorController@update` |
| DELETE | `/admin/operator/{id}` | `OperatorController@destroy` |

### Dokumentasi Tampilan

> Screenshot halaman Manajemen Operator akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 12. Data Pelanggan

### Tujuan

Fitur Data Pelanggan digunakan untuk menampilkan informasi pelanggan yang pernah melakukan booking melalui sistem.

### Aktor

- Admin

### Alur

1. Admin membuka menu Data Pelanggan.
2. Sistem menampilkan daftar pelanggan.
3. Admin dapat melihat informasi pelanggan berdasarkan riwayat booking.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/pelanggan` | `PelangganController@index` |

### Dokumentasi Tampilan

> Screenshot halaman Data Pelanggan akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 13. Riwayat Bermain

### Tujuan

Riwayat Bermain digunakan untuk menampilkan seluruh riwayat sesi bermain yang telah selesai sebagai bahan monitoring dan evaluasi.

### Aktor

- Admin
- Operator

### Alur

1. Pengguna membuka menu Riwayat Bermain.
2. Sistem mengambil data riwayat permainan.
3. Riwayat ditampilkan sesuai hak akses pengguna.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/riwayat` | `RiwayatController@index` |
| GET | `/operator/riwayat` | `OperatorRiwayatController@index` |

### Dokumentasi Tampilan

> Screenshot halaman Riwayat Bermain akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 14. Laporan & Statistik

### Tujuan

Fitur ini menyediakan laporan dan statistik penggunaan Playbox sebagai bahan evaluasi operasional.

### Aktor

- Admin

### Alur

1. Admin membuka menu Laporan & Statistik.
2. Sistem menampilkan grafik penggunaan dan statistik pendapatan.
3. Admin dapat mengunduh laporan sesuai kebutuhan.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/statistik` | `StatistikController@index` |

### Dokumentasi Tampilan

> Screenshot halaman Laporan & Statistik akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 15. Riwayat Aktivitas

### Tujuan

Riwayat Aktivitas digunakan untuk mencatat aktivitas penting yang dilakukan pengguna selama menggunakan sistem sebagai bentuk audit trail.

### Aktor

- Admin

### Alur

1. Admin membuka menu Riwayat Aktivitas.
2. Sistem menampilkan daftar aktivitas pengguna.
3. Aktivitas disusun berdasarkan waktu kejadian.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/activity-log` | `ActivityController@index` |

### Dokumentasi Tampilan

> Screenshot halaman Riwayat Aktivitas akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

# Ringkasan Fitur

| No | Fitur | Aktor |
|----|-------------------------------|----------------|
| 1 | Login | Admin, Operator |
| 2 | Landing Page | Pelanggan |
| 3 | Booking Playbox (Sesi Tetap) | Pelanggan |
| 4 | Booking Playbox (Sesi Fleksibel) | Pelanggan |
| 5 | Dashboard Admin | Admin |
| 6 | Monitoring Playbox | Admin, Operator |
| 7 | Manajemen Playbox | Admin |
| 8 | Manajemen Cabang | Admin |
| 9 | Manajemen Game | Admin |
| 10 | Manajemen Event & Promo | Admin |
| 11 | Manajemen Operator | Admin |
| 12 | Data Pelanggan | Admin |
| 13 | Riwayat Bermain | Admin, Operator |
| 14 | Laporan & Statistik | Admin |
| 15 | Riwayat Aktivitas | Admin |