<?php

namespace App\Observers;

use App\Models\PurchaseReturn;
use App\Models\Product;

class PurchaseReturnObserver
{
    /**
     * Handle the PurchaseReturn "created" event.
     */
    public function created(PurchaseReturn $purchaseReturn): void
    {
        //
        $product = Product::where('sku', $purchaseReturn->sku)->first();

        $product->update([
            'quantity'=> $product->quantity - $purchaseReturn->quantity,
        ]);
    }

    /**
     * Handle the PurchaseReturn "updated" event.
     */
    public function updated(PurchaseReturn $purchaseReturn): void
    {
        //
    }

    /**
     * Handle the PurchaseReturn "deleted" event.
     */
    public function deleted(PurchaseReturn $purchaseReturn): void
    {
        //
        $product = Product::where('sku', $purchaseReturn->sku)->first();

        $product->update([
            'quantity'=> $product->quantity + $purchaseReturn->quantity,
        ]);
    }

    /**
     * Handle the PurchaseReturn "restored" event.
     */
    public function restored(PurchaseReturn $purchaseReturn): void
    {
        //
    }

    /**
     * Handle the PurchaseReturn "force deleted" event.
     */
    public function forceDeleted(PurchaseReturn $purchaseReturn): void
    {
        //
    }
}
