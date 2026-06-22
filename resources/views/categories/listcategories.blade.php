<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('لیست دسته بندی ها') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{Route('add_category')}}">
                                <button type="button" class="btn btn-success">دسته بندی جدید</button>
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
                                <th scope="col">تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $item)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->name}}</td>
                                <td>
                                    <form action="{{Route('delete_category',$item->id)}}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف دسته بندی اطمینان دارید؟')">
                                                Delete
                                            </button>
                                    </form>
                                    <a href="{{Route('form_edit_category',$item->id)}}">
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                    </a>
                                </td>
                                </tr>
                                @endforeach

                            </tbody>
</table>
                    
</x-app-layout>