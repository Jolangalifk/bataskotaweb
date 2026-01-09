@extends('layouts.app')

@section('title', 'Pembayaran - BatasKota Coffee')

@section('content')
<div class="max-w-[600px] mx-auto px-4 sm:px-6 md:px-10 py-8 md:py-12">
    <!-- Page Heading -->
    <div class="mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 text-[#1b160d] dark:text-white">Pembayaran</h1>
        <p class="text-[#083672] dark:text-[#be9b6b] text-lg">Selesaikan pembayaran untuk pesanan Anda</p>
    </div>

    <div class="rounded-xl border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] p-6 md:p-8 shadow-sm">
        <!-- Order Info -->
        <div class="text-center mb-8">
            <p class="text-sm text-[#083672] dark:text-[#be9b6b]">Order ID</p>
            <p class="text-2xl font-bold text-[#1b160d] dark:text-white">#{{ $order->order_number }}</p>
        </div>

        <!-- Amount -->
        <div class="text-center mb-8 p-6 bg-[#f8f7f6] dark:bg-[#221a10] rounded-xl">
            <p class="text-sm text-[#083672] dark:text-[#be9b6b] mb-2">Total Pembayaran</p>
            <p class="text-4xl font-black text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        <!-- QRIS Section -->
        <div class="text-center mb-8">
            <h3 class="text-lg font-bold text-[#1b160d] dark:text-white mb-4">Scan QRIS untuk Membayar</h3>
            <div class="inline-block p-4 bg-white rounded-xl shadow-sm">
                <!-- Placeholder QRIS -->
                <div class="w-48 h-48 bg-gray-100 flex items-center justify-center rounded-lg">
                    <span class="material-symbols-outlined text-6xl text-gray-400">qr_code_2</span>
                </div>
            </div>
            <p class="text-sm text-[#083672] dark:text-[#be9b6b] mt-4">
                Gunakan aplikasi e-wallet atau mobile banking untuk scan
            </p>
        </div>

        <!-- Payment Status -->
        <div class="border-t border-[#f3eee7] dark:border-[#3e3428] pt-6">
            <div class="flex items-center justify-center gap-2 text-[#083672] dark:text-[#be9b6b]">
                <span class="material-symbols-outlined animate-spin">sync</span>
                <span>Menunggu pembayaran...</span>
            </div>
        </div>

        <!-- Demo Button (for testing) -->
        <form action="{{ route('payment.process', $order) }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                <span class="flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>Simulasi Pembayaran Berhasil (Demo)</span>
                </span>
            </button>
        </form>

        <!-- Back Link -->
        <div class="mt-6 text-center">
            <a href="{{ route('orders') }}" class="text-primary hover:text-primary/80 font-medium">
                ← Kembali ke Pesanan Saya
            </a>
        </div>
    </div>
</div>
@endsection
