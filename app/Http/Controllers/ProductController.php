<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $strengthVariants = ProductVariant::strength()->get();
        $sizeVariants = ProductVariant::size()->get();
        $shotVariants = ProductVariant::shot()->get();

        return view('pages.detail-product', compact('product', 'strengthVariants', 'sizeVariants', 'shotVariants'));
    }
}
