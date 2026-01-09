@extends('layouts.admin')

@section('title', 'Manajemen Pesanan - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-7xl mx-auto w-full">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen Pesanan</h2>
            <p class="text-slate-500 dark:text-slate-400">Kelola pesanan masuk</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Auto-refresh aktif</span>
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="flex flex-col gap-1 p-5 rounded-xl bg-white dark:bg-[#1a140c] border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pesanan Baru</p>
                <span class="material-symbols-outlined text-primary">shopping_bag</span>
            </div>
            <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $orders->whereIn('status', ['pending', 'paid'])->count() }}</span>
        </div>
        <div class="flex flex-col gap-1 p-5 rounded-xl bg-white dark:bg-[#1a140c] border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Diproses</p>
                <span class="material-symbols-outlined text-blue-600">coffee_maker</span>
            </div>
            <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $orders->where('status', 'process')->count() }}</span>
        </div>
        <div class="flex flex-col gap-1 p-5 rounded-xl bg-white dark:bg-[#1a140c] border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Siap Diambil</p>
                <span class="material-symbols-outlined text-green-600">check_circle</span>
            </div>
            <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $orders->where('status', 'ready')->count() }}</span>
        </div>
        <div class="flex flex-col gap-1 p-5 rounded-xl bg-white dark:bg-[#1a140c] border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex justify-between items-start">
                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Selesai Hari Ini</p>
                <span class="material-symbols-outlined text-gray-600">done_all</span>
            </div>
            <span class="text-3xl font-bold text-slate-900 dark:text-white">{{ $orders->where('status', 'done')->count() }}</span>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Item</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-bold text-primary">#{{ $order->order_number }}</span>
                            <div class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ $order->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-900 dark:text-white">{{ $order->customer_name ?? $order->user->username }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-500">{{ $order->customer_phone ?? $order->user->phone }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-300">
                            {{ $order->items->count() }} item
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300 border-yellow-200 dark:border-yellow-800',
                                    'paid' => 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300 border-green-200 dark:border-green-800',
                                    'process' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 border-blue-200 dark:border-blue-800',
                                    'ready' => 'bg-primary text-white border-primary',
                                    'done' => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 border-gray-200 dark:border-gray-700',
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu Bayar',
                                    'paid' => 'Dibayar',
                                    'process' => 'Diproses',
                                    'ready' => 'Siap Diambil',
                                    'done' => 'Selesai',
                                ];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $statusColors[$order->status] ?? '' }}">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}" class="p-1.5 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">
                            Belum ada pesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
