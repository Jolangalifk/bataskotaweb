@extends('layouts.app')

@section('title', 'Keranjang - BatasKota Coffee')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 md:px-10 lg:px-28">
    <!-- Page Heading -->
    <div class="mb-8">
        <h1 class="text-3xl font-black tracking-tight text-[#1b160d] dark:text-white sm:text-4xl">
            Keranjang Anda ({{ $cart ? $cart->items->sum('quantity') : 0 }} item)
        </h1>
    </div>

    @if($cart && $cart->items->count() > 0)
    <div class="flex flex-col gap-10 lg:flex-row">
        <!-- Left Column: Cart Items -->
        <div class="flex-1 flex flex-col gap-4">
            @foreach($cart->items as $item)
            <div class="group relative flex flex-col gap-4 rounded-xl border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] p-4 shadow-sm transition-shadow hover:shadow-md sm:flex-row sm:items-start">
                <div class="aspect-square h-20 w-20 shrink-0 overflow-hidden rounded-lg sm:h-24 sm:w-24 bg-gray-100 dark:bg-gray-800">
                    @if($item->product->image)
                    <img alt="{{ $item->product->name }}" class="h-full w-full object-cover" src="{{ asset('storage/' . $item->product->image) }}" />
                    @else
                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30">
                        <span class="material-symbols-outlined text-3xl text-amber-400 dark:text-amber-600">coffee</span>
                    </div>
                    @endif
                </div>
                <div class="flex flex-1 flex-col justify-between gap-3 h-full">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-base font-bold text-[#1b160d] dark:text-white">{{ $item->product->name }}</h3>
                                @if($item->variant_text)
                                <p class="text-sm text-[#083672] dark:text-[#be9b6b] mt-0.5">{{ $item->variant_text }}</p>
                                @endif
                                @if($item->notes)
                                <p class="text-xs text-gray-500 mt-1 italic">"{{ $item->notes }}"</p>
                                @endif
                            </div>
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1">
                                    <span class="material-symbols-outlined text-xl">close</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center rounded-lg border border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-0.5">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-md text-[#1b160d] dark:text-white hover:bg-white dark:hover:bg-[#2c2217] transition-colors" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                    <span class="material-symbols-outlined text-sm">remove</span>
                                </button>
                            </form>
                            <span class="w-10 text-center text-sm font-semibold text-[#1b160d] dark:text-white">{{ $item->quantity }}</span>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-md bg-white dark:bg-[#2c2217] text-primary shadow-sm hover:text-primary/80 transition-colors">
                                    <span class="material-symbols-outlined text-sm">add</span>
                                </button>
                            </form>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-primary">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            <!-- @if($item->extra_price > 0) -->
                            <!-- <p class="text-xs text-gray-500">@ Rp{{ number_format($item->unit_price, 0, ',', '.') }}</p>
                            @endif -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Right Column: Summary Panel -->
        <div class="lg:w-[380px] shrink-0">
            <div class="sticky top-24 rounded-xl border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] p-6 shadow-sm">
                <h2 class="text-xl font-bold text-[#1b160d] dark:text-white mb-6">Ringkasan Pesanan</h2>
                
                @php
                    $subtotal = $cart->total;
                    $tax = 0; // No tax for now
                    $total = $subtotal + $tax;
                @endphp

                <div class="flex flex-col gap-3 border-b border-[#f3eee7] dark:border-[#3e3428] pb-4 mb-4">
                    @foreach($cart->items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-[#083672] dark:text-[#be9b6b]">{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span class="font-medium text-[#1b160d] dark:text-white">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>

                <div class="flex justify-between items-end mb-6">
                    <span class="text-lg font-medium text-[#1b160d] dark:text-white">Total</span>
                    <span class="text-2xl font-black tracking-tight text-primary">Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout') }}" class="w-full rounded-lg bg-primary py-3 text-center text-base font-bold text-white shadow-md transition-all hover:bg-primary/90 hover:shadow-lg active:scale-[0.98] block">
                    Checkout Sekarang
                </a>
                
                <a href="{{ route('menu') }}" class="w-full mt-3 rounded-lg border border-[#f3eee7] dark:border-[#3e3428] py-3 text-center text-sm font-medium text-[#1b160d] dark:text-white hover:bg-[#f8f7f6] dark:hover:bg-[#221a10] transition-colors block">
                    Tambah Menu Lain
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-16">
        <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">shopping_cart</span>
        <h2 class="text-xl font-bold text-gray-600 dark:text-gray-400 mb-2">Keranjang Kosong</h2>
        <p class="text-gray-500 mb-6">Belum ada produk di keranjang Anda</p>
        <a href="{{ route('menu') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-bold hover:bg-primary/90 transition-colors">
            Lihat Menu
        </a>
    </div>
    @endif
</div>
@endsection
