<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspacoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AdminReservaController;
use App\Http\Middleware\CheckIfAdmin;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminExportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('reservas', ReservaController::class);
    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔐 Rotas protegidas por middleware admin
Route::middleware(['auth', CheckIfAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('export/excel', [AdminExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('export/pdf', [AdminExportController::class, 'exportPdf'])->name('export.pdf');

    Route::get('reservas', [AdminReservaController::class, 'index'])->name('reservas.index');
    Route::get('reservas/{id}/edit', [AdminReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('reservas/{id}', [AdminReservaController::class, 'update'])->name('reservas.update');
    Route::delete('reservas/{id}', [AdminReservaController::class, 'destroy'])->name('reservas.destroy');
});
Route::middleware(['auth', CheckIfAdmin::class])->group(function () {
    Route::resource('espacos', EspacoController::class);
});


require __DIR__.'/auth.php';
