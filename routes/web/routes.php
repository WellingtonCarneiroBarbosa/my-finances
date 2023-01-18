<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->name('dashboard.')->group(function () {
    require __DIR__ . '/incomes/routes.php';
});
