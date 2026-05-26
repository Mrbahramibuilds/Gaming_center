<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{Route('add_product')}}">
                                <button type="button" class="btn btn-success">محصول جدید</button>
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
                                <th scope="col">قیمت</th>
                                <th scope="col">دسته بندی</th>
                                <th scope="col">موجودی</th>
                                <th scope="col">وزن</th>
                                <th scope="col">تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $item)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{ $item->formatted_price }} تومان</td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->inventory}}</td>
                                <td>{{$item->weight}}</td>
                                <td>
                                    @cannot('admin-read-only')
                                    <form action="{{Route('delete_product',$item->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف محصول اطمینان دارید؟')">
                                                Delete
                                            </button>
                                    </form>
                                    <a href="{{Route('form_edit_product',$item->name)}}">
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                    </a>
                                    @endcan
                                </td>
                                </tr>
                                @endforeach

                            </tbody>
</table>
                    
</x-app-layout>