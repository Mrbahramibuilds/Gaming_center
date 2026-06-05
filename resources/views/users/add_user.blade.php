<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('افزودن کاربر') }}
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
                    <h5 class="mb-0">افزودن کاربر جدید</h5>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{route('user_store')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-end d-block">نام کاربر</label>
                            <input type="text" name="user_name" class="form-control text-end" placeholder="نام کاربر">
                        </div>
                        @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        <div class="mb-3">
                            <label class="form-label text-end d-block">ایمیل</label>
                            <input type="text" name="email" class="form-control text-end" placeholder="ایمیل کاربر">
                        </div>
                        @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        <div class="mb-3">
                            <label class="form-label text-end d-block">نقش</label>
                            <select name="role_id" class="form-select" required>
                                <option value="" class="text-end">انتخاب کنید</option>
                                @foreach($roles as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-end d-block">رمز عبور</label>
                            <input type="password" name="password" id="password" class="form-control text-end" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text-end d-block">تکرار رمز عبور</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control text-end" required>
                        </div>

                        <div class="text-end">
                            <button class="btn btn-success">
                                ذخیره کاربر
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
                    
</x-app-layout>