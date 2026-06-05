<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('اضافه کردن محصول') }}
        </h2>
    </x-slot>

    <div class="py-12 text-end">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a href="{{Route('dashboard')}}">
                        <button type="button" class="btn btn-info btn-sm">بازگشت به فروشگاه</button>
                    </a>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">افزودن محصول جدید</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf

                        {{-- نام محصول --}}
                        <div class="mb-3">
                            <label class="form-label">نام محصول</label>
                            <input type="text" name="product_name" class="form-control" placeholder="PS5 مثلا">
                        </div>

                        {{-- دسته بندی --}}
                        <div class="mb-3">
                            <label class="form-label">دسته بندی</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">انتخاب کنید</option>
                                @foreach($category as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- قیمت --}}
                        <div class="mb-3">
                            <label class="form-label">قیمت </label>
                            <input type="number" name="price" class="form-control" placeholder="مثلاً 2500000" required>
                        </div>


                        {{-- وزن --}}
                        <div class="mb-3">
                            <label class="form-label">وزن (کیلوگرم)</label>
                            <input type="text" name="weight" class="form-control" placeholder="مثلاً 0.3">
                        </div>

                        {{-- تصویر --}}
                        <div class="mb-3">
                            <label class="form-label">تصویر محصول</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        {{-- دکمه --}}
                        <div class="text-end">
                            <button class="btn btn-success">
                                ذخیره محصول
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
                    
</x-app-layout>