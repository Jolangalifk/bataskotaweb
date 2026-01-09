<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)->orderBy('id')->take(6)->get();
        $company = CompanyProfile::first();
        return view('pages.home', compact('featuredProducts', 'company'));
    }

    public function menu(Request $request)
    {
        $search = $request->input('search');
        
        $products = Product::where('is_active', true)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->paginate(12)
            ->withQueryString();
        
        return view('pages.menu', compact('products', 'search'));
    }
}
