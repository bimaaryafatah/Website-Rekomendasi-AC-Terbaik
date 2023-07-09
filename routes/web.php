<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AcController;

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
})->name('/');

Route::get('/ac', [AcController::class, 'index'])->name('ac');
Route::get('/create', [AcController::class, 'create'])->name('create');
Route::post('/store', [AcController::class, 'store'])->name('store');
Route::get('/edit/{id}', [AcController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [AcController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [AcController::class, 'destroy'])->name('delete');
Route::match(['get', 'post'], '/hasil', [AcController::class, 'spk'])->name('spk');
Route::match(['get', 'post'], '/showform', [AcController::class, 'showform'])->name('showform');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');

Route::get('/datatable', function () {
    return view('backend.datatable');
});
