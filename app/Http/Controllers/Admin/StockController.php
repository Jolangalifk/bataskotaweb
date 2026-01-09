<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\Expense;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::latest()->paginate(10);
        return view('admin.stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('admin.stocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'purchase_price' => 'nullable|numeric|min:0',
        ]);

        $stock = Stock::create($request->only(['material_name', 'quantity', 'unit']));

        $stock->histories()->create([
            'change' => $request->quantity,
            'description' => 'Stok awal',
        ]);

        // Create expense if purchase price is provided
        if ($request->filled('purchase_price') && $request->purchase_price > 0) {
            Expense::create([
                'category' => 'stock',
                'description' => 'Pembelian ' . $request->material_name . ' (' . $request->quantity . ' ' . $request->unit . ')',
                'amount' => $request->purchase_price,
                'expense_date' => now()->toDateString(),
            ]);
        }

        return redirect()->route('admin.stocks.index')
            ->with('success', 'Bahan baku berhasil ditambahkan');
    }

    public function edit(Stock $stock)
    {
        return view('admin.stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'material_name' => 'required|string|max:255',
            'change' => 'required|integer',
            'description' => 'nullable|string',
            'purchase_price' => 'nullable|numeric|min:0',
        ]);

        $stock->update(['material_name' => $request->material_name]);

        if ($request->change != 0) {
            $newQuantity = $stock->quantity + $request->change;
            if ($newQuantity < 0) $newQuantity = 0;
            
            $description = $request->description ?? ($request->change > 0 ? 'Penambahan stok' : 'Pengurangan stok');
            
            $stock->histories()->create([
                'change' => $request->change,
                'description' => $description,
            ]);
            
            $stock->update(['quantity' => $newQuantity]);

            // Create expense if adding stock with purchase price
            if ($request->change > 0 && $request->filled('purchase_price') && $request->purchase_price > 0) {
                Expense::create([
                    'category' => 'stock',
                    'description' => 'Pembelian ' . $stock->material_name . ' (' . $request->change . ' ' . $stock->unit . ')',
                    'amount' => $request->purchase_price,
                    'expense_date' => now()->toDateString(),
                ]);
            }
        }

        return redirect()->route('admin.stocks.index')
            ->with('success', 'Stok berhasil diperbarui');
    }

    public function addStock(Request $request, Stock $stock)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $stock->addStock($request->quantity, $request->description);

        return back()->with('success', 'Stok berhasil ditambahkan');
    }

    public function reduceStock(Request $request, Stock $stock)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $stock->quantity,
            'description' => 'nullable|string',
        ]);

        $stock->reduceStock($request->quantity, $request->description);

        return back()->with('success', 'Stok berhasil dikurangi');
    }

    public function history()
    {
        $histories = StockHistory::with('stock')->latest()->paginate(20);
        return view('admin.stocks.history', compact('histories'));
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('admin.stocks.index')
            ->with('success', 'Bahan baku berhasil dihapus');
    }
}
