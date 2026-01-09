<header class="bg-white dark:bg-[#1a140d] border-b border-[#f3eee7] dark:border-[#3a2e22] px-6 py-4 sticky top-0">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold text-[#1b160d] dark:text-white">@yield('page-title', 'Dashboard')</h1>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-500">{{ auth('admin')->user()->name ?? 'Admin' }}</span>
            <span class="px-2 py-1 text-xs rounded-full bg-primary/10 text-primary">{{ ucfirst(auth('admin')->user()->role ?? 'admin') }}</span>
        </div>
    </div>
</header>
