# Database Backup - BatasKota Coffee

Dokumentasi tentang backup dan restore database project BatasKota Coffee.

## Lokasi Backup

File backup database tersimpan di:
```
database/backups/database_backup.sql
```

## Informasi Backup

- Database: bataskota
- Tanggal Backup: 12 Januari 2026
- Ukuran: ~42 KB
- Format: SQL

## Tabel yang Ter-backup

1. admins
2. cart_items
3. carts
4. company_profiles
5. expenses
6. failed_jobs
7. migrations
8. order_items
9. orders
10. password_reset_tokens
11. payments
12. personal_access_tokens
13. product_variants
14. products
15. stock_histories
16. stocks
17. users

## Cara Restore Database

### Metode 1: Menggunakan MySQL Command Line

```bash
# Pastikan MySQL running
mysql -u root bataskota < database/backups/database_backup.sql
```

### Metode 2: Menggunakan phpMyAdmin (Laragon)

1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Pilih database `bataskota`
3. Klik tab "Import"
4. Pilih file `database/backups/database_backup.sql`
5. Klik "Go"

### Metode 3: Menggunakan Laravel Artisan

```bash
# Buat database baru
php artisan db:seed

# Atau restore dari backup
mysql -u root bataskota < database/backups/database_backup.sql
```

## Cara Membuat Backup Baru

### Metode 1: Menggunakan mysqldump

```bash
mysqldump -u root bataskota > database/backups/database_backup_$(date +%Y%m%d_%H%M%S).sql
```

### Metode 2: Menggunakan Script PHP

Buat file `backup_database.php`:

```php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$db = DB::connection();
$dbName = config('database.connections.mysql.database');

echo "Exporting database: $dbName" . PHP_EOL;

$tables = DB::select('SHOW TABLES');
$sql = "-- Database Backup for $dbName" . PHP_EOL;
$sql .= "-- Generated: " . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL;

foreach ($tables as $table) {
    $tableName = array_values((array)$table)[0];
    
    echo "Exporting table: $tableName" . PHP_EOL;
    
    $sql .= "DROP TABLE IF EXISTS `$tableName`;" . PHP_EOL;
    
    $createTable = DB::select("SHOW CREATE TABLE `$tableName`");
    $sql .= $createTable[0]->{'Create Table'} . ";" . PHP_EOL . PHP_EOL;
    
    $rows = DB::table($tableName)->get();
    
    if ($rows->count() > 0) {
        $columns = array_keys((array)$rows[0]);
        $columnList = implode('`, `', $columns);
        
        foreach ($rows as $row) {
            $values = [];
            foreach ($columns as $col) {
                $value = $row->$col;
                if ($value === null) {
                    $values[] = 'NULL';
                } else {
                    $values[] = "'" . addslashes($value) . "'";
                }
            }
            $sql .= "INSERT INTO `$tableName` (`$columnList`) VALUES (" . implode(', ', $values) . ");" . PHP_EOL;
        }
        $sql .= PHP_EOL;
    }
}

$filename = 'database/backups/database_backup_' . date('Y-m-d_H-i-s') . '.sql';
file_put_contents($filename, $sql);

echo PHP_EOL;
echo "Database exported successfully!" . PHP_EOL;
echo "File: $filename" . PHP_EOL;
echo "Size: " . number_format(filesize($filename), 0, ',', '.') . " bytes" . PHP_EOL;
```

Jalankan:
```bash
php backup_database.php
```

## Data yang Ter-backup

### Admin Accounts
- Owner: owner@bataskota.com / password123
- Kasir: kasir@bataskota.com / password123

### Products
- Kopi Susu Vanilla
- Kopi Susu Batas Kota
- Dan produk lainnya

### Orders
- Pesanan dari user dengan berbagai status

### Stocks
- Stok bahan baku dengan history

### Expenses
- Pengeluaran usaha

### Company Profile
- Informasi BatasKota Coffee
- Jam operasional: 07:00 - 22:00
- Lokasi dan kontak

## Tips Backup

1. **Backup Rutin**: Lakukan backup setiap minggu atau setelah perubahan penting
2. **Multiple Backups**: Simpan beberapa versi backup untuk keamanan
3. **Test Restore**: Selalu test restore backup untuk memastikan data valid
4. **Dokumentasi**: Catat tanggal dan deskripsi setiap backup
5. **Lokasi Aman**: Simpan backup di lokasi yang aman (cloud, external drive)

## Troubleshooting

### Error: "Can't connect to MySQL server"

Pastikan MySQL running:
- Buka Laragon
- Klik tombol "Start All"
- Tunggu sampai MySQL status hijau

### Error: "Access denied for user 'root'"

Pastikan password MySQL benar di `.env`:
```
DB_USERNAME=root
DB_PASSWORD=
```

### Error: "Unknown database 'bataskota'"

Buat database terlebih dahulu:
```bash
mysql -u root -e "CREATE DATABASE bataskota;"
```

Kemudian restore backup:
```bash
mysql -u root bataskota < database/backups/database_backup.sql
```

## Informasi Lebih Lanjut

- Database: MySQL 8.0
- Charset: utf8mb4
- Collation: utf8mb4_unicode_ci
- Project: BatasKota Coffee Web Application
- Framework: Laravel 10

---

**Last Updated**: 12 Januari 2026
