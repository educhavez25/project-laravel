<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);

// Ruta de prueba simple
Route::get('/prueba', function () {
    return '¡La ruta funciona!';
});
