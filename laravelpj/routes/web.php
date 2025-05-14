<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudCategoryController;

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
//route category xem va them
Route::get('/categories', [CrudCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CrudCategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CrudCategoryController::class, 'store'])->name('categories.store');


Route::get('/', function () {
    return view('welcome');
});
