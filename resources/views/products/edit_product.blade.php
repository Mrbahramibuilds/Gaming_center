<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('ویرایش محصول') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-end">
                    <a href="{{Route('list_products')}}">
                        <button type="button" class="btn btn-info btn-sm ">بازگشت به لیست محصولات</button>
                    </a>
           
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">ویرایش محصول</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{Route('update_product',$product->name)}}">
                        @csrf
                        @method('PATCH')
                        {{-- نام محصول --}}
                        <div class="mb-3">
                            <label class="form-label">نام محصول</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control"required>
                        </div>

                       
                        <div class="mb-3">
                            <label class="form-label">دسته بندی</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">انتخاب کنید</option>
                                @foreach($category as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id', $product->category_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label">قیمت (تومان)</label>
                            <input type="number" name="price" value="{{$product->price}}" class="form-control" placeholder="مثلاً 2500000" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">وزن (کیلوگرم)</label>
                            <input type="text" name="weight" value="{{$product->weight}}" class="form-control" placeholder="مثلاً 0.3">
                        </div>

                       
                        <div class="mb-3">
                            <label class="form-label">تصویر محصول</label>
                            <input type="text" name="image" value="{{$product->image}}" class="form-control">
                        </div>

                      
                        <div class="text-end">
                           <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('آیا از ویرایش محصول اطمینان دارید؟')">
                                ویرایش
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
                    
</x-app-layout>