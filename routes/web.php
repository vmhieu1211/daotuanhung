<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\CouponsController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\SystemSettingsController;

Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::get('on-sale', [FrontendController::class, 'onSale'])->name('on-sale');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('frontendCategory');
Route::get('/categories', [FrontendController::class, 'categories'])->name('frontendCategories');
Route::get('/sub-category/{slug}', [FrontendController::class, 'subcategory'])->name('subcategory');
Route::get('/product/{slug}', [FrontendController::class, 'show'])->name('single-product');
Route::post('/contact', [FrontendController::class, 'contactStore'])->name('store-contact');
Route::get('/about', [FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact-us');
Route::get('/terms-and-conditions', [FrontendController::class, 'terms'])->name('terms.conditions');
Route::get('/privacy-policy', [FrontendController::class, 'privacy'])->name('privacy.policy');

Route::resource('cart', CartController::class);

Route::post('coupons', [CouponsController::class, 'store'])->name('coupons.store');
Route::delete('coupons', [CouponsController::class, 'destroy'])->name('coupons.destroy');

// Authenticated users routes
Route::middleware('auth',)->group(function () {
	Route::get('my-orders', [ProfileController::class, 'index'])->name('my-orders.index');
	Route::get('my-profile', [ProfileController::class, 'edit'])->name('my-profile.edit');
	Route::post('my-profile', [ProfileController::class, 'update'])->name('my-profile.store');
	Route::get('my-orders/{id}', [ProfileController::class, 'show'])->name('my-profile.show');
	// Route::resource('orders', OrderController::class);
	Route::resource('checkout', CheckoutController::class);
});

// Login & Register Routes
Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Adminstrator Routes
Route::middleware(['auth', 'admin'])->group(function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');
	Route::resource('admin/users', UserController::class);
	Route::resource('admin/slides', SlideController::class);
	Route::resource('admin/categories', CategoryController::class);
	Route::resource('admin/subcategories', SubCategoryController::class);
	Route::delete('admin/products/photo/{id}', [ProductController::class, 'destroyImage'])->name('destroyImage');
	Route::delete('admin/products/attribute/{id}', [ProductController::class, 'destroyAttribute'])->name('destroyAttribute');
	Route::resource('admin/coupon', CouponController::class);
	Route::resource('admin/products', ProductController::class);
	Route::resource('admin/system-settings', SystemSettingsController::class);
	Route::get('/admin/contact', [MessageController::class, 'index'])->name('contactMessages');
	Route::get('/admin/contact/{id}', [MessageController::class, 'show'])->name('contact.show');
	Route::resource('admin/orders', OrderController::class);
	Route::resource('admin/roles', RoleController::class);
	Route::resource('admin/order-statuses', OrderStatusController::class);
});
