<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('products', ProductController::class);


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/', [HomeController::class, 'index'])->name('accueil');


Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


Route::get('/register', [AuthClientController::class, 'showregisterForm'])->name('client.register');
Route::post('/register', [AuthClientController::class, 'register'])->name('client.register');

Route::get('/login', [AuthClientController::class, 'showLoginForm'])->name('client.login');
Route::post('/login', [AuthClientController::class, 'login']);

Route::post('/logout', [AuthClientController::class, 'logout'])->name('logout'); 

// route pour les orders  

Route::middleware(['auth:clients'])->group(function () {
     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
     Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
 });

// Route::middleware(['auth:admin'])->group(function () {
//     Route::patch('/orders/{order', [OrderController::class, 'update'])->name('orders.update');
// });

// route pour les admins
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// });


