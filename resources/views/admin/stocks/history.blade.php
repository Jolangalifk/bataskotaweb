@extends('layouts.admin')

@section('title', 'Riwayat Stok - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-7xl mx-auto w-full">
    <div class="mb-8">
        <a href="{{ route('admin.stocks.index') }}" class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Riwayat Perubahan Stok</h2>
    </div>

    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Bahan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Perubahan</th>
                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @forelse($histories as $history)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $history->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $history->stock->material_name }}</td>
                        <td class="px-6 py-4">
                            @if($history->change > 0)
                            <span class="text-green-600 font-bold">+{{ $history->change }}</span>
                            @else
                            <span class="text-red-600 font-bold">{{ $history->change }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $history->description ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-slate-500">Belum ada riwayat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($histories->hasPages())
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
            {{ $histories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
