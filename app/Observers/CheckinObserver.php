<?php

namespace App\Observers;

use App\Models\Checkin;
use App\MOdels\Product;
use Illuminate\Http\Request;

class CheckinObserver
{
    /**
     * Handle the Checkin "created" event.
     */

     public function creating(Checkin $checkin)
     {
         //


                    // $product = Product::where('sku', $checkin->sku)->first();
                   //  $product->update([
                   //      'quantity' => $product->quantity + $checkin->quantity,
                   //  ]);
                  //  if (Checkin::where('sku', $checkin->sku)->exists()){
                   //     $product = Product::where('sku', $checkin->sku)->first();
                   //      $product->update([
                   //           'quantity' => $product->quantity + $checkin->quantity,
                      //    ]);
                  //  }


     }

    public function created(Checkin $checkin)
    {
        //


                $product = Product::where('sku', $checkin->sku)->first();

                   $product->update([
                        'quantity' => $product->quantity + $checkin->quantity,
                    ]);


    }




    /**
     * Handle the Checkin "updated" event.
     */
    public function updated(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "deleted" event.
     */
    public function deleted(Checkin $checkin): void
    {
        //
        $product = Product::where('sku', $checkin->sku)->first();

        $product->update([
            'quantity' => $product->quantity - $checkin->quantity,
        ]);
    }

    /**
     * Handle the Checkin "restored" event.
     */
    public function restored(Checkin $checkin): void
    {
        //
    }

    /**
     * Handle the Checkin "force deleted" event.
     */
    public function forceDeleted(Checkin $checkin): void
    {
        //
    }
}
