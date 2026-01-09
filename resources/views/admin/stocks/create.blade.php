@extends('layouts.admin')

@section('title', 'Tambah Bahan - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-3xl mx-auto w-full">
    <div class="mb-8">
        <a href="{{ route('admin.stocks.index') }}" class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Bahan Baku</h2>
    </div>

    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <form action="{{ route('admin.stocks.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Bahan</label>
                    <input type="text" name="material_name" value="{{ old('material_name') }}" placeholder="Contoh: Biji Kopi Arabica" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    @error('material_name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Jumlah</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                        @error('quantity')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Satuan</label>
                        <input type="text" name="unit" value="{{ old('unit') }}" placeholder="kg, liter, pcs" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                        @error('unit')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Harga Pembelian (Rp) <span class="text-slate-400 font-normal">- opsional</span></label>
                    <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" min="0" placeholder="0" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                    <p class="text-xs text-slate-500 mt-1">Jika diisi, akan otomatis tercatat sebagai pengeluaran</p>
                    @error('purchase_price')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
