<?php

use App\Http\Controllers\Incomes\CreateController;
use Illuminate\Support\Facades\Route;

Route::prefix('receitas')->name('incomes.')->group(function () {
    Route::get('/novo', CreateController::class)->name('create');
    Route::post('/novo', [CreateController::class, 'store'])->name('store');
});
