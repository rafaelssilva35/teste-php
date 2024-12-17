<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('suppliers', SupplierController::class)->names([
    'index' => 'suppliers.index',
    'create' => 'suppliers.create',
    'store' => 'suppliers.store',
    'show' => 'suppliers.show',
    'edit' => 'suppliers.edit',
    'update' => 'suppliers.update',
    'destroy' => 'suppliers.destroy',
]);
// Route::resource('suppliers/create', SupplierController::class)->except(['create']);
