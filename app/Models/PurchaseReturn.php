<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class PurchaseReturn extends Model
{
    use HasFactory;
    use Loggable;

    protected $table = 'purchase_returns';

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'location',
        'checkoutdate',
        'client',
        'drnumber',
        'prsnumber',
        'stockout_id',
        'sku',
        'productcode',
        'model',
        'uom',
        'itemdescription',
        'serialnumber'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
