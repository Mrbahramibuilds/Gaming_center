<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{'Show order'}}
        </h2>
    </x-slot>          
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <h3>{{'the user '.$user->name.' order'}}</h3>
                    </div>
                    <h5>{{'Products'}}</h5>

                        <table class="table">
                              <thead>
                                    <tr>
                                      <th scope="col">شماره</th>
                                      <th scope="col">نام</th>
                                      <th scope="col">دسته بندی</th>
                                      <th scope="col">تعداد سفارش</th>
                                      <th scope="col">قیمت</th>
                                      <th scope="col">تنظیمات</th>
                                    </tr>
                              </thead>
                          <tbody>

                                @foreach($order->products as $item)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->category->name}}</td>
                                        <td>{{$item->pivot->quantity}}</td>
                                        <td>{{ $item->formatted_price }} تومان</td>
                                        <td>

                                              <form action="{{Route('delete_product_in_order',$item->name)}}" method="POST" style="display:inline;">
                                                      @csrf
                                                      @method('DELETE')
                                                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا از حذف محصول در سبد خرید اطمینان دارید؟')">
                                                              حذف کردن از سبد خرید
                                                          </button>
                                              </form>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                                
                          </tbody>
                        </table>
                            <div class="container text-center">
                                            <div class="row align-items-start">
                                                <div class="col">
                                                <h4>جمع کل فاکتور</h4>
                                                </div>
                                                <div class="col">
                                                <h4>
                                                    {{ $order->formatted_price }} تومان
                                                </h4>
                                                </div>
                                                
                                            </div>
                            </div>
                </div>
    
            </div>
    </div>

</x-app-layout>
