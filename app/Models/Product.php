<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     use HasFactory;
    protected $table='products';

    protected $fillable = [
        'category_id',
        'name',
        'price',
        'inventory',
        'weight',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected $appends = ['formatted_price'];

    public function getFormattedPriceAttribute()
    {
        return number_format((float) $this->price, 0);
    }
        public function getRouteKeyName()
            {
                return 'name'; // یا slug
            }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function purchases()
    {
         return $this->belongsToMany(Purchase::class,'product_purchase')
            ->withPivot(['quantity', 'buy_price', 'row_total'])
            ->withTimestamps();;
    }
}
