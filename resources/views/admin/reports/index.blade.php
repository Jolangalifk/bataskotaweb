@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-7xl mx-auto w-full">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Laporan Keuangan</h2>
        <p class="text-slate-500 dark:text-slate-400">Ringkasan performa bisnis</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-slate-500 text-sm font-medium">Total Pendapatan</span>
                <span class="material-symbols-outlined text-green-600">trending_up</span>
            </div>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-slate-500 text-sm font-medium">Total Pengeluaran</span>
                <span class="material-symbols-outlined text-red-600">trending_down</span>
            </div>
            <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalExpenses ?? 0, 0, ',', '.') }}</p>
        </div>
        {{-- 
        <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-slate-500 text-sm font-medium">Laba Bersih</span>
                <span class="material-symbols-outlined text-primary">account_balance</span>
            </div>
            @php $profit = ($totalRevenue ?? 0) - ($totalExpenses ?? 0); @endphp
            <p class="text-3xl font-bold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                Rp {{ number_format($profit, 0, ',', '.') }}
            </p>
        </div>
        --}}
    </div>

    <!-- Top Products -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6 mb-8">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Produk Terlaris</h3>
        <div class="space-y-4">
            @forelse($topProducts ?? [] as $product)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ $loop->iteration }}
                    </div>
                    <span class="font-medium text-slate-900 dark:text-white">{{ $product->name }}</span>
                </div>
                <span class="text-slate-500">{{ $product->total_sold ?? 0 }} terjual</span>
            </div>
            @empty
            <p class="text-slate-500 text-center py-4">Belum ada data penjualan</p>
            @endforelse
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Transaksi Terbaru</h3>
        <div class="space-y-3">
            @forelse($recentOrders ?? [] as $order)
            <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                <div>
                    <p class="font-medium text-slate-900 dark:text-white">#{{ $order->order_number }}</p>
                    <p class="text-xs text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            @empty
            <p class="text-slate-500 text-center py-4">Belum ada transaksi</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
