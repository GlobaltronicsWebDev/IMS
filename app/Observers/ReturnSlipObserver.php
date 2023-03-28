<?php

namespace App\Observers;

use App\Models\ReturnSlip;
use App\Models\Product;

class ReturnSlipObserver
{
    /**
     * Handle the ReturnSlip "created" event.
     */
    public function created(ReturnSlip $returnSlip): void
    {
        //
        $product = Product::where('sku', $returnSlip->sku)->first();

        $product->update([
            'quantity'=> $product->quantity - $returnSlip->quantity,
        ]);
    }

    /**
     * Handle the ReturnSlip "updated" event.
     */
    public function updated(ReturnSlip $returnSlip): void
    {
        //
    }

    /**
     * Handle the ReturnSlip "deleted" event.
     */
    public function deleted(ReturnSlip $returnSlip): void
    {
        //
        $product = Product::where('sku', $returnSlip->sku)->first();

        $product->update([
            'quantity'=> $product->quantity + $returnSlip->quantity,
        ]);
    }

    /**
     * Handle the ReturnSlip "restored" event.
     */
    public function restored(ReturnSlip $returnSlip): void
    {
        //
    }

    /**
     * Handle the ReturnSlip "force deleted" event.
     */
    public function forceDeleted(ReturnSlip $returnSlip): void
    {
        //
    }
}
