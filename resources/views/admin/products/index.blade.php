@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-7xl mx-auto w-full">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Manajemen Produk</h2>
            <p class="text-slate-500 dark:text-slate-400">Kelola produk yang dijual</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white text-sm font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Produk
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
        {{ session('success') }}
    </div>
    @endif

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-[#1a140c] p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Total Produk</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $products->total() }}</h3>
            </div>
            <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-blue-600 dark:text-blue-400">
                <span class="material-symbols-outlined">inventory_2</span>
            </div>
        </div>
        <div class="bg-white dark:bg-[#1a140c] p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Produk Aktif</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $products->where('is_active', true)->count() }}</h3>
            </div>
            <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg text-green-600 dark:text-green-400">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
        </div>
        <div class="bg-white dark:bg-[#1a140c] p-5 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex items-start justify-between">
            <div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">Produk Nonaktif</p>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $products->where('is_active', false)->count() }}</h3>
            </div>
            <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-600 dark:text-red-400">
                <span class="material-symbols-outlined">cancel</span>
            </div>
        </div>
    </div>

    <!-- Product Table -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider font-semibold">
                        <th class="p-4 pl-6">Produk</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Varian</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right pr-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-sm text-slate-700 dark:text-slate-300">
                    @forelse($products as $product)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                        <td class="p-4 pl-6">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-lg bg-cover bg-center shrink-0 border border-slate-100 dark:border-slate-700"
                                    style="background-image: url('{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100' }}');">
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ $product->name }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ Str::limit($product->description, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <span class="px-2 py-1 text-xs font-medium rounded-full 
                                @if($product->category == 'coffee') bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400
                                @elseif($product->category == 'non-coffee') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                                @elseif($product->category == 'toast') bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400
                                @else bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400
                                @endif">
                                {{ ucfirst($product->category) }}
                            </span>
                        </td>
                        <td class="p-4 font-medium text-slate-900 dark:text-white">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            <div class="flex flex-wrap gap-1">
                                @if($product->has_strength)
                                <span class="px-1.5 py-0.5 text-[10px] font-medium rounded bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Kekuatan</span>
                                @endif
                                @if($product->has_size)
                                <span class="px-1.5 py-0.5 text-[10px] font-medium rounded bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">Ukuran</span>
                                @endif
                                @if($product->has_shot)
                                <span class="px-1.5 py-0.5 text-[10px] font-medium rounded bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">Shot</span>
                                @endif
                                @if(!$product->has_strength && !$product->has_size && !$product->has_shot)
                                <span class="text-xs text-slate-400">-</span>
                                @endif
                            </div>
                        </td>
                        <td class="p-4">
                            @if($product->is_active)
                            <div class="flex items-center gap-1.5">
                                <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                <span class="text-xs font-medium text-green-700 dark:text-green-400">Aktif</span>
                            </div>
                            @else
                            <div class="flex items-center gap-1.5">
                                <div class="h-2 w-2 rounded-full bg-red-500"></div>
                                <span class="text-xs font-medium text-red-700 dark:text-red-400">Nonaktif</span>
                            </div>
                            @endif
                        </td>
                        <td class="p-4 text-right pr-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="p-1.5 text-slate-400 hover:text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                            Belum ada produk. <a href="{{ route('admin.products.create') }}" class="text-primary hover:underline">Tambah produk pertama</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
