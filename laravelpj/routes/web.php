<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CrudAdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\CrudCategoryController;
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;


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
//route category Show and Create
Route::get('/categories', [CrudCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CrudCategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CrudCategoryController::class, 'store'])->name('categories.store');
//route category Edit
Route::get('/categories/{id}/edit', [CrudCategoryController::class, 'editCategory'])->name('categories.editCategory');
Route::put('/categories/{id}', [CrudCategoryController::class, 'update'])->name('categories.update');
//Route Delete
Route::delete('/categories/{id}', [CrudCategoryController::class, 'deleteCategory'])->name('categories.deleteCategory');


//user:route hiển thị danh sách người dùng mẫu
Route::get('/users', [CrudAdminUserController::class, 'index'])->name('users.index');
//user: route hiển thị forrm thêm người dùng
Route::get('/users/create', [CrudAdminUserController::class, 'create'])->name('users.create');
//user: route đến hàm store để xử lý thêm người dùng
Route::post('/users', [CrudAdminUserController::class, 'store'])->name('users.store');

// Xử lý cập nhật người dùng
Route::get('/users/update/{id}', [CrudAdminUserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [CrudAdminUserController::class, 'update'])->name('users.update');
//xử lý xóa người dùng// Xử lý xóa người dùng
Route::delete('/users/{id}', [CrudAdminUserController::class, 'delete'])->name('users.delete');
//route crud_orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
//route tintuc
Route::get('/blog', [BaiVietController::class, 'index'])->name('baiviet.index');
Route::get('/blog/{id}', [BaiVietController::class, 'show'])->name('baiviet.show');
//route productCrud
//route hiển thị danh sách sản phẩm
Route::get('/products', [CrudProductController::class, 'index'])->name('products.index');
//route chuyển hướng qua trang thêm sản phẩm
Route::get('/products/create', [CrudProductController::class, 'create'])->name('products.create');
//route xử lý thêm sản phẩm
Route::post('/products', [CrudProductController::class, 'store'])->name('products.store');
//route xử lí chỉnh sửa sản phẩm
Route::get('/products/{product}/edit', [CrudProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [CrudProductController::class, 'update'])->name('products.update');




Route::get('/', function () {
    return view('welcome');
});
//user: route xử lí thêm người dùng
