<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Product extends Model
{
    use HasFactory;
    use Loggable;



    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'location',
        'brand',
        'model',
        'sku',
        'description',
        'productcode',
        'uom',
        'quantity',
        'status',


    ];

    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
