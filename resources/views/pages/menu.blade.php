@extends('layouts.app')

@section('title', 'Menu - BatasKota Coffee')

@section('content')
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-10 lg:px-28 py-8 md:py-12">
    <!-- Page Heading -->
    <div class="mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 text-[#1b160d] dark:text-white">Menu Kami</h1>
        <p class="text-[#083672] dark:text-[#be9b6b] text-lg">Pilih minuman dan makanan favorit Anda</p>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('menu') }}" class="flex flex-col md:flex-row gap-4 mb-10">
        <div class="flex-1 relative">
            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-[#083672] dark:text-[#be9b6b]">search</span>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari menu..." class="w-full pl-12 pr-4 py-3 rounded-lg border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] text-[#1b160d] dark:text-white focus:ring-2 focus:ring-primary/50 focus:border-primary" />
        </div>
        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-sm">search</span>
            <span>Cari</span>
        </button>
        @if($search)
        <a href="{{ route('menu') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
            <span class="material-symbols-outlined text-sm">close</span>
            <span>Reset</span>
        </a>
        @endif
    </form>

    @php
        $categoryLabels = [
            'coffee' => ['title' => 'Coffee', 'icon' => 'coffee', 'desc' => 'Berbagai pilihan kopi berkualitas'],
            'non-coffee' => ['title' => 'Non-Coffee', 'icon' => 'local_cafe', 'desc' => 'Minuman segar tanpa kopi'],
            'toast' => ['title' => 'Toast', 'icon' => 'bakery_dining', 'desc' => 'Roti panggang dengan berbagai topping'],
        ];
        $hasProducts = collect($productsByCategory)->flatten()->count() > 0;
    @endphp

    @if($hasProducts)
        @foreach($productsByCategory as $category => $products)
            @if($products->count() > 0)
            <!-- {{ $categoryLabels[$category]['title'] }} Section -->
            <section class="mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">{{ $categoryLabels[$category]['icon'] }}</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-[#1b160d] dark:text-white">{{ $categoryLabels[$category]['title'] }}</h2>
                        <p class="text-sm text-[#083672] dark:text-[#be9b6b]">{{ $categoryLabels[$category]['desc'] }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach($products as $product)
                    <a href="{{ route('product.show', $product) }}" class="group flex flex-col overflow-hidden rounded-xl border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] transition-all hover:shadow-lg">
                        <div class="aspect-square w-full overflow-hidden bg-gray-100 dark:bg-gray-800">
                            @if($product->image)
                            <img alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" src="{{ asset('storage/' . $product->image) }}" />
                            @else
                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30">
                                <span class="material-symbols-outlined text-5xl text-amber-400 dark:text-amber-600">{{ $categoryLabels[$category]['icon'] }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col p-4">
                            <h3 class="font-bold text-[#1b160d] dark:text-white line-clamp-1">{{ $product->name }}</h3>
                            <p class="text-xs text-[#083672] dark:text-[#be9b6b] mt-1 line-clamp-2">{{ $product->description ?? 'Produk berkualitas' }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-lg font-bold text-primary">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-sm">add</span>
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif
        @endforeach
    @else
        <div class="text-center py-16">
            <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">{{ $search ? 'search_off' : 'coffee' }}</span>
            <h2 class="text-xl font-bold text-gray-600 dark:text-gray-400 mb-2">{{ $search ? 'Tidak Ada Hasil' : 'Belum Ada Menu' }}</h2>
            <p class="text-gray-500 dark:text-gray-500">{{ $search ? 'Coba kata kunci lain atau reset pencarian' : 'Menu akan segera tersedia' }}</p>
            @if($search)
            <a href="{{ route('menu') }}" class="mt-4 inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined text-sm">refresh</span>
                <span>Lihat Semua Menu</span>
            </a>
            @endif
        </div>
    @endif
</div>
@endsection
