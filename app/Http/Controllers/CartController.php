<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->activeCart;
        if ($cart) {
            $cart->load('items.product');
        }
        return view('pages.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'strength' => 'nullable|string',
            'size' => 'nullable|string',
            'shot' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Calculate extra price from variants
        $extraPrice = 0;

        if ($request->strength && $product->has_strength) {
            $variant = ProductVariant::where('type', 'strength')->where('name', $request->strength)->first();
            if ($variant) $extraPrice += $variant->extra_price;
        }

        if ($request->size && $product->has_size) {
            $variant = ProductVariant::where('type', 'size')->where('name', $request->size)->first();
            if ($variant) $extraPrice += $variant->extra_price;
        }

        if ($request->shot && $product->has_shot) {
            $variant = ProductVariant::where('type', 'shot')->where('name', $request->shot)->first();
            if ($variant) $extraPrice += $variant->extra_price;
        }

        // Get or create active cart
        $cart = Auth::user()->activeCart ?? Cart::create([
            'user_id' => Auth::id(),
            'status' => 'active',
        ]);

        // Check if same item with same variants exists
        $existingItem = $cart->items()
            ->where('product_id', $request->product_id)
            ->where('strength', $request->strength)
            ->where('size', $request->size)
            ->where('shot', $request->shot)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $request->quantity);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'strength' => $request->strength,
                'size' => $request->size,
                'shot' => $request->shot,
                'extra_price' => $extraPrice,
                'quantity' => $request->quantity,
                'notes' => $request->notes,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Keranjang diperbarui');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return back()->with('success', 'Item dihapus dari keranjang');
    }
}
