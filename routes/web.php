<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\CompanyProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes - BatasKota Coffee
|--------------------------------------------------------------------------
*/

// ==========================================
// A. HALAMAN USER (PELANGGAN)
// ==========================================

// 1. Halaman Login / Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Halaman Menu / Katalog Produk (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');

// 3. Halaman Detail Produk & Variasi
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Routes yang memerlukan login
Route::middleware('auth')->group(function () {
    // 4. Halaman Keranjang Pesanan
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/item/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/item/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // 5. Halaman Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');

    // 6. Halaman Pembayaran Digital
    Route::get('/payment/{order}', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/{order}', [PaymentController::class, 'process'])->name('payment.process');

    // 7. Halaman Status Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.status');

    // 8. Halaman Profil Akun
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ==========================================
// B. HALAMAN ADMIN (OWNER / KASIR)
// ==========================================

Route::prefix('admin')->name('admin.')->group(function () {
    // 9. Halaman Login Admin
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Routes yang memerlukan login admin
    Route::middleware('auth:admin')->group(function () {
        // 10. Dashboard Admin
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

        // 11. Halaman Manajemen Produk
        Route::resource('products', AdminProductController::class);

        // 12. Halaman Manajemen Transaksi
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

        // 13. Halaman Manajemen Stok Bahan Baku
        Route::get('/stocks/history', [StockController::class, 'history'])->name('stocks.history');
        Route::resource('stocks', StockController::class);

        // 14. Halaman Laporan & Keuangan
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        Route::resource('expenses', ExpenseController::class);

        // 15. Halaman Manajemen Informasi BatasKota
        Route::get('/company', [CompanyProfileController::class, 'index'])->name('company');
        Route::put('/company', [CompanyProfileController::class, 'update'])->name('company.update');
        Route::post('/company/toggle-status', [CompanyProfileController::class, 'toggleStatus'])->name('company.toggle-status');

        // Logout Admin
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
