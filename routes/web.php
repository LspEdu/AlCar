<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::user()->rol == 'admin') return redirect()->route('admin.index');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/payment', [StripeController::class, 'pagos'])->name('metodos');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/coche', [CocheController::class, 'index'])->name('coche.index');
    Route::get('/coche/create', [CocheController::class , 'create'])->name('coche.create');
    Route::post('/coche/create', [CocheController::class, 'store'])->name('coche.store');
    Route::get('/coche/{id}', [CocheController::class, 'show'])->name('coche.show');
    Route::get('/coche/{id}/json', [CocheController::class, 'json'])->name('coche.json');
    Route::get('/coche/{id}/edit', [CocheController::class, 'edit'])->name('coche.edit');
    Route::post('/coche/{id}/edit', [CocheController::class, 'update'])->name('coche.update');
    Route::delete('/coche/{id}/destroy', [CocheController::class, 'destroy'])->name('coche.delete');
    Route::post('/coche/{id}/reservar', [FacturaController::class, 'reservar'])->name('coche.reservar');
    Route::post('/coche/{id}/alquilar', [FacturaController::class, 'alquilar'])->name('coche.alquilar');
});


Route::middleware('auth')->group(function() {
    Route::get('/factura', [FacturaController::class, 'index'])->name('factura.index');
    Route::get('/factura/{id}', [FacturaController::class , 'show'])->name('factura.show');
    Route::post('/factura/{codigo}', [FacturaController::class, 'destroy'])->name('factura.cancelar');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/coche', [AdminController::class, 'coches'])->name('admin.coches');
    Route::get('/admin/coche/{id}', [AdminController::class, 'showCoche'])->name('admin.coche');
    Route::delete('/admin/coche/{id}', [AdminController::class, 'destroyCoche'])->name('admin.coche-destroy');
    Route::get('/admin/coche/{id}/validar', [AdminController::class, 'validar'])->name('admin.validar');
    Route::get('/admin/usuario', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/admin/usuario/{id}', [AdminController::class, 'showUsuario'])->name('admin.usuario');
    Route::delete('/admin/usuario/{id}', [AdminController::class, 'destroyUsuario'])->name('admin.usuario-destroy');
});


require __DIR__.'/auth.php';
