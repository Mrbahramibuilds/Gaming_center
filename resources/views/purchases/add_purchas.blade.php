<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('افزودن خرید') }}
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
    <div class="row justify-content-center text-end">
           
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">ثبت خرید جدید</h5>
                </div>

                <div class="card-body">
                    <form action="#" method="POST" id="purchaseForm">
                        @csrf

                        {{-- نمایش خطاهای ولیدیشن --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>خطا:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- اطلاعات فاکتور --}}
                        <div class="row g-3 mb-4 text-end">
                            <div class="col-md-6">
                                <label class="form-label">توضیحات</label>
                                <input type="text" name="description" class="form-control"
                                    value="{{ old('description') }}">
                            </div>

                            <div class="col-md-6">
                                 <label class="form-label">تاریخ خرید</label>
                                    <input type="text"
                                        name="purchase_date"
                                        class="form-control"
                                        placeholder="مثلاً 1405/04/04"
                                        value="{{ old('purchase_date') }}">
                            </div>
                        </div>

                        <hr>

                        {{-- بخش محصولات --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="button" class="btn btn-success btn-sm" id="addProductRow">
                                + افزودن محصول
                            </button>
                            <h5 class="mb-0">محصولات خرید</h5>
                            
                        </div>

                        <div class="table-responsive ">
                            <table class="table table-bordered align-middle" id="productsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>محصول</th>
                                        <th>تعداد</th>
                                        <th>قیمت خرید</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody id="productRows">
                                    {{-- ردیف اول پیش‌فرض --}}
                                    <tr class="product-row">
                                        <td>
                                            <select name="products[0][product_id]" class="form-select product-select" required>
                                                <option value="">انتخاب محصول</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="number"
                                                name="products[0][quantity]"
                                                class="form-control quantity"
                                                min="1"
                                                value="1"
                                                required>
                                        </td>

                                        <td>
                                            <input type="number"
                                                name="products[0][buy_price]"
                                                class="form-control buy-price"
                                                min="0"
                                                value="0"
                                                required>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                                حذف
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- جمع کل --}}
                        <div class="row mt-4">
                            <div class="col-md-4 ms-auto">
                                <label class="form-label fw-bold">جمع کل فاکتور</label>
                                <input type="text" id="grandTotal" class="form-control fw-bold" value="0" readonly>
                            </div>
                        </div>

                        {{-- دکمه ثبت --}}
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">
                                ثبت خرید
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        

        {{-- قالب option محصولات برای JS --}}
        <script>
            const productOptions = `
                <option value="">انتخاب محصول</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            `;
        </script>

        <script>
            let rowIndex = 1;

            // افزودن ردیف جدید
            document.getElementById('addProductRow').addEventListener('click', function () {
                const row = `
                    <tr class="product-row">
                        <td>
                            <select name="products[${rowIndex}][product_id]" class="form-select product-select" required>
                                ${productOptions}
                            </select>
                        </td>

                        <td>
                            <input type="number"
                                name="products[${rowIndex}][quantity]"
                                class="form-control quantity"
                                min="1"
                                value="1"
                                required>
                        </td>

                        <td>
                            <input type="number"
                                name="products[${rowIndex}][buy_price]"
                                class="form-control buy-price"
                                min="0"
                                value="0"
                                required>
                        </td>

                        <td>
                            <input type="text" class="form-control row-total" value="0" readonly>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">حذف</button>
                        </td>
                    </tr>
                `;

                document.getElementById('productRows').insertAdjacentHTML('beforeend', row);
                rowIndex++;
                calculateGrandTotal();
            });

            // حذف ردیف
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row')) {
                    const rows = document.querySelectorAll('#productRows .product-row');

                    // حداقل یک ردیف باقی بماند
                    if (rows.length > 1) {
                        e.target.closest('tr').remove();
                        calculateGrandTotal();
                    }
                }
            });

            // محاسبه جمع ردیف و جمع کل
            document.addEventListener('input', function (e) {
                if (e.target.classList.contains('quantity') || e.target.classList.contains('buy-price')) {
                    const row = e.target.closest('tr');
                    calculateRowTotal(row);
                    calculateGrandTotal();
                }
            });

            function calculateRowTotal(row) {
                const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
                const buyPrice = parseFloat(row.querySelector('.buy-price').value) || 0;
                const total = quantity * buyPrice;

                row.querySelector('.row-total').value = total;
            }

            function calculateGrandTotal() {
                let grandTotal = 0;

                document.querySelectorAll('.product-row').forEach(function (row) {
                    const rowTotal = parseFloat(row.querySelector('.row-total').value) || 0;
                    grandTotal += rowTotal;
                });

                document.getElementById('grandTotal').value = grandTotal;
            }

            // بار اول هم محاسبه شود
            document.querySelectorAll('.product-row').forEach(function (row) {
                calculateRowTotal(row);
            });
            calculateGrandTotal();

             
        </script> 
    </div>
</div>
                    
</x-app-layout>