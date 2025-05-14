<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudAdminUserController;
use App\Http\Controllers\OrderController;

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


//user:route hiển thị danh sách người dùng mẫu
Route::get('/users', [CrudAdminUserController::class, 'index'])->name('users.index');
//user: route hiển thị forrm thêm người dùng
Route::get('/users/create', [CrudAdminUserController::class, 'create'])->name('users.create');
//user: route đến hàm store để xử lý thêm người dùng
Route::post('/users', [CrudAdminUserController::class, 'store'])->name('users.store');

//route crud_orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');



Route::get('/', function () {
    return view('welcome');
});
//user: route xử lí thêm người dùng
