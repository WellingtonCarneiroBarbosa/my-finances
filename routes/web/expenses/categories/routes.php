<?php

use App\Http\Controllers\Expenses\Categories\CreateController;
use Illuminate\Support\Facades\Route;

Route::prefix('categorias')->name('categories.')->group(function () {
    Route::get('/novo', CreateController::class)->name('create');
    Route::post('/novo', [CreateController::class, 'store'])->name('store');
});
