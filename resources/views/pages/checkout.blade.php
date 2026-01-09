@extends('layouts.app')

@section('title', 'Checkout - BatasKota Coffee')

@section('content')
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
    <main class="layout-container flex h-full grow flex-col py-8 px-4 md:px-10 lg:px-40">
        <div class="layout-content-container mx-auto flex w-full max-w-[1200px] flex-col flex-1">
            <!-- Page Heading & Stepper -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
                <div class="flex flex-col gap-1">
                    <h1 class="text-3xl font-bold leading-tight text-[#1b160d] dark:text-white">Checkout</h1>
                    <p class="text-[#083672] dark:text-[#be9b6b] text-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">lock</span>
                        Koneksi aman
                    </p>
                </div>
                <!-- Stepper -->
                <div class="flex items-center gap-2 md:gap-4 self-center md:self-auto">
                    <a href="{{ route('cart') }}" class="flex items-center gap-2 group">
                        <div class="flex size-8 items-center justify-center rounded-full bg-primary/20 text-primary font-bold text-sm">1</div>
                        <span class="text-sm font-medium hidden sm:block text-[#083672] dark:text-[#be9b6b] group-hover:text-primary">Keranjang</span>
                    </a>
                    <div class="h-[1px] w-4 md:w-8 bg-[#f3eee7] dark:bg-[#3e3428]"></div>
                    <div class="flex items-center gap-2">
                        <div class="flex size-8 items-center justify-center rounded-full bg-primary text-white font-bold text-sm shadow-md shadow-primary/30">2</div>
                        <span class="text-sm font-bold text-[#1b160d] dark:text-white">Pembayaran</span>
                    </div>
                    <div class="h-[1px] w-4 md:w-8 bg-[#f3eee7] dark:bg-[#3e3428]"></div>
                    <div class="flex items-center gap-2 opacity-50">
                        <div class="flex size-8 items-center justify-center rounded-full border border-[#f3eee7] dark:border-[#3e3428] text-[#083672] dark:text-[#be9b6b] font-medium text-sm">3</div>
                        <span class="text-sm font-medium hidden sm:block">Selesai</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    <!-- Left Column: Forms -->
                    <div class="lg:col-span-2 flex flex-col gap-6">
                        <!-- Customer Info -->
                        <section class="rounded-xl bg-white dark:bg-[#2c2217] p-6 shadow-sm border border-[#f3eee7] dark:border-[#3e3428]">
                            <h3 class="text-xl font-bold mb-4 text-[#1b160d] dark:text-white">Informasi Pemesan</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-sm font-medium text-[#083672] dark:text-[#be9b6b]">Nama</label>
                                        <input type="text" name="name" value="{{ auth()->user()->username }}" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary dark:text-white" required />
                                    </div>
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-sm font-medium text-[#083672] dark:text-[#be9b6b]">Nomor HP</label>
                                        <input type="tel" name="phone" value="{{ auth()->user()->phone }}" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary dark:text-white" required />
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <label class="text-sm font-medium text-[#083672] dark:text-[#be9b6b]">Catatan (Opsional)</label>
                                    <input type="text" name="notes" placeholder="Contoh: Es nya dikit aja ya" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-sm focus:border-primary focus:ring-1 focus:ring-primary dark:text-white" />
                                </div>
                            </div>
                        </section>

                        <!-- Payment Method -->
                        <section class="rounded-xl bg-white dark:bg-[#2c2217] p-6 shadow-sm border border-[#f3eee7] dark:border-[#3e3428]">
                            <h3 class="text-xl font-bold mb-4 text-[#1b160d] dark:text-white">Metode Pembayaran</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <!-- QRIS -->
                                <label class="cursor-pointer relative group">
                                    <input checked type="radio" name="payment_method" value="qris" class="peer sr-only" />
                                    <div class="flex flex-col items-center justify-center gap-2 p-4 rounded-lg border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#221a10] hover:border-primary/50 transition-all peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-1 peer-checked:ring-primary h-full">
                                        <span class="material-symbols-outlined text-2xl text-gray-600 dark:text-gray-300">qr_code_scanner</span>
                                        <span class="font-medium text-sm text-[#1b160d] dark:text-white">QRIS</span>
                                    </div>
                                </label>
                            </div>
                        </section>
                    </div>

                    <!-- Right Column: Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="sticky top-24 space-y-4">
                            <div class="rounded-xl bg-white dark:bg-[#2c2217] p-6 shadow-sm border border-[#f3eee7] dark:border-[#3e3428]">
                                <div class="flex justify-between items-center mb-4 pb-4 border-b border-[#f3eee7] dark:border-[#3e3428]">
                                    <h3 class="font-bold text-lg text-[#1b160d] dark:text-white">Ringkasan Pesanan</h3>
                                    <a href="{{ route('cart') }}" class="text-xs font-medium text-primary hover:text-primary/80">Edit</a>
                                </div>

                                <!-- Items List -->
                                <div class="flex flex-col gap-3 mb-6 max-h-[300px] overflow-y-auto">
                                    @foreach($cart->items as $item)
                                    <div class="flex gap-3">
                                        <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800">
                                            @if($item->product->image)
                                            <img alt="{{ $item->product->name }}" class="h-full w-full object-cover" src="{{ asset('storage/' . $item->product->image) }}" />
                                            @else
                                            <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30">
                                                <span class="material-symbols-outlined text-xl text-amber-400">coffee</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-1 flex-col justify-between min-w-0">
                                            <div>
                                                <p class="font-semibold text-sm line-clamp-1 text-[#1b160d] dark:text-white">{{ $item->product->name }}</p>
                                                @if($item->variant_text)
                                                <p class="text-xs text-[#083672] dark:text-[#be9b6b]">{{ $item->variant_text }}</p>
                                                @endif
                                            </div>
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-[#083672] dark:text-[#be9b6b]">x{{ $item->quantity }}</span>
                                                <span class="font-medium text-[#1b160d] dark:text-white">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Cost Breakdown -->
                                <div class="space-y-2 mb-6 text-sm border-t border-[#f3eee7] dark:border-[#3e3428] pt-4">
                                    <div class="flex justify-between text-[#083672] dark:text-[#be9b6b]">
                                        <span>Subtotal ({{ $cart->items->sum('quantity') }} item)</span>
                                        <span>Rp{{ number_format($cart->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="h-[1px] bg-[#f3eee7] dark:bg-[#3e3428] my-2"></div>
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-[#1b160d] dark:text-white">Total</span>
                                        <span class="text-primary">Rp{{ number_format($cart->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                @if($storeOpen)
                                <button type="submit" class="w-full rounded-lg bg-primary py-3 px-4 text-white font-bold hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                                    <span>Bayar Sekarang</span>
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </button>
                                @else
                                <div class="text-center">
                                    <button type="button" disabled class="w-full rounded-lg bg-gray-400 py-3 px-4 text-white font-bold cursor-not-allowed flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-sm">lock</span>
                                        <span>Toko Sedang Tutup</span>
                                    </button>
                                    <p class="text-xs text-red-500 mt-2">Maaf, pesanan tidak dapat diproses saat toko tutup.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
