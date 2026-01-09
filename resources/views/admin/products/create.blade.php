@extends('layouts.admin')

@section('title', 'Tambah Produk - Admin BatasKota')

@section('content')
<div class="flex-1 p-8 max-w-3xl mx-auto w-full">
    <div class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1 mb-4">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Daftar Produk
        </a>
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Produk Baru</h2>
    </div>

    <div class="bg-white dark:bg-[#1a140c] rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <!-- Image Preview -->
                <div x-data="{ preview: null }">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Gambar Produk</label>
                    <div class="flex items-start gap-4">
                        <div class="w-32 h-32 rounded-lg border-2 border-dashed border-slate-300 dark:border-slate-600 overflow-hidden bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
                            <template x-if="preview">
                                <img :src="preview" alt="Preview" class="w-full h-full object-cover" />
                            </template>
                            <template x-if="!preview">
                                <span class="material-symbols-outlined text-4xl text-slate-400">image</span>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="image" accept="image/*" @change="preview = URL.createObjectURL($event.target.files[0])"
                                class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary file:text-white file:font-medium" />
                            <p class="mt-2 text-xs text-slate-500">Format: JPG, PNG, GIF. Maks 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama Produk</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Kategori</label>
                    <select name="category" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required>
                        <option value="coffee">Coffee</option>
                        <option value="non-coffee">Non-Coffee</option>
                        <option value="toast">Toast</option>
                        <option value="topping">Topping</option>
                    </select>
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 p-3 text-slate-900 dark:text-white focus:border-primary focus:ring-1 focus:ring-primary">{{ old('description') }}</textarea>
                </div>

                <!-- Variant Options -->
                <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Opsi Varian</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Aktifkan varian yang tersedia untuk produk ini</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Strength -->
                        <label class="flex items-center gap-3 p-4 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <input type="checkbox" name="has_strength" value="1" class="rounded border-slate-300 text-primary focus:ring-primary" />
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">Varian Kekuatan</p>
                                <p class="text-xs text-slate-500">Normal / Strong</p>
                            </div>
                        </label>

                        <!-- Size -->
                        <label class="flex items-center gap-3 p-4 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <input type="checkbox" name="has_size" value="1" class="rounded border-slate-300 text-primary focus:ring-primary" />
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">Varian Ukuran</p>
                                <p class="text-xs text-slate-500">Small / Medium / Large</p>
                            </div>
                        </label>

                        <!-- Shot -->
                        <label class="flex items-center gap-3 p-4 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <input type="checkbox" name="has_shot" value="1" class="rounded border-slate-300 text-primary focus:ring-primary" />
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">Varian Shot</p>
                                <p class="text-xs text-slate-500">1 Shot / 2 Shot / 3 Shot</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Status -->
                <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-primary focus:ring-primary" />
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Produk Aktif</span>
                    </label>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all">
                        Simpan Produk
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
