<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CompanyProfile;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->activeCart;
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong');
        }
        $cart->load('items.product');
        
        $company = CompanyProfile::first();
        $storeOpen = $company ? $company->store_status : false;
        
        return view('pages.checkout', compact('cart', 'storeOpen'));
    }

    public function process(Request $request)
    {
        // Check store status first
        $company = CompanyProfile::first();
        if (!$company || !$company->store_status) {
            return redirect()->route('checkout')->with('error', 'Maaf, toko sedang tutup. Silakan coba lagi saat toko buka.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:qris,ewallet,cash',
        ]);

        $cart = Auth::user()->activeCart;
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong');
        }

        DB::beginTransaction();
        try {
            // Generate order number
            $orderNumber = 'BK' . date('Ymd') . str_pad(Order::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'total_price' => $cart->total,
                'status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'strength' => $item->strength,
                    'size' => $item->size,
                    'shot' => $item->shot,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'extra_price' => $item->extra_price,
                    'subtotal' => $item->subtotal,
                    'notes' => $item->notes,
                ]);
            }

            // Mark cart as checked out
            $cart->update(['status' => 'checked_out']);

            DB::commit();
            return redirect()->route('payment', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
