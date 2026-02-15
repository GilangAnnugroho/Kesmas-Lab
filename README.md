<div align="center">

# 🏥 KESMAS-LAB
**Sistem Informasi Manajemen Laboratorium Kesehatan Daerah**

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

<p align="center">
  <b>Digitalisasi Operasional Laboratorium:</b><br>
  Dari Pendaftaran, Rekam Medis, hingga Validasi Hasil — <i>Paperless & Terintegrasi.</i>
</p>

[Fitur Utama](#-fitur-unggulan) • [Teknologi](#-teknologi) • [Instalasi](#-panduan-instalasi-cepat) • [Demo](#-akses-demo)

</div>

---

## 📖 Tentang Aplikasi

**KESMAS-LAB** adalah solusi perangkat lunak yang dirancang khusus untuk Unit Pelaksana Teknis Daerah (UPTD) Laboratorium Kesehatan. Sistem ini mentransformasi proses manual menjadi digital, memastikan akurasi data medis, mempercepat waktu tunggu pasien, dan memudahkan manajemen dalam memantau statistik pemeriksaan secara *real-time*.

---

## 🌟 Fitur Unggulan

| Modul | Deskripsi & Fungsionalitas |
| :--- | :--- |
| **🔐 Admin & Petugas** | • **Dashboard Statistik:** Visualisasi data kunjungan & pendapatan.<br>• **Manajemen Parameter:** Atur jenis uji lab & tarif (`KesmasParameterController`).<br>• **Verifikasi Berjenjang:** Validasi hasil oleh penanggung jawab sebelum rilis.<br>• **Rekam Medis Digital:** History pemeriksaan pasien tersimpan aman. |
| **🩺 Layanan Pasien** | • **Registrasi Cepat:** Input data administratif pasien (`KesmasRegistrationController`).<br>• **Cetak Hasil:** Generate sertifikat hasil uji lab otomatis (PDF). |
| **🌍 Portal Publik** | • **Tracking Status:** Pasien dapat memantau progres sampel mereka.<br>• **Informasi Layanan:** Akses info tarif dan jenis pemeriksaan via web. |

---

## 🛠 Teknologi

Project ini dibangun menggunakan fondasi teknologi modern yang stabil dan aman:

* **Backend Core:** `Laravel 10.10` (PHP 8.1+)
* **Database:** `MySQL / MariaDB`
* **Frontend Asset:** `Vite` (HTML5, CSS3, JS)
* **Templating:** `Blade Engine`
* **Auth System:** `Laravel Sanctum`
* **Server:** `Apache` atau `Nginx`

---

## 🚀 Panduan Instalasi Cepat

Ikuti langkah-langkah berikut untuk menjalankan project di local environment Anda:

### 1. Persiapan Awal
Pastikan komputer Anda sudah terinstall: `PHP >= 8.1`, `Composer`, dan `Node.js`.

### 2. Clone & Install
# Clone repository
git clone [https://github.com/USERNAME-KAMU/kesmas-lab.git](https://github.com/USERNAME-KAMU/kesmas-lab.git)

# Masuk ke direktori
cd kesmas-lab

# Install Backend Dependencies
composer install

# Install Frontend Dependencies
npm install

---

### 3. Konfigurasi Environment
# Duplikat file env
cp .env.example .env

# Generate App Key (Penting!)
php artisan key:generate

---

### 4. Setup Database
Buka file .env dan sesuaikan kredensial database Anda:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kesmas_db  # Pastikan DB ini sudah dibuat di phpMyAdmin
DB_USERNAME=root
DB_PASSWORD=

---

### 5. Migrasi & Menjalankan Server
# Migrasi tabel ke database
php artisan migrate

# Jalankan server (Buka 2 terminal berbeda)
# Terminal 1:
php artisan serve

# Terminal 2 (Untuk compile aset):
npm run dev

🚀 Aplikasi siap diakses di: http://127.0.0.1:8000

---

📂 Struktur Direktori Utama
Berikut adalah peta struktur folder untuk memudahkan navigasi kode:
kesmas-lab/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/         # 🔒 Logika Dashboard, Rekam Medis, Verifikasi
│   │   ├── Auth/          # 🔑 Logika Login & Autentikasi
│   │   └── Public/        # 🌍 Logika Halaman Depan Pasien
│   └── Models/            # 📦 Representasi Database (Client, Result, Parameter)
├── database/
│   └── migrations/        # ⚙️ Skema Tabel Database
├── resources/
│   ├── views/
│   │   ├── admin/         # 🎨 Tampilan Panel Admin
│   │   └── kesmas/        # 🎨 Tampilan Publik
└── routes/
    └── web.php            # 🔗 Definisi URL & Routing

---

👤 Akses Demo
Gunakan akun berikut untuk pengujian sistem (Default Seeder):
Role: Administrator
Email: admin@kesmas.com
Password: password123

---

🤝 Kontribusi
Kami sangat terbuka untuk kolaborasi! Jika Anda ingin berkontribusi:
Fork repository ini.
Buat branch fitur baru: git checkout -b fitur-keren.
Commit perubahan: git commit -m 'Menambahkan fitur keren'.
Push ke branch: git push origin fitur-keren.
Submit Pull Request.

---
<div align="center">

KESMAS-LAB © 2024 • Dilindungi oleh Lisensi MIT.

<small>Dibuat dengan ❤️ untuk kemajuan kesehatan masyarakat.</small>

</div>
