# BatasKota Coffee - Aplikasi Web

Aplikasi web untuk manajemen kopi lokal BatasKota Coffee dengan sistem pemesanan online dan dashboard admin.

## Cara Menjalankan Aplikasi

### 1. Persiapan Database
Buat database MySQL dengan nama `bataskota`:
```sql
CREATE DATABASE bataskota;
```

### 2. Konfigurasi Environment
Pastikan file `.env` sudah dikonfigurasi dengan benar:
```
DB_DATABASE=bataskota
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Jalankan Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

### 4. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

## Login Admin

Akses halaman admin di: **http://127.0.0.1:8000/admin/login**

**Akun Owner:**
- Email: owner@bataskota.com
- Password: password123

**Akun Kasir:**
- Email: kasir@bataskota.com
- Password: password123

## Fitur Aplikasi

### Fitur Pelanggan
- Lihat menu produk kopi dan makanan
- Detail produk dengan variasi (ukuran, suhu, level gula, shot espresso)
- Keranjang belanja
- Checkout dan pembayaran (QRIS)
- Tracking status pesanan
- Profil akun

### Fitur Admin
- Dashboard dengan statistik penjualan
- Manajemen produk (tambah, edit, hapus)
- Manajemen pesanan dan update status
- Manajemen stok bahan baku
- Riwayat perubahan stok
- Laporan keuangan (pendapatan, pengeluaran, laba rugi)
- Manajemen pengeluaran
- Manajemen informasi usaha (alamat, jam operasional, status toko)
- Toggle status toko (buka/tutup)

## Struktur Database

### Tabel Utama
- **users** - Data pelanggan
- **admins** - Data admin (owner/kasir)
- **products** - Menu produk
- **carts & cart_items** - Keranjang belanja
- **orders & order_items** - Pesanan
- **stocks & stock_histories** - Stok bahan baku
- **expenses** - Pengeluaran usaha
- **company_profiles** - Informasi usaha

## 🛠️ Command Laravel yang Sering Digunakan

### Server
```bash
php artisan serve                    # Jalankan server
```

### Database
```bash
php artisan migrate                  # Jalankan migration
php artisan migrate:fresh --seed     # Reset database + seeder
php artisan db:seed                  # Jalankan seeder saja
```

### Cache
```bash
php artisan cache:clear              # Clear cache
php artisan config:clear             # Clear config cache
php artisan route:clear              # Clear route cache
```

### Generate Files
```bash
php artisan make:controller NamaController
php artisan make:model NamaModel
php artisan make:migration create_nama_table
```

### Info
```bash
php artisan route:list               # Lihat semua routes
php artisan --version                # Lihat versi Laravel
```

## Struktur Folder Penting

```
bataskotaweb/
├── app/
│   ├── Http/Controllers/        # Logic aplikasi
│   └── Models/                  # Model database
├── database/
│   ├── migrations/              # Schema database
│   └── seeders/                 # Data awal
├── resources/
│   └── views/                   # Tampilan (Blade)
│       ├── pages/               # Halaman user
│       ├── admin/               # Halaman admin
│       ├── auth/                # Login/Register
│       └── layouts/             # Template layout
├── routes/
│   └── web.php                  # Definisi routes
├── public/                      # Assets (CSS, JS, images)
└── .env                         # Konfigurasi environment
```

## Routes Penting

### Halaman User
- `/` - Home
- `/menu` - Menu produk
- `/product/{id}` - Detail produk
- `/cart` - Keranjang
- `/checkout` - Checkout
- `/orders` - Daftar pesanan
- `/profile` - Profil

### Halaman Admin
- `/admin/login` - Login admin
- `/admin/dashboard` - Dashboard
- `/admin/products` - Manajemen produk
- `/admin/orders` - Manajemen pesanan
- `/admin/stocks` - Manajemen stok
- `/admin/expenses` - Pengeluaran
- `/admin/reports` - Laporan keuangan
- `/admin/company` - Info usaha

## Teknologi

- **Framework**: Laravel 10
- **PHP**: 8.1+
- **Database**: MySQL
- **Frontend**: Tailwind CSS
- **Timezone**: Asia/Jakarta (WIB)

## Catatan Penting

1. **Timezone**: Aplikasi menggunakan timezone Asia/Jakarta (WIB)
2. **Stok Default**: Stok bahan baku default adalah 0 gram, admin harus menambahkan stok manual
3. **Status Toko**: Status toko ditentukan oleh toggle manual admin DAN jam operasional
4. **Checkout**: Button checkout akan disabled jika toko tutup
5. **Pengeluaran**: Saat ini hanya kategori "Pembelian Bahan Baku" yang aktif

## Troubleshooting

### Error: Database connection failed
- Pastikan MySQL sudah running
- Cek konfigurasi di file `.env`
- Pastikan database `bataskota` sudah dibuat

### Error: Route not found
```bash
php artisan route:clear
php artisan cache:clear
```

### Error: Class not found
```bash
composer dump-autoload
```

### Error: Permission denied (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## Support

Untuk dokumentasi lengkap Laravel: https://laravel.com/docs/10.x

---

**Project**: BatasKota Coffee Web Application  
**Framework**: Laravel 10  
**Database**: MySQL (bataskota)  
**Location**: C:\laragon\www\bataskotaweb
