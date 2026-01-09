<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Expense;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->toDateString();
        $endDate = $request->end_date ?? now()->toDateString();

        // Total Pendapatan (include paid and done orders)
        $totalRevenue = Order::whereIn('status', ['paid', 'process', 'ready', 'done'])
            ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
            ->sum('total_price');

        // Total Pengeluaran
        $totalExpenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
            ->sum('amount');

        // Laba Rugi
        $profit = $totalRevenue - $totalExpenses;

        // Produk Terlaris (dari semua order yang sudah dibayar)
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->whereHas('order', function ($q) use ($startDate, $endDate) {
                $q->whereIn('status', ['paid', 'process', 'ready', 'done'])
                    ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59']);
            })
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->with('product')
            ->get();

        // Transaksi per hari (dari semua order yang sudah dibayar)
        $dailyTransactions = Order::whereIn('status', ['paid', 'process', 'ready', 'done'])
            ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Recent Orders (semua order yang sudah dibayar)
        $recentOrders = Order::whereIn('status', ['paid', 'process', 'ready', 'done'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue',
            'totalExpenses',
            'profit',
            'topProducts',
            'dailyTransactions',
            'startDate',
            'endDate',
            'recentOrders'
        ));
    }
}
