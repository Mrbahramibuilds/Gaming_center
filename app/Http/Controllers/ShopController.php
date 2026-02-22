<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $categoris=Category::all();
        $products=Product::with('category');

       

        if ($request->filled('category_id')){
        $products->where('category_id', $request->category_id);
        }


        if ($request->filled('sort')) {
        switch ($request->sort) {
            case 'price_asc':
                $products->orderBy('products.price', 'asc');
                break;

            case 'price_desc':
                $products->orderBy('products.price', 'desc');
                break;

            case 'name_asc':
                $products->orderBy('products.name', 'asc');
                break;
            case 'name_desc':
                $products->orderBy('products.name','desc');
                break;
            case 'time_new':
                $products->orderBy('products.created_at','desc');
                break;
            case 'time_old':
                $products->orderBy('products.created_at','asc');
                break;
        }
    }
    //  $products = $products->get();
        return view('dashboard',compact('products','categoris','user'));
    }


}