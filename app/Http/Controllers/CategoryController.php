<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list_categories()
    {
        $categories=Category::all();
        return view('categories.listcategories', compact('categories'));
    }

    public function add_category()
    {
        return view('categories.add_category');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'category_name'=>'required|string|max:50'
        ]);
        $category = Category::create([
            'name'   => $request->category_name,
        ]);

        return redirect()->route('list_categories');
    }

    public function form_edit_category(Category $category)
    {
        return view('categories.edit_category',compact('category'));

    }

    public function update_category(Request $request , Category $category)
    {
        $request->validate([
            'name'=>'required|string|max:50'
        ]);
        $category->update($request->all());
        return redirect()->route('list_categories');
    }

    public function drop_category(Category $category)
    {
        $category->delete();
        return redirect()->route('list_categories');
    }
}
