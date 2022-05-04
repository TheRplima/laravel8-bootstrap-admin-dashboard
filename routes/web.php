<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->name('admin.')->group(function(){
    Route::get('/users/restore-all', [UserController::class, 'restoreAll'])->name('users.restore-all');
    Route::get('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::resource('/users', UserController::class);

    Route::get('/pages/restore/{page}', [PageController::class, 'restore'])->name('pages.restore');
    Route::get('/pages/restore-all', [PageController::class, 'restoreAll'])->name('pages.restore-all');
    Route::resource('/pages', PageController::class);

    Route::get('/products/restore/{product}', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('/products/restore-all', [ProductController::class, 'restoreAll'])->name('products.restore-all');
    Route::resource('products', ProductController::class);

    Route::resource('/menus', MenuController::class);

    Route::resource('roles', RoleController::class);
});
