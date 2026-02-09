# MahasiswaApp

Sistem Informasi Akademik untuk manajemen data mahasiswa.

## Persyaratan Sistem

Sebelum menjalankan proyek ini, pastikan Anda memiliki persyaratan berikut terinstal di sistem Anda:

- **PHP**: Versi 8.2 atau lebih tinggi
- **Composer**: Dependency manager untuk PHP
- **Node.js**: Versi 18 atau lebih tinggi (untuk frontend build)
- **npm**: Package manager untuk Node.js (biasanya sudah termasuk dengan Node.js)
- **Database**: MySQL, PostgreSQL, atau SQLite (untuk penyimpanan data)

## Cara Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek MahasiswaApp di lingkungan lokal Anda:

### 1. Clone Repository

```bash
git clone <repository-url>
cd mahasiswa-app
```

### 2. Install Dependencies PHP

Install semua dependencies PHP menggunakan Composer:

```bash
composer install
```

### 3. Setup Environment

Salin file environment example dan generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan atur konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mahasiswa_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Jalankan Migration

Buat tabel database dengan menjalankan migration:

```bash
php artisan migrate
```

### 6. Install Dependencies Frontend

Install semua dependencies Node.js menggunakan npm:

```bash
npm install
```

### 7. Build Assets Frontend

Build assets frontend menggunakan Vite:

```bash
npm run build
```

### 8. Jalankan Aplikasi

Ada beberapa cara untuk menjalankan aplikasi:

#### Opsi 1: Jalankan secara manual

- Jalankan server Laravel:
  ```bash
  php artisan serve
  ```

- Jalankan Vite untuk development (di terminal terpisah):
  ```bash
  npm run dev
  ```

#### Opsi 2: Gunakan script dev (recommended)

Gunakan script `dev` yang sudah disediakan untuk menjalankan server, queue, dan Vite secara bersamaan:

```bash
composer run dev
```

### 9. Akses Aplikasi

Buka browser dan akses aplikasi di:

- **Frontend**: http://localhost:8000
- **Vite Dev Server**: http://localhost:5173 (jika menggunakan npm run dev)

### 10. Login Default

Untuk login pertama kali, Anda mungkin perlu membuat user admin atau menggunakan seeder yang tersedia.

## Catatan Tambahan

- Pastikan port 8000 dan 5173 tidak digunakan oleh aplikasi lain
- Jika menggunakan database MySQL, pastikan MySQL server sudah berjalan
- Untuk production deployment, gunakan `npm run build` dan konfigurasikan web server seperti Apache atau Nginx

## Troubleshooting

Jika mengalami masalah:

1. Pastikan semua persyaratan sistem terpenuhi
2. Jalankan `composer install` dan `npm install` ulang
3. Clear cache Laravel: `php artisan config:clear`
4. Pastikan file `.env` sudah benar
