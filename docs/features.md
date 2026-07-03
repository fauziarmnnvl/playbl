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
2. Pengguna memasukkan email atau username dan password.
3. Sistem melakukan proses validasi.
4. Jika data valid, Admin diarahkan ke Dashboard Admin.
5. Jika data valid, Operator diarahkan ke halaman Monitoring Playbox.
6. Jika pengguna yang sudah login mengakses kembali route `/login`, sistem akan mengarahkan pengguna ke halaman sesuai role yang dimiliki.

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
- Operator

### Alur

1. Pelanggan mengisi informasi diri.
2. Pelanggan memilih cabang.
3. Pelanggan memilih Playbox yang tersedia.
4. Pelanggan memilih durasi bermain.
5. Pelanggan melakukan review booking.
6. Pelanggan melakukan pembayaran menggunakan QRIS.
7. Sistem menyimpan data booking dan menampilkan halaman Booking Berhasil yang berisi informasi booking.
8. Pelanggan menunjukkan bukti booking dan bukti pembayaran kepada operator.
9. Operator mencek data booking dan pembayaran.
10. Operator menekan tombol Mulai Sesi pada dashboard monitoring.
11. Sistem mengubah status Playbox menjadi Sedang Digunakan dan menghitung waktu bermain sesuai durasi yang dipilih.

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
- Operator

### Alur

1. Pelanggan mengisi informasi diri.
2. Pelanggan memilih cabang.
3. Pelanggan memilih Playbox yang tersedia.
4. Pelanggan memilih durasi bermain (Sesi-flexible).
5. Pelanggan melakukan review booking.
6. Sistem menyimpan data booking.
7. Pelanggan menekan tombol Mulai Bermain, kemudian sistem mulai menghitung durasi bermain hingga sesi selesai.
8. Pelanggan mengakhiri sesi bermain, kemudian sistem menghitung total biaya berdasarkan durasi bermain serta menampilkan kode QRIS dan rincian pembayaran.
9. Pelanggan melakukan pembayaran menggunakan QRIS.
10. Sistem mencatat transaksi dengan status Menunggu Verifikasi Pembayaran.
11. Operator memverifikasi pembayaran melalui halaman Monitoring Playbox.
12. Operator menekan tombol Sudah Bayar.
13. Sistem memperbarui status transaksi menjadi Lunas dan menampilkan halaman Pembayaran Selesai yang berisi informasi booking dan pembayaran.

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

1. Admin atau Operator berhasil login.
2. Admin atau Operator membuka halaman Monitoring Playbox.
3. Sistem menampilkan daftar Playbox sesuai hak akses.
4. Operator dapat memulai sesi bermain untuk booking sesi tetap sesuai hak akses masing-masing operator.
5. Sistem memperbarui status Playbox secara real-time selama sesi berlangsung.
6. Setelah pelanggan mengakhiri sesi bermain, sistem menampilkan status Menunggu Verifikasi Pembayaran pada sesi flexible.
7. Operator memverifikasi pembayaran dengan menekan tombol Sudah Bayar.
8. Sistem mengubah status transaksi menjadi Lunas dan status Playbox kembali menjadi Tersedia.

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

1. Admin berhasil login.
2. Admin membuka menu Manajemen Playbox.
3. Sistem menampilkan daftar Playbox yang diurutkan berdasarkan Cabang dan kode Playbox.
4. Daftar Playbox ditampilkan menggunakan pagination untuk mempermudah pengelolaan data.
5. Admin dapat menambah, mengubah, maupun menghapus data Playbox.
6. Saat menambahkan Playbox, sistem hanya menampilkan Cabang yang berstatus Aktif.
7. Cabang berstatus Nonaktif tidak dapat dipilih sebagai lokasi Playbox baru.
8. Sistem menyimpan perubahan yang dilakukan.

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

1. Admin berhasil login.
2. Admin membuka menu Manajemen Cabang.
3. Sistem menampilkan daftar cabang.
4. Admin dapat menambah, mengubah, maupun menghapus data cabang.
5. Sistem menyimpan perubahan yang dilakukan.

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

1. Admin berhasil login.
2. Admin membuka menu Manajemen Game.
3. Sistem menampilkan daftar game.
4. Admin dapat menambah, mengubah, maupun menghapus data game.
5. Sistem menyimpan perubahan yang dilakukan.

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

1. Admin berhasil login.
2. Admin membuka menu Event & Promo.
3. Sistem menampilkan daftar event dan promo beserta banner, deskripsi, nilai diskon, periode, dan status promo.
4. Status Aktif atau Nonaktif ditentukan secara otomatis berdasarkan periode promo.
5. Admin dapat menambah, mengubah, maupun menghapus data Event & Promo.
6. Admin dapat mengunggah banner promo yang disimpan menggunakan Laravel Storage.
7. Sistem menampilkan banner promo secara proporsional pada panel Admin dan halaman pelanggan.
8. Deskripsi promo yang ditampilkan pada halaman pelanggan diambil secara dinamis dari database.
9. Perubahan data Event & Promo akan langsung ditampilkan pada website pelanggan.

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

1. Admin berhasil login.
2. Admin membuka menu Manajemen Operator.
3. Sistem menampilkan daftar operator.
4. Admin dapat menambah, mengubah, maupun menghapus akun operator.
5. Sistem menyimpan perubahan yang dilakukan.

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

Fitur Data Pelanggan digunakan untuk menampilkan informasi pelanggan yang pernah melakukan booking melalui sistem. Data yang ditampilkan disesuaikan dengan hak akses pengguna.

### Aktor

- Admin
- Operator

### Alur

1. Admin atau Operator berhasil login.
2. Pengguna membuka menu Data Pelanggan.
3. Jika pengguna adalah Admin, sistem menampilkan seluruh pelanggan yang pernah melakukan booking.
4. Jika pengguna adalah Operator, sistem hanya menampilkan pelanggan yang pernah melakukan booking di cabang yang dikelola oleh Operator tersebut.
5. Sistem menampilkan nama pelanggan, nomor HP, total booking, dan tanggal terakhir bermain.
6. Pada halaman Operator, Total Booking dihitung khusus berdasarkan transaksi pada cabang Operator.
7. Pada halaman Operator, Terakhir Bermain dihitung berdasarkan transaksi terakhir pelanggan pada cabang Operator.
8. Pengguna dapat mencari pelanggan berdasarkan nama atau nomor HP.
9. Sistem menampilkan notifikasi SweetAlert toast setelah nomor HP berhasil disalin.
10. Daftar pelanggan ditampilkan menggunakan pagination.

### Route & Controller

| Method | Route | Controller |
| :----: | :---- | :--------- |
| GET | `/admin/pelanggan` | `PelangganController@index` |
| GET | `/operator/pelanggan` | `OperatorPelangganController@index` |

### Hak Akses Data

| Role | Data yang Ditampilkan |
| :--- | :-------------------- |
| Admin | Seluruh pelanggan dari semua cabang |
| Operator | Pelanggan yang pernah melakukan booking di cabang Operator |

### Dokumentasi Tampilan

> Screenshot halaman Data Pelanggan Admin dan Operator akan ditambahkan pada tahap akhir pengembangan sebagai dokumentasi antarmuka sistem.

---

## 13. Riwayat Bermain

### Tujuan

Riwayat Bermain digunakan untuk menampilkan seluruh riwayat sesi bermain yang telah selesai sebagai bahan monitoring dan evaluasi.

### Aktor

- Admin
- Operator

### Alur

1. Admin atau Operator berhasil login.
2. Admin atau Operator membuka menu Riwayat Bermain.
3. Sistem mengambil data riwayat permainan.
4. Riwayat permainan ditampilkan sesuai hak akses.

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

1. Admin berhasil login.
2. Admin membuka menu Laporan & Statistik.
3. Sistem menampilkan grafik penggunaan dan statistik pendapatan.
4. Admin dapat mengunduh laporan sesuai kebutuhan.

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

1. Admin berhasil login.
2. Admin membuka menu Riwayat Aktivitas.
3. Sistem menampilkan daftar aktivitas pengguna.
4. Aktivitas disusun berdasarkan waktu kejadian.

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
| 12 | Data Pelanggan | Admin, Operator |
| 13 | Riwayat Bermain | Admin, Operator |
| 14 | Laporan & Statistik | Admin |
| 15 | Riwayat Aktivitas | Admin |