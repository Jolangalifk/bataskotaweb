<aside class="w-64 bg-white dark:bg-[#1a140d] border-r border-[#f3eee7] dark:border-[#3a2e22] flex flex-col max-h-screen sticky top-0">
    <div class="p-6 border-b border-[#f3eee7] dark:border-[#3a2e22]">
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center">
            <span class="text-xl font-bold text-[#1b160d] dark:text-white">BatasKota</span>
            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Admin Panel</span>
        </a>
    </div>
    
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">dashboard</span>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        
        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">coffee</span>
            <span class="text-sm font-medium">Produk</span>
        </a>
        
        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">receipt_long</span>
            <span class="text-sm font-medium">Pesanan</span>
        </a>
        
        <a href="{{ route('admin.stocks.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.stocks.*') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">inventory_2</span>
            <span class="text-sm font-medium">Stok Bahan</span>
        </a>
        
        <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.reports') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">bar_chart</span>
            <span class="text-sm font-medium">Laporan</span>
        </a>
        
        <a href="{{ route('admin.expenses.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.expenses.*') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">payments</span>
            <span class="text-sm font-medium">Pengeluaran</span>
        </a>
        
        <a href="{{ route('admin.company') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.company*') ? 'bg-primary text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2a2015]' }} transition-colors">
            <span class="material-symbols-outlined text-[20px]">store</span>
            <span class="text-sm font-medium">Info Usaha</span>
        </a>
    </nav>
    
    <div class="p-4 border-t border-[#f3eee7] dark:border-[#3a2e22]">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 w-full transition-colors">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span class="text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>
