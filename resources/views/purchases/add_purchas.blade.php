<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-end">
            {{ __('افزودن خرید') }}
        </h2>
    </x-slot>

    <div class="py-12 text-end">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('dashboard') }}">
                <button type="button" class="btn btn-info btn-sm mb-3">بازگشت به فروشگاه</button>
            </a>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="container mt-3">
                        <div class="row justify-content-center text-end">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">ثبت خرید جدید</h5>
                                </div>

                                <div class="card-body">
                                    {{-- آدرس action را با route ذخیره خرید خودت جایگزین کن --}}
                                    <form action="{{Route('add_purches')}}" method="POST" id="purchaseForm">
                                        @csrf

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

                                        <div class="table-responsive" dir="rtl">
                                            <table class="table table-bordered align-middle text-center">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 28%">محصول</th>
                                                        <th style="width: 12%">تعداد</th>
                                                        <th style="width: 22%">قیمت خرید</th>
                                                        <th style="width: 23%">جمع ردیف</th>
                                                        <th style="width: 15%">عملیات</th>
                                                    </tr>
                                                </thead>

                                               
                                                <tbody id="productRows">
                                                    <tr id="emptyRow">
                                                    </tr>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-start"><h4>جمع کل فاکتور</h4></th>
                                                        <th>
                                                            <span id="grandTotalDisplay" class="fw-bold"><h4>0 تومان</h4></span>
                                                            <input type="hidden" name="total_amount" id="grandTotalRaw" value="0">
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="mt-4 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary px-4">
                                                ثبت خرید
                                            </button>
                                        </div>
                                    </form>
                                </div> {{-- card-body --}}
                            </div> {{-- card --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const addBtn = document.getElementById('addProductRow');
            const productRows = document.getElementById('productRows');
            const grandTotalDisplay = document.getElementById('grandTotalDisplay');
            const grandTotalRaw = document.getElementById('grandTotalRaw');

            if (!addBtn || !productRows || !grandTotalDisplay || !grandTotalRaw) {
                console.error('المان‌های لازم پیدا نشدند');
                return;
            }

            const productOptions = `
                <option value="">انتخاب محصول</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            `;

            let rowIndex = 0;

            // تبدیل ورودی به عدد خام
            function normalizeNumber(value) {
                if (!value) return 0;
                return parseInt(value.toString().replace(/[^\d]/g, '')) || 0;
            }

            // فرمت با جداکننده سه‌رقمی
            function formatPrice(number) {
                number = parseInt(number) || 0;
                return new Intl.NumberFormat('en-US').format(number);
            }

            // ساخت ردیف جدید
            function createRow(index) {
                return `
                    <tr class="product-row">
                        <td>
                            <select name="products[${index}][product_id]" class="form-select product-select" required>
                                ${productOptions}
                            </select>
                        </td>

                        <td>
                            <input type="number"
                                   name="products[${index}][quantity]"
                                   class="form-control quantity"
                                   min="1"
                                   value="1"
                                   required>
                        </td>

                        <td>
                            {{-- input نمایشی برای کاربر --}}
                            <input type="text"
                                   class="form-control buy-price-display"
                                   placeholder="قیمت خرید"
                                   inputmode="numeric"
                                   value="0">

                            {{-- input واقعی برای ارسال به سرور --}}
                            <input type="hidden"
                                   name="products[${index}][buy_price]"
                                   class="buy-price"
                                   value="0">

                            <small class="text-muted d-block mt-1 price-text">0 تومان</small>
                        </td>

                        <td>
                            <span class="row-total-text fw-bold">0 تومان</span>
                            <input type="hidden" class="row-total" value="0">
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">حذف</button>
                        </td>
                    </tr>
                `;
            }

            // محاسبه جمع یک ردیف
            function calculateRow(row) {
                if (!row) return;

                const qty = normalizeNumber(row.querySelector('.quantity')?.value);
                const price = normalizeNumber(row.querySelector('.buy-price')?.value);

                const total = qty * price;

                row.querySelector('.row-total').value = total;
                row.querySelector('.row-total-text').textContent = formatPrice(total) + ' تومان';
            }

            // محاسبه جمع کل فاکتور
            function calculateGrandTotal() {
                let total = 0;

                productRows.querySelectorAll('.product-row').forEach(function (row) {
                    total += normalizeNumber(row.querySelector('.row-total')?.value);
                });

                grandTotalRaw.value = total;
                grandTotalDisplay.textContent = formatPrice(total) + ' تومان';
            }

            // افزودن ردیف جدید
            addBtn.addEventListener('click', function () {
                const emptyRow = document.getElementById('emptyRow');
                if (emptyRow) emptyRow.remove();

                productRows.insertAdjacentHTML('beforeend', createRow(rowIndex));
                rowIndex++;

                const lastRow = productRows.querySelector('tr:last-child');
                calculateRow(lastRow);
                calculateGrandTotal();
            });

            // حذف ردیف
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row')) {
                    const row = e.target.closest('.product-row');
                    if (row) row.remove();

                    if (productRows.querySelectorAll('.product-row').length === 0) {
                        productRows.innerHTML = `
                            <tr id="emptyRow">
                                <td colspan="5" class="text-center text-muted">
                                    هنوز محصولی اضافه نشده است
                                </td>
                            </tr>
                        `;
                    }

                    calculateGrandTotal();
                }
            });

            // تغییر تعداد یا قیمت
            document.addEventListener('input', function (e) {
                const row = e.target.closest('.product-row');
                if (!row) return;

                // تغییر تعداد
                if (e.target.classList.contains('quantity')) {
                    calculateRow(row);
                    calculateGrandTotal();
                }

                // تغییر قیمت
                if (e.target.classList.contains('buy-price-display')) {
                    const rawPrice = normalizeNumber(e.target.value);

                    row.querySelector('.buy-price').value = rawPrice;
                    row.querySelector('.price-text').textContent = formatPrice(rawPrice) + ' تومان';

                    calculateRow(row);
                    calculateGrandTotal();
                }
            });

            // وقتی فوکوس روی قیمت رفت، فرمت را بردار
            document.addEventListener('focus', function (e) {
                if (e.target.classList.contains('buy-price-display')) {
                    const row = e.target.closest('.product-row');
                    if (!row) return;

                    const rawPrice = normalizeNumber(row.querySelector('.buy-price').value);
                    e.target.value = rawPrice ? rawPrice : '';
                }
            }, true);

            // وقتی از قیمت خارج شد، جداکننده را اعمال کن
            document.addEventListener('blur', function (e) {
                if (e.target.classList.contains('buy-price-display')) {
                    const row = e.target.closest('.product-row');
                    if (!row) return;

                    const rawPrice = normalizeNumber(row.querySelector('.buy-price').value);
                    e.target.value = rawPrice ? formatPrice(rawPrice) : '0';
                }
            }, true);

        });
    </script>
</x-app-layout>