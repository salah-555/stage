<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

// Route::middleware(['auth'])->group(function () {
//     Route::middleware(function ($request, $next) {
//         if (auth()->user() && auth()->user()->role !== 'admin') {
//             return redirect('/')->with('error', 'Accès refusé.');
//         }
//         return $next($request);
//     })->group(function () {
//         Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
//         Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//         Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
//         Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
//         Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
//     });
// });

// Route::resource('products', ProductController::class);

// Routes accessibles à tout le monde (ex: voir les produits)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// Route::get('/accueil', [HomeController::class, 'index'])->name('accueil');

Route::get('/', [HomeController::class, 'index'])->name('accueil');


// Routes protégées pour les admins seulement
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
//     Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//     Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
//     Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
//     Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
// });

// Route::middleware(['admin'])->group(function () {
//     Route::resource('products', ProductController::class)->except(['index', 'show']);
    
// });
//////////////////////

// Routes accessibles à tout le monde
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');



Route::middleware(['auth'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});









// Route::get('/dashboard', function() {
//     return view('dashboard');
// })->name('dashboard');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');




Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');


Route::get('/register', [AuthClientController::class, 'showregisterForm'])->name('client.register');
Route::post('/register', [AuthClientController::class, 'register'])->name('client.register');

Route::get('/login', [AuthClientController::class, 'showLoginForm'])->name('client.login');
Route::post('/login', [AuthClientController::class, 'login']);

Route::post('/logout', [AuthClientController::class, 'logout'])->name('logout'); 



// Routes du panier
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Route pour passer commande

Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');

// route pour les orders  
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// route pour mettre le client est annulee leur commande

Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

route::get('/admin/orders', function () {
    return redirect()->route('orders.index')->with("success", 'Commande mises a jour .');
});


// Cette route pour tester la connexion 

Route::get('/test-auth', function() {
    return response()->json([
        'user' => auth()->user(),
    ]);
});



// Route::middleware(['auth:clients'])->group(function () {
//      Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
//      Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
//  });

// Route::middleware(['auth:admin'])->group(function () {
//     Route::patch('/orders/{order', [OrderController::class, 'update'])->name('orders.update');
// });

// route pour les admins
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
// });


