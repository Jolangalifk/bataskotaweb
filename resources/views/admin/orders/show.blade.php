@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-4xl mx-auto w-full">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.orders.index') }}" class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Daftar Pesanan
        </a>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Pesanan #{{ $order->order_number }}</h2>
                <p class="text-slate-500 dark:text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-700',
                    'paid' => 'bg-green-100 text-green-700',
                    'process' => 'bg-blue-100 text-blue-700',
                    'ready' => 'bg-primary text-white',
                    'done' => 'bg-gray-100 text-gray-600',
                ];
                $statusLabels = [
                    'pending' => 'Menunggu Bayar',
                    'paid' => 'Dibayar',
                    'process' => 'Diproses',
                    'ready' => 'Siap Diambil',
                    'done' => 'Selesai',
                ];
            @endphp
            <span class="px-4 py-2 rounded-full text-sm font-bold {{ $statusColors[$order->status] ?? '' }}">
                {{ $statusLabels[$order->status] ?? $order->status }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Info -->
            <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Informasi Pelanggan</h3>
                <div class="flex items-center gap-4">
                    <div class="size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xl font-bold">
                        {{ strtoupper(substr($order->customer_name ?? $order->user->username, 0, 2)) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 dark:text-white">{{ $order->customer_name ?? $order->user->username }}</p>
                        <p class="text-sm text-slate-500">{{ $order->user->email }}</p>
                        <p class="text-sm text-slate-500">{{ $order->customer_phone ?? $order->user->phone }}</p>
                        @if($order->payment_method)
                        <p class="text-sm text-slate-500 mt-1">Pembayaran: {{ ucfirst($order->payment_method) }}</p>
                        @endif
                    </div>
                </div>
                @if($order->notes)
                <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                    <p class="text-sm text-slate-500">Catatan:</p>
                    <p class="text-sm text-slate-700 dark:text-slate-300">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Order Items -->
            <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Item Pesanan</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex gap-4">
                            <!-- Product Image -->
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-800 flex-shrink-0">
                                @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-slate-400">coffee</span>
                                </div>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-primary">{{ $item->quantity }}x</span>
                                    <p class="font-medium text-slate-900 dark:text-white">{{ $item->product_name }}</p>
                                </div>
                                @if($item->variant_text)
                                <p class="text-xs text-slate-500 mt-1">{{ $item->variant_text }}</p>
                                @endif
                                @if($item->notes)
                                <p class="text-xs text-slate-400 italic mt-1">Catatan: {{ $item->notes }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="font-medium text-slate-900 dark:text-white">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </span>
                            @if($item->extra_price > 0)
                            <p class="text-xs text-slate-500">@ Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-900 dark:text-white">Total</span>
                        <span class="text-xl font-black text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Status -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6 sticky top-24">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Update Status</h3>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-2">
                        @foreach(['pending' => 'Menunggu Bayar', 'paid' => 'Dibayar', 'process' => 'Diproses', 'ready' => 'Siap Diambil', 'done' => 'Selesai'] as $value => $label)
                        <label class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                            <input type="radio" name="status" value="{{ $value }}" {{ $order->status === $value ? 'checked' : '' }} class="text-primary focus:ring-primary" />
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
