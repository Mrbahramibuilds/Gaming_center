<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
           فاکتور فروش {{ $order->user->name }}  
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100 text-end">
                    
                    <div class="card shadow-sm mb-3">
                            <div class="card-header bg-primary text-white">
                                اطلاعات فاکتور
                            </div>

                            <div class="card-body">
                                <div class="row text-center text-end">

                                    <div class="col-md-3">
                                        <h6>نام کاربر</h6>
                                        <strong>{{ $order->user->name }}</strong>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>تاریخ خرید</h6>
                                        <strong>
                                            @if($order->created_at)
                                                                {{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('Y/m/d') }}
                                            @endif
                                        </strong>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>جمع کل</h6>
                                        <strong>
                                            {{ number_format($order->total_price) }}
                                            
                                            تومان
                                        </strong>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>تعداد محصولات</h6>
                                        <strong>
                                            {{ $order->products->count() }}
                                        </strong>
                                    </div>

                                </div>
                            </div>
                    </div>

<div class="card shadow-sm">
    <div class="card-header">
        محصولات خریداری شده
    </div>

    <div class="card-body text-end">

        <table class="table table-bordered text-center ">
            <thead>
                <tr>
                    <th>شماره</th>
                    <th>محصول</th>
                    <th>تعداد</th>
                    <th>قیمت فروش خرید</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->products as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>

                    <td>
                        {{ number_format($item->price) }}
                        تومان
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>


    </div>
</div>
                    
</x-app-layout>