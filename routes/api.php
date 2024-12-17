<?php

use App\Http\Controllers\Api\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('suppliers', SupplierController::class)
    ->name('index', 'api.suppliers.index')
    ->name('store', 'api.suppliers.store')
    ->name('show', 'api.suppliers.show')
    ->name('update', 'api.suppliers.update')
    ->name('destroy', 'api.suppliers.destroy');
