<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('ویرایش دسته بندی') }}
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
                    <h5 class="mb-0">ویرایش دسته بندی </h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{route('update_category',$category->id)}}">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label class="form-label text-end d-block">نام دسته بندی</label>
                            <input type="text" name="name" class="form-control text-end" placeholder="نام دسته بندی" value="{{$category->name}}">
                        </div>
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        <div class="text-end">
                            <button class="btn btn-success">
                                ذخیره دسته بندی
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
                    
</x-app-layout>