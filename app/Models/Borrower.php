<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Borrower extends Model
{
    use HasFactory;
    use Loggable;
    protected $table = 'borrowers';

    protected $fillable = [
        'borrower_id',
        'product_id',
        'quantity',
        'location',
        'checkoutdate',
        'dateofreturn',
        'client',
        'brnumber',
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
