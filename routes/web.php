<?php

use App\Http\Controllers\CocheController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/coches', [CocheController::class, 'index'])->name('coche.index');
    Route::get('/coche/create', [CocheController::class , 'create'])->name('coche.create');
    Route::post('/coche/create', [CocheController::class, 'store'])->name('coche.store');
    Route::get('/coche/{id}', [CocheController::class, 'show'])->name('coche.show');
    Route::get('/coche/edit/{id}', [CocheController::class, 'edit'])->name('coche.edit');
    Route::post('/coche/edit/{id}', [CocheController::class, 'update'])->name('coche.update');
    Route::delete('/coche/destroy/{id}', [CocheController::class, 'destroy'])->name('coche.delete');
});

require __DIR__.'/auth.php';
