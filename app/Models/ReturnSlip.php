<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class ReturnSlip extends Model
{
    use HasFactory;
    use Loggable;

    protected $table = 'return_slips';

    protected $fillable = [
        'return_id',
        'product_id',
        'quantity',
        'location',
        'checkoutdate',
        'client',
        'drnumber',
        'rsnumber',
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
