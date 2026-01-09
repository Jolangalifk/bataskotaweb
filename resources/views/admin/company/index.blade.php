@extends('layouts.admin')

@section('title', 'Profil Usaha - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-3xl mx-auto w-full">
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Profil Usaha</h2>
        <p class="text-slate-500 dark:text-slate-400">Kelola informasi BatasKota Coffee</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">{{ session('error') }}</div>
    @endif

    <!-- Status Toko Card -->
    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl flex items-center justify-center {{ ($profile->is_open ?? true) ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }}">
                    <span class="material-symbols-outlined text-3xl {{ ($profile->is_open ?? true) ? 'text-green-600' : 'text-red-600' }}">
                        {{ ($profile->is_open ?? true) ? 'storefront' : 'door_front' }}
                    </span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Status Toko</h3>
                    <div class="flex items-center gap-2 mt-1">
                        @if($profile->is_open ?? true)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            Toko Buka
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300">
                            <span class="w-2 h-2 rounded-full bg-red-500"></span>
                            Toko Tutup
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.company.toggle-status') }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-3 rounded-lg font-bold text-white transition-all {{ ($profile->is_open ?? true) ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                    {{ ($profile->is_open ?? true) ? 'Tutup Toko' : 'Buka Toko' }}
                </button>
            </form>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-4">
            Status ini akan ditampilkan di halaman utama. Jika toko ditutup, pelanggan tetap bisa melihat menu tapi akan melihat status "Tutup".
        </p>
    </div>

    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <form action="{{ route('admin.company.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <!-- Informasi Dasar -->
                <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Informasi Dasar</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Usaha</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name ?? 'BatasKota Coffee') }}" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                            @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                            <textarea name="description" rows="3" placeholder="Deskripsi singkat tentang usaha Anda" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary">{{ old('description', $profile->description ?? '') }}</textarea>
                            @error('description')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Alamat</label>
                            <textarea name="address" rows="2" placeholder="Alamat lengkap" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary">{{ old('address', $profile->address ?? '') }}</textarea>
                            @error('address')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Kontak -->
                <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Kontak</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nomor Telepon</label>
                            <input type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" placeholder="08xxxxxxxxxx" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                            @error('phone')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" placeholder="email@example.com" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                            @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">WhatsApp</label>
                            <input type="tel" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp ?? '') }}" placeholder="628xxxxxxxxxx" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                            <p class="text-xs text-slate-500 mt-1">Format: 628xxxxxxxxxx (tanpa +)</p>
                            @error('whatsapp')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Instagram</label>
                            <input type="text" name="instagram" value="{{ old('instagram', $profile->instagram ?? '') }}" placeholder="@username" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                            @error('instagram')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Jam Operasional</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Jam Buka</label>
                            <input type="time" name="open_time" value="{{ old('open_time', $profile->open_time ? \Carbon\Carbon::parse($profile->open_time)->format('H:i') : '08:00') }}" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                            @error('open_time')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Jam Tutup</label>
                            <input type="time" name="close_time" value="{{ old('close_time', $profile->close_time ? \Carbon\Carbon::parse($profile->close_time)->format('H:i') : '22:00') }}" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                            @error('close_time')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
