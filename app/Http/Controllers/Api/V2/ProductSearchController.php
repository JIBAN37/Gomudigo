<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    public function searchProduct(Request $request)
    {
        $searchedProduct = $request->search;

        $product = Product::when($searchedProduct, function ($product) use($searchedProduct){
            $product->where('name', 'LIKE', '%'.$searchedProduct.'%');
        })
        ->limit(15)
        ->get();

        return response()->json($product);
    }
}
