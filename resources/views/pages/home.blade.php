@extends('layouts.app')

@section('title', 'BatasKota Coffee - Menu')

@section('content')
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
    <main class="flex-1 flex flex-col">
        <!-- Hero / Featured -->
        <section class="w-full px-4 md:px-10 lg:px-28 py-8">
            <div class="max-w-[1200px] mx-auto w-full bg-[#fcfaf8] dark:bg-[#2a2015] rounded-xl overflow-hidden shadow-sm border border-[#f3eee7] dark:border-[#3a2e22]">
                <div class="flex flex-col md:flex-row gap-6 p-6 md:p-10 items-center">
                    <div class="flex-1 flex flex-col gap-6 md:pr-8 text-center md:text-left">
                        <div class="flex flex-col gap-3">
                            <span class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider w-fit mx-auto md:mx-0">
                                Rekomendasi Favorit
                            </span>
                            <h1 class="text-[#1b160d] dark:text-white text-3xl md:text-5xl font-black leading-tight tracking-[-0.033em]">
                                Mulai harimu dengan menu signature BatasKotaCoffee
                            </h1>
                            <h2 class="text-[#6b5840] dark:text-[#a08b70] text-base md:text-lg font-normal leading-relaxed">
                                Nikmati Palm Sugar Latte signature BatasKotaCoffee, dibuat dari bahan sederhana, dengan rasa yang pas, dan harga ramah di kantong.
                            </h2>
                        </div>
                        <div class="flex gap-4 justify-center md:justify-start">
                            <a href="{{ route('menu') }}" class="flex items-center justify-center rounded-lg h-12 px-8 bg-primary text-white text-base font-bold shadow-lg shadow-primary/30 hover:shadow-primary/50 hover:-translate-y-0.5 transition-all">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                    <div class="flex-1 w-full max-w-[500px]">
                        <div class="w-full aspect-[4/3] bg-center bg-no-repeat bg-cover rounded-xl shadow-md transform hover:scale-[1.02] transition-transform duration-500" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBTx9wpn8h3w-92c2uwqvBx8igNJwa7aujYBCE8I7559k0-ncNavnc02buf-7rZnSQfTJQvEMn_X3ci6skamvBwiW4qJ6zgYbVMMf8NtrBGHbQHtEGAgvJJjS8wtIthikYn7tcRT-fwankeN4W3iQ9PUtDI6-5cXDUsHSdhQmHfslCCyUDMJvmi7d5Vk0chYTUcK6ihVQ_vL_NWPL_EVeI9XaJearRPFdkUkRZQJT2m4qDAM7sCZ_Q2YmwOs6_vbXtSQIpBtp4LVaI');"></div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Main Product Grid -->
        <section class="flex-1 px-4 md:px-10 lg:px-28 py-8 bg-[#fcfaf8] dark:bg-[#1e170e]">
            <div class="max-w-[1200px] mx-auto">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-bold text-[#1b160d] dark:text-white">Menu BatasKotaCoffee</h3>
                    <div class="text-sm text-[#083672] dark:text-[#be9b6b]">
                        Menampilkan {{ $featuredProducts->count() ?? 0 }} produk
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($featuredProducts ?? [] as $product)
                    <div class="group bg-white dark:bg-[#2a2015] rounded-xl overflow-hidden border border-[#f3eee7] dark:border-[#3a2e22] hover:border-primary/50 hover:shadow-lg dark:hover:shadow-black/40 transition-all duration-300 flex flex-col">
                        <div class="relative w-full aspect-square overflow-hidden bg-gray-100 dark:bg-gray-800">
                            @if($product->image)
                            <div class="w-full h-full bg-center bg-no-repeat bg-cover transform group-hover:scale-110 transition-transform duration-500" style="background-image: url('{{ asset('storage/' . $product->image) }}');"></div>
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30">
                                <span class="material-symbols-outlined text-6xl text-amber-400 dark:text-amber-600">coffee</span>
                            </div>
                            @endif
                        </div>
                        <div class="p-4 flex flex-col flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-[#1b160d] dark:text-white text-lg font-bold leading-tight">{{ $product->name }}</h4>
                                <span class="text-primary font-bold text-sm">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-[#6b5840] dark:text-[#a08b70] text-sm leading-relaxed mb-4 flex-1 line-clamp-2">
                                {{ $product->description }}
                            </p>
                            <a href="{{ route('product.show', $product) }}" class="w-full py-2.5 rounded-lg bg-[#f3eee7] dark:bg-[#3a2e22] text-[#1b160d] dark:text-white font-semibold text-sm hover:bg-primary hover:text-white transition-colors text-center">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Belum ada produk tersedia</p>
                    </div>
                    @endforelse
                </div>
                
                <div class="flex justify-center mt-12">
                    <a href="{{ route('menu') }}" class="flex items-center gap-2 text-[#083672] dark:text-[#be9b6b] hover:text-primary dark:hover:text-primary transition-colors font-semibold">
                        <span>Lihat Semua Menu</span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- About / Company Info Section -->
        @if($company)
        <section class="px-4 md:px-10 lg:px-28 py-12 bg-white dark:bg-[#2a2015]">
            <div class="max-w-[1200px] mx-auto">
                <div class="text-center mb-10">
                    <span class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider mb-3">
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1b160d] dark:text-white">{{ $company->name ?? 'BatasKotaCoffee' }}</h2>
                    @if($company->description)
                    <p class="text-[#6b5840] dark:text-[#a08b70] text-lg mt-4 max-w-2xl mx-auto">{{ $company->description }}</p>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                    <!-- Lokasi -->
                    @if($company->address)
                    <div class="bg-[#fcfaf8] dark:bg-[#1e170e] rounded-xl p-6 border border-[#f3eee7] dark:border-[#3a2e22]">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
                        </div>
                        <h3 class="text-lg font-bold text-[#1b160d] dark:text-white mb-2">Lokasi</h3>
                        <p class="text-[#6b5840] dark:text-[#a08b70] text-sm">{{ $company->address }}</p>
                    </div>
                    @endif

                    <!-- Jam Operasional dengan Status -->
                    @if($company->open_time && $company->close_time)
                    @php
                        $now = \Carbon\Carbon::now();
                        $openTime = \Carbon\Carbon::createFromFormat('H:i', $company->open_time->format('H:i'));
                        $closeTime = \Carbon\Carbon::createFromFormat('H:i', $company->close_time->format('H:i'));
                        $currentTime = \Carbon\Carbon::createFromFormat('H:i', $now->format('H:i'));
                        
                        // Check if current time is within operating hours
                        $withinOperatingHours = $currentTime->between($openTime, $closeTime);
                        
                        // Store is open if: manually set to open AND within operating hours
                        $isOpen = $company->is_open && $withinOperatingHours;
                    @endphp
                    <div class="bg-[#fcfaf8] dark:bg-[#1e170e] rounded-xl p-6 border border-[#f3eee7] dark:border-[#3a2e22]">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-2xl">schedule</span>
                            </div>
                            <!-- Status Badge -->
                            @if(!$company->is_open)
                                {{-- Manually closed by admin --}}
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Tutup Sementara
                                </span>
                            @elseif($isOpen)
                                {{-- Open and within operating hours --}}
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                    </span>
                                    Buka
                                </span>
                            @else
                                {{-- Open but outside operating hours --}}
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    Di Luar Jam Operasional
                                </span>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-[#1b160d] dark:text-white mb-2">Jam Operasional</h3>
                        <p class="text-[#6b5840] dark:text-[#a08b70] text-sm">
                            Setiap Hari<br>
                            <span class="font-semibold text-[#1b160d] dark:text-white">{{ $openTime->format('H:i') }} - {{ $closeTime->format('H:i') }} WIB</span>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif
    </main>
</div>
@endsection
