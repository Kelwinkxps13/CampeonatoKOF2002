<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampController;

Route::post('/create', [CampController::class, 'store'])->name('store_camp');
Route::get('/create', [CampController::class, 'create'])->name('create_camp');
Route::get('/{camp}', [CampController::class, 'camp'])->name('camp');
Route::get('/', [CampController::class, 'index'])->name('index');
