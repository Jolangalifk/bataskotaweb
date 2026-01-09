<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('pages.payment', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Simulasi pembayaran Midtrans Demo
        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method ?? 'qris',
            'payment_status' => 'success', // Demo: langsung success
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
        ]);

        $order->update(['status' => 'paid']);

        return redirect()->route('order.status', $order->id)
            ->with('success', 'Pembayaran berhasil!');
    }
}
