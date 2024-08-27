<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::group(['middleware' => 'web'], function () {
    Route::get('/', [ApiController::class, 'index'])->name('api.index');
    Route::get('/store', [ApiController::class, 'store'])->name('store');
    Route::get('/api/detail/{param}', [ApiController::class, 'detail'])->name('api.detail');
});
