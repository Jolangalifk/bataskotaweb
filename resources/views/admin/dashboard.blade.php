@extends('layouts.admin')

@section('title', 'Dashboard - Admin BatasKota')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-[#2a2015] rounded-xl p-6 border border-[#f3eee7] dark:border-[#3a2e22]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pendapatan Bulan Ini</p>
                    <p class="text-2xl font-bold text-[#1b160d] dark:text-white">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-600">trending_up</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-[#2a2015] rounded-xl p-6 border border-[#f3eee7] dark:border-[#3a2e22]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pengeluaran Bulan Ini</p>
                    <p class="text-2xl font-bold text-[#1b160d] dark:text-white">Rp {{ number_format($totalExpense ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-red-600">trending_down</span>
                </div>
            </div>
        </div>
        
        <!-- <div class="bg-white dark:bg-[#2a2015] rounded-xl p-6 border border-[#f3eee7] dark:border-[#3a2e22]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Laba/Rugi</p>
                    <p class="text-2xl font-bold {{ ($profit ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">Rp {{ number_format($profit ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600">account_balance</span>
                </div>
            </div>
        </div> -->
        
        <div class="bg-white dark:bg-[#2a2015] rounded-xl p-6 border border-[#f3eee7] dark:border-[#3a2e22]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pesanan Hari Ini</p>
                    <p class="text-2xl font-bold text-[#1b160d] dark:text-white">{{ $todayOrders ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600">shopping_cart</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pesanan Terbaru -->
        <div class="bg-white dark:bg-[#2a2015] rounded-xl border border-[#f3eee7] dark:border-[#3a2e22]">
            <div class="p-6 border-b border-[#f3eee7] dark:border-[#3a2e22]">
                <h3 class="text-lg font-bold text-[#1b160d] dark:text-white">Pesanan Terbaru</h3>
            </div>
            <div class="p-6">
                @if(isset($recentOrders) && $recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-[#1e170e] rounded-lg">
                        <div>
                            <p class="font-medium text-[#1b160d] dark:text-white">{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-500">{{ $order->user->username ?? 'Guest' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            <span class="text-xs px-2 py-1 rounded-full 
                                @if($order->status == 'done') bg-green-100 text-green-600
                                @elseif($order->status == 'pending') bg-yellow-100 text-yellow-600
                                @elseif($order->status == 'process') bg-blue-100 text-blue-600
                                @else bg-gray-100 text-gray-600 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 text-center py-8">Belum ada pesanan</p>
                @endif
            </div>
        </div>
        
        <!-- Produk Terlaris -->
        <div class="bg-white dark:bg-[#2a2015] rounded-xl border border-[#f3eee7] dark:border-[#3a2e22]">
            <div class="p-6 border-b border-[#f3eee7] dark:border-[#3a2e22]">
                <h3 class="text-lg font-bold text-[#1b160d] dark:text-white">Produk Terlaris</h3>
            </div>
            <div class="p-6">
                @if(isset($topProducts) && $topProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($topProducts as $item)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-[#1e170e] rounded-lg">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">coffee</span>
                            </div>
                            <div>
                                <p class="font-medium text-[#1b160d] dark:text-white">{{ $item->product->name ?? 'Unknown' }}</p>
                                <p class="text-sm text-gray-500">Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-[#1b160d] dark:text-white">{{ $item->total_sold }} terjual</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 text-center py-8">Belum ada data penjualan</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
