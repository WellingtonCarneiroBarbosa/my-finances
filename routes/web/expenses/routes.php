<?php

use App\Http\Controllers\Expenses\CreateController;

Route::prefix('/gastos')->name('expenses.')->group(function () {
    Route::get('/registrar', CreateController::class)->name('create');
    Route::post('/registrar', [CreateController::class, 'store'])->name('store');

    require __DIR__ . '/categories/routes.php';
});
