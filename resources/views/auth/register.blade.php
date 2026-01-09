@extends('layouts.auth')

@section('title', 'Register - BatasKota Coffee')

@section('content')
<main class="h-screen flex items-center justify-center p-2 sm:p-4 overflow-hidden">
    <div class="w-full max-w-[1100px] h-[95vh] flex flex-col lg:flex-row bg-white dark:bg-[#2c2216] rounded-xl shadow-xl overflow-hidden border border-[#e7ddcf] dark:border-neutral-800">
        <!-- Left Side: Visual Hero -->
        <div class="hidden lg:flex w-1/2 bg-cover bg-center relative" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDZImU3DErTtzbzZAIFjAfblmgW_Qk0JVEBJ6Rj6gJ-7HK6ENyuDZURIO6evcMw0L_7aT-IxfvmXGjWYauS-gw2u1gGDqqPRdzXH0YcqPbk7kZ8YzECCsfkB0ZoFAtxICnm5RH9cJViOaoVqh35r1xmFJPYnMOuR3HYagWr3zfoY4g28Ahb2Qj3UyZlBIa2zjPV9S1ylXsHQD5YnSCdhoXYDzabaDBo1PQv1aVrJczpslbcAiQKGGEwj5adXGMx67oHDXg1QEY-_7s');">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-8">
                <h1 class="text-white text-3xl font-black leading-tight mb-3 tracking-tight">
                    Mulai Harimu dengan Kopi Favoritmu.
                </h1>
                <p class="text-white/90 text-base font-medium">
                    Daftar di BatasKotaCoffee untuk memesan kopi dan toast lebih cepat, tanpa antri, dan lebih praktis untuk aktivitas harianmu.
                </p>
            </div>
        </div>
        
        <!-- Right Side: Auth Form -->
        <div class="w-full lg:w-1/2 flex flex-col bg-white dark:bg-[#1e170e] overflow-hidden">
            <!-- <div class="flex border-b border-[#e7ddcf] dark:border-neutral-800">
                <p class="flex-1 py-3 text-center border-b-[3px] border-primary text-[#1b160d] dark:text-white font-bold text-xs tracking-wide bg-primary/5 dark:bg-primary/10">
                    Sign Up
                </p>
            </div> -->
            
            <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 py-4 overflow-y-auto">
                <div class="mb-4 text-left">
                    <h2 class="text-2xl font-black mb-1 text-[#1b160d] dark:text-white tracking-tight">
                        Selamat Datang di BatasKota
                    </h2>
                    <p class="text-hover dark:text-neutral-400 text-sm">
                        Buat akun sekarang dan nikmati kemudahan memesan kopi dan toast favoritmu secara digital.
                    </p>
                </div>
                
                @if($errors->any())
                <div class="mb-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                
                <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-3">
                    @csrf
                    <!-- Username Field -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold uppercase tracking-wide text-[#1b160d] dark:text-gray-300">Username</label>
                        <div class="relative group">
                            <input name="username" value="{{ old('username') }}" class="w-full rounded-lg border border-[#e7ddcf] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-800/50  px-4 pl-10 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-hover/60 dark:placeholder:text-neutral-600 text-[#1b160d] dark:text-white" placeholder="Nama lengkap" type="text" required />
                            <span class="material-symbols-outlined absolute left-3 top-1 text-hover group-focus-within:text-primary transition-colors text-xl">person</span>
                        </div>
                    </div>
                    
                    <!-- Email Field -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold uppercase tracking-wide text-[#1b160d] dark:text-gray-300">Email</label>
                        <div class="relative group">
                            <input name="email" value="{{ old('email') }}" class="w-full rounded-lg border border-[#e7ddcf] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-800/50 px-4 pl-10 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-hover/60 dark:placeholder:text-neutral-600 text-[#1b160d] dark:text-white" placeholder="name@example.com" type="email" required />
                            <span class="material-symbols-outlined absolute left-3 top-1 text-hover group-focus-within:text-primary transition-colors text-xl">mail</span>
                        </div>
                    </div>
                    
                    <!-- Phone Field -->
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold uppercase tracking-wide text-[#1b160d] dark:text-gray-300">No. HP</label>
                        <div class="relative group">
                            <input name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border border-[#e7ddcf] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-800/50 px-4 pl-10 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-hover/60 dark:placeholder:text-neutral-600 text-[#1b160d] dark:text-white" placeholder="08123456789" type="tel" />
                            <span class="material-symbols-outlined absolute left-3 top-1 text-hover group-focus-within:text-primary transition-colors text-xl">phone</span>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="flex flex-col gap-1.5" x-data="{ showPassword: false }">
                        <label class="text-xs font-bold uppercase tracking-wide text-[#1b160d] dark:text-gray-300">Password</label>
                        <div class="relative group">
                            <input name="password" :type="showPassword ? 'text' : 'password'" class="w-full rounded-lg border border-[#e7ddcf] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-800/50 px-4 pl-10 pr-10 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-hover/60 dark:placeholder:text-neutral-600 text-[#1b160d] dark:text-white" placeholder="Minimal 8 karakter" required />
                            <span class="material-symbols-outlined absolute left-3 top-1 text-hover group-focus-within:text-primary transition-colors text-xl">lock</span>
                            <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-2 text-hover hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-xl" x-show="!showPassword">visibility</span>
                                <span class="material-symbols-outlined text-xl" x-show="showPassword" style="display: none;">visibility_off</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div class="flex flex-col gap-1.5" x-data="{ showConfirmPassword: false }">
                        <label class="text-xs font-bold uppercase tracking-wide text-[#1b160d] dark:text-gray-300">Konfirmasi Password</label>
                        <div class="relative group">
                            <input name="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" class="w-full rounded-lg border border-[#e7ddcf] dark:border-neutral-700 bg-[#fcfaf8] dark:bg-neutral-800/50 px-4 pl-10 pr-10 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all placeholder:text-hover/60 dark:placeholder:text-neutral-600 text-[#1b160d] dark:text-white" placeholder="Ulangi password" required />
                            <span class="material-symbols-outlined absolute left-3 top-1 text-hover group-focus-within:text-primary transition-colors text-xl">lock</span>
                            <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-3 top-2 text-hover hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-xl" x-show="!showConfirmPassword">visibility</span>
                                <span class="material-symbols-outlined text-xl" x-show="showConfirmPassword" style="display: none;">visibility_off</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" class="mt-2 w-full h-10 bg-primary hover:bg-hover text-white rounded-lg font-bold text-sm tracking-wide transition-all shadow-md transform active:scale-[0.99]">
                        Register
                    </button>
                    
                    <div class="flex w-full justify-center">
                        <p class="text-xs text-[#1b160d] dark:text-gray-300">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="font-bold text-primary hover:text-hover">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
