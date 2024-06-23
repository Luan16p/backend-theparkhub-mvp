<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InterfaceController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\SearchController;

Route::get('/', [InterfaceController::class, 'index'])->name('index');

Route::get('/estacionamento_reservar', [VagaController::class, 'index'])->name('reservar.index');
Route::post('/estacionamento_reservar', [VagaController::class, 'update'])->name('reservar.update');

Route::post('/reservar', [VagaController::class, 'store'])->name('reservar.store');


Route::get('/pesquisar', [SearchController::class, 'index'])->name('pesquisar.index');