<?php

Route::prefix('/gastos')->name('expenses.')->group(function () {
    require __DIR__ . '/categories/routes.php';
});
