<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('لیست خریدها') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{Route('add_purches')}}">
                                <button type="button" class="btn btn-success">خرید جدید</button>
                            </a>
                        </div>
                    </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table class="table">
                            <thead>
                                <tr onclick='window.location="#"' style="cursor:pointer;">
                                <th scope="col">شماره</th>
                                <th scope="col">شماره فاکتور</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">قیمت</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">توضیحات</th>
                                <th scope="col">تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $item)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->invoice_number}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{ number_format($item->total_amount) }} تومان</td>
                                <td>
                                    @if($item->purchase_date)
                                        {{ \Morilog\Jalali\Jalalian::fromDateTime($item->purchase_date)->format('Y/m/d') }}
                                    @endif
                                </td>

                                <td>{{$item->description}}</td>
                                <td>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف خرید اطمینان دارید؟')">
                                                Delete
                                            </button>
                                    </form>
                                    <a href="#">
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                    </a>
                                </td>
                                </tr>
                                @endforeach

                            </tbody>
</table>
                    
</x-app-layout>