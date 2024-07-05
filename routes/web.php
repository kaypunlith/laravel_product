<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\FontEndController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UpdateProfileController;
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



// Route::view('/admin','admin.main');
Route::get('/category',[CategoryController::class,'index'])->name('category.list');
Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::post('/category',[CategoryController::class,'store'])->name('category.store');
Route::get('/category/{categoryId}/edit',[CategoryController::class,'edit'])->name('category.edit');
Route::put('/category/{categoryId}',[CategoryController::class,'update'])->name('category.update');
Route::get('/category/{categoryId}',[CategoryController::class,'show'])->name('category.show');
Route::delete('/category/{categoryId}',[CategoryController::class,'destroy'])->name('category.delete');


Route::controller(ProductController::class)->group(function(){
    
    Route::get('/product','index')->name('product.list');
    Route::get('/product/create','create')->name('product.create');
    Route::post('/product','store')->name('product.store');
    Route::get('/product/{proId}/edit','edit')->name('product.edit');
    Route::put('/product/{proId}','update')->name('product.update');
    Route::delete('/product/{proId}','destroy')->name('product.delete');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/registration','registration')->name('register');
    Route::post('/post-register','postRegister')->name('register.post');
    
    Route::get('/login','index')->name('login');
    Route::post('/post-login','postLogin')->name('login.post');

    Route::get('/logout','logout')->name('logout');
    // check middleware
    Route::get('/dashboard','dashboard')->middleware(['auth' => 'is_verify_email']);
    Route::get('/account/verify/{token}','verifyAccount')->name('user.verify');

});

Route::get('/change-password',[ChangePasswordController::class,'index'])->name('form.password');
Route::post('/change-password',[ChangePasswordController::class,'store'])->name('change.password');

Route::get('/update-profile/{user}', [UpdateProfileController::class,'editProfile'])->name('profile.edit');
Route::patch('/update-profile/{user}', [UpdateProfileController::class,'updateProfile'])->name('profile.update');


// Route Front-End

Route::get('/',[FontEndController::class,'index'])->name('frontend.index');
Route::get('/show/{productId}',[FontEndController::class,'show'])->name('frontend.show');
Route::get('/search',[FontEndController::class,'getBysearch'])->name('frontend.search');
Route::get('/showcategory/{categoryId}',[FontEndController::class,'getByCategory'])->name('frontend.category');

// Add to cart
Route::controller(StoreController::class)->group(function(){
    Route::get('/cart','cart')->name('cart');
    Route::get('/add-to-cart/{id}','addToCart')->name('add.to.cart');
    Route::patch('/update-cart','update')->name('update.cart');
    Route::delete('/remove-cart','remove')->name('remove.cart');
    Route::get('checkout','checkout')->name('checkout.save');

});

Route::controller(OrderController::class)->group(function(){
    Route::get('/order', 'index')->name('admin.order');
    Route::post('/order/approve/{id}', 'approve')->name('admin.approve');
    Route::post('/order/reject/{id}','reject')->name('admin.reject');
});