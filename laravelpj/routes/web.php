<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CrudAdminUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\CrudCategoryController;
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\ProductListController;

use App\Http\Controllers\ChiTietSanPhamController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KhachHangController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomePageController;

use App\Http\Controllers\WishlistController;
use App\Http\Controllers\RegisterController;  
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\CartController; 


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
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
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
Route::delete('/products/{product}', [CrudProductController::class, 'delete'])->name('products.delete');


//route payment
Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

// Hiển thị danh sách sản phẩm chính
Route::get('/sanpham', [ProductListController::class, 'index'])->name('sanpham.index');
//route lấy danh mục tại HomePage
Route::get('/sanpham/{id}', [ProductListController::class, 'showByCategory'])->name('products.byCategory');
// Trang chi tiết sản phẩm
Route::get('/chitietsanpham/{id}', [ChiTietSanPhamController::class, 'show'])->name('chitietsanpham.show');

//route Guest
Route::get('/khachhang', [KhachHangController::class, 'index'])->name('khachhang');
Route::get('/khachhang/create', [KhachHangController::class, 'create'])->name('khachhang.create');
Route::post('/khachhang', [KhachHangController::class, 'store'])->name('khachhang.store');
Route::get('/khachhang/{id}/edit', [KhachHangController::class, 'edit'])->name('khachhang.edit');
Route::delete('/khachhang/{id}', [KhachHangController::class, 'destroy'])->name('khachhang.destroy');

//route LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');












//home page
Route::get('/home', [HomePageController::class, 'index'])->name('home');

//Whislist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.show_wishlist');
Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/decrease/{id}', [WishlistController::class, 'decrease'])->name('wishlist.decrease');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::get('/', function () {
    return view('welcome');
});
//user: route xử lí thêm người dùng

// Giỏ hàng
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/remove-item/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

