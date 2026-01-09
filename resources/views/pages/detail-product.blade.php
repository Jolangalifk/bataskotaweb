@extends('layouts.app')

@section('title', $product->name . ' - BatasKota Coffee')

@section('content')
<div class="flex-1 flex justify-center py-6 md:py-10 px-4 md:px-10 lg:px-40">
    <div class="max-w-[1100px] w-full flex flex-col">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap gap-2 pb-6 items-center">
            <a class="text-[#083672] text-sm font-medium leading-normal hover:text-primary" href="{{ route('menu') }}">Menu</a>
            <span class="material-symbols-outlined text-[#083672] text-sm">chevron_right</span>
            <span class="text-[#1b160d] dark:text-gray-200 text-sm font-medium leading-normal">{{ $product->name }}</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 lg:gap-16">
            <!-- Left Column: Product Image -->
            <div class="flex-1 flex flex-col gap-6">
                <div class="relative w-full aspect-[4/5] lg:aspect-square rounded-xl overflow-hidden shadow-sm bg-[#fcfaf8] dark:bg-[#2a2015]">
                    @if($product->image)
                    <div class="w-full h-full bg-center bg-no-repeat bg-cover transition-transform duration-700 hover:scale-105"
                        style="background-image: url('{{ asset('storage/' . $product->image) }}');">
                    </div>
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/30 dark:to-amber-800/30">
                        <span class="material-symbols-outlined text-8xl text-amber-400 dark:text-amber-600">coffee</span>
                    </div>
                    @endif
                    @if($product->is_active)
                    <div class="absolute top-4 left-4 bg-white/90 dark:bg-black/70 backdrop-blur-sm px-3 py-1 rounded-full">
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">Tersedia</span>
                    </div>
                    @endif
                </div>
                <div class="hidden lg:block">
                    <h3 class="font-bold text-lg mb-2 dark:text-gray-200">Deskripsi</h3>
                    <p class="text-[#083672] dark:text-gray-400 text-sm leading-relaxed">
                        {{ $product->description ?? 'Produk berkualitas dari BatasKota Coffee.' }}
                    </p>
                </div>
            </div>

            <!-- Right Column: Customization Form -->
            <div class="flex-1 flex flex-col max-w-lg w-full">
                <div class="mb-6 border-b border-[#f3eee7] dark:border-[#3a2e22] pb-6">
                    <h1 class="text-3xl font-bold text-[#1b160d] dark:text-white mb-2">{{ $product->name }}</h1>
                    <p class="text-2xl font-semibold text-primary" id="totalPrice">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-6" x-data="productForm({{ $product->price }})">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    @if($product->has_strength)
                    <!-- Strength Variant -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-base font-bold text-[#1b160d] dark:text-gray-200">Kekuatan</h3>
                            <span class="text-xs text-[#083672] font-medium bg-[#f3eee7] dark:bg-[#2c2419] px-2 py-1 rounded">Wajib</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($strengthVariants as $variant)
                            <label class="cursor-pointer relative">
                                <input {{ $loop->first ? 'checked' : '' }} class="peer sr-only" name="strength" type="radio" 
                                    value="{{ $variant->name }}" data-price="{{ $variant->extra_price }}"
                                    @change="updatePrice('strength', {{ $variant->extra_price }})" />
                                <div class="p-4 rounded-lg border-2 border-[#f3eee7] dark:border-[#2c2419] peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 transition-all flex items-center justify-between h-full">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-[#083672] text-[24px]">coffee</span>
                                        <p class="font-semibold text-sm text-[#1b160d] dark:text-gray-200">{{ $variant->name }}</p>
                                    </div>
                                    @if($variant->extra_price > 0)
                                    <span class="text-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded">+{{ number_format($variant->extra_price/1000, 0) }}k</span>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($product->has_size)
                    <!-- Size Variant -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-base font-bold text-[#1b160d] dark:text-gray-200">Ukuran</h3>
                            <span class="text-xs text-[#083672] font-medium bg-[#f3eee7] dark:bg-[#2c2419] px-2 py-1 rounded">Wajib</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach($sizeVariants as $variant)
                            <label class="cursor-pointer relative">
                                <input {{ $loop->first ? 'checked' : '' }} class="peer sr-only" name="size" type="radio" 
                                    value="{{ $variant->name }}" data-price="{{ $variant->extra_price }}"
                                    @change="updatePrice('size', {{ $variant->extra_price }})" />
                                <div class="p-3 rounded-lg border-2 border-[#f3eee7] dark:border-[#2c2419] peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 transition-all text-center">
                                    <p class="font-semibold text-sm text-[#1b160d] dark:text-gray-200">{{ $variant->name }}</p>
                                    @if($variant->extra_price > 0)
                                    <span class="text-xs text-primary">+{{ number_format($variant->extra_price/1000, 0) }}k</span>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($product->has_shot)
                    <!-- Shot Variant -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-base font-bold text-[#1b160d] dark:text-gray-200">Jumlah Shot</h3>
                            <span class="text-xs text-[#083672] font-medium bg-[#f3eee7] dark:bg-[#2c2419] px-2 py-1 rounded">Wajib</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach($shotVariants as $variant)
                            <label class="cursor-pointer relative">
                                <input {{ $loop->first ? 'checked' : '' }} class="peer sr-only" name="shot" type="radio" 
                                    value="{{ $variant->name }}" data-price="{{ $variant->extra_price }}"
                                    @change="updatePrice('shot', {{ $variant->extra_price }})" />
                                <div class="p-3 rounded-lg border-2 border-[#f3eee7] dark:border-[#2c2419] peer-checked:border-primary peer-checked:bg-primary/5 dark:peer-checked:bg-primary/10 transition-all text-center">
                                    <p class="font-semibold text-sm text-[#1b160d] dark:text-gray-200">{{ $variant->name }}</p>
                                    @if($variant->extra_price > 0)
                                    <span class="text-xs text-primary">+{{ number_format($variant->extra_price/1000, 1) }}k</span>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Special Notes -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-base font-bold text-[#1b160d] dark:text-gray-200">Catatan Khusus</h3>
                            <span class="text-xs text-[#083672] font-medium">Opsional</span>
                        </div>
                        <textarea name="notes" class="w-full min-h-[80px] p-4 rounded-lg bg-[#f3eee7] dark:bg-[#2c2419] border-none text-sm text-[#1b160d] dark:text-gray-200 placeholder-[#083672] focus:ring-1 focus:ring-primary resize-none" placeholder="Contoh: Kurang es, alergi susu..."></textarea>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-base font-bold text-[#1b160d] dark:text-gray-200">Jumlah</h3>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center rounded-lg border border-[#f3eee7] dark:border-[#2c2419] bg-[#f3eee7] dark:bg-[#2c2419] p-1">
                                <button type="button" @click="decreaseQty()" class="flex h-10 w-10 items-center justify-center rounded-md text-[#1b160d] dark:text-white hover:bg-white dark:hover:bg-[#3a3022] transition-colors">
                                    <span class="material-symbols-outlined">remove</span>
                                </button>
                                <input type="number" name="quantity" x-model="quantity" min="1" class="w-16 border-none bg-transparent p-0 text-center text-lg font-semibold focus:ring-0 text-[#1b160d] dark:text-white" />
                                <button type="button" @click="increaseQty()" class="flex h-10 w-10 items-center justify-center rounded-md bg-white dark:bg-[#3a3022] text-primary shadow-sm hover:text-primary/80 transition-colors">
                                    <span class="material-symbols-outlined">add</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="mt-4">
                        <button type="submit" class="w-full bg-primary hover:bg-[#083672] text-white font-bold py-4 px-6 rounded-lg shadow-lg shadow-primary/30 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                            <span>Tambah ke Keranjang - <span x-text="formatPrice(totalPrice * quantity)"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function productForm(basePrice) {
    return {
        basePrice: basePrice,
        quantity: 1,
        extras: { strength: 0, size: 0, shot: 0 },
        get totalPrice() {
            return this.basePrice + this.extras.strength + this.extras.size + this.extras.shot;
        },
        updatePrice(type, price) {
            this.extras[type] = price;
        },
        increaseQty() {
            this.quantity++;
        },
        decreaseQty() {
            if (this.quantity > 1) this.quantity--;
        },
        formatPrice(price) {
            return 'Rp' + new Intl.NumberFormat('id-ID').format(price);
        }
    }
}
</script>
@endpush
@endsection
