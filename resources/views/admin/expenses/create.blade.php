@extends('layouts.admin')

@section('title', 'Tambah Pengeluaran - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-3xl mx-auto w-full">
    <div class="mb-8">
        <a href="{{ route('admin.expenses.index') }}" class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Pengeluaran</h2>
    </div>

    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <form action="{{ route('admin.expenses.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Category hidden - default to stock --}}
                <input type="hidden" name="category" value="stock" />
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tanggal</label>
                    <input type="date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    @error('expense_date')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Keterangan</label>
                    <input type="text" name="description" value="{{ old('description') }}" placeholder="Contoh: Beli biji kopi 5kg" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    @error('description')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Jumlah (Rp)</label>
                    <input type="number" name="amount" value="{{ old('amount') }}" min="0" placeholder="0" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    @error('amount')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
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
