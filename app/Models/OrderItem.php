<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class OrderItem extends Model
{

    use HasFactory;
    use Loggable;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'location',
        'checkoutdate',
        'client',
        'drnumber',
        'srnumber',
        'ponumber',
        'stockout_id',
        'sku',
        'productcode',
        'model',
        'uom',
        'itemdescription',
        'serialnumber'
    ];

    /**
     * Get the  that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

        /**
     * Get the  that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

}
