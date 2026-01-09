@extends('layouts.app')

@section('title', 'Status Pesanan - BatasKota Coffee')

@section('content')
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-10 lg:px-28 py-8 md:py-12">
    <!-- Hero / Page Heading -->
    <div class="mb-10 text-center md:text-left">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 text-[#1b160d] dark:text-white">
                    Status Pesanan #{{ $order->order_number }}
                </h1>
                <p class="text-[#083672] dark:text-[#be9b6b] text-lg">
                    Pantau pesanan Anda secara real-time
                </p>
            </div>
            <div class="flex items-center gap-2 text-sm text-[#083672] dark:text-[#be9b6b] bg-[#e6e0d6]/30 dark:bg-[#3a2e20]/30 px-3 py-1.5 rounded-full self-center md:self-end">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                </span>
                Live Updates
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        <!-- Order Status Timeline -->
        <section class="flex flex-col rounded-2xl bg-white dark:bg-[#2c2217] shadow-sm ring-1 ring-gray-900/5 dark:ring-white/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-[#2c2217]">
                <h3 class="text-lg font-bold text-[#1b160d] dark:text-white">Status Pesanan</h3>
            </div>
            <div class="p-6">
                <div class="flex flex-col gap-6">
                    @php
                        $statuses = [
                            'pending' => ['icon' => 'pending', 'label' => 'Menunggu Pembayaran', 'color' => 'yellow'],
                            'paid' => ['icon' => 'check_circle', 'label' => 'Pembayaran Berhasil', 'color' => 'green'],
                            'process' => ['icon' => 'coffee_maker', 'label' => 'Sedang Diproses', 'color' => 'blue'],
                            'ready' => ['icon' => 'shopping_bag', 'label' => 'Siap Diambil', 'color' => 'primary'],
                            'done' => ['icon' => 'done_all', 'label' => 'Selesai', 'color' => 'gray'],
                        ];
                        $currentStatus = $order->status;
                        $statusOrder = array_keys($statuses);
                        $currentIndex = array_search($currentStatus, $statusOrder);
                    @endphp

                    @foreach($statuses as $key => $status)
                    @php
                        $index = array_search($key, $statusOrder);
                        $isActive = $index <= $currentIndex;
                        $isCurrent = $key === $currentStatus;
                    @endphp
                    <div class="flex items-center gap-4 {{ $isActive ? '' : 'opacity-40' }}">
                        <div class="size-12 rounded-lg flex items-center justify-center {{ $isCurrent ? 'bg-primary text-white' : ($isActive ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400' : 'bg-gray-100 dark:bg-gray-800 text-gray-400') }}">
                            <span class="material-symbols-outlined text-[24px]">{{ $status['icon'] }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-[#1b160d] dark:text-white">{{ $status['label'] }}</p>
                            @if($isCurrent)
                            <p class="text-sm text-[#083672] dark:text-[#be9b6b]">Status saat ini</p>
                            @endif
                        </div>
                        @if($isActive)
                        <span class="material-symbols-outlined text-green-500">check</span>
                        @endif
                    </div>
                    @if(!$loop->last)
                    <div class="ml-6 h-6 w-[2px] {{ $isActive && $index < $currentIndex ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-700' }}"></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Order Details -->
        <section class="flex flex-col rounded-2xl bg-white dark:bg-[#2c2217] shadow-sm ring-1 ring-gray-900/5 dark:ring-white/5 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-white/5 bg-gray-50/50 dark:bg-[#2c2217]">
                <h3 class="text-lg font-bold text-[#1b160d] dark:text-white">Detail Pesanan</h3>
            </div>
            <div class="p-6 space-y-4">
                @foreach($order->items as $item)
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <div class="bg-[#f8f7f6] dark:bg-[#221a10] rounded p-1 h-fit">
                            <span class="font-bold text-primary">{{ $item->quantity }}x</span>
                        </div>
                        <div>
                            <p class="font-medium text-[#1b160d] dark:text-white">{{ $item->product_name }}</p>
                            @if($item->variant_text)
                            <p class="text-xs text-[#083672] dark:text-[#be9b6b]">{{ $item->variant_text }}</p>
                            @endif
                            @if($item->notes)
                            <p class="text-xs text-gray-500 italic">"{{ $item->notes }}"</p>
                            @endif
                        </div>
                    </div>
                    <span class="font-medium text-[#1b160d] dark:text-white">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach

                <div class="my-4 border-t border-dashed border-[#f3eee7] dark:border-[#3e3428]"></div>

                <div class="flex justify-between items-center p-3 bg-[#f8f7f6] dark:bg-[#221a10] rounded-lg">
                    <span class="font-bold text-[#1b160d] dark:text-white">Total</span>
                    <span class="text-xl font-black text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
