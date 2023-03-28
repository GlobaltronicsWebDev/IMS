<?php

namespace App\Observers;

use App\Models\Borrower;
use App\Models\Product;

class BorrowerObserver
{
    /**
     * Handle the Borrower "created" event.
     */
    public function created(Borrower $borrower): void
    {
        //
        $product = Product::where('sku', $borrower->sku)->first();

        $product->update([
            'quantity'=> $product->quantity - $borrower->quantity,
        ]);
    }

    /**
     * Handle the Borrower "updated" event.
     */
    public function updated(Borrower $borrower): void
    {
        //
    }

    /**
     * Handle the Borrower "deleted" event.
     */
    public function deleted(Borrower $borrower): void
    {
        //

        $product = Product::where('sku', $borrower->sku)->first();

        $product->update([
            'quantity'=> $product->quantity + $borrower->quantity,
        ]);
    }

    /**
     * Handle the Borrower "restored" event.
     */
    public function restored(Borrower $borrower): void
    {
        //
    }

    /**
     * Handle the Borrower "force deleted" event.
     */
    public function forceDeleted(Borrower $borrower): void
    {
        //
    }
}
