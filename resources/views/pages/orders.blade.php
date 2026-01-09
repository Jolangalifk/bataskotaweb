@extends('layouts.app')

@section('title', 'Pesanan Saya - BatasKota Coffee')

@section('content')
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-10 lg:px-28 py-8 md:py-12">
    <!-- Page Heading -->
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 text-[#1b160d] dark:text-white">Pesanan Saya</h1>
        <p class="text-[#083672] dark:text-[#be9b6b] text-lg">Riwayat dan status pesanan Anda</p>
    </div>

    @if($orders->count() > 0)
    <div class="space-y-4">
        @foreach($orders as $order)
        <a href="{{ route('order.status', $order) }}" class="block rounded-xl border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] p-6 shadow-sm hover:shadow-md transition-all">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">receipt_long</span>
                    </div>
                    <div>
                        <p class="font-bold text-[#1b160d] dark:text-white">#{{ $order->order_number }}</p>
                        <p class="text-sm text-[#083672] dark:text-[#be9b6b]">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <p class="text-sm text-[#083672] dark:text-[#be9b6b]">{{ $order->items->count() }} item</p>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                            'paid' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                            'process' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                            'ready' => 'bg-primary/10 text-primary',
                            'done' => 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
                        ];
                        $statusLabels = [
                            'pending' => 'Menunggu Pembayaran',
                            'paid' => 'Dibayar',
                            'process' => 'Diproses',
                            'ready' => 'Siap Diambil',
                            'done' => 'Selesai',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $statusLabels[$order->status] ?? $order->status }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="mt-8">
        {{ $orders->links() }}
    </div>
    @endif
    @else
    <div class="text-center py-16">
        <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">receipt_long</span>
        <h2 class="text-xl font-bold text-gray-600 mb-2">Belum Ada Pesanan</h2>
        <p class="text-gray-500 mb-6">Anda belum memiliki riwayat pesanan</p>
        <a href="{{ route('menu') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-bold hover:bg-primary/90 transition-colors">
            Lihat Menu
        </a>
    </div>
    @endif
</div>
@endsection
