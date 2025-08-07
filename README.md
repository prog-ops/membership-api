# Aplikasi Membership Konten (Content Membership Platform)
Selamat datang di repositori Aplikasi Membership Konten! Ini adalah aplikasi web full-stack yang dibangun sebagai studi kasus untuk mengimplementasikan sistem keanggotaan dengan berbagai level hak akses terhadap konten digital.

Aplikasi ini mengelola akses pengguna ke artikel dan video berdasarkan tiga tingkatan membership yang berbeda (Tipe A, B, dan C), serta mendukung otentikasi manual dan sosial (Google & Facebook).

## ✨ Fitur Utama
- Otentikasi Lengkap:
  - Registrasi dan Login manual dengan validasi.
  - Login sosial media menggunakan Google dan Facebook via Laravel Socialite.
- Sistem Membership 3 Tingkat:
  - Tipe A: Akses terbatas ke 3 artikel dan 3 video.
  - Tipe B: Akses medium ke 10 artikel dan 10 video.
  - Tipe C: Akses penuh ke seluruh konten.
- Role-Based Access Control (RBAC): Konten yang ditampilkan kepada pengguna disaring secara dinamis di sisi backend berdasarkan level membership mereka.
- Dashboard Pengguna: Halaman dashboard yang personal dan menampilkan ringkasan hak akses yang dimiliki pengguna.
- Arsitektur Modern: Dibangun dengan pendekatan monolithic SPA menggunakan Laravel dan Inertia.js untuk pengalaman pengguna yang cepat dan reaktif tanpa perlu membangun API terpisah.

## 💻 Tech Stack
Backend
- PHP 8.x
- Laravel 10.x
- Laravel Socialite (untuk Social Login)
- PostgreSQL database

Frontend
- React.js
- TypeScript
- Inertia.js (penghubung backend & frontend)
- Tailwind CSS
- Vite (build tool)

Development Environment
- Laragon

## 🚀 Panduan Instalasi & Setup Lokal
Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal anda.

1. Clone Repositori
   ```bash
   git clone [LINK_REPO_ANDA]
   cd [NAMA_FOLDER_PROYEK]
   ```
   
2. Instal Dependensi
   Pastikan anda memiliki Composer dan Node.js terinstal.
   ```bash
   # Instal dependensi PHP
   composer install
   # Instal dependensi JavaScript
   npm install
   ```
   
3. Generate Application Key
   ```bash
   php artisan key:generate
   ```
   
4. Setup File `.env`
   Koneksi Database:
   ```code snippet
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=membership_db
   DB_USERNAME=postgres
   DB_PASSWORD=password_anda
   ```

   Kredensial Social Login:
   ```code snippet
   GOOGLE_CLIENT_ID=GOOGLE_CLIENT_ID anda
   GOOGLE_CLIENT_SECRET=GOOGLE_CLIENT_SECRET anda
   GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback

   FACEBOOK_CLIENT_ID=FACEBOOK_CLIENT_ID anda
   FACEBOOK_CLIENT_SECRET=FACEBOOK_CLIENT_SECRET anda
   FACEBOOK_REDIRECT_URI=http://127.0.0.1:8000/auth/facebook/callback
   ```

5. Migrasi dan Seeding Database
   Perintah ini akan membuat semua tabel dan mengisinya dengan data dummy (user, artikel, video).
   ```bash
   php artisan migrate:fresh --seed
   ```
   
6. Jalankan Server
    Anda perlu menjalankan dua server secara bersamaan di dua terminal terpisah.
    ```bash
    # Di terminal 1, jalankan server backend Laravel
    php artisan serve

    # Di terminal 2, jalankan server frontend Vite
    npm run dev
    ```

7. Selesai
   Buka browser anda dan akses http://127.0.0.1:8000. Aplikasi sudah siap digunakan

