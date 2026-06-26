<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table='purchases';

    protected $fillable = [
        'invoice_number',
        'purchase_date',
        'status',
        'total_amount',
        'description',
    ];

    
    public function products()
    {
         return $this->belongsToMany(Product::class,'product_purchase')
            ->withPivot(['quantity', 'buy_price', 'row_total'])
            ->withTimestamps();;
    }
}
