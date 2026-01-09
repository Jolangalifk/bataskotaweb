<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Expense;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total Pendapatan (bulan ini) - include paid and done orders
        $totalRevenue = Order::whereIn('status', ['paid', 'process', 'ready', 'done'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        // Total Pengeluaran (bulan ini)
        $totalExpense = Expense::whereMonth('expense_date', now()->month)
            ->whereYear('expense_date', now()->year)
            ->sum('amount');

        // Laba Rugi
        $profit = $totalRevenue - $totalExpense;

        // Total Pesanan Hari Ini
        $todayOrders = Order::whereDate('created_at', today())->count();

        // Pesanan Pending (belum dibayar)
        $pendingOrders = Order::where('status', 'pending')->count();

        // Produk Terlaris (dari semua order yang sudah dibayar)
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereHas('order', function ($q) {
                $q->whereIn('status', ['paid', 'process', 'ready', 'done'])
                    ->whereMonth('created_at', now()->month);
            })
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->with('product')
            ->get();

        // Pesanan Terbaru
        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalExpense',
            'profit',
            'todayOrders',
            'pendingOrders',
            'topProducts',
            'recentOrders'
        ));
    }
}
