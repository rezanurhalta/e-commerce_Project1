<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// route::resource('/products', ProductController::class);

Route::get('/', function () {
    return redirect('/login');
});


route::get('/login', [AuthController::class, 'showlogin']);
route::post('/login', [AuthController::class, 'login'])->name('login');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');

route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
route::get('/admin/report/sales', [AdminController::class, 'salesReport'])->name('admin.sales');
route::get('/admin/orders', [AdminController::class, 'index'])->name('admin.orders.index');
route::get('/admin/orders/{id}', [AdminController::class, 'show'])->name('admin.orders.show');
route::put('/admin/orders/{id}', [AdminController::class, 'update'])->name('admin.orders.update');

Route::resource('products', ProductController::class);

Route::get('/customer/products', [CustomerController::class, 'products'])->name('customer.products');
route::get('/customer/orders', [OrderController::class, 'orders'])->name('customers.orders');


route::get('/cart', [CartController::class, 'index'])->name('customer.cart');
route::Post('/cart/add/{productId}', [CartController::class, 'add'])->name('customer.cart.add');
route::put('/cart/update/{cartId}', [CartController::class, 'update'])->name('customer.cart.update');
route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('customer.cart.remove');



route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('customer.checkout');
Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('customer.checkout.process');
Route::get('/customer/confirmation/{orderId}', [OrderController::class, 'confirmation'])->name('customer.order.confirmation');
Route::get('/customer/orders/{id}', [CustomerController::class, 'show'])->name('customer.show');
Route::get('orders', [CustomerController::class, 'orders'])->name('customer.orders');
