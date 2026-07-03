<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('لیست سفارشات') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table class="table">
                            <thead>
                                <tr onclick='window.location="#"' style="cursor:pointer;">
                                <th scope="col">شماره</th>
                                <th scope="col">نام کاربر</th>
                                <th scope="col">وضعیت</th>
                                <th scope="col">قیمت</th>
                                <th scope="col">تاریخ</th>
                                <th scope="col">تنظیمات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $item)
                                <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->user->name}}</td>
                                <td>
                                    @if(!$item->status=='pending')
                                    تایید شده است
                                    @else
                                    در حال پردازش
                                    @endif
                                </td>
                                <td>{{ number_format($item->total_price) }} تومان</td>
                                <td>
                                    @if($item->created_at)
                                        {{ \Morilog\Jalali\Jalalian::fromDateTime($item->created_at)->format('Y/m/d') }}
                                    @endif
                                </td>

                                <td>
                                    
                                    <a href="{{Route('details_order',$item->id)}}">
                                        <button class="btn btn-primary btn-sm">Details</button>
                                    </a>
                                </td>
                                </tr>
                                @endforeach

                            </tbody>
</table>
                    
</x-app-layout>