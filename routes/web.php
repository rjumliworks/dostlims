<?php

use App\Http\Controllers\VelzonRoutesController;
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
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/search', [App\Http\Controllers\SearchController::class, 'search']);

Route::middleware(['role:Human Resource Officer'])->group(function () {
    Route::resource('/employees', App\Http\Controllers\HumanResource\EmployeeController::class);
});

Route::middleware(['role:Administrator'])->group(function () {
    Route::resource('/users', App\Http\Controllers\Executive\UserController::class);
    Route::resource('/facilities', App\Http\Controllers\Executive\FacilityController::class);
    Route::resource('/references', App\Http\Controllers\Executive\ReferenceController::class);
    Route::resource('/discounts', App\Http\Controllers\Executive\DiscountController::class);
});

require __DIR__.'/auth.php';
