<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="category_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">همه دسته‌بندی‌ها</option>

                                    @foreach($categoris as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        
                        <div class="col-md-4">
                                    <select name="sort" class="form-select" onchange="this.form.submit()">
                                        <option value="">مرتب‌سازی پیش‌فرض</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                            قیمت: کم به زیاد
                                        </option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                            قیمت: زیاد به کم
                                        </option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                            نام محصول (A-Z)
                                        </option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                            نام محصول (Z-A)
                                        </option>
                                        <option value="time_new" {{ request('sort') == 'time_new' ? 'selected' : '' }}>
                                            جدید ترین
                                        </option>
                                        <option value="time_old" {{ request('sort') == 'time_old' ? 'selected' : '' }}>
                                            قدیمی ترین
                                        </option>
                                    </select>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="container mt-4">

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card product-card h-100">

                    @if($product->image)
                    <img src="{{ asset('/admin/uplode/products/'.$product->image)}}" class="card-img-top" alt="product image">
                    @else
                      <img src="{{ asset('/admin/uplode/products/none_images.jpg')}}" class="card-img-top" alt="product image">
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            {{ $product->name }}
                        </h5>

                        <p class="text-muted mb-1">
                            دسته بندی:{{ $product->category->name}} 
                        </p>

                        <p class="fw-bold text-success">
                            <td>{{ $product->formatted_price }} تومان</td>
                        </p>
                        <p class="fw-bold text-success">
                            {{ $product->weight }} :وزن
                        </p>
                        <p class="fw-bold {{ $product->inventory > 0 ? 'text-success' : 'text-danger' }}">
                            
                            @if(!$product->inventory > 0)
                                <i class="bi bi-x-circle-fill text-danger"></i> ناموجود
                            @endif
                        </p>

                        <form action="{{ route('add_order', $product) }}" method="post">
                            @csrf
                            <button type="submit" class="btn {{ $product->inventory > 0 ? 'btn-success' : 'btn-secondary' }}" 
                                    {{ $product->inventory > 0 ? '' : 'disabled' }}>
                                <i class="bi {{ $product->inventory > 0 ? 'bi-cart-plus' : 'bi-cart-x' }}"></i>
                                {{ $product->inventory > 0 ? 'اضافه کردن به سبد خرید' : 'ناموجود' }}
                            </button>
                        </form>
                    </div>
                    <small class="text-muted text-center">
                   آخرین ویرایش :{{ $product->updated_at->diffForHumans() }}
                    </small>
                </div>
    
            </div>
        @endforeach
    </div>

</div>
</x-app-layout>
