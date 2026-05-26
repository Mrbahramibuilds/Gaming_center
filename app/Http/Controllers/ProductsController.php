<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
public function list_products()
{
    $products=Product::with('category')->get();
    return view('products.listproducts',compact('products'));
}

public function add_product()
{
    $category=Category::all();
    return view('products.add_product',compact('category'));    
}
public function stor_product(Request $request,Product $product)
{
    {
        // 1. اعتبارسنجی ساده
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'price'        => 'required|numeric',
            'weight'       => 'nullable|string',
            'image' => 'max:512'
        ]);

            if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('/admin/uplode/products/'),$filename);
            }

        // 3. INSERT با Model
        $product->create([
            'name' => $request->product_name,
            'category_id'=> $request->category_id,
            'price'=> $request->price,
            'weight'=> $request->weight,
            'image'=> $filename,
        ]);

        // 4. ریدایرکت
        return redirect()->route('list_products');
    }
}
public function drop_products(Product $products,Request $request){
        $product = Product::findOrFail($request->id);
        $product->delete();
        return redirect()->route('list_products');
}

public function form_edit_product(Product $product)
{
    $category=Category::all();
    return view('products.edit_product',compact('product','category'));
}

public function update_product(Product $product,Request $request)
{
    $product->update($request->all());
    return redirect()->route('list_products');
}
}
