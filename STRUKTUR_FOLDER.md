# 📁 Struktur Folder Project BatasKota Coffee

Penjelasan lengkap setiap folder dan fungsinya dalam project Laravel.

---

## 🏗️ STRUKTUR UTAMA PROJECT

```
bataskotaweb/
├── app/                          # Kode aplikasi utama
├── bootstrap/                    # File bootstrap Laravel
├── config/                       # File konfigurasi
├── database/                     # Database migrations & seeders
├── public/                       # File publik (assets, images)
├── resources/                    # Resources (views, CSS, JS)
├── routes/                       # Definisi routes
├── storage/                      # Storage files (cache, logs)
├── tests/                        # File testing
├── vendor/                       # Dependencies (Composer)
├── .env                          # Environment configuration
├── .env.example                  # Template .env
├── artisan                       # Laravel CLI
├── composer.json                 # Composer dependencies
├── composer.lock                 # Lock file dependencies
├── package.json                  # NPM dependencies
├── phpunit.xml                   # Testing configuration
├── vite.config.js                # Vite configuration
└── README.md                     # Dokumentasi project
```

---

## 📂 PENJELASAN DETAIL SETIAP FOLDER

### 1️⃣ `app/` - Kode Aplikasi Utama

**Fungsi**: Tempat semua kode bisnis aplikasi

```
app/
├── Console/                      # Artisan commands
│   └── Kernel.php               # Konfigurasi console
├── Exceptions/                   # Exception handling
│   └── Handler.php              # Exception handler
├── Http/                         # HTTP layer
│   ├── Controllers/             # Controllers (logika aplikasi)
│   │   ├── HomeController.php   # Home page logic
│   │   ├── CartController.php   # Cart logic
│   │   ├── CheckoutController.php
│   │   ├── PaymentController.php
│   │   ├── ProfileController.php
│   │   ├── OrderController.php
│   │   └── Admin/               # Admin controllers
│   │       ├── AdminAuthController.php
│   │       ├── AdminDashboardController.php
│   │       ├── ProductController.php
│   │       ├── OrderController.php
│   │       ├── StockController.php
│   │       ├── ExpenseController.php
│   │       ├── ReportController.php
│   │       └── CompanyProfileController.php
│   ├── Middleware/              # Middleware (filter request)
│   │   └── Authenticate.php
│   └── Requests/                # Form validation requests
├── Models/                       # Database models (Eloquent)
│   ├── User.php                 # User model
│   ├── Admin.php                # Admin model
│   ├── Product.php              # Product model
│   ├── ProductVariant.php       # Product variant model
│   ├── Cart.php                 # Cart model
│   ├── CartItem.php             # Cart item model
│   ├── Order.php                # Order model
│   ├── OrderItem.php            # Order item model
│   ├── Stock.php                # Stock model
│   ├── StockHistory.php         # Stock history model
│   ├── Expense.php              # Expense model
│   └── CompanyProfile.php       # Company profile model
├── Providers/                    # Service providers
│   ├── AppServiceProvider.php   # Main service provider
│   ├── AuthServiceProvider.php  # Auth service provider
│   ├── BroadcastServiceProvider.php
│   ├── EventServiceProvider.php
│   └── RouteServiceProvider.php
└── Kernel.php                   # Application kernel
```

**Penjelasan**:
- **Controllers**: Menangani logika bisnis (proses request dari user)
- **Models**: Representasi tabel database (query, relasi)
- **Middleware**: Filter/validasi request sebelum masuk controller
- **Providers**: Konfigurasi service aplikasi

---

### 2️⃣ `bootstrap/` - Bootstrap Laravel

**Fungsi**: File inisialisasi Laravel

```
bootstrap/
├── app.php                      # Inisialisasi aplikasi
└── cache/                       # Cache folder (auto-generated)
    ├── packages.php
    └── services.php
```

**Penjelasan**:
- `app.php`: File yang di-load pertama kali saat aplikasi start
- `cache/`: Menyimpan cache konfigurasi untuk performa

---

### 3️⃣ `config/` - Konfigurasi Aplikasi

**Fungsi**: File konfigurasi aplikasi

```
config/
├── app.php                      # Konfigurasi aplikasi (timezone, name)
├── auth.php                     # Konfigurasi authentication
├── broadcasting.php             # Konfigurasi broadcasting
├── cache.php                    # Konfigurasi cache
├── cors.php                     # CORS configuration
├── database.php                 # Konfigurasi database
├── filesystems.php              # Konfigurasi file storage
├── hashing.php                  # Password hashing config
├── logging.php                  # Logging configuration
├── mail.php                     # Email configuration
├── queue.php                    # Queue configuration
├── sanctum.php                  # API token configuration
├── services.php                 # Third-party services config
├── session.php                  # Session configuration
└── view.php                     # View configuration
```

**Penjelasan**:
- Semua konfigurasi aplikasi ada di sini
- Bisa di-override dengan environment variables di `.env`
- Contoh: `config/app.php` mengatur timezone ke `Asia/Jakarta`

---

### 4️⃣ `database/` - Database Migrations & Seeders

**Fungsi**: Mengelola database schema dan data awal

```
database/
├── migrations/                  # Database schema files
│   ├── 2014_10_12_000000_create_users_table.php
│   ├── 2025_12_30_140001_create_admins_table.php
│   ├── 2025_12_30_140002_create_products_table.php
│   ├── 2025_12_30_140003_create_product_variants_table.php
│   ├── 2025_12_30_140005_create_cart_items_table.php
│   ├── 2025_12_30_140006_create_orders_table.php
│   ├── 2025_12_30_140007_create_order_items_table.php
│   ├── 2025_12_30_140009_create_stocks_table.php
│   ├── 2025_12_30_140010_create_stock_histories_table.php
│   └── 2025_12_30_140011_create_expenses_table.php
├── seeders/                     # Data seeding files
│   ├── DatabaseSeeder.php       # Main seeder
│   ├── AdminSeeder.php          # Seed admin data
│   ├── ProductSeeder.php        # Seed product data
│   ├── StockSeeder.php          # Seed stock data
│   └── CompanyProfileSeeder.php # Seed company data
└── factories/                   # Model factories (untuk testing)
```

**Penjelasan**:
- **Migrations**: File untuk membuat/mengubah struktur tabel database
  - Jalankan: `php artisan migrate`
  - Rollback: `php artisan migrate:rollback`
- **Seeders**: File untuk mengisi data awal ke database
  - Jalankan: `php artisan db:seed`
  - Contoh: AdminSeeder membuat akun admin default

---

### 5️⃣ `public/` - File Publik (Assets)

**Fungsi**: File yang bisa diakses langsung dari browser

```
public/
├── index.php                    # Entry point aplikasi
├── .htaccess                    # Apache configuration
├── logo.svg                     # Logo aplikasi
├── assets/                      # Assets folder
│   ├── css/                     # CSS files
│   ├── js/                      # JavaScript files
│   ├── images/                  # Images
│   └── fonts/                   # Custom fonts
└── storage/                     # Symlink ke storage/app/public
    └── (uploaded files)         # File upload dari user
```

**Penjelasan**:
- `index.php`: File pertama yang diakses saat user buka aplikasi
- `assets/`: Semua CSS, JS, images yang digunakan
- `storage/`: Symlink ke folder storage untuk akses file upload
- Akses: `http://localhost:8000/logo.svg`

---

### 6️⃣ `resources/` - Resources (Views, CSS, JS)

**Fungsi**: Template views dan asset development

```
resources/
├── views/                       # Blade templates
│   ├── layouts/                 # Layout templates
│   │   ├── app.blade.php        # Main layout (user)
│   │   ├── admin.blade.php      # Admin layout
│   │   ├── auth.blade.php       # Auth layout
│   │   └── partials/            # Reusable components
│   │       ├── header.blade.php
│   │       ├── footer.blade.php
│   │       ├── admin-sidebar.blade.php
│   │       ├── admin-topbar.blade.php
│   │       └── ...
│   ├── pages/                   # User pages
│   │   ├── home.blade.php       # Home page
│   │   ├── menu.blade.php       # Menu page
│   │   ├── detail-product.blade.php
│   │   ├── cart.blade.php
│   │   ├── checkout.blade.php
│   │   ├── payment.blade.php
│   │   ├── orders.blade.php
│   │   ├── order-status.blade.php
│   │   └── profile.blade.php
│   ├── auth/                    # Auth pages
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── admin/                   # Admin pages
│   │   ├── login.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── products/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── orders/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   ├── stocks/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── history.blade.php
│   │   ├── expenses/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   ├── reports/
│   │   │   └── index.blade.php
│   │   └── company/
│   │       └── index.blade.php
│   └── errors/                  # Error pages
│       ├── 404.blade.php
│       └── 500.blade.php
├── css/                         # CSS files
│   └── app.css                  # Main CSS
└── js/                          # JavaScript files
    └── app.js                   # Main JS
```

**Penjelasan**:
- **views/**: Semua template Blade (HTML + PHP)
  - `layouts/`: Template dasar yang di-extend halaman lain
  - `pages/`: Halaman user
  - `admin/`: Halaman admin
  - `auth/`: Halaman login/register
- **css/ & js/**: Asset development (di-compile dengan Vite)

---

### 7️⃣ `routes/` - Definisi Routes

**Fungsi**: Mendefinisikan URL routes aplikasi

```
routes/
├── web.php                      # Web routes (HTTP)
├── api.php                      # API routes (REST API)
├── console.php                  # Console routes (Artisan)
└── channels.php                 # Broadcasting channels
```

**Penjelasan**:
- `web.php`: Semua routes untuk web (GET, POST, PUT, DELETE)
  - Contoh: `Route::get('/', [HomeController::class, 'index'])`
- `api.php`: Routes untuk REST API (jika ada)
- Jalankan: `php artisan route:list` untuk lihat semua routes

---

### 8️⃣ `storage/` - Storage Files

**Fungsi**: Menyimpan file aplikasi (cache, logs, uploads)

```
storage/
├── app/                         # Application storage
│   ├── public/                  # Public storage (file upload)
│   │   └── (uploaded files)     # Gambar produk, dll
│   └── (private files)
├── framework/                   # Framework storage
│   ├── cache/                   # Cache files
│   ├── sessions/                # Session files
│   └── views/                   # Compiled Blade views
└── logs/                        # Log files
    └── laravel.log              # Application log
```

**Penjelasan**:
- `app/public/`: File upload dari user (gambar produk)
- `framework/views/`: Blade template yang sudah di-compile
- `logs/`: Log aplikasi (error, info, debug)
- Akses file upload: `http://localhost:8000/storage/nama-file`

---

### 9️⃣ `tests/` - Testing Files

**Fungsi**: File untuk unit testing dan feature testing

```
tests/
├── Feature/                     # Feature tests
│   └── ExampleTest.php
├── Unit/                        # Unit tests
│   └── ExampleTest.php
└── TestCase.php                 # Base test class
```

**Penjelasan**:
- **Feature tests**: Test fitur aplikasi (HTTP requests)
- **Unit tests**: Test individual functions/methods
- Jalankan: `php artisan test`

---

### 🔟 `vendor/` - Dependencies (Composer)

**Fungsi**: Library/package yang diinstall via Composer

```
vendor/
├── laravel/                     # Laravel framework
├── symfony/                     # Symfony components
├── guzzlehttp/                  # HTTP client
├── monolog/                     # Logging library
└── ... (ratusan package lainnya)
```

**Penjelasan**:
- Folder ini auto-generated dari `composer.json`
- Jangan edit file di sini
- Jalankan: `composer install` untuk install dependencies
- Jalankan: `composer update` untuk update dependencies

---

## 📋 FILE PENTING DI ROOT

### `.env` - Environment Configuration
```
APP_NAME=BatasKota Coffee
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bataskota
DB_USERNAME=root
DB_PASSWORD=
```

**Fungsi**: Konfigurasi environment (database, API keys, dll)

---

### `composer.json` - Composer Dependencies
```json
{
    "name": "laravel/laravel",
    "require": {
        "php": "^8.1",
        "laravel/framework": "^10.0"
    }
}
```

**Fungsi**: Daftar package PHP yang digunakan

---

### `package.json` - NPM Dependencies
```json
{
    "name": "bataskota",
    "devDependencies": {
        "vite": "^4.0",
        "tailwindcss": "^3.0"
    }
}
```

**Fungsi**: Daftar package JavaScript yang digunakan

---

### `vite.config.js` - Vite Configuration
```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel(['resources/css/app.css', 'resources/js/app.js']),
    ],
});
```

**Fungsi**: Konfigurasi Vite (build tool untuk CSS/JS)

---

### `phpunit.xml` - Testing Configuration
```xml
<phpunit>
    <testsuites>
        <testsuite name="Unit">
            <directory suffix="Test.php">./tests/Unit</directory>
        </testsuite>
        <testsuite name="Feature">
            <directory suffix="Test.php">./tests/Feature</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

**Fungsi**: Konfigurasi PHPUnit untuk testing

---

## 🎯 ALUR KERJA FOLDER

### Saat User Akses Halaman:

```
1. User buka: http://localhost:8000/menu
                        ↓
2. Laravel cek routes/web.php
   Route::get('/menu', [HomeController::class, 'menu'])
                        ↓
3. Jalankan HomeController@menu
   (app/Http/Controllers/HomeController.php)
                        ↓
4. Controller query database via Model
   (app/Models/Product.php)
                        ↓
5. Return view dengan data
   return view('pages.menu', compact('products'))
                        ↓
6. Render Blade template
   (resources/views/pages/menu.blade.php)
                        ↓
7. Compile Blade → PHP
   Simpan di storage/framework/views/hash.php
                        ↓
8. Jalankan PHP file yang sudah di-compile
                        ↓
9. Tampilkan HTML ke browser
```

---

## 📊 STRUKTUR FOLDER VISUAL

```
bataskotaweb/
│
├── 📂 app/                      ← Kode aplikasi (Controllers, Models)
│   ├── Http/Controllers/        ← Logika bisnis
│   └── Models/                  ← Database models
│
├── 📂 database/                 ← Database schema & data
│   ├── migrations/              ← Struktur tabel
│   └── seeders/                 ← Data awal
│
├── 📂 resources/                ← Views & assets
│   └── views/                   ← Template HTML (Blade)
│
├── 📂 routes/                   ← URL routes
│   └── web.php                  ← Definisi routes
│
├── 📂 public/                   ← File publik (CSS, JS, images)
│   └── storage/                 ← File upload
│
├── 📂 storage/                  ← Cache, logs, compiled views
│   ├── framework/views/         ← Compiled Blade
│   └── logs/                    ← Application logs
│
├── 📂 config/                   ← Konfigurasi aplikasi
│
├── 📂 bootstrap/                ← Bootstrap Laravel
│
├── 📂 vendor/                   ← Dependencies (Composer)
│
├── 📂 tests/                    ← Testing files
│
├── .env                         ← Environment config
├── composer.json                ← PHP dependencies
├── package.json                 ← JS dependencies
├── vite.config.js               ← Build tool config
└── README.md                    ← Dokumentasi
```

---

## 🚀 COMMAND PENTING

### Lihat struktur folder
```bash
# Linux/Mac
tree -L 2

# Windows (PowerShell)
Get-ChildItem -Recurse -Depth 2
```

### Generate files
```bash
php artisan make:controller NamaController
php artisan make:model NamaModel
php artisan make:migration create_nama_table
php artisan make:seeder NamaSeeder
```

### Database
```bash
php artisan migrate                 # Jalankan migrations
php artisan migrate:rollback        # Rollback migrations
php artisan db:seed                 # Jalankan seeders
php artisan migrate:fresh --seed    # Reset + seed
```

### Cache
```bash
php artisan cache:clear             # Clear cache
php artisan view:clear              # Clear compiled views
php artisan route:clear             # Clear route cache
```

---

## 💡 TIPS

1. **Jangan edit `vendor/`** - Folder ini auto-generated
2. **Jangan edit `storage/framework/views/`** - Ini compiled cache
3. **Edit di `resources/views/`** - Tempat yang benar untuk edit views
4. **Edit di `app/Http/Controllers/`** - Tempat yang benar untuk edit logic
5. **Edit di `database/migrations/`** - Tempat yang benar untuk edit schema
6. **Gunakan `.env`** - Untuk konfigurasi environment-specific

---

**Semoga penjelasan ini membantu Anda memahami struktur folder project! 🎉**
