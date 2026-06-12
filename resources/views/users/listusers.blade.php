<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('لیست کاربران') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{Route('add_user')}}">
                                <button type="button" class="btn btn-success">کاربر جدید</button>
                            </a>
                        </div>
                    </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table class="table">
                            <thead>
                                <tr onclick='window.location="#"' style="cursor:pointer;">
                                <th scope="col">شماره</th>
                                <th scope="col">نام</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">نقش</th>
                                <th scope="col">توضیحات</th>
                                <th scope="col">تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $item)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    @if($item->role == null)
                                            <span class="badge bg-secondary">بدون نقش</span>
                                            <td>
                                                
                                            </td>
                                        @else
                                            <span class="badge bg-info">{{ $item->role->name }}</span>
                                          
                                </td>
                                <td>
                                    {{$item->role->description}}
                                </td>
                                @endif
                                <td>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف محصول اطمینان دارید؟')">
                                                Delete
                                            </button>
                                    </form>
                                    <a href="{{Route('form_edit_user',$item->id)}}">
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                    </a>
                                </td>
                                </tr>
                                @endforeach

                            </tbody>
</table>
                    
</x-app-layout>