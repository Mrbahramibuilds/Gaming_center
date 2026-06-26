<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ $purchase->description }}
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
                                        <h6>شماره فاکتور</h6>
                                        <strong>{{ $purchase->invoice_number }}</strong>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>تاریخ خرید</h6>
                                        <strong>
                                            @if($purchase->purchase_date)
                                                                {{ \Morilog\Jalali\Jalalian::fromDateTime($purchase->purchase_date)->format('Y/m/d') }}
                                            @endif
                                        </strong>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>جمع کل</h6>
                                        <strong>
                                            {{ number_format($purchase->total_amount) }}
                                            تومان
                                        </strong>
                                    </div>

                                    <div class="col-md-3">
                                        <h6>تعداد محصولات</h6>
                                        <strong>
                                            {{ $purchase->products->count() }}
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
                    <th>فی خرید</th>
                    <th>جمع</th>
                </tr>
            </thead>

            <tbody>
                @foreach($purchase->products as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->pivot->quantity }}</td>

                    <td>
                        {{ number_format($item->pivot->buy_price) }}
                        تومان
                    </td>

                    <td>
                        {{ number_format($item->pivot->total_price) }}
                        تومان
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        @if($purchase->description)
            <div class="alert alert-info mt-3">
                {{ $purchase->description }}
            </div>
        @endif

    </div>
</div>
                    
</x-app-layout>