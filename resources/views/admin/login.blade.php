@extends('layouts.auth')

@section('title', 'Admin Login - BatasKota Coffee')

@section('content')
<div class="h-screen flex items-center justify-center p-4 overflow-hidden">
    <div class="w-full max-w-md flex flex-col gap-6 bg-white dark:bg-[#2c2216] p-8 rounded-xl shadow-xl border border-[#e7ddcf] dark:border-neutral-800">
        <div class="flex flex-col gap-1.5">
            <h1 class="text-2xl font-black tracking-tight text-[#1b160d] dark:text-white">Admin Portal</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">Selamat datang! Silakan masukkan detail Anda.</p>
        </div>
        
        @if($errors->any())
        <div class="p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form action="{{ route('admin.login') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div class="flex flex-col gap-1.5">
                <label class="text-[#1b160d] dark:text-[#f3eee7] text-xs font-bold uppercase tracking-wide" for="email">Email Address</label>
                <div class="relative flex items-center">
                    <input name="email" value="{{ old('email') }}" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b160d] dark:text-white border border-[#e7ddcf] dark:border-white/10 bg-white dark:bg-white/5 h-11 px-4 pr-10 text-sm focus:outline-0 focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400 transition-all duration-200" id="email" placeholder="admin@bataskota.com" type="email" required />
                    <span class="absolute right-3 text-slate-400 material-symbols-outlined text-xl">mail</span>
                </div>
            </div>
            
            <div class="flex flex-col gap-1.5" x-data="{ showPassword: false }">
                <label class="text-[#1b160d] dark:text-[#f3eee7] text-xs font-bold uppercase tracking-wide" for="password">Password</label>
                <div class="relative flex items-center">
                    <input name="password" :type="showPassword ? 'text' : 'password'" class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b160d] dark:text-white border border-[#e7ddcf] dark:border-white/10 bg-white dark:bg-white/5 h-11 px-4 pr-10 text-sm focus:outline-0 focus:ring-2 focus:ring-primary/20 focus:border-primary placeholder:text-slate-400 transition-all duration-200" id="password" placeholder="Masukkan password" required />
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 text-slate-400 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-xl" x-show="!showPassword">visibility</span>
                        <span class="material-symbols-outlined text-xl" x-show="showPassword" style="display: none;">visibility_off</span>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary h-11 px-5 text-white text-sm font-bold shadow-sm hover:bg-[#083672] active:scale-[0.98] transition-all duration-200 gap-2 mt-2">
                <span>Login</span>
            </button>
        </form>
    </div>
</div>
@endsection
