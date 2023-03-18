<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\KonserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BayarTiketController;
use App\Http\Controllers\OrderTiketController;
use App\Http\Controllers\TiketClientController;
use App\Http\Controllers\ClientDashboardController;

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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('administrator')->middleware(['auth', 'auth.administrator'])->group(function () {

    Route::get('/beranda', [DashboardController::class, 'index'])->name('administrator.beranda');
    Route::resource('/konser', KonserController::class);
    Route::resource('/tiket', TiketController::class);
    Route::resource('/ordertiket', OrderTiketController::class);
    Route::resource('/pembayarantiket', BayarTiketController::class);
});

Route::prefix('client')->middleware(['auth', 'auth.client'])->group(function () {

    Route::get('/beranda', [ClientDashboardController::class, 'index'])->name('client.beranda');
    Route::resource('/tiket', TiketClientController::class);

});

Route::get('logout', function () {
    Auth::user()->logout();
});




