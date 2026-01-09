@extends('layouts.app')

@section('title', 'Profil Saya - BatasKota Coffee')

@section('content')
<div class="max-w-[800px] mx-auto px-4 sm:px-6 md:px-10 py-8 md:py-12">
    <!-- Page Heading -->
    <div class="mb-10 text-center">
        <h1 class="text-3xl md:text-4xl font-black tracking-tight mb-2 text-[#1b160d] dark:text-white">Profil Saya</h1>
        <p class="text-[#083672] dark:text-[#be9b6b] text-lg">Kelola informasi akun Anda</p>
    </div>

    <div class="rounded-xl border border-[#f3eee7] dark:border-[#3e3428] bg-white dark:bg-[#2c2217] p-6 md:p-8 shadow-sm">
        @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-[#083672] dark:text-[#be9b6b] mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-[#1b160d] dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    @error('username')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-[#083672] dark:text-[#be9b6b] mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-[#1b160d] dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" required />
                    @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-[#083672] dark:text-[#be9b6b] mb-2">Nomor HP</label>
                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-[#1b160d] dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                    @error('phone')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-[#f3eee7] dark:border-[#3e3428]" />

                <!-- Change Password Section -->
                <!-- <div>
                    <h3 class="text-lg font-bold text-[#1b160d] dark:text-white mb-4">Ubah Password</h3>
                    <p class="text-sm text-[#083672] dark:text-[#be9b6b] mb-4">Kosongkan jika tidak ingin mengubah password</p>
                </div> -->

                <!-- Current Password -->
                <!-- <div>
                    <label class="block text-sm font-medium text-[#083672] dark:text-[#be9b6b] mb-2">Password Saat Ini</label>
                    <input type="password" name="current_password" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-[#1b160d] dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                    @error('current_password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div> -->

                <!-- New Password -->
                <!-- <div>
                    <label class="block text-sm font-medium text-[#083672] dark:text-[#be9b6b] mb-2">Password Baru</label>
                    <input type="password" name="password" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-[#1b160d] dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                    @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div> -->

                <!-- Confirm Password -->
                <!-- <div>
                    <label class="block text-sm font-medium text-[#083672] dark:text-[#be9b6b] mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="w-full rounded-lg border-[#f3eee7] dark:border-[#3e3428] bg-[#f8f7f6] dark:bg-[#221a10] p-3 text-[#1b160d] dark:text-white focus:border-primary focus:ring-1 focus:ring-primary" />
                </div> -->

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-primary/20 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
