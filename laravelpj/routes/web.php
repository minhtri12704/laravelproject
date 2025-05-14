<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudAdminUserController;

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









Route::get('/', function () {
    return view('welcome');
});
//user: route xử lí thêm người dùng
