<?php


use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes(['verify' => true]);

// ==================User Routes======================================
// Check-ins
Route::controller(App\Http\Controllers\User\CheckinController::class)->group(function () {
    Route::get('/checkins', 'index');
    Route::get('/checkins', 'index')->name('checkin.search');

    Route::get(' /checkins/checkinsPDF', 'checkinsPDF');
});

// Change password routes
Route::middleware('auth')->group(function(){
    Route::get('/admin/edit-password', [App\Http\Controllers\Admin\UserController::class, 'editPassword']);
    Route::post('update-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword']);

    // User side
    Route::get('edit-password', [App\Http\Controllers\User\UserController::class, 'editPassword']);
    Route::post('update-password', [App\Http\Controllers\User\UserController::class, 'changePassword']);
});


//Inventory
Route::controller(App\Http\Controllers\User\ProductController::class)->group(function(){
    Route::get('/products', 'index');
        Route::get('/products', 'index')->name('product.search');

    Route::get(' /products/productsPDF', 'inventoryPDF');
});

// Checkouts
Route::controller(App\Http\Controllers\User\OrderController::class)->group(function(){
    Route::get('/checkouts','index');
        Route::get('/checkouts', 'index')->name('checkout.search');

    Route::get(' /checkouts/checkoutsPDF', 'checkoutsPDF');
});

// Returns
Route::controller(App\Http\Controllers\User\ReturnSlipController::class)->group(function () {
    Route::get('/returns', 'index');
            Route::get('/returns', 'index')->name('return.search');

    Route::get('/returns/returnsPDF', 'returnsPDF');

});

// Borrow Items
Route::controller(App\Http\Controllers\User\BorrowerController::class)->group(function(){
    Route::get('/borrowed-items','index' );
            Route::get('/borrowed-items', 'index')->name('borrowed-item.search');

    Route::get('/borrows/borroweditemsPDF', 'borrowedItemsPDF');

});

// Purchase Returns
Route::controller(App\Http\Controllers\User\PurchaseReturnController::class)->group(function(){
    Route::get('/purchase-returns','index');
    Route::get('/purchase-returns', 'index')->name('purchase-return.search');

    Route::get('/purchasereturns/purchasereturnsPDF', 'returnsPDF');
});



// ===========Routes for Manager=======================
Route::prefix('manager')->group(function (){
// Inventory Routes for Manager
Route::controller(App\Http\Controllers\Manager\ProductController::class)->group(function () {
    Route::get('/products', 'index');
        Route::get('/products', 'index')->name('products.search');

    Route::get('products/productsPDF', 'inventoryPDF');
    Route::get('products/{product_id}/delete','destroy')->middleware(['auth','password.confirm']);
});

//CATEGORIES for Manager
Route::controller(App\Http\Controllers\Manager\CategoryController::class)->group(function () {
    Route::get('/category', 'index');

});

   //BRANDS for Manager
//    Route::get('/brands', App\Http\Livewire\Manager\Brand\Index::class);
   Route::get('/brands', [App\Http\Controllers\Manager\BrandController::class,'index']);

   // Check-in Contoller for manager
   Route::controller(App\Http\Controllers\Manager\CheckinController::class)->group(function () {
    Route::get('/checkins', 'index');
    Route::get('/checkins/create', 'create');
    Route::post('/checkins', 'store');
    Route::get('/checkins/{checkin}/edit', 'edit');
    Route::put('/checkins/{checkin}', 'update');
    Route::get('/checkins/{checkins}/delete', 'destroy')->middleware(['auth','password.confirm']);
    Route::get('/checkins/checkinsPDF', 'checkinsPDF');

});


Route::controller(App\Http\Controllers\Manager\OrderController::class)->group(function () {
    Route::get('/orders', 'index');
        Route::get('/orders', 'index')->name('orders.search');

    Route::get('/orders/create', 'create');
    Route::post('/orders', 'store');
    Route::post('/orders/generateForm', 'generateForm');
    Route::get('/orders/ordersPDF', 'ordersPDF');
    Route::get('/orders/{order_item}/edit', 'edit');
    Route::put('/orders/{order_item}', 'update');
    Route::get('orders/{order_item}/delete','destroy')->middleware(['auth','password.confirm']);
});

// Returns Routes for Manager
Route::controller(App\Http\Controllers\Manager\ReturnSlipController::class)->group(function () {
    Route::get('/returns', 'index');
        Route::get('/returns', 'index')->name('returns.index');

    Route::get('/returns/create', 'create');
    Route::post('/returns', 'store');
    Route::post('/returns/generateForm', 'generateForm');
    Route::get('/returns/returnsPDF', 'returnsPDF');
    Route::get('/returns/{return_slip}/edit', 'edit');
    Route::put('/returns/{return_slip}', 'update');
    Route::get('returns/{return_slip}/delete','destroy')->middleware(['auth','password.confirm']);
});

// Borrowers Routes for Manager
Route::controller(App\Http\Controllers\Manager\BorrowerController::class)->group(function () {
    Route::get('/borrowers', 'index');
        Route::get('/borrowers', 'index')->name('borrowers.search');

    Route::get('/borrowers/create', 'create');
    Route::post('/borrowers', 'store');
    Route::post('/borrowers/generateForm', 'generateForm');
    Route::get('/borrowers/borrowersPDF', 'borrowersPDF');
    Route::get('/borrowers/{borrower}/edit', 'edit');
    Route::put('/borrowers/{borrower}', 'update');
    Route::get('borrowers/{borrower}/delete','destroy')->middleware(['auth','password.confirm']);
});

// Purchase Return Routes
Route::controller(App\Http\Controllers\Manager\PurchaseReturnController::class)->group(function () {
    Route::get('/purchasereturns', 'index');
        Route::get('/purchasereturns', 'index')->name('purchasereturns.search');

    Route::get('/purchasereturns/create', 'create');
    Route::post('/purchasereturns', 'store');
    Route::post('/purchasereturns/generateForm', 'generateForm');
    Route::get('/purchasereturns/purchasereturnsPDF', 'purchasereturnsPDF');
    Route::get('/purchasereturns/{purchase_return}/edit', 'edit');
    Route::put('/purchasereturns/{purchase_return}', 'update');
    Route::get('purchasereturns/{purchase_return}/delete','destroy')->middleware(['auth','password.confirm']);
});

});


// ===========================ADMIN ROUTES=================================================
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){

    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'lineChart']);

    //USERS
    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('users/{user_id}/delete', 'destroy')->middleware(['auth','password.confirm']);
        Route::get('/users', 'index')->name('users.search');
    });


    //CATEGORIES
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');

    });
    //BRANDS
    // Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);
    Route::get('/brands', [App\Http\Controllers\Admin\BrandController::class,'index']);

    // Inventory Routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('/products', 'index');
                Route::get('/products', 'index')->name('products.search');

        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::get('products/productsPDF', 'inventoryPDF');
        Route::put('/products/{product}', 'update');
        Route::get('products/{product_id}/delete','destroy')->middleware(['auth','password.confirm']);
    });

    // Checkouts Routes
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders', 'index')->name('orders.search');

        Route::get('/orders/create', 'create');
        Route::post('/orders', 'store');
        Route::post('/orders/generateForm', 'generateForm');
        Route::get('/orders/ordersPDF', 'ordersPDF');
        Route::get('/orders/{order_item}/edit', 'edit');
        Route::put('/orders/{order_item}', 'update');
        Route::get('orders/{order_item}/delete','destroy')->middleware(['auth','password.confirm']);
    });

    // Check-in Contoller
    Route::controller(App\Http\Controllers\Admin\CheckinController::class)->group(function () {
        Route::get('/checkins', 'index');
        Route::get('/checkins', 'index')->name('checkins.search');

        Route::get('/checkins/create', 'create');
        Route::post('/checkins', 'store');
        //Route::post('/orders/generateForm', 'generateForm');
        Route::get('/checkins/{checkin}/edit', 'edit');
        Route::put('/checkins/{checkin}', 'update');
        Route::get('/checkins/{checkins}/delete', 'destroy')->middleware(['auth','password.confirm']);
        Route::get('/checkins/checkinsPDF', 'checkinsPDF');

    });

    // Returns Routes
    Route::controller(App\Http\Controllers\Admin\ReturnSlipController::class)->group(function () {
        Route::get('/returns', 'index');
        Route::get('/returns', 'index')->name('returns.search');

        Route::get('/returns/create', 'create');
        Route::post('/returns', 'store');
        Route::post('/returns/generateForm', 'generateForm');
        Route::get('/returns/returnsPDF', 'returnsPDF');
        Route::get('/returns/{return_slip}/edit', 'edit');
        Route::put('/returns/{return_slip}', 'update');
        Route::get('returns/{return_slip}/delete','destroy')->middleware(['auth','password.confirm']);
    });

// Borrowers Routes
Route::controller(App\Http\Controllers\Admin\BorrowerController::class)->group(function () {
    Route::get('/borrowers', 'index');
    Route::get('/borrowers', 'index')->name('borrowers.search');

    Route::get('/borrowers/create', 'create');
    Route::post('/borrowers', 'store');
    Route::post('/borrowers/generateForm', 'generateForm');
    Route::get('/borrowers/borrowersPDF', 'borrowersPDF');
    Route::get('/borrowers/{borrower}/edit', 'edit');
    Route::put('/borrowers/{borrower}', 'update');
    Route::get('borrowers/{borrower}/delete','destroy')->middleware(['auth','password.confirm']);
});


// Purchase Return Routes
Route::controller(App\Http\Controllers\Admin\PurchaseReturnController::class)->group(function () {
    Route::get('/purchasereturns', 'index');
    Route::get('/purchasereturns', 'index')->name('purchasereturns.search');

    Route::get('/purchasereturns/create', 'create');
    Route::post('/purchasereturns', 'store');
    Route::post('/purchasereturns/generateForm', 'generateForm');
    Route::get('/purchasereturns/purchasereturnsPDF', 'purchasereturnsPDF');
    Route::get('/purchasereturns/{purchase_return}/edit', 'edit');
    Route::put('/purchasereturns/{purchase_return}', 'update');
    Route::get('purchasereturns/{purchase_return}/delete','destroy')->middleware(['auth','password.confirm']);
});


});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
