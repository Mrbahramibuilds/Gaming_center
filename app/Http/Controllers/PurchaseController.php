<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

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

    private function generateInvoiceNumber()
        {
            do {
                $invoiceNumber = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Purchase::where('invoice_number', $invoiceNumber)->exists());

            return $invoiceNumber;
        }
    public function purchese_store(Request $request)
    {
       
    $request->validate([
        'purchase_date'  => 'required|string',
        'description'    => 'nullable|string',

        'products' => 'required|array|min:1',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity'   => 'required|integer|min:1',
        'products.*.buy_price'  => 'required|numeric|min:0',
    ]);

    DB::transaction(function () use ($request) {

        $purchaseDate = null;

        if (!empty($request->purchase_date)) {
            $purchaseDate = Jalalian::fromFormat('Y/m/d', $request->purchase_date)->toCarbon()->toDateString();
        }

        $purchase = Purchase::create([
            'invoice_number' => $this->generateInvoiceNumber(),
            'purchase_date'  => $purchaseDate, // میلادی ذخیره می‌شود
            'description'    => $request->description,
            'status'         => 'pending',
            'total_amount'   => 0,
        ]);

        $totalAmount = 0;

        foreach ($request->products as $item) {
            $rowTotal = $item['quantity'] * $item['buy_price'];
            $totalAmount += $rowTotal;

            $product = Product::findOrFail($item['product_id']);
            $purchase->products()->attach($item['product_id'], [
                'quantity'  => $item['quantity'],
                'buy_price' => $item['buy_price'],
                'row_total' => $rowTotal,
            ]);
            $product->increment('inventory', $item['quantity']);
        }
        

        $purchase->update([
            'total_amount' => $totalAmount,
        ]);
    });
    

    return redirect()->route('list_purches');
    }

    public function details_purchese(Purchase $purchase)
    {
           return view('purchases.details_purchese', compact('purchase'));
    }

    public function drop_purches(Purchase $purchase)
    {
        $purchase->delete();
          return redirect()->route('list_purches');
    }
}
