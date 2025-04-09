<?php

use App\Http\Controllers\ClientControllerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
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

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/client-add', [ClientController::class, 'add'])->name('client');
Route::get('client-view', [ClientController::class, 'view'])->name('client-view');
Route::get('client-create', [ClientController::class, 'create']);
Route::post('client-store', [ClientController::class, 'store']);
Route::get('/client-edit/{id}', [ClientController::class, 'edit'])->name('client-edit');;
Route::put('/client-update/{id}', [ClientController::class, 'update'])->name('client-update');
Route::post('/client-delete/{id}', [ClientController::class, 'destroy'])->name('client-delete');
Route::get('/client-show/{id}', [ClientController::class, 'show'])->name('client-show');

require __DIR__.'/auth.php';
