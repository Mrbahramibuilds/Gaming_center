<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseController extends Controller
{

    public function list_purches()
    {
        $purchases=Purchase::all();
        return view('purchases.list_purchases',compact('purchases'));
    }
    public function add_purchese()
    {
    $products = Product::orderBy('name')->get();

    return view('purchases.add_purchas', compact('products'));
    }
}
