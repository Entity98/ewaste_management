<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Models\Category;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',HomeComponent::class);

Route::get('/shop',ShopComponent::class);

Route::get('/cart',CartComponent::class)->name('product.cart');

Route::get('/checkout',CheckoutComponent::class);

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('product-category/{category_slug}', CategoryComponent::class)->name('product.category');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// For Admin
Route::middleware([
        'auth:sanctum', config('jetstream.auth_session'), 'verified', 'authadmin'])->group(function () {
    Route::get('admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
});

// For user
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/admin/category',AdminCategoryComponent::class)->name('admin.category');
    Route::get('admin/category/add',AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('admin/category/edit/{category_slug}',AdminEditCategoryComponent::class)->name('admin.editcategory');
});