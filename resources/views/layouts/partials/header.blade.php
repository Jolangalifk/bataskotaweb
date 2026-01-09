<header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#f3eee7] dark:border-b-[#3a2e22] bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm px-10 py-3 shadow-sm">
    <div class="flex items-center gap-8">
        <a href="{{ route('home') }}" class="flex w-24">
            <img src="{{ asset('logo.svg') }}" alt="BatasKota Coffee" />
        </a>
        <div class="hidden md:flex items-center gap-9">
            <a class="{{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-[#1b160d] dark:text-white/80 hover:text-primary' }} text-sm leading-normal transition-colors" href="{{ route('home') }}">Home</a>
            <a class="text-[#1b160d] dark:text-white/80 hover:text-primary dark:hover:text-primary transition-colors text-sm font-medium leading-normal" href="{{ route('menu') }}">Menu</a>
        </div>
    </div>
    <div class="flex flex-1 justify-end gap-6 items-center">
        <!-- <label class="hidden sm:flex flex-col min-w-40 !h-10 max-w-64">
            <div class="flex w-full flex-1 items-stretch rounded-lg h-full ring-1 ring-[#e5dbcf] dark:ring-[#4a3b2a] focus-within:ring-primary transition-all">
                <div class="text-[#083672] dark:text-[#be9b6b] flex border-none bg-transparent items-center justify-center pl-4 rounded-l-lg">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#1b160d] dark:text-white focus:outline-0 focus:ring-0 border-none bg-transparent h-full placeholder:text-[#083672] dark:placeholder:text-[#be9b6b] px-4 rounded-l-none pl-2 text-base font-normal" placeholder="Cari menu..." />
            </div>
        </label> -->
        
        @auth
            <a href="{{ route('cart') }}" class="relative flex cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-primary hover:bg-primary/90 text-white transition-colors">
                <span class="material-symbols-outlined text-[20px]">shopping_cart</span>
                @if(auth()->user()->activeCart && auth()->user()->activeCart->items->count() > 0)
                <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">
                    {{ auth()->user()->activeCart->items->count() }}
                </span>
                @endif
            </a>
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="flex items-center gap-2 text-sm font-medium text-[#1b160d] dark:text-white hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">account_circle</span>
                    {{ auth()->user()->username }}
                    <span class="material-symbols-outlined text-[16px]" :class="{ 'rotate-180': open }">expand_more</span>
                </button>
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#2a2015] rounded-lg shadow-lg border border-[#e5dbcf] dark:border-[#3a2e22] py-1 z-50"
                     style="display: none;">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-[#1b160d] dark:text-white hover:bg-gray-100 dark:hover:bg-[#3a2e22] transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">person</span>
                            Profil
                        </span>
                    </a>
                    <a href="{{ route('orders') }}" class="block px-4 py-2 text-sm text-[#1b160d] dark:text-white hover:bg-gray-100 dark:hover:bg-[#3a2e22] transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                            Pesanan Saya
                        </span>
                    </a>
                    <hr class="my-1 border-[#e5dbcf] dark:border-[#3a2e22]">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <span class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">logout</span>
                                Logout
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary hover:bg-primary/90 text-white text-sm font-bold transition-colors">
                Login
            </a>
        @endauth
    </div>
</header>
