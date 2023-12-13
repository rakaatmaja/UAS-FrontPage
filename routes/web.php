<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');;
Route::get('/promo', [HomeController::class, 'index2'])->name('promo');
Route::get('/wishlist', [HomeController::class, 'index3'])->name('wishlist');
Route::get('/uts', [HomeController::class, 'index4'])->name('uts');
// Route::get('/admin', [ShopController::class, 'index'])->name('admin');
// Route::get('/admin/create', [ShopController::class,'create'])->name('create');
// Route::post('/admin/simpan', [ShopController::class,'simpan']);


Route::group(['middleware'=>'auth'], function () { 
    Route::resource('admin', ShopController::class); 
}); 


// Route::group(['middleware'=>'auth'], function () {
//     Route::resource('admin', ShopController::class)->names([
//         'index' => 'admin.index',
//         // Define other route names as needed
//     ]);
// });


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
