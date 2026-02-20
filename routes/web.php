<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\KitchenDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ManagerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Auth::routes();

// Home/Dashboard Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected Routes
Route::middleware('auth')->group(function () {

    // Dashboard route
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/order/create', function () {
        return redirect()->route('orders.create');
    })->middleware('can:manage.orders')->name('order.create.alias');
    Route::get('/order', function () {
        return redirect()->route('orders.index');
    })->middleware('can:manage.orders')->name('order.index.alias');

    // Profile Route
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Inbox Route
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::get('/kitchen', [KitchenDashboardController::class, 'index'])->middleware('role:Kitchen Staff')->name('kitchen.dashboard');
    Route::get('/manager', [ManagerDashboardController::class, 'index'])->middleware('role:Manager')->name('manager.dashboard');
    Route::get('/cashier', [\App\Http\Controllers\CashierDashboardController::class, 'index'])->middleware('role:Cashier')->name('cashier.dashboard');
    //
    Route::post('/users/{user}/role', [UserRoleController::class, 'update'])->middleware('can:manage.users')->name('users.role.update');
    Route::resource('roles', RoleController::class)->middleware('can:manage.users');
    Route::resource('users', UserController::class)->middleware('can:manage.users');

    /* ======================
        BASIC RESOURCES
    ======================= */
    Route::resource('categories', CategoryController::class)->middleware('can:manage.basic');
    Route::resource('menus', MenuController::class)->middleware('can:manage.basic');
    Route::resource('customer', CustomerController::class)->middleware('can:manage.customer');
    Route::resource('restaurants', RestaurantController::class)->middleware('can:manage.basic');
    Route::resource('tables', RestaurantTableController::class)->middleware('can:manage.basic');
    Route::resource('products', ProductController::class)->middleware('can:manage.basic');
    Route::resource('stocks', StockController::class)->middleware('can:manage.basic');

    /* ======================
        ORDERS (MAIN)
    ======================= */
    Route::prefix('orders')->name('orders.')->group(function () {

        Route::get('/', [OrderController::class, 'index'])->name('index')->middleware('permission:orders.view');
        Route::get('/create', [OrderController::class, 'create'])->name('create')->middleware('can:manage.orders');
        Route::post('/store', [OrderController::class, 'store'])->name('store')->middleware('can:manage.orders');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit')->middleware('permission:orders.view');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show')->middleware('permission:orders.view')->whereNumber('order');

        // ✅ Confirm order
        Route::patch('/{order}/confirm', [OrderController::class, 'confirm'])->name('confirm')->middleware('can:manage.orders');

        // ✅ Payment routes
        Route::get('/{order}/payment', [OrderController::class, 'makePaymentForm'])->name('payment.form')->middleware('can:manage.payment');
        Route::post('/{order}/payment', [OrderController::class, 'processPayment'])->name('payment.process')->middleware('can:manage.payment');

        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel')->middleware('can:manage.cancel');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy')->middleware('role:Admin');


        Route::get('/orders', [PaymentController::class, 'index'])
            ->middleware('can:manage.payment')
            ->name('pages.erp.payments.index');

        // ✅ Invoice
        Route::get('/{order}/invoice', [OrderController::class, 'invoice'])->name('invoice')->middleware('permission:orders.view');

        // Optional: Change status
        Route::patch('/{order}/status', [OrderController::class, 'changeStatus'])->name('status')->middleware('role:Kitchen Staff');
        Route::patch('/{order}/approve', [OrderController::class, 'approve'])->name('approve')->middleware('can:manage.approve');

        // Reports: Delivered Invoices
        Route::get('/reports/delivered', [OrderController::class, 'deliveredReport'])->name('reports.delivered')->middleware('permission:reports.view');
    });


    /* ======================
        DASHBOARD APIs
    ======================= */
    Route::get('/api/dashboard/stats', [DashboardController::class, 'getDashboardStats']);
    Route::get('/api/dashboard/today-orders', [DashboardController::class, 'getTodayOrders']);
    Route::get('/api/dashboard/monthly-revenue', [DashboardController::class, 'getMonthlyRevenue']);
    Route::get('/api/dashboard/status-summary', [DashboardController::class, 'getOrderStatusSummary']);
    Route::get('/api/dashboard/recent-activities', [DashboardController::class, 'getRecentActivities']);
    Route::get('/api/dashboard/quick-stats', [DashboardController::class, 'getQuickStats']);

    /* ======================
        REPORTS
    ======================= */
    Route::get('/reports/customer', [OrderController::class, 'customerItemReport'])
        ->name('reports.customer.items')->middleware('permission:reports.view');

    /* ======================
        PURCHASES
    ======================= */
    Route::prefix('purchases')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');
        Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');
        Route::post('/', [PurchaseController::class, 'store'])->name('purchases.store');
        Route::get('/{id}', [PurchaseController::class, 'show'])->name('purchases.show');
        Route::get('/{id}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');
        Route::put('/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
        Route::delete('/{id}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');

        Route::post('/{id}/approve', [PurchaseController::class, 'approve'])->name('purchases.approve');
        Route::post('/{id}/receive', [PurchaseController::class, 'receive'])->name('purchases.receive');
        Route::get('/low-stock', [PurchaseController::class, 'lowStock'])->name('purchases.low-stock');
    });

    /* ======================
        SUPPLIERS
    ======================= */
    Route::get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('suppliers/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::get('suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('suppliers/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    /* ======================
        PRODUCT EXTRA
    ======================= */
    Route::post(
        '/products/{product}/adjust-stock',
        [ProductController::class, 'adjustStock']
    )->name('products.adjust-stock');
});
