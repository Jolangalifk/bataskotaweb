<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CompanyProfile;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Get best selling products (by total quantity sold)
        // If same quantity, order by latest purchase (trending)
        $bestSellingData = OrderItem::select('product_id')
            ->selectRaw('SUM(quantity) as total_sold')
            ->selectRaw('MAX(created_at) as last_purchased')
            ->whereHas('order', function ($query) {
                $query->whereIn('status', ['paid', 'process', 'ready', 'done']);
            })
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->orderByDesc('last_purchased')
            ->get();

        $bestSellingProductIds = $bestSellingData->pluck('product_id');

        // Get top selling product for hero section (product #1)
        $topProduct = null;
        if ($bestSellingProductIds->isNotEmpty()) {
            $topProduct = Product::where('is_active', true)
                ->where('id', $bestSellingProductIds->first())
                ->first();
        }
        
        // Fallback to first active product if no sales
        if (!$topProduct) {
            $topProduct = Product::where('is_active', true)->first();
        }

        // Get products by category (3 per section)
        $categories = ['coffee', 'non-coffee', 'toast'];
        $productsByCategory = [];
        
        foreach ($categories as $category) {
            $productsByCategory[$category] = Product::where('is_active', true)
                ->where('category', $category)
                ->take(3)
                ->get();
        }

        $company = CompanyProfile::first();
        return view('pages.home', compact('productsByCategory', 'company', 'topProduct'));
    }

    public function menu(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        
        // Get products grouped by category
        $categories = ['coffee', 'non-coffee', 'toast'];
        $productsByCategory = [];
        
        foreach ($categories as $cat) {
            $query = Product::where('is_active', true)->where('category', $cat);
            
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            }
            
            $productsByCategory[$cat] = $query->get();
        }
        
        return view('pages.menu', compact('productsByCategory', 'search'));
    }
}
