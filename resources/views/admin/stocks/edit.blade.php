@extends('layouts.admin')

@section('title', 'Edit Stok - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-3xl mx-auto w-full">
    <div class="mb-8">
        <a href="{{ route('admin.stocks.index') }}" class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Update Stok: {{ $stock->material_name }}</h2>
    </div>

    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <form action="{{ route('admin.stocks.update', $stock) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Bahan</label>
                    <input type="text" name="material_name" value="{{ old('material_name', $stock->material_name) }}" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                </div>
                <div class="p-4 bg-slate-50 dark:bg-slate-800 rounded-lg">
                    <label class="block text-sm font-medium text-slate-500 dark:text-slate-400 mb-1">Stok Saat Ini</label>
                    <p class="text-3xl font-bold text-primary">{{ number_format($stock->quantity) }} <span class="text-lg text-slate-500">{{ $stock->unit }}</span></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Perubahan Stok</label>
                    <input type="number" name="change" value="0" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    <p class="text-xs text-slate-500 mt-1">Gunakan angka positif (+) untuk menambah, negatif (-) untuk mengurangi</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Keterangan</label>
                    <input type="text" name="description" placeholder="Contoh: Pembelian bahan, Pemakaian harian" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Harga Pembelian (Rp) <span class="text-slate-400 font-normal">- opsional, hanya untuk penambahan stok</span></label>
                    <input type="number" name="purchase_price" value="" min="0" placeholder="0" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                    <p class="text-xs text-slate-500 mt-1">Jika diisi saat menambah stok, akan otomatis tercatat sebagai pengeluaran</p>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                        Update Stok
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Recent History -->
    @if($stock->histories->count() > 0)
    <div class="mt-6 bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Riwayat Perubahan Terakhir</h3>
        <div class="space-y-3">
            @foreach($stock->histories()->latest()->limit(5)->get() as $history)
            <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                <div>
                    <p class="text-sm text-slate-500">{{ $history->created_at->format('d M Y, H:i') }}</p>
                    <p class="text-sm text-slate-700 dark:text-slate-300">{{ $history->description ?? '-' }}</p>
                </div>
                <span class="font-bold {{ $history->change > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $history->change > 0 ? '+' : '' }}{{ $history->change }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
