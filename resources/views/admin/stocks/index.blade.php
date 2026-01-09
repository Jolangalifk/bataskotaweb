@extends('layouts.admin')

@section('title', 'Manajemen Stok - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-7xl mx-auto w-full">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen Stok Bahan Baku</h2>
            <p class="text-slate-500 dark:text-slate-400">Kelola persediaan bahan</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.stocks.history') }}" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-sm font-semibold px-4 py-2 rounded-lg transition-all">
                <span class="material-symbols-outlined text-[20px]">history</span>
                Riwayat
            </a>
            <a href="{{ route('admin.stocks.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Bahan
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif

    <!-- Stocks Table -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Bahan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Satuan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Update Terakhir</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($stocks as $stock)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $stock->material_name }}</td>
                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">{{ $stock->quantity }}</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $stock->unit }}</td>
                        <td class="px-6 py-4">
                            @if($stock->quantity <= 10)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300">
                                <span class="size-1.5 rounded-full bg-red-500"></span>
                                Stok Rendah
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                                <span class="size-1.5 rounded-full bg-green-500"></span>
                                Tersedia
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $stock->updated_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.stocks.edit', $stock) }}" class="p-1.5 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.stocks.destroy', $stock) }}" method="POST" onsubmit="return confirm('Yakin hapus bahan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">
                            Belum ada data stok
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($stocks->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
            {{ $stocks->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
