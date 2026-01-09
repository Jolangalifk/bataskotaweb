@extends('layouts.admin')

@section('title', 'Manajemen Pengeluaran - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-7xl mx-auto w-full">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen Pengeluaran</h2>
            <p class="text-slate-500 dark:text-slate-400">Catat dan kelola pengeluaran usaha</p>
        </div>
        <a href="{{ route('admin.expenses.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Pengeluaran
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">{{ session('success') }}</div>
    @endif

    <!-- Summary Card -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-slate-500 text-sm mb-1">Total Pengeluaran Bulan Ini</p>
                <p class="text-3xl font-bold text-red-600">Rp {{ number_format($totalThisMonth ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-red-600">trending_down</span>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Keterangan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase">Jumlah</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($expenses as $expense)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $expense->expense_date ? $expense->expense_date->format('d M Y') : $expense->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $expense->description }}</td>
                        <td class="px-6 py-4 font-bold text-red-600">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.expenses.edit', $expense) }}" class="p-1.5 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.expenses.destroy', $expense) }}" method="POST" onsubmit="return confirm('Yakin hapus pengeluaran ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-500 dark:text-slate-400">
                            <span class="material-symbols-outlined text-4xl text-slate-300 dark:text-slate-600 mb-2 block">receipt_long</span>
                            Belum ada pengeluaran
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($expenses->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
            {{ $expenses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
