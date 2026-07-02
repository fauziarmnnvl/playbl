# Refactoring Documentation

## Deskripsi

Dokumen ini berisi riwayat aktivitas refactoring yang dilakukan selama proses pengembangan Sistem Informasi Layanan dan Pemesanan Playbox Berbasis Web. Refactoring dilakukan untuk meningkatkan kualitas struktur kode, mempermudah pemeliharaan (maintenance), meningkatkan keterbacaan kode (readability), serta memudahkan pengembangan fitur di masa mendatang tanpa mengubah proses bisnis aplikasi.

---

# Refactoring 1

## Sebelum

### Masalah

Seluruh halaman aplikasi masih menggunakan struktur layout yang belum dipisahkan berdasarkan kebutuhan pengguna sehingga kode tampilan menjadi kurang modular dan sulit dikembangkan.

---

## Perubahan

Layout dipisahkan menjadi beberapa file sesuai kebutuhan masing-masing halaman.

```
resources/views/layouts
├── app.blade.php
├── admin.blade.php
├── guest.blade.php
```

---

## Alasan

- Memisahkan tampilan User, Admin, dan Guest.
- Mengurangi pengulangan kode.
- Mempermudah pengembangan halaman baru.

---

## Dampak

- Struktur proyek menjadi lebih rapi.
- Maintenance lebih mudah.
- Konsistensi tampilan meningkat.

---

# Refactoring 2

## Sebelum

### Masalah

Komponen antarmuka seperti navbar, tombol, input, dan navigasi masih ditulis berulang pada berbagai halaman.

---

## Perubahan

Komponen dipisahkan menjadi Blade Component.

```
resources/views/components
├── navbar.blade.php
├── nav-link.blade.php
├── primary-button.blade.php
├── secondary-button.blade.php
├── text-input.blade.php
├── modal.blade.php
└── footer.blade.php
```

---

## Alasan

- Mengurangi duplikasi kode.
- Memudahkan perubahan tampilan secara terpusat.

---

## Dampak

- Kode menjadi reusable.
- Pengembangan UI lebih cepat.
- Konsistensi antarmuka meningkat.

---

# Refactoring 3

## Sebelum

### Masalah

Landing Page masih terdiri dari file yang besar sehingga sulit dipelajari dan dipelihara.

---

## Perubahan

Landing Page dipisahkan menjadi beberapa section.

```
resources/views/sections
├── hero.blade.php
├── branches.blade.php
├── games.blade.php
├── dashboard.blade.php
├── event-promo.blade.php
├── faq.blade.php
├── cta.blade.php
├── bookingInfo.blade.php
├── bookingCabang.blade.php
├── bookingPlaybox.blade.php
├── bookingDurasi.blade.php
├── bookingReview.blade.php
├── bookingPembayaran.blade.php
└── bookingSuccess.blade.php
```

---

## Alasan

- Mempermudah pengelolaan setiap bagian Landing Page.
- Setiap section dapat dikembangkan secara terpisah.

---

## Dampak

- Struktur tampilan menjadi lebih modular.
- Mempermudah kolaborasi tim.

---

# Refactoring 4

## Sebelum

### Masalah

Alur pemesanan Playbox masih sulit dikembangkan apabila seluruh proses berada pada satu halaman.

---

## Perubahan

Alur booking dipisahkan menjadi beberapa halaman sesuai tahapan proses pemesanan.

Tahapan tersebut meliputi:

- Informasi pelanggan
- Pemilihan cabang
- Pemilihan Playbox
- Pemilihan durasi bermain
- Review booking
- Pembayaran
- Booking berhasil

Selain itu ditambahkan alur booking Flexible yang dipisahkan ke halaman tersendiri.

---

## Alasan

- Mempermudah pengembangan setiap proses booking.
- Mempermudah debugging apabila terjadi kesalahan.

---

## Dampak

- Alur aplikasi lebih jelas.
- Maintenance lebih mudah.
- Pengembangan fitur booking menjadi lebih fleksibel.

---

# Refactoring 5

## Sebelum

### Masalah

Seluruh stylesheet masih bercampur sehingga perubahan pada halaman Admin dapat memengaruhi halaman User.

---

## Perubahan

CSS dipisahkan menjadi beberapa file.

```
resources/css
├── app.css
└── admin.css
```

---

## Alasan

- Memisahkan styling User dan Admin.
- Mempermudah pengelolaan CSS.

---

## Dampak

- Struktur CSS menjadi lebih rapi.
- Mengurangi konflik styling.

---

# Refactoring 6

## Sebelum

### Masalah

Logika aplikasi berpotensi menjadi sulit dipelihara apabila seluruh proses ditempatkan pada satu controller.

---

## Perubahan

Controller dipisahkan berdasarkan tanggung jawab masing-masing.

Contoh:

```
BookingController
CabangController
GameController
PlayboxController
DashboardController
MonitoringController
OperatorController
StatistikController
AktivitasController
RiwayatController
```

---

## Alasan

Mengikuti prinsip Single Responsibility Principle (SRP).

---

## Dampak

- Controller menjadi lebih fokus.
- Kode lebih mudah dibaca.
- Maintenance menjadi lebih mudah.

---

# Refactoring 7

## Sebelum

### Masalah

Controller Admin dan Operator berada pada struktur yang sama sehingga kurang terorganisir.

---

## Perubahan

Controller Operator dipindahkan ke namespace tersendiri.

```
app/Http/Controllers/Operator
├── OperatorMonitoringController.php
└── OperatorRiwayatController.php
```

---

## Alasan

- Memisahkan logika Admin dan Operator.
- Mempermudah pengembangan role baru.

---

## Dampak

- Struktur controller lebih rapi.
- Hak akses lebih mudah dikelola.

---

# Refactoring 8

## Sebelum

### Masalah

Routing aplikasi akan sulit dipelihara apabila seluruh route ditulis tanpa pengelompokan.

---

## Perubahan

Route dikelompokkan berdasarkan middleware dan role.

Contoh:

- Public Route
- Admin Route
- Operator Route
- Authentication Route
- Profile Route

---

## Alasan

- Mempermudah pembacaan file routing.
- Mempermudah pengaturan hak akses.

---

## Dampak

- Struktur routing menjadi lebih jelas.
- Maintenance lebih mudah.
- Risiko kesalahan konfigurasi route berkurang.

---

# Refactoring 9

## Sebelum

### Masalah

Identitas visual pada halaman Admin belum konsisten dengan branding BoxPlay.id sehingga tampilan aplikasi kurang seragam.

---

## Perubahan

Dilakukan penyempurnaan tampilan antarmuka Admin, meliputi:

- Penyesuaian logo BoxPlay.id.
- Perapihan posisi logo pada sidebar.
- Penyesuaian layout sidebar.
- Penyempurnaan styling halaman Admin.
- Penyesuaian tampilan Landing Page agar konsisten dengan branding aplikasi.

---

## Alasan

Meningkatkan konsistensi identitas visual aplikasi dan memberikan pengalaman pengguna yang lebih baik.

---

## Dampak

- Branding aplikasi menjadi lebih konsisten.
- Antarmuka lebih profesional.
- User Experience meningkat.

---

# Refactoring 10

## Sebelum

### Masalah

Logika monitoring sesi bermain, pengiriman notifikasi Telegram, dan proses memulai sesi masih tersebar pada Command dan Livewire Component sehingga kode menjadi panjang, sulit dipelihara, serta meningkatkan duplikasi logika aplikasi.

---

## Perubahan

Business logic dipindahkan ke dalam Service Layer.

Service yang ditambahkan meliputi:

```
app/Services
├── TelegramService.php
├── SessionNotificationService.php
└── PlayboxSessionService.php
```

Selain itu dilakukan penyesuaian pada:

- MonitorSessionCommand agar hanya bertugas menjalankan proses monitoring.
- MonitoringPlaybox agar proses memulai sesi menggunakan PlayboxSessionService.
- Model aplikasi dengan menambahkan constant dan query scope untuk meningkatkan konsistensi kode.

---

## Alasan

- Memisahkan business logic dari Command dan Livewire Component.
- Mengurangi duplikasi kode.
- Meningkatkan keterbacaan dan maintainability.
- Menerapkan prinsip Single Responsibility Principle (SRP).

---

## Dampak

- Struktur kode menjadi lebih modular.
- Business logic lebih mudah dipelihara.
- Pengembangan fitur monitoring dan notifikasi menjadi lebih mudah.
- Kode menjadi lebih terstruktur dan mudah dipahami.

---

# Refactoring 11

## Sebelum

### Masalah

File media seperti gambar Cabang, Game, dan Event & Promo masih disimpan langsung pada folder `public/images`. Pendekatan ini menyebabkan pengelolaan file menjadi kurang fleksibel, sulit dipindahkan ke media penyimpanan lain, serta tidak mengikuti mekanisme penyimpanan file yang direkomendasikan oleh Laravel.

---

## Perubahan

Pengelolaan media diubah menggunakan Laravel Storage dengan memanfaatkan disk `public`.

Perubahan yang dilakukan meliputi:

- Memindahkan penyimpanan file media dari folder `public/images` ke `storage/app/public`.
- Mengubah proses upload pada Controller agar menggunakan Laravel Storage.
- Menyesuaikan path gambar pada Seeder agar menggunakan direktori Storage.
- Mengubah seluruh tampilan (Blade) agar menggunakan `Storage::url()` saat menampilkan gambar.
- Menghapus aset gambar lama yang sudah tidak digunakan pada folder `public/images`.

Contoh struktur penyimpanan:

```text
storage/app/public
├── cabang
├── games
└── event-promo
```

---

## Alasan

- Mengikuti standar pengelolaan file yang direkomendasikan oleh Laravel.
- Mempermudah proses upload, update, dan penghapusan file.
- Meningkatkan fleksibilitas apabila di masa mendatang menggunakan media penyimpanan lain seperti Amazon S3.
- Mengurangi ketergantungan terhadap folder `public`.

---

## Dampak

- Struktur penyimpanan media menjadi lebih terorganisir.
- Pengelolaan file lebih mudah dipelihara.
- Tampilan aplikasi tetap berjalan tanpa mengubah proses bisnis.
- Sistem menjadi lebih mudah dikembangkan apabila menggunakan media penyimpanan yang berbeda di masa mendatang.

# Kesimpulan

Refactoring yang dilakukan selama pengembangan proyek berfokus pada peningkatan kualitas struktur kode, modularitas komponen, konsistensi antarmuka, serta kemudahan maintenance tanpa mengubah proses bisnis aplikasi. Dengan struktur yang lebih terorganisir, pengembangan fitur baru dan kolaborasi antar anggota tim dapat dilakukan dengan lebih mudah dan efisien.