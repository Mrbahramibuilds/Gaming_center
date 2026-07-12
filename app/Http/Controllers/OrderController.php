<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function add_order(Product $product){
         $user = Auth::user();

        // 1️⃣ پیدا کردن سبد خرید فعال
        $order = Order::firstOrCreate(
            [
                'user_id' => $user->id,
                'status'  => 'pending',
            ]
        );

        // 2️⃣ اگر محصول قبلاً در سبد هست
        if ($order->products()->where('product_id', $product->id)->exists()) {

            $order->products()->updateExistingPivot(
                $product->id,
                ['quantity' => DB::raw('quantity + 1')]
            );

        } else {
            // 3️⃣ attach جدید
            $order->products()->attach($product->id, [
                'quantity' => 1
            ]);
        }

        $product->decrement('inventory', 1);

        $order->load('products');

        $total = $order->products->sum(function ($item) {
        return $item->price * $item->pivot->quantity;
        });

        $order->update(['total_price' => $total]);

        return redirect()->back()->with('success', 'محصول به سبد خرید اضافه شد');
    }


    public function show_order(){
        $user=Auth::user();
        $order = Order::with(['products.category']) 
        ->where('user_id', $user->id)
        ->where('status', 'pending')
        ->first();

        if (!$order){
           abort(403,'!!شما سفارش فعالی ندارید');
        }

    return view('orders.order_show', [
        'user'=>$user,
        'order'=>$order,
    ]);

    }
    public function delete_product_in_order(Product $product)
    {
        $user=Auth::user();

        $order=Order::where('user_id', $user->id)
        ->where('status','pending')
        ->first();
        
        if(!$order){
            return back()->with('danger','سبد خریدی وجود ندارد');
        }

        $pivot=$order->products()
        ->where('product_id',$product->id)
        ->first();

         if (!$pivot) {
        return back();
        }

        if($pivot->pivot->quantity>1){
            $order->products()->updateExistingPivot(
                $product->id,
                ['quantity' => DB::raw('quantity - 1')]
            );
        }else{
        $order->products()->detach($product->id);
        }

        $product->increment('inventory', 1);

        $order->load('products');

            // 🧮 محاسبه مجدد جمع فاکتور
            $total = $order->products->sum(function ($item) {
                return $item->price * $item->pivot->quantity;
            });

            $order->update(['total_price' => $total]);

            return back()->with('success', 'محصول از سبد خرید حذف شد');
}

        public function list_orders()
        {
           $orders=Order::with('user')->get();
           return view('orders_managment.list_orders',compact('orders')); 
        }

        public function details_order(Order $order)
        {
            $order->with('user')->get();
            return view('orders_managment.details_order',compact('order')); 
        }

        
}

