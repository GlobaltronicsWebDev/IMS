<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\OrderItem;
use App\Models\Checkin;
use App\Models\ReturnSlip;
use App\Models\Borrower;
use App\Models\PurchaseReturn;

use App\Observers\OrderItemObserver;
use App\Observers\CheckinObserver;
use App\Observers\ReturnSlipObserver;
use App\Observers\BorrowerObserver;
use App\Observers\PurchaseReturnObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();
        OrderItem::observe(OrderItemObserver::class);
        Checkin::observe(CheckinObserver::class);
        ReturnSlip::observe(ReturnSlipObserver::class);
        Borrower::observe(BorrowerObserver::class);
        PurchaseReturn::observe(PurchaseReturnObserver::class);

    }
}
