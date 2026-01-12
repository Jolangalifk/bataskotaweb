# Panduan Instalasi - BatasKota Coffee

Panduan lengkap untuk menjalankan project BatasKota Coffee dari GitHub.

---

## Persyaratan Sistem

Sebelum memulai, pastikan komputer Anda sudah terinstall:

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB
- Git
- Web Server (Apache/Nginx) atau Laragon/XAMPP

---

## Langkah 1: Clone Repository

Clone project dari GitHub ke komputer Anda:

```bash
# Clone repository
git clone https://github.com/username/bataskotaweb.git

# Masuk ke folder project
cd bataskotaweb
```

---

## Langkah 2: Install Dependencies

Install semua dependencies PHP menggunakan Composer:

```bash
composer install
```

Tunggu hingga proses selesai. Ini akan menginstall Laravel dan semua package yang diperlukan.

---

## Langkah 3: Konfigurasi Environment

### 3.1 Copy File Environment

```bash
# Windows
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### 3.2 Generate Application Key

```bash
php artisan key:generate
```

### 3.3 Edit File .env

Buka file `.env` dan sesuaikan konfigurasi database:

```env
APP_NAME="BatasKota Coffee"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bataskota
DB_USERNAME=root
DB_PASSWORD=

APP_TIMEZONE=Asia/Jakarta
```

---

## Langkah 4: Setup Database

### 4.1 Buat Database

Buka MySQL/phpMyAdmin dan buat database baru:

```sql
CREATE DATABASE bataskota CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Atau menggunakan command line:**

```bash
mysql -u root -e "CREATE DATABASE bataskota;"
```

### 4.2 Pilih Salah Satu Metode

#### Metode A: Restore dari Backup (Rekomendasi)

Jika ingin menggunakan data yang sudah ada:

```bash
# Windows (PowerShell)
Get-Content database/backups/database_backup.sql | mysql -u root bataskota

# Linux/Mac
mysql -u root bataskota < database/backups/database_backup.sql
```

**Atau menggunakan phpMyAdmin:**
1. Buka http://localhost/phpmyadmin
2. Pilih database `bataskota`
3. Tab "Import"
4. Pilih file `database/backups/database_backup.sql`
5. Klik "Go"

#### Metode B: Jalankan Migration & Seeder

Jika ingin mulai dari awal dengan data sample:

```bash
php artisan migrate:fresh --seed
```

---

## Langkah 5: Setup Storage

Buat symbolic link untuk storage:

```bash
php artisan storage:link
```

Ini akan membuat link dari `public/storage` ke `storage/app/public` untuk akses file upload.

---

## Langkah 6: Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

---

## Akses Aplikasi

### Halaman User
- Home: http://127.0.0.1:8000
- Menu: http://127.0.0.1:8000/menu
- Login: http://127.0.0.1:8000/login
- Register: http://127.0.0.1:8000/register

### Halaman Admin
- Login Admin: http://127.0.0.1:8000/admin/login

**Akun Admin Default:**
- Owner: owner@bataskota.com / password123
- Kasir: kasir@bataskota.com / password123

---

## Troubleshooting

### Error: "Class not found"

```bash
composer dump-autoload
```

### Error: "No application encryption key"

```bash
php artisan key:generate
```

### Error: "Database connection failed"

1. Pastikan MySQL sudah running
2. Cek konfigurasi di file `.env`
3. Pastikan database `bataskota` sudah dibuat

### Error: "Permission denied" (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Error: "The stream or file could not be opened"

```bash
# Windows
mkdir storage\logs
echo. > storage\logs\laravel.log

# Linux/Mac
mkdir -p storage/logs
touch storage/logs/laravel.log
chmod -R 775 storage
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"

Pastikan MySQL service running:

**Laragon:**
- Buka Laragon
- Klik "Start All"

**XAMPP:**
- Buka XAMPP Control Panel
- Start Apache dan MySQL

**Linux:**
```bash
sudo service mysql start
```

---

## Konfigurasi Tambahan (Opsional)

### Menggunakan Laragon

Jika menggunakan Laragon, Anda bisa akses aplikasi dengan:

1. Letakkan project di `C:\laragon\www\bataskotaweb`
2. Akses via: http://bataskotaweb.test

### Menggunakan XAMPP

1. Letakkan project di `C:\xampp\htdocs\bataskotaweb`
2. Akses via: http://localhost/bataskotaweb/public

### Menggunakan Virtual Host (Rekomendasi)

Buat virtual host untuk akses yang lebih mudah:

**Apache (httpd-vhosts.conf):**
```apache
<VirtualHost *:80>
    ServerName bataskota.test
    DocumentRoot "C:/laragon/www/bataskotaweb/public"
    <Directory "C:/laragon/www/bataskotaweb/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Hosts file (C:\Windows\System32\drivers\etc\hosts):**
```
127.0.0.1 bataskota.test
```

Restart Apache, lalu akses: http://bataskota.test

---

## Verifikasi Instalasi

Setelah instalasi selesai, verifikasi dengan:

### 1. Cek Routes

```bash
php artisan route:list
```

Pastikan semua routes terdaftar.

### 2. Cek Database

```bash
php artisan tinker
```

Kemudian jalankan:
```php
App\Models\Product::count();
App\Models\Admin::count();
```

Jika mengembalikan angka, database sudah terkoneksi dengan benar.

### 3. Test Aplikasi

1. Buka http://127.0.0.1:8000
2. Pastikan halaman home muncul
3. Login admin di http://127.0.0.1:8000/admin/login
4. Cek dashboard admin

---

## Command Berguna

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Reset Database

```bash
php artisan migrate:fresh --seed
```

### Backup Database

```bash
# Windows
mysqldump -u root bataskota > backup.sql

# Linux/Mac
mysqldump -u root bataskota > backup.sql
```

### Update Dependencies

```bash
composer update
```

---

## Struktur Project

```
bataskotaweb/
├── app/                    # Kode aplikasi
├── database/               # Migrations, seeders, backups
├── public/                 # Entry point & assets
├── resources/              # Views, CSS, JS
├── routes/                 # Route definitions
├── storage/                # Logs, cache, uploads
├── .env                    # Environment config
├── composer.json           # PHP dependencies
└── README.md              # Dokumentasi
```

---

## Fitur Aplikasi

### Fitur Pelanggan
- Lihat menu produk
- Detail produk dengan variasi
- Keranjang belanja
- Checkout dan pembayaran
- Tracking pesanan
- Profil akun

### Fitur Admin
- Dashboard statistik
- Manajemen produk
- Manajemen pesanan
- Manajemen stok bahan baku
- Laporan keuangan
- Manajemen pengeluaran
- Manajemen info usaha

---

## Dokumentasi Tambahan

- **README.md** - Dokumentasi utama project
- **STRUKTUR_FOLDER.md** - Penjelasan struktur folder
- **DATABASE_BACKUP.md** - Panduan backup & restore database

---

## Development Tips

### 1. Gunakan Git

```bash
# Buat branch baru untuk fitur
git checkout -b feature/nama-fitur

# Commit perubahan
git add .
git commit -m "Deskripsi perubahan"

# Push ke GitHub
git push origin feature/nama-fitur
```

### 2. Debug Mode

Saat development, set `APP_DEBUG=true` di `.env` untuk melihat error detail.

Saat production, set `APP_DEBUG=false` untuk keamanan.

### 3. Testing

```bash
# Jalankan tests
php artisan test

# Buat test baru
php artisan make:test NamaTest
```

### 4. Code Style

```bash
# Format code (jika menggunakan Laravel Pint)
./vendor/bin/pint
```

---

## Deployment ke Production

### 1. Optimize Aplikasi

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### 2. Set Environment

```env
APP_ENV=production
APP_DEBUG=false
```

### 3. Setup HTTPS

Gunakan SSL certificate untuk keamanan.

### 4. Backup Rutin

Setup cron job untuk backup database otomatis.

---

## Support

Jika mengalami masalah:

1. Cek dokumentasi Laravel: https://laravel.com/docs/10.x
2. Cek file troubleshooting di atas
3. Cek log error di `storage/logs/laravel.log`

---

## Teknologi

- **Framework**: Laravel 10
- **PHP**: 8.1+
- **Database**: MySQL 8.0
- **Frontend**: Tailwind CSS
- **Timezone**: Asia/Jakarta (WIB)

---

## Lisensi

Project ini dibuat untuk BatasKota Coffee.

---

**Selamat menggunakan BatasKota Coffee Web Application!**

Last Updated: 12 Januari 2026
