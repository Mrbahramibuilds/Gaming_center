<?php

return [
    /*
    |--------------------------------------------------------------------------
    | خطوط اعتبارسنجی زبان
    |--------------------------------------------------------------------------
    |
    */

    'accepted'             => ':attribute باید پذیرفته شده باشد.',
    'active_url'           => ':attribute آدرس معتبر نمی‌باشد.',
    'after'                => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal'       => ':attribute باید تاریخی بعد از یا برابر :date باشد.',
    'alpha'                => ':attribute باید فقط حاوی حروف باشد.',
    'alpha_dash'           => ':attribute باید فقط حاوی حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num'            => ':attribute باید فقط حاوی حروف و اعداد باشد.',
    'array'                => ':attribute باید آرایه باشد.',
    'before'               => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal'      => ':attribute باید تاریخی قبل از یا برابر :date باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => ':attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید بین :min و :max آیتم داشته باشد.',
    ],
    'boolean'              => ':attribute فیلد باید درست یا نادرست (true یا false) باشد.',
    'confirmed'            => ':attribute با فیلد تکرار مطابقت ندارد.',  // مهم برای رمز عبور
    'date'                 => ':attribute تاریخ معتبر نمی‌باشد.',
    'date_equals'          => ':attribute باید تاریخی برابر با :date باشد.',
    'date_format'          => ':attribute با قالب :format مطابقت ندارد.',
    'different'            => ':attribute و :other باید متفاوت باشند.',
    'digits'               => ':attribute باید :digits رقم باشد.',
    'digits_between'       => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => ':attribute ابعاد تصویر مجاز نمی‌باشد.',
    'distinct'             => ':attribute فیلد تکراری است.',
    'email'                => ':attribute باید یک ایمیل معتبر باشد.',
    'ends_with'            => ':attribute باید با یکی از این مقادیر خاتمه یابد: :values.',
    'exists'               => ':attribute انتخاب شده معتبر نمی‌باشد.',
    'file'                 => ':attribute باید فایل باشد.',
    'filled'               => ':attribute فیلد باید مقدار داشته باشد.',
    'gt'                   => [
        'numeric' => ':attribute باید بزرگتر از :value باشد.',
        'file'    => ':attribute باید بزرگتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید بزرگتر از :value کاراکتر باشد.',
        'array'   => ':attribute باید بیشتر از :value آیتم داشته باشد.',
    ],
    'gte'                  => [
        'numeric' => ':attribute باید بزرگتر یا مساوی :value باشد.',
        'file'    => ':attribute باید بزرگتر یا مساوی :value کیلوبایت باشد.',
        'string'  => ':attribute باید بزرگتر یا مساوی :value کاراکتر باشد.',
        'array'   => ':attribute باید :value آیتم یا بیشتر داشته باشد.',
    ],
    'image'                => ':attribute باید تصویر باشد.',
    'in'                   => ':attribute انتخاب شده معتبر نمی‌باشد.',
    'in_array'             => ':attribute در :other وجود ندارد.',
    'integer'              => ':attribute باید عدد صحیح باشد.',
    'ip'                   => ':attribute باید آدرس IP معتبر باشد.',
    'ipv4'                 => ':attribute باید آدرس IPv4 معتبر باشد.',
    'ipv6'                 => ':attribute باید آدرس IPv6 معتبر باشد.',
    'json'                 => ':attribute باید رشته JSON معتبر باشد.',
    'lt'                   => [
        'numeric' => ':attribute باید کوچکتر از :value باشد.',
        'file'    => ':attribute باید کوچکتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید کوچکتر از :value کاراکتر باشد.',
        'array'   => ':attribute باید کمتر از :value آیتم داشته باشد.',
    ],
    'lte'                  => [
        'numeric' => ':attribute باید کوچکتر یا مساوی :value باشد.',
        'file'    => ':attribute باید کوچکتر یا مساوی :value کیلوبایت باشد.',
        'string'  => ':attribute باید کوچکتر یا مساوی :value کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :value آیتم داشته باشد.',
    ],
    'max'                  => [
        'numeric' => ':attribute نباید بزرگتر از :max باشد.',
        'file'    => ':attribute نباید بزرگتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :max آیتم داشته باشد.',
    ],
    'mimes'                => ':attribute باید فایل با نوع: :values باشد.',
    'mimetypes'            => ':attribute باید فایل با نوع: :values باشد.',
    'min'                  => [
        'numeric' => ':attribute باید حداقل :min باشد.',
        'file'    => ':attribute باید حداقل :min کیلوبایت باشد.',
        'string'  => ':attribute باید حداقل :min کاراکتر باشد.',
        'array'   => ':attribute باید حداقل :min آیتم داشته باشد.',
    ],
    'multiple_of'          => ':attribute باید ضریبی از :value باشد.',
    'not_in'               => ':attribute انتخاب شده معتبر نمی‌باشد.',
    'not_regex'            => 'فرمت :attribute معتبر نمی‌باشد.',
    'numeric'              => ':attribute باید عدد باشد.',
    'password'             => 'رمز عبور اشتباه است.',
    'present'              => ':attribute باید وجود داشته باشد.',
    'regex'                => 'فرمت :attribute معتبر نمی‌باشد.',
    'required'             => 'فیلد :attribute الزامی است.',
    'required_if'          => 'هنگامی که :other برابر :value است، فیلد :attribute الزامی است.',
    'required_unless'      => 'فیلد :attribute الزامی است مگر اینکه :other در :values باشد.',
    'required_with'        => 'هنگامی که :values وجود دارد، فیلد :attribute الزامی است.',
    'required_with_all'    => 'هنگامی که :values وجود دارد، فیلد :attribute الزامی است.',
    'required_without'     => 'هنگامی که :values وجود ندارد، فیلد :attribute الزامی است.',
    'required_without_all' => 'هنگامی که هیچکدام از :values وجود ندارد، فیلد :attribute الزامی است.',
    'prohibited'           => 'فیلد :attribute ممنوع است.',
    'prohibited_if'        => 'فیلد :attribute وقتی :other برابر :value است ممنوع است.',
    'prohibited_unless'    => 'فیلد :attribute ممنوع است مگر اینکه :other در :values باشد.',
    'same'                 => ':attribute و :other باید مطابقت داشته باشند.',
    'size'                 => [
        'numeric' => ':attribute باید برابر :size باشد.',
        'file'    => ':attribute باید برابر :size کیلوبایت باشد.',
        'string'  => ':attribute باید برابر :size کاراکتر باشد.',
        'array'   => ':attribute باید :size آیتم داشته باشد.',
    ],
    'starts_with'          => ':attribute باید با یکی از این مقادیر شروع شود: :values.',
    'string'               => ':attribute باید رشته باشد.',
    'timezone'             => ':attribute باید منطقه زمانی معتبر باشد.',
    'unique'               => ':attribute قبلاً استفاده شده است.',
    'uploaded'             => 'آپلود :attribute انجام نشد.',
    'url'                  => 'فرمت :attribute معتبر نمی‌باشد.',
    'uuid'                 => ':attribute باید UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | خطوط اعتبارسنجی سفارشی
    |--------------------------------------------------------------------------
    |
    */

    'custom' => [
        'name' => [
            'required' => 'نام کاربری الزامی است.',
            'min' => 'نام کاربری باید حداقل 3 کاراکتر باشد.',
        ],
        'email' => [
            'required' => 'ایمیل الزامی است.',
            'email' => 'فرمت ایمیل معتبر نیست.',
            'unique' => 'این ایمیل قبلاً ثبت شده است.',
        ],
        'password' => [
            'required' => 'رمز عبور الزامی است.',
            'min' => 'رمز عبور باید حداقل 6 کاراکتر باشد.',
            'confirmed' => 'رمز عبور با تکرار آن مطابقت ندارد.',  // این خط برای مشکل شما
        ],
        'roles' => [
            'required' => 'حداقل یک نقش باید انتخاب شود.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | نام‌های فیلدها
    |--------------------------------------------------------------------------
    |
    */

    'attributes' => [
        'name'                  => 'نام کاربری',
        'email'                 => 'ایمیل',
        'password'              => 'رمز عبور',
        'password_confirmation' => 'تکرار رمز عبور',
        'description'           => 'توضیحات',
        'roles'                 => 'نقش‌ها',
        'category_id'           => 'دسته‌بندی',
        'price'                 => 'قیمت',
        'stock'                 => 'موجودی',
        'title'                 => 'عنوان',
        'content'               => 'محتوا',
    ],

];