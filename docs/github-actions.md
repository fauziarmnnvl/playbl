# GitHub Actions Documentation

## Pendahuluan

GitHub Actions digunakan sebagai layanan **Continuous Integration (CI)** pada proyek **BoxPlay.id** untuk membantu proses validasi kode secara otomatis. Workflow ini memastikan bahwa setiap perubahan yang dikirim ke repository dapat melalui proses build dan validasi dasar aplikasi sebelum digabungkan ke branch utama.

---

# Workflow

Repository **BoxPlay.id** menggunakan workflow **Continuous Integration (CI)** untuk memvalidasi proses build aplikasi Laravel secara otomatis. Workflow akan menjalankan instalasi dependency, validasi konfigurasi Composer, konfigurasi environment Laravel, proses build frontend, serta migrasi database menggunakan MySQL.

---

# Lokasi Workflow

Workflow disimpan pada direktori berikut.

```text
.github/workflows/ci.yml
```

---

# Trigger Workflow

Workflow dijalankan secara otomatis pada kondisi berikut.

| Event | Keterangan |
|-------|------------|
| Push | Workflow dijalankan setiap kali terdapat perubahan yang di-push ke branch `main` maupun `development`. |
| Pull Request | Workflow dijalankan ketika terdapat Pull Request menuju branch `main` atau `development`. |

---

# Tahapan Workflow

Workflow Continuous Integration terdiri dari beberapa tahapan berikut.

1. Melakukan checkout source code dari repository.
2. Menyiapkan environment PHP 8.4.
3. Menyiapkan environment Node.js 22.
4. Menginstal dependency menggunakan Composer.
5. Melakukan validasi konfigurasi `composer.json`.
6. Menginstal dependency frontend menggunakan NPM.
7. Melakukan proses build aset frontend menggunakan Vite.
8. Menyiapkan environment Laravel menggunakan file `.env.example`.
9. Menunggu layanan MySQL hingga siap digunakan.
10. Menjalankan migrasi database menggunakan MySQL.

---

# Alur Workflow

```text
Developer Push / Pull Request
            │
            ▼
     GitHub Actions Trigger
            │
            ▼
     Checkout Repository
            │
            ▼
      Setup PHP 8.4
            │
            ▼
     Setup Node.js 22
            │
            ▼
 Install Composer Dependencies
            │
            ▼
 Validate Composer Configuration
            │
            ▼
    Install NPM Dependencies
            │
            ▼
      Build Frontend Assets
            │
            ▼
 Configure Laravel Environment
            │
            ▼
       Wait for MySQL
            │
            ▼
   Run Database Migration
            │
            ▼
       Workflow Status
     (Passed / Failed)
```

---

# Hasil Workflow

Apabila seluruh tahapan berhasil dijalankan, GitHub Actions akan memberikan status **Passed** sebagai indikator bahwa aplikasi berhasil dibangun, dependency berhasil divalidasi, proses build frontend berhasil dilakukan, serta migrasi database dapat dijalankan tanpa kendala.

Sebaliknya, apabila terjadi kesalahan pada salah satu tahapan, workflow akan menghasilkan status **Failed** sehingga pengembang dapat segera melakukan perbaikan sebelum perubahan digabungkan ke branch utama.

---

# Dokumentasi Workflow

## Screenshot

> Screenshot hasil eksekusi workflow GitHub Actions akan dilampirkan pada versi akhir dokumentasi sebagai bukti implementasi Continuous Integration.

## Status Badge

Status badge GitHub Actions dapat ditambahkan pada file `README.md` untuk menunjukkan status workflow secara langsung.

Contoh penggunaan:

```md
![BoxPlay CI](https://github.com/<username>/<repository>/actions/workflows/ci.yml/badge.svg)
```

---

# Catatan Implementasi

Saat ini workflow difokuskan pada proses validasi build aplikasi, instalasi dependency, dan migrasi database. Pengujian otomatis menggunakan PHPUnit serta pemeriksaan standar penulisan kode menggunakan Laravel Pint belum diaktifkan karena masih memerlukan penyesuaian dengan struktur aplikasi dan basis data yang digunakan pada proyek BoxPlay.id.

---

# Manfaat Implementasi

Penerapan GitHub Actions membantu meningkatkan kualitas proses pengembangan perangkat lunak dengan melakukan validasi otomatis terhadap setiap perubahan kode. Melalui mekanisme Continuous Integration, setiap perubahan akan diperiksa mulai dari instalasi dependency, validasi konfigurasi Composer, proses build frontend, hingga migrasi database. Dengan demikian, potensi kesalahan dapat diketahui lebih awal sehingga proses kolaborasi antar anggota tim menjadi lebih terstruktur dan kualitas aplikasi tetap terjaga.